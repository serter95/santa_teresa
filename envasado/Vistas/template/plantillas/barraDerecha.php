<?php
	namespace Vistas\template\plantillas;
	use Modelos\Produccion as Produccion;

	class barraDerecha
	{
		private static $barraDerecha;

		public static function index()
		{
			self::$barraDerecha=new Produccion();
			$datos=self::$barraDerecha->listar();
?>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 columDerecha" style="min-height: 30em; max-height: 40em; overflow-y: auto;" ng-controller="barraDerecha">
	<div class="panel panel-default">
		<center>
			<h5 id="seleccione">Seleccione una opción para ver los datos de la línea</h5>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<select id="lineaParaEstadistica" ng-model="lineaParaEstadistica" ng-change="actualizarLinea()" class="form-control">
					<option value="">Seleccione una linea</option>
					<?php
						while($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
					?>
						<option value="<?php echo $array['id']; ?>"> <?php echo $array['nombre']; ?> </option>
					<?php
						}
					?>
				</select>
			</div>
		</center>

    <div class="panel-body">
			<input type="hidden" id="resultadoDatabarraDerecha" name="resultadoDatabarraDerecha"/>
			<!-- Nav tabs -->
	    <ul id="titulosBarra" class="nav nav-tabs">
	        <li id="datosR1-1" class="active"><a href="#datosR1" data-toggle="tab"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span></a></li>
					<li id="datosR2-1"><a href="#datosR2" data-toggle="tab"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a></li>
					<li><a href="#datosR3" data-toggle="tab"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></li>
	    </ul>
      <!-- Tab panes -->
      <div class="tab-content">
      	<div class="tab-pane fade in active" id="datosR1">
        	<div class="panel panel-default">
          	<div class="panel-body">
            	<div class="table-responsive">
								<!--button ng-show="barraDerecha.registrosConseguidos>0" class="btn btn-default" ng-click="graficas()">
									Reloj de Producción <span class="glyphicon glyphicon-stats"></span>
								</button-->
								<input type="hidden" name="relojGuage" id="relojGuage">
								<div id="gaugeSpeedometer" style="min-width: 240px; max-width: 280px; height: 280px; margin: 0 auto;"></div>
							</div>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

				<div class="tab-pane fade" id="datosR2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">

											<h5><b>Imagen de la Línea</b></h5>

			                <div class="imgLinea">
												<a href="<?php echo URL;?>Vistas/template/imagenes/{{imagenActual}}" class="fancybox" rel="gallery">
													<img ng-src="<?php echo URL;?>Vistas/template/imagenes/{{imagenActual}}" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												</a>
											</div>
											<h5><b>Descripción:</b></h5>

											<div class="datosBarra">Estado:
												<span class="verde" ng-style="estiloEstado" ng-bind="estadoLinea"></span>
											</div>
											<div class="datosBarra">Parada de Emergencia:
												<span class="verde" ng-style="estiloParada" ng-bind="paradas"></span>
											</div>
											<div class="datosBarra">Supervisor:
												<span ng-bind="supervisor"></span>
											</div>
											<div class="datosBarra">Producto:
												<span ng-bind="producto"></span>
											</div>
											<div class="datosBarra">Producción:
												<a href="<?php echo URL;?>produccion/detalle/{{idProduccion}}">
													<span class="numeros" ng-style="estiloProduccion" ng-bind="produccion"></span>
												</a>
											</div>

                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

        <div class="tab-pane fade" id="datosR3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">

                    	<h5><b>Estimaciones:</b></h5>

											<!--div class="datosBarra">Botellas Estimadas:
												<span ng-style="nulo" class="numeros" ng-bind="botellasEstimadas"></span>
											</div-->
											<div class="datosBarra">Cajas Estimadas:
												<span ng-style="nulo" class="numeros" ng-bind="cajasEstimadas"></span>
											</div>

											<h5><b>Paradas:</b></h5>

											<div class="datosBarra">Total:
												<a href="<?php echo URL; ?>produccion/historial/paradas-emergencia-{{idProduccion}}">
													<span ng-style="nulo" class="rojo" ng-bind="totalParadas"></span>
												</a>
											</div>
											<div class="datosBarra">Ultima Ubicación:
												<span ng-style="nulo" class="naranja" ng-bind="UltimaParada"></span>
											</div>

						          <h5><b>Contadores:</b></h5>

											<div class="datosBarra">Total de Camadas:
												<a href="<?php echo URL; ?>produccion/historial/camadas-usadas-{{idProduccion}}">
													<span ng-style="nulo" class="numeros" ng-bind="totalCamadas"></span>
												</a>
											</div>
											<div class="datosBarra">Botellas Llenas:
												<a href="<?php echo URL; ?>produccion/historial/botellas-llenas-{{idProduccion}}">
													<span ng-style="nulo" class="numeros" ng-bind="botellasLlenas"></span>
												</a>
											</div>
											<div class="datosBarra">Botellas Vacias:
												<a href="<?php echo URL; ?>produccion/historial/botellas-vacias-{{idProduccion}}">
													<span ng-style="nulo" class="numeros" ng-bind="botellasVacias"></span>
												</a>
											</div>
											<div class="datosBarra">Cajas Llenas:
												<a href="<?php echo URL; ?>produccion/historial/cajas-llenas-{{idProduccion}}">
													<span ng-style="nulo" class="numeros" ng-bind="cajasLlenas"></span>
												</a>
											</div>
											<div class="datosBarra">Cajas Vacias:
												<a href="<?php echo URL; ?>produccion/historial/cajas-vacias-{{idProduccion}}">
													<span ng-style="nulo" class="numeros" ng-bind="cajasVacias"></span>
												</a>
											</div>

                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
      </div>
      </div>
		</div>

		<div class="estadisticas"></div>

</div>
<?php
		}
	}
?>
