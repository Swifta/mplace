<?php 
if(defined('SYSPATH') or die("No Direct access allowed."));
class Test_Controller extends Template_Controller{
	public $template = 'test_template/template';
	//public $auto_render = TRUE;
	public function __contstruct(){
		parent::__construct();
	}
	function test(){
		
		//echo "Yes, we here.";
		$this->template->content = new View('test');
		//$this->template->render(TRUE);
		//$this->template->content = new View('test');
		//$this->template->render(TRUE);
		
	}
}
?>