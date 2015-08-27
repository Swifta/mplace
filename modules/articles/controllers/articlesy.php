<?php  defined('SYSPATH') or die('No Direct Access allowed.');?>
<?php 

class Articles_Controller extends Website_Controller{
	const ALLOW_PRODUCTION = FALSE;
	
	public $template = 'bank_registration_template/template';
	
	function __construct(){
		
		parent::__construct();
	}
	
	
	public function index()
	{

		$this->admin_dashboard_data = $this->admin->get_admin_dashboard_data();
		$this->balance = $this->admin->get_admin_balance1();
		$this->user_list = $this->admin->get_user_list();
		$this->transaction_list = $this->admin->get_transaction_list();
		$this->deals_transaction_list = $this->admin->get_transaction_chart_list();
		$this->template->content = new View("admin/home");
		$this->template->title = $this->Lang["ADMIN_DASHBOARD"];
	}

	
	
	function  register_bank(){
		$this->template->content = new View('admin/login');
		$this->template->title = 'Bank Registration';
		$this->template->render(TRUE);
		
		
	}
}

?>