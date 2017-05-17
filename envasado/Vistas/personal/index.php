<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
		<h3 class="titulo">Vista Principal de Personal</h3>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Listado de Personal</h3>
			</div>
			<div class="panel-body">
				<a class="btn btn-success agregar" href="<?php echo URL;?>personal/agregar">Agregar <span class="glyphicon glyphicon-plus"></span></a>
				<?php
					$objeto=new Controladores\usuariosController();
					$data=$objeto->ver($_SESSION['id_usuario']);
					$resultado=$data->fetch(\PDO::FETCH_ASSOC);
				?>
				<table class="table table-hover" id="myTable">
					<thead>
						<tr>
							<th>Cedula</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th class="hidden-xs">Cargo</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php
						while($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
					?>
						<tr>
							<td><?php echo $array['cedula'];?></td>
							<td><?php echo $array['nombres'];?></td>
							<td><?php echo $array['apellidos'];?></td>
							<td class="hidden-xs"><?php echo $array['cargo'];?></td>
							<td>
								<a class="btn btn-default" href="<?php echo URL;?>personal/ver/<?php echo $array['id'];?>" title="Detalle"><span class="glyphicon glyphicon-zoom-in"></span></a>

								<a class="btn btn-primary" href="<?php echo URL;?>personal/editar/<?php echo $array['id'];?>" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>

								<a class="btn btn-danger" href="#" onclick="eliminar('personal', '<?php echo $array['nombres'].' '.$array['apellidos'];?>', '<?php echo $array['id']; ?>', 'Usted está seguro que desea eliminar a ');" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a> 
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

<?php new Vistas\template\plantillas\barraDerecha(); ?>

</div>