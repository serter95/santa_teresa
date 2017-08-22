<?php
	namespace Vistas\template\plantillas;

	class menu
	{
		public static function index($url)
		{
?>
<nav class="navbar navbar-fixed-top navbar-inverse" id="negro">
	<div id="containerMenu" class="container">

		<div id="navbar-brandMenu" class="navbar-brand">
			<span class="blancoTitulo">Monitoreo del Proceso de Envasado</span>
		</div>

		<button id="botonResponsive" class="navbar-toggle" data-target=".navHeaderCollapse" data-toggle="collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<div class="navbar-collapse collapse navHeaderCollapse" id="menu">
			<ul class="nav navbar-nav navbar-right" id="barraMenu">

        		<li
        			<?php if($url[0]=='inicio' || $url[0]=='')
        				{
        			?>
							class="enfocar"
					<?php
						}
					?>
				><a href="<?php echo URL; ?>inicio/index">Inicio</a></li>

        		<li
					<?php if($url[0]=='produccion')
						{
					?>
						class="enfocar"
					<?php
						}
					?>
				><a href="<?php echo URL; ?>produccion/index">Producción</a></li>


				<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menú <span class="glyphicon glyphicon-chevron-down"></span></a>
	              <ul class="dropdown-menu">
	                <div id="hover">
	                	<a href="<?php echo URL; ?>personal/index">
							<div
								<?php if($url[0]=='personal')
									{
								?>
									class="enfocar"
								<?php
									}
								?>
							>Personal
							</div>
						</a>

						<a href="<?php echo URL; ?>proveedores/index">
							<div
								<?php if($url[0]=='proveedores')
									{
								?>
										class="enfocar"
								<?php
									}
								?>
							>Proveedores
							</div>
						</a>

						<a href="<?php echo URL; ?>botellas/index">
							<div
								<?php if($url[0]=='botellas')
									{
								?>
										class="enfocar"
								<?php
									}
								?>
							>Botellas
							</div>
						</a>

						<a href="<?php echo URL; ?>cajas/index">
							<div
								<?php if($url[0]=='cajas')
									{
								?>
										class="enfocar"
								<?php
									}
								?>
							>Cajas
							</div>
						</a>

						<a href="<?php echo URL; ?>tapas/index">
							<div
								<?php if($url[0]=='tapas')
									{
								?>
										class="enfocar"
								<?php
									}
								?>
							>Tapas
							</div>
						</a>

						<a href="<?php echo URL; ?>etiquetas/index">
							<div
								<?php if($url[0]=='etiquetas')
									{
								?>
										class="enfocar"
								<?php
									}
								?>
							>Etiquetas
							</div>
						</a>

						<a href="<?php echo URL; ?>paletas/index">
							<div
								<?php if($url[0]=='paletas')
									{
								?>
										class="enfocar"
								<?php
									}
								?>
							>Paletas
							</div>
						</a>

						<a href="<?php echo URL; ?>planificacion/index">
							<div
								<?php if($url[0]=='planificacion')
									{
								?>
										class="enfocar"
								<?php
									}
								?>
							>Planificación
							</div>
						</a>
	                </div>
	              </ul>
	            </li>

				<!-- ******************************************************************************* -->

				<li class="dropdown enfocar">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cuenta <span class="glyphicon glyphicon-chevron-down"></span></a>
          <ul class="dropdown-menu">
            <div class="user">
            	Usuario: <?php echo $_SESSION['usuario']; ?> <br>
            	Privilegio: <?php echo $_SESSION['privilegio']; ?>
            	<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['id_usuario']; ?>" ng-model="idUsuario">
            </div>
            <li role="separator" class="divider"></li>
            <div id="hover">
            	<a href="#"><div>Configuración</div></a>
              <a href="<?php echo URL;?>salir/index"><div>Salir</div></a>
            </div>
          </ul>
        </li>
			</ul>
		</div>
	</div>
</nav>
<?php
		}
	}
?>
