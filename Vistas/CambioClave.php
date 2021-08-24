<?php 
$rec = $_GET['rec'];
?>
<html>
   <head>
   		<title>Cooperativa Agropecuaria-Electrica MC</title>
		
		<!-- Librería Notiflix -->
		<link rel="stylesheet" href="../Librerias/notiflix-2.4.0.min.css" />
		<script src="../Librerias/notiflix-2.4.0.min.js"></script>

		<!-- Librería jQuery -->
		<script src="../Librerias/jQuery.js"></script>

		<!-- Librería jQuery - maskedinput -->
		<script src="../Librerias/jquery.maskedinput.js"></script>

		<!-- Librería SHA512 -->
		<script src="../Librerias/sha512.js"></script>

		<link rel="stylesheet" href="../CSS/solid.min.css" />
		<link rel="stylesheet" href="../CSS/style.css">

		<link rel="stylesheet" href="../Plugins/fontawesome-free/css/all.min.css">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	</head>

	<body>

		<div class="login-page">
		<p class="aligncenter">
		<img src="./Media/logo.jpg" width="180" height="180" />
		</p>
		<div class="form">

				<p class="login-box-msg">Ingrese una nueva contraseña</p>
				<div class="input-group mb-0">
				<input id="Clave" name="Clave" type="password" class="form-control" placeholder="Contraseña" autocomplete="off"/>
					<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
					</div>
				</div>
				<div class="input-group mb-0">
				<input id="CClave" name="CClave" class="form-control" type="password" placeholder="Repita Contraseña" autocomplete="off"/>
					<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
					</div>
				</div>

				<button type="submit" onclick="recuperar()">Confirmar</button>
				<p></p>

		</div>
	</body>
		<script>
function recuperar() {
    // Se obtienen los datos ingresados
	var rec = '<?php echo $rec;?>';
	var Clave = document.getElementById("Clave").value;
	var CClave = document.getElementById("CClave").value;

    if (rec.length == 0) {
        Notiflix.Notify.Failure("Vuelva a ingresar");
        return;
	}

	   if (Clave.length == 0) {
        Notiflix.Notify.Failure("Ingrese una contraseña!");
        return;
	}

	   if (CClave.length == 0) {
        Notiflix.Notify.Failure("Vuelva a ingresar su contraseña!");
        return;
	}

	   if (CClave != Clave) {
		Notiflix.Notify.Failure("Vuelva a confirmar contraseña!");
		CClave.value = "";
        return;
	}	
    // Activa la pantalla de carga
    Notiflix.Loading.Circle('Cargando...');
    $.ajax({
        type: 'POST',
        url: '../Inyector.php',
        data: { Archivo: 'recuperar3.php',Clave: hex_sha512(Clave) ,rec: rec},
        dataType: 'html',
        success: function(data) {

            console.log(data);
            //var Resultado = JSON.parse(data);
            Notiflix.Loading.Remove();

            //if (Resultado.error) {
            //  Notiflix.Notify.Failure(Resultado.error);
            //return;
            //}

            //document.location = Resultado.location;
        },
        error: function(data) {
            console.log(data);
        }
    });

}
		</script>

</html>