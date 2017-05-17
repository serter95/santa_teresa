<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
		<h3 class="titulo">Vista Principal de Etiquetas</h3>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Listado de Etiquetas</h3>
			</div>
			<div class="panel-body">
				<a class="btn btn-success agregar" href="<?php echo URL;?>etiquetas/agregar">Agregar <span class="glyphicon glyphicon-plus"></span></a>
				<?php
					$objeto=new Controladores\usuariosController();
					$data=$objeto->ver($_SESSION['id_usuario']);
					$resultado=$data->fetch(\PDO::FETCH_ASSOC);
				?>
				<table class="table table-hover" id="myTable">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Medida</th>
							<th>Proveedor</th>
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
						<td><?php echo $array['medida'];?></td>
						<td>
							<?php 
								$objeto2=new Modelos\Conexion();
								$sql=$objeto2->seleccionar("nombre","proveedor","id='".$array['id_proveedor']."'");
								$query=$sql->fetch(\PDO::FETCH_ASSOC);
								echo $query['nombre'];
							?>
						</td>						
						<td>
							<a class="btn btn-default" href="<?php echo URL;?>etiquetas/ver/<?php echo $array['id'];?>" title="Detalle"><span class="glyphicon glyphicon-zoom-in"></span></a>

							<a class="btn btn-primary" href="<?php echo URL;?>etiquetas/editar/<?php echo $array['id'];?>" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>

							<a class="btn btn-danger" href="#" onclick="eliminar('etiquetas', '<?php echo $array['nombre'];?>', '<?php echo $array['id']; ?>', 'Usted está seguro que desea eliminar la etiqueta ');" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a> 
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