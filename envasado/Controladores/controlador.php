<?php
	namespace Controladores;
	
	abstract class controlador
	{
		protected function Mayus($variable)
		{
			$variable = strtr(trim(strtoupper($variable)),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
			return $variable;
		}
	}
?>