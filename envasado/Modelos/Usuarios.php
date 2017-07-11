<?php 
	namespace Modelos;

	class Usuarios extends Modelos implements Interfaz
	{
		private $id;
		private $nombre;
		private $contrasena;
		private $pregunta;
		private $respuesta;
		private $bloqueo;
		private $resolucion;
		private $id_personal;
		private $id_privilegio;

		public function set($atributo, $valor)
		{
			$this->$atributo=$valor;
		}

		public function get($atributo)
		{
			return $this->$atributo;
		}

		public function listar()
		{
			return $this->con->seleccionar("*", "usuario", "estatus=1 ORDER BY nombre ASC");
		}

		public function add()
		{
			$this->con->insertar("usuario", "nombre, contrasena, pregunta, respuesta, id_personal, id_privilegio", "'{$this->nombre}', '{$this->contrasena}', '{$this->pregunta}', '{$this->respuesta}', '{$this->id_personal}', '{$this->id_privilegio}'");
		}

		public function delete()
		{
			$this->con->actualizar("usuario", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			
			$this->con->actualizar("usuario", "nombre='{$this->nombre}', contrasena='{$this->contrasena}', pregunta='{$this->pregunta}', respuesta='{$this->respuesta}', id_personal='{$this->id_personal}', id_privilegio='{$this->id_privilegio}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "usuario", "estatus=1 AND id='{$this->id}'");
		}
	}
?>