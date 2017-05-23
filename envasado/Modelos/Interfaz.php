<?php
	namespace Modelos;

	interface Interfaz
	{
		public function set($atributo, $valor);
		public function get($atributo);
		public function listar();
		public function add();
		public function edit();
		public function view();
		public function delete();
	}
?>