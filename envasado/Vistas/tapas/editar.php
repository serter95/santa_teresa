<?php
	$array=$datos->fetch(\PDO::FETCH_ASSOC);
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
		<h3 class="titulo">Editar Tapa</h3>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Editar Tapa</div>
			</div>
			<div class="panel-body">
				<div class="row">
					
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarTapas">
						<form class="form-horizontal" action="" method="POST" name="tapas" enctype="multipart/form-data">
						
						<?php require_once 'Vistas/template/plantillas/campoRequerido.php'; ?>
						
						<input type="hidden" value="editar" id="accion">
						<input type="hidden" value="<?php echo $array['id']; ?>" id="id" name="id">

						<span ng-repeat="objeto in editTapa">

							<div class="form-group">
								<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="nombre" type="text" 
									name="nombre" title="Ingrese el nombre de la tapa Ej:Superior 1"
									placeholder="Ejemplo: Superior 1" ng-model="objeto.nombre" 
									ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}'" 
									ng-keyup="validarNombre()" autofocus required>
									<span class="rojoRequired">*</span>
									<span class="rojo">
										{{valorNombre}}
									</span>
									<span class="rojo" 
									ng-show="tapas.nombre.$dirty && tapas.nombre.$invalid">
										El nombre de la tapa debe contener letras y/o números, minimo 5 caracteres
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="medida" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Medida:</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="medida" type="text" 
									name="medida" title="Ingrese la medida de la tapa Ej:35 x 40 x 50"
									placeholder="Ejemplo: 35 x 40 x 50" ng-model="objeto.medida" 
									ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}'" 
									ng-blur="validarNombre()" required>
									<span class="rojoRequired">*</span>
									<span class="rojo" 
									ng-show="tapas.medida.$dirty && tapas.medida.$invalid">
										La Medida de la tapa debe contener letras y/o números, minimo 5 caracteres
									</span>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="proveedor">Proveedor: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="proveedor" id="proveedor" 
									title="Seleccione una opción" ng-model="objeto.proveedor" 
									ng-change="validarNombre()" required>
										<option value="">Seleccione una opción</option>
										<option ng-repeat="objeto2 in proveedoresTapas" 
										value="{{objeto2.id}}">{{objeto2.nombre}}</option>
									</select>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="tapas.proveedor.$dirty && tapas.proveedor.$error.required">Seleccione una opción</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="foto" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="foto" type="file" name="foto" title="cargue la Imagen de la Tapa">
									<p>Formatos permitido: jpeg, png y jpg.
									<br>Tamaño limite: 700Kb * 1024Kb.</p>
								</div>
							</div>

						</span>

							<div class="form-group">
								<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen Actual: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<a class="fancybox" rel="gallery" href="<?php echo URL; ?>Vistas/template/imagenes/tapas/<?php echo $array['foto']; ?>">
										<img class="col-lg-3 col-md-3 col-sm-3 col-xs-12 img-thumbnail" 
										src="<?php echo URL; ?>Vistas/template/imagenes/tapas/<?php echo $array['foto']; ?>">
									</a>
								</div>
							</div>

							<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button ng-disabled="tapas.$invalid" class="btn btn-primary" type="submit" id="boton">Editar</button>
								<button class="btn btn-default" type="reset">Limpiar</button>
						    </div>
						</form>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				</div>
			</div>
		</div>
	</div>
	<?php new Vistas\template\plantillas\barraDerecha(); ?>
</div>