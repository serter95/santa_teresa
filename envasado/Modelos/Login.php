<?php 
	namespace Modelos;

	class Login extends Modelos
	{
		//private $con;
		private $resultado;
		private $id;
		private $privilegio;
		private $nombre;
		private $pass;

		public function set($atributo, $valor)
		{
			$this->$atributo=trim(strtolower($valor));
		}

		public function get($atributo)
		{
			return $this->$atributo;
		}

		public function validar()
		{
			return $this->con->seleccionar("u.id as id_usuario, u.nombre as nombre_usuario, u.contrasena as contrasena_usuario, p.nombre as nombre_privilegio", "usuario u, privilegio p, personal pe", "pe.id=u.id_personal AND u.id_privilegio=p.id AND pe.estatus=1 AND u.estatus=1 AND p.estatus=1");
		}
	}
?>