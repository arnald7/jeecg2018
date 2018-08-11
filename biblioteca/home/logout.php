<?php
session_start(); //iniciamos a sessão que foi aberta

session_destroy(); //pei!!! destruimos a sessão ;)

session_unset(); //limpamos as variaveis globais das sessões

echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
//echo "<script type='text/javascript'>alert('Você saiu!'); top.location.href='login.php';</script>";

?>