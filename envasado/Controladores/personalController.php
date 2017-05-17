<?php 
	namespace Controladores;
	use Modelos\Personal as Personal;

	class personalController
	{
		private $personal;

		public function __construct()
		{
			$this->personal=new Personal();
		}
		
		public function Mayus($variable)
		{
			$variable = strtr(trim(strtoupper($variable)),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
			return $variable;
		}

		public function index()
		{	
			return $datos=$this->personal->listar();
		}

		public function agregar()
		{
			if($_POST)
			{
				$ci=trim($_POST['cedula']);

				if (!preg_match("/^[0-9]{7,9}/", $ci))
				{
				    $errorRegistro='si';
				}

				$cont=strlen($ci);

				if ($cont==7)
				{
					$ci="0".$ci;
				}

				$cedula=$_POST['nacionalidad'].$ci;
				
				$resultado=$this->personal->listar();

				$this->personal->set("numeroPersonal", trim($_POST['numeroPersonal']));
				$this->personal->set("cedula", $cedula);
				$this->personal->set("nombres", $this->Mayus($_POST['nombres']));
				$this->personal->set("apellidos", $this->Mayus($_POST['apellidos']));
				$this->personal->set("departamento", $_POST['departamento']);
				$this->personal->set("cargo", $_POST['cargo']);
				$this->personal->set("estado", $_POST['estado']);
				$this->personal->set("jornada", $_POST['jornada']);

				if (!preg_match("/^[0-9]{5,6}/", $this->personal->get("numeroPersonal")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->personal->get("nombres")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->personal->get("apellidos")))
				{
				    $errorRegistro='si';
				}

				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['numero_personal']==$this->personal->get("numeroPersonal") || $array['cedula']==$this->personal->get('cedula'))
					{
						$errorRegistro='si';
					}
				}

				if ($errorRegistro=='si')
				{
					header("Location: ".URL."personal/index/error-registrar");
				}
				else
				{
					$this->personal->add();
				
					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;
					
					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
						$this->personal->set("numeroPersonal", $_POST['numeroPersonal']);
						$this->personal->set("cedula", $cedula);

						$datos=$this->personal->listarImagen();

						if ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$array["id"];

							$nombre=$nom[0].".".$nom[1];

							$this->personal->set("id", $array["id"]);
							$this->personal->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."avatars".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->personal->subirImagen();

							header("Location: ".URL."personal/index/exito-registrar");
						}
					}
					else
					{
						header("Location: ".URL."personal/index/exito-registrar");
					}
				}
			}
		}

		public function editar($id)
		{
			if (!$_POST)
			{
				$this->personal->set("id",$id);
				return $datos=$this->personal->view();
			}
			else
			{
				$ci=trim($_POST['cedula']);

				if (!preg_match("/^[0-9]{7,9}/", $ci))
				{
				    $errorRegistro='si';
				}

				$cont=strlen($ci);

				if ($cont==7)
				{
					$ci="0".$ci;
				}

				$cedula=$_POST['nacionalidad'].$ci;
				
				$resultado=$this->personal->listar();

				$this->personal->set("id", $_POST['id']);
				$this->personal->set("numeroPersonal", trim($_POST['numeroPersonal']));
				$this->personal->set("cedula", $cedula);
				$this->personal->set("nombres", $this->Mayus($_POST['nombres']));
				$this->personal->set("apellidos", $this->Mayus($_POST['apellidos']));
				$this->personal->set("departamento", $_POST['departamento']);
				$this->personal->set("cargo", $_POST['cargo']);
				$this->personal->set("estado", $_POST['estado']);
				$this->personal->set("jornada", $_POST['jornada']);

				if (!preg_match("/^[0-9]{5,6}/", $this->personal->get("numeroPersonal")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->personal->get("nombres")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->personal->get("apellidos")))
				{
				    $errorRegistro='si';
				}

				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['numero_personal']==$this->personal->get("numeroPersonal") && $array['id']!=$this->personal->get('id'))
					{
						$errorRegistro='si';
					}

					if ($array['cedula']==$this->personal->get('cedula') && $array['id']!=$this->personal->get('id'))
					{
						$errorRegistro='si';
					}
				}

				if ($errorRegistro=='si')
				{
					header("Location: ".URL."personal/index/error-modificar");
				}
				else
				{
					$this->personal->edit();

					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;
					
					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$id;

							$nombre=$nom[0].".".$nom[1];

							$this->personal->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."avatars".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->personal->subirImagen();

							header("Location: ".URL."personal/index/exito-modificar");
					}
					else
					{
						header("Location: ".URL."personal/index/exito-modificar");
					}
				}
			}
		}

		public function ver($id)
		{
			$this->personal->set("id", $id);
			return $datos=$this->personal->view();
		}

		public function eliminar($id)
		{
			$this->personal->set("id", $id);
			$this->personal->delete();

			header("Location: ".URL."personal/index/exito-eliminar");
		}

		public function angular($parametro)
		{
			$valor=explode('.', $parametro);

			#echo "*aqui estoy*";

			$consulta=$this->personal->listar();

			if ($consulta->rowCount()>0)
			{
				while ($result = $consulta->fetch(\PDO::FETCH_ASSOC))
				{
					if ($valor[2]=='agregar')
					{
						if ($valor[1]=='numero_personal')
						{
							if ($result['numero_personal']==trim($valor[0]))
					        {
					        	$resultado=1;
					        }
						}

						if ($valor[1]=='cedula')
						{
							$ci=explode('-', $valor[0]);
							
							$cont=strlen($ci[1]);

							if ($cont==7)
							{
								$valor[0]=$ci[0]."-0".$ci[1];
							}

							if ($result['cedula']==strtoupper(trim($valor[0])))
					        {
					        	$resultado=1;
					        }
						}
					}

					if ($valor[2]=='editar')
					{
						if ($valor[1]=='numero_personal')
						{
							if ($result['numero_personal']==trim($valor[0]) && $result['id']!=$valor[3])
					        {
					        	$resultado=1;
					        }
						}

						if ($valor[1]=='cedula')
						{
							$ci=explode('-', $valor[0]);
							
							$cont=strlen($ci[1]);

							if ($cont==7)
							{
								$valor[0]=$ci[0]."-0".$ci[1];
							}

							if ($result['cedula']==strtoupper(trim($valor[0])) && $result['id']!=$valor[3])
					        {
					        	$resultado=1;
					        }
						}
					}
			    }
			}
			echo $resultado;
		}
	}

	$personal=new personalController();
?>