<?php
	$array=$datos->fetch(\PDO::FETCH_ASSOC);
?>
<h3 class="titulo">Ver Etiqueta</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Ver Etiqueta</div>
	</div>
	<div class="panel-body">
		<div class="row">
			
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarEtiquetas">
				<form class="form-horizontal" action="" method="POST" name="etiquetas" enctype="multipart/form-data">
				
					<input type="hidden" value="editar" id="accion">
					<input type="hidden" value="<?php echo $array['id']; ?>" id="id" name="id">

					<span ng-repeat="objeto in editEtiqueta">

						<div class="form-group">
							<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<input class="form-control" id="nombre" type="text" 
								name="nombre" ng-model="objeto.nombre" disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="medida" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Medida:</label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<input class="form-control" id="medida" type="text" 
								name="medida" ng-model="objeto.medida" disabled>
							</div>
						</div>

						<div class="form-group">
							<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="proveedor">Proveedor: </label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<select class="form-control" name="proveedor" id="proveedor"
								ng-model="objeto.proveedor" disabled>
									<option value="">Seleccione una opción</option>
									<option ng-repeat="objeto2 in proveedoresEtiquetas" 
									value="{{objeto2.id}}">{{objeto2.nombre}}</option>
								</select>
							</div>
						</div>
					
					</span>
					
					<div class="form-group">
						<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen Actual: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<a class="fancybox" rel="gallery" href="<?php echo URL; ?>Vistas/template/imagenes/etiquetas/<?php echo $array['foto']; ?>">
								<img class="col-lg-3 col-md-3 col-sm-3 col-xs-12 img-thumbnail" 
								src="<?php echo URL; ?>Vistas/template/imagenes/etiquetas/<?php echo $array['foto']; ?>">
							</a>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>