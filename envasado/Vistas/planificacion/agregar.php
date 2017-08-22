<h3 class="titulo">Agregar Planificación</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Agregar Nueva Planificación</div>
	</div>
	<div class="panel-body">
		<div class="row">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarPlanificacion">
				<form class="form-horizontal" action="" method="POST" name="planificacion" enctype="multipart/form-data">

				<?php Vistas\template\plantillas\campoRequerido::index(); ?>

					<input type="hidden" value="agregar" id="accion">

					<div class="form-group">
						<label for="fecha_produccion" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Fecha de Producción:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="fecha_produccion" type="text"
							name="fecha_produccion" title="Esta es la fecha de la planificacion"
							placeholder="Ejemplo: DD-MM-YYYY" ng-model="fecha_produccion" required readonly>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="linea">Linea de Producción:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" ng-change="validacion()" name="linea" id="linea" title="Seleccione una opción" ng-model="linea" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto in lineasProduccion" value="{{objeto.id}}">{{ objeto.nombre }}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="planificacion.linea.$dirty && planificacion.linea.$error.required">Selecione una opción</span>
						</div>
					</div>

					<div class="form-group">
						<label for="estimacion_total" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Estimación Total:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="estimacion_total" ng-blur="validacion()" type="number"
							name="estimacion_total" title="Ingrese el número de cajas llenas estimadas Ej:5000"
							placeholder="Ejemplo: 5000" ng-model="estimacion_total"
							ng-pattern="'^[0-9]{1,}'" min="1" required>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="planificacion.estimacion_total.$dirty && planificacion.estimacion_total.$invalid">
								La cantidad de estimación debe contener solo números
							</span>
						</div>
					</div>

					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-3 col-lg-8 col-md-8 col-sm-8 col-xs-6 rojo">
						{{resultadoValidacion}}
					</div>

					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button ng-disabled="planificacion.$invalid" class="btn btn-primary" type="submit" id="boton">Registrar</button>
						<button class="btn btn-default" type="reset">Limpiar</button>
				  </div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>
