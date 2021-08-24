<html>
   <head>
		<title>Cooperativa Agropecuaria-Electrica MC</title>

		<link rel="shortcut icon" href="./Media/favicon.ico">
		<link rel="icon" href="./Media/favicon.ico">
		
		<!-- Librería Notiflix -->
		<link rel="stylesheet" href="./Librerias/notiflix-2.4.0.min.css" />
		<script src="./Librerias/notiflix-2.4.0.min.js"></script>

		<!-- Librería jQuery -->
		<script src="./Librerias/jQuery.js"></script>

		<!-- Librería jQuery - maskedinput -->
		<script src="./Librerias/jquery.maskedinput.js"></script>

		<!-- Librería SHA512 -->
		<script src="./Librerias/sha512.js"></script>

		<link rel="stylesheet" href="./CSS/solid.min.css" />
		<link rel="stylesheet" href="./CSS/style.css">

		<link rel="stylesheet" href="./Plugins/fontawesome-free/css/all.min.css">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	</head>

	<body>
		<div class="login-page">
		<p class="aligncenter">
		<img src="./Media/logo.jpg" width="180" height="180" />
		</p>
		<div class="form">

				<p class="login-box-msg">Ingrese su CUIL y Clave</p>
				<div class="input-group mb-0">
				<input id="CUIL" name="User" type="text" class="form-control" placeholder="CUIL" autocomplete="off" onkeypress="return enterKeyPressed(event)"/>
					<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
					</div>
				</div>
				<div class="input-group mb-0">
				<input id="Clave" name="Pass" class="form-control" type="password" placeholder="Contraseña" autocomplete="off" onkeypress="return enterKeyPressed(event)"/>
					<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
					</div>
				</div>
				
				<label class="new-checks">Recordar CUIL
					<div>
						<input type="checkbox" id="Recordar">
						<span class="checkmark"></span>
					</div>
				</label>
				<button type="submit" onclick="InicioSesion()">Iniciar sesión</button>
				<p></p>
				<div class="tab-custom-content"></div>
				<p class="mb-1">
						<a href="index.php?Enlace=Recuperar" class="link">Olvidé mi clave</a>
				</p>
				
				<p class="mb-0">
				<a href="index.php?Enlace=Registro" class="link">Registrarme</a>
				</p>
				</div>
		</div>
	</body>
	<script src="./Scripts/Ingreso.js"></script>
	</html>
