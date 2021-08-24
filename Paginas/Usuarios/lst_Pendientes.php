<!-- Cabezera de contenido -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
					<li class="breadcrumb-item"><a href="#">Usuarios</a></li>
					<li class="breadcrumb-item active">Verificación pendiente</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<!-- Contenido -->
<section class="content">
	<div class="container-fluid">
		<div class="alert alert-info text-center" role="alert">
			<i class="fas fa-info-circle"></i>
			Un usuario pendiente (o con verificación pendiente), es aquel que ya envió sus datos para ser verificados.
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Listado de usuarios pendientes</h3>
					</div>

					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>CUIL</th>
									<th>Apellido, Nombre</th>
									<th>Registro</th>
								</tr>
							</thead>

							<tbody>
								<?php
									// Se obtiene un array con los ID's pendientes
									$arrPendientes = obtenerListadoPendientes($mysqli);

									// Se itinera sobre el array recibido
									foreach($arrPendientes as $Usuario) {
										// Se obtienen los datos del usuario
										$uInfo = obtenerDatosUsuario($Usuario, $mysqli);
										//$id_nivel = obtenerV($name['0'], $mysqli);
										echo '<tr>
										<td>'.CUILFormat($uInfo['0']).'</td>
										<td><a href="?Seccion=VerUsuario&uID='.$Usuario.'">'.$uInfo['4'].', '.$uInfo['5'].'</a></td>
										<td>'.$uInfo[3].'</td>';
										echo '</tr>';
									}
								?>
							</tbody>

							<tfoot>
								<tr>
									<th>CUIL</th>
									<th>Apellido, Nombre</th>
									<th>Verificado</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>							
			</div>
		</div>
	</div>
</section>

<script>
    $(document).ready(function() {
        $('#example1').DataTable({
			responsive: true,
			language: {
				search:         "Buscar:",
				info:           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
				zeroRecords:    "No se encontraron resultados",
				infoEmpty:      "Mostrando 0 de 0 de 0 entradas",
				lengthMenu:     "Mostrar _MENU_ entradas",
				infoFiltered:   "(filtrado de _MAX_ total entradas)",
				"paginate": {
					"first":      "Primero",
					"last":       "Último",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
    });
</script>