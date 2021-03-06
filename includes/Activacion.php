<?php
/*
	Archivo: Activacion.php
	Autor: Armas, Juan Manuel
	Proposito: Activación de cuentas mediante correo electrónico
	Fecha: 3/10/2020
	Ultima edición: 28/11/2020
*/

	// Incluye la base de datos
	include 'MySQL.php';

	// Chequea que exista el Token de activación
	if (!isset($_POST['Token'])) {
		// Si por alguna razón no se encuentra el token, se da aviso y se termina la función
		echo json_encode(array("error" => "Por alguna razón, no se detectó el código de activación, ¡vuelve a intentar!"));
		exit();
	}

	// Obtiene los datos necesarios
	$Token = $_POST['Token'];

	
	$Resultados = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE activacion='$Token' AND activo = '0'");


	if (mysqli_num_rows($Resultados) == 0) {
		echo json_encode(array("error" => "$Resultados"));
		exit();
	} else {
		mysqli_query($mysqli, "UPDATE usuarios SET activo='1', activacion=NULL WHERE activacion='$Token'");
		echo json_encode(array("success" => true));
	}
?>