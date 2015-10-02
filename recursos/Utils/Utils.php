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

function pegaCoordenadas($endereco){
	$ch = curl_init();
	$params = http_build_query(array("address"=>$endereco));
	curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?".$params);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	
	$response = curl_exec($ch);
	curl_close($ch);	
	
	$obj = json_decode($response);
	
	$latitude = $obj->results[0]->geometry->location->lat;
    $longitude = $obj->results[0]->geometry->location->lng;
	$cordenadas[] = $latitude;
	$cordenadas[] = $longitude;
	return $cordenadas;
}

?>
