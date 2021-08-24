<?php
/*
	Archivo: Secciones.php
	Autor: Armas, Juan Manuel
	Proposito: Funcionamiento de las secciones aparte del menú
	Fecha: 07/01/2021
	Ultima edición: 08/01/2021
*/

	// Array limpio
	$Secciones = [];

	// Secciones de nivel 3 (Usuario)
	$Secciones[3] = [
		"VerReclamo" => "Reclamos/verReclamo.php",
		"EditarPublicacion" => "Prensa/EditarPublicacion.php",
		"VerPublicacion" => "Prensa/verPublicacion.php",
	];

	// Secciones de nivel 4 (Prensa)
	$Secciones[4] = [
		"EditarPublicacion" => "Prensa/EditarPublicacion.php",
		"VerReclamo" => "Reclamos/verReclamo.php",
		"VerPublicacion" => "Prensa/verPublicacion.php",
	];

	// Secciones de nivel 5 (Soporte)
	$Secciones[5] = [
		"VerReclamo" => "Reclamos/verReclamoAdm.php",
		"VerPublicacion" => "Prensa/verPublicacion.php",
		"VerReclamoint" => "Reclamos int/verReclamoAdm.php",
	];

	$Secciones[6] = [
		"VerReclamo" => "Reclamos/verReclamoAdm.php",
		"VerPublicacion" => "Prensa/verPublicacion.php",
		"VerReclamoint" => "Reclamos int/verReclamoAdm.php",
	];
	
	// Secciones de nivel 9 (Root)
	$Secciones[9] = [
		"EditarPublicacion" => "Prensa/EditarPublicacion.php",
		"VerReclamo" => "Reclamos/verReclamoAdm.php",
		"VerUsuario" => "Usuarios/verUsuario.php",
		"VerPublicacion" => "Prensa/verPublicacion.php",
		"VerReclamoint" => "Reclamos int/verReclamoAdm.php",
	];
?>