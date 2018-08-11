<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Biblioteca</title>

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/custom.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="text/css" rel="Stylesheet" href="../css/redmond/jquery-ui.css" />

	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/calendario.js"></script>
	<script type="text/javascript" src="../js/jquery.collapser.min.js"></script>
	<script type="text/javascript" src="../js/collapser_functions.js"></script>

</head>
<body>

	<div id="form_index">
	<form class="well form_login_index" method="post" action="home/login.php">
		<h4>Digite o usuário e senha</h4>
		<label class="control-label">Usuário:</label><input type="text" name="login" size="28" maxlength="150" />
		<label class="control-label">Senha:</label><input type="password" name="senha" size="15" maxlength="10" />&nbsp;
		<input id="botao" type="submit" value="Entrar" />
		<div id="erro"></div>
	</form>
	</div>
	
</body>
</html>