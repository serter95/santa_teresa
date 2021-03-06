<h3 class="titulo">Agregar Botellas</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Agregar Nueva Botella</div>
	</div>
	<div class="panel-body">
		<div class="row">
			
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarBotellas">
				<form class="form-horizontal" action="" method="POST" name="botellas" enctype="multipart/form-data">
				
				<?php Vistas\template\plantillas\campoRequerido::index(); ?>
				
					<input type="hidden" value="agregar" id="accion">

					<div class="form-group">
						<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="nombre" type="text" 
							name="nombre" title="Ingrese el nombre de la botella Ej:Superior 750ml"
							placeholder="Ejemplo: Superior 750ml" ng-model="nombre" 
							ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}'" 
							ng-keyup="validarNombre()" autofocus required>
							<span class="rojoRequired">*</span>
							<span class="rojo">
								{{valorNombre}}
							</span>
							<span class="rojo" 
							ng-show="botellas.nombre.$dirty && botellas.nombre.$invalid">
								El nombre de la botella debe contener letras y/o números, minimo 5 caracteres
							</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="distribucion">Distribución: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="distribucion" id="distribucion" 
							title="Seleccione una opción" ng-model="distribucion" 
							ng-change="validarNombre()" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto in distribucionTotal">{{ objeto }}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="botellas.distribucion.$dirty && botellas.distribucion.$error.required">Selecione una opción</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="proveedor">Proveedor: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="proveedor" id="proveedor" 
							title="Seleccione una opción" ng-model="proveedor" 
							ng-change="validarNombre()" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto2 in proveedoresTotal" 
								value="{{objeto2.id}}">{{objeto2.nombre}}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="botellas.proveedor.$dirty && botellas.proveedor.$error.required">Seleccione una opción</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="medida">Medida: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="medida" id="medida" 
							title="Seleccione una opción" ng-model="medida" 
							ng-change="validarNombre()" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto3 in medidasTotal" 
								value="{{objeto3.id}}">{{objeto3.tipo}}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="botellas.medida.$dirty && botellas.medida.$error.required">Seleccione una opción</span>
						</div>
					</div>
					
					<div class="form-group">
						<label for="foto" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="foto" type="file" name="foto" title="cargue la Imagen de la Botella">
							<p>Formatos permitido: jpeg, png y jpg.
							<br>Tamaño limite: 700Kb * 1024Kb.</p>
						</div>
					</div>

					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button ng-disabled="botellas.$invalid" class="btn btn-primary" type="submit" id="boton">Registrar</button>
						<button class="btn btn-default" type="reset">Limpiar</button>
				    </div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>