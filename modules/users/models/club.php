<?php defined('SYSPATH') or die('No direct script access.');
class Club_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		$this->UserID = $this->session->get("UserID");
	}
}
?>
