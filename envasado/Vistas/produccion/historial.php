<h3 class="titulo">Vista de <?php echo $datos['titulo']; ?></h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Historial de <?php echo $datos['titulo']; ?></h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th>Nº</th>
					<th>Fecha y Hora</th>
          <?php if ($datos['parada']): ?>
            <th>Fecha y Hora de Reinicio</th>
            <th>Estación</th>
          <?php endif; ?>
				</tr>
			</thead>
			<tbody>
			<?php
        $i=1;
				while($array=$datos['consulta']->fetch(\PDO::FETCH_ASSOC))
				{
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $array['fecha_hora'];?></td>
        <?php if ($datos['parada']): ?>
          <td><?php echo $array['hora_fecha_reinicio'];?></td>
          <td><?php echo $array['nombre'];?></td>
        <?php endif; ?>
			</tr>
			<?php
          $i++;
				}
			?>
			</tbody>
		</table>
	</div>
</div>
