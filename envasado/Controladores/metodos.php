<?php
	namespace Controladores;

	interface metodos {
		public function index();
		public function agregar();
		public function editar($id);
		public function ver($id);
		public function eliminar($id);
		public function angular($parametro);
	}
?>
