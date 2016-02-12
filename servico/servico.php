<?php
require_once (dirname(__FILE__).'/config.php');
require_once (FACHADA. 'FachadaProfissional.php');
require_once (FACHADA. 'FachadaPaciente.php');
require_once (FACHADA. 'FachadaUtilidades.php');
require_once (CLASSES. 'Paciente.php');
require_once (SLIM. 'Slim.php');
require_once (UTILS. 'Utils.php');

\ Slim \ Slim :: registerAutoloader();

$app = new \ Slim \ Slim();

$app->get('/autenticacao/:cpf/:senha', function ($cpf, $senha) {
	$nativo[0] = FachadaProfissional :: getInstancia()->ValidarAcesso($cpf, $senha);
	if (!is_null($nativo[0])) {
		FachadaUtilidades::getInstancia()->removerToken(md5($cpf . $senha));
		$res = FachadaUtilidades :: getInstancia()->gerarToken(md5($cpf . $senha), $nativo[0]->getCodProf());
		if ($res != 1) {
			echo md5($cpf . $senha);
		}			
	} else {
		echo "-1";
	}

});


$app->get('/dadosusuario/:token', function ($token) { 
	//recuperar codigo do usuario pelo token recebido do app											
	$dados_usuario = FachadaUtilidades :: getInstancia()->recuperarCodigoUsuario($token);	
	if ($dados_usuario->getCodProf() != null) {		
		if (diffDate($dados_usuario->getDataHora(), 'MI')){				
			$dados_usuario_nativo = FachadaProfissional::getInstancia()->listarUsuarioPorCodigo($dados_usuario->getCodProf());
			if (!is_null($dados_usuario_nativo)){				
				$usuario = new Profissional();
				$usuario->cod_prof = $dados_usuario_nativo->getCodProf();
				$usuario->nome = $dados_usuario_nativo->getNome();
				$usuario->cpf = $dados_usuario_nativo->getCpf();							
			}	
			echo json_encode($usuario);
		} else {
			FachadaUtilidades::getInstancia()->removerToken($token);
			echo "session expired!";
		}
	}	
});

	$app->get('/visitas/:token', function ($token) {
		//recuperar codigo do usuario pelo token recebido do app
		$dados_usuario = FachadaUtilidades :: getInstancia()->recuperarCodigoUsuario($token);
		if ($dados_usuario->getCodProf() != null) {
			if (diffDate($dados_usuario->getDataHora(), 'MI')){
				$dados_visita_nativo = FachadaProfissional::getInstancia()->listarVisitasPorUsuario($dados_usuario->getCodProf());
				if (!is_null($dados_visita_nativo)){
					$visitas = NULL;
					foreach ($dados_visita_nativo as $visita) {
						$std = new Visita();
						$std->cod_visita = $visita->getCodVisita();
						$std->cod_prof = $visita->getCodProf();
						$std->cod_paciente = $visita->getCodPaciente();
						$std->nome = $visita->getNome();
						$std->nascimento = $visita->getNascimento();
						$std->sexo = $visita->getSexo();
						$std->rua = $visita->getRua();
						$std->numero = $visita->getNumero();
						$std->bairro = $visita->getBairro();
						$std->cidade = $visita->getCidade();
						$std->estado = $visita->getEstado();
						$std->cep = $visita->getCep();
						$std->patologias = $visita->getPatologias();
						$std->anotacoes = $visita->getAnotacoes();
						$std->latitude = $visita->getLatitude();
						$std->data_hora = $visita->getDataHora();
						$std->data_visita = $visita->getDataVisita();
						$std->status = $visita->getStatus();
						$std->longitude = $visita->getLongitude();
						$std->prioridade = $visita->getPrioridade();

						$visitas[] = $std;
						
					}
					
					echo json_encode($visitas, JSON_UNESCAPED_UNICODE);
				}
				
			} else {
				FachadaUtilidades::getInstancia()->removerToken($token);
				echo "session expired!";
			}
		}
	});

$app->get('/cadastrousuario/:nome/:cpf/:senha', function ($nome, $cpf, $senha) {
			$usuario = new Profissional();
			$usuario->nome = $nome;
			$usuario->cpf = $cpf;
			$usuario->senha = $senha;

			$id = FachadaProfissional::getInstancia()->adicionarUsuario($usuario);
			echo "@" .$id. "@";
	});
	
$app->get('/finalizar/:visitas', function ($visitas) {
		$lista = json_decode($visitas);
		foreach ($lista as $visita){
			$std = new Visita();
			$std->cod_paciente = $visita->{'cod_paciente'};			
			$std->patologias = $visita->{'patologias'};
			$std->anotacoes = $visita->{'anotacoes'};			
			$std->data_hora = $visita->{'data_hora'};			
			$std->prioridade = $visita->{'prioridade'};
			$res = FachadaProfissional::getInstancia()->atualizaVisitaPaciente($std);
		}	
		echo $res;
	});
	
$app->get('/cadastropaciente/:nome/:nascimento/:sexo/:rua/:numero/:bairro/:cidade/:estado/:cep/:patologias/:prioridade', function ($nome, $nascimento, $sexo, $rua, $numero, $bairro, $cidade, $estado, $cep, $patologias, $prioridade) {
		$paciente = new Paciente();
		$paciente->nome = $nome;
		$paciente->nascimento = $nascimento;
		$paciente->sexo = $sexo;
		$paciente->rua = $rua;
		$paciente->numero = $numero;
		$paciente->bairro = $bairro;
		$paciente->cidade = $cidade;
		$paciente->estado = $estado;	
		$paciente->cep = $cep;
		$paciente->patologias = $patologias;
		$cordenadas = pegaCoordenadas($rua.", ".$numero." - ".$bairro.", ".$cidade." - ".$estado.", ".$cep);
		$paciente->latitude = $cordenadas[0];
		$paciente->longitude = $cordenadas[1];
		$paciente->prioridade = $prioridade;
	
		$id = FachadaPaciente::getInstancia()->adicionarPaciente($paciente);
		echo "@" .$id. "@";
	});

$app->run();