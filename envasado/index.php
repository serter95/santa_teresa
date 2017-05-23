<?php
//ob_start();
//error_log(0);
//error_reporting(E_ALL);
error_reporting(0);

$aux=explode('/', $_SERVER['REQUEST_URI']);
define('REQUEST_URI', $aux[4]);
define("URL", "http://".$_SERVER['HTTP_HOST']."/santa_teresa/envasado/");
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)).DS);

require_once 'Configuracion/Autoload.php';
Configuracion\Autoload::run();
Modelos\Validar::index();

class Template
{
	public function __construct()
	{
		if (REQUEST_URI!='angular')
		{
?>
			<!DOCTYPE html>
			<html lang="es" ng-app="santaTeresa">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /-->
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Envasado</title>
				<link rel="stylesheet" href="<?php echo URL; ?>Vistas/template/css/bootstrap.min.css">
				<link rel="stylesheet" href="<?php echo URL; ?>Vistas/template/css/dataTables.min.css">
				<link rel="stylesheet" href="<?php echo URL; ?>Vistas/template/css/jquery.fancybox.css">
				<link rel="stylesheet" href="<?php echo URL; ?>Vistas/template/css/mio.css">
			</head>
			<body>
<?php
		}
	}

	public function __destruct()
	{
		if (REQUEST_URI!='angular')
		{
			$url=explode('/', strtolower($_GET['url']));
			Vistas\template\plantillas\menu::index($url);
?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-principal">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 areaTrabajo">
<?php
		}
					Configuracion\Enrutador::run(new Configuracion\Request());
?>
					<input type="hidden" name="HTTP_HOST" id="HTTP_HOST" value="<?php echo URL; ?>" />
<?php
		if (REQUEST_URI!='angular')
		{
?>
				</div>
<?php
				Vistas\template\plantillas\barraDerecha::index();
?>
			</div>
<?php
			Vistas\template\plantillas\footer::index();
?>
			<script src="<?php echo URL; ?>Vistas/template/js/angular.min.js"></script>
			<script src="<?php echo URL; ?>Vistas/template/js/angular-route.min.js"></script>
			<script src="<?php echo URL; ?>Vistas/template/js/jquery-3.1.1.min.js"></script>
			<script src="<?php echo URL; ?>Vistas/template/js/bootstrap.min.js"></script>
			<script src="<?php echo URL; ?>Vistas/template/js/dataTables.min.js"></script>
			<script src="<?php echo URL; ?>Vistas/template/js/jquery.fancybox.js"></script>
			<script src="<?php echo URL; ?>Vistas/template/js/Chart.bundle.min.js"></script>
		    <script src="<?php echo URL; ?>Vistas/template/js/utils.js"></script>
			<script src="<?php echo URL; ?>Vistas/template/js/funciones.js"></script>
<?php
			Vistas\template\plantillas\modales::index($url);
?>
			<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
			</body>
			</html>
<?php
		}
	}
}
	new Template();
	//ob_end_flush();
?>