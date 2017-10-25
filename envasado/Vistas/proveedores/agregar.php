<h3 class="titulo">Agregar Proveedor</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Agregar Nuevo Proveedor</div>
	</div>
	<div class="panel-body">
		<div class="row">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarProveedores">
				<form class="form-horizontal" action="" method="POST" name="proveedores" enctype="multipart/form-data">

				<?php Vistas\template\plantillas\campoRequerido::index(); ?>

				<input type="hidden" value="agregar" id="accion">

					<div class="form-group">
						<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="nombre" type="text"
							name="nombre" title="Ingrese el nombre del proveedor Ej:Venvidrio C.A"
							placeholder="Ejemplo: Venvidrio C.A" ng-model="nombre"
							ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9 \.]{5,}'"
							ng-keyup="validarNombreProveedor()" ng-blur="validarMunicipio()" autofocus required>
							<span class="rojoRequired">*</span>
							<span class="rojo">
								{{valorNombre}}
							</span>
							<span class="rojo"
							ng-show="proveedores.nombre.$dirty && proveedores.nombre.$invalid">
								El nombre del proveedor debe contener letras y/o números, minimo 5 caracteres
							</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="estado">Estado: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="estado" id="estado"
							title="Seleccione una opción" ng-model="estado"
							ng-change="buscarMunicipios()" ng-blur="validarNombreProveedor()" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto in estados" value="{{objeto.id}}">{{ objeto.nombre }}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="proveedores.estado.$dirty && proveedores.estado.$error.required">Selecione una opción</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="municipio">Municipio: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="municipio" id="municipio"
							title="Seleccione una opción" ng-model="municipio"
							ng-change="validarMunicipio()" ng-blur="validarNombreProveedor()" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto2 in municipios" value="{{objeto2.id}}">{{ objeto2.nombre }}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="proveedores.municipio.$dirty && proveedores.municipio.$error.required">Selecione una opción</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="direccion">Dirección: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<textarea class="form-control" id="direccion" name="direccion" ng-model="direccion" title="Ingrese la direccion del proveedor Ej:El concejo, calle..." ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9 \.,_-]{10,}'"
							ng-keyup="validarMunicipio()" ng-blur="validarNombreProveedor()" required></textarea>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="proveedores.direccion.$dirty && proveedores.direccion.$invalid">Coloque la Dirección del Proveedor solo se aceptan numeros, letras, puntos, comas y guinoes ". , - _" minimo 10 caracteres</span>
						</div>
					</div>

					<div class="form-group inputTelefonos">
						<label for="codigo" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Teléfono: </label>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<input class="form-control" id="codigo" type="number" name="codigo"
							min="0001" max="9999" ng-minlength="4" ng-maxlength="4"
							title="Ingrese el Código del Teléfono Ej:0244, 0412, etc."
							placeholder="Ejemplo: 0244" ng-model="codigo"
							ng-pattern="'^[0-9]{4}'" ng-keyup="validarMunicipio()"
							ng-blur="validarNombreProveedor()" required>
							<span class="rojoRequired">*</span>
							<span class="rojo">
								{{valorCedula}}
							</span>
							<span class="rojo" ng-show="proveedores.codigo.$dirty && proveedores.codigo.$invalid">El código del teléfono debe tener 4 numeros</span>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
							<input class="form-control" id="numero" type="number" name="numero"
							min="0000000" max="9999999" ng-minlength="7" ng-maxlength="7"
							title="Ingrese el Número de Teléfono Ej:1234455"
							placeholder="Ejemplo: 1234455" ng-model="numero"
							ng-pattern="'^[0-9]{7}'" ng-keyup="validarMunicipio()"
							ng-blur="validarNombreProveedor()" required>
							<span class="rojoRequired">*</span>
							<span class="rojo">
							</span>
							<span class="rojo" ng-show="proveedores.numero.$dirty && proveedores.numero.$invalid">El número de teléfono debe tener 7 números</span>
						</div>
					</div>

					<div class="form-group">
						<label for="nombres" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Persona Contacto: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="contacto" type="text" name="contacto"
							ng-maxlength="60" placeholder="Ejemplo: Pedro Pérez"
							title="Ingrese el Nombre de la Persona de Contacto Ej: Pedro Pérez"
							ng-model="contacto" ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?'" ng-keyup="validarMunicipio()"
							 ng-blur="validarNombreProveedor()" required>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="proveedores.contacto.$dirty && proveedores.contacto.$invalid">Los nombres y apellidos de la persona deben tener minimo 2 letras</span>
						</div>
					</div>

					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button ng-disabled="proveedores.$invalid" class="btn btn-primary" type="submit" id="boton">Registrar</button>
						<button class="btn btn-default" type="reset">Limpiar</button>
				    </div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>
