<?php
	require_once("../define.php");
	class Banco 
	{
		public function dbConnect()
		{
		// 	return new PDO("mysql:host=localhost;dbname=grupoesp_biblioteca", "grupoesp_user", "getjesus@481");
			return new PDO('mysql:host='.HOST.';dbname='.DATABASE, USUARIO, SENHA);  	
		//	return new PDO("mysql:host=localhost;dbname=biblioteca", "root", "root");
		}

	}
?>