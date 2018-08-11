<?php
	require_once('../define.php');
	require_once CL_BANCO;
	//require_once CL_CONNECTION;
	
	class Portfolio
	{

		function listarRegistros($inicio, $quantidade)
		{
			$sql = "SELECT tb_portfolio.*, tb_clientes.cliente AS cliente FROM tb_portfolio INNER JOIN tb_clientes ON tb_portfolio.id_cliente = tb_clientes.Id_cliente ";
			$sql = $sql . " ORDER BY id_trabalho DESC LIMIT $inicio, $quantidade";
			
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

		function contarRegistros()
		{
			$sql = "SELECT * FROM tb_portfolio";
			
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

		function listarRegistrosClientes()
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

		function cadastrarRegistro($id_cliente, $trabalho, $campanha, $peca)
		{
			// Insere o registro na tabela
			$sql = "INSERT INTO tb_portfolio ";
			$sql = $sql . "(id_cliente, trabalho, campanha, peca) ";
			$sql = $sql . "VALUES('$id_cliente','$trabalho','$campanha','$peca')";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['inclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";	
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['inclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";
				$banco->fecharConexao();
				return false;
			}
		}

		function capturarIdPortfolio($idsel)
		{
			$sql = "SELECT tb_portfolio.*, tb_clientes.cliente AS cliente FROM tb_portfolio INNER JOIN tb_clientes ON tb_portfolio.id_cliente = tb_clientes.Id_cliente WHERE id_trabalho = '".$idsel."'";

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

		function editarRegistro($newcliente, $id)
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

		function excluirRegistro($id)
		{
			
			// ATUALIZA o registro na tabela
			$sql = "DELETE FROM tb_portfolio WHERE id_trabalho='$id'";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['exclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['exclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";
				$banco->fecharConexao();
				return false;
			}
		}

		function recuperaGravaImagemNova($id, $trabalho)
		{
			$sql = "UPDATE tb_portfolio SET trabalho='$trabalho' WHERE id_trabalho='$id'";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['alterado']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['alterado']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";
				$banco->fecharConexao();
				return false;
			}
		}

		function atualizaPortfolio($id, $id_cliente, $campanha, $peca)
		{
			$sql = "UPDATE tb_portfolio SET id_cliente='$id_cliente', campanha='$campanha', peca='$peca' WHERE id_trabalho='$id' ";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['alterado']="OK";
				//echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";
				header( 'Location: ../home/index.php' ) ;
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['alterado']="ERROR";
				//echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home/index.php'>";
				header( 'Location: ../home/index.php' ) ;
				$banco->fecharConexao();
				return false;
			}
		}			
	}
?>