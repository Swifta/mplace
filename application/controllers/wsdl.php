<?php if(defined('SYSPATH') or die('No direct access allowed.')); ?>
<?php 
	
	class WSDL_Controller extends Controller{
		
		function __construct(){
			parent::__construct();
			$this->balance_model = new Balance_Model();
		}
		
		function index(){
			
			$fn = $this->balance_model->get_user_balance_by_id(157);
			echo $fn;
			
		}
		
		function generate_wsdl(){
			
			require_once(APPPATH.'ws/zend-soap/zend-soap-master/vendor/autoload.php');
			$auto_d = new Zend\Soap\AutoDiscover();
			/*
				var_dump($auto_d);
			*/
			
			$wsdl = $auto_d->generate();
			
			
			
			
		}
		
	}
?>