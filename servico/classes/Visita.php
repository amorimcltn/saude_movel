<?php

class Visita {
	
	public $cod_prof;
	public $cod_paciente;	
	public $nome;
	public $idade;
	public $endereco;
	public $longitude;
	public $latitude;
	public $patologias;
	public $data_hora;
	public $anotacoes;
	
	public function setCodProf($cod_prof){
		$this->cod_prof = $cod_prof;
	}
	
	public function getCodProf(){
		return $this->cod_prof;
	}	
	
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
	
	public function setDataHora($data_hora){
		$this->data_hora = $data_hora;
	}
	
	public function getDataHora(){
		return $this->data_hora;
	}	
	
	public function setAnotacoes($anotacoes){
		$this->anotacoes = $anotacoes;
	}
	
	public function getAnotacoes(){
		return $this->anotacoes;
	}	
	
}

?>

