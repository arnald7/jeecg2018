<?php

//include 'includes/sessoes.php';
//include 'includes/funcoes.php';

$obs = addslashes($_REQUEST['obs']);
$news = intval($_REQUEST['news']);
$ref_transacao = uniqid ('', true);


// variaveis de teste

$cl_email = 'arnald7@gmail.com';
$email_pag_seguro = 'arnald7@gmail.com';
$ref_transacao = '0000010000';

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
//	include 'includes/inc_metas.php';
	$paginaativa = 0;
	?>

	<title>Finaliza Pedido - <?php echo $nome_site; ?></title>

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


</head>

<body>


	<article class="area finaliza" style="float:none;">

		
		<!-- <form name="fps" target="pagseguro" method="post" action="https://pagseguro.uol.com.br/v2/checkout/payment.html">

		 <form name="fps" target="pagseguro" method="post" action="http://www.agencialatina.com.br/clientes/lecado_pedidos/receber.php">  -->
		<form name="fps" target="pagseguro" method="post" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html">
      
	    	<input type="hidden" name="receiverEmail" value="<?php echo $email_pag_seguro; ?>">
		    <input type="hidden" name="reference" value="<?php echo $ref_transacao; ?>">
    		<input type="hidden" name="currency" value="BRL">
    		<input type="hidden" name="encoding" value="UTF-8">

            <input type="hidden" name="shippingType" value="0">  

            <input type="hidden" name="shippingAddressPostalCode" value="000120251">  
            <input type="hidden" name="shippingAddressStreet" value="Est. Magarca">  
            <input type="hidden" name="shippingAddressNumber" value="1435">  
            <input type="hidden" name="shippingAddressComplement" value="Rua A">  
            <input type="hidden" name="shippingAddressDistrict" value="Guaratiba">  
            <input type="hidden" name="shippingAddressCity" value="Rio de Janeiro">  
            <input type="hidden" name="shippingAddressState" value="RJ">  
            <input type="hidden" name="shippingAddressCountry" value="BRA">  
      
		    <input type="hidden" name="senderName" value="Arnald">  
    		<input type="hidden" name="senderAreaCode" value="">  
		    <input type="hidden" name="senderPhone" value="">  
		    <input type="hidden" name="senderEmail" value="<?php echo $cl_email; ?>">  

				<input type="hidden" name="itemId" value="010">
				<input type="hidden" name="itemDescription" value="Evento">
				<input type="hidden" name="itemAmount" value="30.00">

				<input type="hidden" name="itemQuantity" value="01">

				<input type="hidden" name="itemWeight" value="">



            <h2>Aten&ccedil;&atilde;o:</h2>
            <p>Ao concluir a sua compra, caso voc&ecirc; n&atilde;o seja direcionado automaticamente para o nosso site, clique no link retornar, conforme imagem abaixo:</p>
			<p>&nbsp;</p>
            <figure>

            <!-- 	<img class="u-max-full-width" src="images/retornar.png" alt=""> -->

            </figure>
			<p>&nbsp;</p>
			<p>Clique no bot&atilde;o abaixo para ser encaminhado ao Pag Seguro.</p>
            <p>Um sistema simples e confi&aacute;vel que permite pagamento on-line atrav&eacute;s de cart&atilde;o de cr&eacute;dito, transfer&ecirc;ncia banc&aacute;ria ou boleto.</p>
			<p>&nbsp;</p>
			<p>Ap&oacute;s o pagamento, voc&ecirc; receber&aacute; um e-mail do Pag Seguro confirmando a transa&ccedil;&atilde;o.</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <input type="submit" value="Enviar">

        </form>

    </article>

    </main>

	<?php /*

	dbEnd();
    include 'includes/inc_footer.php';*/

	?>




</body>
</html>