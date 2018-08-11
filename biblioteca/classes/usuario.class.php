<?php
	require_once("../define.php");
	require_once(CL_BANCO);
	
	class Usuario 
	{

		private $db;

		public function __construct(){
			$this->db = new Banco();
			$this->db = $this->db->dbConnect();
		}
		
		function logarUsuario($login, $senha) { // mщtodo para fazer login de um usuсrio
	
			if(!empty($login) && !empty($senha)){
		    	$st = $this->db->prepare("SELECT * FROM usuarios WHERE usuario=? and senha=?");
		    	$st->bindParam(1, $login);
		    	$st->bindParam(2, $senha);
		    	$st->execute();

		    	if($st->rowCount() == 1){
		    		$result = $st->fetch(PDO::FETCH_ASSOC);
		    		$data = $result['usuario'];
		    		$_SESSION['ID_USUARIO'] = $data;
		    		return true; //echo "User verified, access granted";
		    	}else{
		    		return false; // echo "Incorrect login ou senha";
		    	}


		    }else{
		    	echo "Please enter login and senha";
		    }       

		}
		
		/*****************************************************************/



		public function cadastrarUsuario($usuario, $funcao, $senha) {
    //	$sql = "INSERT INTO usuarios (usuario, id_nivel, senha) VALUES ('$usuario', '$funcao', '$senha')";
        $sql = "INSERT INTO usuarios (usuario, id_nivel, senha) VALUES ('$usuario', '$funcao', '$senha')";

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

		// function cadastrarUsuario($nome, $login, $senha, $acessos, $estado) // mщtodo para cadastrar usuсrio
		// {
		// 	$sql="INSERT INTO tb_usuarios (nome, login, senha, estado) VALUES ('$nome', '$login', '".md5($senha)."', '$estado')";
		// 	$banco = new Banco(); // abre a conexуo com o banco
			
		// 	if(mysql_query($sql)) // tenta fazer a query sql
		// 	{
		// 		$ultimo = mysql_result(mysql_query("SELECT id_usuario FROM tb_usuarios WHERE login = '$login'"), 0, 'id_usuario');
		// 		mysql_query("INSERT INTO tb_permissoes (id_usuario) VALUES ('$ultimo')");
		// 		foreach($acessos as $campo)
		// 		{
		// 			mysql_query("UPDATE tb_permissoes SET $campo = 1 WHERE id_usuario = '$ultimo'");
		// 		}
		// 		$banco->fecharConexao(); // fecha a conexуo com o banco
		// 		return true; // retorna verdadeiro se a query foi realizada
		// 	}
		// 	else
		// 	{
		// 		$banco->fecharConexao(); // fecha a conexуo com o banco
		// 		return false; // retorna verdadeiro se a query foi realizada
		// 	}
		// }
		
		/*******************************************************************/
		
		function atualizarUsuario($nome, $login, $senha, $id_usuario, $acessos, $estado)
		{
			if(!empty($senha) && $senha != '')
			{
				$senha = md5($senha);
				$sql = "UPDATE tb_usuarios SET nome = '$nome', senha = '$senha', login = '$login', estado = '$estado' WHERE id_usuario = '$id_usuario'";
				$banco = new Banco();
				
				if(mysql_query($sql))
				{
					if(mysql_affected_rows())
					{
						mysql_query("UPDATE tb_permissoes SET usuarios = 0, artigos = 0, noticias = 0, contatos = 0 WHERE id_usuario = '$id_usuario'");
						foreach($acessos as $campo)
						{
							mysql_query("UPDATE tb_permissoes SET $campo = 1 WHERE id_usuario = '$id_usuario'");
						}
						
						unset($campo);
						$banco->fecharConexao(); // fecha a conexуo com o banco
						return true; // retorna verdadeiro se a query foi realizada
					}
				}
				else
				{
					$banco->fecharConexao(); // fecha a conexуo com o banco
					return false; // retorna verdadeiro se a query foi realizada
				}
			}
			else
			{
				$sql = "UPDATE tb_usuarios SET nome = '$nome', login = '$login', estado = '$estado' WHERE id_usuario = '$id_usuario'";
				$banco = new Banco();
				
				if(mysql_query($sql))
				{
					if(mysql_affected_rows())
					{
						mysql_query("UPDATE tb_permissoes SET usuarios = 0, artigos = 0, noticias = 0, contatos = 0 WHERE id_usuario = '$id_usuario'");
						foreach($acessos as $campo)
						{
							mysql_query("UPDATE tb_permissoes SET $campo = 1 WHERE id_usuario = '$id_usuario'");
						}
						
						$banco->fecharConexao(); // fecha a conexуo com o banco
						return true; // retorna verdadeiro se a query foi realizada
					}
				}
				else
				{
					$banco->fecharConexao(); // fecha a conexуo com o banco
					return false; // retorna verdadeiro se a query foi realizada
				}
			}
		}
		
		/******************************************************************/

		
		function listarUsuarios() // listar todos os usuсrios do sistema
		{
			$sql = "SELECT id, usuario FROM usuarios WHERE id !=1 ORDER BY usuario";
			$banco = new Banco(); // abre a conexуo com o banco
			
			if($busca = @mysql_query($sql)) // tenta fazer a query sql
			{
				$banco->fecharConexao();
				return $busca; // retorna os dados dos usuсrios do sistema
			}
			else
			{
				$banco->fecharConexao();
				return false; // retorna falso caso ocorra erro na consulta
			}
		}
		
		/*************************************************************/
		
		function excluirUsuario($id_usuario) // excluir um usuсrio do sistema
		{
			$sql = "DELETE FROM tb_usuarios WHERE id_usuario = '$id_usuario' AND id_usuario != 1";
			$banco = new Banco(); // abre a conexуo com o banco
			
			if($deletar = mysql_query($sql)) // tenta fazer a query sql
			{
				if(mysql_affected_rows()) // verifica se algum usuсrio foi deletado
				{
					$banco->fecharConexao();
					return true; // retorna verdadeiro se houve a exclusуo do usuсrio
				}
				else
				{
					$banco->fecharConexao();
					return false; // retorna falso se nуo houve a exclusуo do usuсrio
				}
			}
			else
			{
				$banco->fecharConexao();
				return false; // retorna falso caso a query sql nуo tenha sido realizada
			}
		}
		
		/***************************************************************/
		
		function buscarUsuarioId($idUser)
		{
			$sql = "SELECT * FROM usuarios WHERE id = '$idUser'";
			$banco = new Banco();
			
			if($busca = mysql_query($sql))
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


		function buscarUsuario($id)
		{
			$sql = "SELECT * FROM usuarios WHERE id = '$id'";
			$banco = new Banco();
			
			if($busca = mysql_query($sql))
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
		
		/************************************************************/
		
		function getPermissoes($id_usuario)
		{
			$sql = "SELECT * FROM tb_permissoes WHERE id_usuario = '$id_usuario'";
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
		
		function getNomeUsuario($id_usuario)
		{
			$sql = "SELECT usuario FROM usuarios WHERE id = '$id_usuario'";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$banco->fecharConexao();
				$busca = mysql_fetch_row($busca);
				return $busca[0];	
			}
			else
			{
				$banco->fecharConexao();
				return false;
			}
		}
		
		/*
			mщtodo para fazer a comparaчуo entre a senha cadastrada na base de dados
			e a senha fornecida como parтmetro para a funчуo
		*/
		function comparar_senha($id_usuario, $senha)
		{
			$sql = "SELECT senha FROM tb_usuarios WHERE id_usuario = '$id_usuario'";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$busca = mysql_fetch_row($busca);
				$senha_bd = $busca[0];
				
				if ($senha_bd != md5($senha))
				{
					return false;
				}
				else
					return true;
			}
			else
			{
				$banco->fecharConexao();
				return false;
			}
		}
		
		/*
			mщtodo para fazer a alteraчуo da senha do usuсrio
		*/
		function alterar_senha($id_usuario, $senha)
		{
			$sql = "UPDATE tb_usuarios SET senha = '".md5($senha)."' WHERE id_usuario = '$id_usuario'";
			
			$banco = new Banco();
			
			if (mysql_query($sql))
			{
				$banco->fecharConexao();
				return true;
			}
			else
			{
				$banco->fecharConexao();
				return false;
			}
		}
		
	}
?>