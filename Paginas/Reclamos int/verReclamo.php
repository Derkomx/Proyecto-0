<?php
	// Incluye los archivos necesarios
	include_once '././includes/MySQL.php';
	include_once '././includes/functions.php';
	// Se obtiene la ID del usuario
	$ID = $_SESSION['id_usuario'];

	// Obtiene la ID del reclamo actual
	$Reclamo = $_GET['Reclamo'];
	

	// Obtiene los datos del reclamo
	$DatosReclamo = obtenerReclamoint($Reclamo, $mysqli);
	// Obtiene las respuestas del reclamo
	$Respuestas = obtenerRespuestasReclamoint($Reclamo, $ID, $mysqli);

	if (!($DatosReclamo[0] == $ID) || !isset($Respuestas)) { ?>
		<div class="alert alert-warning text-center" role="alert">
			Reclamo inválido.
		</div>
	<?php } else { ?>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						
						<h4><small><?php echo "Departamento: " .obtenerDepartamentoint($DatosReclamo[2]); ?></small></h4>
						<h4>
							<small>Reclamo #<?php echo $Reclamo; ?></small>
							<?php $Estado = obtenerEstadoReclamoint($DatosReclamo[3]); ?>
							<td class="text-center"><span class="badge bg-<?php echo $Estado['1']; ?>"><?php echo $Estado['0']; ?></span></td>
						</h4>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-9 mx-auto">
						<?php foreach($Respuestas as $Dato) {
							

							// Chequea si el ID de la respuesta es del usuario
							if ($Dato[4] == $ID) { ?>
								<div class="card card-success card-outline">
									<div class="card-header">
										<h3 class="card-title">
											<i class="fas fa-user-alt"></i>
											<?php echo $Dato[0].", ".$Dato[1]; ?> - <?php echo $Dato[2]; ?>
										</h3>
									</div>
								<div class="card-body">
									<?php echo $Dato[3]; ?>
								</div>
							</div>

							<?php } else { ?>
								<div class="card card-primary card-outline">
									<div class="card-header">
										<h3 class="card-title">
											<i class="fas fa-user-tie"></i>
											EQUIPO DE SOPORTE - <?php echo $Dato[2]; ?>
										</h3>
									</div>

									<div class="card-body">
										<?php echo $Dato[3]; ?>
									</div>
								</div>
							<?php }
						} ?>

					<?php if ($DatosReclamo[3] == 3) { ?>
						<div class="alert alert-warning text-center" role="alert">
							Este reclamo se encuentra cerrado, por lo que ya no se admiten más respuestas.
						</div>
					<?php } else { ?>
						<div class="card card-info">
							<div class="card-header">
								<h3 class="card-title">
									<i class="fas fa-plus"></i>
									Agregar nueva respuesta
								</h3>
							</div>

							<div class="card-body">
								<div class="form-group">
									<textarea class="form-control" rows="5" id="Mensaje"></textarea>
								</div>
							</div>

							<div class="card-footer">
								<div class="wrapper" style="text-align: center;">
									<button type="submit" class="btn btn-info" onclick="RespuestaUsuario()">Enviar respuesta</button>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php } ?>

<script src="Scripts/Reclamos2.js"></script>