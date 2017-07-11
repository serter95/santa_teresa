<?php 
	namespace Modelos;

	class Cajas extends Modelos implements Interfaz
	{
		private $id;
		private $nombre;
		private $medida;
		private $cantidad_botellas;
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
			return $this->con->seleccionar("*", "cajas", "estatus=1 ORDER BY nombre ASC");
		}

		public function add()
		{
			$this->con->insertar("cajas", "nombre, medida, cantidad_botellas, id_proveedor", "'{$this->nombre}', '{$this->medida}', '{$this->cantidad_botellas}', '{$this->id_proveedor}'");
		}

		public function listarImagen()
		{
			return $this->con->seleccionar("*","cajas","nombre='{$this->nombre}' AND estatus=1 LIMIT 1");
		}

		public function subirImagen()
		{
			$this->con->actualizar("cajas", "foto='{$this->foto}'", "id='{$this->id}'");
		}

		public function delete()
		{
			$this->con->actualizar("cajas", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			$this->con->actualizar("cajas", "nombre='{$this->nombre}', medida='{$this->medida}', cantidad_botellas='{$this->cantidad_botellas}', id_proveedor='{$this->id_proveedor}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "cajas", "id='{$this->id}'");
		}
	}
?>