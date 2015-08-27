<?php 
	if(defined('SYSPATH') or die('No direct access allowed.'));
?>

<?php

	class Sample_Controller extends Controller {

		//echo "Hi";
		
		/*$client = new SoapClient("http://54.173.157.210:9765/Provisioning_1.0.0/services/provisioning?wsdl");
		
		
		$mtds = $client->__getFunctions();
		
		
		var_dump($mtds);
		echo $mtds[0];*/
		
		function index(){
		
		
		$client = new SoapClient("http://www.webservicex.com/globalweather.asmx?wsdl", array('exceptions'=>0, 'encoding'=>'UTF-8'));
		$mtds = $client->__getFunctions();
		var_dump($mtds);
		echo "\n".$mtds[0];
		
		try{
		$weather = $client->GetWeather(array('CityName'=>'Lagos','CountryName'=>'Nigeria'));
		
		if(is_soap_fault($weather)){
			var_dump("Error");
			trigger_error("Whoa!", E_USER_WARNING);
			exit(0);
		}
		
		}catch(Exception $e){
			var_dump("Exception");
			exit(0);
		}
		var_dump($weather);
		
		
		
		
		
		$response = $weather->GetWeatherResult;
		
		var_dump($response);
		$p = xml_parser_create();
		$vals = array();
		$index = array();
		
		$response_clean = str_replace('encoding="utf-16"', "", $response);
		
		;
		if(xml_parse_into_struct($p, $response_clean, $vals, $index) == 1){
			xml_parser_free($p);
			var_dump($vals);
			var_dump($index);
			
			$xmlObj = simplexml_load_string($response_clean);
			var_dump($xmlObj);
			
		}else{
			echo "Could not parse the string.";
			exit(-1);
		}
		
		
		}
		
		//exit(-1);
	}

?>
