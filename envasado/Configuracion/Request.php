<?php 
	namespace Configuracion;

	class Request
	{
		private $controlador;
		private $metodo;
		private $argumento;

		public function __construct()
		{
			//$url= $_SERVER["PHP_SELF"]; // REQUEST_URI - PHP_SELF - SERVER_NAME
			//echo $url."<br>";

			if (isset($_GET['url']))
			{

				$ruta=filter_input(INPUT_GET, 'url');
				$ruta=explode("/", $ruta);
				$ruta=array_filter($ruta);
				#print_r($ruta);

				if ($ruta[0]=="index.php")
				{
					$this->controlador='inicio';
				}
				else
				{
					$this->controlador=strtolower(array_shift($ruta));
				}
				
				$this->metodo=strtolower(array_shift($ruta));

				if (!$this->metodo)
				{
					$this->metodo="index";
				}

				$this->argumento=strtolower(array_shift($ruta));
			}
			else
			{
				$this->controlador="inicio";
				$this->metodo="index";
			}
		}

		public function getControlador()
		{
			return $this->controlador;
		}

		public function getMetodo()
		{
			return $this->metodo;
		}

		public function getArgumento()
		{
			return $this->argumento;
		}
	}
?>