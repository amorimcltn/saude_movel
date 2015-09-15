<?php

class Profissional {
	
	public $cod_prof;
	public $data_hora;
	public $nome;
	public $cpf;
	public $senha;
	
	public function setCodProf($cod_prof){
		$this->cod_prof = $cod_prof;
	}
	
	public function setDataHora($data_hora){
		$this->data_hora = $data_hora;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function getCodProf(){
		return $this->cod_prof;
	}
	
	public function getDataHora(){
		return $this->data_hora;
	}
	
	public function getNome(){
		return $this->nome;
	}

	public function getCpf(){
		return $this->cpf;
	}
	
	public function getSenha(){
		return $this->senha;
	}	
	
	public function setSenha($senha){
		$this->senha = $senha;
	}	
	
}

?>
