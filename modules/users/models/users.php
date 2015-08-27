<?php defined('SYSPATH') or die('No direct script access.');
class Users_Model extends Model
{
	public function __construct()
	{
		
		parent::__construct();
		$this->db=new Database();
		$this->session = Session::instance();
		$this->city_id = $this->session->get("CityID");
		$this->UserID = $this->session->get("UserID");
		
		
		
		
	}
        
        /*
        * ZENITH BANK OPEN NEW BANK ACCOUNT FOR LOGGED IN USER
         * WE SEND AN EMAIL TO THE USER
         * @param JSONObject of valid required fields to Open an account
        */
        public function update_user_to_club_membership($create_account = false, $params=""){
            /*
				before attempting to open this account for this user
				need to check if user already created an account with this platform before
			*/
			
           /* $result = $this->db->query("SELECT * FROM zenith_opened_account WHERE user_id=".$this->UserID);
				if(count($result) > 0){
					return -1;//user already opened account with this platform in the past
				}
            */
			
			
			/*
				I don't think this is required. Club membership signup is only restricted
				on none club members. If they opened up zenith account on this platform, their
				profile is automatically updated to club members.(Open for discussion thought :-))
				@Live
			*/
						
			$params_obj = arr::to_object($params);	
			
			try{
				/*	Insertion into zenith_opened_account table
					@Live
				*/
				if($create_account){
				        $this->db->insert("zenith_opened_account", array("user_id" => $this->UserID,
						"account_number"=>$params_obj->account_number, "account_name"=>$params_obj->account_name, "account_class"
						=>$params_obj->account_class));
				}
				/*
					Auto update user profile to club membership
					@Live
				*/
				
				
				$u_tb_name = 'users';
				$u_columns = array('nuban'=>$params_obj->account_number, 'club_member'=>1);
				$u_where = array('user_id'=>$this->UserID);
				$results = $this->db->update($u_tb_name, $u_columns, $u_where);
				/*
					Set club session variable to 1 (for club members);
					@Live
				*/
				$this->session->set(array("Club"=>1));	
				return 1;
					
			} catch(Exception $e){
				/*
					TODO
					Incase of any failure, need to roll back both transactions above.
					@Live
				*/
				return -1;
			}
			
                
            
        }
        
        /*
        * ZENITH BANK VALIDATE ACCOUNT NUMBER FOR LOGGED IN USERS IF VALIDATION IS SUCCESSFUL
        * WE UPDATE THE DB AND FLAG USER ROW AS A CLUB MEMBER AND INSERT USER'S 
        * @param NUBAN provided
        */
		
		
		/*
			I renamed this method from 
			update_user_to_club_membership to update_user_for_club_membership
			@Live
		*/
		 
		 function update_user_for_club_membership($arg = ""){
			 
			 	$acc_no = $arg['account_number'];
				try{
					
                	$status = $this->db->update("users", array("club_member" => 1 , "nuban" => $acc_no), array("user_id" =>$this->UserID));
					 return 1;
					
				}catch(Exception $e){
					return -1;
				}
				
				
				
               
		 }
		
		
        
       
        
        /*
         * ZENITH BANK GETTING ACCOUNT CLASS AS AN ARRAY KEY=CODE, VALUE=DEESCRIPTION
         * @param None
         */
        public function club_registration_get_account_class(){
            $ret = array();
            $arg = array();
            $arg['userName'] = ZENITH_TEST_USER;
            $arg['Pwd'] = ZENITH_TEST_PASS;
            $soap = new SoapClient(ZENITH_TEST_ENDPOINT);
            $fun_resp_class = $soap->getAccountClass($arg);
            foreach($fun_resp_class->getAccountClassResult->ClassCode as $value){
                $ret[$value->ClassCodes] = $value->ClassName;
            }
            return $ret;
        }
        
        /*
         * VERIFICATION OF ACCOUNT NUMBER ONLY FUNCTION
         * @param NUBAN number only
         */
        public function club_verify_account_number($nuban){
            $arg = array();
            $arg['userName'] = ZENITH_TEST_USER;
            $arg['Pwd'] = ZENITH_TEST_PASS;
            $soap = new SoapClient(ZENITH_TEST_ENDPOINT);
            $arg['account_number'] = $nuban;
            $fun_resp = $soap->VerifyAccount($arg); //call the soap api to validate
            if($fun_resp->VerifyAccountResult->errorMessage != ""){
                return 0; //error occured. could not verify account number
            }
            //for the SOAP not to throw an error. it means the account number is valid.
            //go i need to check the database to know if such account number has not been tied to a user before
            //its fraud if 2 customers uses thesame account number to sign up for club membership
            $result_check_nuban = $this->db->query("SELECT nuban FROM users WHERE nuban='".$arg['account_number']."'");
            if(count($result_check_nuban) > 0){
                return -1 ; //This NUBAN number has been Used by another Customer;
            }
            else{
                return 1; //account number provided is valid and can be used.
            }
        }
	
