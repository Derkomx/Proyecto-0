<?php
	// Comienza la sesión
	session_start();

	// Incluye los archivos necesarios
	include_once 'MySQL.php';
	include_once 'functions.php';
	include_once 'Configuracion.php';

	// Se obtienen todos los datos ingresados por el usuario
	$ID = $_SESSION['id_usuario'];
	$Apellido = $_POST["Apellido"];
	$Nombre = $_POST["Nombre"];
	$Domicilio = $_POST["Domicilio"];
	$Telefono = $_POST['Telefono'];
	$Ciudad = $_POST["Ciudad"];
	$Postal = $_POST["Postal"];
	$Apellido = strtoupper($Apellido);
	$Nombre = strtoupper($Nombre);
	$Domicilio = strtoupper($Domicilio);
	$Ciudad = strtoupper($Ciudad);

	if (file_exists("Imagenes/".$ID."frente.jpeg")) {
		unlink("Imagenes/".$ID."frente.jpeg");
	}


	//Generar Consulta para saber si el usuario tiene o no datos cargados
	$Res=mysqli_query($mysqli, "SELECT * FROM datos_personales WHERE id_usuario='$ID'");
		// si el usuario no tiene datos en la tabla se lo agrega, sino solo se actualizan
        if(mysqli_num_rows($Res)==0){
			mysqli_query($mysqli,"INSERT INTO datos_personales (id_usuario, apellido, nombres, direccion, localidad, zip, telefono) VALUES ('$ID', '$Apellido', '$Nombre', '$Domicilio', '$Ciudad', '$Postal', '$Telefono')");
			//////////////////imagen////////////////////////////////////////
			$Frente= $ID."frente";
			if (isset($_POST['Frente'])) {
				$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['Frente']));
				$filepath = "Imagenes/".$Frente.".jpeg"; // or image.jpg
				 file_put_contents($filepath, $data);
						mysqli_query($mysqli,"INSERT INTO documentacion (id_usuario, frente, ftipo) VALUES ('$ID', '$Frente', 'jpeg')");
						mysqli_query($mysqli, "UPDATE usuarios SET datos_enviados = 1 WHERE id_usuario = '$ID'");
						// Si por alguna razón no se procesa el ingreso, se da aviso
						echo json_encode(array("success" => true ));
						exit();
					}else {
						// Si por alguna razón no se procesa el ingreso, se da aviso
						echo json_encode(array("error" => "¡Ocurrió un error inesperado!"));
					 }

			//////////////////////////////////////////////////////////////////////////////////
        } else{
            $res2=mysqli_query($mysqli, "UPDATE datos_personales SET  apellido= '$Apellido', nombres= '$Nombre', direccion= '$Domicilio', localidad= '$Ciudad', zip='$Postal', telefono='$Telefono', bloqueado='0' WHERE id_usuario = '$ID'");
           //////////////////imagen////////////////////////////////////////
			$Frente= $ID."frente";
			if (isset($_POST['Frente'])) {
				$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['Frente']));
				$filepath = "Imagenes/".$Frente.".jpeg"; // or image.jpg
				 file_put_contents($filepath, $data);
						mysqli_query($mysqli,"UPDATE documentacion SET frente = '$Frente', ftipo = 'jpeg' WHERE id_usuario = '$ID'");
						mysqli_query($mysqli, "UPDATE usuarios SET datos_enviados = 1 WHERE id_usuario = '$ID'");
						// Si por alguna razón no se procesa el ingreso, se da aviso
						echo json_encode(array("success" => true ));
						exit();
					}else {
			
			   // Si por alguna razón no se procesa el ingreso, se da aviso
			   echo json_encode(array("error" => "¡Ocurrió un error inesperado!"));
			}
			//////////////////////////////////////////////////////////////////////////////////
            
		}

?>