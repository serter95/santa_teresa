<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
		<h3 class="titulo">Agregar Personal</h3>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Agregar Nuevo Personal</div>
			</div>
			<div class="panel-body">
				<div class="row">
					
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarPersonal">

						<form class="form-horizontal" action="" method="POST" name="personal" enctype="multipart/form-data">
						
						<?php require_once 'Vistas/template/plantillas/campoRequerido.php'; ?>
						
						<input type="hidden" value="agregar" id="accion">

							<div class="form-group">
								<label for="numeroPersonal" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">
									Número de Personal: 
								</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="numeroPersonal" type="number" 
									name="numeroPersonal" min="10000" max="100000"
									title="Ingrese el numero del Personal Ej:10000"
									placeholder="Ejemplo: 10123" ng-model="numeroPersonal" 
									ng-pattern="'^[0-9]{5,6}'" 
									ng-keyup="validarBD('agregar','numero_personal')"
									ng-blur="validarBD('agregar','numero_personal')" autofocus required>
									<span class="rojoRequired">*</span>
									<span class="rojo">
										{{valorPersonal}}
									</span>
									<span class="rojo" 
									ng-show="personal.numeroPersonal.$dirty && personal.numeroPersonal.$invalid">
										El numero de personal debe ser minimo de 5 digitos y mayor que 9.999 y menor que 100.000
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="nacionalidad">Nacionalidad: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="nacionalidad" id="nacionalidad" 
									title="Seleccione una opción" ng-model="nacionalidad" 
									ng-change="validarBD('agregar','cedula')"
									ng-blur="validarBD('agregar','cedula')" required>
										<option value="">Seleccione una opción</option>
										<option ng-repeat="nac in nacionalidadTotal">{{ nac }}</option>
									</select>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="personal.nacionalidad.$dirty && personal.nacionalidad.$error.required">Selecione una opción</span>
								</div>
							</div>

							<div class="form-group">
								<label for="cedula" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Cédula de Identidad: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="cedula" type="number" name="cedula" 
									min="1000000" max="999999999" ng-minlength="5" ng-maxlength="9" 
									title="Ingrese una Cédula de Identidad Ej:1012012"
									placeholder="Ejemplo: 55123123" ng-model="cedula" 
									ng-pattern="'^[0-9]{7,9}'" 
									ng-keyup="validarBD('agregar','cedula')"
									ng-blur="validarBD('agregar','cedula')" required>
									<span class="rojoRequired">*</span>
									<span class="rojo">
										{{valorCedula}}
									</span>
									<span class="rojo" ng-show="personal.cedula.$dirty && personal.cedula.$invalid">La cedula debe ser de 6 a 9 digitos y mayor que 999.999</span>
								</div>
							</div>
						
							<div class="form-group">
								<label for="nombres" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombres: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="nombres" type="text" name="nombres"  
									ng-maxlength="60" placeholder="Ejemplo: Pedro Luis" 
									title="Ingrese los Nombres de la Persona Ej: Pedro Luis" 
									ng-model="nombres" ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?'" required>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="personal.nombres.$dirty && personal.nombres.$invalid">Los nombres deben tener minimo 2 letras</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="apellidos" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Apellidos: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="apellidos" type="text" name="apellidos"
									minlength="2" maxlength="60" placeholder="Ejemplo: Perez Torres" 
									title="Ingrese los Apellidos de la Persona Ej: Perez Torres" 
									ng-model="apellidos" ng-pattern="'^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?'" required>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="personal.apellidos.$dirty && personal.apellidos.$invalid">Los apellidos deben tener minimo 2 letras</span>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="departamento">Departamento: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="departamento" id="departamento" title="Seleccione una opción" ng-model="departamento" required>
										<option value="">Seleccione una opción</option>
										<option ng-repeat="dep in departamentoTotal">{{dep}}</option>
									</select>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="personal.departamento.$dirty && personal.departamento.$error.required">Selecione una opción</span>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="cargo">Cargo: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="cargo" id="cargo" 
									title="Seleccione una opción" ng-model="cargo" required>
										<option value="">Seleccione una opción</option>
										<option ng-repeat="cargo in cargoTotal">{{cargo}}</option>
									</select>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="personal.cargo.$dirty && personal.cargo.$error.required">Selecione una opción</span>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="estado">Estado: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="estado" id="estado" 
									title="Seleccione una opción" ng-model="estado" required>
										<option value="">Seleccione una opción</option>
										<option ng-repeat="estado in estadoTotal">{{estado}}</option>
									</select>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="personal.estado.$dirty && personal.estado.$error.required">Selecione una opción</span>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="jornada">Jornada: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="jornada" id="jornada" 
									title="Seleccione una opción" ng-model="jornada" required>
										<option value="">Seleccione una opción</option>
										<option ng-repeat="jornada in jornadaTotal">{{jornada}}</option>
									</select>
									<span class="rojoRequired">*</span>
									<span class="rojo" ng-show="personal.jornada.$dirty && personal.jornada.$error.required">Selecione una opción</span>
								</div>
							</div>
					
							<div class="form-group">
								<label for="foto" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="foto" type="file" name="foto" title="cargue la Imagen de la Persona">
									<p>Formatos permitido: jpeg, png y jpg.
									<br>Tamaño limite: 700Kb * 1024Kb.</p>
								</div>
							</div>

							<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button ng-disabled="personal.$invalid" class="btn btn-primary" type="submit" id="boton">Registrar</button>
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