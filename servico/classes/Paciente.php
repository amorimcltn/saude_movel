<?php

class Paciente {
	
	public $cod_paciente;	
	public $nome;
	public $nascimento;
	public $sexo;
	public $rua;
	public $numero;
	public $bairro;
	public $cidade;
	public $estado;	
	public $cep;
	public $latitude;
	public $longitude;
	public $patologias;
	public $prioridade;
	
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

	public function setNascimento($nascimento){
		$this->nascimento = $nascimento;
	}
	
	public function getNascimento(){
		return $this->nascimento;
	}	
	
	public function setSexo($sexo){
		$this->sexo = $sexo;
	}
	
	public function getSexo(){
		return $this->sexo;
	}	
	
	public function setRua($rua){
		$this->rua = $rua;
	}
	
	public function getRua(){
		return $this->rua;
	}
	
	public function setNumero($numero){
		$this->numero = $numero;
	}
	
	public function getNumero(){
		return $this->numero;
	}	
	
	public function setBairro($bairro){
		$this->bairro = $bairro;
	}
	
	public function getBairro(){
		return $this->bairro;
	}	
	
	public function setCidade($cidade){
		$this->cidade = $cidade;
	}
	
	public function getCidade(){
		return $this->cidade;
	}	
	
	public function setEstado($estado){
		$this->estado = $estado;
	}
	
	public function getEstado(){
		return $this->estado;
	}
	
	public function setCep($cep){
		$this->cep = $cep;
	}
	
	public function getCep(){
		return $this->cep;
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
	
	public function setPrioridade($prioridade){
		$this->prioridade = $prioridade;
	}
	
	public function getPrioridade(){
		return $this->prioridade;
	}	
	
}

?>
