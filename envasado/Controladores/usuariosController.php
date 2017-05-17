<?php 
	namespace Controladores;
	use Modelos\Usuarios as Usuarios;

	class usuariosController
	{
		private $con;

		public function __construct()
		{
			$this->con=new Usuarios();
		}
		
		public function index()
		{
			return $this->con->listar();
		}

		public function agregar()
		{
			/*if($_POST)
			{
			
			}*/
		}

		public function editar($id)
		{
			/*if (!$_POST)
			{
				$this->con->set("id",$id);
				return $this->con->view();
			}
			else
			{
				
			}*/
		}

		public function ver($id)
		{
			$this->con->set("id", $id);
			return $this->con->view();
		}

		public function eliminar($id)
		{
			/*$this->con->set("id", $id);
			$this->con->delete();

			header("Location: ".URL."usuario/index/exito-eliminar");*/
		}

		public function angular($parametro)
		{
			/*$valor=explode('.', $parametro);

			#echo "*aqui estoy*";

			$consulta=$this->con->listar();

			if ($consulta->rowCount()>0)
			{
				while ($result = $consulta->fetch(\PDO::FETCH_ASSOC))
				{
					
			    }
			}
			#$resultado="****aqui llega****";
			echo $resultado;*/
		}
	}
?>