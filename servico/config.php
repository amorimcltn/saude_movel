<?php

define('MODULO_DIRETORIO', dirname(__FILE__).'/');
define('RECURSOS', MODULO_DIRETORIO.'../recursos/');
define('SLIM', RECURSOS.'Slim/');
define('UTILS', RECURSOS.'Utils/');
define('SERVICO', MODULO_DIRETORIO.'../../saude-movel-sw/servico/');
define('FACHADA', SERVICO.'fachada/');
define('CLASSES', SERVICO.'classes/');
define('PERSISTENCIA', SERVICO.'persistencia/');

//Sessao com tokens
define('TEMPO_SESSAO', 315);

//Configuracoes do banco de dados
//define('ACESSO_SERVIDOR_SERVICO','localhost');
//define('ACESSO_USUARIO_SERVICO','root');
//define('ACESSO_SENHA_SERVICO','');
//define('ACESSO_NOME_BANCO_SERVICO','saude_movel_servico');

define('ACESSO_SERVIDOR_SERVICO','localhost');
define('ACESSO_USUARIO_SERVICO','1145626');
define('ACESSO_SENHA_SERVICO','saudemovel0587');
define('ACESSO_NOME_BANCO_SERVICO','1145626');

?>

