<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
		<h3 class="titulo">Vista de Producción de <?php echo $datos['nombre_linea']; ?></h3>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<?php echo "Producción desde '".$datos['fecha_hora_inicio']."' hasta ";

						if ($datos['fecha_hora_fin']=='2017-01-01 00:00:00')
						{
							echo "'".date('Y-m-d H:m:i')."' (No Culminada)";
						}
						else
						{
							echo "'".$datos['fecha_hora_fin']."' (Culminada)";
						}
					?>		
				</h3>
			</div>
			<div class="panel-body" ng-controller="informacionModal">
				<div class="informacion">
					<a class="btn btn-danger boton-informacion" ng-click="informacion('<?php echo URL;?>produccion/angular/<?php echo $datos['id'];?>_emergencia')">Paradas de Emergencia <span class="glyphicon glyphicon-th-list"></span></a>

					<a class="btn btn-info boton-informacion" ng-click="informacion('<?php echo URL;?>produccion/angular/<?php echo $datos['id'];?>_personal')">Personal <span class="glyphicon glyphicon-th-list"></span></a>
				</div>
				
				<table class="table table-hover">
					<h4><u>Supervisor:</u></h4>
					<thead>
						<tr>
							<th>C.I</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Jornada</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $datos['cedula'];?></td>
						<td><?php echo $datos['nombres'];?></td>
						<td><?php echo $datos['apellidos'];?></td>
						<td><?php echo $datos['jornada'];?></td>
					</tr>
					</tbody>
				</table>

				<table class="table table-hover">
					<h4><u>Paleta:</u></h4>
					<thead>
						<tr>
							<th>Nombres</th>
							<th>Botellas por Camada</th>
							<th>Número de Camadas</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $datos['nombre_paleta'];?></td>
						<td><?php echo $datos['bulk'];?></td>
						<td><?php echo $datos['cantidad_bulks'];?></td>
					</tr>
					</tbody>
				</table>

				<table class="table table-hover">
					<h4><u>Botella:</u></h4>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Distribución</th>
							<th>Medida (cm)</th>
							<th>Proveedor</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $datos[0]['nombre_botella'];?></td>
						<td><?php echo $datos[0]['distribucion'];?></td>
						<td><?php echo $datos[0]['tipo'];?></td>
						<td><?php echo $datos[0]['nombre_proveedor'];?></td>
					</tr>
					</tbody>
				</table>

				<table class="table table-hover">
					<h4><u>Caja:</u></h4>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Cantidad de Botellas</th>
							<th>Medida (cm)</th>
							<th>Proveedor</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $datos[1]['nombre_caja'];?></td>
						<td><?php echo $datos[1]['cantidad_botellas'];?></td>
						<td><?php echo $datos[1]['medida_caja'];?></td>
						<td><?php echo $datos[1]['nombre_proveedor_caja'];?></td>
					</tr>
					</tbody>
				</table>

				<table class="table table-hover">
					<h4><u>Etiqueta:</u></h4>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Medida (cm)</th>
							<th>Proveedor</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $datos[2]['nombre_etiqueta'];?></td>
						<td><?php echo $datos[2]['medida_etiqueta'];?></td>
						<td><?php echo $datos[2]['nombre_proveedor_etiqueta'];?></td>
					</tr>
					</tbody>
				</table>

				<table class="table table-hover">
					<h4><u>Tapa:</u></h4>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Medida (inch)</th>
							<th>Proveedor</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $datos[3]['nombre_tapa'];?></td>
						<td><?php echo $datos[3]['medida_tapa'];?></td>
						<td><?php echo $datos[3]['nombre_proveedor_tapa'];?></td>
					</tr>
					</tbody>
				</table>

				<table class="table table-hover">
					<h4><u>Contadores:</u></h4>
					<thead>
						<tr>
							<th>Botellas llenas</th>
							<th>Botellas Vacias</th>
							<th>Cajas llenas</th>
							<th>Cajas Vacias</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $datos[4]['botellas_llenas'];?></td>
						<td><?php echo $datos[4]['botellas_vacias'];?></td>
						<td><?php echo $datos[4]['cajas_llenas'];?></td>
						<td><?php echo $datos[4]['cajas_vacias'];?></td>
					</tr>
					</tbody>

					<thead>
						<tr>
							<th>Camadas Usadas</th>
							<!--th>Cantidad de Paletas</th-->
							<th>Paradas de Emergencia</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $datos[4]['bulks_usados'];?></td>
							<!--td><?php //echo $datos['cantidad_paletas'];?></td-->
							<td><?php echo $datos[4]['parada_emergencia'];?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php new Vistas\template\plantillas\barraDerecha(); ?>

</div>