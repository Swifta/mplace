<?php if(defined('SYSPATH') or die('No direct access allowed.'))?>
<?php

class Balance_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function get_user_balance_by_id($user_id){
		
		$this->db->where(array('user_id'=>$user_id, 'user_type'=>'3', 'user_status'=>'1' ));
		$result = $this->db->get('users');
		
		return $result[0]->merchant_account_balance;	
	}
	
}

?>