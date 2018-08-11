<?php
	require_once('../define.php');
	require_once CL_BANCO;
	
	class Inscricao
	{

		private $db;

		public function __construct(){
			$this->db = new Banco();
			$this->db = $this->db->dbConnect();
		}


		function buscabiblioteca($keywords)
		{

			$keywords = strtoupper($keywords);
			$sth = $this->db->prepare("SELECT * FROM livros WHERE titulo LIKE '%$keywords%' ");
			$sth->execute();

			if($sth->rowCount() > 0) {

				while($row=$sth->fetch(PDO::FETCH_ASSOC)) {

							echo '<p>'. ( $row['titulo'] ) .' | '. ( $row['autor']  ) . '</p>';

				}

			}else{

				echo "Termo não encontrado"; 

			}

		}		

		function listaInscricao() // Lista inscritos
		{
			$sth = $this->db->prepare("SELECT * from cadastro");
			$sth->execute();

			echo '
			<table class="table table80 table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Nome</th>
		                  <th>Cracha</th>
		                  <th>Data de Nascimento</th>
		                  <th>Endereço</th>
		                  <th>Bairro</th>
		                  <th>CEP</th>
		                  <th>Cidade</th>
		                  <th></th>
		                </tr>
		              </thead>
		              <tbody>';

			while($row=$sth->fetch(PDO::FETCH_ASSOC)) {
				echo '<tr>';
			//	echo '<td>'. utf8_encode( $row['titulo'] ) . '</td>';
			//	echo '<td>'. utf8_encode( $row['autor']  ) . '</td>';
				echo '<td>'. ( $row['nome'] ) . '</td>';
				echo '<td>'. ( $row['cracha']  ) . '</td>';
				echo '<td>'. ( $row['dtnascimento']  ) . '</td>';
				echo '<td>'. ( $row['endereco']  ) . '</td>';
				echo '<td>'. ( $row['bairro']  ) . '</td>';
				echo '<td>'. ( $row['cep']  ) . '</td>';
				echo '<td>'. ( $row['cidade']  ) . '</td>';
				echo '<td><button class="btn"><a href="editar.php?id='.($row['id_cad']).'">Editar</a></button>&nbsp;&nbsp;<button class="btn"><a href="index.php?del_id='.($row['id_cad']).'">Delete</a></button></td>';
				echo '</tr>';
			}

			echo '</tbody>
	            </table>';
		}

		function insertData($titulo, $autor, $espirito, $editora, $edicao, $isbn, $quant, $table)
		{
			$sql = "INSERT INTO $table SET titulo=:titulo,autor=:autor,espirito=:espirito,editora=:editora,edicao=:edicao,isbn=:isbn,quantidade=:quantidade";
			$q = $this->db->prepare($sql);
			$q->execute(array(':titulo'=>$titulo,':autor'=>$autor,':espirito'=>$espirito,':editora'=>$editora,':edicao'=>$edicao,':isbn'=>$isbn,':quantidade'=>$quant));
			return true;
		}


		function updateData($titulo, $autor, $espirito, $editora, $edicao, $isbn, $quant, $table, $id)
		{
			$sql = "UPDATE $table set titulo = '$titulo', autor = '$autor', espirito = '$espirito', editora = '$editora', edicao = '$edicao', isbn = '$isbn', quantidade = '$quant' WHERE id=$id";
			$q = $this->db->prepare($sql);
			$q->execute(array($titulo,$autor,$espirito,$editora,$edicao,$isbn,$quant,$id));
			return true;
		}

		function selectDataforId($id, $table)
		{
			$sql="SELECT * FROM $table WHERE id = $id";
			$q = $this->db->prepare($sql);
			$q->execute(array($id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		function deleteData($id, $table){
	
			$sql="DELETE FROM $table WHERE id=:id";
			$q = $this->db->prepare($sql);
			$q->execute(array(':id'=>$id));
			return true;	
		}



function update($id,$name,$email,$mobile,$address,$table){

		$sql = "UPDATE $table 
		        SET name=:name,email=:email,mobile=:mobile,address=:address
				WHERE id=:id";
		$q = $this->conn->prepare($sql);
		$q->execute(array(':id'=>$id,':name'=>$name,':email'=>$email,':mobile'=>$mobile,':address'=>$address));		
		return true;
		
	}


function cadastraLivros() // Cadastra os livros
		{
			
			$sth = $this->db->prepare("SELECT * from livros");
			$sth->execute();
//			$result = $sth->fetchAll();
//			$result = $sth->fetch(PDO::FETCH_ASSOC);

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$email,$mobile));

			Database::disconnect();
			header("Location: index.php");

			
//			var_dump($result);
//			return; // $result;
		}





// ----------------------------------- biblioteca GETJ ---------------------------------------------------------
		function listarUserItensporData($idUser, $idUserCliente) // Lista os itens com o jobs ativos ordenados por data
		{
			
			if($idUserCliente == '') {

			$sql = "SELECT itens.*, jobs.ativo, jobs.job, usuarios.usuario, clientes.cliente, clientes.id AS idcli \n"
			. "FROM itens\n"
			. "INNER JOIN jobs ON itens.id_job = jobs.id\n"
			. "INNER JOIN clientes ON jobs.id_cliente = clientes.id\n"
			. "INNER JOIN usuarios ON itens.id_responsavel = usuarios.id\n"
			. "WHERE jobs.ativo =  '1' AND usuarios.id = '".$idUser."'\n"
			. "ORDER BY itens.data_entrega ASC";	

			} else {

			$sql = "SELECT itens.*, jobs.ativo, jobs.job, usuarios.usuario, clientes.cliente, clientes.id AS idcli \n"
			. "FROM itens\n"
			. "INNER JOIN jobs ON itens.id_job = jobs.id\n"
			. "INNER JOIN clientes ON jobs.id_cliente = clientes.id\n"
			. "INNER JOIN usuarios ON itens.id_responsavel = usuarios.id\n"
			. "WHERE jobs.ativo =  '1' AND usuarios.id = '".$idUser."' AND clientes.id = '".$idUserCliente."'\n"
			. "ORDER BY itens.data_entrega ASC";

			}

			$banco = new Banco();
			
			if ($busca = mysql_query($sql) or exit(mysql_error()) )
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


		function editaComentario($newComentario, $idCom)
		{
			//$sql = "SELECT jobs.*, clientes.cliente AS cliente FROM jobs INNER JOIN clientes ON jobs.id_cliente = clientes.id WHERE jobs.id = '".$idsel."'";
			$sql = "UPDATE comentarios SET comentario = '$newComentario' WHERE id = '$idCom'";
			//$sql = "SELECT comentarios.*, usuarios.usuario FROM comentarios INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id WHERE comentarios.id_item = '".$idsel."' ORDER BY  comentarios.datacriacao DESC ";

			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_OK.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_ERROR.php'>";
				$banco->fecharConexao();
				return false;
			}
		}



		function capturaComentarioEditar($idsel)
		{
			$sql = "SELECT * FROM comentarios WHERE id = '".$idsel."' ";

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


		function capturaIdcomentario($idsel)
		{
			//$sql = "SELECT jobs.*, clientes.cliente AS cliente FROM jobs INNER JOIN clientes ON jobs.id_cliente = clientes.id WHERE jobs.id = '".$idsel."'";
			$sql = "SELECT comentarios.*, usuarios.usuario FROM comentarios INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id WHERE comentarios.id_item = '".$idsel."' ORDER BY  comentarios.datacriacao DESC ";

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


		function comentarioNovo($id_item, $id_usuario, $comentario)
		{
			// Insere o registro na tabela
			$sql = "INSERT INTO comentarios  ";
			$sql = $sql . "(id_item, datacriacao, id_usuario, comentario) ";
			$sql = $sql . "VALUES('$id_item', NOW(), '$id_usuario', '$comentario')";


			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				//$_SESSION['inclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_OK.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				//$_SESSION['inclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_ERROR.php'>";
				$banco->fecharConexao();
				return false;
			}
		}



		function listarTodosItensporData() // Lista os itens com o jobs ativos ordenados por data
		{
			$sql = "SELECT itens.*, jobs.ativo, jobs.job, usuarios.usuario\n"
				. "FROM itens \n"
				. "INNER JOIN jobs ON itens.id_job = jobs.id\n"
				. "INNER JOIN usuarios ON itens.id_responsavel = usuarios.id\n"
				. "WHERE jobs.ativo =  '1'\n"
				. "ORDER BY itens.data_entrega ASC";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql) or exit(mysql_error()) )
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



		function editarItem($item_nome, $status, $itemNivel, $responsavel, $timeStamp, $caminho, $briefing, $observacoes, $job, $idItem)
		{
			
			// ATUALIZA o registro na tabela
			$sql = "UPDATE itens SET titulo_item = '$item_nome', id_status = '$status', id_nivel = '$itemNivel' , id_responsavel = '$responsavel', data_entrega = '$timeStamp', caminho = '$caminho', briefing = '$briefing', observacao = '$observacoes', id_job = '$job' WHERE id = '$idItem'";
			
			$banco = new Banco();

			
			if ($busca = mysql_query($sql))
			{
				//$_SESSION['alterado']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_OK.php'>";
				//echo '<meta HTTP-EQUIV="Refresh" CONTENT="0;URL=../job/item_view.php?id=' .$idItem. '">';
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				//$_SESSION['alterado']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_ERROR.php'>";
				//echo '<meta HTTP-EQUIV="Refresh" CONTENT="0;URL=../job/item_view.php?id=' .$idItem. '">';
				$banco->fecharConexao();
				return false;
			}
		}


		function capturarIdItem($idsel)
		{
			$sql = "SELECT * FROM itens WHERE id = '$idsel'";

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

		function editarJob($nomejob, $id_cliente, $timeStamp, $ativo, $id)
		{
			
			// ATUALIZA o registro na tabela
			$sql = "UPDATE jobs SET job = '$nomejob', id_cliente = '$id_cliente', job_data_entrega = '$timeStamp', ativo = '$ativo' WHERE id = '$id'";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				//$_SESSION['inclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_OK.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				//$_SESSION['inclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_ERROR.php'>";
				$banco->fecharConexao();
				return false;
			}
		}


		function capturarIdJob($idsel)
		{
			$sql = "SELECT jobs.*, clientes.cliente AS cliente FROM jobs INNER JOIN clientes ON jobs.id_cliente = clientes.id WHERE jobs.id = '".$idsel."'";

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

		function listarJobseClientes()
		{
			$sql = "SELECT jobs.*, clientes.cliente AS cliente FROM jobs INNER JOIN clientes ON jobs.id_cliente = clientes.id ORDER BY job_data_entrega ASC";
			
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


		function capturaIdItem($idsel)
		{
			
			$sql = "SELECT itens.*, jobs.job, clientes.cliente, usuarios.usuario FROM jobcontrol.jobs \n"
				    . "INNER JOIN jobcontrol.clientes ON (jobs.id_cliente = clientes.id)\n"
				    . "INNER JOIN jobcontrol.itens ON (itens.id_job = jobs.id)\n"
				    . "INNER JOIN jobcontrol.usuarios ON (itens.id_responsavel = usuarios.id)\n"
				    . "WHERE itens.id = $idsel "; 

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

		function listarItensPorJobs($idJob)
		{

			$sql = "SELECT itens.*, jobs.job, clientes.cliente, usuarios.usuario FROM jobcontrol.jobs \n"
				    . "INNER JOIN jobcontrol.clientes ON (jobs.id_cliente = clientes.id)\n"
				    . "INNER JOIN jobcontrol.itens ON (itens.id_job = jobs.id)\n"
				    . "INNER JOIN jobcontrol.usuarios ON (itens.id_responsavel = usuarios.id)\n"
				    . "WHERE itens.id_job = $idJob "; 
			
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


		function listarInfoJobs()
		{
			$sql = "SELECT jobs.*, clientes.cliente FROM  jobcontrol.jobs INNER JOIN jobcontrol.clientes ON (jobs.id_cliente = clientes.id) WHERE jobs.ativo = '1' ORDER BY job_data_entrega;";
			
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


		function cadastrarItemNovo($item_nome, $status, $itemNivel, $responsavel, $data_entrada, $timeStamp, $caminho, $briefing, $observacoes, $job)
		{
			// Insere o registro na tabela
			$sql = "INSERT INTO itens  ";
			$sql = $sql . "(titulo_item, id_status, id_nivel, id_responsavel, data_entrada, data_entrega, caminho, briefing, observacao, id_job) ";
			$sql = $sql . "VALUES('$item_nome', '$status', '$itemNivel', '$responsavel', '$data_entrada', '$timeStamp', '$caminho', '$briefing', '$observacoes', '$job')";


			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				//$_SESSION['inclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_OK.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				//$_SESSION['inclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/alert_ERROR.php'>";
				$banco->fecharConexao();
				return false;
			}
		}


		function cadastrarJob($nomejob, $timeStamp, $id_cliente)
		{

			// Insere o registro na tabela
			$sql = "INSERT INTO jobs  ";
			$sql = $sql . "(job, datacriacao, job_data_entrega, id_cliente) VALUES('$nomejob', NOW(),'$timeStamp','$id_cliente')";
			
			$banco = new Banco();
			
			if ($busca = mysql_query($sql))
			{
				$_SESSION['inclusao']="OK";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/job_cadastro.php'>";
				$banco->fecharConexao();
				return $busca;
			}
			else
			{
				$_SESSION['inclusao']="ERROR";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../job/job_cadastro.php'>";
				$banco->fecharConexao();
				return false;
			}
		}


		function listarCampanhas()
		{
			$sql = "SELECT * FROM jobs ORDER BY datacriacao ASC";
			
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

		function listarJobClientes()
		{
			$sql = "SELECT jobs.* , clientes.cliente AS cliente FROM  jobs INNER JOIN  clientes ON jobs.id_cliente = clientes.id WHERE ativo = '1'";
			
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



		// antigos -->



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