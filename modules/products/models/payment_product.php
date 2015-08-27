<?php defined('SYSPATH') or die('No direct script access.');
class Payment_product_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance(); 
		$this->UserID = $this->session->get("UserID");
		$this->UserName = $this->session->get("UserName");
	}

	/** GET USER LIMIT **/
	
	public function get_user_limit_details($deal_id = "")
	{
		$result = $this->db->count_records("transaction_mapping", array( "deal_id" => $deal_id, "user_id" =>$this->UserID));	            
                return $result;
	}
	
	/** GET USER REFERRAL BALANCE DETAILS **/
	
	public function get_user_referral_balance_details()
	{
		$result = $this->db->select("user_referral_balance")
                                        ->from("users")
                                        ->where(array("user_id" => $this->UserID))
                                        ->get();
		if(count($result)){
			return $result->current()->user_referral_balance;
		}
		return 0;
	}

	/** GET PRODUCT PAYMENT DETAILS  **/
	
	public function get_product_payment_details($deal_id = "")
	{
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where deal_type = 2  and deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_id = '$deal_id' ");
	        return $result;
	}
	/** PRODUCTS BUY FOR FRIEND REFERRAL PAYMENT **/
	
	public function products_referral_payment_deatils($post = "", $referral_amount = "", $quantity = "", $deal_id = "", $purchase_qty = "",$deal_amount = "" )
	{
		 $result = $this->db->insert("transaction", array("user_id" => $this->UserID,"deal_id" =>$deal_id,'firstname' =>$this->UserName, 'acknowledgement' => "Success", 'order_date' => time(), 'amount' => 0, "referral_amount" => $deal_amount , "payment_status" =>  "Success", 'quantity' => $quantity, 'type' => "3","transaction_date" => time()));
		 
		 $trans_ID = $result->insert_id();
		 
		 for($q=1; $q <= $quantity; $q++){
			$this->db->insert("transaction_mapping", array("deal_id" => $deal_id , "user_id" => $this->UserID, "transaction_id" => $trans_ID , "coupon_code_status" => 1, "transaction_date"=>time()));
		 }
		 
		 $this->db->insert("shipping_info", array("transaction_id" => $trans_ID , "user_id" => $this->UserID, "adderss1" => $post->adderss1 , "address2" => $post->address2, "city" => $post->city ,"state" => $post->state ,"country" => $post->country, "shipping_date" => time()));
		 
                 $purchase_count_total = $purchase_qty + $quantity;
	         $result_deal = $this->db->update("deals", array("purchase_count" => $purchase_count_total), array("deal_id" => $deal_id)); 
                 $this->db->query("update users set deal_bought_count = deal_bought_count + $quantity where user_id = $this->UserID");
                 
		 return $result_deal; exit;
	}
	
	/** REFERRAL AMOUNT UPDATE **/
	
	public function products_referral_amount_payment_deatils($referral_amount="")
	{
	        if($referral_amount){
		$this->db->query("update users set user_referral_balance = user_referral_balance - $referral_amount  where user_id = $this->UserID");
		} 
	}
	
	/** GET USERS FULL DETAILS **/
	
	public function get_user_details()
	{
		$result = $this->db->from("users")->where(array("user_id" => $this->UserID))->get();
		return $result;
	}
	
	public function get_user_data_list()
	{
		$result = $this->db->from("users")
				   ->join("city","city.city_id","users.ship_city")
				   ->join("country","country.country_id","users.ship_country")
				   ->where(array("user_id" => $this->UserID))
				   ->get();
		return $result;
	}

	/** UPDATE AMOUNT TO REFERED USER **/

	public function update_referral_amount($ref_user_id = "")
	{
		$referral_amount = REFERRAL_AMOUNT;
		$this->db->query("update users set user_referral_balance = user_referral_balance+$referral_amount where user_id = $ref_user_id");
		return;
	}

	public function get_cart_products($deal_id = "")
	{                   
		$result = $this->db->from("product")->where(array("deal_id" => $deal_id))->get();
		return $result;
	}
	
	public function get_city_by_country_pay($country=""){
	        $conditions = (is_numeric($country))?array("country_id" => $country, "country_status" => '1'):array("country_name" => $country, "country_status" => '1');
	        $result_country = $this->db->from("country")->where($conditions)->get();
		$country_id = $result_country->current()->country_id;
		$result = $this->db->from("city")->where(array("country_id" => $country_id, "city_status" => '1'))
                                        ->orderby("city_name")
                                        ->get();
		return $result;
	}
	
	public  function getcountrydata($countryurl)
	{
		$result = $this->db->select('country_code')->from("country")
			->where(array( "country_url" => $countryurl ))
			->limit(1)
			->get();
		return $result;
	}
}
