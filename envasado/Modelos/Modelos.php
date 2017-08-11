<?php
	namespace Modelos;

	abstract class Modelos
	{
		public $con;

		public function __construct() {
			$this->con = new Conexion();
		}
	}
?>
