
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
									<h3 class="card-title"> Lista de servicios</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>TIPO DE SERVICIO</th>
												<th>DETALLE</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$array1 = altasicont($_SESSION['id_usuario'],$mysqli);
										$array2 = listainm($array1['1'],$mysqli);									
										foreach($array2 as $name) {
											echo '<tr>
											<td>'.$name['1'].'</td>
											<td>'.$name['2'].'</td>';
											echo '</tr>';
										}
										?>
										</tbody>
										<tfoot>
											<tr>
											<th>TIPO</th>
											<th>NUMERO</th>
											</tr>
										</tfoot>
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