<?php 
	namespace Modelos;

	class Etiquetas extends Modelos implements Interfaz
	{
		private $id;
		private $nombre;
		private $medida;
		private $foto;
		private $id_proveedor;

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
			return $this->con->seleccionar("*", "etiqueta", "estatus=1 ORDER BY nombre ASC");
		}

		public function add()
		{
			$this->con->insertar("etiqueta", "nombre, medida, id_proveedor", "'{$this->nombre}', '{$this->medida}', '{$this->id_proveedor}'");
		}

		public function listarImagen()
		{
			return $this->con->seleccionar("*","etiqueta","nombre='{$this->nombre}' AND estatus=1 LIMIT 1");
		}

		public function subirImagen()
		{
			$this->con->actualizar("etiqueta", "foto='{$this->foto}'", "id='{$this->id}'");
		}

		public function delete()
		{
			$this->con->actualizar("etiqueta", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			$this->con->actualizar("etiqueta", "nombre='{$this->nombre}', medida='{$this->medida}', id_proveedor='{$this->id_proveedor}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "etiqueta", "id='{$this->id}'");
		}
	}
?>