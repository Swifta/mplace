<?php if(defined('SYSPATH') or die('No direct access allowed.')); ?>
<?php 
	
	class Balance_Controller extends Controller{
		
		function __construct(){
			parent::__construct();
			$this->balance_model = new Balance_Model();
		}
		
		function index(){
			
			$fn = $this->balance_model->get_user_balance_by_id(157);
			echo $fn;
			
		}
		
	}
?>