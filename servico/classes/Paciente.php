<?php

class Paciente {
	
	public $cod_paciente;	
	public $nome;
	public $idade;
	public $endereco;
	public $latitude;
	public $longitude;
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
	
	public function getEndereco(){
		return $this->endereco;
	}	
	
	public function setLongitude($longitude){
		$this->longitude = $longitude;
	}
	
	public function getLongitude(){
		return $this->longitude;
	}
	
	public function setLatitude($latitude){
		$this->latitude = $latitude;
	}
	
	public function getLatitude(){
		return $this->latitude;
	}	
	
	public function setPatologias($patologias){
		$this->patologias = $patologias;
	}
	
	public function getPatologias(){
		return $this->patologias;
	}	
	
}

?>
