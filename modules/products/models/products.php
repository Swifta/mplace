<?php defined('SYSPATH') or die('No direct script access.');
class Products_Model extends Model
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
		
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition = 'and product.for_store_cred = '.$_SESSION['Club'].' ':$this->club_condition = '';
		(strcmp($_SESSION['Club'], '0') == 0)?$this->club_condition_arr = true:$this->club_condition_arr = false;
		
	}

	/* GET BANNER LIST */
	public function get_banner_list()
	{
		$result = $this->db->from("banner_image")->where(array("status" => 1, "product" => 1))->get();
		return $result;
	}

	/** PRODUCTS COUNT **/

	public function get_products_count($search = "",$category = "",$cur_category="",$cur_size="",$maincatid="")
	{
		
		
		
        $conditions = "";
			$join ="join category on category.category_id=product.category_id";
		if($cur_category){
			$conditions = "and category.category_id IN ($cur_category)";
				}
				
				
		if($cur_size){
			$conditions = "and product_size.size_id IN ($cur_size) and product_size.quantity!=0";
				}
				
				
		if($category){
			 $conditions = " and category.category_url='$category'";
		}
		if($search=='sub'){
			$conditions = " and category.category_url='$category'";
			$join ="join category on category.category_id=product.sub_category_id";
		}
		if($search=='sec'){
			$conditions = " and category.category_url='$category'";
			$join =" join category on category.category_id=product.sec_category_id";
		}
		if($search=='third'){
			$conditions = " and category.category_url='$category'";
			$join =" join category on category.category_id=product.third_category_id";
		}
		if($maincatid!= 0) {

			$conditions .= " and category.category_id=$maincatid ";
		}
		
		
			
		
		
		
			
			
		if($search != 'main' && $search != 'sub' && $search != 'sec' && $search != 'third' && $search != ""){
			 //$conditions .= " and (deal_title like '%".mysqli_real_escape_string($search)."%'";
			 //$conditions .= " or deal_description like '%".mysqli_real_escape_string($search)."%')";
			 
			$conditions .= " and (deal_title like '%".$search."%'";
			$conditions .= " or deal_description like '%".$search."%')";
		}
		
		
			

	
		
		
		
		if(CITY_SETTING){
			
		$query = "select product.deal_id from product  join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id $join where purchase_count < user_limit_quantity ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by product.deal_id order by product.deal_id DESC";
		
		
		
		
		$result = $this->db->query($query);

		} else {
			$query = "select product.deal_id from product  join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id ".$join." where purchase_count < user_limit_quantity ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 ".$conditions." group by product.deal_id order by product.deal_id DESC";
			
			
			
			
			$result = $this->db->query($query);
			
			
			

		}
		
	
		
		
		return count($result);
	}

	/** GET PRODUCTS LIST **/

	public function  get_products_list($search = "", $category = "", $offset = "", $record = "",$cur_category="",$cur_size="",$maincatid="",$size="",$color="",$discount="",$price="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="",$price_text = "")
	{
	        $conditions = "";
			
			

		$join ="join category on category.category_id=product.category_id";
		if($cur_category){
			$conditions = "and category.category_id IN ($cur_category)";
				}
		if($cur_size){
			$conditions = "and product_size.size_id IN ($cur_size) and product_size.quantity!=0";
				}
		if($category){
			 $conditions = " and category.category_url='$category'";
		}
		if($search=='sub'){
			$conditions = " and category.category_url='$category'";
			$join =" join category on category.category_id=product.sub_category_id";
		}
		if($search=='sec'){
			$conditions = " and category.category_url='$category'";
			$join =" join category on category.category_id=product.sec_category_id";
		}
		if($search=='third'){
			$conditions = " and category.category_url='$category'";
			$join =" join category on category.category_id=product.third_category_id";
		}

		if($maincatid!= 0) {

			$conditions .= " and category.category_id=$maincatid ";
		}
		
		
		  

		if($search!='main' && $search!='sub' && $search!='sec' && $search!='third' && $search!=""){

			// $conditions .= " and (deal_title like '%".mysql_real_escape_string($search)."%'";
			// $conditions .= " or deal_description like '%".mysql_real_escape_string($search)."%')";
			 
			  $conditions .= " and (deal_title like '%".$search."%'";
			 $conditions .= " or deal_description like '%".$search."%')";
		}
		
		

		// filter start
		if($main_cat){  // for main category
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){ // for sub category
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=product.sub_category_id";
		}
		if($sec_cat){ // for 2nd level category
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=product.sec_category_id";
		}
		if($third_cat){ // for 3rd level category
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=product.third_category_id";
		}


		if($size){
			$size = rtrim($size, ",");
			$conditions .= " and product_size.size_id in($size)";
		}

		if($color){
			$color = rtrim($color, ",");
			$join = $join." join color on color.deal_id=product.deal_id";
			$conditions .= " and color.color_code_id in($color)";
		}

		if($discount){
			$discount = rtrim($discount, ",");
			$discount1 = explode(',',$discount);
			$arr = array("1" => "<10", "2" => "10 and 20", "3" => "20 and 30", "4" => "30 and 50", "5" => "50 and 75", "6" => ">75");

			if(count($discount1) == 1){

				$val = $discount1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_percentage $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (product.deal_percentage between $arr[$val]";
						}else{
							$conditions .="and (product.deal_percentage $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val])";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val]";
						}
					}
				}
			}
		}
		
		

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($price1); $i++){
					$val = $price1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (product.deal_value between $arr[$val]";
						}else{
							$conditions .="and (product.deal_value $arr[$val]";
						}
					}else if($i == count($price1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val])";
						}else{
							$conditions .=" or product.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val]";
						}else{
							$conditions .=" or product.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if($price_text){
			$price_text = str_replace(array(CURRENCY_SYMBOL," "),"",$price_text);
			$price_array = explode("-", $price_text);
			$conditions .=" and product.deal_value between $price_array[0] and $price_array[1]";
		}
		
		
		 

		// filter end

		if(CITY_SETTING){
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by product.deal_id order by product.deal_id DESC limit $offset,$record";
		$result = $this->db->query($query);



		} else {

			$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1  $conditions  group by product.deal_id order by product.deal_id DESC limit $offset,$record";
			$result = $this->db->query($query);
			
			


		} // print_r($result);
		 return $result;
	}



	/*public function get_ajax_products_count($size="",$color="",$discount="",$price ="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="")
	{
		$join =" join category on category.category_id=product.category_id";

		$conditions = "";

		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=product.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=product.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=product.third_category_id";
		}


		if($size){
			$size = rtrim($size, ",");
			$conditions .= " and product_size.size_id in($size)";
		}

		if($color){
			$color = rtrim($color, ",");
			$join = $join." join color on color.deal_id=product.deal_id";
			$conditions .= " and color.color_code_id in($color)";
		}

		if($discount){
			$discount = rtrim($discount, ",");
			$discount1 = explode(',',$discount);
			$arr = array("1" => "<10", "2" => "10 and 20", "3" => "20 and 30", "4" => "30 and 50", "5" => "50 and 75", "6" => ">75");

			if(count($discount1) == 1){

				$val = $discount1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_percentage $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (product.deal_percentage between $arr[$val]";
						}else{
							$conditions .="and (product.deal_percentage $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val])";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val]";
						}
					}
				}
			}
		}

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .="and (product.deal_value between $arr[$val]";
						}else{
							$conditions .="and (product.deal_value $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val])";
						}else{
							$conditions .=" or product.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val]";
						}else{
							$conditions .=" or product.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if(CITY_SETTING){
		$query = "select product.deal_id from product join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id $join where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by product.deal_id order by product.deal_id DESC";
		$result = $this->db->query($query);

		} else {
			$query = "select product.deal_id from product  join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id $join where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1 $conditions group by product.deal_id order by product.deal_id DESC";
			$result = $this->db->query($query);

		}
		return count($result);
	} */

	/** GET PRODUCTS LIST **/

	public function  get_ajax_products_list($size = "",$color="",$discount="",$price="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="",$price_text = "", $type = "")
	{
		$join =" join category on category.category_id=product.category_id";

		$conditions = "";

		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=product.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=product.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=product.third_category_id";
		}

		if($size){
			$size = rtrim($size, ",");
			$conditions .= " and product_size.size_id in($size)";
		}

		if($color){
			$color = rtrim($color, ",");
			$join = $join." join color on color.deal_id=product.deal_id";
			$conditions .= " and color.color_code_id in($color) ";
		}

		if($discount){
			$discount = rtrim($discount, ",");
			$discount1 = explode(',',$discount);
			$arr = array("1" => "<10", "2" => "10 and 20", "3" => "20 and 30", "4" => "30 and 50", "5" => "50 and 75", "6" => ">75");

			if(count($discount1) == 1){

				$val = $discount1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_percentage $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .=" and (product.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" and (product.deal_percentage $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val])";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val]";
						}
					}
				}
			}
		}

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($price1); $i++){
					$val = $price1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .=" and (product.deal_value between $arr[$val]";
						}else{
							$conditions .=" and (product.deal_value $arr[$val]";
						}
					}else if($i == count($price1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val])";
						}else{
							$conditions .=" or product.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val]";
						}else{
							$conditions .=" or product.deal_value $arr[$val]";
						}
					}
				}
			}
		}

		if($price_text){
			$price_text = str_replace(array(CURRENCY_SYMBOL," "),"",$price_text);
			$price_array = explode("-", $price_text);
			$conditions .=" and product.deal_value between $price_array[0] and $price_array[1]";
		}

		$pagin = "";
		if($type != 1){
			$pagin = " limit 12";
		}

		if(CITY_SETTING){
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity ".$this->club_condition." deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id'  $conditions group by product.deal_id order by product.deal_id DESC$pagin";
		$result = $this->db->query($query);


		} else {

			$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id $join join product_size on product_size.deal_id=product.deal_id where purchase_count < user_limit_quantity and deal_status = 1 and category.category_status = 1 and  store_status = 1  $conditions  group by product.deal_id order by product.deal_id DESC$pagin";
			$result = $this->db->query($query);


		}
		//print_r($result);
		return $result;
	}

	/** VIEW PRODUCTS **/

	public function get_product_details($deal_key = "", $url_title = "",$type = "")
	{
			if($type == "admin-preview" || $type == "merchant-preview"){
				$condition = array("url_title" => $url_title, "deal_key" => $deal_key,"category.category_status" => 1, "store_status" => 1);
			} else {

			         $ip=$_SERVER['REMOTE_ADDR'];

                                /*$addr_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
                                $city = stripslashes(ucfirst($addr_details['geoplugin_city']));
				$country = stripslashes(ucfirst($addr_details['geoplugin_countryName'])); */
				$city = "";
				$country = "";
			        $count_view = $this->db->from("view_count_location")->where(array("product_key" => $deal_key,"ip" =>$ip))->get();
			        if(count($count_view) == 0){
			                $this->db->insert("view_count_location", array("product_key" => $deal_key,"ip" =>$ip,"city" => $city,"country" => $country,"date" => time()));
			                $this->db->query("update product set view_count = view_count + 1 where deal_key = '$deal_key'");
			       }

				$condition = array("url_title" => $url_title, "deal_key" => $deal_key,"deal_status" => 1, "category.category_status" => 1, "store_status" => 1);
				
				if($this->club_condition_arr){
					$condition = array("url_title" => $url_title, "deal_key" => $deal_key,"deal_status" => 1, "category.category_status" => 1, "store_status" => 1, "product.for_store_cred" => 0);
				}
				
				//@Live
			}
	        $result = $this->db->select("*","stores.phone_number as phone","stores.address1 as addr1","stores.address2 as addr2")->from("product")
                                ->where($condition)
                                ->join("stores","stores.store_id","product.shop_id")
                                ->join("city","city.city_id","stores.city_id")
                                ->join("country","country.country_id","stores.country_id")
                                ->join("users","users.user_id","product.merchant_id")
                                ->join("category","category.category_id","product.category_id")
                                ->get();
                return $result;
	}

	/** GET RELATED CATEGORY DEALS LIST  **/

	public function get_related_category_products_list($deal_id = "", $category_id = "")
	{
		$condition = "";
		if(CITY_SETTING){
			$condition = "and stores.city_id = '$this->city_id' ";
		}
		$result = $this->db->query("select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and deal_id <> '$deal_id' $condition  and product.sec_category_id =  '$category_id'   order by deal_id DESC ");
	        return $result;
	}

	/** ADD COMMENTS **/

	public function add_comments($comments = "" , $deal_id = "")
	{
	        $result = $this->db->insert("discussion", array("user_id" =>$this->UserID, "deal_id" => $deal_id, "comments" => $comments, "created_date" => time()));

		return 0;
	}
	/** GET CART PRODUCTS LIST **/

	public function get_cart_products($deal_id = "")
	{
		$result = $this->db->from("product")->where(array("deal_id" => $deal_id))->get();
		return $result;
	}

	/** MOST VIEW PRODUCTS LIST **/

	public function get_products_view()
	{
	         if(CITY_SETTING){ 
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1  and stores.city_id = '$this->city_id' order by product.view_count DESC limit 3";
		
		$result = $this->db->query($query);
	        
		} else {
		
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1  order by product.view_count DESC limit 3";
		$result = $this->db->query($query);
                }
		return $result;
	}

	/** GET RELATED CATEGORY DEALS LIST  **/

	public function  get_hot_products_view()
	{
	         if(CITY_SETTING){ 
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and deal_feature = 1 and stores.city_id = '$this->city_id' ORDER BY RAND() limit 4";
		$result = $this->db->query($query);
		} else {
		$query = "select product.deal_id,product.deal_key,product.deal_title,product.url_title,product.deal_value,product.deal_price, category.category_url,deal_percentage from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and deal_feature = 1 ORDER BY RAND() limit 4";
		$result = $this->db->query($query);
		}
	        return $result;
	}

	/** GET PRODUCT SIZE **/
	public function get_product_one_size($deal_id = "")
	{

	        $result = $this->db->query("select * from product_size  where  deal_id = '$deal_id' order by CAST(size_name as SIGNED INTEGER) ASC ");


		return $result;
	}

	/** GET PRODUCT COLOR **/
	public function get_product_color($deal_id = "")
	{
		$result = $this->db->from("color")
				->where(array("deal_id" => $deal_id))
				->orderby("color.color_code_name","ASC")
		     		->get();
		return $result;
	}

	/** PRODUCT STAR RATING **/

	public function save_product_rating($post="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $post->deal_id, "user_id" => $this->UserID))->get();
		if(count($result)==0)
		{
			$result = $this->db->insert("rating", array("type_id" => $post->deal_id, "user_id" => $this->UserID, "rating" => $post->rate, "module_id" => 2));
		}
		elseif(count($result)>0)
		{
			$result= $this->db->update("rating", array("rating" => $post->rate), array("type_id" => $post->deal_id, "user_id" => $this->UserID, "module_id" => 2));
		}
	}

	/** AUCTION RATING **/

	public function get_product_rating($deal_id="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $deal_id))->get();
		if(count($result)>0)
		{
			$get_rate = count($result);
			$sum= $this->db->query("select sum(rating) as sum from rating where type_id=$deal_id AND module_id = 2");
			$get_sum=$sum->current()->sum;
			$average= $get_sum/$get_rate;
			return $average;
		}
		elseif(count($result)==0)
		{
			return 0;
		}
	}

	public function get_product_rating_sum($deal_id="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $deal_id))->get();
		if(count($result)>0)
		{
			$get_rate = count($result);
			$sum= $this->db->query("select sum(rating) as sum from rating where type_id=$deal_id AND module_id = 2");
			$get_sum=$sum->current()->sum;
			return $get_sum;
		}
		elseif(count($result)==0)
		{
			return 0;
		}
	}

	/** GET PRODUCT COLOR **/

	public function get_color_data($deal_id = "")
	{
		$result = $this->db->from("color")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}


	/** GET PRODUCT DELIVERY DETAILS **/

	public function get_product_delivery($product_id = "")
	{
		$result = $this->db->from("product_policy")
				->where(array("product_id" => $product_id))
		     		->get();
		return $result;
	}

	/** GET PRODUCT SIZE **/

	public function get_size_data($deal_id = "")
	{
		$result = $this->db->from("product_size")
				->where(array("deal_id" => $deal_id))
		     		->get();
		return $result;
	}


	/** GET PRODUCTS LIST **/

	public function  get_products_min_max($size = "",$color="",$discount="",$price="",$main_cat="",$sub_cat="",$sec_cat="",$third_cat="")
	{
		$join =" join category on category.category_id=product.category_id";

		$conditions = "";

		if($main_cat){
			 $conditions .= " and category.category_url='$main_cat'";
		}
		if($sub_cat){
			$conditions .= " and category.category_url='$sub_cat'";
			$join ="join category on category.category_id=product.sub_category_id";
		}
		if($sec_cat){
			$conditions .= " and category.category_url='$sec_cat'";
			$join ="join category on category.category_id=product.sec_category_id";
		}
		if($third_cat){
			$conditions .= " and category.category_url='$third_cat'";
			$join ="join category on category.category_id=product.third_category_id";
		}

		if($size){
			$size = rtrim($size, ",");
			$conditions .= " and product_size.size_id in($size)";
		}

		if($color){
			$color = rtrim($color, ",");
			$join = $join." join color on color.deal_id=product.deal_id";
			$conditions .= " and color.color_code_id in($color) ";
		}

		if($discount){
			$discount = rtrim($discount, ",");
			$discount1 = explode(',',$discount);
			$arr = array("1" => "<10", "2" => "10 and 20", "3" => "20 and 30", "4" => "30 and 50", "5" => "50 and 75", "6" => ">75");

			if(count($discount1) == 1){

				$val = $discount1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_percentage $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .=" and (product.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" and (product.deal_percentage $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val])";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_percentage between $arr[$val]";
						}else{
							$conditions .=" or product.deal_percentage $arr[$val]";
						}
					}
				}
			}
		}

		if($price){
			$price = rtrim($price, ",");
			$price1 = explode(',',$price);
			$arr = array("1" => "<500", "2" => "501 and 1000", "3" => "1001 and 1500", "4" => "1501 and 2000", "5" => "2001 and 2500", "6" => ">2500");

			if(count($price1) == 1){

				$val = $price1[0];
				$a = ($val ==1 || $val ==6)?"":"between";
				$conditions .=" and (product.deal_value $a $arr[$val]) ";
			}else{
				for($i=0; $i<count($discount1); $i++){
					$val = $discount1[$i];
					if($i == 0){
						if($val != 1 && $val != 6){
							$conditions .=" and (product.deal_value between $arr[$val]";
						}else{
							$conditions .=" and (product.deal_value $arr[$val]";
						}
					}else if($i == count($discount1)-1){
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val])";
						}else{
							$conditions .=" or product.deal_value $arr[$val])";
						}
					}else{
						if($val != 1 && $val != 6){
							$conditions .=" or product.deal_value between $arr[$val]";
						}else{
							$conditions .=" or product.deal_value $arr[$val]";
						}
					}
				}
			}
		}


		if(CITY_SETTING){
		$query = "select MAX(deal_value) as max_deal, MIN(deal_value) as min_deal from product join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' $conditions order by deal_id ASC ";
		$result = $this->db->query($query);

		} else {
			$query = "select MAX(deal_value) as max_deal, MIN(deal_value) as min_deal from product join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1  $conditions order by deal_id ASC";
			$result = $this->db->query($query);

		}//print_r($result);
		return $result;
	}

		 /** GET DEALS LIST BY FILTER */

	 public function get_products_lists_byfilter($price_from,$price_to)
	  {
		if(CITY_SETTING){
				$query = "select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and stores.city_id = '$this->city_id' and product.deal_value between $price_from and $price_to   order by deal_id ASC ";
				$result = $this->db->query($query);

				return $result;
		}
		else {
				if($price_from == 0)
				{
					$price_to = 100000;
				}
				$query = "select * from product  join stores on stores.store_id=product.shop_id join category on category.category_id=product.category_id where  deal_status = 1  ".$this->club_condition." and purchase_count < user_limit_quantity  and category.category_status = 1 and  store_status = 1  and product.deal_value between $price_from and $price_to   order by deal_id ASC ";
				$result = $this->db->query($query);
				return $result;
		}
	  }

	/** GET DEALS SUB CATEGORY LIST **/

	public function get_subcategory_list($id="",$type="")
	{
		$conditions = array("category_status" => 1,"main_category_id !="=>0,"main_category_id"=>$id,"type"=> 2);
		if($type == 2){
			$conditions = array("category_status" => 1,"main_category_id !="=>0,"sub_category_id"=>$id,"type"=> 3);
		}
		if($type == 3){
			$conditions = array("category_status" => 1,"main_category_id !="=>0,"sub_category_id"=>$id,"type"=> 4);
		}
		$result = $this->db->from("category")->where($conditions)->orderby("category_name","ASC")->get();
		
		//print_r($category2); exit;
		//exit;
		return $result;
	}

	/** GET CATEGORY NAME  **/

	public function get_categoryname($category = "" )
	{
		$result = $this->db->from('category')->where(array("category_url" => $category))->get();
		return $result;
	}

	/** GET COLOR LIST

	public function get_color_list()
	{
		return $this->db->get('color_code');

	} **/
		/** GET COLOR LIST  **/

	public function get_size_list()
	{


	        $query = "SELECT * FROM size ORDER BY CAST(size_name as SIGNED INTEGER) ASC";
	        $result = $this->db->query($query);
	        //$result = $this->db->from("size")->orderby("size_name","ASC")->get();


		return $result;
	}

	/** GET DEALS LIST BY COLOR FILTER */

	 public function get_products_lists_bycolor($color="")
	  {
		if(CITY_SETTING){
				$query = "select * from product  join stores on stores.store_id=product.shop_id join color on color.deal_id=product.deal_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and color.color_id = $color and stores.city_id = '$this->city_id'  order by product.deal_id ASC ";
				$result = $this->db->query($query);
				return $result;
		}
		else {
				$query = "select * from product  join stores on stores.store_id=product.shop_id join color on color.deal_id=product.deal_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and color.color_id = $color  order by product.deal_id ASC";
				$result = $this->db->query($query);
				return $result;
		}
	  }
	/** GET DEALS LIST BY COLOR FILTER */

	 public function get_products_lists_bycolor_count($color="")
	  {
		if(CITY_SETTING){
				$query = "select * from product  join stores on stores.store_id=product.shop_id join color on color.deal_id=product.deal_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity  ".$this->club_condition." and deal_status = 1 and category.category_status = 1 and  store_status = 1 and color.color_id = $color and stores.city_id = '$this->city_id'  order by product.deal_id ASC ";
				$result = $this->db->query($query);
				return count($result);
		}
		else {
				$query = "select * from product  join stores on stores.store_id=product.shop_id join color on color.deal_id=product.deal_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity  and product.for_store_cred = 1 and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and color.color_id = $color  order by product.deal_id ASC";
				$result = $this->db->query($query);
		 		return count($result);

		}
	  }

	/** GET DEALS LIST BY SIZE FILTER */

	 public function get_products_lists_bysize($size="")
	  {
		if(CITY_SETTING){
				$query = "select * from product  join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and product_size.size_id = $size and stores.city_id = '$this->city_id'  order by product.deal_id ASC ";
				$result = $this->db->query($query);
				return $result;
		}
		else {
				$query = "select * from product  join stores on stores.store_id=product.shop_id join product_size on product_size.deal_id=product.deal_id join category on category.category_id=product.category_id where  purchase_count < user_limit_quantity and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and product_size.size_id = $size  order by product.deal_id ASC";
				$result = $this->db->query($query);
				return $result;
		}
	  }

	/** GET PRODUCT COLOR **/
	public function get_color_list()
	{
		$result = $this->db->select("color.*")->from("color")->join("color_code","color_code.color_code","color.color_name","left")
				->where(array("color_status" =>0,"color_code.color_name!="=>"NULL"))
				->orderby("color.color_code_name","ASC")
				->groupby("color.color_name")
		     		->get();
		return $result;
	}

	/** GET DEALS SUB CATEGORY LIST **/

	public function get_maincate_name()
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"main_category_id !="=>0))->orderby("category_name","ASC")->get();
		return $result;
	}

	/** GET PRODUCTS SUB CATEGORY LIST **/

	public function get_main_category($category="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"category_url"=>$category))->orderby("category_name","ASC")->get();
		return $result;
	}
	/** GET PRODUCTS SUB CATEGORY LIST **/

	public function get_main_categoryname($category_id="")
	{
		$result = $this->db->from("category")->where(array("category_status" => 1,"category_id"=>$category_id))->orderby("category_name","ASC")->get();
		return $result;
	}

	public function GetProductRatingCount($deal_id="")
	{
		$result= $this->db->from("rating")->where(array("type_id" => $deal_id))->get();
		return count($result);
	}

	//To get compared products list
	public function get_productcompare($id="")
	{
		$n_condition = array("p.deal_status" => 1,"p.deal_id"=>$id);
		
		if($this->club_condition_arr){
			$n_condition = array("p.deal_status" => 1,"p.deal_id"=>$id, "p.for_store_cred" => 0);
		}
		$result = $this->db->select("p.deal_id","p.deal_title","p.url_title","p.deal_key", "p.deal_value","p.deal_price","p.deal_percentage","p.purchase_count", "p.user_limit_quantity","ps.size_name", "p.deal_description")
				->from("product as p")
				->join("product_size as ps","ps.deal_id","p.deal_id","left")
				->where($n_condition)//@Live
				->groupby("p.deal_id")
				->get()->as_array(false);

		return $result;
	}

		 public function getProductAttributes($product_id) {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->select("ag.attribute_group_id", "ag.groupname", "ag.sort_order")
						->from("product_attribute as pa")
						->join("attribute as a","pa.attribute_id","a.attribute_id","left")
						->join("attribute_group as ag","a.attribute_group" ,"ag.attribute_group_id","left")
						->where(array("pa.product_id"=>$product_id))
						->groupby("ag.attribute_group_id")
						->orderby("ag.sort_order", "ag.groupname","asc")
						->get()->as_array(false);
		//print_r($product_attribute_group_query); exit;
		 foreach ($product_attribute_group_query as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->select("a.attribute_id", "a.name", "pa.text")
						->from("product_attribute as pa")
						->join("attribute as a","pa.attribute_id","a.attribute_id","left")
						->where(array("pa.product_id"=>$product_id,"a.attribute_group"=>$product_attribute_group['attribute_group_id']))
						->groupby("a.attribute_id")
						->orderby("a.sort_order", "a.name","asc")
						->get()->as_array(false);


			foreach ($product_attribute_query as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name'],
					'text'         => $product_attribute['text']
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

		/** Get Single product color**/
	public function GetProductColor($deal_id = "")
	{
		$result = $this->db->from("color")
				->where(array("deal_id" => $deal_id))
				->orderby("color.color_code_name","ASC")
		     		->get()->as_array(false);
		return $result;
	}

	/** Get Product Size **/
	public function GetProductSize($deal_id = "")
	{

		 $result = $this->db->select("*","size.size_name as name", "size.size_id as id")->from("size")
	                        ->join("product_size","product_size.size_id","size.size_id","left")
				->where(array("deal_id" =>$deal_id))
				->orderby("size.size_name","ASC")
	                        ->get()->as_array(false);
                return $result;
	} 
	
	
	/* public function GetProductSize($deal_id = "")
	{
	        $result = $this->db->query("select * , size.size_name as name , size.size_id as id from size  join product_size on product_size.size_id=size.size_id where  deal_id = '$deal_id' order by CAST(size.size_name as SIGNED INTEGER) ASC ");

		return $result;
	} */

	public function get_productcount($id="")
	{
		$n_condition = array("deal_status" => 1,"deal_id"=>$id);
		
		if($this->club_condition_arr){
			$n_condition = array("deal_status" => 1,"deal_id"=>$id, "product.for_store_cred" => 0);
		}
		$result = $this->db->select("deal_id")->from("product")->where($n_condition)->get(); //@Live
		return $result;

	}
	public function get_userwishlist()
	{
		$result = $this->db->select("wishlist")->from("users")->where(array("user_id" => $this->UserID))->get()->current();
		return $result;
	}
	public function update_wishlist($wishlist="")
	{
		$result = $this->db->update("users", array("wishlist" => serialize($wishlist)),array("user_id" => $this->UserID));
		return 1;
	}

	public function get_user_wish_count()
	{

		$query = "select wishlist from users where user_id = '$this->UserID' and wishlist != ' ' ";
		$result = $this->db->query($query);
		return $result;
	}

	public function get_user_wish_list()
	{
	        $query = "select wishlist from users where user_id = '$this->UserID' and wishlist != ' ' ";
	        $result = $this->db->query($query);
	        return $result->as_array();
	}
	public function get_wishlist_products($id="")
	{
	        /*if(CITY_SETTING){ 
		$query = "select * from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1  and stores.city_id = '$this->city_id' and product.deal_id = '$id' ";
		$result = $this->db->query($query);
		} else {
		$query = "select * from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where deal_status = 1 and category.category_status = 1 and  store_status = 1 and product.deal_id = '$id'";
		$result = $this->db->query($query);
		} */
		$query = "select * from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and product.deal_id = '$id'";
		$result = $this->db->query($query);
	        return $result;
	        
	}

	public function get_category_details($product_id = 0)
	{
		
		if($this->club_condition_arr){
		$result = $this->db->select("category.category_name","category.category_id","category.category_url","product.deal_title")->from("category")->join("product","product.sub_category_id","category.category_id","left")->where(array("product.deal_id" =>$product_id, 'product.for_store_cred'=> $_SESSION['Club']))->get();
		return $result;
		}else{
			$result = $this->db->select("category.category_name","category.category_id","category.category_url","product.deal_title")->from("category")->join("product","product.sub_category_id","category.category_id","left")->where(array("product.deal_id" =>$product_id,))->get();
		}
	}

	public function update_shipping_address($post = array())
	{

		$result = $this->db->update("users", array("ship_name" => $post->firstname,"ship_address1" => $post->address1, "ship_address2" => $post->address2,"ship_mobileno" => $post->mobile,"ship_city"=>$post->city,"ship_country" => $post->country,"ship_state" => $post->state,"ship_zipcode" =>$post->zip_code), array("user_id" =>$this->UserID));

		return 1;
	}
	
	public function  get_hot_all_products_view($deal_id = "")
	{
	        if(CITY_SETTING){
				
				$query = "select * from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and stores.city_id = '$this->city_id' and  store_status = 1 and deal_id <> '$deal_id' and deal_feature = 1 ORDER BY RAND()";
		$result = $this->db->query($query);
		
				return $result;
		}
		else {
		
		$query = "select * from product  join stores on stores.store_id=product.shop_id  join category on category.category_id=product.category_id where purchase_count < user_limit_quantity and deal_status = 1  ".$this->club_condition." and category.category_status = 1 and  store_status = 1 and deal_id <> '$deal_id' and deal_feature = 1 ORDER BY RAND()";
		$result = $this->db->query($query);
	        return $result;
	        }
	}

        public function get_userflat_amount($userid)
	{
		$result = $this->db->select("flat_amount")->from("users")->where(array("user_id" => $userid))->get()->current();
		return $result;
	}


}
