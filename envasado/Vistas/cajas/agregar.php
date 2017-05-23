<h3 class="titulo">Agregar Cajas</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Agregar Nueva Caja</div>
	</div>
	<div class="panel-body">
		<div class="row">
			
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarCajas">
				<form class="form-horizontal" action="" method="POST" name="cajas" enctype="multipart/form-data">
				
				<?php Vistas\template\plantillas\campoRequerido::index(); ?>
				
					<input type="hidden" value="agregar" id="accion">

					<div class="form-group">
						<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="nombre" type="text" 
							name="nombre" title="Ingrese el nombre de la caja Ej:Superior 750ml"
							placeholder="Ejemplo: Superior 750ml" ng-model="nombre" 
							ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}'" 
							ng-keyup="validarNombre()" autofocus required>
							<span class="rojoRequired">*</span>
							<span class="rojo">
								{{valorNombre}}
							</span>
							<span class="rojo" 
							ng-show="cajas.nombre.$dirty && cajas.nombre.$invalid">
								El nombre de la caja debe contener letras y/o números, minimo 5 caracteres
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="medida" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Medida:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="medida" type="text" 
							name="medida" title="Ingrese la medida de la caja Ej:35 x 40 x 50"
							placeholder="Ejemplo: 35 x 40 x 50" ng-model="medida" 
							ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}'" 
							ng-blur="validarNombre()" required>
							<span class="rojoRequired">*</span>
							<span class="rojo" 
							ng-show="cajas.medida.$dirty && cajas.medida.$invalid">
								La Medida de la caja debe contener letras y/o números, minimo 5 caracteres
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="cantidad_botellas" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Unidades:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="cantidad_botellas" type="text" 
							name="cantidad_botellas" title="Ingrese las unidades de botellas Ej:12"
							placeholder="Ejemplo: 12" ng-model="cantidad_botellas" 
							ng-pattern="'^[0-9]{1,2}'" ng-blur="validarNombre()" required>
							<span class="rojoRequired">*</span>
							<span class="rojo" 
							ng-show="cajas.cantidad_botellas.$dirty && cajas.cantidad_botellas.$invalid">
								Las unidades de botellas por caja debe contener solo numeros, minimo 1 caracter maximo 2
							</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="proveedor">Proveedor: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="proveedor" id="proveedor" 
							title="Seleccione una opción" ng-model="proveedor" 
							ng-change="validarNombre()" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto2 in proveedoresCajas" 
								value="{{objeto2.id}}">{{objeto2.nombre}}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="cajas.proveedor.$dirty && cajas.proveedor.$error.required">Seleccione una opción</span>
						</div>
					</div>
					
					<div class="form-group">
						<label for="foto" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="foto" type="file" name="foto" title="cargue la Imagen de la Caja">
							<p>Formatos permitido: jpeg, png y jpg.
							<br>Tamaño limite: 700Kb * 1024Kb.</p>
						</div>
					</div>

					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button ng-disabled="cajas.$invalid" class="btn btn-primary" type="submit" id="boton">Registrar</button>
						<button class="btn btn-default" type="reset">Limpiar</button>
				    </div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>