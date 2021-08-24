<!DOCTYPE html>
<html>
	<head>
		<title>Cooperativa Agropecuaria-Electrica MC</title>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

		<!-- Librería Notiflix -->
		<link rel="stylesheet" href="./Librerias/notiflix-2.4.0.min.css" />
		<script src="./Librerias/notiflix-2.4.0.min.js"></script>

		<!-- Librería jQuery -->
		<script src="./Librerias/jQuery.js"></script>

		<!-- Librería jQuery - maskedinput -->
		<script src="./Librerias/jquery.maskedinput.js"></script>

		<link rel="shortcut icon" href="./Media/favicon.ico">
		<link rel="icon" href="./Media/favicon.ico">
		
		<link rel="stylesheet" href="./Plugins/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="./CSS/style.css">

		<script src="./Scripts/Recuperar.js"></script>
	</head>

	<body>
		<div class="login-page">
			<p class="aligncenter">
			<img src="./Media/logo.jpg" width="180" height="180" />
			</p>
			<div class="form">
				<h2 style="text-align: center;">Olvidé mi clave</h2>
				
				<p style="padding: 0; font-size: 16px; line-height: 20px; text-align: center;">Si no recuerdas la contraseña de tu cuenta perdiste o la misma, introduce tu CUIL con el que te registraste y a continuación te enviaremos instrucciones para recuperar la misma.</p>

				<div class="input-group mb-0">
					<input id="CUIL" name="Cuil" placeholder="CUIL" autocomplete="off" class="form-control"/>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>

				<button type="submit" onclick="Recupera()">Recuperar</button>
				
				<div class="tab-custom-content"></div>
				
				<p class="mb-1">
					
						<a href="index.php" class="link">Iniciar sesion</a>
					
				</p>

				<p class="mb-1">
					
						<a href="index.php?Enlace=Registro" class="link">Registrarme</a>
					
				</p>
			</div>
		</div>
	</body>
</html>