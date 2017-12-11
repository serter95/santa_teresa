<h3 class="titulo">Agregar Paleta</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Agregar Nueva Paleta</div>
	</div>
	<div class="panel-body">
		<div class="row">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarPaletas">
				<form class="form-horizontal" action="" method="POST" name="paletas" enctype="multipart/form-data">

				<?php Vistas\template\plantillas\campoRequerido::index(); ?>

					<input type="hidden" value="agregar" id="accion">

					<div class="form-group">
						<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="nombre" type="text"
							name="nombre" title="Ingrese el nombre de la paleta Ej:Superior 1"
							placeholder="Ejemplo: Superior 1" ng-model="nombre"
							ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}'"
							ng-keyup="validarNombre()" autofocus required>
							<span class="rojoRequired">*</span>
							<span class="rojo">
								{{valorNombre}}
							</span>
							<span class="rojo"
							ng-show="paletas.nombre.$dirty && paletas.nombre.$invalid">
								El nombre de la paleta debe contener letras y/o números, minimo 5 caracteres
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="bulk" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Botellas P/C:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="bulk" type="number"
							name="bulk" title="Ingrese el número de botellas por camada Ej:120"
							placeholder="Ejemplo: 120" ng-model="bulk"
							ng-pattern="'^[0-9]{1,}'" min="1"
							ng-blur="validarNombre()" required>
							<span class="rojoRequired">*</span>
							<span class="rojo"
							ng-show="paletas.bulk.$dirty && paletas.bulk.$invalid">
								El número de botellas por camada debe contener solo números
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="cantidad_bulks" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Camadas:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="cantidad_bulks" type="number"
							name="cantidad_bulks" title="Ingrese el número de camadas Ej:30"
							placeholder="Ejemplo: 30" ng-model="cantidad_bulks"
							ng-pattern="'^[0-9]{1,}'" min="1"
							ng-blur="validarNombre()" required>
							<span class="rojoRequired">*</span>
							<span class="rojo"
							ng-show="paletas.cantidad_bulks.$dirty && paletas.cantidad_bulks.$invalid">
								La cantidad de camadas debe contener solo números
							</span>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="botella">Botella: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="botella" id="botella" title="Seleccione una opción" ng-model="botella" ng-change="validarNombre()" required>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto2 in botellasPaletas"
								value="{{objeto2.id}}">{{objeto2.nombre}}</option>
							</select>
							<span class="rojoRequired">*</span>
							<span class="rojo" ng-show="paletas.botella.$dirty && paletas.botella.$error.required">Seleccione una opción</span>
						</div>
					</div>

					<div class="form-group">
						<label for="foto" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="foto" type="file" name="foto" title="cargue la Imagen de la Paleta">
							<p>Formatos permitido: jpeg, png y jpg.
							<br>Tamaño limite: 700Kb * 1024Kb.</p>
						</div>
					</div>

					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button ng-disabled="paletas.$invalid" class="btn btn-primary" type="submit" id="boton">Registrar</button>
						<button class="btn btn-default" type="reset">Limpiar</button>
				    </div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>
