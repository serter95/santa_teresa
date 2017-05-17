<?php 
	namespace Controladores;
	use Modelos\Botellas as Botellas;
	use Modelos\Conexion as Conexion;

	class botellasController
	{
		private $con;
		private $conDoble;

		public function __construct()
		{
			$this->con=new Botellas();
			$this->conDoble=new Conexion();
		}

		public function Mayus($variable)
		{
			$variable = strtr(trim(strtoupper($variable)),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
			return $variable;
		}

		public function index()
		{	
			return $this->con->listar();
		}

		public function agregar()
		{
			if($_POST)
			{
				$resultado=$this->con->listar();

				$nombre=$this->Mayus($_POST['nombre']);
				$nombre=str_replace("  ", " ", $nombre);

				if(!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}

				$this->con->set("nombre", $nombre);
				$this->con->set("distribucion", $_POST['distribucion']);
				$this->con->set("id_proveedor", $_POST['proveedor']);
				$this->con->set("id_medida", $_POST['medida']);
				$this->con->set("foto", $_POST['foto']);
				
				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['nombre']==$nombre)
					{
						$errorRegistro='si';
					}
				}
			
				if ($errorRegistro=='si')
				{
					header("Location: ".URL."botellas/index/error-registrar");
				}
				else
				{
					$this->con->add();

					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;
					
					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
						$this->con->set("nombre", $_POST['nombre']);

						$datos=$this->con->listarImagen();

						if ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$array["id"];

							$nombre=$nom[0].".".$nom[1];

							$this->con->set("id", $array["id"]);
							$this->con->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."botellas".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->con->subirImagen();

							header("Location: ".URL."botellas/index/exito-registrar");
						}
					}
					else
					{
						header("Location: ".URL."botellas/index/exito-registrar");
					}
				}
			}
		}

		public function editar($id)
		{
			if (!$_POST)
			{
				$this->con->set("id",$id);
				return $datos=$this->con->view();
			}
			else
			{
				$resultado=$this->con->listar();

				$nombre=$this->Mayus($_POST['nombre']);
				$nombre=str_replace("  ", " ", $nombre);

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}

				$this->con->set("id", $_POST['id']);
				$this->con->set("nombre", $nombre);
				$this->con->set("distribucion", $_POST['distribucion']);
				$this->con->set("id_proveedor", $_POST['proveedor']);
				$this->con->set("id_medida", $_POST['medida']);
				$this->con->set("foto", $_POST['foto']);

				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['nombre']==$nombre && $array['id']!=$_POST['id'])
					{
						$errorRegistro='si';
					}
				}

				if ($errorRegistro=='si')
				{
					header("Location: ".URL."botellas/index/error-modificar");
				}
				else
				{
					$this->con->edit();
				
					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;
					
					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
						$this->con->set("nombre", $_POST['nombre']);

						$datos=$this->con->listarImagen();

						if ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$array["id"];

							$nombre=$nom[0].".".$nom[1];

							$this->con->set("id", $array["id"]);
							$this->con->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."botellas".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->con->subirImagen();

							header("Location: ".URL."botellas/index/exito-modificar");
						}
					}
					else
					{
						header("Location: ".URL."botellas/index/exito-modificar");
					}
				}
			}
		}

		public function ver($id)
		{
			$this->con->set("id", $id);
			return $datos=$this->con->view();
		}

		public function eliminar($id)
		{
			$this->con->set("id", $id);
			$this->con->delete();

			header("Location: ".URL."botellas/index/exito-eliminar");
		}

		public function angular($parametro)
		{
			$array=array();

			$parametro=explode('_', $parametro);

			$consulta=$this->con->listar();

			if ($parametro[0]=='nombre')
			{
				$nombre=str_replace("  ", " ", $parametro[1]);

				while ($result = $consulta->fetch(\PDO::FETCH_ASSOC))
				{
					if ($parametro[2])
					{
						if ($this->Mayus($nombre)==$result['nombre'] && $parametro[2]!=$result['id'])
						{
							$array[]=1;
						}
					}
					else
					{
						if ($this->Mayus($nombre)==$result['nombre'])
						{
							$array[]=1;
						}
					}
			    }
			}

			if ($parametro[0]=='proveedores')
			{
				$data=$this->conDoble->seleccionar("id, nombre", "proveedor", "estatus=1 ORDER BY nombre ASC");

				while ($result = $data->fetch(\PDO::FETCH_ASSOC))
				{
					$array[]=$result;
			    }
			}

			if ($parametro[0]=='medidas')
			{
				$data=$this->conDoble->seleccionar("id, tipo", "medidas", "estatus=1 ORDER BY tipo ASC");

				while ($result = $data->fetch(\PDO::FETCH_ASSOC))
				{
					$array[]=$result;
			    }
			}

			if ($parametro[0]=='editar')
			{
				$this->con->set("id",$parametro[1]);
				$consulta=$this->con->view();

				while ($result = $consulta->fetch(\PDO::FETCH_ASSOC))
				{
					$array=array(
						"nombre"=>$result['nombre'],
						"distribucion"=>$result['distribucion'],
						"proveedor"=>$result['id_proveedor'],
						"medida"=>$result['id_medida'],
						);
			    }
			}

			echo $json=json_encode($array);
		}
	}
?>