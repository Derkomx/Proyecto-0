<?php
/*
	Archivo: Publicaciones.php
	Autor: Armas, Juan Manuel
	Proposito: Controlador para crear, editar y eliminar publicaciones desde prensa
	Fecha: 12/02/2021
	Ultima edición: 19/02/2021
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
	$uID = $_SESSION['id_usuario'];

	if (isset($_POST['Tipo'])) {
		if ($_POST['Tipo'] == 'Eliminar') {
			$Publicacion = $_POST['Publicacion'];

			// Se eliminan los datos
			mysqli_query($mysqli, "DELETE FROM blog WHERE id = $Publicacion");

			// Se chequea si ya existe la publicación archivada
			if (file_exists("Publicaciones/HTML/".$Publicacion.".html")) {
				// En ese caso, se borra el archivo de la publicación
				unlink("Publicaciones/HTML/".$Publicacion.".html");
			}
			
			// Se chequea si ya existe la imagen de la publicación archivada
			if (file_exists("Publicaciones/Preview/".$Publicacion.".jpeg")) {
				// En ese caso, se borra el archivo de la publicación
				unlink("Publicaciones/Preview/".$Publicacion.".jpeg");
			}

			echo json_encode(array("success" => 1));
		}

		exit();
	}

	// Obtiene los datos requeridos
	$Titulo = $JSONContent['Titulo'];
	$Imagen = $JSONContent['Imagen'];
	$Cuerpo = $JSONContent['Cuerpo'];
	$Fecha = $JSONContent['Fecha'];
	$Tipo = $JSONContent['Tipo'];
	
	if ($Fecha == 0) {
		$Fecha = $datetime = date_create()->format('Y-m-d H:i:s');
	} else {
		$Fecha = date ('Y-m-d H:i:s', strtotime($Fecha));
	}

	if ($Tipo == 'Publicar') {
		if ($stmt = $mysqli->prepare("INSERT INTO blog (usuario, titulo, fecha) VALUES ( ?, ?, ?)")) {
			$stmt->bind_param('iss', $uID, $Titulo, $Fecha);
			$stmt->execute();
			$stmt->store_result();

			$stmt->fetch();

			// Obtiene la nueva ID insertada
			$newID = $stmt->insert_id;

			// Chequea si existe la carpeta donde guardar las publicaciones
			if (!is_dir('Publicaciones/HTML')) {
				// Si no existe, crea la carpeta
				mkdir('Publicaciones/HTML', 0777, true);
			}
			
			// Chequea si existe la carpeta donde guardar las imagenes de las publicaciones
			if (!is_dir('Publicaciones/Preview')) {
				// Si no existe, crea la carpeta
				mkdir('Publicaciones/Preview', 0777, true);
			}

			// Se chequea si por alguna razón ya existe la publicación archivada
			if (file_exists("Publicaciones/HTML/".$newID.".html")) {
				// En ese caso, se borra el archivo de la publicación
				unlink("Publicaciones/HTML/".$newID.".html");
			}
			
			// Se chequea si por alguna razón ya existe la imagen de la publicación archivada
			if (file_exists("Publicaciones/Preview/".$newID.".jpeg")) {
				// En ese caso, se borra el archivo de la publicación
				unlink("Publicaciones/Preview/".$newID.".jpeg");
			}

			// Se crea el archivo con la publicación correspondiente
			$HTML_Path = "Publicaciones/HTML/".$newID.".html";
			file_put_contents($HTML_Path, $Cuerpo);

			// Se crea la imagen de presentación de la imagen
			$Image_Decode = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $Imagen));
			$Image_Path = "Publicaciones/Preview/".$newID.".jpeg";
			file_put_contents($Image_Path, $Image_Decode);

			echo json_encode(array("success" => 1));
		} else {
			// Si da error en la base de datos, se da aviso.
			echo json_encode(array("error" => "¡Ocurrió un error interno 1!"));
			exit();
		}
	} elseif ($Tipo == 'Editar') {
		$Publicacion = $JSONContent['Publicacion'];

		if ($stmt = $mysqli->prepare("UPDATE blog SET titulo = ?, fecha = ? WHERE id = ?")) {
			$stmt->bind_param('ssi', $Titulo, $Fecha, $Publicacion);
			$stmt->execute();
			$stmt->store_result();

			$stmt->fetch();

			// Se chequea si ya existe la publicación archivada
			if (file_exists("Publicaciones/HTML/".$Publicacion.".html")) {
				// En ese caso, se borra el archivo de la publicación
				unlink("Publicaciones/HTML/".$Publicacion.".html");
			}
			
			// Se chequea si ya existe la imagen de la publicación archivada
			if (file_exists("Publicaciones/Preview/".$Publicacion.".jpeg")) {
				// En ese caso, se borra el archivo de la publicación
				unlink("Publicaciones/Preview/".$Publicacion.".jpeg");
			}

			// Se crea el archivo con la publicación correspondiente
			$HTML_Path = "Publicaciones/HTML/".$Publicacion.".html";
			file_put_contents($HTML_Path, $Cuerpo);

			// Se crea la imagen de presentación de la imagen
			$Image_Decode = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $Imagen));
			$Image_Path = "Publicaciones/Preview/".$Publicacion.".jpeg";
			file_put_contents($Image_Path, $Image_Decode);

			echo json_encode(array("success" => 1));
		} else {
			// Si da error en la base de datos, se da aviso.
			echo json_encode(array("error" => "¡Ocurrió un error interno 2!"));
			exit();
		}
	}
?>