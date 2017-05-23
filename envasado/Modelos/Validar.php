<?php 
	namespace Modelos;

	class Validar
	{
		public static function index()
		{
			session_start();

			if ($_SESSION["mlvamvsdst"]!="SI")
			{
				session_unset();
				session_destroy();
				header('Location:http://'.$_SERVER['HTTP_HOST'].'/santa_teresa');
			}
		}
	}
?>