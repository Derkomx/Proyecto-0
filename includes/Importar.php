<?php
/*
	Archivo: Importar.php
	Autor: Armas, Juan Manuel
	Proposito: Importar archivo de contribuyentes desde Excel
	Fecha: 03/03/2021
	Ultima edición: 03/03/2021
*/

	// Inicia la sesión correspondiente
	ob_start();
	session_start();

	// Incluye los archivos necesarios
	include_once 'MySQL.php';
	include_once 'functions.php';
	include_once 'Registros.php';

	// Ajusta correctamente la zona horaria
	setlocale(LC_CTYPE, 'es');
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	// Obtiene el ID del usuario
	$ID = $_SESSION['id_usuario'];

	// Obtiene los datos requeridos
	$Archivo = $JSONContent['Excel'];
	$Datos = json_decode($Archivo, true);

	$Usuarios = [];

	if ($stmt = $mysqli->prepare("SELECT cuenta FROM contribuyentes")) {
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($Contribuyente);

		while ($stmt->fetch()) {
			$Usuarios[$Contribuyente] = "asd";
		};
	} else {
		echo json_encode(array("error" => "¡No se pudo conectar a la base de datos!"));
		exit();
	}

	foreach ($Datos as $Row) {
		$Cuenta = $Row['Cuenta'];
		$CUIL = $Row['CUIL BASE OK'];

		if (!isset($Usuarios[$Cuenta])) {
			mysqli_query($mysqli, "INSERT INTO contribuyentes (cuenta, cuil) VALUES('$Cuenta', '$CUIL')");
		}
	}

	guardarRegistro($mysqli, $ID, 11);

	echo json_encode(array("success" => 1));
	exit();
?>