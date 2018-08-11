<?php
require_once '../define.php';
class Connection {

	private $link;
	
	public function openConnection() {
		// PDO("mysql:host=localhost;dbname=nome_banco", "root", "sua_senha");

		$opcoes = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' );
		
		// $this->link = mysql_connect(HOST, USUARIO, SENHA);
		$this->link = new PDO("mysql:host=HOST;dbname=DATABASE,charset=utf8", "USUARIO", "SENHA", $opcoes);
		//mysql_select_db(DATABASE);
	}
	
	public function closeConnection() {
		// mysql_close($this->link);
		$this->link = null;
	}
}

?>