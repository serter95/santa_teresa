<?php
	$array=$datos->fetch(\PDO::FETCH_ASSOC);
?>
<h3 class="titulo">Ver Proveedor</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Ver Proveedor</div>
	</div>
	<div class="panel-body">
		<div class="row">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarProveedores">
				<form class="form-horizontal" action="" method="POST" name="proveedores" enctype="multipart/form-data">

					<input type="hidden" value="editar" id="accion">
					<input type="hidden" value="<?php echo $array['id']; ?>" id="id" name="id">

				<span ng-repeat="obj in editProveedor">

					<div class="form-group">
						<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="nombre" type="text"
							name="nombre" ng-model="obj.nombre" disabled>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="estado">Estado: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="estado" id="estado"
							ng-model="obj.estado" disabled>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto in estados" value="{{objeto.id}}">{{ objeto.nombre }}</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="municipio">Municipio: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="municipio" id="municipio"
							ng-model="obj.municipio" disabled>
								<option value="0">Seleccione una opción</option>
								<option ng-repeat="objeto2 in municipios" value="{{objeto2.id}}">{{ objeto2.nombre }}</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="direccion">Dirección: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<textarea class="form-control" id="direccion" name="direccion"
							ng-model="obj.direccion" disabled></textarea>
						</div>
					</div>

					<div class="form-group inputTelefonos">
						<label for="codigo" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Teléfono: </label>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<input class="form-control" id="codigo" type="text" name="codigo"
							ng-model="obj.codigo" disabled>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
							<input class="form-control" id="numero" type="text" name="numero"
							ng-model="obj.numero" disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="nombres" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Persona Contacto: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="contacto" type="text" name="contacto"
							ng-model="obj.contacto" disabled>
						</div>
					</div>
				</span>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>
