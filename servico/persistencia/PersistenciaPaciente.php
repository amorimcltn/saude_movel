<?php
require_once(dirname(__FILE__).'/../config.php');
require_once(FACHADA.'FachadaConectorBD.php');
require_once (CLASSES.'Paciente.php');
require_once (CLASSES.'InstanciaUnica.php');

class PersistenciaPaciente extends InstanciaUnica {
    
    public function adicionarPaciente($paciente) {        
        $nome = $paciente -> getNome();
        $idade = $paciente -> getIdade();
        $endereco = $paciente -> getEndereco();
        $patologias = $paciente -> getPatologias();
        $longitude = $paciente -> getLongitude();
        $latitude = $paciente -> getLatitude();

        $sql = "Insert into paciente values (default,'$nome','$idade','$endereco', '$latitude','$longitude','$patologias')";
		
        return FachadaConectorBD::getInstancia()->inserir($sql);
    }	

}
?>