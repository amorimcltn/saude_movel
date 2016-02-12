<?php
require_once(CLASSES.'InstanciaUnica.php');
require_once(PERSISTENCIA.'PersistenciaProfissional.php');

class FachadaProfissional extends InstanciaUnica{

	public function validarAcesso($cpf, $senha){
        $usuarios = PersistenciaProfissional::getInstancia()->selecionarPorCpfSenha($cpf, $senha);
        if($usuarios!=NULL){
            return $usuarios[0];
        } else { 
        	return NULL; 
        }
	}
	
	public function listarUsuarioPorCodigo($cod_prof){
        $usuarios = PersistenciaProfissional::getInstancia()->selecionarPorCodigo($cod_prof);
        if($usuarios!=NULL){
            return $usuarios[0];
        } else { 
        	return NULL; 
        }
	}
	public function adicionarUsuario($usuario){
		$id = PersistenciaProfissional::getInstancia()->adicionarUsuario($usuario);

		return $id;
	}
	
	public function listarVisitasPorUsuario($cod_prof){
		$visitas = PersistenciaProfissional::getInstancia()->selecionarVisitasPorUsuario($cod_prof);
		if ($visitas != NULL){
			return $visitas;
		} else {
			return NULL;
		}
	}
	
	public function atualizaVisitaPaciente($visita){
		return PersistenciaProfissional::getInstancia()->updateVisitaPaciente($visita);
	}

}

?>