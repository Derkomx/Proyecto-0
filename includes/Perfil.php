<?php
/*
	Archivo: Perfil.php
	Autor: Armas, Juan Manuel
	Proposito: Funcionamiento del perfil en el servidor
	Fecha: 16/12/2020
	Ultima edición: 23/12/2020
*/

	// Inicia la sesión correspondiente
	ob_start();
	session_start();

	// Incluye los archivos necesarios
	include_once 'MySQL.php';
	include_once 'functions.php';

	// Ajusta correctamente la zona horaria
	setlocale(LC_CTYPE, 'es');
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	// Chequea el tipo de ejecución de este archivo
	$Tipo = $_POST['Tipo'];

	// Se obtiene la ID del usuario
	$ID = $_SESSION['id_usuario'];

	if (isset($Tipo) && ($Tipo == "Cambiar imagen")) {
		// Se obtienen los datos necesarios
		$Imagen = $_POST['Imagen'];
 
		// Chequea si existe la carpeta donde guardar las imagenes
		if (!is_dir('Perfil')) {
			// Si no existe, crea la carpeta
			mkdir('Perfil', 0777, true);
		}

		if (file_exists("Perfil/".$ID.".jpeg")) {
			unlink("Perfil/".$ID.".jpeg");
		}

		$Datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $Imagen));
		$filepath = "Perfil/".$ID.".jpeg";
		file_put_contents($filepath, $Datos);
		
		echo json_encode(array("success" => true ));
		exit();
	} elseif (isset($Tipo) && ($Tipo == "Modo oscuro")) {
		// Se obtiene el estado al que se quiere cambiar el modo oscuro
		$Estado = $_POST['Estado'];

		// Se actualiza el estado en la base de datos
		$Consulta = mysqli_query($mysqli, "UPDATE usuarios SET darkmode = '$Estado' WHERE id_usuario = '$ID'");
		
		// Se chequea si se actualizó correctamente
		if ($Consulta) {
			// Devuelve exitosamente el resultado
			echo json_encode(array("success" => true));
			exit();
		} else {
			// Devuelve error
			echo json_encode(array("error" => "No se pudo guardar el cambio!"));
			exit();
		}
	} elseif (isset($Tipo) && ($Tipo == "Cambiar correo")) {
		// Se obtienen los datos necesarios enviados desde el cliente
		$Correo = $_POST['Correo'];

		// Realiza una consulta para obtener una cuenta con el nuevo correo electrónico
		if ($stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1")) {
			$stmt->bind_param('s', $Correo);
			$stmt->execute();
			$stmt->store_result();

			// Chequea si ya existe una cuenta con ese correo
			if ($stmt->num_rows > 0) {
				// Devuelve error
				echo json_encode(array("error" => "¡Ya hay una cuenta registrada con el nuevo correo que ingresaste!"));
				exit();
			}
		} else {
			// Si da error en la base de datos, se da aviso.
			echo json_encode(array("error" => "¡Ocurrió un error interno!"));
			exit();
		}

		// Genera un código de activación para el nuevo correo
		$Activacion = md5($cuil.time());

		// Se actualiza el estado en la base de datos
		$Consulta = mysqli_query($mysqli, "UPDATE usuarios SET nuevoemail = '$Correo', activacion = '$Activacion' WHERE id_usuario = '$ID'");
		
		// Se chequea si se actualizó correctamente
		if ($Consulta) {
			// Envía el correo electrónico a la nueva dirección
			$email = $Correo;
			$EmailType = 'CambioCorreo';
			include 'Email.php';

			// Devuelve exitosamente el resultado
			echo json_encode(array("success" => true));
			exit();
		} else {
			// Devuelve error
			echo json_encode(array("error" => "¡No se pudo guardar el cambio!"));
			exit();
		}
	}
?>