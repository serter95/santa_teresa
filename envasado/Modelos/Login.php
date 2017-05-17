<?php 
	namespace Modelos;

	class Login
	{
		private $con;
		public $resultado;
		public $id;
		public $privilegio;
		public $nombre;
		private $pass;

		public function __construct()
		{
			$this->con = new Conexion();

			$this->nombre=trim(strtolower($_POST['usuario']));
		    $this->pass=trim(strtolower($_POST['password']));

			$datos=$this->con->seleccionar("u.id as id_usuario, u.nombre as nombre_usuario, u.contrasena as contrasena_usuario, p.nombre as nombre_privilegio", "usuario u, privilegio p, personal pe", "pe.id=u.id_personal AND u.id_privilegio=p.id AND pe.estatus=1 AND u.estatus=1 AND p.estatus=1");

		    while ($result = $datos->fetch(\PDO::FETCH_ASSOC))
		    {
		        if ($this->nombre==$result['nombre_usuario'] && $this->pass==$result['contrasena_usuario'])
		        {
		        	$this->resultado='BUENO';
		            $this->id=$result['id_usuario'];
		            $this->privilegio=$result['nombre_privilegio'];
		        }
		    }

		    if ($this->resultado=="BUENO")
		    {
		    	session_start();

		        # variables de sesion

		        $_SESSION["mlvamvsdst"]="SI"; // autentificado
		        $_SESSION['usuario']=$this->nombre;
		        $_SESSION['id_usuario']=$this->id;
		        $_SESSION['privilegio']=$this->privilegio;

		        $this->con->actualizar("usuario", "id_linea_seleccionada=NULL", "id='".$_SESSION['id_usuario']."'");

		        header('Location: envasado/');
		    }
		}
	}
?>