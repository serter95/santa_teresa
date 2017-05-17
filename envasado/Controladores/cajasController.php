<?php 
	namespace Controladores;
	use Modelos\Cajas as Cajas;
	use Modelos\Conexion as Conexion;

	class cajasController
	{
		private $con;
		private $con2;

		public function __construct()
		{
			$this->con=new Cajas();
			$this->con2=new Conexion();
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

				$medida=$this->Mayus($_POST['medida']);
				$medida=str_replace("  ", " ", $medida);

				$cantidad_botellas=$this->Mayus($_POST['cantidad_botellas']);

				if(!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}

				if(!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $medida))
				{
					$errorRegistro='si';
				}

				if(!preg_match("/^[0-9]{1,2}/", $cantidad_botellas))
				{
					$errorRegistro='si';
				}

				$this->con->set("nombre", $nombre);
				$this->con->set("medida", $medida);
				$this->con->set("cantidad_botellas", $cantidad_botellas);
				$this->con->set("id_proveedor", $_POST['proveedor']);
				
				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['nombre']==$nombre)
					{
						$errorRegistro='si';
					}
				}
			
				if ($errorRegistro=='si')
				{
					header("Location: ".URL."cajas/index/error-registrar");
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

							$ruta="Vistas".DS."template".DS."imagenes".DS."cajas".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->con->subirImagen();

							header("Location: ".URL."cajas/index/exito-registrar");
						}
					}
					else
					{
						header("Location: ".URL."cajas/index/exito-registrar");
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

				$medida=$this->Mayus($_POST['medida']);
				$medida=str_replace("  ", " ", $medida);

				$cantidad_botellas=$this->Mayus($_POST['cantidad_botellas']);

				if(!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $nombre))
				{
					$errorRegistro='si';
				}

				if(!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ 0-9]{5,}/", $medida))
				{
					$errorRegistro='si';
				}

				if(!preg_match("/^[0-9]{1,2}/", $cantidad_botellas))
				{
					$errorRegistro='si';
				}

				$this->con->set("id", $_POST['id']);
				$this->con->set("nombre", $nombre);
				$this->con->set("medida", $medida);
				$this->con->set("cantidad_botellas", $cantidad_botellas);
				$this->con->set("id_proveedor", $_POST['proveedor']);
				

				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['nombre']==$nombre && $array['id']!=$_POST['id'])
					{
						$errorRegistro='si';
					}
				}

				if ($errorRegistro=='si')
				{
					header("Location: ".URL."cajas/index/error-modificar");
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

							$ruta="Vistas".DS."template".DS."imagenes".DS."cajas".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->con->subirImagen();

							header("Location: ".URL."cajas/index/exito-modificar");
						}
					}
					else
					{
						header("Location: ".URL."cajas/index/exito-modificar");
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

			header("Location: ".URL."cajas/index/exito-eliminar");
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
				$data=$this->con2->seleccionar("id, nombre", "proveedor", "estatus=1 ORDER BY nombre ASC");

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
						"medida"=>$result['medida'],
						"cantidad_botellas"=>$result['cantidad_botellas'],
						"proveedor"=>$result['id_proveedor'],
						);
			    }
			}

			echo $json=json_encode($array);
		}
	}
?>