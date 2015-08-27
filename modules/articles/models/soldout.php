<?php defined('SYSPATH') or die('No direct script access.');
class Soldout_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
	}
	
	/* GET SOLD  OUT DEALS LIST */
	public function get_solddeals_list($cityid="")
	{
		if(CITY_SETTING){ 
			
			$conditions = "stores.city_id = $cityid  and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
			$conditions .=" and (purchase_count = maximum_deals_limit or deals.enddate <".time()." )";
            $query = "select * from deals join category on category.category_id=deals.category_id  join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id where $conditions ";
            $result = $this->db->query($query);
			 
		 } else {
			$conditions = "stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
			$conditions .=" and (purchase_count = maximum_deals_limit or deals.enddate <".time()." )";
            $query = "select * from deals join category on category.category_id=deals.category_id  join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id  where $conditions ";
            $result = $this->db->query($query);
		 
		 }
		 return $result; 
	}
	
	/* GET SOLD OUT PRODUCTS LIST */
	public function get_soldproducts_list($cityid="")
	{
		if(CITY_SETTING){ 
				$conditions = "stores.city_id = $cityid and purchase_count = user_limit_quantity and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
				$query = "select * from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id where $conditions";
				$result = $this->db->query($query);
			return $result;
		} else {
			$conditions = "purchase_count = user_limit_quantity and stores.store_status = 1 and category.category_status = 1 and city.city_status = 1 ";
				$query = "select * from product join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id where $conditions";
				$result = $this->db->query($query);
			return $result;
			
		}
	}
	
	
	/* GET SOLD OUT AUCTION LIST */
	public function get_soldauction_list($cityid="")
	{
		if(CITY_SETTING){ 
			$query = " SELECT * FROM auction join users on users.user_id=auction.winner join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join country on country.country_id=city.country_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status != 0 and stores.city_id=$cityid and category.category_status = 1 and city.city_status = 1 ";
			$result_high = $this->db->query($query); 
			return $result_high; 
		} else {
			$query = " SELECT * FROM auction join users on users.user_id=auction.winner join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join country on country.country_id=city.country_id join category on category.category_id=auction.category_id where auction.winner != 0 and auction.auction_status !=0 and category.category_status = 1 and city.city_status = 1 ";
			$result_high = $this->db->query($query); 
			return $result_high; 
			
		} 
	}

}