        /* CLUB MEMBER REG EXTENDING WHAT REG DOES ADDING $post->account_number field
         * Update your 'users' table add column 'club_member'=>int(1) set default to be 0
         */
        
        public function club_registration_new_not_registered($post = "" , $user_referral_id = ""){
            //before registering the user. I will have to check if user account is valid
            $arg = array();
            $arg['userName'] = ZENITH_TEST_USER;
            $arg['Pwd'] = ZENITH_TEST_PASS;
            $soap = new SoapClient(ZENITH_TEST_ENDPOINT);
            $arg['account_number'] = $post->account_number;
            $fun_resp = $soap->VerifyAccount($arg); //call the soap api to validate
            if($fun_resp->VerifyAccountResult->errorMessage != ""){
                return 0; //error occured. could not verify account number
            }
            //for the SOAP not to throw an error. it means the account number is valid.
            //go i need to check the database to know if such account number has not been tied to a user before
            //its fraud if 2 customers uses thesame account number to sign up for club membership
            $result_check_nuban = $this->db->query("SELECT nuban FROM users WHERE nuban='".$arg['account_number']."'");
            if(count($result_check_nuban) > 0){
                return -1 ; //This NUBAN number has been Used by another Customer;
            }
            $referral_id = text::random($type = 'alnum', $length = 8);
            $result_country = $this->db->select("country_id")->from("city")->where(array("city_id" => $post->city ))->limit(1)->get();
            $country_value = $result_country->current()->country_id;
            $referred_user_id = 0;
            if($user_referral_id)
            {
            $result_referral = $this->db->select("user_id")->from("users")->where(array("referral_id" =>$user_referral_id))->limit(1)->get();
                    if(count($result_referral)){
                            $referred_user_id  = $result_referral->current()->user_id;
                    }
            }
            $result = $this->db->insert("users", array("firstname" => $post->f_name, "email" => $post->email, "password" =>  md5($post->password),
                "city_id" => $post->city, "country_id" => $post->country, "referral_id" => $referral_id, 
                "referred_user_id" =>$referred_user_id, "joined_date" => time(),"last_login" => time(), 
                "user_type"=> 4, "club_member"=>1, "nuban"=>$arg['account_number']));

            $result_city = $this->db->select("category_id,city_id")->from("email_subscribe")->where(array("email_id" =>$post->email))->get();
            if(count($result_city) > 0) {
                $city_subscribe = $result_city->current()->city_id;
                $city_subscribe .=",".$post->city;
                $result = $this->db->update("email_subscribe", array("user_id" =>$result->insert_id(),"category_id"=> $city_subscribe),array("email_id" => $post->email));		        
            } else {
                $category_result = $this->db->query("select * from category where type = 1 and category_status = 1  ORDER BY RAND() LIMIT 1");
                $category_subscribe = $category_result->current()->category_id;
                $result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $result->insert_id(), "email_id" => 
                    $post->email,"city_id" => $post->city,"country_id" =>$post->country,"category_id" =>$category_subscribe));
            }
            $this->session->set(array("UserID" => $result->insert_id(), "UserName" => $post->f_name, "UserEmail" => $post->email, 
                "city_id" => $post->city, "UserType" => 4, "club_member"=> 1));
            return 1; //Account number verified & User Registered;            
        }
        
	/** GET LOGIN DETAILS **/
	
	/*
		Reset Zenith Offer session variable after loading membership popup.
		
		@Live
	*/
	
	public function reset_z_offer_session_var(){
		
		 $this->session->set("ZenithOffer", 0);
		 
	}
	
	
	
	/*
		Added Zenith offer parameter for autoloading the offer
		@Live
	*/

	public function login_users($email = "",$password = "", $z_offer = "0")
	{ 
		$result = $this->db->from("users")->where(array("email" => $email, "password" =>  md5($password),"user_type" =>4))->get();
		if(count($result) == 1){
			foreach($result as $a){
				if($a->user_status == 1){ 
						
				        $this->session->set(array("UserID" => $a->user_id, "UserName" => $a->firstname , "UserEmail" => $a->email, 
                                            "city_id" => $a->city_id,"UserType" => $a->user_type, "Club"=>$a->club_member, "ZenithOffer" => $z_offer));
						
						
						if(strcmp($z_offer, "1") == 0)
				        	return -999;
						return 1;
						
				}
				else if($a->user_status == 0){
				        return 8;
				}
				else{
				        return -1;
				}
			}
		} else { return -1; }
	}
	
	    /** REGISTER USERS **/

	    public function add_users($post = "" , $user_referral_id = "")
	    {
		$referral_id = text::random($type = 'alnum', $length = 8);
		$result_country = $this->db->select("country_id")->from("city")->where(array("city_id" => $post->city ))->limit(1)->get();
		$country_value = $result_country->current()->country_id;
		$referred_user_id = 0;
		if($user_referral_id)
		{
		$result_referral = $this->db->select("user_id")->from("users")->where(array("referral_id" =>$user_referral_id))->limit(1)->get();
			if(count($result_referral)){
				$referred_user_id  = $result_referral->current()->user_id;
			}
		}
		$result = $this->db->insert("users", array("firstname" => $post->f_name, "email" => $post->email, "password" =>  md5($post->password),"city_id" => $post->city, "country_id" => $post->country, "referral_id" => $referral_id, "referred_user_id" =>$referred_user_id, "joined_date" => time(),"last_login" => time(), "user_type"=> 4));
		
		
		$result_city = $this->db->select("category_id,city_id")->from("email_subscribe")->where(array("email_id" =>$post->email))->get();
		   	 
				if(count($result_city) > 0) {
					
					
                        $city_subscribe = $result_city->current()->city_id;
                        $city_subscribe .=",".$post->city;
						
					
                        $result = $this->db->update("email_subscribe", array("user_id" =>$result->insert_id(),"category_id"=> $city_subscribe),array("email_id" => $post->email));
						
							
						
                        } else {
						
                        $category_result = $this->db->query("select * from category   where type = 1 and category_status = 1  ORDER BY RAND() LIMIT 1");
			$category_subscribe = $category_result->current()->category_id;
		        $result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $result->insert_id(), "email_id" => $post->email,"city_id" => $post->city,"country_id" =>$post->country,"category_id" =>$category_subscribe));
				
						
    		        
  		        }
				
		$this->session->set(array("UserID" => $result->insert_id(), "UserName" => $post->f_name, "UserEmail" => $post->email, "city_id" => $post->city, 
                    "UserType" => 4, "Club"=>0));
		return 1;
	}
	
	/** REGISTER FACEBOOK USERS **/

	public function register_facebook_user($fb_profile = array(), $city_id="", $fb_access_token = "",$user_referral_id = "",$password = "")
	{ 
		$result_country = $this->db->from("city")->where(array("default" =>1))->limit(1)->get();
		$country_value = "";
		if(count($result_country) >0 ){
		$country_value = $result_country->current()->country_id; 
		$city_id = $result_country->current()->city_id; 
		}
				                              
		$result = $this->db->from("users")->where(array("email" => $fb_profile->email))->limit(1)->get();
		if(count($result) == 0){
			$fb_image_url = "http://graph.facebook.com/".$fb_profile->id."/picture";
			//$password = text::random($type = 'alnum', $length = 10);
			$store_key = text::random($type = 'alnum', $length = 10);
			$referral_id = text::random($type = 'alnum', $length = 10);
			$referred_user_id = 0;
			if($user_referral_id)
		    {
		        $result_referral = $this->db->select("user_id")->from("users")->where(array("referral_id" =>$user_referral_id))->limit(1)->get();
			    if(count($result_referral)){
				    $referred_user_id  = $result_referral->current()->user_id;
			    }
		    }
			
			$insert = $this->db->insert("users",array("firstname" => $fb_profile->first_name, "lastname" => $fb_profile->last_name , "email" => $fb_profile->email, "password" => md5($password), "city_id" => $city_id , "country_id" => $country_value,"referral_id" => $referral_id,"referred_user_id" =>$referred_user_id,"joined_date" => time(), "last_login" => time(),  "fb_user_id" => $fb_profile->id , "fb_session_key" => $fb_access_token ,"login_type"=>"3"));

			$result_city = $this->db->select("category_id")->from("email_subscribe")->where(array("email_id" =>$fb_profile->email))->get();
			if(count($result_city) > 0){
						$city_subscribe = $result_city->current()->category_id;
						$result = $this->db->update("email_subscribe", array("user_id" =>$insert->insert_id(),"category_id" =>$city_subscribe),array("email_id" => $fb_profile->email));
				
					} else {
				$category_result = $this->db->query("select * from category   where type = 1 and category_status = 1  ORDER BY RAND() LIMIT 1");
				$category_subscribe = $category_result->current()->category_id;
				$result_email_subscribe = $this->db->insert("email_subscribe", array("user_id" => $insert->insert_id(),"email_id" => $fb_profile->email,"category_id" => $category_subscribe));
  		                        }
			$this->session->set(array("UserID" => $insert->insert_id(), "UserName" => $fb_profile->first_name, "UserEmail" => $fb_profile->email, "fb_access_token" => $fb_access_token,"UserType" => "4"));
			
			if($fb_image_url){
				$image = file_get_contents($fb_image_url);
				$file = DOCROOT.'images/user/150_115/'.$insert->insert_id().".jpg";
				file_put_contents($file, $image);
			}
			
			
		} else {
			$userid = $result->current()->user_id;
			$name = $result->current()->firstname;
			$user_type = $result->current()->user_type;
			$this->session->set(array("UserID" => $userid, "UserName" => $name, "UserEmail" => $fb_profile->email,"UserType" => $user_type));
			return 1;
		}
		return $insert->insert_id();
	}
	
	/** REGISTER FACEBOOK USERS **/

	public function facebook_share_user($fb_profile = array(), $fb_access_token = "")
	{
            $fb_image_url = "http://graph.facebook.com/".$fb_profile->id."/picture";		
	        $result = $this->db->update("users", array("fb_user_id" => $fb_profile->id , "fb_session_key" => $fb_access_token , "facebook_update" => "1"), array("user_id" =>$this->UserID));

			if($fb_image_url){
				$image = file_get_contents($fb_image_url);
				$file = DOCROOT.'images/user/150_115/'.$this->UserID.".jpg";
				file_put_contents($file, $image);
			}
		return;
	}
	
	/** CHECK USER EXIST **/
	
	public function check_user_exist($email = "", $z_offer = "0")
	{
		$result = $this->db->from('users')->where(array('email' => $email))->get();
		if(count($result) == 0){
			if(strcmp($z_offer, "1") == 0)
				return -999;
			return 1;
		}
		return -1;
	}
	
	  /** CHECK PASSWORD **/
    
	public function exist_password($pass = "", $id = "")
	{
		$result = $this->db->count_records('users', array('user_id' => $id, 'password' => md5($pass)));
		return (bool) $result;
	}

	/** GET USER DETAILS **/
	
	public function get_users_details()
	{
		$result = $this->db->from("users")
				   ->where(array("user_id" => $this->UserID))
				   ->get();
		return $result;
	}

	/** GET USERS LIST **/

	public function get_user_data_list()
	{
		$result = $this->db->from("users")
				   ->join("city","city.city_id","users.city_id")
				   ->join("country","country.country_id","city.country_id")
				   ->where(array("user_id" => $this->UserID))
				   ->get();
		return $result;
	}

	/** UPDATE USERS **/

	public function update_user($post = array(),$cat_pref="")
	{
		$category_preference = "";
	        if($cat_pref != ""){
                        foreach($cat_pref as $cat_preference)
                        {
                               $category_preference .= $cat_preference.',';
                        }
                        $category_preferences = rtrim($category_preference, ',');
                }else {
	                $category_preferences = 0;
		
                }		
		$result = $this->db->update("users", array("firstname" => $post->firstname,"lastname" => $post->lastname, "email" => $post->email,'address1' => $post->address1, 'address2' => $post->address2,'phone_number' => $post->mobile,'my_favouites'=>$category_preference), array("user_id" =>$this->UserID));
		return 1;
	}

	 /** GET USERS CATEGORY LIST **/

	public function get_users_category_list()
	{
		$result = $this->db->select("my_favouites")->from("users")
		->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result; 
	}

	/** GET USERS CITY LIST **/

	public function get_users_city_list($user_id = "")
	{
		$result = $this->db->select("newsletter_city")->from("users")->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result;
	}

   	/** GET DEALS CATEGORY LIST **/

	public function get_gategory_list()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1))->orderby("category_name","ASC")->get();
		return $result;
	}
	
	/** ALL COUNTRY LIST **/

	public function allCountryList()
	{
		$result = $this->db->from("country")->where(array("country_status" => 1)) ->orderby("country.country_name", "ASC")->get();
		return $result;
	}

	/** UPDATE EMAIL **/

	public function update_email($post,$userid)
	{
		$result = $this->db->update("users", array("email" => $post->email), array("user_id" => $userid));
		return 1;
	}

    /** UPDATE REFERRAL BALANCE **/

	public function get_users_details_amount($refamount)
	{
		$result = $this->db->update("users", array("user_referral_balance" => $refamount), array("user_id" => $this->UserID));
		return 1;
	}
	
	/** UPDATE PASSWORD **/

	public function update_Password($post)
	{
		$result = $this->db->update("users", array("password" => md5($post->password)), array("user_id" => $this->UserID));
		return 1;
	}

	/** GET USER DETAILS **/

	public function user_details()
	{
		$result = $this->db->from("users")
				->join("city","city.city_id","users.city_id")
				->where(array("user_id" => $this->UserID))
				->get();
		return $result;
	}
	
	/** CHECK EMAIL EXIST **/

	public function exist_email($email = "")
	{
		$result = $this->db->count_records('users', array('email' => $email));
		return (bool) $result;
	}

	/** CHEXK OLD PASSWORD **/

	public function oldpassword($pass = "")
	{
		$result = $this->db->from('users')->where(array("user_id" => $this->UserID, 'password'=> md5($pass)))->get();
		return count($result);

	}
	/* GET DEALS  BOUGHT  COUNT*/
	public function get_user_bought($uid = "")
	{
		$result = $this->db->delete('deals', array('deal_key' => $uid));
		return count($result);
	}

	/** CITY SETTINGS UPDATED**/

	public function update_city_settings($citysubs = array())
	{
		$city_subscribe = "";

		foreach($citysubs as $cc){
			 $city_subscribe .= $cc.',';
		}
		$city_subscribe = rtrim($city_subscribe, ',');
		if($city_subscribe){
			$result = $this->db->update("users", array("newsletter_city" => $city_subscribe), array("user_id" => $this->UserID));
		}
		return 1; 
	}

	/** CATEGORY SETTINGS UPDATED**/

	public function update_category_preference($cat_pref = "")
	{
	        $category_preference = "";
	        if($cat_pref != ""){
                        foreach($cat_pref as $cat_preference)
                        {
                               $category_preference .= $cat_preference.',';
                        }
                        $category_preferences = rtrim($category_preference, ',');
                }else {
	                $category_preferences = 0;
                }
		$result = $this->db->update("users", array("newsletter_category" => $category_preferences), array("user_id" => $this->UserID));
		return 1;
	}

	/** FORGOT PASSWORD **/

	public function forgot_password($email = "")
	{
		$email = trim($email);
		$result = $this->db->from("users")->where(array("email" => $email))->limit(1)->get();
		if(count($result) > 0){
		        $result_new = $this->db->from("users")->where(array("email" => $email,"user_status"=>1))->limit(1)->get();
		        if(count($result_new) == 0){
		                return -2;
		        }
			$password = text::random($type = 'alnum', $length = 10);
			$userid = $result->current()->user_id;
			$name = $result->current()->firstname;
			$email = $result->current()->email;
			
			$results['name']=$result->current()->firstname;
			$results['email']=$result->current()->email;
			$results['password']=$password;
			$result1=$this->db->update("users",array("password" => md5($password) ), array("user_id" => $userid));
			if($result1){
					return $results;	
				}
		}
		else{
			return 0;
		}
	}

	/* GET DEALS BOUGHT DATA */
	
	public function get_deals_bought()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 7))->get();
		return $result;
	}

 	/* GET COPY RIGHT  DATA */
	public function get_copy_right()
	{
		$result = $this->db->from("cms")->where(array("cms_id" => 8))->get();
		return $result;
	}
	
	public function get_user_bought_product($uid = "")
	{
		$result = $this->db->delete('product', array('deal_key' => $uid));
		return count($result);
	}
	
       /** GET COUNTRY LIST **/
	public function getcountrylist()
        {
		$result = $this->db->from("country")
                        ->orderby("country.country_name", "ASC")
		        ->where(array("country_status" => '1'))->get();
		return $result;
	}
	
        /** GET CITY LIST **/
	public function getCityList()
        {
        $result = $this->db->from("city")
                            ->join("country","country.country_id","city.country_id")
                            ->orderby("city.city_id", "ASC")
                            ->where(array("city_status" => '1'))
                            ->get();
        return $result;
        }
	
	/** GET CITY LIST BY COUNTRY **/
	public function get_city_by_country($country){
		$result = $this->db->from("city")->where(array("country_id" => $country, "city_status" => '1'))->orderby("city_name")
		->get();
		return $result;
	}
	
	/**GET DELAS COUPONS LIST COUNT**/

	public function get_deals_coupons_list_count()
	{
		$result = $this->db->from("transaction")
                ->where(array("transaction.user_id" => $this->UserID,"transaction_mapping.user_id" => $this->UserID))
                ->join("deals","deals.deal_id","transaction.deal_id")
                ->join("transaction_mapping","transaction_mapping.transaction_id","transaction.id")
                ->join("stores","stores.store_id","deals.shop_id")
                ->orderby("transaction.transaction_date","DESC")
                ->get();
		return count($result);
	}

	/**GET DELAS COUPONS LIST**/

	public function get_deals_coupons_list($offset = "", $record = "")
	{
		$result = $this->db->select("*","transaction.type as trans_type")->from("transaction")
                    ->where(array("transaction.user_id" => $this->UserID,"transaction_mapping.user_id" => $this->UserID))
                    ->join("deals","deals.deal_id","transaction.deal_id")
                    ->join("transaction_mapping","transaction_mapping.transaction_id","transaction.id")
                    ->join("stores","stores.store_id","deals.shop_id")
                    ->limit($record, $offset)
                    ->orderby("transaction.transaction_date","DESC")
                    ->get();
		return $result;	
	}

		/**GET PRODUCTS COUPONS LIST COUNT**/

	public function get_products_coupons_list_count()
	{

		$result = $this->db->select('*','shipping_info.adderss1 as saddr1','shipping_info.address2 as saddr2','users.phone_number','transaction.id as trans_id','stores.address1 as addr1','stores.address2 as addr2','stores.phone_number as str_phone','transaction.shipping_amount as shipping')->from("shipping_info")
                    ->where(array("shipping_type"=>1,"shipping_info.user_id" => $this->UserID))
                    ->join("users","users.user_id","shipping_info.user_id") 					
                    ->join("transaction","transaction.id","shipping_info.transaction_id")  
		    ->join("product","product.deal_id","transaction.product_id") 
		    ->join("stores","stores.store_id","product.shop_id") 
		    ->join("city","city.city_id","shipping_info.city")    
		      
                    ->orderby("shipping_id","DESC")

                    ->get(); 
		return count($result);	
                
	}
	/**GET PRODUCTS COUPONS LIST**/

	public function get_products_coupons_list($offset = "", $record = "")
	{

		$result = $this->db->select('*','shipping_info.adderss1 as saddr1','shipping_info.address2 as saddr2','users.phone_number','transaction.id as trans_id','stores.address1 as addr1','stores.address2 as addr2','stores.phone_number as str_phone','transaction.shipping_amount as shipping','stores.city_id as str_city_id')->from("shipping_info")
                    ->where(array("shipping_type"=>1,"shipping_info.user_id" => $this->UserID))
                    ->join("users","users.user_id","shipping_info.user_id") 					
                    ->join("transaction","transaction.id","shipping_info.transaction_id")  
					->join("product","product.deal_id","transaction.product_id") 
					->join("stores","stores.store_id","product.shop_id") 
					->join("city","city.city_id","shipping_info.city") 
		       ->limit($record, $offset)               
                    ->orderby("shipping_id","DESC")

                    ->get(); 
		return $result;	
	}

	/**GET PRODUCTS COUPONS LIST**/

	public function get_auctions_coupons_list()
	{
		$result = $this->db->select('*','shipping_info.adderss1 as de_add1','shipping_info.address2 as de_add2')->from("shipping_info")
                    ->where(array("shipping_type"=>2,"shipping_info.user_id" => $this->UserID))
                    ->join("users","users.user_id","shipping_info.user_id") 					
                    ->join("transaction","transaction.id","shipping_info.transaction_id")  
					->join("auction","auction.deal_id","transaction.auction_id") 
					 ->join("stores","stores.store_id","auction.shop_id")                
                    ->orderby("shipping_id","DESC")

                    ->get(); 
		return $result;	
                
	}
	
	/** GET USER REFERAL LIST**/

	public function user_refrel_list_count()
	{
		$result = $this->db->from("users")
                        ->where(array("user_status"=>1,"referred_user_id" => $this->UserID))
                        ->get();
		return count($result);
			
	}
	/* GET USER BOUGHT AUCTION */
	public function get_user_bought_boughtau($uid = "")
	{
		$result = $this->db->delete('auction', array('deal_key' => $uid));
		return count($result);
	}
	/** GET USER REFERAL LIST**/

	public function user_refrel_list($offset = "", $record = "")
	{
		$result = $this->db->from("users")
                        ->where(array("referred_user_id" => $this->UserID))
			->limit($record, $offset)
                        ->get();

		return $result;
	}
	
	/** GET USER WINNER LIST**/

	public function user_winner_list_count()
	{
		$result = $this->db->from("bidding")->select("bidding.bid_id")->join("auction","auction.deal_id","bidding.auction_id")->where(array("auction.deal_status" => 1,"bidding.user_id" => $this->UserID))->orderby("bidding_time","DESC")->get();
		return count($result);
	}

	/** GET USER WINNER LIST**/

	public function user_winner_list($offset = "", $record = "")
	{
		$result = $this->db->from("bidding")->select("auction.deal_title","auction.deal_value","auction.url_title","auction.deal_key","bidding.bid_amount","bidding.shipping_amount","bidding.bidding_time")->join("auction","auction.deal_id","bidding.auction_id")->where(array("auction.deal_status" => 1,"bidding.user_id" => $this->UserID))->orderby("bidding_time","DESC")->limit($record,$offset)->get();
		return $result;
	}
	/** GET DEALS CATEGORY LIST **/

	public function get_category_list()
	{
		$result = $this->db->from("category")
		->where(array("category_status" => 1,"main_category_id" =>0))->orderby("category_name","ASC")->get();
		return $result; 
	}
	/** GET DEALS CATEGORY LIST **/

	public function get_city_list()
	{
		$result = $this->db->from("city")
		->join("country","country.country_id","city.country_id")
		->where(array("city_status" => 1,"country_status" => 1))
		->orderby("city.city_name", "ASC")
		->get();

		return $result;
	}

	/** CATEGORY AND SETTINGS UPDATED**/

	public function update_preference($city_subscribe="",$cat_subscribe = "")
	{	
		
		if(CITY_SETTING) {
		$city_value = "";
	        if(count($city_subscribe)!= "" && count($city_subscribe)!= 0 ){
                        foreach($city_subscribe as $city_preference)
                        {
                               $city_value .= $city_preference.',';
                        } 
                        $city_value1 = rtrim($city_value, ',');
                } else {
	                $city_value1 = 0;
                }           
	        $category_value = "";
	        if($cat_subscribe != ""){
                        foreach($cat_subscribe as $preference)
                        {
                               $category_value .= $preference.',';
                        }
                        $category_value1 = rtrim($category_value, ',');
                }else {
	                $category_value1 = 0;
                }  
                $result = $this->db->update("email_subscribe", array("city_id" => $city_value1,"category_id" => $category_value1), array("user_id" => $this->UserID));

		return count($result);
		} else {
			
	        $category_value = "";
	        if($cat_subscribe != ""){
                        foreach($cat_subscribe as $preference)
                        {
                               $category_value .= $preference.',';
                        }
                        $category_value1 = rtrim($category_value, ',');
                }else {
	                $category_value1 = 0;
                }  
                $result = $this->db->update("email_subscribe", array("category_id" => $category_value1), array("user_id" => $this->UserID));

		return count($result);
		}
	}

	 /** GET USERS CITY LIST **/

	public function get_users_select_list()
	{
		$result = $this->db->select("city_id,email_id,user_id,suscribe_city_status")->from("email_subscribe")
		               ->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result;
	}
	
	 /** GET USERS SELECT CATEGORY LIST **/

	public function get_users_select_list1()
	{
		$result = $this->db->select("category_id")->from("email_subscribe")
		               ->where(array("user_id" => $this->UserID))->limit(1)->get();
		return $result; 
	}

	/** GET CITY DATA **/

	public function get_city_data($city_id = ""){
		$result = $this->db->from("city")->where(array("city_id" => $city_id))->get();
		return $result;	
	}

	/** BLOCK UNBLOCK SUBSCRIBE **/
	
	public function blockunblocksubscriber($type = "",$user_id = "" )
	{  
		$status=0;
        	if($type == 1){
          	$status=1;
        }
        	$result = $this->db->update("email_subscribe", array("suscribe_city_status" => $status), array("user_id" => $user_id));
        	return count($result);
	}

	/** UPDATE  FACEBOOK WALL **/

	public function update_facebook_wal($facebook ="")
	{
		    $result = $this->db->update("users", array("facebook_update" =>$facebook), array("user_id" =>$this->UserID));
			return 1;
	}

	/**GET DELAS COUPONS LIST PDF GENERATE**/

	public function get_deals_coupons($deal_coupon_code="")
	{
	         $result = $this->db->from("transaction_mapping")
                            ->where(array("transaction_mapping.user_id" => $this->UserID,"transaction.user_id" => $this->UserID,"transaction_mapping.coupon_code"=>$deal_coupon_code))
                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
                            ->join("transaction","transaction.deal_id","deals.deal_id")
                            ->join("stores","stores.store_id","deals.shop_id")
                             ->join("city","city.city_id","stores.city_id")
                            ->join("country","country.country_id","stores.country_id")
                            ->get();                 
		
                return $result;

	}
	
	/**GET DELAS COUPONS LIST PDF GENERATE**/

	public function get_deals_coupons_mail($deal_coupon_code="")
	{
	         $result = $this->db->from("transaction_mapping")
                            ->where(array("transaction_mapping.coupon_code"=>$deal_coupon_code))
                            ->join("deals","deals.deal_id","transaction_mapping.deal_id")
                            ->join("transaction","transaction.deal_id","deals.deal_id")
                            ->join("stores","stores.store_id","deals.shop_id")
                            ->join("city","city.city_id","stores.city_id")
                            ->join("country","country.country_id","stores.country_id")
                            ->get();                 
		
                return $result;
	}
	
	/** CITY SUBSCRIBE **/
	
	public function subscribe_city($post="")
	{
	        $result_city = $this->db->select("category_id")->from("email_subscribe")->where(array("email_id" =>$post->subscribe_email))->get();             
		if(count($result_city) > 0){
			$city = array_unique(explode(',',$result_city[0]->category_id)); //convert the cites to array and remove duplicate values
		        $city_subscribe = $result_city->current()->category_id;
		        $city_subscribe .=",".$post->city_id;
			if (in_array($post->city_id,$city,TRUE)){ // check the city is subscribed 
                        return -3;
			} else {
			$result = $this->db->update("email_subscribe", array("category_id" =>$city_subscribe), array("email_id" => $post->subscribe_email));
			return 1;   
		      }
                }
 	        else{
	                 $result = $this->db->insert("email_subscribe", array("category_id" => $post->city_id,"email_id" => $post->subscribe_email));
					//$admin_email = $this->db->select('email')->from('users')->where(array('user_type' => 1))->limit(1)->get();
	                return 1;
  		}
     }
        
        /** CATEGORY SUBSCRIBE **/
        
        public function subscribe_category($post="")
	    {
	
	        $result_category = $this->db->select("category_id")->from("email_subscribe")->where(array("email_id" => $post->subscribe_email))->get();
		    if(count($result_category) > 0){
		        $category_subscribe = $result_category->current()->category_id;
		        $category_subscribe .=",".$post->category_id;
                        $result = $this->db->update("email_subscribe", array("category_id" =>$category_subscribe), array("email_id" => $post->subscribe_email));
                        
		                return 1;
            } else {
	                 $result = $this->db->insert("email_subscribe", array("category_id" => $post->category_id,"email_id" => $post->subscribe_email));
	                return 1;
  		    }
  		
        }


	/* UPDATE PHONE */
	public function update_phone($phone="")
	{ 		
		$result = $this->db->update("users", array("phone_number" => $phone), array("user_id" =>$this->UserID));
		return $result;
	}
	/* UPDATE USERS ADDRESS */
	public function update_address($address1 = "",$address2 =" ")
	{ 		
		$result = $this->db->update("users", array("address1" => $address1,"address2" =>$address2), array("user_id" =>$this->UserID));
		return $result;
	}
	/* UPDATE CITY */
	public function update_city($city = "")
	{ 		
		$result = $this->db->update("users", array("city_id" => $city), array("user_id" =>$this->UserID));
		return $result;
	}
	/*UPDATE COUNTRY */
	public function update_country($country = "")
	{ 
		$result = $this->db->update("users", array("country_id" => $country), array("user_id" =>$this->UserID));
		return $result;
	}
		/** GET EDIT followup **/
	
	public function get_edit_name($user_id = "")
	{
		$result = $this->db->from('users')->where(array("user_id" => $user_id))->get();												
		return $result;	
	}
		
			/** UPDATE PROFILE **/
	public function update_user_info($user_id  = "",$first_name="",$last_name="")
	{ 		
		$result = $this->db->update("users", array("firstname" => $first_name,"lastname" =>$last_name), array("user_id" =>$user_id));
		return $result;
	}
			/** GET EDIT followup **/
	public function update_user_password($old_pass = "",$new_pass = "")
	{ 	
			
		$result = $this->db->from('users')->select('password')->where(array("user_id" =>$this->UserID,"password"=>md5($old_pass)))->get();
		if(count($result) == 1){ 
			$result1 = $this->db->update("users", array("password" =>md5($new_pass)), array("user_id" =>$this->UserID)); 
			return count($result1);
		}
		else{  echo "-1";   }
	}
	/* GET SHIPPING PRODUCT COLOR */
	public function get_shipping_product_color()
	{
		$result = $this->db->from("color_code")->get();
		return $result;
	}
	
	/* GET PRODUCT SHIPPING PRODUCT SIZE */
	public function get_shipping_product_size()
	{
		$result = $this->db->from("size")->get();
		return $result;
	}
	
	/** UPDATE USER SHIPPING INFO **/

	public function update_shipping_address($post = array())
	{ 
			
		$result = $this->db->update("users", array("ship_name" => $post->firstname,"ship_address1" => $post->address1, "ship_address2" => $post->address2,"ship_mobileno" => $post->mobile,"ship_city"=>$post->city,"ship_country" => $post->country,"ship_state" => $post->state,"ship_zipcode" =>$post->zip_code), array("user_id" =>$this->UserID));
		return 1;
	}
	
	
	
}
