<?php
	require_once('../define.php');
	require_once CL_BANCO;
	
	class Cliente
	{


		function cadastrarClientes($cliente, $contato, $telefone, $observacao)
		{

			// Insere o registro na tabela
			$sql = "INSERT INTO clientes  ";
			$sql = $sql . "(cliente, contato, telefone, observacao) ";
			$sql = $sql . "VALUES('$cliente', '$contato', '$telefone', '$observacao')";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['inclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../clientes/cli_cadastro.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['inclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../clientes/cli_cadastro.php'>";
				$banco->fecharConexao();
				return false;
			}
		}

		function listarClientes()
		{
			$sql = "SELECT id, cliente FROM clientes";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$banco->fecharConexao();
				return false;
			}
		}

// Antigos ->




		// function listarClientes($inicio, $quantidade)
		// {
		// 	$sql = "SELECT * FROM tb_clientes";
		// 	$sql = $sql . " ORDER BY cliente ASC LIMIT $inicio, $quantidade";
			
		// 	$banco = new Banco();
			
		// 	if ($busca = mysql_query($sql))
		// 	{
		// 		$banco->fecharConexao();
		// 		return $busca;
		// 	}
		// 	else
		// 	{
		// 		$banco->fecharConexao();
		// 		return false;
		// 	}
		// }

		function listarClientesSimples()
		{
			$sql = "SELECT * FROM tb_clientes ORDER BY cliente ASC";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$banco->fecharConexao();
				return false;
			}
		}


		function contarClientes()
		{
			$sql = "SELECT * FROM tb_clientes";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$banco->fecharConexao();
				return false;
			}
		}


/*		function cadastrarClientes($cliente)
		{
			
			// Insere o registro na tabela
			$sql = "INSERT INTO tb_clientes (cliente) VALUES('$cliente')";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['inclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/clientes.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['inclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/clientes.php'>";
				$banco->fecharConexao();
				return false;
			}
		}  */


		function capturarIdCliente($idsel)
		{
			$sql = "SELECT * FROM tb_clientes WHERE Id_cliente = '$idsel'";

			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$banco->fecharConexao();
				return false;
			}

		}


		function editarClientes($newcliente, $id)
		{
			
			// ATUALIZA o registro na tabela
			$sql = "UPDATE tb_clientes SET cliente='$newcliente' WHERE Id_cliente='$id'";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['alterado']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/clientes.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['alterado']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/clientes.php'>";
				$banco->fecharConexao();
				return false;
			}
		}


		function excluirClientes($id)
		{
			
			// ATUALIZA o registro na tabela
			$sql = "DELETE FROM tb_clientes WHERE Id_cliente='$id'";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['exclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/clientes.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['exclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/clientes.php'>";
				$banco->fecharConexao();
				return false;
			}
		}		
	}
?>