<?php 

//database connection


/* BANCO DE DADOS */

$hostname = "localhost";
$userDB = "xxxxxxxxxx";
$passwordDB = "xxxxxxxx";
$database = "xxxxxxxxxx";



function dbCon(){

	global $hostname, $userDB, $passwordDB, $database, $db;
	$db = mysqli_connect($hostname, $userDB, $passwordDB, $database ) or die (mysqli_error($db));

	mysqli_query($db,"SET NAMES 'utf8'");
	mysqli_query($db,'SET character_set_connection=utf8');
	mysqli_query($db,'SET character_set_client=utf8');
	mysqli_query($db,'SET character_set_results=utf8');

	return $db;	
}

function dbEnd(){
	$db = dbCon();
	mysqli_close($db);
}


?>
