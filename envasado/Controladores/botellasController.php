<?php
	namespace Controladores;
	use Modelos\Botellas as Botellas;

	class botellasController extends controlador implements metodos
	{
		private $objeto;

		public function __construct()
		{
			$this->objeto=new Botellas();
		}

		public function index()
		{
			return $this->objeto->listar();
		}

		public function agregar()
		{
			if($_POST)
			{
				$resultado=$this->objeto->listar();

				$nombre=$this->Mayus($_POST['nombre']);
				$nombre=str_replace("  ", " ", $nombre);

				if(!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}

				$this->objeto->set("nombre", $nombre);
				$this->objeto->set("distribucion", $_POST['distribucion']);
				$this->objeto->set("id_proveedor", $_POST['proveedor']);
				$this->objeto->set("id_medida", $_POST['medida']);
				$this->objeto->set("foto", $_POST['foto']);

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
					$this->objeto->add();

					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;

					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
						$this->objeto->set("nombre", $_POST['nombre']);

						$datos=$this->objeto->listarImagen();

						if ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$array["id"];

							$nombre=$nom[0].".".$nom[1];

							$this->objeto->set("id", $array["id"]);
							$this->objeto->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."botellas".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->objeto->subirImagen();

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
				$this->objeto->set("id",$id);
				return $datos=$this->objeto->view();
			}
			else
			{
				$resultado=$this->objeto->listar();

				$nombre=$this->Mayus($_POST['nombre']);
				$nombre=str_replace("  ", " ", $nombre);

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}

				$this->objeto->set("id", $_POST['id']);
				$this->objeto->set("nombre", $nombre);
				$this->objeto->set("distribucion", $_POST['distribucion']);
				$this->objeto->set("id_proveedor", $_POST['proveedor']);
				$this->objeto->set("id_medida", $_POST['medida']);
				$this->objeto->set("foto", $_POST['foto']);

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
					$this->objeto->edit();

					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;

					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
						$this->objeto->set("nombre", $_POST['nombre']);

						$datos=$this->objeto->listarImagen();

						if ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$array["id"];

							$nombre=$nom[0].".".$nom[1];

							$this->objeto->set("id", $array["id"]);
							$this->objeto->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."botellas".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->objeto->subirImagen();

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
			$this->objeto->set("id", $id);
			return $datos=$this->objeto->view();
		}

		public function eliminar($id)
		{
			$this->objeto->set("id", $id);
			$this->objeto->delete();

			header("Location: ".URL."botellas/index/exito-eliminar");
		}

		public function angular($parametro)
		{
			$array=array();

			$parametro=explode('_', $parametro);

			$consulta=$this->objeto->listar();

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
				$data=$this->objeto->con->seleccionar("id, nombre", "proveedor", "estatus=1 ORDER BY nombre ASC");

				while ($result = $data->fetch(\PDO::FETCH_ASSOC))
				{
					$array[]=$result;
			    }
			}

			if ($parametro[0]=='medidas')
			{
				$data=$this->objeto->con->seleccionar("id, tipo", "medidas", "estatus=1 ORDER BY tipo ASC");

				while ($result = $data->fetch(\PDO::FETCH_ASSOC))
				{
					$array[]=$result;
			    }
			}

			if ($parametro[0]=='editar')
			{
				$this->objeto->set("id",$parametro[1]);
				$consulta=$this->objeto->view();

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
