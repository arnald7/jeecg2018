<?php

include('funcoes.php');


		$contadeemail='falacomigo@arnald.com.br';
        $emailsender = $contadeemail;
//      $emaildestinatario = $contadeemail;
	    $emaildestinatario = 'falacomigo@arnald.com.br'; 

	    $comcopia = 'jeerio.cg@gmail.com';               

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo


//Pegue a data no formato dd/mm/yyyy
$data = $_POST['data_nascimento'];
//Exploda a data para entrar no formato aceito pelo DB.
$dataP = explode('/', $data);
$dataNoFormatoParaOBanco = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];


	$nome_completo 		= $_POST['nome_completo'];
	$nome_cracha   		= $_POST['nome_cracha'];
	$data_nascimento	= $dataNoFormatoParaOBanco; //$_POST['data_nascimento'];
	$endereco       	= $_POST['endereco'];
	$endereco_num       = $_POST['endereco_num'];
	$complemento        = $_POST['complemento'];
	$bairro		        = $_POST['bairro'];
	$cep        		= $_POST['cep'];
	$cidade		        = $_POST['cidade'];
	$estado		        = $_POST['estado'];
	$email 		        = $_POST['email']; 
	$telefone 		    = $_POST['telefone'];
	$como_soube         = $_POST['como_soube'];
	$frequenta 	        = $_POST['frequenta'];
	$nome_frequenta     = $_POST['nome_frequenta'];
	$japarticipou       = $_POST['japarticipou'];
	$qual_japarticipou  = $_POST['qual_japarticipou'];
	$necessita 	        = $_POST['necessita'];
	$qual_necessita     = $_POST['qual_necessita'];
	$diabetico 	        = $_POST['diabetico'];
	$vegetariano        = $_POST['vegetariano'];

	$desconto        	= $_POST['desconto'];

	if ($desconto == 0) {

		$desconto_txt = 'confraternista ( sem desconto )';

	} elseif ($desconto == 1) {

		$desconto_txt = 'criança';
		
	} elseif ($desconto == 2) {

		$desconto_txt = 'trabalhador';
		
	}
	



/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '
<P>Mensagem postada pelo formulario do site (JEECG):</P>

<p>Nome completo: <b><i>'.$nome_completo.'</i></b></p>
<p>Nome para o cracha: <b><i>'.$nome_cracha.'</i></b></p>
<p>data de nascimento: <b><i>'.$data_nascimento.'</i></b></p>
<p>endereço: <b><i>'.$endereco.'</i></b></p>
<p>numero: <b><i>'.$endereco_num.'</i></b></p>
<p>complemento: <b><i>'.$complemento.'</i></b></p>
<p>bairro: <b><i>'.$bairro.'</i></b></p>
<p>cep: <b><i>'.$cep.'</i></b></p>
<p>cidade: <b><i>'.$cidade.'</i></b></p>
<p>estado: <b><i>'.$estado.'</i></b></p>
<p>email: <b><i>'.$email.'</i></b></p>
<p>telefone: <b><i>'.$telefone.'</i></b></p>
<p>como soube: <b><i>'.$como_soube.'</i></b></p>
<p>frequenta alguma casa: <b><i>'.$frequenta.'</i></b></p>
<p>qual o nome da casa: <b><i>'.$nome_frequenta.'</i></b></p>
<p>ja participou da jee-cg: <b><i>'.$japarticipou.'</i></b></p>
<p>qual: <b><i>'.$qual_japarticipou.'</i></b></p>
<p>necessidades especiais: <b><i>'.$necessita.'</i></b></p>
<p>qual: <b><i>'.$qual_necessita.'</i></b></p>
<p>é diabetico: <b><i>'.$diabetico.'</i></b></p>
<p>é vegetariano: <b><i>'.$vegetariano.'</i></b></p>
<p>Desconto: <b><i>'.$desconto_txt.'</i></b></p>


<hr>';
  

/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
//$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
$headers .= "Content-type: text/html; charset=UTF-8".$quebra_linha;

// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;

// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

$assunto = "Cadastro JEECG 2018";
 
	if(mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender)){

	//	echo "Mensagem enviada com sucesso!"; mail(to,subject,message,headers,parameters);
		$assuntoCliente = "JEE CG 2018 - Cadastro realizado";
		$mensagemCliente = '
		<p>Mensagem postada pelo formulario do site (Jee-Rio CG):</p>
		<p>Sua cadastro foi realizado com sucesso.</p>
		<p>Aguardamos a confirmação do seu pagamento</p>
		';

		mail($email, $assuntoCliente, $mensagemCliente, $headers, "-r". $emailsender);

$db = dbCon();

$sql = "INSERT INTO cadastro (nome, cracha, dtnascimento, endereco, endereco_num, complemento, bairro, cep, cidade, estado, email, telefone, como_soube, frequenta, nome_frequenta, japarticipou, qual_japarticipou, necessita, qual_necessita, diabetico, vegetariano, desconto) VALUES ('$nome_completo','$nome_cracha','$data_nascimento','$endereco','$endereco_num','$complemento', '$bairro','$cep','$cidade','$estado','$email','$telefone','$como_soube','$frequenta','$nome_frequenta','$japarticipou','$qual_japarticipou','$necessita','$qual_necessita','$diabetico','$vegetariano', '$desconto')";


	mysqli_query($db,$sql) or die( '<script>alert("Erro\n\n'.mysqli_error($db).'\n\n' .$sql. '");</script>' );
	
//	$msg = $sing." cadastrado com sucesso!";

	dbEnd();

		if ($desconto == 0) {
		    
		    $pagr = 'pag.php';
			echo '<script>location.href="'.$pagr.'"</script>';

		} elseif ($desconto == 1) {

		    $pagr1 = 'pag1.php';
			echo '<script>location.href="'.$pagr1.'"</script>';

		} elseif ($desconto == 2) {

		    $pagr2 = 'pag2.php';
			echo '<script>location.href="'.$pagr2.'"</script>';
		    
		}

	}else{
		echo "Não enviado!";
	}

	
?>