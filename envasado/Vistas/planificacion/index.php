<h3 class="titulo">Vista Principal de Planificación</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Listado de Planificación</h3>
	</div>
	<div class="panel-body">
		<?php
			if ($datos['validacion']==true) {
		?>
			<button class="btn btn-success agregar" disabled>Agregar <span class="glyphicon glyphicon-plus"></span></button>
		<?php
			} else {
		?>
		<a class="btn btn-success agregar" href="<?php echo URL;?>planificacion/agregar">Agregar <span class="glyphicon glyphicon-plus"></span></a>
		<?php
			}
		?>
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th>Fecha de Producción</th>
					<th>Linea</th>
					<th>Estimación Total</th>
					<th>Usada</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while($array=$datos['listar']->fetch(\PDO::FETCH_ASSOC)) {
			?>
			<tr>
				<td><?php echo $array['fecha_produccion'];?></td>
				<td><?php echo $array['nombre'];?></td>
				<td><?php echo $array['estimacion_total'];?></td>
				<td>
					<?php
						if ($array['usada']==1) {
						  echo "Si";
						} else {
						  echo "No";
						}
					?>
				</td>
				<td>
					<?php
						if ($array['usada']==0) {
					?>
					<a class="btn btn-primary" href="<?php echo URL;?>planificacion/editar/<?php echo $array['id'];?>" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
					<a class="btn btn-danger" href="#" onclick="eliminar('planificacion', '<?php echo $array['fecha_produccion']." ".$array['nombre'];?>', '<?php echo $array['id']; ?>', 'Usted está seguro que desea eliminar la planificación ');" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
					<?php
						}
					?>
				</td>
			</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
</div>
