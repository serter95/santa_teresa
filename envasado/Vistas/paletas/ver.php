<?php
	$array=$datos->fetch(\PDO::FETCH_ASSOC);
?>
<h3 class="titulo">Ver Paleta</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Ver Paleta</div>
	</div>
	<div class="panel-body">
		<div class="row">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" ng-controller="validarPaletas">
				<form class="form-horizontal" action="" method="POST" name="paletas" enctype="multipart/form-data">

				<input type="hidden" value="editar" id="accion">
				<input type="hidden" value="<?php echo $array['id']; ?>" id="id" name="id">

				<span ng-repeat="objeto in editPaleta">

					<div class="form-group">
						<label for="nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="nombre" type="text"
							name="nombre" ng-model="objeto.nombre" disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="bulk" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Botellas P/C:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="bulk" type="text" ng-model="objeto.bulk" disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="cantidad_bulks" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Camadas:</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<input class="form-control" id="cantidad_bulks" type="text"
							name="cantidad_bulks" ng-model="objeto.cantidad_bulks" disabled>
						</div>
					</div>

					<div class="form-group">
						<label multiple class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label" for="botella">Botella: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<select class="form-control" name="botella" id="botella" ng-model="objeto.botella" disabled>
								<option value="">Seleccione una opción</option>
								<option ng-repeat="objeto2 in botellasPaletas"
								value="{{objeto2.id}}">{{objeto2.nombre}}</option>
							</select>
						</div>
					</div>
				</span>

					<div class="form-group">
						<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Imagen Actual: </label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<a class="fancybox" rel="gallery" href="<?php echo URL; ?>Vistas/template/imagenes/paletas/<?php echo $array['foto']; ?>">
								<img class="col-lg-3 col-md-3 col-sm-3 col-xs-12 img-thumbnail"
								src="<?php echo URL; ?>Vistas/template/imagenes/paletas/<?php echo $array['foto']; ?>">
							</a>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		</div>
	</div>
</div>
