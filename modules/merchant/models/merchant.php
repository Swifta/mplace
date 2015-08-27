<?php defined('SYSPATH') or die('No direct script access.');
class Merchant_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();
		$this->user_id = $this->session->get("user_id");
	}

        /** MERCHANT DASHBORAD DATA **/

	public function get_merchant_dashboard_data()
	{

		$result_active_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->where(array("enddate >" => time(),"deals.merchant_id" => $this->user_id,"deal_status"=>"1","stores.store_status" => "1"))->get();
		$result["active_deals"]=count($result_active_deals);

		$result_archive_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->where(array("enddate <" => time(),"deals.merchant_id" => $this->user_id,"deal_status"=>"1","stores.store_status" => "1"))->get();
		$result["archive_deals"]=count($result_archive_deals);

		$result_active_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count < user_limit_quantity  and deal_status=1 and stores.store_status = 1 and product.merchant_id = ".$this->user_id."");

		$result["active_products"]=count($result_active_products);

		$result_sold_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE  purchase_count = user_limit_quantity  and deal_status=1 and stores.store_status = 1 and product.merchant_id = ".$this->user_id."");

		$result["sold_products"]=count($result_sold_products);

		$result_active_auction =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->join("category","category.category_id","auction.category_id")->where(array("enddate >" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","auction.merchant_id" => $this->user_id))->get();
		$result["active_auction"]=count($result_active_auction);

		$result_archive_auction =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","auction.merchant_id" => $this->user_id))->get();
		$result["archive_auction"]=count($result_archive_auction);

		$result["products_shipping"] = count($this->db->select("shipping_info.shipping_id")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("product","product.deal_id","transaction.product_id")->where(array( "shipping_type" => 1,"transaction.type !=" =>5,"product.merchant_id" => $this->user_id))->groupby("shipping_id")->get());

		//$result["auction_shipping"] = $this->db->count_records("shipping_info", array( "shipping_type" => 2));
		$result["auction_shipping"] = count($this->db->select("shipping_info.shipping_id")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("auction","auction.deal_id","transaction.auction_id")->where(array( "shipping_type" => 2,"transaction.type !=" =>5,"auction.merchant_id" => $this->user_id))->groupby("shipping_id")->get());
		
		$result["stores"] = $this->db->count_records("stores", array( "store_status" => 1, "merchant_id" => $this->user_id));
		$result["request_fund"] = $this->db->count_records("request_fund", array( "request_status" => 2, "user_id" => $this->user_id));
		$result_close_coupon = $this->db->select("transaction_mapping.id")->from("transaction_mapping")->join("deals","deals.deal_id","transaction_mapping.deal_id")->where(array("coupon_code_status" => 0,"deals.merchant_id" => $this->user_id))->get();
		$result["close_coupon"] = count($result_close_coupon);

		return $result;
	}

	/** GET MERCHANT BALANCE **/

        public function get_merchant_balance_fund()
	{

                $result =$this->db->from("request_fund")->where(array("request_status" => 2, "user_id" => $this->user_id))->get();

                return $result;
        }

	/** MERCHANT LOGIN **/

	public function merchant_login($email = "", $password = "")
	{

                $result = $this->db->from("users")->where(array("email" => $email, "password" => md5($password), "user_type" => 3))->limit(1)->get();
                        if(count($result) == 1){
	                        if($result->current()->user_status == 1){
		                        $this->session->set(array(
						                "user_id" => $result->current()->user_id,
						                "name" => $result->current()->firstname ,
						                "user_email" => $result->current()->email,
						                "user_city" => $result->current()->city_id,
						                "user_type" =>  $result->current()->user_type,
								"facebook_status" =>$result->current()->facebook_update,
								"fb_access_token" =>$result->current()->fb_session_key,
								"fb_user_id" =>$result->current()->fb_user_id
				                        ));
				                        return 10;
	                        }
	                        return 9;
                        }
                        else{
	                        $emailCount = $this->db->count_records("users", array("email" => $email, "user_type" => 3));
	                        if($emailCount == 0){
		                        return 8;
	                        }
	                        return 0;
                        }
	}

        /** MERCHANT DETAILS **/

	public function user_details()
	{

                $result = $this->db->from("users")
                                ->where(array("user_id" => $this->user_id))
                                ->join("city","city.city_id","users.city_id")
                                ->join("country","country.country_id","city.country_id")
                                ->get();
                return $result;
	}

	/** GET SINGLE MERCHANT DATA **/

	public function get_users_data()
	{

                $result = $this->db->from("users")->where(array("user_id" => $this->user_id))->join("city","city.city_id","users.city_id")->limit(1)->get();
                return $result;
	}

	/** GET CITY LIST **/

	public function getCityList()
	{

		$result = $this->db->from("city")
			        ->join("country","country.country_id","city.country_id")
			        ->orderby("city.city_name", "ASC")
			        ->get();
		return $result;
	}

	/** UPDATE MERCHANT **/

        public function edit_merchant($id = "" ,$post = "")
	{
                $result = $this->db->update("users", array('firstname' => $post->firstname, 'lastname' => $post->lastname,'email' => $post->email,'phone_number' => $post->mobile, 'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'payment_account_id' => $post->payment), array('user_id' => $id));
                return $result;
        }

        /** UPDATE PASSWORD **/

        public function change_password($id = "", $pass = "")
	{
                $result = $this->db->update("users", array('password' => md5($pass->password)), array('user_id' => $id));
                return count($result);

        }
        
        /** UPDATE FLAT AMOUNT **/

        public function change_flat_amount($id = "", $post = "")
	{
                $result = $this->db->update("users", array('flat_amount' => $post->flat_shipping), array('user_id' => $id));
                
                                $free = "0";
                                if(isset($post->free)){
                                $free = $post->free;
                                }
                                $flat = "0";
                                if(isset($post->flat)){
                                $flat = $post->flat;
                                }
                                $product = "0";
                                if(isset($post->product)){
                                $product = $post->product;
                                }
                                $quantity = "0";
                                if(isset($post->quantity)){
                                $quantity = $post->quantity;
                                }
                                $aramex = "0";
                                if(isset($post->aramex)){
                                $aramex = $post->aramex;
                                }
                                $result_shipping = $this->db->update("shipping_module_settings", array("free" => $free,"flat" => $flat, "per_product" => $product,'per_quantity' => $quantity, 'aramex' => $aramex), array('ship_user_id' => $id));
                return count($result);

        }

        /** CHECK PASSWORD **/

        public function exist_password($pass = "", $id = "")
	{
                $result = $this->db->count_records('users', array('user_id' => $id, 'password' => md5($pass)));
		return (bool) $result;
        }

        /** ADD DEALS **/

	public function add_deals($post = "", $deal_key = "")
	{

		$savings=($post->price-$post->deal_value);
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal

		//$sub_cat = implode(',',$sub_cat1);
		$result = $this->db->insert("deals", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category, "deal_price" => $post->price,"deal_value" => $post->deal_value,"deal_savings" => $savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "expirydate" => strtotime($post->expiry_date),"created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100,"minimum_deals_limit" =>  $post->minlimit,"maximum_deals_limit" => $post->maxlimit , "user_limit_quantity" =>  $post->quantity,"merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_date" => time(),"created_by"=>$this->user_id,"deal_status" => 0, "for_store_cred"=>$post->store_cred));

		if(count($result) == 1){
			return $result->insert_id();
		}
		return 0;
	}

	/** GET DEALS CATEGORY LIST **/
	
	public function get_category_list_order($count = "")
	{
	        if($count == 1){
	        
	                $dispa = array("category_status" => 1,"main_category_id"=>0 , "deal" =>1);
	        } 
	        if($count == 2){
	                 $dispa = array("category_status" => 1,"main_category_id"=>0 , "product" =>1);
	        } 
	        if($count == 3){
	                $dispa = array("category_status" => 1,"main_category_id"=>0 , "auction" =>1);
	        } 

		$result = $this->db->from("category")
		->where($dispa)
		->orderby("category_name","ASC")->get();
		return $result;
	}

	public function get_gategory_list()
	{

		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id"=>0))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** GET ALL CATEGORY LIST **/
	public function all_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1))->orderby("category_name","ASC")->get();
		return $result;

	}
	/** GET MERCHANT BALANCE **/

	public function get_merchant_balance()
	{
                $result =$this->db->from("users")->where(array("user_type" => 3, "user_id" => $this->user_id))->get();
                return $result;
	}

	/** GET SHOP LIST **/

	public function get_shop_list()
	{

                $result = $this->db->from("stores")
                            ->join("users","users.user_id","stores.merchant_id")
                            ->join("city","city.city_id","stores.city_id")
                            ->orderby("stores.store_name", "ASC")
                            ->where(array("stores.store_status" => '1',"merchant_id" => $this->user_id, "city_status" => '1'))
                            ->get();
                return $result;
        }

        /** GET COUNTRY BASED CITY LIST **/

	public function get_city_by_country($country)
	{

		$result = $this->db->from("city")->where(array("country_id" => $country, "city_status" => '1'))->orderby("city_name")->get();
		return $result;
	}

        /** MANAGE  DEALS **/

	public function get_all_deals_list($type = "", $offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

		if($type == 1){
			$cont = "<";
		}
		else{
			$cont = ">";
		}
		 $conditions = "deals.enddate $cont ".time()." AND deals.merchant_id = ".$this->user_id;
                if($_GET){

                        if($city){
                                $conditions .= " and city.city_id = ".$city;
                        }
                        if($name){
                                $conditions .= " and (deals.deal_title like '%".mysql_real_escape_string($name)."%'";
                                $conditions .= " or stores.store_name like '%".mysql_real_escape_string($name)."%')";
                        }
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( deals.created_date between $startdate_str and $enddate_str )";	
                        }

			$sort_arr = array("name"=>" order by deals.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by deals.deal_price $sort","value"=>" order by deals.deal_value $sort","savings"=>" order by deals.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by deals.deal_id DESC'; }

					 $query = "select * , deals.created_date as createddate from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id where $conditions $limit1 ";



                }
	        else{
				$query = "select * , deals.created_date as createddate from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id join category on category.category_id=deals.category_id join users on users.user_id=deals.merchant_id where $conditions order by deals.deal_id DESC $limit1 ";
                }

                $result = $this->db->query($query);
                return $result;
        }

    	/** DEALS COUNT **/

	public function get_all_deals_count($type = "", $city = "", $name = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

	        if($type == 1){
			$cont = "<";
		}
		else{
			$cont = ">";
		}

		if($_GET){
                        $conditions = "deals.enddate $cont ".time()." AND deals.merchant_id = ".$this->user_id;

                        if($city){
                                $conditions .= " and city.city_id = ".$city;
                        }
                        if($name){
                                $conditions .= " and (deals.deal_title like '%".mysql_real_escape_string($name)."%'";
                                $conditions .= " or stores.store_name like '%".mysql_real_escape_string($name)."%')";
                        }
                        
                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and deals.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( deals.created_date between $startdate_str and $enddate_str )";	
                        }

			$sort_arr = array("name"=>" order by deals.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by deals.deal_price $sort","value"=>" order by deals.deal_value $sort","savings"=>" order by deals.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by deals.deal_id DESC'; }

                        $query = "select * from deals join stores on stores.store_id=deals.shop_id join city on city.city_id=stores.city_id where $conditions ";
                        $result = $this->db->query($query);
                }
		else{
			$result = $this->db->select("deal_id")->from("deals")
						->join("stores","stores.store_id","deals.shop_id")
						->join("city","city.city_id","stores.city_id")
						->where(array("enddate $cont" => time(), "deals.merchant_id" => $this->user_id))
						->get();
		}
		return count($result);
	}

	/** GET CITY LIST **/
   	public function get_city_lists()
	{

                $result = $this->db->from("city")

                            ->orderby("city.city_name", "ASC")
			    ->join("country","country.country_id","city.country_id")
                            ->where(array("city_status" => '1',"country.country_status"=>1))
                            ->get();
                return $result;
        }

        /** VIEW DEALS **/

	public function get_deals_data($deal_key = "", $deal_id = "")
	{

                $result = $this->db->select('*','deals.sub_category_id as sub_cat','deals.sec_category_id as sec_cat')->from("deals")
				->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"deals.merchant_id" => $this->user_id))
				->join("stores","stores.store_id","deals.shop_id")
				->join("city","city.city_id","stores.city_id")
				->join("country","country.country_id","stores.country_id")
				->join("users","users.user_id","deals.merchant_id")
				->join("category","category.category_id","deals.category_id")
				->get();
                return $result;
	}
	
	public function get_dealsmail_data($deal_key = "", $deal_id = "")
	{

                $result = $this->db->select('*','deals.sub_category_id as sub_cat','deals.sec_category_id as sec_cat')->from("deals")
				->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"deal_status" => 1,"deals.merchant_id" => $this->user_id))
				->join("stores","stores.store_id","deals.shop_id")
				->join("city","city.city_id","stores.city_id")
				->join("country","country.country_id","stores.country_id")
				->join("users","users.user_id","deals.merchant_id")
				->join("category","category.category_id","deals.category_id")
				->get();
                return $result;
	}

	/** EDIT DEALS DATA **/

	public function get_edit_deal($deal_id = "",$deal_key = "")
	{

	 $result = $this->db->from("deals")
                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))
             		->get();

           return $result;

	}

	/** UPDATE DEALS **/

	public function edit_deals($deal_id = "", $deal_key = "", $post = "",$adminid)
	{

		$dealdata = $this->db->select("deal_title","url_title")->from("deals")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))->get();
		if(count($dealdata) == 1){
			$oldurlTitle = $dealdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){
				$result = $this->db->count_records("deals", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}
			$savings=($post->price-$post->deal_value);
			$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		//$sub_cat = implode(',',$sub_cat1);
			$this->db->update("deals", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category, "deal_type"=> $post->deal_type, "deal_price" => $post->price,"deal_value" => $post->deal_value,"deal_savings" =>$savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "expirydate" => strtotime($post->expiry_date),"created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100,"minimum_deals_limit" =>  $post->minlimit,"maximum_deals_limit" => $post->maxlimit , "user_limit_quantity" =>  $post->quantity,"merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id), array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id));

			return 1;
		}
		return 8;
	}

	/** BLOCK UNBLOCK DEALS **/

	public function blockunblockdeal($type = "", $key = "", $deal_id = "" )
	{

                $status = 0;
                if($type == 1){
                        $status = 1;
                }
                $result = $this->db->update("deals", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key, "merchant_id" => $this->user_id));
                return count($result);
	}

	/**  GET CLOSED COUPON COUNT   **/

	public function get_coupon_count($code = "" , $name = "")
	{
		$contitions = "transaction_mapping.coupon_code_status = 0 AND deals.merchant_id = $this->user_id";

		if($_GET){

		        if($name){
				        $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                        $contitions .= ' OR deals.deal_title like "%'.mysql_real_escape_string($name).'%")';
					}
                    if($code){
						$contitions .= ' and transaction_mapping.coupon_code like "%'.mysql_real_escape_string($code).'%"';
					}

                       $result = $this->db->query("SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions");
		}
		else {
		$query = "SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions ";
	$result = $this->db->query($query);
		}

	return count($result);
	}

	/** GET CLOSED COUPON LIST **/
	public function get_coupon_list($offset = "", $record = "",$code = "" , $name = "",$limit="")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$contitions = "transaction_mapping.coupon_code_status=0 AND deals.merchant_id = $this->user_id";
		if($_GET){
					if($name){
				        $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                        $contitions .= ' OR deals.deal_title like "%'.mysql_real_escape_string($name).'%")';
					}
                    if($code){
						$contitions .= ' and transaction_mapping.coupon_code like "%'.mysql_real_escape_string($code).'%"';
					}
                       $result = $this->db->query("SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions $limit1 ");
		}
		else {
		$query = "SELECT * FROM transaction_mapping join deals on deals.deal_id = transaction_mapping.deal_id join users on users.user_id=transaction_mapping.user_id where $contitions $limit1 ";
	$result = $this->db->query($query);
		}

	return $result;
	}
        /** GET COUNTRY LIST **/

        public function getcountrylist()
	{

	        $result = $this->db->from("country")->where(array("country_status" => '1'))->orderby("country_name")->get();
	        return $result;
        }

	/** ADD MERCHANT SHOP ACCOUNT **/

        public function add_merchant_shop($post = "",$store_key = "")
	{

                $stores_result = $this->db->insert("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'store_key' =>$store_key,'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile, 'zipcode' => $post->zipcode, "meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,'website' => $post->website, 'latitude' => $post->latitude, 'longitude' => $post->longitude,'created_by'=>$this->user_id, 'store_type' => '2','merchant_id'=>$this->user_id,"created_date" => time()));
                $merchant_id = $stores_result->insert_id();
                return $merchant_id;
        }

        /** GET MERCHANT SHOP DATA  **/

        public function get_merchant_list_shop($offset = "", $record = "",  $name = "", $city = "",$limit="")
	{
			$limit1 = $limit !=1 ?"limit $offset,$record":"";

                $contitions = "merchant_id = ".$this->user_id;
                if($_GET){
                        if($city){

				$contitions .= ' and stores.city_id = '.$city;
                        }

                        if($name){
			        $contitions .= ' and store_name like "%'.mysql_real_escape_string($name).'%"';
                        }
                         $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ORDER BY stores.store_id $limit1");

                }
                else{
                        $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ORDER BY stores.store_id $limit1");
                }
                return $result;
        }

        /** GET MERCHANT SHOP COUNT DATA  **/

        public function get_merchant_shop_count($name = "", $city = "")
 	{

                $contitions = "merchant_id = ".$this->user_id;
                if($_GET){
                        if($city){

				$contitions .= ' and stores.city_id = '.$city;
                        }

                        if($name){
			        $contitions .= ' and store_name like "%'.mysql_real_escape_string($name).'%"';
                        }
                         $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ");

                }
                else{
                        $result = $this->db->query("select * from stores join country on country.country_id = stores.country_id join city on city.city_id = stores.city_id where $contitions ");
                }
                return count($result);
        }

        /** UPDATE MERCHANT SHOP **/

        public function edit_merchant_shop($id = "", $post = "")
	{

             $merchant_result = $this->db->update("stores", array("store_name" => $post->storename,"store_url_title" => url::title($post->storename),'address1' => $post->address1, 'address2' => $post->address2, 'city_id' => $post->city, 'country_id' => $post->country, 'phone_number' => $post->mobile, 'zipcode' => $post->zipcode, "meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,'website' => $post->website, 'latitude' => $post->latitude, 'longitude' => $post->longitude), array('store_id' => $id,"merchant_id" => $this->user_id));
          return $id;
        }

        /** GET SINGLE MERCHANT SHOP DATA **/

	public function get_merchant_shop_data($storeid = "")
	{
		$result = $this->db->from("stores")->join("city","city.city_id","stores.city_id")->where(array("store_id" => $storeid, "merchant_id" => $this->user_id))->limit(1)->get();
		return $result;
	}

	/** BLOCK & UNBLOCK MERCHANT SHOP **/

        public function blockunblockmerchantshop($type = "", $storesid = "")
	{

                $status = 0;
                if($type == 1){
                    $status = 1;
                }
                $get_data = $this->db->from("stores")->join("users","stores.merchant_id","users.user_id")->where(array("store_id" => $storesid,"user_id" => $this->user_id))->get();
                foreach($get_data as $c){
			if($c->user_status == 1){
				$result = $this->db->update("stores", array("store_status" => $status), array("store_id" => $storesid));
				 return count($result);
			}
			else{
				return -1;
			}
		}
        }

        /** FUND REQUEST **/

        public function add_fund_request($amount = "",$useramount = "")
	{

                $stores_result = $this->db->insert("request_fund", array("type" => "1", 'user_id' => $this->user_id, 'amount' => $amount, 'date_time' => time()));

                if(count($stores_result) == 1){

                        $result = $this->db->update("users", array("merchant_account_balance" => $useramount), array("user_id" => $this->user_id));
                }
               return $stores_result;
        }

        /** MANAGE FUND REQUEST **/

        public function get_all_fund_request($offset = "", $record = "")
	{

        $result = $this->db->from("request_fund")
                                    ->where(array("user_id" => $this->user_id))
                                    ->orderby("request_id", "DESC")
                                    ->limit($record, $offset)
                                    ->get();
        return $result;
        }

        /** MANAGE FUND REQUEST COUNT**/

        public function get_fund_request()
	{

        $result = $this->db->select("request_id")->from("request_fund")
                                    ->where(array("user_id" => $this->user_id))
                                    ->orderby("request_id", "DESC")
                                    ->get();
         return count($result);
        }

        /** DELETE FUND REQUEST **/

        public function deletefund($request_id = "", $useramount= "")
	{

		$result = $this->db->delete('request_fund', array('request_id' => $request_id,"request_status"=>1,"user_id" => $this->user_id));
		if(count($result) == 1){

		        $result_user = $this->db->update("users", array("merchant_account_balance" => $useramount), array("user_id" => $this->user_id));
		}
		return count($result);
	}

	/** GET FUND REQUEST **/

	public function get_fund_request_data($request_id = "")
	{
		$result = $this->db->from("request_fund")->where(array('request_id' => $request_id, 'request_status' => 1, "user_id" => $this->user_id))->limit(1)->get();
		return $result;

	}

	/** UPDATE FUND REQUEST **/

        public function edit_fund_request($request_id = "",$amount = "", $useramount = "")
	{

                $stores_result = $this->db->update("request_fund", array("amount" => $amount, 'date_time' => time()), array("user_id" => $this->user_id, 'request_id' => $request_id, 'request_status' => 1));

                if(count($stores_result) == 1){

                        $result = $this->db->update("users", array("merchant_account_balance" => $useramount), array("user_id" => $this->user_id));
                 }

               return $stores_result;
        }

        /** VIEW DEALS FOR TRANSACTION**/

	public function get_transaction_data($deal_id = "")
	{
                $result = $this->db->from("deals")
                                ->where(array("transaction.deal_id" => $deal_id,"deals.merchant_id" =>$this->user_id))
	                        ->join("transaction","transaction.deal_id","deals.deal_id")
	                        ->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}

	 /** VIEW PRODUCT FOR TRANSACTION**/

	public function get_product_transaction_data($deal_id = "")
	{
                $result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("product")
                                ->where(array("transaction.product_id" => $deal_id,"transaction.type !=" =>5,"product.merchant_id" =>$this->user_id))
	                        	->join("transaction","transaction.product_id","product.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}

	 /** VIEW PRODUCT FOR TRANSACTION**/

	public function get_cod_transaction_data($deal_id = "")
	{
                $result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("product")
                                ->where(array("transaction.product_id" => $deal_id,"transaction.type" =>5,"product.merchant_id" =>$this->user_id))
	                        	->join("transaction","transaction.product_id","product.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}

	/** VIEW AUCTION FOR TRANSACTION**/

	public function get_auction_transaction_data($deal_id = "")
	{
                $result = $this->db->from("auction")
                                ->where(array("transaction.auction_id" => $deal_id,"auction.merchant_id" =>$this->user_id))
	                        	->join("transaction","transaction.auction_id","auction.deal_id")
	                        	->orderby("transaction.id","DESC")
                                ->get();
                return $result;
	}
        /** ADD PRODUCTS **/

	public function add_products($post = "", $deal_key = "",$size_quantity = "")
	{
		$quantity = "";
	    foreach($size_quantity as $sq){
	      $quantity += $sq;
	    }
	    $inc_tax = "0";
			 if(isset($_POST['Including_tax'])) {
			        $inc_tax = "1";
			 }
		$savings=(($post->price)-($post->deal_value));
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
	//	$sub_cat = implode(',',$sub_cat1);

                $shipping_amount = "0";
		 if(isset($_POST['shipping_amount'])) {
		        $shipping_amount = $_POST['shipping_amount'];
		 }
		 
		        $weight = "0";
			 if(isset($_POST['weight'])) {
			        $weight = $_POST['weight'];
			 }
			 $height = "0";
			 if(isset($_POST['height'])) {
			        $height = $_POST['height'];
			 }
			 $length = "0";
			 if(isset($_POST['length'])) {
			        $length = $_POST['length'];
			 }
			 $width = "0";
			 if(isset($_POST['width'])) {
			        $width = $_POST['width'];
			 }
	$atr_option = isset($post->attr_option)?$post->attr_option:0;  // for attribute is present or not
				
				
				

		$result = $this->db->insert("product", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description,"delivery_period" => $post->delivery_days,"category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"deal_price" => $post->price,"deal_type"=> 2,"deal_value" => $post->deal_value,"deal_savings" => $savings,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100,"merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"shipping"=>$post->shipping,"created_by"=>$this->user_id,"color" => $post->color_val,"size" => $post->size_val,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"shipping_amount" => $shipping_amount,"user_limit_quantity"=>$quantity,"deal_status" =>0,"attribute"=>$atr_option,"Including_tax" =>$inc_tax,"created_date" => time(), "for_store_cred"=>$post->store_cred));
		

		 $product_id = $result->insert_id();
			if(($post->color_val) == 1){
			    foreach($post->color as $c){
			        $result_count = $this->db->from("color")->where(array("deal_id" => $product_id, "color_name" => $c))->get();
			        if(count($result_count)==0){
			        $result_id = $this->db->from("color_code")->where(array("color_code" => $c))->get();
			        $result_color = $this->db->insert("color", array("deal_id" => $product_id, "color_name" => $c, "color_code_id" => $result_id->current()->id,"color_code_name" => $result_id->current()->color_name));
			        }
			    }
			}

	    if(($post->size_val) == 1){
	        $i= 0;
	        foreach($post->size as $s){
	            $result_count = $this->db->from("product_size")->where(array("deal_id" => $product_id, "size_id" => $s))->get();
	            if(count($result_count)==0){
	            $result_id = $this->db->from("size")->where(array("size_id" => $s))->get();
	            		$size_tot = count((array)$post->size);
						//To avoid None size if other sizes selected
					if($size_tot == 1 && ($s!=1 || $s==1)){
						$result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
					}elseif($size_tot > 1 && $s!=1){
							$result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
					}
	            $i++; }
	        }
	    }

	    		//Attribute start
		if(($post->attr_option) == 1){

	  	$attr_result = $this->db->delete('product_attribute', array('product_id' => $product_id));

		$attr = array_unique($_POST['attribute']);
		//print_r($attr);exit;
	        foreach($attr as $k=>$s){
		$result_attribute = $this->db->insert("product_attribute", array("product_id" => $product_id, "attribute_id" => $s,"text"=>$_POST['attribute_value'][$k]));

				}

	        }

		//Attribute end

		$policy = array_unique($_POST['Delivery_value']);
	        if(count($policy)>0){
	        $Deli_result = $this->db->delete('product_policy', array('product_id' => $product_id));
	        foreach($policy as $p=>$s){
		                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $product_id,"text"=>$_POST['Delivery_value'][$p]));
				}
		}

		if(count($result) == 1){
			return $result->insert_id();
		}
		return 0;
	}

	/** PRODUCTS COUNT **/

	public function get_all_products_count($type = "", $city = "", $name = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
				if($sort_type == "DESC" ){
					$sort = "DESC";


				}
		if($_GET){

			if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }
			if($city){
				$conditions .= " and city.city_id = ".$city;
			}

			if($name){
				$conditions .= " and deal_title like '%".mysql_real_escape_string($name)."%'";
			}
			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( product.created_date between $startdate_str and $enddate_str )";	
                        }

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }
			$query = "select ('deal_id') from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions";
			$result = $this->db->query($query);
		}
		else{

			if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }

			$query = "select * from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions";
			$result = $this->db->query($query);
		}
		return count($result);
	}

	/** MANAGE  PRODUCTS **/

	public function get_all_product_list($type, $offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
                if($_GET){
		         if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }

			if($city){
			        $conditions .= " and city.city_id = ".$city;
			}
			if($name){
			        $conditions .= " and (deal_title like '%".mysql_real_escape_string($name)."%'";
			        $conditions .= " or store_name like '%".mysql_real_escape_string($name)."%')";
			}
			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and product.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( product.created_date between $startdate_str and $enddate_str )";	
                        }
			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }

			$query = "select * , product.created_date as createddate from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions  $limit1 ";
			$result = $this->db->query($query);
		}
	        else{
	                 if($type != "1")
		        {
		                $conditions = "purchase_count < user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }else {
		                $conditions = "purchase_count = user_limit_quantity and product.merchant_id = ".$this->user_id." and stores.store_status = 1";
		        }

			$sort_arr = array("name"=>" order by product.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by product.deal_price $sort","value"=>" order by product.deal_value $sort","savings"=>" order by product.deal_savings $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by product.deal_id DESC'; }

			$query = "select * , product.created_date as createddate from product join stores on stores.store_id=product.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=product.category_id join users on users.user_id=product.merchant_id where $conditions $limit1 ";
			$result = $this->db->query($query);
                }
            return $result;
        }
	/** UPDATE PRODUCTS **/

	public function edit_product($deal_id = "", $deal_key = "", $post = "",$size_quantity = "")
	{

		 $quantity = 0;

	     for($i=0;$i<count($size_quantity); $i++){
			if($size_quantity[$i]!=0){
				$quantity +=$size_quantity[$i];
			}

		 }

		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		// $sub_cat = implode(',',$sub_cat1);

		$dealdata = $this->db->select("deal_title","url_title","user_limit_quantity","purchase_count")->from("product")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))->get();

		$total_quantity = $quantity;

		if( $dealdata->current()->purchase_count >= $dealdata->current()->user_limit_quantity)
		{
			$total_quantity = $dealdata->current()->user_limit_quantity+$quantity;
		}
		else if( $dealdata->current()->purchase_count < $dealdata->current()->user_limit_quantity && ($dealdata->current()->purchase_count !=0 ) && ($quantity ==0 ) ){
			$total_quantity = $dealdata->current()->purchase_count;
		}
		else if( $dealdata->current()->purchase_count < $dealdata->current()->user_limit_quantity && ($dealdata->current()->purchase_count !=0 ) && ($quantity !=0 ) ){
			$total_quantity = $dealdata->current()->purchase_count+$quantity;
		}

		if(count($dealdata) == 1){
			$oldurlTitle = $dealdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){
				$result = $this->db->count_records("product", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}
			 $inc_tax = "0";
			 if(isset($_POST['Including_tax'])) {
			        $inc_tax = "1";
			 }
			$result = $this->db->delete('color', array('deal_id' => $deal_id));
			$result = $this->db->delete('product_size', array('deal_id' => $deal_id));
			$savings=($post->price-$post->deal_value);
			$atr_option = isset($post->attr_option)?$post->attr_option:0; // for attribute

                         $shipping_amount = "0";
		         if(isset($_POST['shipping_amount'])) {
		                $shipping_amount = $_POST['shipping_amount'];
		         }
		         
		         $weight = "0";
			 if(isset($_POST['weight'])) {
			        $weight = $_POST['weight'];
			 }
			 $height = "0";
			 if(isset($_POST['height'])) {
			        $height = $_POST['height'];
			 }
			 $length = "0";
			 if(isset($_POST['length'])) {
			        $length = $_POST['length'];
			 }
			 $width = "0";
			 if(isset($_POST['width'])) {
			        $width = $_POST['width'];
			 }
			$this->db->update("product", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description,"delivery_period"=> $post->delivery_days, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category, "third_category_id" => $post->third_category,"deal_price" => $post->price,"deal_value" => $post->deal_value,"deal_savings" =>$savings,"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description,"deal_percentage" => ($savings/$post->price)*100, "merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"color" => $post->color_val,"size" => $post->size_val,"shipping_amount" => $shipping_amount,"user_limit_quantity"=>$quantity,"shipping"=>$post->shipping,"attribute"=>$atr_option,"Including_tax" =>$inc_tax, "weight" => $weight,"height" => $height,"length" => $length,"width" => $width), array("deal_id" => $deal_id, "deal_key" => $deal_key));

			 if(($post->color_val) == 1){
				foreach($post->color as $c){
					 $result_id = $this->db->from("color_code")->where(array("color_code" => $c))->get();
			        $result_color = $this->db->insert("color", array("deal_id" => $deal_id, "color_name" => $c, "color_code_id" => $result_id->current()->id,"color_code_name" => $result_id->current()->color_name));
			    }
	        }

	        if(($post->size_val) == 1){
				$i= 0;
				foreach($post->size as $s){
					$result_count = $this->db->from("product_size")->where(array("deal_id" => $deal_id, "size_id" => $s))->get();
					if(count($result_count)==0){
					$result_id = $this->db->from("size")->where(array("size_id" => $s))->get();
							$size_tot = count((array)$post->size);
							//To avoid None size if other sizes selected
						if($size_tot == 1 && ($s!=1 || $s==1)){
							$result_color = $this->db->insert("product_size", array("deal_id" => $deal_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
						}elseif($size_tot > 1 && $s!=1){
								$result_color = $this->db->insert("product_size", array("deal_id" => $deal_id, "size_name" => $result_id->current()->size_name, "size_id" => $s,"quantity"=>$size_quantity[$i]));
						}
					$i++; }
				}
			}

				//Attribute start
		$attr_result = $this->db->delete('product_attribute', array('product_id' => $deal_id));
		if(($post->attr_option) == 1){

		$attr = array_unique($_POST['attribute']);
		//print_r($attr);exit;
	        foreach($attr as $k=>$s){
		$result_attribute = $this->db->insert("product_attribute", array("product_id" => $deal_id, "attribute_id" => $s,"text"=>$_POST['attribute_value'][$k]));

				}

	        }

		//Attribute end

		$policy = array_unique($_POST['Delivery_value']);
	        if(count($policy)>0){
	        $Deli_result = $this->db->delete('product_policy', array('product_id' => $deal_id));
	        foreach($policy as $p=>$s){
		                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $deal_id,"text"=>$_POST['Delivery_value'][$p]));
				}
		}


		        return 1;
		}
		return 8;
	}
 	/** EDIT PRODUCTS DATA **/

	public function get_edit_product($deal_id = "",$deal_key = "")
	{
	   $result = $this->db->from("product")
	                        ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))
	             		->get();
           return $result;
	}

	 /** VIEW PRODUCTSS **/

	public function get_products_data($deal_key = "", $deal_id = "")
	{

                 $result = $this->db->select('*','product.sub_category_id as sub_cat','product.sec_category_id as sec_cat')->from("product")
                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"product.merchant_id" => $this->user_id))
	                        ->join("stores","stores.store_id","product.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
		                ->join("users","users.user_id","product.merchant_id")
		                ->join("category","category.category_id","product.category_id")
	                        ->get();
                return $result;
	}
	
	public function get_productsmail_data($deal_key = "", $deal_id = "")
	{

                 $result = $this->db->select('*','product.sub_category_id as sub_cat','product.sec_category_id as sec_cat')->from("product")
                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"deal_status" => 1,"product.merchant_id" => $this->user_id))
	                        ->join("stores","stores.store_id","product.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
		                ->join("users","users.user_id","product.merchant_id")
		                ->join("category","category.category_id","product.category_id")
	                        ->get();
                return $result;
	}
	/** BLOCK UNBLOCK PRODUCTS **/

	public function blockunblockproducts($type = "", $key = "", $deal_id = "" )
	{
                $status = 0;
                if($type == 1){
                        $status = 1;
                }
                $result = $this->db->update("product", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key,"merchant_id" => $this->user_id));
                return count($result);
	}

	/** GET SHIPPING DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/

        public function get_shipping_list($offset = "", $record = "",  $name= "",$type = "",$limit="")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";

				$condition = "AND t.type != 5";

				if($type){
					$condition = " AND t.type = 5 ";

				}
        		if($_GET){
	        		$contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= 'OR u.email like "%'.mysql_real_escape_string($name).'%"';
            		$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC $limit1 ");

				}
				else {

					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping,stores.city_id as str_city_id from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC $limit1 ");
				}
                return $result;
        }


		 /** GET CONTACTS DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping     **/

        public function get_shipping_count($name = "",$type = "")
        {
				$condition = "AND t.type != 5";

				if($type){
					$condition = " AND t.type = 5 ";

				}
           		if($_GET){
			        $contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= ' OR u.email like "%'.mysql_real_escape_string($name).'%"';
					$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

                  $result = $this->db->query("select s.shipping_id  from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC ");
		}
		else {
			 $result = $this->db->query("select s.shipping_id  from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where shipping_type = 1 AND d.merchant_id = $this->user_id $condition group by shipping_id order by shipping_id DESC ");
		}
                return count($result);
        }

	/* UPDATE SHIPPING STATUS */
	public function update_shipping_status($id = "",$type="")
	{

		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id));

		return count($result);
	}

	/* VALIDATE COUPON */
	public function validate_coupon($coupon = "",$product_amount = "",$trans_id = "")
	{
		$result =  $this->db->count_records("transaction_mapping", array("coupon_code" => $coupon,"transaction_id" => $trans_id,"coupon_code_status" =>1));
			if($result > 0){
				//$this->db->query("update users set merchant_account_balance = merchant_account_balance + $product_amount where user_type = 1");
				$this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Success','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));

				return 1;
			}

			else return 0;
	}
	/** GET COUNT FOR TRANSACTION  **/

	public function count_transaction_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type="",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
			$conditions = "";
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions .= "transaction.id > 0";
		          }else {
		                $conditions .= "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		          if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

			$result = $this->db->query('select * from transaction join users on users.user_id=transaction.user_id join auction on auction.deal_id=transaction.auction_id where '.$conditions.' and auction.merchant_id ='.$this->user_id.' and users.firstname like "%'.$search_key.'%" OR transaction.transaction_id like "%'.$search_key.'%" OR auction.deal_title like "%'.$search_key.'%"');

		}
		else{

			if(($type=="")||($type=="mail")) {

					$conditions = "transaction.id >= 0 and auction.merchant_id = '$this->user_id'";

				if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}


		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");
		       }
		      else {

					$conditions = " payment_status = '$type' and auction.merchant_id = '$this->user_id'";

				  if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort_type","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");


		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("*")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("auction","auction.deal_id","transaction.auction_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}

	/** GET COUNT FOR DEAL TRANSACTION  **/

	public function count_transaction_deal_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
			
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0 ";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		          if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}

			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
                        
                        $conditions .= " and deals.merchant_id = $this->user_id ";
				
			$result = $this->db->query('select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where '.$conditions.' and (users.firstname like "%'.$search_key.'%" OR transaction.transaction_id like "%'.$search_key.'%" OR deals.deal_title like "%'.$search_key.'%")');
				

		}
		else{

			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");

			$conditions = "transaction.id >= 0 and deals.merchant_id = '$this->user_id'";
			if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
			$conditions = " payment_status = '$type' and deals.merchant_id = '$this->user_id'";

		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("transaction.id")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("deals","deals.deal_id","transaction.deal_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}

	/** GET TRANSACTION LIST **/

	public function get_transaction_deal_list($type = "", $search_key = "",$offset = "", $record = "",$sort_type = "",$param = "",$trans_type="",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		          if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}
		        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
			
			$conditions .= " and deals.merchant_id = $this->user_id ";
			
			 $result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where $conditions and (users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR deals.deal_title like '%".$search_key."%') order by transaction.id DESC  $limit1 "); 
		}
		else{
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");

			$conditions = "transaction.id >= 0 and deals.merchant_id = '$this->user_id'";
			if($trans_type){
				$conditions .= " AND transaction.type = 5 ";
			}
			else{
				$conditions .= " AND transaction.type != 5 ";
			}
		       }
		      else {
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by deals.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by deals.shipping_fee $sort");
			$conditions = " payment_status = '$type' and deals.merchant_id = '$this->user_id'";

		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join deals on deals.deal_id=transaction.deal_id where $conditions $limit1 ");
		}
		return $result;
	}
		/** GET COUNT FOR PRODUCT TRANSACTION  **/

	public function count_transaction_product_list($type = "", $search_key = "",$sort_type = "",$param = "",$trans_type = "",$today="", $startdate = "", $enddate = "")
	{
					$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
						$conditions .= " AND transaction.type = 5";
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			$result = $this->db->query("select transaction.id from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions and product.merchant_id = $this->user_id  and ( users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' )");
		}
		else{
				$conditions = "transaction.id >= 0 and product.merchant_id = '$this->user_id' ";
				if($trans_type){
						$conditions .= " AND transaction.type = 5";
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' and product.merchant_id = '$this->user_id'";
				if($trans_type){
						$conditions .= " AND transaction.type = 5";
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("transaction.id")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("product","product.deal_id","transaction.product_id")
						->where($conditions)
						->get();
		}
		return count($result);
	}

	/** GET TRANSACTION LIST **/

	public function get_transaction_list($type = "", $search_key = "", $offset = "", $record = "",$sort_type = "",$param = "",$trans_type="",$today="", $startdate = "", $enddate = "")
	{
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		          if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

			$result = $this->db->query("select *,users.firstname as firstname from transaction join users on users.user_id=transaction.user_id join auction on auction.deal_id=transaction.auction_id where $conditions and auction.merchant_id = $this->user_id and ( users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR auction.deal_title like '%".$search_key."%' ) limit $offset,$record");
		}
		else{

			if(($type=="")||($type=="mail")) {
				$conditions = "transaction.id >= 0 and auction.merchant_id = '$this->user_id'";
				if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}

		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");



		       }
		      else {
				  $conditions = " payment_status = '$type' and auction.merchant_id = '$this->user_id'";

				  if($trans_type){
						$conditions .= " AND transaction.type = 5 ";
					}
				else{
						$conditions .= " AND transaction.type != 5 ";
					}


		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by auction.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by auction.shipping_fee $sort");


		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("*")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("auction","auction.deal_id","transaction.auction_id")
						->where($conditions)
						->limit($record, $offset)
						->get();
		}
		return $result;
	}
		/** GET PRODUCT TRANSACTION LIST **/

	public function get_transaction_product_list($type = "", $search_key = "", $offset = "", $record = "",$type1 = "",$sort_type = "",$param = "",$trans_type = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";
		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}
		 if($_GET){
			 $search_key = mysql_real_escape_string($search_key);
			  if(($type=="")||($type=="mail")) {
		                $conditions = "transaction.id > 0";
		          }else {
		                $conditions = "(payment_status='$type')";
		          }
		           if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and transaction.transaction_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( transaction.transaction_date between $startdate_str and $enddate_str )";	
                        }
				
		        if($trans_type){
						$conditions .= " AND transaction.type = 5";
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			$result = $this->db->query("select *,users.firstname as firstname, transaction.shipping_amount as shippingamount from transaction join users on users.user_id=transaction.user_id join product on product.deal_id=transaction.product_id where $conditions and product.merchant_id = $this->user_id  and ( users.firstname like '%".$search_key."%' OR transaction.transaction_id like '%".$search_key."%' OR product.deal_title like '%".$search_key."%' ) $limit1 ");
		}
		else{
				$conditions = "transaction.id >= 0 and product.merchant_id = '$this->user_id' ";
				if($trans_type){
						$conditions .= " AND transaction.type = 5";
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
			if(($type=="")||($type=="mail")) {
		             $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		       }
		      else {
				$conditions = " payment_status = '$type' and product.merchant_id = '$this->user_id'";
				if($trans_type){
						$conditions .= " AND transaction.type = 5";
					}
				else{
						$conditions .= " AND transaction.type != 5";
					}
		           $sort_arr = array("username"=>" order by users.firstname $sort","title"=>" order by product.deal_title $sort","quantity"=>" order by transaction.quantity $sort_type","amount"=>" order by transaction.amount $sort","refamount"=>" order by transaction.referral_amount $sort","commision"=>" order by transaction.deal_merchant_commission $sort","bidamount" => "order by transaction.bid_amount $sort","shipping_fee" =>"order by product.shipping_fee $sort");
		             }
			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by transaction.id DESC'; }

			$result = $this->db->select("*","transaction.shipping_amount as shippingamount")->from("transaction")
						->join("users","users.user_id","transaction.user_id")
						->join("product","product.deal_id","transaction.product_id")
						->where($conditions)
						->limit($record, $offset)
						->get();
		}
		return $result;
	}

	/**GET  DEALS COUPON **/

	public function coupon_code_validate($code="")
	{
	                $time=time();
			$conditions="";
              		if($code || $code=='0'){
                                $conditions= "transaction_mapping.coupon_code ='".mysql_real_escape_string($code)."'";
                         }
                        $query = "select deals.*,transaction_mapping.coupon_code,transaction_mapping.coupon_code_status,transaction.type,transaction.id as trans_id,transaction.amount,transaction.referral_amount,transaction.quantity from deals join transaction on transaction.deal_id=deals.deal_id  join transaction_mapping on transaction_mapping.transaction_id=transaction.id and transaction_mapping.deal_id=transaction.deal_id where $conditions and deals.expirydate > $time and merchant_id = '$this->user_id' limit 1 ";
                        $result = $this->db->query($query);

			return $result;

	}
	/* GET SHIPPING PRODUCT COLOR */
	public function get_shipping_product_color()
	{
		$result = $this->db->from("color_code")->orderby("color_name","asc")->get();
		return $result;
	}
	/*GET SHIPPING PRODUCT SIZE */
	public function get_shipping_product_size()
	{
		$result = $this->db->from("size")->get();
		return $result;
	}
	/** UPDATE COUPON STATUS **/

	public function close_coupon_status($type = "",$coupon_code="",$deal_id = "",$trans_id=0,$act=0)
	{
	       //$count = $this->db->count_records("transaction_mapping", array("coupon_code_status" => $type), array("coupon_code" => $coupon_code,"deal_id" => $deal_id));

			//if($count==0){

             $transaction_details = $this->db->select("referral_amount","amount","deal_merchant_commission","quantity")->from("transaction")->where(array("deal_id" => $deal_id,"id" =>$trans_id))->get();
             $transaction_referral_amount=$transaction_details->current()->referral_amount;
             $merchant_commission = $transaction_details->current()->deal_merchant_commission;
             $transaction_amount=$transaction_details->current()->amount;
             $transaction_quantity=$transaction_details->current()->quantity;
             $transaction_total_amount = ($transaction_referral_amount + $transaction_amount)/$transaction_quantity;

	         // select merchant details
	         $merchant_details = $this->db->select("merchant_account_balance","merchant_commission")->from("users")->where(array("user_id" => $this->user_id))->get();

	         $merchant_account_balance = $merchant_details->current()->merchant_account_balance;
	         $admin_percentage = ($merchant_commission/100);
	         $admin_commission = $admin_percentage * $transaction_total_amount;
	         $merchant_amount = $transaction_total_amount - $admin_commission;

	         $merchant_account = $merchant_account_balance + $merchant_amount;

		  if($act==0){ // for normal transaction
	         // update merchant account balance details
	         $result_mer = $this->db->update("users", array("merchant_account_balance" => $merchant_account), array("user_id" => $this->user_id));
		  }
	         // select admin details
	      /*   $admin_details = $this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => "1"))->get();
	         $admin_account_balance=$admin_details->current()->merchant_account_balance;
	         $admin_commission_amount=($admin_account_balance+$admin_commission);
	         $admin_total_amount=($admin_commission_amount-$transaction_total_amount);

	         // update admin account balance details
	         $result_admin = $this->db->update("users", array("merchant_account_balance" => $admin_total_amount), array("user_type" => "1")); */
	         // coupon code closed
              $result = $this->db->update("transaction_mapping", array("coupon_code_status" => $type), array("coupon_code" => $coupon_code,"deal_id" => $deal_id));

			if($act==1){  // cod transaction
				//$coupon_count = $this->db->count_records("transaction_mapping", array("coupon_code_status" => $type), array("transaction_id" => $trans_id,"deal_id" => $deal_id));

				//if($coupon_count == $transaction_quantity){
					$this->db->update('transaction',array('captured_date' =>time(),'payment_status' => 'Completed','pending_reason' =>'None'),array('id' => $trans_id));
				//}
			}

                return count($result);
          //}
         // return 0;
	}

	/** GET USER LIST **/
	public function get_transaction_chart_list()
	{
	        $result = $this->db->from("transaction_mapping")
                                ->where(array("deals.merchant_id" => $this->user_id))
	                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
                                ->get();
                return $result;
	}

	/** GET DEAL TRANSACTION LIST FOR HOME PAGE**/
	public function get_merchant_deal_transaction_chart_list()
	{
	        $result = $this->db->select("transaction.*")->from("transaction")
								->where(array("deals.merchant_id" => $this->user_id))
								->join("deals","deals.deal_id","transaction.deal_id")
                                ->get();
                return $result;
	}

	/** GET PRODUCT TRANSACTION LIST FOR HOME PAGE**/
	public function get_merchant_product_transaction_chart_list()
	{
	        $result = $this->db->select("transaction.*")->from("transaction")
								->where(array("product.merchant_id" => $this->user_id))
								->join("product","product.deal_id","transaction.product_id")
                                ->get();
                return $result;
	}

	/** GET AUCTION TRANSACTION LIST FOR HOME PAGE**/
	public function get_merchant_auction_transaction_chart_list()
	{
	        $result = $this->db->select("transaction.*")->from("transaction")
								->where(array("auction.merchant_id" => $this->user_id))
								->join("auction","auction.deal_id","transaction.auction_id")
                                ->get();
                return $result;
	}
	/** GET USER LIST **/
	public function get_product_transaction_chart_list()
	{
	        $result = $this->db->from("transaction_mapping")
                                ->where(array("product.merchant_id" => $this->user_id))
	                            ->join("product","product.deal_id","transaction_mapping.product_id")
                                ->get();
                return $result;
	}

	/** GET USER LIST **/
	public function get_auction_transaction_chart_list()
	{
	        $result = $this->db->from("transaction")
	                            ->join("auction","auction.deal_id","transaction.auction_id")
								 ->where(array("auction.merchant_id" => $this->user_id))
                                ->get();
                return $result;
	}

	/** GET BIDDING DATA **/

	public function get_bidding_data_list()
	{
                $result =$this->db->from("bidding")->get();
                return $result;
	 }

	/** ADD AUCTION **/

	public function add_auction_products($post = "", $deal_key = "")
	{
		$savings = $post->product_price-$post->deal_value;
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		//$sub_cat = implode(',',$sub_cat1);

	    $result = $this->db->insert("auction", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category,"third_category_id" => $post->third_category,"product_value" => $post->product_price,"deal_value" => $post->deal_value,"deal_price" => $post->deal_value,"deal_savings"=> $savings,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date), "created_date" => time(),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, "merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"bid_increment"=>$post->bid_increment,"shipping_fee"=>$post->shipping_fee ,"shipping_info"=>$post->shipping_info,"deal_status" => 0, "for_store_cred"=>$post->store_cred));

		if(count($result) == 1){
			return $result->insert_id();
		}
		return 0;
	}

	/** UPDATE AUCTION **/

	public function edit_auction($deal_id = "", $deal_key = "", $post = "")
	{
		$sub_cat1 = $_POST['sub_category'];	 //Multiple stores have same deal
		//$sub_cat = implode(',',$sub_cat1);

		$dealdata = $this->db->select("deal_title","url_title","bid_count")->from("auction")->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))->get();

				if(count($dealdata) == 1){
			$oldurlTitle = $dealdata->current()->url_title;
			if($oldurlTitle != url::title($post->title)){
				$result = $this->db->count_records("deals", array("url_title" => url::title($post->title)));
				if($result > 0){
					return 0;
				}
			}

			$this->db->update("auction", array("deal_title" => $post->title, "url_title" => url::title($post->title), "deal_key" => $deal_key, "deal_description" => $post->description, "category_id" => $post->category,"sub_category_id" => $post->sub_category,"sec_category_id" => $post->sec_category, "third_category_id" => $post->third_category,"product_value" => $post->product_price, "deal_value" => $post->deal_value,"startdate" => strtotime($post->start_date), "enddate" => strtotime($post->end_date),"meta_keywords" => $post->meta_keywords , "meta_description" =>  $post->meta_description, "merchant_id"=>$this->user_id,"shop_id"=>$post->stores,"created_by"=>$this->user_id,"bid_increment"=>$post->bid_increment,"shipping_fee"=>$post->shipping_fee ,"shipping_info"=>$post->shipping_info), array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id));

			if($dealdata->current()->bid_count == 0 ){ // for no one bid
					$this->db->update("auction", array("deal_price" => $post->deal_value),array("deal_id" => $deal_id, "deal_key" => $deal_key));
				}


			return 1;
		}
		return 8;
	}
	/** MANAGE  AUCTION **/

	public function get_all_auction_list($type = "",$offset = "", $record = "", $city = "", $name = "",$sort_type = "",$param = "",$limit="",$today="", $startdate = "", $enddate = "")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

		if($type == 1){

		$cont = "<";
		}
		else{
		$cont = ">";
		}

		$conditions = "auction.enddate $cont ".time()." AND auction.enddate > 0 AND stores.store_status = 1 AND auction.merchant_id = $this->user_id AND city_status =1 AND country_status = 1 ";

		if($_GET){


			if($city){
			$conditions .= " and city.city_id = ".$city;
			}
			if($name){
			$conditions .= " and (deal_title like '%".mysql_real_escape_string($name)."%'";
			$conditions .= " or store_name like '%".mysql_real_escape_string($name)."%')";
			}
			if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( auction.created_date between $startdate_str and $enddate_str )";	
                        }
			$sort_arr = array("name"=>" order by auction.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by auction.deal_price $sort","count"=>" order by auction.bid_count $sort","increment"=>" order by auction.bid_increment $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by auction.deal_id DESC'; }

			$query = "select * , auction.created_date as createddate from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id where $conditions $limit1 ";


		}
		else{

			$query = "select * , auction.created_date as createddate from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id  join country on country.country_id=stores.country_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id where $conditions order by auction.deal_id DESC $limit1 ";
		}

		$result = $this->db->query($query);
		return $result;
	}

	/** AUCTION COUNT **/

	public function get_all_auction_count($type = "", $city = "", $name = "",$sort_type = "",$param = "",$today="", $startdate = "", $enddate = "")
	{
			$sort = "ASC";
			if($sort_type == "DESC" ){
				$sort = "DESC";
			}

                if($type == 1){

                        $cont = "<";
                }
                else{
                        $cont = ">";
                }

                if($_GET){

                        $conditions = "auction.enddate $cont ".time()."  AND auction.enddate > 0 AND stores.store_status = 1 AND auction.merchant_id = $this->user_id";
                        if($city){
                                $conditions .= " and city.city_id = ".$city;
                        }

                        if($name){
                                $conditions .= " and (deal_title like '%".mysql_real_escape_string($name)."%'";
			        $conditions .= " or store_name like '%".mysql_real_escape_string($name)."%')";
                        }

                        if($today == 1)
                        {
                                $from_date = date("Y-m-d 00:00:01"); 
                                $to_date = date("Y-m-d 23:59:59"); 
                                $from_date_str = strtotime($from_date);
                                $to_date_str = strtotime($to_date);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 2)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (7*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        else if($today == 3)
                        {
                                $to_date = date("Y-m-d 23:59:59"); 
                                $to_date_str = strtotime($to_date);
                                $from_date_str = $to_date_str - (30*24*3600);
                                $conditions .= " and auction.created_date between $from_date_str and $to_date_str";
                        }
                        if( $startdate != "" && $enddate != "")
                        {
	                        $startdate_str = strtotime($startdate);
	                        $enddate_str = strtotime($enddate);
	                        $conditions .= " and ( auction.created_date between $startdate_str and $enddate_str )";	
                        }
			$sort_arr = array("name"=>" order by auction.deal_title $sort","city"=>" order by city.city_name $sort","store"=>" order by stores.store_name $sort","price"=>" order by auction.deal_price $sort","count"=>" order by auction.bid_count $sort","increment"=>" order by auction.bid_increment $sort");

			if(isset($sort_arr[$param])){
	       		 $conditions .= $sort_arr[$param];
	        	}else{  $conditions .= ' order by auction.deal_id DESC'; }

                                $query = "select * from auction join stores on stores.store_id=auction.shop_id join city on city.city_id=stores.city_id join category on category.category_id=auction.category_id join users on users.user_id=auction.merchant_id   where $conditions";
                                $result = $this->db->query($query);
                }
                else{
                        $result = $this->db->select("deal_id")->from("auction")
                                        ->where(array("enddate $cont" => time(),"stores.store_status" => "1","auction.merchant_id" =>$this->user_id))
			                            ->join("stores","stores.store_id","auction.shop_id")
			                            ->join("city","city.city_id","stores.city_id")
			                            ->join("country","country.country_id","stores.country_id")
						    			->join("category","category.category_id","auction.category_id")
						    			->join("users","users.user_id","auction.merchant_id")
			                            ->orderby("deal_id","DESC")
                                        ->get();
                }
                return count($result);
	}

	/** VIEW AUCTION **/

	public function get_auction_data($deal_key = "", $deal_id = "")
	{

	        $result = $this->db->select('*','auction.sub_category_id as sub_cat','auction.sec_category_id as sec_cat')->from("auction")
                                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key))
                                                ->join("stores","stores.store_id","auction.shop_id")
                                                ->join("city","city.city_id","stores.city_id")
                                                ->join("country","country.country_id","stores.country_id")
                                                ->join("users","users.user_id","auction.merchant_id")
                                                ->join("category","category.category_id","auction.category_id")
                                                ->get();
                return $result;
	}
	
	public function get_auctionmail_data($deal_key = "", $deal_id = "")
	{

	        $result = $this->db->select('*','auction.sub_category_id as sub_cat','auction.sec_category_id as sec_cat')->from("auction")
                                                ->where(array("deal_id" => $deal_id, "deal_key" => $deal_key, "deal_status" => 1))
                                                ->join("stores","stores.store_id","auction.shop_id")
                                                ->join("city","city.city_id","stores.city_id")
                                                ->join("country","country.country_id","stores.country_id")
                                                ->join("users","users.user_id","auction.merchant_id")
                                                ->join("category","category.category_id","auction.category_id")
                                                ->get();
                return $result;
	}

	/** EDIT AUCTION DATA **/

	public function get_edit_auction($deal_id = "",$deal_key = "")
	{
		$result = $this->db->from("auction")
							->where(array("deal_id" => $deal_id, "deal_key" => $deal_key,"merchant_id" => $this->user_id))
		     				->get();
		return $result;
	}

	/** GET SINGLE USER DATA **/

	public function get_auction_users_data($userid = "")
	{
		$result = $this->db->from("users")->where(array("user_type" => $userid))->where('user_status',1)->orderby("firstname","ASC")->get();
		return $result;
	}

	/** BLOCK UNBLOCK AUCTION **/

	public function blockunblockauction($type = "", $key = "", $deal_id = "" )
	{

		$status = 0;
		if($type == 1){
		$status = 1;
		}
		$result = $this->db->update("auction", array("deal_status" => $status), array("deal_id" => $deal_id, "deal_key" => $key));
		return count($result);
	}


		/** GET SHIPPING DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/

        public function get_auction_shipping_list($offset = "", $record = "",  $name= "",$type = "",$limit="")
        {
			$limit1 = $limit !=1 ?"limit $offset,$record":"";

				$condition = "AND t.type != 5  AND d.merchant_id = $this->user_id ";

				if($type){
					$condition = " AND t.type = 5 AND d.merchant_id = $this->user_id ";
				}
        		if($_GET){
	        		$contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= 'OR u.email like "%'.mysql_real_escape_string($name).'%"';
            		$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

                   $result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id where $contitions and shipping_type = 2 $condition group by shipping_id order by shipping_id DESC  $limit1 ");
				}
				else {
					$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 2 $condition group by shipping_id order by shipping_id DESC $limit1 ");
				}
                return $result;
        }


		 /** GET CONTACTS DATA  **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping     **/

        public function get_auction_shipping_count($name = "",$type = "")
        {
				$condition = "AND t.type != 5 and d.merchant_id = $this->user_id ";
				if($type){
					$condition = " AND t.type = 5 and d.merchant_id = $this->user_id ";

				}
           		if($_GET){
			        $contitions = ' (u.firstname like "%'.mysql_real_escape_string($name).'%"';
                    $contitions .= ' OR u.email like "%'.mysql_real_escape_string($name).'%"';
					$contitions .= 'OR tm.coupon_code like "%'.mysql_real_escape_string($name).'%")';

                   $result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where $contitions and shipping_type = 2 $condition group by shipping_id order by shipping_id DESC ");
		}
		else {
			$result = $this->db->query("select s.shipping_id from shipping_info as s join transaction as t on t.id=s.transaction_id join auction as d on d.deal_id=t.auction_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join users as u on u.user_id=s.user_id where shipping_type = 2 $condition group by shipping_id order by shipping_id DESC");
		}
                return count($result);
        }


	/** AUCTION WINNER LIST  **/

	public function get_winner_list($offset = "", $record = "", $name = "",$limit="")
	{
		$limit1 = $limit !=1 ?"limit $offset,$record":"";

		$contitions = "auction.winner != 0 and auction.merchant_id = $this->user_id and bidding.winning_status!=0 ";

		if($_GET){

		        	   $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                       $contitions .= ' OR auction.deal_title like "%'.mysql_real_escape_string($name).'%")';

		}

		$query = " SELECT * FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id  join bidding on bidding.auction_id = auction.deal_id where $contitions order by auction.deal_id DESC $limit1 ";

				$result = $this->db->query($query);

	return $result;

	}

	/** AUCTION WINNER 	COUNT  **/

	public function get_winner_count($name = "")
	{
		$contitions = "auction.winner != 0 and auction.merchant_id = $this->user_id and bidding.winning_status!=0 ";

		if($_GET){
		        	   $contitions .= ' and (users.firstname like "%'.mysql_real_escape_string($name).'%"';
                       $contitions .= ' OR auction.deal_title like "%'.mysql_real_escape_string($name).'%")';
                       $result = $this->db->query("SELECT count(bidding.bid_id) as count FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id join bidding on bidding.auction_id = auction.deal_id where $contitions ");
			}

		else {
		$result = $this->db->query( " SELECT count(bidding.bid_id) as count FROM auction join users on users.user_id=auction.winner join city on city.city_id=users.city_id join country on country.country_id=users.country_id  join bidding on bidding.auction_id = auction.deal_id where $contitions " );
		}
	return $result[0]->count;

	}
	/* GET BIDDING LIST */
	public function get_bidding_list($deal_id = "")
		{
			$result = $this->db->from("bidding")->join("auction","auction.deal_id","bidding.auction_id")->join("users","users.user_id","bidding.user_id")->where(array("auction.deal_status" => 1,"auction.deal_id" => $deal_id,"users.user_status" =>1))->orderby("bid_id","DESC")->get();
		return $result;

		}
	/** GET DEALS SUB CATEGORY LIST **/

	public function get_sub_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>2))->orderby("category_name","ASC")->get();
		return $result;
	}

	public function get_sec_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>3))->orderby("category_name","ASC")->get();
		return $result;
	}

    /** GET SUB CATEGORY LIST BY CATEGORY **/
        public function get_sub_category($category = "")
	{
		$result = $this->db->from("category")
		                    ->where(array("main_category_id" => $category, "category_status" => 1,"type" => 2))
	                        ->orderby("category_name")->get();
		return $result;
	}


	/** GET SEC SUB CATEGORY LIST BY CATEGORY **/
        public function get_sec_category($category = "")
	{
		$result = $this->db->from("category")
		                    ->where(array("sub_category_id" => $category, "category_status" => 1,"type" => 3))
	                        ->orderby("category_name")->get();
		return $result;
	}

	/** GET SEC SUB CATEGORY LIST BY CATEGORY **/
        public function get_third_category($category = "")
	{
		$result = $this->db->from("category")
		                    ->where(array("sub_category_id" => $category, "category_status" => 1,"type" => 4))
	                        ->orderby("category_name")->get();
		return $result;
	}

        public function get_third_category_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"type"=>4))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** FORGOT PASSWORD **/

	public function forgot_password($email = "", $password = "")
	{

		$email = trim($email);
		$result = $this->db->from("users")->where(array("email" => $email,"user_type" => 3,"user_status" => 1))->limit(1)->get();
		if(count($result) > 0){
			
			$userid = $result->current()->user_id;
			$name = $result->current()->firstname;
			$email = $result->current()->email;
			$this->db->update("users",array("password" => md5($password) ), array("user_id" => $userid));
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function get_user_details_list($email)
	{
		$email = trim($email);
		$result = $this->db->from("users")->where(array("email" => $email,"user_type" => 3,"user_status" => 1))->limit(1)->get();
		return $result;
	}

	/* GET DEALS CHART */
	public function get_deals_chart_list()
	{
	    $result_active_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate >" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","deals.merchant_id" => $this->user_id))->get();
		$result["active_deals"]=count($result_active_deals);

		$result_archive_deals =$this->db->from("deals")->join("stores","stores.store_id","deals.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1","deals.merchant_id" => $this->user_id))->get();
		$result["archive_deals"]=count($result_archive_deals);
		return $result;
	}
	/* GET PRODUCT CHART LIST */
	public function get_products_chart_list()
	{
	    $result_active_products = $this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count < user_limit_quantity and deal_status = 1 and stores.store_status = 1 and product.merchant_id = $this->user_id");
		$result["active_products"]=count($result_active_products);

		$result_sold_products =$this->db->query("SELECT * FROM product join stores on stores.store_id=product.shop_id WHERE purchase_count = user_limit_quantity and deal_status = 1 and stores.store_status = 1 and product.merchant_id = $this->user_id");
		$result["archive_products"]=count($result_sold_products);
		return $result;
	}

	/** AUCTION DASHBOARD   **/

	public function get_auction_chart_list()
	{
	    $result_active_deals =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate >" => time(), "auction.merchant_id" =>$this->user_id,"deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["active_auction"]=count($result_active_deals);

		$result_archive_deals =$this->db->from("auction")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","stores.city_id")->join("country","country.country_id","city.country_id")->where(array("enddate <" => time(),"auction.merchant_id" =>$this->user_id, "deal_status"=>"1","stores.store_status" => "1", "city_status" => "1", "country_status"=>"1"))->get();
		$result["archive_auction"]=count($result_archive_deals);
		return $result;
	}

		/** REGISTER DELS AUTO POST INTO FACEBOOK  WALL **/

	public function register_autopost($fb_profile = array(),$fb_access_token = "")
	{

        $result= $this->db->update("users", array("fb_user_id" => $fb_profile->id ,"fb_session_key" => $fb_access_token,"facebook_update"=>1), array("user_id" =>$this->user_id));
		$this->session->set(array("fb_access_token" => $fb_access_token,"fb_user_id" => $fb_profile->id));
		return $result;
	}

	/** UPDATE DEAL AUTO POST **/
	public function update_autopost($value = "")
	{
		$result = $this->db->update("users", array("facebook_update" =>$value,"fb_user_id"=>0,"fb_session_key"=>0), array("user_id" =>$this->user_id));
		return $result;
	}

	/** GET PRODUCT COLOR **/

	public function get_color_code()
	{
		$result = $this->db->from("color")->join("color_code","color_code.color_code","color.color_name","left")
				->where(array("color_status" =>0,"color_code.color_name!="=>"NULL"))
				->orderby("color.color_code_name","ASC")
				->groupby("color.color_name")
		     		->get();
		return $result;
	}

	/** GET PRODUCT SIZE **/

	public function get_product_size()
	{
		$query = "SELECT * FROM size ORDER BY CAST(size_name as SIGNED INTEGER) ASC";
	        $result = $this->db->query($query);
		return $result;
	}

	/** GET PRODUCT COLOR **/

	public function get_color_data($color_id="")
	{
		$result = $this->db->from("color_code")
		                ->where(array("color_code" => $color_id))
						->get();
		return $result;
	}

	/** GET PRODUCT SIZE **/

	public function get_size_data($size_id="")
	{
		$result = $this->db->from("size")
		                ->where(array("size_id" => $size_id))
		     		->get();
		return $result;
	}

	/** GET PRODUCT COLOR **/

	public function get_product_color($deal_id = "")
	{
		$result = $this->db->from("color")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}
	/** GET PRODUCT SIZE **/

	public function get_product_one_size($deal_id = "")
	{
		$result = $this->db->from("product_size")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}

	/** GET PRODUCT COLOR **/

	public function store_size_data($city_id = "",$deal_id = "")
	{
	    $dealdata = $this->db->select("product_size_id")->from("product_size")->where(array("deal_id" => $deal_id,"size_id" => $city_id))->get();
	    if(count($dealdata) == 1){
	        return 0;
	    } else {

	    $result_id = $this->db->select("size_name")->from("size")->where(array("size_id" => $city_id))->get();
		$result = $this->db->insert("product_size", array("deal_id" => $deal_id,"size_id" => $city_id,"size_name" => $result_id->current()->size_name));
		return 1;
		}
	}

	/** GET PRODUCT COLOR **/

	public function store_color_data($city_id = "",$deal_id = "")
	{
	    $dealdata = $this->db->select("color_id")->from("color")->where(array("deal_id" => $deal_id,"color_name" => $city_id))->get();
	    if(count($dealdata) == 1){
	        return 0;
	    } else {

	    $result_id = $this->db->select("id","color_name")->from("color_code")->where(array("color_code" => $city_id))->get();
		$result = $this->db->insert("color", array("deal_id" => $deal_id,"color_code_id" => $result_id->current()->id,"color_name" => $city_id,"color_code_name" => $result_id->current()->color_name));

		return 1;
		}
	}
	/** GET SHIPPING DATA FOR DELIVERY MAIL **/
		/**   s->shipping_info,t->transaction,u->user,tm->transaction_mapping    **/

        public function get_shipping_list1()
        {
			$result = $this->db->query("select *,s.adderss1 as saddr1,s.address2 as saddr2,u.phone_number,t.id as trans_id,stores.address1 as addr1,stores.address2 as addr2,stores.phone_number as str_phone,t.shipping_amount as shipping from shipping_info as s join transaction as t on t.id=s.transaction_id join product as d on d.deal_id=t.product_id join transaction_mapping as tm on tm.transaction_id = t.id join city on city.city_id=s.city join stores on stores.store_id = d.shop_id join users as u on u.user_id=s.user_id  where shipping_type = 1  group by shipping_id order by shipping_id DESC");
            return $result;
        }

        /**  UPDATE THE DELIVERY STATUS OF COD **/
	public function update_cod_shipping_status($id = "",$type="",$trans_id=0,$product_id=0,$merchant_id=0)
	{
			
			$check = $this->db->count_records('shipping_info',array('shipping_id' =>$id,'delivery_status'=>0));
			if($check){
			$get_detail = $this->db->select("deal_merchant_commission","shipping_amount","tax_amount","amount","product_size","quantity")->from('transaction')->where(array("id" =>$trans_id,"product_id" =>$product_id))->get();
			if(count($get_detail)){
				if($type==4){ // for completed transaction update the merchant balance
				$product_amount=$get_detail[0]->amount;
				 $total_pay_amount = ($product_amount + $get_detail[0]->shipping_amount + $get_detail[0]->tax_amount);
				 $commission=(($product_amount)*($get_detail[0]->deal_merchant_commission/100));
				 $merchantcommission = $total_pay_amount - $commission ;
				 //$this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

				 $this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Success','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));

				}
				else if($type==5){  // for failed transcation reset the quantity for that size
						$quantity=$get_detail[0]->quantity;
						$size_id = $get_detail[0]->product_size;
					$this->db->query("update product_size set quantity = quantity + $quantity where deal_id = '$product_id' and size_id = '$size_id' ");

					$this->db->query("update product set user_limit_quantity = user_limit_quantity + $quantity where deal_id = '$product_id'");

					$this->db->update('transaction',array('payment_status' => 'Failed','pending_reason' =>'Not paid'),array('id' => $trans_id));

				}
			}

		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id ,'shipping_type' => 1));

		return count($result);
		}
		return 0;
	}

	public function get_auction_mail_data($deal_id = "",$transaction_id = "",$shipping_id="")
	{

		$result = $this->db->select("shipping_info.*,auction.deal_title,deal_price,transaction.bid_amount,transaction.quantity,transaction.shipping_amount,transaction.tax_amount,transaction.transaction_date,store_name,stores.address1 as addr1,stores.address2 as addr2,city_name,stores.zipcode,stores.phone_number as str_phone,transaction.shipping_amount as shipping,shipping_info.adderss1 as saddr1,shipping_info.address2 as saddr2,shipping_info.phone,stores.website,shipping_info.name,shipping_info.country,auction.deal_key,auction.deal_value,auction.url_title,users.fb_session_key,users.fb_user_id,users.email,users.facebook_update")->from("shipping_info")->join("transaction","transaction.id","shipping_info.transaction_id")->join("auction","auction.deal_id","transaction.auction_id")->join("stores","stores.store_id","auction.shop_id")->join("city","city.city_id","shipping_info.city")->join("users","users.user_id","shipping_info.user_id")->where(array("shipping_info.shipping_id" => $shipping_id,"transaction.id" =>$transaction_id,"auction.deal_id" => $deal_id))->get();

		return $result;
	}

	/**  UPDATE THE DELIVERY STATUS OF AUCTION COD  **/
	public function auction_update_cod_shipping_status($id = "",$type="",$trans_id=0,$auction_id=0,$merchant_id=0)
	{

	$check = $this->db->count_records('shipping_info',array('shipping_id' =>$id,'delivery_status'=>0));
			if($check){
			$get_detail = $this->db->select("deal_merchant_commission","shipping_amount","tax_amount","amount","product_size","quantity")->from('transaction')->where(array("id" =>$trans_id,"auction_id" =>$auction_id))->get();
			if(count($get_detail)){
				if($type==4){ // for completed transaction update the merchant balance
				$product_amount=$get_detail[0]->amount;
				 $total_pay_amount = ($product_amount + $get_detail[0]->shipping_amount + $get_detail[0]->tax_amount);
				 $commission=(($product_amount)*($get_detail[0]->deal_merchant_commission/100));
				 $merchantcommission = $total_pay_amount - $commission ;
				 $this->db->query("update users set merchant_account_balance = merchant_account_balance + $merchantcommission where user_type = 3 and user_id = $merchant_id ");

				 $this->db->update('transaction',array('captured' => 1,'captured_date' =>time(),'payment_status' => 'Success','pending_reason' =>'None'),array('id' => $trans_id));

				$this->db->update('transaction_mapping',array('coupon_code_status' => 0),array("transaction_id" => $trans_id));

				}
				else if($type==5){  // for failed transcation reset the quantity for that size

						$time=time()+(AUCTION_EXTEND_DAY*24*60*60);
						$result = $this->db->query("UPDATE auction SET enddate = $time,winner = 0,auction_status = 0 WHERE deal_id = $auction_id");
						$this->db->delete("bidding",array("auction_id" => $auction_id));

					$this->db->update('transaction',array('payment_status' => 'Failed','pending_reason' =>'Not paid'),array('id' => $trans_id));

				}
			}

		$result = $this->db->update('shipping_info',array('delivery_status' => $type),array('shipping_id' => $id ,'shipping_type' => 2));

		return count($result);
		}
		return 0;

	}

	/* GET HIGHEST BID */
		public function get_highest_bid($deal_id ="")
		{
			$result = $this->db->from("bidding")->select("bid_amount","bid_id")->where(array("auction_id" => $deal_id))->orderby("bid_amount","DESC")->limit(1)->get();
			return $result;
		}

	/** GET MERCHANT BALANCE **/

	public function get_merchant_balance1()
	{
                $result =$this->db->select("merchant_account_balance")->from("users")->where(array("user_type" => 3, "user_id" => $this->user_id))->get();
                return (count($result))?$result->current()->merchant_account_balance:0;
	}

		/* Attributes start */
	/*To get all attributes*/
	public function GetAttributes(){
		 $result = $this->db->from("attribute")->get();

		return $result;
	}

	/*To get single product attributes*/
	public function get_product_attributes($product_id=""){
		 $result = $this->db->from("product_attribute")->where(array("product_id"=>$product_id))->get();
		 return $result;
	}

	/*To get product attribute and attribute groups*/
	public function getProductAttributes() {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->select("ag.attribute_group_id", "ag.groupname", "ag.sort_order")
						->from("attribute as a")
						->join("attribute_group as ag","a.attribute_group" ,"ag.attribute_group_id","left")
						->groupby("ag.attribute_group_id")
						->orderby("ag.sort_order", "ag.groupname","asc")
						->get()->as_array(false);
		//print_r($product_attribute_group_query); exit;
		 foreach ($product_attribute_group_query as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->select("a.attribute_id", "a.name")
						->from("attribute as a")
						->where(array("a.attribute_group"=>$product_attribute_group['attribute_group_id']))
						->groupby("a.attribute_id")
						->orderby("a.sort_order", "a.name","asc")
						->get()->as_array(false);


			foreach ($product_attribute_query as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['groupname'],
				'attribute'          => $product_attribute_data
			);
		}

		//print_r($product_attribute_group_data); exit;
		return $product_attribute_group_data;
	}

	/* Attributes end */

	/*To get single product policy*/
	public function get_product_policy($product_id=""){
		 $result = $this->db->from("product_policy")->where(array("product_id"=>$product_id))->get();
		 return $result;
	}
	
	/** GET MERCHANT SHIPPING DATA **/
	
	public function get_shipping_data()
	{
		$result = $this->db->from("shipping_module_settings")->where(array("ship_user_id" => $this->user_id))->limit(1)->get();
		return $result;
	}
	
	/** UPDATE SHIPPING ACCOUNT SETTINGS **/
	
	public function shipping_settings($post = "")
	{
		$result = $this->db->update("users",array("AccountCountryCode" => $post->AccountCountryCode, "AccountEntity" => $post->AccountEntity, "AccountNumber" => $post->AccountNumber, "AccountPin" => $post->AccountPin,"UserName" => $post->UserName, "ShippingPassword" => $post->Password ), array("user_type" => 3, "user_id" => $this->user_id));
		return 1;
	}
	
		/** Import product option category add **/

	public function importproduct_addcategory($category = "",$sub_category = "",$sec_category = "",$third_category = "")
	{//echo $category.'<br />'.$sub_category.'<br />'.$sec_category.'<br />'.$third_category;
		$main_cat_id = 0;
		$sub_cat_id = 0;
		$sec_cat_id = 0;
		$third_cat_id = 0;
		if(($category != "") && ($sub_category != "") && ($sec_category != "")){
		$result = $this->db->count_records("category", array("category_url" => url::title($category)));
		if($result > 0){
			$status = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($category),"type"=>1))->get();
			$main_cat_id = (count($status))?$status[0]->category_id:0;
		}
		if($main_cat_id!=0){
			$result1 = $this->db->count_records("category", array("category_url" => url::title($sub_category)));
			if($result1 > 0){
				$status1 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sub_category),"type"=>2))->get();
				$sub_cat_id = (count($status1))?$status1[0]->category_id:0;
			}
			
		}
		if($sub_cat_id!=0){
			$result2 = $this->db->count_records("category", array("category_url" => url::title($sec_category)));
			if($result2 > 0){
				$status2 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($sec_category),"type"=>3))->get();
				$sec_cat_id = (count($status2))?$status2[0]->category_id:0;
			}
			
		}
		$third_cat_id=0;
		if($third_category!=""){
			if($sec_cat_id!=0){
				$result3 = $this->db->count_records("category", array("category_url" => url::title($third_category)));
				if($result3 > 0){
					$status3 = $this->db->select('category_id')->from('category')->where(array("category_url" => url::title($third_category),"type"=>4))->get();
					$third_cat_id = (count($status3))?$status3[0]->category_id:0;
				}
			}
		}
	}
	
		$cat_result['main_category_id'] = $main_cat_id;
		$cat_result['sub_category_id'] = $sub_cat_id;
		$cat_result['sec_category_id'] = $sec_cat_id;
		$cat_result['third_category_id'] = $third_cat_id;
		
	//echo '$main_cat_id:'.$main_cat_id.'$sub_cat_id:'.$sub_cat_id.'$sec_cat_id:'.$sec_cat_id.'$third_cat_id:'.$third_cat_id; exit;
		return $cat_result;
	}
	
	/** GET MERCHANT DETAILS **/
	
	public function get_merchant_details($shop_name="")
        {
                $query = "select * from users left join stores ON users.user_id=stores.merchant_id where stores.store_name='$shop_name' AND users.user_id=$this->user_id";
                $result = $this->db->query($query);                     
                return $result;
        }
        
        public function get_merchant_and_shop_status($shop_name="")
	{
                $merchant_id = $this->user_id;
                $query = "select * from stores where store_name='$shop_name' AND merchant_id='$merchant_id'";
                $result_1 = $this->db->query($query);  
                $result = count($result_1);
                if($result == 1)
                {
                        return 1;
                }
                else
                {
                        return 0;
                }
		
	}
	
	/** GET COLOR DETAILS **/
	
	public function get_color_details($color)
	{
		$result = $this->db->from("color_code")->where(array("color_name" => $color))->get();
		return $result;
	}
	
	/** GET SIZES **/
	
	public function get_size_details($size)
	{
		$result = $this->db->count_records("size", array("size_name" => $size));
		if($result == 0){
			$result = $this->db->insert("size",array("size_name" =>$size,"size_arabic" =>""));
		}
		$result = $this->db->from("size")->where(array("size_name" => $size))->get();
		return $result;
	}
	
	/** IMPORT PRODUCTS **/
	
	public function add_import_product($adminid ="",$title = "",$deal_key="", $category_id = "",$sub_category_id = "",$sec_category_id = "",$third_category_id = "",$product_price ="", $discount_price ="", $product_desc = "",$deliver_days ="",$merchant_id ="",$shop_id ="",$color_val ="",$size_val ="",$col ="",$size ="",$size_quantity="",$attribute_type="",$attribute="",$meta_keywords="",$meta_description="",$deliver_policy="",$shipping_amount_val = "" , $shipping_method = "",$shipping_weight = "", $shipping_height = "", $shipping_length ="", $shipping_width ="")
	{ 
		if($category_id !="0" && $sub_category_id !="0" ) {
                        $quantity = "";
                        foreach($size_quantity as $sq){
                                $quantity += $sq;
                        }

			$inc_tax = "1";
			
			$shipping_amount = "0";
			 if(isset($shipping_amount_val)) {
			        $shipping_amount = $shipping_amount_val;
			 }
			 
			 $weight = "0";
			 if(isset($shipping_weight)) {
			        $weight = $shipping_weight;
			 }
			 $height = "0";
			 if(isset($shipping_height)) {
			        $height = $shipping_height;
			 }
			 $length = "0";
			 if(isset($shipping_length)) {
			        $length = $shipping_length;
			 }
			 $width = "0";
			 if(isset($shipping_width)) {
			        $width = $shipping_width;
			 }
			 
			$savings=($product_price-$discount_price);
			$result = $this->db->insert("product", array("deal_title" => $title,"url_title" => url::title($title), "deal_key" => $deal_key,"category_id" => $category_id,"sub_category_id" => $sub_category_id,"sec_category_id" =>  $sec_category_id,"third_category_id" =>  $third_category_id,"deal_price" => $product_price,"deal_value" => $discount_price,"deal_savings" => $savings,"deal_percentage" => ($savings/$discount_price)*100,"deal_description" => $product_desc,"size" =>$size_val,"color" =>$color_val,"delivery_period" => $deliver_days,"merchant_id" =>$merchant_id,"shop_id" => $shop_id,"created_date" => time(),"created_by"=>$adminid,"user_limit_quantity"=>$quantity,"deal_status" =>0,"attribute"=>$attribute_type,"meta_description"=>$meta_description,"meta_keywords"=>$meta_keywords,"shipping_amount"=>$shipping_amount,"shipping"=>$shipping_method,"Including_tax" =>$inc_tax,"weight" => $weight,"height" => $height,"length" => $length,"width" => $width,"created_date" => time()));
	                $product_id = $result->insert_id();
                        if(($color_val) == 1){
                                foreach ($col as $colors) {
                                        $color_detail = explode("_",$colors);
                                        $color_id = $color_detail[0];
                                        $color_code = $color_detail[1];
                                        $color_name = $color_detail[2];
                                        $result_color = $this->db->insert("color", array("deal_id" => $product_id, "color_name" => $color_code, "color_code_id" => $color_id,"color_code_name" => $color_name));
                                } 
                        } 
                        if(($size_val) == 1){
                                foreach ($size as $sizes) {
                                        $size_detail = explode("_",$sizes);
                                        $size_id =$size_detail[0];
                                        $size_name =$size_detail[1];
                                        $size_quant =$size_detail[2];
                                        $result_color = $this->db->insert("product_size", array("deal_id" => $product_id, "size_name" => $size_name, "size_id" => $size_id,"quantity"=>$size_quant));
                                }			
                        }
                        if($attribute_type !=0){
                                foreach($attribute as $a) {
                                        $vals = explode('-',$a);
                                        $main_attr_group = isset($vals[0])?$vals[0]:'';
                                        $sub_attr_group = isset($vals[1])?$vals[1]:'';
                                        $attr_description = isset($vals[2])?$vals[2]:'';
                                        $main_group_id = $this->get_main_group($main_attr_group);
                                        $sub_group_id = $this->get_sub_group($sub_attr_group,$main_group_id);
                                        if(($main_attr_group !='') &&  ($sub_attr_group !='')) { 
                                                $result_attribute = $this->db->insert("product_attribute", array("product_id" => $product_id, "attribute_id" => $sub_group_id,"text"=>$attr_description));
                                        }
                                }	
                        }
                        $Deli_result = $this->db->delete('product_policy', array('product_id' => $product_id));
	                $result_Delivery = $this->db->insert("product_policy", array("product_id" => $product_id,"text"=>$deliver_policy));
	                return $product_id;
	                }
        }
        
         /* GET ATTRIBUTE MAIN GROUP DETAILS */
	   public function get_main_group($groupname="")
	   {
			$result = $this->db->select("attribute_group_id")->from("attribute_group")->where(array("groupname"=>$groupname))->get();
			$group_id = (count($result))?$result[0]->attribute_group_id:0;
			return $group_id;
	   }
	      /* GET ATTRIBUTE SUB GROUP DETAILS */
	   public function get_sub_group($subgroupname="",$maingroupid="")
	   {
			$result = $this->db->select("attribute_id")->from("attribute")->where(array("name"=>$subgroupname,"attribute_group"=>$maingroupid))->get();
			$sub_group_id = (count($result))?$result[0]->attribute_id:0;
			return $sub_group_id;
	   }
		

}
