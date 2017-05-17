<?php 
	namespace Modelos;

	class Validar
	{
		public function __construct()
		{
			session_start();

			if ($_SESSION["mlvamvsdst"]!="SI")
			{
				session_unset();
				session_destroy();
				header('Location:http://localhost/santa_teresa');
			}
		}
	}
?>