<?php
	
class TarefaService{

	private $conexao;
	private $tarefa;

	public function __construct(Conexao $conexao, Tarefa $tarefa){
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	public function inserir(){
		$query = 'call inserir(:tarefa)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
		$stmt->execute();
	}

	public function recuperar(){
		$query = '
			Select 
				t.id, s.status, t.tarefa 
			from
				 tb_tarefas as t 
				 left join tb_status as s on (t.id_status = s.id)
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar(){
		
		$query = 'call update_tarefas(:tarefa, :id)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		return $stmt->execute();
	}

	public function remover(){
		$query = 'delete from tb_tarefas where id = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id'));
		$stmt->execute();
	}

	public function marcarRealizada(){		
		$query = 'update tb_tarefas set id_status = ? where id = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id_status'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));
		return $stmt->execute();
	}

	public function recuperarTarefasPendentes(){
		$query = "
			Select 
				t.id, s.status, t.tarefa 
			from
				 tb_tarefas as t 
				 left join tb_status as s on (t.id_status = s.id)
			where 
				t.id_status = :id_status
		";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

?>