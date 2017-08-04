<?php
	namespace Vistas\template\plantillas;

	class modales
	{
		public static function index($url)
		{
			$titulo="Monitoreo del Proceso de Envasado";
			$aceptar="Aceptar";
			$cancelar="Cancelar";
?>
			<div id="exito" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="error">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
				    <div class="modal-header" id="modalVerde">
				      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				      <h4 class="modal-title"><?php echo $titulo ?></h4>
				    </div>
				    <div class="modal-body">
				      <center>
				       <h4>¡<span class="mensajeModal"></span>!</h4>

				       <button class="btn btn-primary" data-dismiss="modal"><?php echo $aceptar ?></button>
				      </center>
				    </div>
				  </div>
				</div>
			</div>

			<div id="error" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="error">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
				    <div class="modal-header" id="modalRojo">
				      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				      <h4 class="modal-title"><?php echo $titulo ?></h4>
				    </div>
				    <div class="modal-body">
				      <center>
				       <h4>¡<span class="mensajeModal"></span>!</h4>

				       <button class="btn btn-primary" data-dismiss="modal"><?php echo $aceptar ?></button>
				      </center>
				    </div>
				  </div>
				</div>
			</div>

			<div id="eliminar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="error">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
				    <div class="modal-header" id="modalRojo">
				      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				      <h4 class="modal-title"><?php echo $titulo ?></h4>
				    </div>
				    <div class="modal-body">
				    	<input type="hidden" id="eliminarId">
				    	<input type="hidden" id="moduloEliminar">
				      <center>
				       <h4>¿<span id="mensajeEliminar"></span><u><span id="datosEliminar"></span></u>?</h4>

				       <button class="btn btn-primary" onclick="confirmarEliminar('<?php echo URL; ?>');"><?php echo $aceptar ?></button>
				       <button class="btn btn-danger" data-dismiss="modal"><?php echo $cancelar ?></button>
				       </center>
				    </div>
				  </div>
				</div>
			</div>

			<div id="informacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="error">
				<div class="modal-dialog modal-lg" role="document">
				  <div class="modal-content">
				    <div class="modal-header">
				      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				      <h4 class="modal-title"><?php echo $titulo ?></h4>
				    </div>
				    <div class="modal-body">
				    	<div class="panel-body" id="mensajeInformacion" ng-model="mensajeInformacion">
				    	</div>
				    	<center>
				       		<button class="btn btn-danger" data-dismiss="modal"><?php echo $cancelar ?></button>
				       </center>
				    </div>
				  </div>
				</div>
			</div>

			<div id="canvasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="error">
				<div class="modal-dialog modal-lg" role="document">
				  <div class="modal-content">
				    <div class="modal-header">
				      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				      <h4 class="modal-title"><?php echo $titulo ?></h4>
				    </div>
				    <div class="modal-body">
				    	<div id="container" style="width: 100%;">
					        <div id="gaugeSpeedometer" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div>
					    </div>
				    	<center>
				       		<button class="btn btn-primary" data-dismiss="modal"><?php echo $aceptar ?></button>
				       </center>
				    </div>
				  </div>
				</div>
			</div>
<?php
			if ($url[0]!="inicio" && $url[1]=="index" && $url[2])
			{
?>
				<script type="text/javascript">
					modales("<?php echo $url[2]; ?>");
				</script>
<?php
			}

		}
	}
?>
