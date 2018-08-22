<?php include('../include/header.php'); ?>

	<h1>Cadastro - Editar</h1>

	<?php
/*
 $titulo 	= 'teste1';
 $autor 	= 'autoteste1';
 $espirito 	= 'espiritoteste1';
 $editora 	= 'editorateste1';
 $edicao 	= 'edicaoteste1';
 $isbn 		= 'isbnteste1';
 $quant 	= '1';
 $table		= 'livros';
*/

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( null==$id ) {
		header("Location: index.php");
	}	

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
			
			// update data
			if ($valid) {
				$table		= 'cadastro';
				$atualizar = new Inscricao();
				$atualizar->updateData($titulo, $autor, $espirito, $editora, $edicao, $isbn, $quant, $table, $id);
				header("Location: index.php?status_insert=success"); 
			}

		} else {
		
			$editarId = new Inscricao();
			extract($editarId->selectDataforId($_REQUEST['id'],"cadastro"));

			$myDateTime = DateTime::createFromFormat('Y-m-d', $dtnascimento);
			$formatdtnascimento = $myDateTime->format('d/m/Y');




		}


?>

					<form class="form-horizontal" action="editar.php?id=<?php echo $id?>" method="post">

<div class="row">

<div class="col-sm-6 col-md-6 col-lg-6">

					  <div class="control-group <?php echo !empty($tituloError)?'error':'';?>">
					    <label class="control-label">Nome</label>
					    <div class="controls">
					      	<input name="titulo" type="text"  value="<?php echo !empty($nome)?$nome:'';?>">
					      	<?php if (!empty($tituloError)): ?>
					      		<span class="help-inline"><?php echo $tituloError;?></span>
					      	<?php endif; ?>
					    </div>
						</div>
						
					  <div class="control-group <?php echo !empty($autorError)?'error':'';?>">
					    <label class="control-label">Cracha</label>
					    <div class="controls">
					      	<input name="autor" type="text" placeholder="Autor" value="<?php echo !empty($cracha)?$cracha:'';?>">
					      	<?php if (!empty($autorError)): ?>
					      		<span class="help-inline"><?php echo $autorError;?></span>
					      	<?php endif;?>
					    </div>
						</div>
						
					  <div class="control-group">
					    <label class="control-label">Data de Nascimento</label>
					    <div class="controls">
					      	<input name="dtnascimento" type="text"  placeholder="data de nascimento" value="<?php echo !empty($formatdtnascimento)?$formatdtnascimento:'';?>">
					    </div>
						</div>

</div>

<div class="col-sm-6 col-md-6 col-lg-6">

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
					      	<input name="quant" type="text"  placeholder="Quantidade" value="<?php echo !empty($quantidade)?$quantidade:'';?>">
					      	<?php if (!empty($quantError)): ?>
					      		<span class="help-inline"><?php echo $quantError;?></span>
					      	<?php endif;?>
					    </div>
						</div>

</div>

</div>

			
											  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
						
					</form>	
	
	
<?php include('../include/footer.php'); ?>