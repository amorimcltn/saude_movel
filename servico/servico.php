<?php
require_once (dirname(__FILE__).'/config.php');
require_once (FACHADA. 'FachadaProfissional.php');
require_once (FACHADA. 'FachadaUtilidades.php');
require_once (SLIM. 'Slim.php');
require_once (UTILS. 'Utils.php');

\ Slim \ Slim :: registerAutoloader();

$app = new \ Slim \ Slim();

$app->get('/autenticacao/:cpf/:senha', function ($cpf, $senha) {
	$nativo[0] = FachadaProfissional :: getInstancia()->ValidarAcesso($cpf, $senha);
	if ($nativo != NULL) {
		$res = FachadaUtilidades :: getInstancia()->gerarToken(md5($cpf . $senha), $nativo[0]->getCodProf());
	}	
	if ($res != 1) {
		echo "@" . md5($cpf . $senha) . "@";
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
						$std->cod_prof = $visita->getCodProf();
						$std->cod_paciente = $visita->getCodPaciente();
						$std->nome = $visita->getNome();
						$std->idade = $visita->getIdade();
						$std->endereco = $visita->getEndereco();
						$std->patologias = $visita->getPatologias();
						$std->anotacoes = $visita->getAnotacoes();
						
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

$app->run();