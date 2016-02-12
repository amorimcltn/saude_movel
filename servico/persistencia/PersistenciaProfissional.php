<?php
require_once(dirname(__FILE__).'/../config.php');
require_once(FACHADA.'FachadaConectorBD.php');
require_once (CLASSES.'Profissional.php');
require_once (CLASSES.'Visita.php');
require_once (CLASSES.'InstanciaUnica.php');

class PersistenciaProfissional extends InstanciaUnica {
    
    public function selecionarPorCpfSenha($cpf, $senha) {
        $usuarios = NULL;

        $sql = "SELECT * FROM profissional WHERE cpf = '" . $cpf . "' AND senha = '" . $senha . "'";
        $registros = FachadaConectorBD::getInstancia() -> consultar($sql);

        if (!is_null($registros)) {
            $i = 0;
            //Percorre array que retornou do banco de dados e cria um objeto do tipo Profissional
            foreach ($registros as $registro) {
                $usuario = new Profissional();
                $usuario -> setCodProf($registro['cod_prof']);
                $usuario -> setNome($registro['nome']);
				$usuario -> setCpf($registro['cpf']);
				$usuario -> setSenha($registro['senha']);
                
                $usuarios[$i++] = $usuario;   
            }
        }

        return $usuarios;
    }
	
	public function selecionarPorCodigo($cod_prof) {
        $usuarios = NULL;

        $sql = "SELECT * FROM profissional WHERE cod_prof = " . $cod_prof;
        $registros = FachadaConectorBD::getInstancia() -> consultar($sql);

        if (!is_null($registros)) {
            $i = 0;
            //Percorre array que retornou do banco de dados e cria um objeto do tipo Profissional
            foreach ($registros as $registro) {
                $usuario = new Profissional();
                $usuario -> setCodProf($cod_prof);
                $usuario -> setNome($registro['nome']);
				$usuario -> setCpf($registro['cpf']);
				
                $usuarios[$i++] = $usuario;   
            }
        }
        return $usuarios;
    }

    public function selecionarVisitasPorUsuario($cod_prof){
    	$visitas = NULL;
    	$sql = "SELECT DISTINCT pa.nome, pa.nascimento, pa.sexo, pa.rua, pa.numero, pa.bairro, pa.cidade, pa.estado, pa.cep, pa.latitude, pa.longitude, 
    			pa.patologias, pa.prioridade, v.* from paciente pa, profissional pro 
    			JOIN visita v ON v.cod_prof = pro.cod_prof where v.cod_paciente = pa.cod_paciente and v.cod_prof = ".$cod_prof." and v.status <> 1 ORDER BY pa.nascimento";
    	
    	$registros = FachadaConectorBD::getInstancia() -> consultar($sql);
    	if (!is_null($registros)){
    		$i = 0;
    		foreach ($registros as $registro) {
    			$visita = new Visita();
    			$visita -> setCodVisita($registro['cod_visita']);
    			$visita -> setCodProf($registro['cod_prof']);
    			$visita -> setCodPaciente($registro['cod_paciente']);
    			$visita -> setNome(utf8_encode($registro['nome']));
    			$visita -> setNascimento($registro['nascimento']);
    			$visita -> setSexo($registro['sexo']);
    			$visita -> setPatologias(utf8_encode($registro['patologias']));
    			$visita -> setRua(utf8_encode($registro['rua']));
    			$visita -> setNumero($registro['numero']);
    			$visita -> setBairro(utf8_encode($registro['bairro']));
    			$visita -> setCidade(utf8_encode($registro['cidade']));
    			$visita -> setEstado(utf8_encode($registro['estado']));
    			$visita -> setCep($registro['cep']);
    			$visita -> setLatitude($registro['latitude']);
    			$visita -> setLongitude($registro['longitude']);
    			$visita -> setDataHora($registro['data_hora']);
    			$visita -> setDataVisita($registro['data_visita']);
    			$visita -> setStatus($registro['status']);
    			$visita -> setAnotacoes(utf8_encode($registro['anotacoes']));
    			$visita -> setPrioridade($registro['prioridade']);
    			
    			$visitas[$i++] = $visita;
    		}
    		
    	}
    	
    	return $visitas;
    }
    
    public function adicionarUsuario($usuario) {        
        $nome = $usuario -> getNome();
        $senha = $usuario -> getSenha();
        $cpf = $usuario -> getCpf();

        $sql = "Insert into profissional values (default,'$nome','$cpf','$senha')";
		
        return FachadaConectorBD::getInstancia()->inserir($sql);
    }	
    
    public function updateVisitaPaciente($visita) {
    	$cod_paciente = $visita -> getCodPaciente();
    	$patologias = $visita -> getPatologias();
    	$anotacoes = $visita -> getAnotacoes();
    	$data_hora = $visita -> getDataHora();
    	$prioridade = $visita -> getPrioridade();
    	
    	$sql = "UPDATE visita SET anotacoes = '".$anotacoes."', data_hora = '".$data_hora."', status = '1' where cod_paciente = '".$cod_paciente."'";
    	$res = FachadaConectorBD::getInstancia()->atualizar($sql);
    	$sql = "UPDATE paciente SET patologias = '".$patologias."', prioridade = '".$prioridade."' where cod_paciente = '".$cod_paciente."'";
    	$res = FachadaConectorBD::getInstancia()->atualizar($sql);
    	return $res;
    }    

}
?>