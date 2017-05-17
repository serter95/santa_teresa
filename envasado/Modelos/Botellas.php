<?php 
	namespace Modelos;

	class Botellas
	{
		private $id;
		private $nombre;
		private $distribucion;
		private $id_proveedor;
		private $id_medida;
		private $foto;
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
			return $this->con->seleccionar("*", "botellas", "estatus=1 ORDER BY nombre ASC");
		}

		public function add()
		{
			$this->con->insertar("botellas", "nombre, distribucion, id_proveedor, id_medida", "'{$this->nombre}', '{$this->distribucion}', '{$this->id_proveedor}', '{$this->id_medida}'");
		}

		public function listarImagen()
		{
			return $this->con->seleccionar("*","botellas","nombre='{$this->nombre}' AND estatus=1 LIMIT 1");
		}

		public function subirImagen()
		{
			$this->con->actualizar("botellas", "foto='{$this->foto}'", "id='{$this->id}'");
		}

		public function delete()
		{
			$this->con->actualizar("botellas", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			$this->con->actualizar("botellas", "nombre='{$this->nombre}', distribucion='{$this->distribucion}', id_proveedor='{$this->id_proveedor}', id_medida='{$this->id_medida}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "botellas", "estatus=1 AND id='{$this->id}'");
		}
	}
?>