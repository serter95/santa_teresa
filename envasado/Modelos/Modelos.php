<?php
	namespace Modelos;

	abstract class Modelos
	{
		protected $con;
		
		public function __construct()
		{
			$this->con = new Conexion();
		}
	}
?>