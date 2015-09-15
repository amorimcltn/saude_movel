<?php

class Paciente {
	
	public $cod_paciente;	
	public $nome;
	public $idade;
	public $endereco;
	public $patologias;
	
	public function setCodPaciente($cod_paciente){
		$this->cod_paciente = $cod_paciente;
	}		
	
	public function getCodPaciente(){
		return $this->cod_paciente;
	}	
	
	public function setNome($nome){
		$this->nome = $nome;
	}
		
	public function getNome(){
		return $this->nome;
	}	

	public function setIdade($idade){
		$this->idade = $idade;
	}
	
	public function getIdade(){
		return $this->idade;
	}	
	
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	
	public function getEnderedo(){
		return $this->endereco;
	}	
	
	public function setPatologias($patologias){
		$this->patologias = $patologias;
	}
	
	public function getPatologias(){
		return $this->patologias;
	}	
	
}

?>
