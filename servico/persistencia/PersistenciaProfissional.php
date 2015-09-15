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
    	$sql = "SELECT DISTINCT pa.nome, pa.idade, pa.endereco, pa.patologias, v.* from paciente pa, 
    			profissional pro JOIN visita v ON v.cod_prof = pro.cod_prof where v.cod_paciente = pa.cod_paciente and v.cod_prof = 1";
    	
    	$registros = FachadaConectorBD::getInstancia() -> consultar($sql);
    	if (!is_null($registros)){
    		$i = 0;
    		foreach ($registros as $registro) {
    			$visita = new Visita();
    			$visita -> setCodProf($registro['cod_prof']);
    			$visita -> setCodPaciente($registro['cod_paciente']);
    			$visita -> setNome(utf8_encode($registro['nome']));
    			$visita -> setIdade($registro['idade']);
    			$visita -> setPatologias(utf8_encode($registro['patologias']));
    			$visita -> setEndereco(utf8_encode($registro['endereco']));
    			$visita -> setDataHora($registro['data_hora']);
    			$visita -> setAnotacoes(utf8_encode($registro['anotacoes']));
    			
    			$visitas[$i++] = $visita;
    		}
    		
    	}
    	
    	return $visitas;
    }
    
    public function adicionarUsuario(Profissional $usuario) {        
        $nome = $usuario -> getNome();
        $senha = $usuario -> getSenha();
        $cpf = $usuario -> getCpf();

        $sql = "Insert into profissional values (default,'$nome','$cpf','$senha')";
		
        return FachadaConectorBD::getInstancia()->inserir($sql);
    }	

}
?>