
<html>
	<head>
		<title>Cooperativa Agropecuaria-Electrica MC</title>
        <link rel="stylesheet" href="./CSS/solid.min.css" />
		<link rel="stylesheet" href="./CSS/style.css">

		<!-- Librería Notiflix -->
		<link rel="stylesheet" href="./Librerias/notiflix-2.4.0.min.css" />
		<script src="./Librerias/notiflix-2.4.0.min.js"></script>

		<!-- Librería jQuery -->
		<script src="./Librerias/jQuery.js"></script>

		<!-- Librería jQuery - maskedinput -->
		<script src="./Librerias/jquery.maskedinput.js"></script>

		<!-- Librería SHA512 -->
		<script src="./Librerias/sha512.js"></script>

		<!-- Librería PSWmeter -->
		<script src="./Librerias/pswmeter.min.js"></script>

		<link rel="stylesheet" href="./Plugins/fontawesome-free/css/all.min.css">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	</head>
    <body>
		<div class="login-page">
			<!-- Imagen superior -->
			<p class="aligncenter">
				<img src="./Media/logo.jpg" width="180" height="180" />
			</p>

			<div class="form">
				<h2 aligncenter>Registrarme</h2>

				<div class="input-group mb-0">
					<input id="CUIL" name="Cuil" type="text" placeholder="CUIL" autocomplete="off" class="form-control"/>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>

				<div class="input-group mb-0">
					<input id="Correo" name="Correo" type="email" placeholder="Correo electrónico" autocomplete="off" class="form-control"/>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>

				<div class="input-group mb-0">
					<input id="CCorreo" name="CCorreo" type="email" placeholder="Confirmar correo electrónico" autocomplete="off" class="form-control"/>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>

				<div class="input-group mb-0">
					<input id="Clave" name="Clave" type="password" placeholder="Contraseña" autocomplete="off" class="form-control"/>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
                <!-- Información de seguridad de clave -->
				<div style="display: none;" id="pswmeter" class="mt-3"></div>
				<div style="display: none; padding-top: 8px; padding-bottom: 6px; text-align: center;" id="pswmeter-message" class="mt-3"></div>

				<div class="input-group mb-0">
					<input id="CClave" name="CClave" type="password" placeholder="Confirmar contraseña" autocomplete="off" class="form-control"/>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div> 

				<label class="new-checks">Acepto los
					<a class="link" onclick="Terminos()">Terminos y Condiciones</a></p>
				
					<div>
						<input type="checkbox" id="checkterm">
						<span class="checkmark"></span>
					</div>
				</label>
                <button type="submit" onclick="Registro()">Registrarme</button>
                <p></p>
                <div class="tab-custom-content"></div>
				<p class="mb-1">
						<a href="index.php?Enlace=Recuperar" class="link">Olvidé mi clave</a>
				</p>
				
				<p class="mb-0">
                <a href="index.php" class="link">Iniciar sesion</a>
                </p>
			</div>
		</div>

		<script src="./Scripts/Registro.js"></script>
	</body>
</html>