<?php 

class Conexao {

	private $host = 'localhost';
	private $dbname = 'tarefas';
	private $user = 'root';
	private $pass = '';

	public function conectar(){
		try {
			
			$conexão = new PDO (
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"

			);

			return $conexão;

		} catch (PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}

}

?>