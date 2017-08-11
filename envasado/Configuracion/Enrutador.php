<?php
	namespace Configuracion;

	class Enrutador
	{
		public static function run(Request $request)
		{
			$controlador=$request->getControlador()."Controller";

			$ruta=ROOT."Controladores".DS.$controlador.".php";

			$metodo=$request->getMetodo();

			if ($metodo=="index.php"){
				$metodo="index";
			}

			$argumento=$request->getArgumento();

			if (is_readable($ruta))
			{
				require_once $ruta;

				$mostrar='Controladores\\'.$controlador;

				$controlador=new $mostrar;

				if (!isset($argumento))
				{
					$datos=call_user_func(array($controlador, $metodo));
				}
				else
				{
					$datos=call_user_func_array(array($controlador, $metodo), array($argumento));
				}
			}
			else
			{
				echo "<br><br><br><br>ERROR AL CARGAR EL CONTROLADOR! La siguiente ruta no existe: '".$ruta."'<br><br>";
			}

			// Cargar Vista

			$ruta=ROOT."Vistas".DS.$request->getControlador().DS.$request->getMetodo().".php";

			//var_dump(REQUEST_URI);

			if (REQUEST_URI!='angular')
			{
				if (is_readable($ruta))
				{
					require_once $ruta;
				}
				else
				{
					echo "<br><br><br><br>ERROR AL CARGAR LA VISTA! La siguiente ruta no existe: '".$ruta."'<br><br>";
				}
			}
		}
	}
?>
