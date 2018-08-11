<?php include('../include/header.php'); ?>

	<h1>Biblioteca</h1>

	<?php

	$keywords = $_GET['q'];

	$pesquisa = new Livros();
	$pesquisa->buscabiblioteca($keywords);

	?>
	
	
<?php include('../include/footer.php'); ?>