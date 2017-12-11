<?php
	namespace Controladores;
	use Modelos\Planificacion as Planificacion;
	use Modelos\Produccion as Produccion;

	class planificacionController extends controlador implements metodos
	{
		private $objeto;

		public function __construct()
		{
			$this->objeto=new Planificacion();
		}

		public function index()
		{
			date_default_timezone_set('America/Caracas');

			$listar=$this->objeto->listar();
			$fecha=date('Y-m-d', time());
			$validacion=$this->objeto->validacion($fecha);
			if($validacion->rowCount()==6) {
				$validacion=true;
			} else {
				$validacion=false;
			}
			return array('listar'=>$listar, 'validacion'=>$validacion);
		}

		public function agregar()
		{
			if($_POST)
			{
				$fecha=$_POST['fecha_produccion'];
				$estimacion=$_POST['estimacion_total'];
				$linea=$_POST['linea'];

				if ($estimacion==0) {
					$errorRegistro='si';
				}
				/*$f=explode('/', $fecha);
				$this->objeto->set("fecha_planificacion", $f[2].'-'.$f[1].'-'.$f[0]);*/
				$this->objeto->set("fecha_produccion", $fecha);
				$this->objeto->set("estimacion_total", $estimacion);
				$this->objeto->set("id_linea", $linea);
				if ($errorRegistro=='si'){
					header("Location: ".URL."planificacion/index/error-registrar");
				}	else {
					$this->objeto->add();
					header("Location: ".URL."planificacion/index/exito-registrar");
				}
			}
		}

		public function editar($id)
		{
			if (!$_POST)
			{
				$this->objeto->set("id",$id);
				return $datos=$this->objeto->view();
			}
			else
			{
				$id=$_POST['id'];
				$fecha=$_POST['fecha_produccion'];
				$estimacion=$_POST['estimacion_total'];
				$linea=$_POST['linea'];
				if ($estimacion==0) {
					$errorRegistro='si';
				}
				$this->objeto->set("id", $id);
				$this->objeto->set("fecha_produccion", $fecha);
				$this->objeto->set("id_linea", $linea);
				$this->objeto->set("estimacion_total", $estimacion);

				if ($errorRegistro=='si')
				{
					header("Location: ".URL."planificacion/index/error-modificar");
				}
				else
				{
					$this->objeto->edit();
					header("Location: ".URL."planificacion/index/exito-modificar");
				}
			}
		}

		public function ver($id)
		{
			$this->objeto->set("id", $id);
			return $datos=$this->objeto->view();
		}

		public function eliminar($id)
		{
			$this->objeto->set("id", $id);
			$this->objeto->delete();

			header("Location: ".URL."planificacion/index/exito-eliminar");
		}

		public function angular($parametro)
		{
			$array=array();

			$parametro=explode('_', $parametro);

			$consulta=$this->objeto->listar();

			if ($parametro[0]=='lineas')
			{
				$lineas=new Produccion();
				$datos=$lineas->listar();

				while ($arreglo=$datos->fetch(\PDO::FETCH_ASSOC)) {
					$array[]=$arreglo;
				}
			}

			if ($parametro[0]=='editar')
			{
				$datos=$this->ver($parametro[1]);

				while ($arreglo=$datos->fetch(\PDO::FETCH_ASSOC)) {
					$array=array(
						'fecha_produccion' => $arreglo['fecha_produccion'],
						'linea' => $arreglo['id_linea'],
						'estimacion_total' => $arreglo['estimacion_total'],
					);
				}
			}

			if ($parametro[0]=='validar')
			{
				$result=$this->objeto->validacionIndividual($parametro[1], $parametro[2]);
				if ($result->rowCount()==1) {
					if ($parametro[3]) {
						while ($arreglo=$result->fetch(\PDO::FETCH_ASSOC)) {
							if ($arreglo['id']!=$parametro[3]) {
								$array=array(
									'resultadoValidacion' => 'Ya Existe la Planificación',
								);
							} else {
								if ($arreglo['usado']==1) {
									$array=array(
										'resultadoValidacion' => 'Planificación en uso! No se puede modificar',
									);
								}
							}
						}
					} else {
						$array=array(
							'resultadoValidacion' => 'Ya Existe la Planificación',
						);
					}
				}
			}

			echo $json=json_encode($array);
		}
	}
?>
