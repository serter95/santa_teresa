<?php
	$array=$datos->fetch(\PDO::FETCH_ASSOC);
	$ced=explode('-', $array['cedula']);
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
		<h3 class="titulo">Ver Personal</h3>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Ver Personal</div>
			</div>
			<div class="panel-body">
				<div class="row">
					
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarPersonal">

						<form class="form-horizontal" action="" method="POST" name="personal" enctype="multipart/form-data">

						<input type="hidden" value="ver" id="accion">
						<input type="hidden" value="<?php echo $array['id']; ?>" id="id" name="id">
						<input type="hidden" value="<?php echo $array['numero_personal']; ?>" id="numeroPersonal2" name="numeroPersonal2">
						<input type="hidden" value="<?php echo $ced[0].'-'; ?>" id="nacionalidad2">
						<input type="hidden" value="<?php echo $ced[1]; ?>" id="cedula2">
						<input type="hidden" value="<?php echo $array['nombres']; ?>" id="nombres2">
						<input type="hidden" value="<?php echo $array['apellidos']; ?>" id="apellidos2">
						<input type="hidden" value="<?php echo $array['departamento']; ?>" id="departamento2">
						<input type="hidden" value="<?php echo $array['cargo']; ?>" id="cargo2">
						<input type="hidden" value="<?php echo $array['estado']; ?>" id="estado2">
						<input type="hidden" value="<?php echo $array['jornada']; ?>" id="jornada2">

						<span ng-repeat="objeto in edit">
							<div class="form-group">
								<label for="numeroPersonal" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">
									Número de Personal: 
								</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="numeroPersonal" type="text" 
									name="numeroPersonal" disabled ng-model="objeto.numeroPersonal">
								</div>
							</div>
							
							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="nacionalidad">Nacionalidad: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="nacionalidad" id="nacionalidad" 
									ng-model="objeto.nacionalidad" disabled>
										<option value="">Seleccione una opción</option>
										<option ng-repeat="nac in nacionalidadTotal">{{ nac }}</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="cedula" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Cédula de Identidad: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="cedula" type="text" name="cedula" 
									disabled ng-model="objeto.cedula">
								</div>
							</div>
						
							<div class="form-group">
								<label for="nombres" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombres: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="nombres" type="text" name="nombres" 
									disabled ng-model="objeto.nombres">
								</div>
							</div>
							
							<div class="form-group">
								<label for="apellidos" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Apellidos: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<input class="form-control" id="apellidos" type="text" name="apellidos"
									disabled ng-model="objeto.apellidos">
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="departamento">Departamento: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="departamento" id="departamento" disabled ng-model="objeto.departamento">
										<option value="">Seleccione una opción</option>
										<option ng-repeat="dep in departamentoTotal">{{dep}}</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="cargo">Cargo: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="cargo" id="cargo" 
									disabled ng-model="objeto.cargo">
										<option value="">Seleccione una opción</option>
										<option ng-repeat="cargo in cargoTotal">{{cargo}}</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="estado">Estado: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="estado" id="estado" 
									disabled ng-model="objeto.estado">
										<option value="">Seleccione una opción</option>
										<option ng-repeat="estado in estadoTotal">{{estado}}</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="jornada">Jornada: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<select class="form-control" name="jornada" id="jornada" 
									disabled ng-model="objeto.jornada">
										<option value="">Seleccione una opción</option>
										<option ng-repeat="jornada in jornadaTotal">{{jornada}}</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen Actual: </label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
									<a class="fancybox" rel="gallery" href="<?php echo URL; ?>Vistas/template/imagenes/avatars/<?php echo $array['foto']; ?>">
										<img class="col-lg-3 col-md-3 col-sm-3 col-xs-12 img-thumbnail" src="<?php echo URL; ?>Vistas/template/imagenes/avatars/<?php echo $array['foto']; ?>">
									</a>
								</div>
							</div>
						</span>
						
						</form>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
				</div>
			</div>
		</div>
	</div>
	<?php new Vistas\template\plantillas\barraDerecha(); ?>
</div>