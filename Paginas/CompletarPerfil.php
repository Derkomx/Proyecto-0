<?php
	ob_start();
?>

<?php
	isLogged();


	if ($stmt = $mysqli->prepare("SELECT datos_enviados, verificado2, denegado FROM usuarios WHERE id_usuario = ? ")) {
        $stmt->bind_param('i', $ID);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($Enviado, $Verificado, $Denegado);
        $stmt->fetch();
	}

	//$permitido = verificado($_SESSION['id_usuario'],$mysqli);
?>

<?php
	setlocale(LC_CTYPE, 'es');
	date_default_timezone_set('America/Argentina/Buenos_Aires');
?>

<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cooperativa Agropecuaria-Electrica MC</title>
	<link rel="shortcut icon" href="Media/icono.ico" type="image/x-icon">
	<link rel="icon" href="Media/icono.ico" type="image/x-icon">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="Plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="Plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="Plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="Plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="Plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="Plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="Plugins/summernote/summernote-bs4.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
	
	<!-- Librería jQuery -->
	<script src="Librerias/jQuery.js"></script>

	<!-- Librería jQuery - maskedinput -->
	<script src="Librerias/jquery.maskedinput.js"></script>

	<!-- Librería Notiflix -->
	<link rel="stylesheet" href="Librerias/Notiflix/notiflix-2.6.0.min.css" />
	<script src="Librerias/Notiflix/notiflix-2.6.0.min.js"></script>
	
	<!-- Librería SHA512 -->
	<script src="Librerias/sha512.js"></script>

	<!-- Librería CropperJS -->
	<link  href="Librerias/CropperJS/cropper.css" rel="stylesheet">
	<script src="Librerias/CropperJS/cropper.js"></script>

	<!-- Librería PSWmeter -->
	<script src="Librerias/pswmeter.min.js"></script>
	
	<!-- Bootstrap -->
	<link href="Librerias/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	</head>

	<body class="hold-transition sidebar-mini layout-fixed">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Cooperativa Agropecuaria-Electrica MC</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-light-success elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<img src="Media/logo.jpg" alt="Cooperativa Agropecuaria-Electrica MC" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">User Ver. 1.0.0</span>		   
			</a>

			<div class="sidebar">
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="includes/Logout.php" class="nav-link">
								<i class="nav-icon fas fa-sign-out-alt"></i>
								<p>Cerrar sesión</p>
							</a>
						</li>		  
					</ul>
				</nav>
			</div>
		</aside>
		

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-1">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark"> </h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->


			<!-- Main content -->
			<section class="content">
				<?php if ($Enviado == 0 && $Verificado == 0){ 
					
					if ($Denegado > 0) { 
						if ($Denegado >= 3) { ?>
							<div class="container py-6">
								<div class="row">
									<div class="mx-auto col-sm-5">
										<!-- form user info -->
										<div class="card">
											<div class="card-header bg-danger">
												<h6 class="mb-0 text-center">Bloqueado</h6>
											</div>

											<div class="card-body">
												<h6 class="text-center">Sus datos han comprobados y rechazados 3 veces consecutivas.</h6>
												<br>
												<h6 class="text-center">Tu cuenta se encuentra ahora bloqueada por esta razón.</h6>
												<br>
												<h6 class="text-center">Para mas información o la solución de este problema, deberás ponerte en contacto con soporte.</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php exit(); } ?>
							<h6 class="mb-2 text-center">Tus datos han sido comprobados y la verificación fue denegada, comprueba tus datos y envíalos nuevamente.</h6>

							<div class="row">
								<div class="col"><hr></div>
							</div>
						<?php } ?>
					
					<div class="container-fluid w-10 mx-auto border">
						<div class="container">
							<div class="well form-horizontal justify-content-center" id="contact_form">

								<h1 class="m-0 text-dark text-center">Atención</h1>
								<label style="width: 100%; text-align: center; color: #000000; padding-top: 20px; font-weight: normal;">¡Aún no has completado tu perfil! Para hacer esto, por favor completa todos los datos a continuación y serán verificados por un administrador.<p></p></label>

								<p></p>
								<p></p>

								<!-- Nombre -->
								<div align="center" class="form-group">
									<label class="col-md-5 control-label">Nombre(s)</label>
									<div class="col-md-5 inputGroupContainer">
										<div class="input-group">
											<input id="first_name" placeholder="Nombre(s)" class="form-control"  type="text"/>
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-user"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Apellido -->
								<div align="center" class="form-group">
									<label class="col-md-5 control-label">Apellido(s)</label>
									<div class="col-md-5 inputGroupContainer">
										<div class="input-group">
											<input id="last_name" placeholder="Apellido(s)" class="form-control"  type="text"/>
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-user"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Número de teléfono / celular -->
								<div align="center" class="form-group">
									<label class="col-md-5 control-label">Teléfono / Celular</label>
									<div class="col-md-5 inputGroupContainer">
										<div class="input-group">
											<input id="phone" placeholder="(11) 123456" class="form-control" type="text">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fa fa-phone"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Domicilio -->
								<div align="center" class="form-group">
									<label class="col-md-5 control-label">Domicilio</label>
									<div class="col-md-5 inputGroupContainer">
										<div class="input-group">
											<input id="address" placeholder="Domicilio" class="form-control" type="text">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fa fa-home"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Ciudad -->
								<div align="center" class="form-group">
									<label class="col-md-5 control-label">Ciudad</label>
									<div class="col-md-5 inputGroupContainer">
										<div class="input-group">
											<input id="ciudad" placeholder="Ciudad" class="form-control"  type="text">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fa fa-home"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Código postal -->
								<div align="center" class="form-group">
									<label class="col-md-5 control-label">Código postal</label>
									<div class="col-md-5 inputGroupContainer">
										<div class="input-group">
											<input id="postal" placeholder="Código postal" class="form-control"  type="text">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fa fa-home"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Foto facutra -->
								<div align="center" class="form-group">
									<label class="col-md-5 control-label">Foto: Factura emitida por C.A.E.M.C</label>
									<div class="col-md-5 inputGroupContainer">
										<div class="input-group">
											<input id="input-frente" style="padding: 0px; padding-top: 3px; padding-left: 4px;" class="form-control"  type="file" accept="image/png, image/jpeg">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fa fa-camera"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<label style="width: 100%; text-align: center; color: #000000; padding-top: 0px; padding-bottom: 10px; font-weight: normal;">Intente que las fotos sean lo más nítidas y legíbles posible.</label>

								<img id="img-frente" style="display: none;" alt="" />
								

								<!-- Button -->
								<div align="center" class="form-group">
									<label class="col-md-5"></label>
									<div class="col-md-5">
										<button id="but_upload" onclick="AceptarDatos()" class="btn btn-warning" style="text-align:center;" >Enviar <span class="glyphicon glyphicon-send"></span></button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.container -->
			<?php } elseif ($Enviado == 1 && $Verificado == 0){ ?>
				<div class="container py-6">
					<div class="row">
						<div class="mx-auto col-sm-5">
							<!-- form user info -->
							<div class="card">
								<div class="card-header bg-success">
									<h6 class="mb-0 text-center">Verificación de datos</h6>
								</div>

								<div class="card-body">
									<h6 class="text-center">Sus datos han sido enviados correctamente.</h6>
									<br>
									<h6 class="text-center">Serán verificados por la administración en un lapso de hasta 72 horas máximo, una vez que ocurra esto, enviaremos un correo electrónico a tu dirección, con los resultados.</h6>
									<br>
									<h6 class="text-center">Muchas gracias.</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			</section>
		<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			Copyright &copy; 2020 <a href="">Cooperativa Agropecuaria y Electrica Monte Caseros</a>.
			<div class="float-right d-none d-sm-inline-block">
				<b>C.A.E.M.C Ver.</b> 1.0.0
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
	</body>
	
	<!-- jQuery -->
	<script src="Plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="Plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="Plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="Plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="Plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="Plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="Plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="Plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="Plugins/moment/moment.min.js"></script>
	<script src="Plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="Plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="Plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="Plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="dist/js/pages/dashboard.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<script src="Scripts/CompletarPerfil.js"></script>
</html>