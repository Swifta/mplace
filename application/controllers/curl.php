<?php if(defined('SYSPATH') or die('No direct access allowed ssebo')); ?>

<?php 

	class CURL_Controller extends Controller{
		function index(){
			
			$curl = curl_init('https://www.google.co.ug');
			$fp = fopen("mean.txt", "w");
			curl_setopt($curl, CURLOPT_FILE, $fp);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_exec($curl);
			curl_close($curl);
			fclose($fp);
			echo "Hi pipo.";
		}
	}

?>