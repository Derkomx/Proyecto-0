<?php
/*
	Archivo: CambiarClave.php
	Autor: Armas, Juan Manuel
	Proposito: Controlador para el cambio de correo electrónico de un usuario
	Fecha: 21/12/2020
	Ultima edición: 21/12/2020
*/

	// Incluye los archivos necesarios
	include_once 'MySQL.php';
	include_once 'functions.php';

	// Ajusta correctamente la zona horaria
	setlocale(LC_CTYPE, 'es');
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	$Activacion = $_POST['Activacion'];

	if ($stmt = $mysqli->prepare("SELECT nuevoemail FROM usuarios WHERE activacion = ? LIMIT 1")) {
        $stmt->bind_param('s', $Activacion);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($Correo);
        $stmt->fetch();

        if ($stmt->num_rows == 1) {
			$Consulta = mysqli_query($mysqli, "UPDATE usuarios SET email = '$Correo', nuevoemail = NULL, activacion = NULL WHERE activacion = '$Activacion'");

			// Se chequea si se actualizó correctamente
			if ($Consulta) {
				// Devuelve exitosamente el resultado
				echo json_encode(array("success" => true));
				exit();
			} else {
				// Devuelve error
				echo json_encode(array("error" => "¡No se pudo cambiar el correo!"));
				exit();
			}
        } else {
			// Si da error en la base de datos, se da aviso.
			echo json_encode(array("error" => "¡El código de confirmación para el nuevo correo no existe o ya fue cambiado!"));
			exit();
        }
    } else {
		// Si da error en la base de datos, se da aviso.
		echo json_encode(array("error" => "¡Ocurrió un error interno!"));
        exit();
    }
?>