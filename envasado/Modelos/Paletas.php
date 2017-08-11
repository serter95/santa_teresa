<?php
	namespace Modelos;

	class Paletas extends Modelos implements Interfaz
	{
		private $id;
		private $nombre;
		private $bulk;
		private $cantidad_bulks;
		private $foto;
		private $id_botella;

		public function set($atributo, $valor) {
			$this->$atributo=$valor;
		}

		public function get($atributo)
		{
			return $this->$atributo;
		}

		public function listar()
		{
			return $this->con->seleccionar("*", "paleta", "estatus=1 ORDER BY nombre ASC");
		}

		public function add()
		{
			$this->con->insertar("paleta", "nombre, bulk, cantidad_bulks, id_botella", "'{$this->nombre}', '{$this->bulk}', '{$this->cantidad_bulks}', '{$this->id_botella}'");
		}

		public function listarImagen()
		{
			return $this->con->seleccionar("*","paleta","nombre='{$this->nombre}' AND estatus=1 LIMIT 1");
		}

		public function subirImagen()
		{
			$this->con->actualizar("paleta", "foto='{$this->foto}'", "id='{$this->id}'");
		}

		public function delete()
		{
			$this->con->actualizar("paleta", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			$this->con->actualizar("paleta", "nombre='{$this->nombre}', bulk='{$this->bulk}', cantidad_bulks='{$this->cantidad_bulks}', id_botella='{$this->id_botella}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "paleta", "id='{$this->id}'");
		}
	}
?>
