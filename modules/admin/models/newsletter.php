<?php defined('SYSPATH') or die('No direct script access.');
class Newsletter_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();	
		$this->UserID = $this->session->get("UserID");
		
	}
	
	/** GET SUBSCRIBER DATA **/
	
	public function subscriber_list($offset = "", $record = "")
	{
		$result = $this->db->select("email_subscribe.*","city.city_name")->from("email_subscribe")
				->join("city","city.city_id","email_subscribe.city_id")
				->limit($record, $offset)
				->get();
				
		return $result;
	}
	
	/** COUNT OF RECORDS **/
	
	public function subscriber_list_count()
	{
		$result = $this->db->from("email_subscribe")
		->get();

		return count($result);
	}
	/** BLOCK UNBLOCK SUBSCRIBE **/
	
	public function blockunblocksubscriber($type = "",$user_id = "" )
	{  
	$status=0;
        if($type == 1){
          $status=1;
        }
        $result = $this->db->update("email_subscribe", array("suscribe_status" => $status), array("user_id" => $user_id));

        return count($result);
	}

	/** DELETE SUBSCRIBE  **/

	public function deletesubscriber($user_id = "")
	{
		$result = $this->db->delete('email_subscribe', array('user_id' => $user_id));
		return count($result);
	}
	
    
	/** NEWSLETTER SEND **/

	public function send_newsletter($post)
	{
		
		if($post->city=='all'){
			$conditions = array("user_status" => 1,"user_type" => 4);
		} else {
			$conditions = array("city_id" => $post->city,"user_status" => 1,"user_type" => 4);
		}
		$news = $this->db->from("users")->where($conditions)->get();
		
		if(count($news) > 0){

			foreach($news as $c){
            		$from = CONTACT_EMAIL;
            		
				$this->email_id = "";
				$this->name = "";
				$this->message = $post->message;
				$message = new View("themes/".THEME_NAME."/admin_mail_template");
				if(EMAIL_TYPE==2){
					email::smtp($from, $c->email,$post->subject,$post->message);
				} else{
					email::sendgrid($from, $c->email,$post->subject,$post->message);
				}
			}
			return 1;
  		}
	}

	/** GET ALL CITY LIST **/
	
	public function getCityList()
	{
		$result = $this->db->from("city")
			->join("country","country.country_id","city.country_id")
			->orderby("city.city_name", "ASC")
			->where(array("city_status" => 1,"country.country_status"=>1))
			->get();

		return $result;
	}


	/** CHECK CITY EXIST OR NOT **/
    
	public function check_city_exist($country_id = "", $city_id = "")
	{
		$result = $this->db->from("city")
                            ->join("country","country.country_id","city.country_id")
			    ->where(array("city_status" => 1,"city.country_id" => $country_id, "city_id" => $city_id))
                            ->get();
        return $result;
	}
	
	/** GET SUB CATEGORY LIST **/
	
	public function get_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1))->orderby("category_name","ASC")->get();
		return $result;
	}

		/** GET SUB CATEGORY LIST **/
	
	public function get_top_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type" =>1))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	/** GET CITY DAILY DEALS LIST  **/
	
	public function get_city_daily_deals_list($category_id = 0)
	{
		$result = $this->db->query("select * from deals  left join stores on stores.store_id=deals.shop_id  left join city on city.city_id= stores.city_id left join  category on  category.category_id=deals.category_id  where deals.category_id = $category_id and deal_status = 1  and  stores.store_status = 1  and  category.category_status =1  and enddate >".time()." order by deals.deal_id DESC limit 5");
        return $result;
	}

	/** GET CITY DAILY DEALS LIST  **/
	
	public function get_city_daily_products_list($category_id = 0)
	{
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id  join city on city.city_id= stores.city_id join  category on  category.category_id=product.category_id  where product.category_id = $category_id  and deal_status = 1  and  stores.store_status = 1   and  category.category_status =1 and purchase_count < user_limit_quantity order by product.deal_id DESC limit 5");
	        return $result;
	}

	/** GET CITY DAILY DEALS LIST  **/
	
	public function get_city_daily_auction_list($category_id = 0)
	{
		$result = $this->db->query("select * from(auction)  join stores on stores.store_id=auction.shop_id  join city on city.city_id= stores.city_id join  category on  category.category_id=auction.category_id  where auction.category_id = $category_id and deal_status = 1 and enddate >".time()."  and  stores.store_status = 1   and  category.category_status =1  order by auction.deal_id DESC limit 5");
        return $result;
	}

	
	/** GET USERS CITY SUBSCRIPTION **/
	
	public function get_subscribed_user_list()
	{
		$result = $this->db->from("email_subscribe")
				->where(array("suscribe_city_status" => 1,"suscribe_status" => 1,"category_id !=" =>"" ,"category_id !=" =>"0" ))
				//->join("email_subscribe","email_subscribe.user_id","users.user_id")
				->get();
		return $result;
	}
	
	/**UPDATE USERS NEWSLETTER DATE **/
	public function update_users_news_date($user_id)
	{
	        $result = $this->db->update("users", array("newsletter_date" => time()), array("user_id" => $user_id));
	}

		/** GET CITY LIST JOIN COUNTRY **/

	public function get_all_city_list()
	{
		$result = $this->db->from("city")->join("country","country.country_id","city.country_id")->where(array("city_status" => 1,"country_status" => 1))->orderby("city_name", "ASC")->get();
		return $result;
	}
	
	/** GET CITY NAME FOR MANAGE SUBSCRIBER **/
	
	public function getCityList1($cityid="")
	{
		$result = $this->db->query("SELECT city.city_name FROM city WHERE FIND_IN_SET(city.city_id,'$cityid')");
		
		return $result;
	}
	
	/* GET MODULE SETTING LIST */
	public function get_setting_module_list()
	{
		$result = $this->db->from("module_settings")->get();
		return $result;
	}
	
}
