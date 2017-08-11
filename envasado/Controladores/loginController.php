<?php
	namespace Controladores;
	use Modelos\Login as Login;

	class loginController
	{
		private $objeto;

		public function __construct()
		{
			$this->objeto=new Login();
		}

		public function index()
		{
			if($_POST)
			{
				$this->objeto->set('nombre', $_POST['usuario']);
				$this->objeto->set('pass', $_POST['password']);

				$datos=$this->objeto->validar();

				while ($result = $datos->fetch(\PDO::FETCH_ASSOC))
			  {
	        if ($this->objeto->get('nombre')==$result['nombre_usuario'] && $this->objeto->get('pass')==$result['contrasena_usuario'])
	        {
	        	$this->objeto->set('resultado', 'bueno');
	          $this->objeto->set('id', $result['id_usuario']);
	          $this->objeto->set('privilegio', $result['nombre_privilegio']);
	        }
			  }

		    if ($this->objeto->get('resultado')=="bueno")
		    {
		    	session_start();

		        # variables de sesion

		        $_SESSION["mlvamvsdst"]="SI"; // autentificado
		        $_SESSION['usuario']=$this->objeto->get('nombre');
		        $_SESSION['id_usuario']=$this->objeto->get('id');
		        $_SESSION['privilegio']=$this->objeto->get('privilegio');

		        $this->objeto->con->actualizar("usuario", "id_linea_seleccionada=NULL", "id='".$_SESSION['id_usuario']."'");

		        header('Location: envasado/');
			    }
			    else
			    {
			    	return false;
			    }
			}
		}
	}
?>
