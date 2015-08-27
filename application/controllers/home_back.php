<?php if(defined('SYSPATH') or die('No direct access allowed')); ?>
<?php 
class Home_Controller extends Website_Controller {
	
	//public $template = "home_template";
	
	
	public function index(){
		//echo "Hi";
		/*
		$client = new SoapClient("http://54.173.157.210:9765/Provisioning_1.0.0/services/provisioning?wsdl");
		$mtd = $client->__getFunctions();
		var_dump($mtd);
		*/
		
		
		
		
		
		
		$client = new SoapClient("http://www.webservicex.com/globalweather.asmx?wsdl", array('exceptions'=>0));
		$mtds = $client->__getFunctions();
		
		var_dump($mtds);
		
		
	
		$weather = $client->GetWeather(array('CountryName'=>'Kenya'));
		
		
		if(!is_soap_fault($weather)){
			var_dump($weather);
		}else{
			var_dump("Error.");
			
		}
		
		exit(0);
		
		
		$xml_string = $weather->GetWeatherResult;
		
		//$xml_string_cleaned = str_replace('encoding="utf-16"', "", $xml_string);
		
		//var_dump($xml_string_cleaned);
		
		
		
		
	/*	$xml_string = "<?xml version='1.0' encoding='utf-8' ?> 
<document>
 <title>Forty What?</title>
 <from>Joe</from>
 <to>Jane</to>
 <body>
  I know that's the answer -- but what's the question?
 </body>
</document>";*/
		
	var_dump($xml_string);
		
		/*
			$xml_obj = simplexml_load_string($xml_string_cleaned);
			if($xml_obj){
				
				var_dump($xml_obj);
			}else{
				var_dump("Error occured while converting xml string to object");
			}*/
			
		
		
		
		
		
		
		
		
		
		
		exit(0);
	}
}
?>
