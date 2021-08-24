<?php
/*
	Archivo: CambiarClave.php
	Autor: Armas, Juan Manuel
	Proposito: Controlador para el cambio de claves de un usuario
	Fecha: 18/12/2020
	Ultima edición: 18/12/2020
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

	// Se obtiene la ID del usuario
	$ID = $_SESSION['id_usuario'];
	
	// Se obtienen los datos enviados del cliente
	$Password = $_POST['Clave'];
	$NewPassword = $_POST['NuevaClave'];

	if ($stmt = $mysqli->prepare("SELECT password, salt FROM usuarios WHERE id_usuario = ? LIMIT 1")) {
        $stmt->bind_param('i', $ID);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($db_Password, $salt);
        $stmt->fetch();

        $Password = hash('sha512', $Password . $salt);
	
        if ($stmt->num_rows == 1) {
			// Chequea si la clave ingresada es la correcta
			if ($db_Password == $Password) {
				// Si la clave nueva es inválida (más o menosde 128 caracteres), se notifica al usuario.
				if (strlen($NewPassword) != 128) {
					echo json_encode(array("error" => "Configuracion de contraseña incorrecta."));
					exit();
				}

				// Obtiene un decriptador aleatorio para la clave
				$new_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
				$Password = hash('sha512', $NewPassword . $new_salt);

				$Consulta = mysqli_query($mysqli, "UPDATE usuarios SET password = '$Password', salt = '$new_salt' WHERE id_usuario = '$ID'");

				// Se chequea si se actualizó correctamente
				if ($Consulta) {
					// Devuelve exitosamente el resultado
					echo json_encode(array("success" => true));
					exit();
				} else {
					// Devuelve error
					echo json_encode(array("error" => "¡No se pudo guardar la nueva clave!"));
					exit();
				}
			} else {
				// Si da error en la base de datos, se da aviso.
				echo json_encode(array("error" => "¡La clave ingresada es incorrecta!"));
				exit();
			}
        } else {
			// Si da error en la base de datos, se da aviso.
			echo json_encode(array("error" => "¡Error interno en la base de datos!"));
			exit();
        }
    } else {
		// Si da error en la base de datos, se da aviso.
		echo json_encode(array("error" => "¡Ocurrió un error interno!"));
        exit();
    }
?>