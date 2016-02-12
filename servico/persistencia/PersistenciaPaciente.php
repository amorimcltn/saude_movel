<?php
require_once(dirname(__FILE__).'/../config.php');
require_once(FACHADA.'FachadaConectorBD.php');
require_once (CLASSES.'Paciente.php');
require_once (CLASSES.'InstanciaUnica.php');

class PersistenciaPaciente extends InstanciaUnica {
    
    public function adicionarPaciente($paciente) {        
        $nome = $paciente -> getNome();
        $nascimento = $paciente -> getNascimento();
        $sexo = $paciente -> getSexo();
        $rua = $paciente -> getRua();
        $numero = $paciente -> getNumero();
        $bairro = $paciente -> getBairro();
        $cidade = $paciente -> getCidade();
        $estado = $paciente -> getEstado();
        $cep = $paciente -> getCep();
        $patologias = $paciente -> getPatologias();
        $longitude = $paciente -> getLongitude();
        $latitude = $paciente -> getLatitude();
        $prioridade = $paciente -> getPrioridade();

        $sql = "Insert into paciente values (default,'$nome','$nascimento','$rua','$numero','$bairro','$cidade',
        				'$estado','$cep','$latitude','$longitude','$patologias','$prioridade')";
		
        return FachadaConectorBD::getInstancia()->inserir($sql);
    }	

}
?>