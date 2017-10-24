<?php
	$arreglo=$datos->fetch(\PDO::FETCH_ASSOC);
?>
<h3 class="titulo">Vista de <?php echo $arreglo['nombre_linea']; ?></h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Historial de <?php echo $arreglo['nombre_linea']; ?></h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th>Inicio</th>
					<th>Producto</th>
					<th>Fin</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while($array=$datos->fetch(\PDO::FETCH_ASSOC))
				{
					if (!$array['fecha_hora_fin'])
					{
						$array['fecha_hora_fin']='No definida';
					}
			?>
			<tr>
				<td><?php echo $array['fecha_hora_inicio'];?></td>
				<td><?php echo $array['nombre'];?></td>
				<td><?php echo $array['fecha_hora_fin'];?></td>
				<td>
					<a class="btn btn-default" href="<?php echo URL;?>produccion/detalle/<?php echo $array['id_produccion'];?>" title="Detalle"><span class="glyphicon glyphicon-zoom-in"></span></a>
					<a class="btn btn-info" href="<?php echo URL;?>produccion/pdf/<?php echo $array['id_produccion'];?>" target="_blank" title="Reporte"><span class="glyphicon glyphicon-print"></span></a>
				</td>
			</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
</div>
