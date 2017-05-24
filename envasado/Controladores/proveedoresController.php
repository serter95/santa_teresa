<?php 
	namespace Controladores;
	use Modelos\Proveedores as Proveedores;
	
	class proveedoresController extends controlador implements metodos
	{
		private $objeto;

		public function __construct()
		{
			$this->objeto=new Proveedores();
		}
		
		public function index()
		{
			return $this->objeto->listar();
		}

		public function agregar()
		{
			if($_POST)
			{
				$nombre=$this->Mayus($_POST['nombre']);
				$nombre=str_replace("  ", " ", $nombre);
				$direccion=$this->Mayus($_POST['direccion']);
				$codigo=trim($_POST['codigo']);
				$numero=trim($_POST['numero']);
				$contacto=$this->Mayus($_POST['contacto']);

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9 \.]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9 \.,_-]{10,}/", $direccion))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[0-9]{4}/", $codigo))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[0-9]{7}/", $numero))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $contacto))
				{
					$errorRegistro='si';
				}

				$telefono=$codigo.'-'.$numero;

				$this->objeto->set("nombre", $nombre);
				$this->objeto->set("id_municipio", $_POST['municipio']);
				$this->objeto->set("direccion", $direccion);
				$this->objeto->set("telefono", $telefono);
				$this->objeto->set("persona_contacto", $contacto);
				
				$data=$this->objeto->listar();

				while ($array = $data->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['nombre']==$this->objeto->get("nombre"))
					{
						$errorRegistro='si';
					}
			    }

				if ($errorRegistro=='si')
				{
					header("Location: ".URL."proveedores/index/error-registrar");
				}
				else
				{
					$this->objeto->add();
					header("Location: ".URL."proveedores/index/exito-registrar");
				}
			}
		}

		public function editar($id)
		{
			if (!$_POST)
			{
				$this->objeto->set("id",$id);
				return $this->objeto->view();
			}
			else
			{
				$nombre=$this->Mayus($_POST['nombre']);
				$nombre=str_replace("  ", " ", $nombre);
				$direccion=$this->Mayus($_POST['direccion']);
				$codigo=trim($_POST['codigo']);
				$numero=trim($_POST['numero']);
				$contacto=$this->Mayus($_POST['contacto']);

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9 \.]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9 \.,_-]{10,}/", $direccion))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[0-9]{4}/", $codigo))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[0-9]{7}/", $numero))
				{
					$errorRegistro='si';
				}
				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $contacto))
				{
					$errorRegistro='si';
				}

				$telefono=$codigo.'-'.$numero;

				$this->objeto->set("id", $_POST['id']);
				$this->objeto->set("nombre", $nombre);
				$this->objeto->set("id_municipio", $_POST['municipio']);
				$this->objeto->set("direccion", $direccion);
				$this->objeto->set("telefono", $telefono);
				$this->objeto->set("persona_contacto", $contacto);
				
				$data=$this->objeto->listar();

				while ($array = $data->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['nombre']==$this->objeto->get("nombre") && $array['id']!=$_POST['id'])
					{
						$errorRegistro='si';
					}
			    }

				if ($errorRegistro=='si')
				{
					header("Location: ".URL."proveedores/index/error-modificar");
				}
				else
				{
					$this->objeto->edit();
					header("Location: ".URL."proveedores/index/exito-modificar");
				}
			}
		}

		public function ver($id)
		{
			$this->objeto->set("id", $id);
			return $this->objeto->view();
		}

		public function eliminar($id)
		{
			$this->objeto->set("id", $id);
			$this->objeto->delete();

			header("Location: ".URL."proveedores/index/exito-eliminar");
		}

		public function angular($parametro)
		{
			$array=array();

			$parametro=explode('_', $parametro);

			if ($parametro[0]=='estados')
			{
				$data=$this->objeto->con->seleccionar("*","estados","estatus=1 ORDER BY nombre ASC");

				if ($data->rowCount()>0)
				{
					while ($result = $data->fetch(\PDO::FETCH_ASSOC))
					{
						$array[]=$result;
				    }
				}
			}
			if (is_numeric($parametro[0]))
			{
				$data=$this->objeto->con->seleccionar("*","municipios","estatus=1 AND id_estado=".$parametro[0]." ORDER BY nombre ASC");

				if ($data->rowCount()>0)
				{
					while ($result = $data->fetch(\PDO::FETCH_ASSOC))
					{
						$array[]=$result;
				    }
				}
			}
			if ($parametro[0]=='nombre')
			{
				$data=$this->objeto->listar();

				if ($data->rowCount()>0)
				{
					$str = str_replace('  ', ' ', $parametro[1]);

					while ($result = $data->fetch(\PDO::FETCH_ASSOC))
					{
						if ($parametro[2])
						{
							if ($this->Mayus($str)==$result['nombre'] && $parametro[2]!=$result['id'])
							{
								$array[]=1;
							}
						}
						else
						{
							if ($this->Mayus($str)==$result['nombre'])
							{
								$array[]=1;
							}
						}	
				    }
				}
			}
			if ($parametro[0]=='buscar-municipio-editar')
			{
				$sql=$this->objeto->con->seleccionar("m.id_estado as estado", "proveedor p, municipios m",
					"p.id_municipio=m.id AND p.estatus=1 AND m.estatus=1 AND p.id='".$parametro[1]."'");
				
				$result = $sql->fetch(\PDO::FETCH_ASSOC);
				
				$sql2=$this->objeto->con->seleccionar("*","municipios","id_estado='".$result['estado']."'");
				
				while ($resultado = $sql2->fetch(\PDO::FETCH_ASSOC))
				{
					$array[]=$resultado;
				}
			}
			if ($parametro[0]=='editar')
			{
				$this->objeto->set("id", $parametro[1]);
				$data=$this->objeto->view();

				if ($data->rowCount()>0)
				{
					while ($result = $data->fetch(\PDO::FETCH_ASSOC))
					{
						$sql=$this->objeto->con->seleccionar("e.id as estado","estados e, municipios m, proveedor p","p.id_municipio=m.id AND e.id=m.id_estado AND e.estatus=1 AND m.estatus=1 AND p.estatus=1 AND p.id='".$parametro[1]."'");
						$query = $sql->fetch(\PDO::FETCH_ASSOC);

						$telf=explode('-', $result['telefono']);

						$array = array(
							"nombre" => $result['nombre'],
							"estado" => $query["estado"],
							"municipio" => $result['id_municipio'],
							"direccion" => $result['direccion'],
							"codigo" => $telf[0],
							"numero" => $telf[1],
							"contacto" => $result['persona_contacto'],
						);
				    }
				}
			}

			$json=json_encode($array);
			echo $json;

			//echo $parametro[1];
		}
	}
?>