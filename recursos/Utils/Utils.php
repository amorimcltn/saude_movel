<?php

function diffDate($d2, $type='', $sep='-')

	{
	$token_valido = false;
	//pega a hora atual do sistema (servidor)
	$d1 = date('Y-m-d');
	$d1 .= ' '.date('H:i:s');		

	if(strstr($d1,':')){
		$dh1 = explode(' ', $d1);
		$d1 = explode($sep, $dh1[0]);
		$d1_h = explode(':', $dh1[1]);
	} else{
		$d1 = explode($sep, $d1);
		$d1_h[0] = $d1_h[1] = $d1_h[2]= 0;}
	
	if(strstr($d2,':')){
		$dh2 = explode(' ', $d2);
		$d2 = explode($sep, $dh2[0]);
		$d2_h = explode(':', $dh2[1]);
	} else{
		$d2 = explode($sep, $d2);
		$d2_h[0] = $d2_h[1] = $d2_h[2]= 0;}
	
	switch ($type)
	{
		case 'A':
			$X = 31104000;
			break;
		case 'M':
			$X = 2592000;
			break;
		case 'D':
			$X = 86400;
			break;
		case 'H':
			$X = 3600;
			break;
		case 'MI':
			$X = 60;
			break;
		default:
			$X = 1;
	}
	
	$tempo_corrido_sessao = (((mktime($d1_h[0],$d1_h[1],$d1_h[2],$d1[1],$d1[2],$d1[0]) - mktime($d2_h[0],$d2_h[1],$d2_h[2],$d2[1],$d2[2],$d2[0]))/$X));
	if ($tempo_corrido_sessao <= TEMPO_SESSAO){
		$token_valido = true;
	}	
	return $token_valido;
}

?>
