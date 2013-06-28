<?php
	
	$array_days = array('DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB');
	$array_days_full = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
	$week_day = date('w');
	$xml = false;
	$actual_grad = '';
			
	function getURLContents($query){
		$c = curl_init();  
		curl_setopt($c, CURLOPT_URL, $query);  
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);  
		  
		// execute the cURL  
		$data = curl_exec($c);  
		curl_close($c);  
		return $data;
	}
	
	function formatQuery($yql){
		$query = "http://query.yahooapis.com/v1/public/yql?q=";
		$query .= urlencode($yql);
		$query .= "&format=json";
		$result = json_decode(getURLContents($query));
		return $result->query->results->p;
	}	
	
	function getWeather(){
		global $xml;
		$xmlpath = 'http://servicos.cptec.inpe.br/XML/cidade/1156/previsao.xml';
		if(@file($xmlpath)){
			$xmlstring = getURLContents($xmlpath);
			$xml = $xmlstring != '' ? new SimpleXMLElement($xmlstring) : false;
		}
	}
	
	function getActualGrad(){
		global $actual_grad;
		$siteurl = 'http://br.weather.com/weather/local/BRXX1364?x=0&y=0';
		$actual_grad = formatQuery("select * from html where url='" . $siteurl . "' and xpath='//td[@class=\\'obsTempText\\']/p'");
		$actual_grad = str_ireplace('C', '', $actual_grad);
	}
	
	function getWeatherImage($string, $small){
		$img = '<img ';
		if(!$small) $img .= 'id="big_image_weather" ';
		$img .= 'src="' . get_bloginfo('template_url') . '/images/weather/';
		switch($string){
			case 'c':
			case 'ch':
			case 'cv':
			case 'ec':
				$img .= 'chuva';
				break;
			case 'cl':
			case 'ps':
			case 'vn':
				$img.= 'sol';
				break;
			case 'e':
			case 'mn':
			case 'n':
			case 'nb':
			case 'nnv':
			case 'nv':
				$img .= 'nuvens';
				break;
			case 'ppt':
			case 'psc':
			case 'pt':
			case 'ci':
			case 'cm':
			case 'ct':
			case 'in':
			case 'ncm':
			case 'nct':
			case 'npp':
			case 'pcm':
			case 'pct':
			case 'pm':
			case 'ppm':
			case 'pp':
				$img .= 'sol_chuva';
				break;
			case 't':
			case 'de':
			case 'np':
			case 'npm':
			case 'npt':
			case 'pc':
				$img .= 'tempestade';
				break;
			case 'g':
				$img .= 'geada';
				break;
			case 'ne':
			case 'ge':
				$img .= 'neve';
				break;
			case 'ncl':
				$img .= 'noite';
				break;
			case 'nnb':
				$img .= 'noite_nuvens';
				break;
			case 'cn':
			case 'nch':
			case 'nci':
			case 'ncn':
			case 'npc':
			case 'npn':
			case 'pcn':
			case 'pnt':
			case 'ppn':
				$img .= 'noite_chuva';
				break;
			default:
				$img .= 'sol_nuvens';
				break;
		}
		if($small) $img .= '_p';
		$img .= '.png" alt="' . $string . '" />';
		return $img;
	}
	
	getWeather();
	getActualGrad();
?>