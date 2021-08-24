<?php
	// Se obtiene la ID del usuario
	$uID = $_GET['uID'];

	// Se obtiene el estado del usuario actual
	$Estado = obtenerEstadoUsuario($uID, $mysqli);
	$Datos = obtenerDatosUsuario($uID, $mysqli);
	
	$strFecha = strtotime($Datos[3]);
	$Registro = date('d/m/2020 - H:i:s', $strFecha);
	
	$Sexos = [
		'Masculino',
		'Femenino',
		'Otro'
	]
?>

<script>
	var uID = <?php echo $uID; ?>;
	var Usuario = <?php echo "'" . $Datos[4] . ', ' . $Datos[5] . "'"; ?>;
</script>
<script src="Scripts/Usuarios.js"></script>

<!-- Cabezera de contenido -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
					<li class="breadcrumb-item"><a href="#">Usuarios</a></li>
					<li class="breadcrumb-item active">Ver usuario #<?php echo $uID; ?></li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">

	<?php if (!isset($Estado)) { ?>
		<div class="col-md-7 mx-auto">
			<div class="alert alert-warning text-center" role="alert">
				<i class="fas fa-info-circle"></i>
				Usuario inválido.
			</div>
		</div>

	<?php } elseif ($Estado == "No activo") { ?>
		<div class="col-md-7 mx-auto">
			<div class="alert alert-warning text-center" role="alert">
				<i class="fas fa-info-circle"></i>
				Este usuario se encuentra actualmente no activo.
			</div>
		</div>

		<div class="col-md-6 mx-auto">
			<div class="card card-info">
				<div class="card-body">
					<h5 class="card-subtitle mb-3 text-muted text-center">Información de usuario #<?php echo $uID; ?></h5>
					<p class="text-center">
						CUIL: <?php echo CUILFormat($Datos[0]); ?></br>
						Registrado el: <?php echo $Registro; ?></br>
						Correo electrónico: <?php echo $Datos[1]; ?>
					</p>
					
					<h5 class="card-subtitle mt-2 mb-3 text-muted text-center">Opciones</h5>

					<div class="col-md-8 mx-auto text-center">
						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-info btn-sm btn-block" onclick="ActivarUsuario()">Activar usuario</button>
						</div>

						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-info btn-sm btn-block" onclick="CambiarCorreo()">Cambiar correo electrónico</button>
						</div>
						
						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-info btn-sm btn-block" onclick="ReenviarCodigo()">Reenviar código de activación</button>
						</div>
						
						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-info btn-sm btn-block" onclick="ObtenerCodigo()">Obtener código de activación</button>
						</div>

						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-danger btn-sm btn-block" onclick="EliminarUsuario()">Eliminar usuario</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } elseif ($Estado == "No verificado") { ?>
		<!-- Modal -->
		<div class="modal fade" id="CompletarDatos" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Completar datos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="well form-horizontal justify-content-center" id="contact_form">
							<label style="width: 100%; text-align: center; color: #000000; padding-top: 20px; font-weight: normal;">Ingresa los datos para el usuario <b>#<?php echo $uID; ?></b>. </br>Los mismos no necesitarán verificación y el usuario quedará automaticamente verificado.<p></p></label>

							<!-- Nombre -->
							<div align="center" class="form-group">
								<label class="col-md-5 control-label">Nombre(s)</label>

								<div class="col-md-10 inputGroupContainer">
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
								<div class="col-md-10 inputGroupContainer">
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
								<div class="col-md-10 inputGroupContainer">
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
								<div class="col-md-10 inputGroupContainer">
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
								<div class="col-md-10 inputGroupContainer">
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
								<div class="col-md-10 inputGroupContainer">
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

							<!-- Foto de FacturaI -->
							<div align="center" class="form-group">
								<label class="col-md-5 control-label">Foto: Factura del servicio</label>
								<div class="col-md-10 inputGroupContainer">
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

							<img id="img-frente" style="display: none;" alt="" />
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-7 mx-auto">
			<div class="alert alert-warning text-center" role="alert">
				<i class="fas fa-info-circle"></i>
				Este usuario se encuentra actualmente no verificado.
			</div>
		</div>

		<div class="col-md-6 mx-auto">
			<div class="card card-info">
				<div class="card-body">
					<h5 class="card-subtitle mb-3 text-muted text-center">Información de usuario #<?php echo $uID; ?></h5>
					<p class="text-center">
						CUIL: <?php echo CUILFormat($Datos[0]); ?></br>
						Registrado el: <?php echo $Registro; ?></br>
						Correo electrónico: <?php echo $Datos[1]; ?>
					</p>
					
					<h5 class="card-subtitle mt-2 mb-3 text-muted text-center">Opciones</h5>

					<div class="col-md-8 mx-auto text-center">
						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#CompletarDatos">Cargar datos del usuario</button>
						</div>
						
						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-info btn-sm btn-block" onclick="CambiarCorreo()">Cambiar correo electrónico</button>
						</div>

						<div class="wrapper mt-1">
							<button type="submit" class="btn btn-danger btn-sm btn-block" onclick="EliminarUsuario()">Eliminar usuario</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } elseif ($Estado == "Pendiente" || $Estado == "Verificado" || $Estado == "Denegado") { ?>
		<link rel="stylesheet" href="Librerias/easyzoom.css" />

		<div class="col-md-7 mx-auto">
			<div class="alert alert-warning text-center" role="alert">
				<i class="fas fa-info-circle"></i>
				<?php 
					if ($Estado == "Pendiente") {
						echo "Este usuario se encuentra actualmente pendiente a verificación.";
					} elseif ($Estado == "Verificado") {
						echo "Este usuario se encuentra verificado y activo.";
					} elseif ($Estado == "Denegado") {
						echo "Este usuario se encuentra actualmente denegado.";
					}
				?>
			</div>
		</div>

		<?php
			if ($Estado == "Verificado" || $Estado == "Denegado") { 
				$admDatos = obtenerDatosUsuario($Datos[11], $mysqli); ?>

				<div class="col-md-7 mx-auto">
					<div class="alert alert-info text-center" role="alert">
						<i class="fas fa-info-circle"></i>
						<?php 
							if ($Estado == "Verificado") {
								echo 'Este usuario fue verificado por <a style="color: #0090FF;" href="?Seccion=VerUsuario&uID=' . $Datos[11] . '">' . $admDatos[4] . ', ' . $admDatos[5] . '</a>.';
							} elseif ($Estado == "Denegado") {
								echo 'Este usuario fue denegado por <a style="color: #0090FF;" href="?Seccion=VerUsuario&uID=' . $Datos[11] . '">' . $admDatos[4] . ', ' . $admDatos[5] . '</a>.';
							}
						?>
					</div>
				</div>
			<?php }
		?>

		<div class="container mx-auto">
			<div class="row mx-auto justify-content-md-center align-items-center">
				<div class="col-md-6 mx-auto">
					<div class="card card-info">
						<div class="card-body">
							<div class="easyzoom easyzoom--overlay">
								<a href="Imagenes/<?php echo $uID; ?>frente.jpeg">
									<img style="display: block; max-width: 100%; height: auto;" src="Imagenes/<?php echo $uID; ?>frente.jpeg" alt="" />
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 h-100 mx-auto">
					<div class="card card-info">
						<div class="card-body">
							<h5 class="card-subtitle mb-2 text-muted text-center">Datos del Titular</h5>

							<p class="text-center mb-0">
								<b>DNI:</b> <?php echo fromCUILtoDNI($Datos[0]); ?></br>
								<b>Nombre(s):</b> <?php echo $Datos[5]; ?></br>
								<b>Apellido(s):</b> <?php echo $Datos[4]; ?></br>
							</p>
						</div>
						
						<div class="card-footer text-muted text-center">
							<div class="col-md-4 mx-auto">
								<button type="submit" class="btn btn-info btn-sm btn-block disabled" aria-disabled="true">Editar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="container mx-auto mt-3">
				<div class="row mx-auto justify-content-md-center align-items-center">

				<div class="col-md-6 h-100 mx-auto">
					<div class="card card-info">
						<div class="card-body">
							<h5 class="card-subtitle mb-3 text-muted text-center">Datos del Complementarios</h5>
							<p class="text-center mb-0">
								<b>Domicilio:</b> <?php echo $Datos[6]; ?></br>
								<b>Localidad:</b> <?php echo $Datos[7]; ?></br>
								<b>Código postal:</b> <?php echo $Datos[8]; ?></br>
								<b>CUIL:</b> <?php echo CUILFormat($Datos[0]); ?>
							</p>
						</div>
						
						<div class="card-footer text-muted text-center">
							<div class="col-md-4 mx-auto">
								<button type="submit" class="btn btn-info btn-sm btn-block disabled" aria-disabled="true">Editar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container mx-auto mt-4">
			<div class="row mx-auto justify-content-md-center align-items-center">
				<div class="col-md-6 h-100 mx-auto">
					<div class="card card-info">
						<div class="card-body">
							<h5 class="card-subtitle mb-3 text-muted text-center">Opciones</h5>

							<div class="col-md-8 mx-auto text-center">
								<div class="wrapper mt-1">
									<button type="submit" class="btn btn-info btn-sm btn-block" onclick="CambiarCorreo()">Cambiar correo electrónico</button>
								</div>

								<div class="wrapper mt-1 mb-1">
									<button type="submit" class="btn btn-danger btn-sm btn-block" onclick="EliminarUsuario()">Eliminar usuario</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 h-100 mx-auto">
					<div class="card card-info">
						<div class="card-body">
							<h5 class="card-subtitle mb-3 text-muted text-center">Otros datos</h5>
							<p class="text-center">
								<b>Correo electrónico:</b> <?php echo $Datos[1]; ?></br>
								<b>Teléfono:</b> <?php echo $Datos[9]; ?></br>
								<b>Registrado el:</b> <?php echo $Datos[3]; ?>
							</p>

							<?php
								if ($Estado == "Pendiente") { ?>
									<div class="wrapper mt-1 text-center">
										<button type="submit" class="btn btn-success mt-1" onclick="AceptarUsuario()">Aceptar usuario</button>
										<button type="submit" class="btn btn-danger mt-1" onclick="DenegarUsuario()">Denegar usuario</button>
									</div>
								<?php }
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php if ($_SESSION['nivel'] == 9 && $Estado == "Verificado") { ?>
			<div class="container mx-auto mt-4">
				<div class="row mx-auto justify-content-md-center align-items-center">
					<div class="col-md-8 h-100 mx-auto">
						<div class="card card-info">
							<div class="card-body">
								<h5 class="card-subtitle mb-3 text-muted text-center">Nivel de usuario</h5>

								<p class="text-center">
									<b>Nivel actual:</b> <?php echo $Datos[10] . ' (' . obtenerDescripcionNivel($Datos[10], $mysqli) . ')'; ?></br>
								</p>

								<h5 class="card-subtitle mb-3 text-muted text-center">Cambiar nivel</h5>

								<div class="col-md-6 h-100 mx-auto text-center">
									<select id="sltNivel" class="form-select form-select-lg mb-2" aria-label=".form-select-lg example" style="width:100%;">
										<option value="0" selected>Selecciona un nivel</option>
										<?php
											$Niveles = obtenerNiveles($mysqli);

											foreach($Niveles as $Nivel) {
												if ($Nivel[0] != $Datos[10]) {
													echo '<option value="' . $Nivel[0] . '">' . $Nivel[1] . '</option>';
												}
											}
										?>
									</select>

									<button type="submit" class="btn btn-info" onclick="CambiarNivel()">Cambiar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<script src="Librerias/easyzoom.js"></script>

		<script>
			var defaults = {
				loadingNotice: 'Cargando imagen, espere...',
				errorNotice: 'No se pudo cargar la imagen.'
			};

			var $easyzoom = $('.easyzoom').easyZoom(defaults);
		</script>
	<?php } ?>
</section>