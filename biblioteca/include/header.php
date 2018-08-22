<?php 
	session_start();
	if (!isset($_SESSION["ID_USUARIO"])) { header("Location: ../index.php"); }

	require_once("../define.php");
	require_once(CL_USUARIO);
	require_once(CL_INSCRITOS);
 ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
    <link   href="../css/custom.css" rel="stylesheet">
    <!--<link   href="../css/bootstrap.min.css" rel="stylesheet">
     <script src="../js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<title>JEET CG - 2018 - Cadastro</title>
</head>
<body>

	<div class="conteiner">

		<div class="menu">
			<a href="index.php">Home</a> | 
			<a href="cadastro.php">Cadastrar</a> | 
			<a href="logout.php">logoff</a>			
		</div>

		<?php include('../include/search.php'); ?>