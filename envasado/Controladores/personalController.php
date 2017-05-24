<?php 
	namespace Controladores;
	use Modelos\Personal as Personal;

	class personalController extends controlador implements metodos
	{
		private $objeto;

		public function __construct()
		{
			$this->objeto=new Personal();
		}

		public function index()
		{	
			return $this->objeto->listar();
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
				
				$resultado=$this->objeto->listar();

				$this->objeto->set("numeroPersonal", trim($_POST['numeroPersonal']));
				$this->objeto->set("cedula", $cedula);
				$this->objeto->set("nombres", $this->Mayus($_POST['nombres']));
				$this->objeto->set("apellidos", $this->Mayus($_POST['apellidos']));
				$this->objeto->set("departamento", $_POST['departamento']);
				$this->objeto->set("cargo", $_POST['cargo']);
				$this->objeto->set("estado", $_POST['estado']);
				$this->objeto->set("jornada", $_POST['jornada']);

				if (!preg_match("/^[0-9]{5,6}/", $this->objeto->get("numeroPersonal")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->objeto->get("nombres")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->objeto->get("apellidos")))
				{
				    $errorRegistro='si';
				}

				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['numero_personal']==$this->objeto->get("numeroPersonal") || $array['cedula']==$this->objeto->get('cedula'))
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
					$this->objeto->add();
				
					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;
					
					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
						$this->objeto->set("numeroPersonal", $_POST['numeroPersonal']);
						$this->objeto->set("cedula", $cedula);

						$datos=$this->objeto->listarImagen();

						if ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$array["id"];

							$nombre=$nom[0].".".$nom[1];

							$this->objeto->set("id", $array["id"]);
							$this->objeto->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."avatars".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->objeto->subirImagen();

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
				$this->objeto->set("id",$id);
				return $datos=$this->objeto->view();
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
				
				$resultado=$this->objeto->listar();

				$this->objeto->set("id", $_POST['id']);
				$this->objeto->set("numeroPersonal", trim($_POST['numeroPersonal']));
				$this->objeto->set("cedula", $cedula);
				$this->objeto->set("nombres", $this->Mayus($_POST['nombres']));
				$this->objeto->set("apellidos", $this->Mayus($_POST['apellidos']));
				$this->objeto->set("departamento", $_POST['departamento']);
				$this->objeto->set("cargo", $_POST['cargo']);
				$this->objeto->set("estado", $_POST['estado']);
				$this->objeto->set("jornada", $_POST['jornada']);

				if (!preg_match("/^[0-9]{5,6}/", $this->objeto->get("numeroPersonal")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->objeto->get("nombres")))
				{
				    $errorRegistro='si';
				}

				if (!preg_match("/^[A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,}( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?( [A-Za-záéíóúñüÁÉÍÓÚÑÜ]{2,})?)?/", $this->objeto->get("apellidos")))
				{
				    $errorRegistro='si';
				}

				while ($array=$resultado->fetch(\PDO::FETCH_ASSOC))
				{
					if ($array['numero_personal']==$this->objeto->get("numeroPersonal") && $array['id']!=$this->objeto->get('id'))
					{
						$errorRegistro='si';
					}

					if ($array['cedula']==$this->objeto->get('cedula') && $array['id']!=$this->objeto->get('id'))
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
					$this->objeto->edit();

					$permitidos=array("image/jpeg","image/png","image/jpg");
					$limite=700;
					
					if (in_array($_FILES['foto']["type"], $permitidos) && $_FILES["foto"]["size"]<=$limite*1024)
					{
							$nom=explode('.', $_FILES['foto']['name']);
							$nom[0]=$id;

							$nombre=$nom[0].".".$nom[1];

							$this->objeto->set("foto", $nombre);

							$ruta="Vistas".DS."template".DS."imagenes".DS."avatars".DS.$nombre;
							move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

							$this->objeto->subirImagen();

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
			$this->objeto->set("id", $id);
			return $datos=$this->objeto->view();
		}

		public function eliminar($id)
		{
			$this->objeto->set("id", $id);
			$this->objeto->delete();

			header("Location: ".URL."personal/index/exito-eliminar");
		}

		public function angular($parametro)
		{
			$valor=explode('.', $parametro);

			#echo "*aqui estoy*";

			$consulta=$this->objeto->listar();

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