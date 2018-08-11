<?php include('../include/header.php'); ?>

	<h1>Biblioteca - Cadastro de Livros</h1>

	<?php

	if ( !empty($_POST)) {
		// keep track validation errors
		$tituloError = null;
		$autorError = null;
		$quantError = null;
		
		// keep track post values
		$titulo 	= $_POST['titulo']; 
 		$autor 		= $_POST['autor'];
 		$espirito 	= $_POST['espirito'];
 		$editora 	= $_POST['editora'];
 		$edicao 	= $_POST['edicao'];
 		$isbn 		= $_POST['isbn'];
 		$quant 		= $_POST['quant'];

 		$table		= 'livros';
				
		// validate input
		$valid = true;
		if (empty($titulo)) {
			$tituloError = 'Please enter Titulo';
			$valid = false;
		}
		
		if (empty($autor)) {
			$autorError = 'Please enter Autor';
			$valid = false;
		} 
		
		if (empty($quant) || $quant<1) {
			$quantError = 'Please enter Quantidade';
			$valid = false;
		}

		// insert data
		if ($valid) {
		$cadastrar = new Livros();
		$cadastrar->insertData($titulo, $autor, $espirito, $editora, $edicao, $isbn, $quant, $table);
	//	$listar->listaLivros();
		header("location:index.php?status_insert=success"); 
		}

	}	

	?>

					<form class="form-horizontal" action="cadastro.php" method="post">
					  <div class="control-group <?php echo !empty($tituloError)?'error':'';?>">
					    <label class="control-label">Titulo</label>
					    <div class="controls col-xs-5">
					      	<input class="col-xs-5" name="titulo" type="text"  placeholder="titulo" value="<?php echo !empty($titulo)?$titulo:'';?>">
					      	<?php if (!empty($tituloError)): ?>
					      		<span class="help-inline"><?php echo $tituloError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($autorError)?'error':'';?>">
					    <label class="control-label">Autor</label>
					    <div class="controls col-xs-5">
					      	<input name="autor" type="text" placeholder="Autor" value="<?php echo !empty($autor)?$autor:'';?>">
					      	<?php if (!empty($autorError)): ?>
					      		<span class="help-inline"><?php echo $autorError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Espirito</label>
					    <div class="controls">
					      	<input name="espirito" type="text"  placeholder="Espirito" value="<?php echo !empty($espirito)?$espirito:'';?>">
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Editora</label>
					    <div class="controls">
					      	<input name="editora" type="text"  placeholder="Editora" value="<?php echo !empty($editora)?$editora:'';?>">
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Edição</label>
					    <div class="controls">
					      	<input name="edicao" type="text"  placeholder="Edição" value="<?php echo !empty($edicao)?$edicao:'';?>">
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">ISBN</label>
					    <div class="controls">
					      	<input name="isbn" type="text"  placeholder="isbn" value="<?php echo !empty($isbn)?$isbn:'';?>">
					    </div>
					  </div>					  					  					  
					  <div class="control-group <?php echo !empty($quantError)?'error':'';?>">
					    <label class="control-label">Quantidade</label>
					    <div class="controls">
					      	<input name="quant" type="text"  placeholder="Quantidade" value="<?php echo !empty($quant)?$quant:'';?>">
					      	<?php if (!empty($quantError)): ?>
					      		<span class="help-inline"><?php echo $quantError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>

					<div class="searchbox">
						<?php

						$keywords = $_GET['q'];

						$pesquisa = new Livros();
						$pesquisa->buscabiblioteca($keywords);

						?>						
					</div>
	
	
<?php include('../include/footer.php'); ?>