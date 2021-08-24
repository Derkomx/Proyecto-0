<!-- Cabezera de contenido -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
					<li class="breadcrumb-item"><a href="#">Reclamos</a></li>
					<li class="breadcrumb-item active">Reclamos cerrados</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<!-- Contenido -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Listado de reclamos cerrados</h3>
					</div>

					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Asunto</th>
									<th>Departamento</th>
									<th>Estado</th>
								</tr>
							</thead>

							<tbody>
								<?php 
									$arrayPersonal = obtenerReclamosGeneral($mysqli);

									foreach($arrayPersonal as $name) {
										if ($name[3] == 3) {
											echo '<tr>
											<td>'.$name['0'].'</td>
											<td><a href="?Seccion=VerReclamo&Reclamo='.$name['0'].'">'.$name['1'].'</a></td>
											<td>'.obtenerDepartamento($name['2']).'</td>';
											$Estado = obtenerEstadoReclamo($name['3']);?>
											<td class="text-center"><span class="badge bg-<?php echo $Estado['1']; ?>"><?php echo $Estado['0']; ?></span></td> 
											<?php echo '</tr>';
										}
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
			"ordering": false,
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