<?php 
	namespace Modelos;
	
	class Salir
	{
		function __construct()
		{
			session_start();

			session_unset();
			session_destroy();

			header("Location:".URL_VALIDAR);
		}
	}
?>