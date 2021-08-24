<!-- Cabezera de contenido -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
					<li class="breadcrumb-item active">Perfil</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<!-- Contenido principal -->
<section class="content ">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 mx-auto mt-3">
				<div class="register-logo">
					<?php
						if (file_exists("Perfil/".$ID.".jpeg")) {
							echo '<img src="Perfil/'.$ID.'.jpeg?='.filemtime("Perfil/".$ID.".jpeg").'" class="rounded-circle" height="180" width="180">';
						} else {
							echo '<img src="Media/Perfil.png" height="180" width="180">';
						}
					?>
				</div>

				<div class="col-md-12 text-center">
					<button class="btn btn-secondary text-center" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-cog"></i> Cambiar imagen</button>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Cambiar imágen de perfil</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<input type="file" id="myFile" name="filename" accept="image/x-png,image/gif,image/jpeg" />

								<div class="text-center mt-2">
									<p id="status"></p>
									<img style="display: block; max-width: 100%; height: auto;" id="imgPerfil" class="rounded" />
								</div>
							</div>

							<div class="modal-footer">
								<button id="Guardar" type="button" class="btn btn-primary">Guardar</button>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 text-center mt-4">
					<label><b>Datos personales</b></label>
				</div>

				<?php $Datos = obtenerDatosPerfil($mysqli); ?>
								
				<div class="col-md-12 text-center">
					<?php echo $Datos[3] . ', ' . $Datos[4] . '<br>'; ?>
					<?php echo CUILFormat($Datos[0]) .'<br>'; ?>
					<?php echo $Datos[1] .'<br>'; ?>
					<?php $phpdate = strtotime($Datos[2]); ?>
					<?php $mysqldate = date( 'd/m/2020 - H:i:s', $phpdate ); ?>
					<?php echo "Registrado el " .$mysqldate. " hs."; ?>
				</div>

				<!-- Separador -->
				<div class="row">
					<div class="col"><hr /></div>
				</div>

				<div class="col-md-8 mx-auto text-center mb-4">
					<label><b>Cambiar contraseña</b></label>

					<div class="form-group">
						<input type="password" class="form-control" id="currentPass" placeholder="Clave actual">
					</div>

					<div class="form-group">
						<input type="password" class="form-control" id="newPass" placeholder="Clave nueva">
					</div>

					<!-- Información de seguridad de clave -->
					<div style="display: none;" id="pswmeter" class="mt-3"></div>
					<div style="display: none; padding-top: 8px; padding-bottom: 6px; text-align: center;" id="pswmeter-message" class="mt-3"></div>

					<div class="form-group">
						<input type="password" class="form-control" id="repeatPass" placeholder="Repita la nueva clave">
					</div>

					<button type="submit" name="actualizar" class="btn btn-success" onclick="CambiarClave()">Actualizar</button>
				</div>

				<!-- Separador -->
				<div class="row">
					<div class="col"><hr /></div>
				</div>
								
				<div class="col-md-8 mx-auto text-center">
					<label><b>Cambiar correo electrónico</b></label>

					<div class="form-group">
						<input type="text" class="form-control" id="newEmail" placeholder="Correo nuevo">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" id="repeatEmail" placeholder="Repita correo nuevo">
					</div>

					<button type="submit" name="actualizar" class="btn btn-success" onclick="CambiarEmail()">Actualizar</button>
				</div>

				<!-- Separador -->
				<div class="row">
					<div class="col"><hr /></div>
				</div>

				<div class="col-md-8 mx-auto text-center mb-4">
					<div class="custom-control custom-switch">
						<?php $Modo = getDarkMode($mysqli); 

						if ($Modo == 'light') { ?>
							<input type="checkbox" class="custom-control-input" id="customSwitches">
						<?php } else { ?>
							<input type="checkbox" class="custom-control-input" id="customSwitches" checked>
						<?php } ?>
						
						<label class="custom-control-label" for="customSwitches">Activar modo oscuro</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="./Scripts/Perfil.js"></script>