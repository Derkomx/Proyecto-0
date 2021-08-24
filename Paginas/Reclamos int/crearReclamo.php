<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-1">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"></h1>
			</div>
		</div>
	</div>
</div>

<h6 class="mb-2 text-center">Antes de crear un ticket, por favor, lea atentamente la sección "<a href="Hola">Preguntas frecuentes</a>".</h6>

<div class="row">
	<div class="col"><hr /></div>
</div>

<div class="container py-6 mb-3">
	<div class="row">
		<div class="mx-auto col-sm-5">
			<div class="card">
				<div class="card-header bg-success">
					<h6 class="mb-0 text-center">Crear nuevo reclamo</h6>
				</div>

				<div class="card-body">
					<div class="alert alert-info text-center" role="alert">
						<p>Al crear un nuevo reclamo, el mismo será enviado al equipo de soporte. Se responderá lo antes posible; puede tardar hasta 2 días hábiles.</p>
					</div>

					<div class="form-group">
						<h6 class="text-center" for="Asunto">Asunto</h6>
						<input type="text" class="form-control" id="Asunto" maxlength="50"/>
					</div>

					<div class="form-group">
						<h6 class="text-center" for="sel1">Departamento</h6>
						<?php
						$Nivel = isLogged();
						if ($Nivel == 6){ ?>
						<select class="form-control input-sm" id="Departamento">
							<option value="" disabled selected>Selecciona un departamento...</option>
							<option>Soporte</option>
							<option hidden>Tecnicos</option>
						</select>
						<?php }elseif ($Nivel == 5) { ?>
							<select class="form-control input-sm" id="Departamento">
							<option value="" disabled selected>Selecciona un departamento...</option>
							<option hidden>Soporte</option>
							<option>Tecnicos</option>
						</select>
						<?php }else { ?>
							<select class="form-control input-sm" id="Departamento">
							<option value="" disabled selected>Selecciona un departamento...</option>
							<option>Soporte</option>
							<option>Tecnicos</option>
						</select>
						<?php } ?>
					</div>

					<div class="form-group">
						<h6 class="text-center" for="comment">Mensaje</h6>
						<textarea class="form-control" rows="5" id="Mensaje"></textarea>
					</div>

					<div style="text-align: center;">
						<button type="submit" class="btn btn-success" onclick="NuevoReclamo()">Crear reclamo</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col"><hr /></div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col text-center">
				<a href="index.php?Seccion=MisReclamosint">
					<button class="btn btn-primary">Todos mis reclamos</button>
				</a>
			</div>
		</div>
	</div>
</div>

<script src="Scripts/Reclamos2.js"></script>