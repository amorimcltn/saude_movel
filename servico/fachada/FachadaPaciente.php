<?php
require_once(CLASSES.'InstanciaUnica.php');
require_once(PERSISTENCIA.'PersistenciaPaciente.php');

class FachadaPaciente extends InstanciaUnica{

	public function adicionarPaciente($paciente){
		$id = PersistenciaPaciente::getInstancia()->adicionarPaciente($paciente);

		return $id;
	}
	


}

?>