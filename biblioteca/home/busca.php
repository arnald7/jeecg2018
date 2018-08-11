<?php include('../include/header.php'); ?>

	<h1>Biblioteca</h1>

	<?php

	$keywords = $_GET['q'];

	echo "<h2>Termo de Busca: ".$keywords."</h2>";

	$pesquisa = new Livros();
	$pesquisa->buscabiblioteca($keywords);

	?>
	
	
<?php include('../include/footer.php'); ?>