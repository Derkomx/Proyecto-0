<?php
	ob_start();
	session_start();

	include_once 'MySQL.php';
	include_once 'functions.php';
	include_once 'Registros.php';

	// Ajusta correctamente la zona horaria
	setlocale(LC_CTYPE, 'es');
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	// Chequea la sección que debe ejecutare
	$Seccion = $_POST['Seccion'];

	// Obtiene los datos necesarios para la ejecución
	$ID = $_SESSION['id_usuario'];
	$Horario = date("Y-m-d H:i:s");

	// Obtiene el ID del usuario
	$ID = $_SESSION['id_usuario'];

	if (isset($Seccion) && ($Seccion == "Enviar codigo")) {
		// Variables necesarias
		$PIN = generarCodigo(6);

		// Se chequea si la consulta devolvió resultados
		//if (mysqli_num_rows($Consulta) == 0) {
			if ($insert_stmt = $mysqli->prepare("INSERT INTO seguridad (id, pin, enviado, tiempo) VALUES (?, ?, ?, NULL) ON DUPLICATE KEY UPDATE id = VALUES(id), pin = VALUES(pin), enviado = VALUES(enviado), tiempo = VALUES(tiempo)")) {
				$insert_stmt->bind_param('iss', $ID, $PIN, $Horario);
			
				if (!$insert_stmt->execute()) {
					echo json_encode(array("error" => "Error interno en la base de datos!"));
					exit();
				} else {
					$email = $_SESSION['email'];
					$EmailType = 'Seguridad';
					include 'Email.php';

					echo json_encode(array("success" => "true"));
					exit();
				}
			}
		//}
	} elseif (isset($Seccion) && ($Seccion == "Activar codigo")) {
		// Se realiza una consulta para verificar si ya hay un correo enviado
		$Consulta = mysqli_query($mysqli, "SELECT * FROM seguridad WHERE id='$ID'");
		$Resultado = mysqli_fetch_array($Consulta);

		// Se chequea si la consulta devolvió resultados
		if (mysqli_num_rows($Consulta) > 0) {
			// Chequea si el código almacenado, es el código correcto ingresado
			if ($Resultado['pin'] == $_POST['Codigo']) {
				// Chequea si el código sigue siendo válido
				if (minutosTranscurridos($Horario, $Resultado['enviado']) > 15) {
					echo json_encode(array("expirado" => "true"));
					exit();
				} else {
					if ($update_stmt = $mysqli->prepare("UPDATE seguridad SET tiempo=? WHERE id=?")) {
						$update_stmt->bind_param('si', $Horario, $ID);
					
						if (!$update_stmt->execute()) {
							echo json_encode(array("error" => "Error interno en la base de datos!"));
							exit();
						} else {
							echo json_encode(array("success" => "true"));
							exit();
						}
					}
				}
			} else {
				echo json_encode(array("error" => "¡El código de seguridad es incorrecto!"));
				exit();
			}
		} else {
			echo json_encode(array("error" => "¡No hay código de seguridad pendiente para tu cuenta!"));
			exit();
		}
	} elseif (isset($Seccion) && ($Seccion == "Exportar usuarios")) {
		$Resultados = [];

		if ($stmt = $mysqli->prepare("SELECT a.id_usuario, b.ncont FROM usuarios a LEFT JOIN contribuyente b ON b.id_usuario = a.id_usuario")) {
			$stmt->execute();
			$stmt->store_result();

			$stmt->bind_result($uID, $nCont);

			// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
			/*if ($stmt->num_rows == 0) {
				return null;
				exit();
			}*/

			$Resultados[] = array(
				array (
					'text' => 'CUIL',
				),

				array (
					'text' => 'Apellido/s',
				),

				array (
					'text' => 'Nombre/s',
				),

				array (
					'text' => 'N° Contribuyente',
				),

				array (
					'text' => 'Alta',
				),

				array (
					'text' => 'E-Mail',
				),

				array (
					'text' => 'Tel./Celular',
				),

				array (
					'text' => 'Dirección',
				),

				array (
					'text' => 'Localidad',
				),

				array (
					'text' => 'Estado',
				),
			);

			while ($stmt->fetch()) {
				$Datos = obtenerDatosUsuario($uID, $mysqli);
				$estadoUsuario = obtenerEstadoUsuario($uID, $mysqli);

				$Resultados[] = array(
					array (
						'text' => CUILFormat($Datos[0]),
					),
					
					array (
						'text' => $Datos[4],
					),
					
					array (
						'text' => $Datos[5],
					),

					array(
						'text' => $nCont,
					),

					array(
						'text' => $Datos[3],
					),

					array(
						'text' => $Datos[1],
					),

					array(
						'text' => $Datos[9],
					),

					array(
						'text' => $Datos[6],
					),

					array(
						'text' => $Datos[7],
					),

					array(
						'text' => $estadoUsuario,
					),
				);
			}

			//exportProductDatabase($Resultados);
		} else {
			echo json_encode(array("error" => "¡No se pudo conectar a la base de datos!"));
			exit();
		}

		guardarRegistro($mysqli, $ID, 12);

		echo json_encode(array("success" => $Resultados));
		exit();
	} elseif (isset($Seccion) && ($Seccion == "Exportar contribuyentes")) {
		$Resultados = [];

		if ($stmt = $mysqli->prepare("SELECT a.id_usuario, b.ncont FROM usuarios a LEFT JOIN contribuyente b ON b.id_usuario = a.id_usuario")) {
			$stmt->execute();
			$stmt->store_result();

			$stmt->bind_result($uID, $nCont);

			// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
			/*if ($stmt->num_rows == 0) {
				return null;
				exit();
			}*/

			$Resultados[] = array(
				array (
					'text' => 'CUIL',
				),

				array (
					'text' => 'Apellido/s',
				),

				array (
					'text' => 'Nombre/s',
				),

				array (
					'text' => 'N° Contribuyente',
				),

				array (
					'text' => 'Alta',
				),

				array (
					'text' => 'E-Mail',
				),

				array (
					'text' => 'Tel./Celular',
				),

				array (
					'text' => 'Dirección',
				),

				array (
					'text' => 'Localidad',
				),

				array (
					'text' => 'Estado',
				),
			);

			while ($stmt->fetch()) {
				if (isset($nCont) && strlen($nCont) > 0) {
					$Datos = obtenerDatosUsuario($uID, $mysqli);
					$estadoUsuario = obtenerEstadoUsuario($uID, $mysqli);

					$Resultados[] = array(
							array (
								'text' => CUILFormat($Datos[0]),
							),
							
							array (
								'text' => $Datos[4],
							),
							
							array (
								'text' => $Datos[5],
							),

							array(
								'text' => $nCont,
							),

							array(
								'text' => $Datos[3],
							),

							array(
								'text' => $Datos[1],
							),

							array(
								'text' => $Datos[9],
							),

							array(
								'text' => $Datos[6],
							),

							array(
								'text' => $Datos[7],
							),

							array(
								'text' => $estadoUsuario,
							),
						);
					
				}
			}

			//exportProductDatabase($Resultados);
		} else {
			echo json_encode(array("error" => "¡No se pudo conectar a la base de datos!"));
			exit();
		}

		guardarRegistro($mysqli, $ID, 12);

		echo json_encode(array("success" => $Resultados));
		exit();
	}
?>