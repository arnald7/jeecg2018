<?php 
	/*DEFINI��O DE CONSTANTES Locais
	define("DATABASE", 'getjsis');
	define("HOST", 'localhost');
	define("USUARIO", 'root');
	define("SENHA", 'root');*/
	
	/*DEFINI��O DE CONSTANTES Online*/
	define("DATABASE", 'budon629_jeecg');
	define("HOST", 'localhost');
	define("USUARIO", 'budon629_user');
	define("SENHA", 'vg527282');

	
	/*Classes*/
	define("CL_USUARIO", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/usuario.class.php");
	define("CL_CONNECTION", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/connection.class.php");

	define("CL_INSCRITOS", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/inscricao.class.php");

	define("CL_LIVROS", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/livros.class.php");

	define("CL_BANCO", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/banco.class.php");
	define("CL_JOBS", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/jobs.class.php");
	define("CL_CLIENTE", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/cliente.class.php");

	/* apagar posteriormente */
	define("CL_PORTFOLIO", $_SERVER['DOCUMENT_ROOT']."/clientes/jeecg/biblioteca/classes/portfolio.class.php");
?>