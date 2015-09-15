<?php
require_once(CLASSES.'InstanciaUnica.php');
require_once (CLASSES. 'Profissional.php');
require_once(PERSISTENCIA.'PersistenciaUtilidades.php');

class FachadaUtilidades extends InstanciaUnica{
	
	public function gerarToken($token, $cod_prof){
		return PersistenciaUtilidades::getInstancia()->inserirToken($token, $cod_prof);
	}
	
	public function removerToken($token){
		return PersistenciaUtilidades::getInstancia()->deletaToken($token);
	}
	
	public function recuperarCodigoUsuario($token){
		$nativo_usuario = PersistenciaUtilidades::getInstancia()->selecionarCodigoUsuario($token);
		$dados_usuario = new Profissional();
		if (!is_null($nativo_usuario)) {
			foreach ($nativo_usuario as $dados) {
				$dados_usuario->cod_prof = $dados->getCodProf();
				$dados_usuario->data_hora = $dados->getDataHora();
			}
		}
		return $dados_usuario;
	}
	
	
} 

?>
