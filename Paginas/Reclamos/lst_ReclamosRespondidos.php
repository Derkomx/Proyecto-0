
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Inicio</h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">	
							<!-- /.card -->
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Listado de reclamos respondidos</h3>
								</div>
								<!-- /.card-header -->
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
											if ($name[3] == 2) {
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
								<!-- /.card-body -->
							</div>							
						</div>
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
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
					"last":       "??ltimo",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
    });
	</script>