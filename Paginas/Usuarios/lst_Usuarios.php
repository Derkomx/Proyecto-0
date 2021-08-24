<!-- Cabezera de contenido -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
					<li class="breadcrumb-item"><a href="#">Usuarios</a></li>
					<li class="breadcrumb-item active">Listado completo</li>
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
			Aquí se listan todos los usuarios registrados, a excepción de los "no activo" y los "no verificado".
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Listado de usuarios</h3>
					</div>

					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>CUIL</th>
									<th>Apellido, Nombre</th>
									<th>Estado</th>
								</tr>
							</thead>

							<tbody>
								<?php 
									$Usuarios = obtenerListadoUsuarios($mysqli);

									foreach($Usuarios as $ID) {
										$Datos = obtenerDatosUsuario($ID, $mysqli);
										$Estado = obtenerEstadoUsuario($ID, $mysqli);

										echo '<tr>
										<td>'.CUILFormat($Datos[0]).'</td>
										<td><a href="?Seccion=VerUsuario&uID='.$ID.'">'.$Datos[4].', '.$Datos[5].'</a></td>
										<td>'.$Estado.'</td>';
										echo '</tr>';
									}
								?>
							</tbody>
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