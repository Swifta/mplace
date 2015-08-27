<?php defined('SYSPATH') or die('No direct script access.');
class Soldout_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		
		/*
			Test for club membership and set conditions.
			@Live
		*/
		
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition = 'and for_store_cred = '.$_SESSION['Club'].' ':$this->club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition_arr = true:$this->club_condition_arr = false;
	}
	
	/* GET SOLD  OUT DEALS LIST */
	public function get_solddeals_list($cityid="")
	{
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition = 'and deals.for_store_cred = '.$_SESSION['Club'].' ':$this->club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition_arr = true:$this->club_condition_arr = false;
		
		if(CITY_SETTING){ 
			
			$conditions = "stores.city_id = $cityid  and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
			$conditions .=$this->club_condition." and (purchase_count = maximum_deals_limit or deals.enddate <".time()." )";
            $query = "select * from deals join category on category.category_id=deals.category_id  join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id where $conditions ";
            $result = $this->db->query($query);
			 
		 } else {
			$conditions = "stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
			$conditions .=$this->club_condition." and (purchase_count = maximum_deals_limit or deals.enddate <".time()." )";
            $query = "select * from deals join category on category.category_id=deals.category_id  join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id  where $conditions ";
            $result = $this->db->query($query);
		 
		 }
		 return $result; 
	}
	
	/* GET SOLD OUT PRODUCTS LIST */
	public function get_soldproducts_list($cityid="")
	{
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition = 'and product.for_store_cred = '.$_SESSION['Club'].' ':$this->club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition_arr = true:$this->club_condition_arr = false;
		
		if(CITY_SETTING){ 
				$conditions = "stores.city_id = $cityid and purchase_count = user_limit_quantity and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ".$this->club_condition." ";
				$query = "select * from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id where $conditions";
				$result = $this->db->query($query);
			return $result;
		} else {
			$conditions = "purchase_count = user_limit_quantity and stores.store_status = 1 ".$this->club_condition." and category.category_status = 1 and city.city_status = 1 ";
				$query = "select * from product join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id where $conditions";
				$result = $this->db->query($query);
			return $result;
			
		}
	}
	
	
	/* GET SOLD OUT AUCTION LIST */
	public function get_soldauction_list($cityid="")
	{
		
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition = 'and auction.for_store_cred = '.$_SESSION['Club'].' ':$this->club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition_arr = true:$this->club_condition_arr = false;
		
		if(CITY_SETTING){ 
			$query = " SELECT * FROM auction join users on users.user_id=auction.winner join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join country on country.country_id=city.country_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status != 0 and stores.city_id=$cityid and category.category_status = 1  ".$this->club_condition."  and city.city_status = 1 ";
			$result_high = $this->db->query($query); 
			return $result_high; 
		} else {
			$query = " SELECT * FROM auction join users on users.user_id=auction.winner join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join country on country.country_id=city.country_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status !=0 and category.category_status = 1  ".$this->club_condition."  and city.city_status = 1 ";
			$result_high = $this->db->query($query); 
			return $result_high; 
			
		} 
	}

}
