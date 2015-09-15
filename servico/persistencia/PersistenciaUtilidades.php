<?php
require_once(dirname(__FILE__).'/../config.php');
require_once (FACHADA.'FachadaConectorBD.php');
require_once (CLASSES.'InstanciaUnica.php');
require_once(CLASSES . 'Profissional.php');
error_reporting(E_ALL ^ E_DEPRECATED);

class PersistenciaUtilidades extends InstanciaUnica{
	
	public function inserirToken($token, $cod_prof){		
		$sql = "INSERT INTO sessao
                      (token, cod_prof, data_hora)
                      VALUES
                      ('".$token."','".$cod_prof."', now())";			
        return FachadaConectorBD::getInstancia()->inserir($sql);		
	}
	
	public function selecionarCodigoUsuario($token){
		$dados_usuario = NULL;
		$sql = "SELECT cod_prof, data_hora FROM sessao WHERE token = '".$token."'";
		$registros = FachadaConectorBD::getInstancia()->consultar($sql);;
		$i = 0;
		if (!is_null($registros)){
			foreach ($registros as $registro){
				$dados_usuario[$i] = new Profissional();
				$dados_usuario[$i]->setCodProf($registro["cod_prof"]);
				$dados_usuario[$i]->setDataHora($registro["data_hora"]);
				$i++;
			}
		}
		return $dados_usuario;
	}	
	
	public function deletaToken($token){
		$sql = "delete from sessao where token = '".$token."'";
		$resposta = PersistenciaUtilidades::selecionarCodigoUsuario($token);
		if (!is_null($resposta)){
			return FachadaConectorBD::getInstancia()->deletar($sql);
		}else {
			return null;
		}
	}
	
}

?>
