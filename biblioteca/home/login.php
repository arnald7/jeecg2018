<?php
	session_start();
	require_once("../define.php");
	require_once(CL_USUARIO);
	
	$user = new Usuario(); 
	if($user->logarUsuario($_POST["login"], md5($_POST["senha"])))
		{
	  		//$user->redirect('home.php');
	  		header('Location: index.php');
		}
	else
		{
	  		echo "Wrong Login!";
	  		echo '<br><a href="logout.php">Logout</a>';
		} 

?>