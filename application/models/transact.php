<?php if(defined('SYSPATH') or die("No direct access allowed"));?>

<?php 
  class Transact_Model extends Model{
	  public function __construct(){
		  parent::__construct();
	  }
	  
	  public function get_transactions(){
		  $this->db->where('id', 1);
		  return $this->db->get('transaction');
	  }
  }
?>