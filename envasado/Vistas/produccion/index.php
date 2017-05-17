<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
		<h3 class="titulo">Vista Principal de Producción</h3>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Líneas de Producción</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php
						while($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
					?>
						<tr>
							<td><?php echo $array['nombre'];?></td>
							<td><?php echo $array['estado'];?></td>
							<td>
								<a class="btn btn-default" href="<?php echo URL;?>produccion/ver/<?php echo $array['id'];?>" title="Detalle"><span class="glyphicon glyphicon-zoom-in"></span></a>
							</td>
						</tr>
					<?php		
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php new Vistas\template\plantillas\barraDerecha();?>
</div>