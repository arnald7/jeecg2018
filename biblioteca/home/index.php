<?php include('../include/header.php'); ?>

	<h1>Cadastro</h1>

	<?php

//	$obj = new Livros();
	$obj = new Inscricao();

	if(isset($_REQUEST['status'])){
		echo "Your Data Successfully Updated";
	}

	if(isset($_REQUEST['status_insert'])){
		echo '<div class="alert alert-success fade in">';
        echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
        echo '<strong>Success!</strong> Alteração concluida com sucesso!';
    	echo '</div>';
	//	echo "Your Data Successfully Inserted";
	}

	if(isset($_REQUEST['del_id'])){

		if($obj->deleteData($_REQUEST['del_id'],"livros")){
			echo "Your Data Successfully Deleted";
		}

	}

	$listar = new Inscricao();
	$listar->listaInscricao();

	?>
	
	
<?php include('../include/footer.php'); ?>