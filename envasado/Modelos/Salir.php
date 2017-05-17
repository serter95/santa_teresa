<?php 
	namespace Modelos;
	
	class Salir
	{
		function __construct()
		{
			session_start();

			session_unset();
			session_destroy();

			header("Location: http://".$_SERVER['HTTP_HOST']."/santa_teresa");
		}
	}
?>