<?php if(defined('SYSPATH') or die('No direct access allowed.'))?>

<?php 

class Transaction_Controller extends Controller{
	
	
	public function index(){
		$txn = new Transact_Model();
		$row = $txn->get_transactions();
		var_dump($row);
		echo $row[0]->firstname;
	}
}
?>