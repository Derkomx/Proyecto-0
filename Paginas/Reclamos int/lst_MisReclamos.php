<?php
// Incluye los archivos necesarios
include_once '././includes/MySQL.php';
include_once '././includes/functions.php';
	$Reclamos = obtenerMisReclamosint($ID, $mysqli);
?>

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

<div class="col-md-10 mx-auto">
	<div class="card">
        <div class="card-header text-center">
            <h3 class="card-title">Últimos reclamos creados</h3>
        </div>

        <div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr class="bg-success">
							<th style="width: 30px;">#</th>
							<th>Título</th>
							<th style="width: 200px;;">Departamento</th>
							<th class="text-center" style="width: 100px;">Estado</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($Reclamos as $Reclamo) { ?>
							<tr>
								<td><?php echo $Reclamo['0']; ?></td>
								<td><a href="?Seccion=VerReclamo&Reclamo=<?php echo $Reclamo['0']; ?>"><?php echo $Reclamo['1']; ?></a></td>
								<td><?php echo obtenerDepartamentoint($Reclamo['2']); ?></td>
								<?php $Estado = obtenerEstadoReclamoint($Reclamo['3']); ?>
								<td class="text-center"><span class="badge bg-<?php echo $Estado['1']; ?>"><?php echo $Estado['0']; ?></span></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col"><hr></div>
</div>

<div class="container">
	<div class="row">
		<div class="col text-center">
			<a href="?Seccion=NuevoReclamo">
				<button class="btn btn-primary">Crear nuevo reclamo</button>
			</a>
		</div>
	</div>
</div>