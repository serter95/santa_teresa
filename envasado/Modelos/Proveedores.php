<?php 
	namespace Modelos;

	class Proveedores
	{
		private $id;
		private $nombre;
		private $id_municipio;
		private $direccion;
		private $telefono;
		private $persona_contacto;
		private $con;

		public function __construct()
		{
			$this->con = new Conexion();
		}

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
			return $this->con->seleccionar("*", "proveedor", "estatus=1 ORDER BY nombre ASC");
		}

		public function add()
		{
			$this->con->insertar("proveedor", "nombre, id_municipio, direccion, telefono, persona_contacto", "'{$this->nombre}', '{$this->id_municipio}', '{$this->direccion}', '{$this->telefono}', '{$this->persona_contacto}'");
		}

		public function delete()
		{
			$this->con->actualizar("proveedor", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			$this->con->actualizar("proveedor", "nombre='{$this->nombre}', id_municipio='{$this->id_municipio}', direccion='{$this->direccion}', telefono='{$this->telefono}', persona_contacto='{$this->persona_contacto}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "proveedor", "estatus=1 AND id='{$this->id}'");
		}
	}
?>