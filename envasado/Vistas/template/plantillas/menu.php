<?php
	namespace Vistas\template\plantillas;

	class menu
	{
		public static function index($url)
		{
?>
<nav class="navbar navbar-default navbar-fixed-top" id="negro">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- 395px -->
			<a class="navbar-brand" href="#">Monitoreo de Envasado</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li <?php if($url[0]=='inicio' || $url[0]=='') { ?>	class="active" <?php } ?>>
					<a href="<?php echo URL; ?>inicio/index">Inicio <span class="sr-only">(current)</span></a>
				</li>
				<li <?php if($url[0]=='produccion') { ?> class="active" <?php } ?>>
					<a href="<?php echo URL; ?>produccion/index">Producción</a>
				</li>
				<li class="dropdown <?php if($url[0]!='inicio' && $url[0]!='produccion' && $url[0]!='configuracion') { ?>	active <?php } ?> " >
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menú <span class="caret"></span></a>
					<ul class="dropdown-menu" id="hover">
						<li <?php if($url[0]=='personal') { ?>  class="active" <?php } ?> >
							<a href="<?php echo URL; ?>personal/index">Personal</a>
						</li>
						<li <?php if($url[0]=='proveedores') { ?>  class="active" <?php } ?>>
							<a href="<?php echo URL; ?>proveedores/index">Proveedores</a>
						</li>
						<li <?php if($url[0]=='botellas') { ?>  class="active" <?php } ?> >
							<a href="<?php echo URL; ?>botellas/index">Botellas</a>
						</li>
						<li <?php if($url[0]=='cajas') { ?>  class="active" <?php } ?> >
							<a href="<?php echo URL; ?>cajas/index">Cajas</a>
						</li>
						<li <?php if($url[0]=='tapas') { ?>  class="active" <?php } ?>>
							<a href="<?php echo URL; ?>tapas/index">Tapas</a>
						</li>
						<li <?php if($url[0]=='etiquetas') { ?>  class="active" <?php } ?>>
							<a href="<?php echo URL; ?>etiquetas/index">Etiquetas</a>
						</li>
						<li <?php if($url[0]=='paletas') { ?>  class="active" <?php } ?>>
							<a href="<?php echo URL; ?>paletas/index">Paletas</a>
						</li>
						<li <?php if($url[0]=='planificacion') { ?>  class="active" <?php } ?>>
							<a href="<?php echo URL; ?>planificacion/index">Planificación</a>
						</li>
					</ul>
				</li>
				<li class="dropdown <?php if($url[0]=='configuracion') { ?>	active <?php } ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cuenta <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<div class="user">
							Usuario: <?php echo $_SESSION['usuario']; ?> <br>
							Privilegio: <?php echo $_SESSION['privilegio']; ?>
							<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['id_usuario']; ?>" ng-model="idUsuario">
						</div>
						<li role="separator" class="divider"></li>
						<li <?php if($url[0]=='configuracion') { ?>  class="active" <?php } ?>>
							<a href="#">Configuración</a>
						</li>
						<li>
							<a href="<?php echo URL; ?>salir/index">Salir</a>
						</li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<?php
		}
	}
?>
