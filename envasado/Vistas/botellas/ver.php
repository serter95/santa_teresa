<?php
	$array=$datos->fetch(\PDO::FETCH_ASSOC);
?>
<h3 class="titulo">Editar Botellas</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Editar Botella</div>
	</div>
	<div class="panel-body">
		<div class="row">
			
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarBotellas">
				<form class="form-horizontal" action="" method="POST" name="botellas" enctype="multipart/form-data">
				
					<input type="hidden" value="editar" id="accion"/>
					<input type="hidden" name="id" id="id" value="<?php echo $array['id']; ?>"/>

					<span ng-repeat="obj in editBotella">

						<div class="form-group">
							<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<input class="form-control" id="nombre" type="text" 
								name="nombre" ng-model="obj.nombre" disabled>
							</div>
						</div>

						<div class="form-group">
							<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="distribucion">Distribución: </label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<select class="form-control" name="distribucion" id="distribucion"
								ng-model="obj.distribucion" disabled>
									<option value="">Seleccione una opción</option>
									<option ng-repeat="objeto in distribucionTotal">{{ objeto }}</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="proveedor">Proveedor: </label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<select class="form-control" name="proveedor" id="proveedor" 
								ng-model="obj.proveedor" disabled>
									<option value="">Seleccione una opción</option>
									<option ng-repeat="objeto2 in proveedoresTotal" 
									value="{{objeto2.id}}">{{objeto2.nombre}}</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="medida">Medida: </label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<select class="form-control" name="medida" id="medida" 
								ng-model="obj.medida" disabled>
									<option value="">Seleccione una opción</option>
									<option ng-repeat="objeto3 in medidasTotal" 
									value="{{objeto3.id}}">{{objeto3.tipo}}</option>
								</select>
							</div>
						</div>

					</span>	

					<div class="form-group">
						<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen Actual: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<a class="fancybox" rel="gallery" href="<?php echo URL; ?>Vistas/template/imagenes/botellas/<?php echo $array['foto']; ?>">
								<img class="col-lg-3 col-md-3 col-sm-3 col-xs-12 img-thumbnail" 
								src="<?php echo URL; ?>Vistas/template/imagenes/botellas/<?php echo $array['foto']; ?>">
							</a>
						</div>
					</div>
					
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>