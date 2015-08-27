<?php defined('SYSPATH') OR die('No direct access allowed.');
class Products_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css'));
		} else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		} else {
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
		$this->products = new Products_Model();
		$this->is_product = 1;
		if(!$this->product_setting){
		        url::redirect(PATH);
		}
	}

	/** PRODUCT PAGE **/

	public function all_products($page = "")
	{
		
		$this->session->set('cate','');
		$this->category_name="";
		$this->category_id = "";
		$this->color1="";
		$category_id="";
		$cur_category="";
		$this->color_id="";
			if(!$this->session->get('categoryID')){
			        $this->session->set('categoryID',"");
			}
			if(count($this->session->get('categoryID'))=="1"){
				$this->session->delete('categoryID');
			}
			if($_GET){
			$this->category = $this->input->get('c');
				if($this->category){
					$category_id = implode(',',$this->category);
						if(count($category_id)==""){
							$this->session->delete('categoryID');
						}
						if($this->session->get('categoryID')){
							$this->session->set('categoryID',$category_id);
						}
					$category_new = $category_id.",".$this->session->get('categoryID');
					$this->session->set('categoryID',$category_new);
					$cur_category = $this->session->get('categoryID');
				}
			}
		        $size_id="";
		        $cur_size="";
			if(!$this->session->get('size')){
			$this->session->set('size',"");
			}
			if(count($this->session->get('size'))=="1"){
						$this->session->delete('size');
			}
			if($_GET){
			$this->size = $this->input->get('size1');
				if($this->size){
					$size_id = implode(',',$this->size);
						if(count($size_id)==""){
							$this->session->delete('size');
						}
						if($this->session->get('size')){
							$this->session->set('size',$size_id);
						}
					$size_new = $size_id.",".$this->session->get('size');
					$this->session->set('size',$size_new);
					$cur_size = $this->session->get('size');
				}
			}
	        $this->all_products_count = $this->products->get_products_count(substr($cur_category, 0, -1),substr($cur_size, 0, -1));
	        $this->pagination = new Pagination(array(
			        'base_url'       => 'products/page/'.$page."/",
			        'uri_segment'    => 3,
			        'total_items'    => $this->all_products_count,
			        'items_per_page' => 12,
			        'style'          => 'digg',
			        'auto_hide' => TRUE
	        ));
		$this->all_products_list = $this->products->get_products_list("","", $this->pagination->sql_offset, $this->pagination->items_per_page,substr($cur_category, 0, -1),substr($cur_size, 0, -1));
		$this->view_products_list = $this->products->get_products_view();
		$this->view_hot_products_list = $this->products->get_hot_products_view();
		$this->products_list = $this->products->get_products_min_max();
		foreach ($this->products_list as $pro ){
		        $this->pro_max=$pro->max_deal;
		        $this->pro_min=$pro->min_deal;
		}
		$this->template->title = $this->Lang["PRODUCTS"]." | ".SITENAME;
		$this->title_display = $this->Lang["PRODUCTS"];
		$this->color_list = $this->products->get_color_list();
		$this->size_list = $this->products->get_size_list();
		$this->template->content = new View("themes/".THEME_NAME."/products/products");
		//$this->categeory_list = $this->products->get_subcategory_list();
		//$this->banner_details = $this->products->get_banner_list();
		if($id = $this->input->get('cate_id')){
			$type = ($this->input->get('t'));
			$id = ($this->input->get('cate_id'));

			if($type== 1){ // for main category to sub category list
				$this->view_type = 1;
				$this->categeory_list = $this->products->get_subcategory_list($id);
				echo  new View("themes/".THEME_NAME."/products/sub_categorey_list");
			}
			else if($type== 2){  // for sub category to 2nd level category list
				$this->view_type = 2;
				$this->categeory_list = $this->products->get_subcategory_list($id,2);
				echo  new View("themes/".THEME_NAME."/products/sub_categorey_list");
			}
			else if($type== 3){ // for 2nd category to 3rd level category list
				$this->view_type = 3;
				$this->categeory_list = $this->products->get_subcategory_list($id,3);
				echo  new View("themes/".THEME_NAME."/products/sub_categorey_list");
			}
		        exit;
		}
	}

	/** PRODUCT VIEWMORE **/

	public function all_products_1($page = "")
	{

		$deal_record = $this->input->get('record');
		$deal_offset = $this->input->get('offset');
		$size = $this->input->get("size");
		$color = $this->input->get("color");
		$discount = $this->input->get("discount");
		$price = $this->input->get("price");
		$main_cat = $this->input->get("main");
		$sub_cat = $this->input->get("sub");
		$sec_cat = $this->input->get("sec");
		$third_cat = $this->input->get("third");
		$price_text = $this->input->get("price1");

		//$this->all_products_count = $this->products->get_products_count($size,$color,$discount,$price,$main_cat,$sub_cat,$sec_cat,$third_cat);
		$this->record = $this->input->get('record');
		$this->all_products_list = $this->products->get_products_list("","",$deal_offset, $deal_record,"","","",$size,$color,$discount,$price,$main_cat,$sub_cat,$sec_cat,$third_cat,$price_text);
		$this->view_products_list = $this->products->get_products_view();
		$this->view_hot_products_list = $this->products->get_hot_products_view();
		$this->template->title = $this->Lang["ALL_PRODUCT_LIST"]." | ".SITENAME;
		$this->title_display = $this->Lang["ALL_PRODUCT_LIST"];
		echo new View("themes/".THEME_NAME."/products/products_list");
		exit;
	}

    public function load_page_content($page = "")
	{
		$size = $this->input->get("size");
		$color = $this->input->get("color");
		$discount = $this->input->get("discount");
		$price = $this->input->get("price");
		$main_cat = $this->input->get("main");
		$sub_cat = $this->input->get("sub");
		$sec_cat = $this->input->get("sec");
		$third_cat = $this->input->get("third");
		$price_text = $this->input->get("price1");
		$type = $this->input->get("type");
		$this->all_products_list = $this->products->get_ajax_products_list($size,$color,$discount,$price,$main_cat,$sub_cat,$sec_cat,$third_cat,$price_text, $type);

		$this->view_products_list = $this->products->get_products_view();
		$this->view_hot_products_list = $this->products->get_hot_products_view();

		$this->template->title = $this->Lang["ALL_PRODUCT_LIST"]." | ".SITENAME;
                $this->title_display = $this->Lang["ALL_PRODUCT_LIST"];
		if($type == 1){
			echo count($this->all_products_list);
		}else{
			echo new View("themes/".THEME_NAME."/products/products_list");
		}
		exit;
	}

	/** PRODUCTS  LISTING - CATEGORY BASED **/

	public function categoery_list($cat_type = "",$category = "", $page = "")
	{
	        //print_r($cat_type); exit;
		$cat_type=base64_decode($cat_type);
		$this->color_id="";
		$this->category_id = "";
		$this->sub_cat="";
		$this->category_url = $category;
		$category_name="";
		$category_name_main = "";

		if($cat_type=="sub"){
		        $this->sub_cat= $category;
				$category_deatils = $this->products->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
				$category_name_main = $category_deatils[0]->category_name;
		}
		elseif($cat_type=="sec"){
		        $this->sub_cat= "2";
				$category_deatils = $this->products->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		}
		else if($cat_type=="third"){
		        $this->sub_cat= "3";
				$category_deatils = $this->products->get_categoryname($category);
				$this->category_id = $category_deatils[0]->main_category_id;
				$category_name = $category_deatils[0]->category_name;
		}
		else {
			$category_deatils = $this->products->get_categoryname($category);
			$this->category_id = $category_deatils[0]->category_id;
			$category_name = $category_deatils[0]->category_name;
		}

		$this->all_products_count = $this->products->get_products_count($cat_type,$category);
		$this->pagination = new Pagination(array(
				'base_url'       => 'products/c/'.base64_encode($cat_type).'/'.$category.'.html/page/'.$page,
				'uri_segment'    => 6,
				'total_items'    => $this->all_products_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_products_list = $this->products->get_products_list($cat_type,$category, $this->pagination->sql_offset, $this->pagination->items_per_page);
		$this->view_products_list = $this->products->get_products_view();
		$this->view_hot_products_list = $this->products->get_hot_products_view();
		$this->category_name = $category_name;
		$this->categeory_list = $this->products->get_subcategory_list();
		$this->products_list = $this->products->get_products_min_max();
		foreach ($this->products_list as $pro ){
		$this->pro_max=$pro->max_deal;
		$this->pro_min=$pro->min_deal;
		}
		$this->color_list = $this->products->get_color_list();
		$this->size_list = $this->products->get_size_list();
		$this->template->title = rtrim($this->Lang["PRODUCTS"].' / '.$category_name." | ".SITENAME);
                $this->title_display = rtrim($this->Lang["PRODUCTS"].' / '.$category_name);
		$this->template->content = new View("themes/".THEME_NAME."/products/products");

	}

	/* ADD MORE SIZE */
	/*public function addmore_size($size,$deals,$quantity)
	{
	    $this->session->set('product_quantity_qty'.$deals,$quantity);
	    $this->session->set('product_size_qty'.$deals,$size);
	    $product_deals = $this->products->get_cart_products($deals);
	    url::redirect(PATH.'product/'.$product_deals->current()->deal_key.'/'.$product_deals->current()->url_title.'.html');

	} */

	/* ADD MORE SIZE */
	public function addmore_size($size,$deals,$quantity)
	{
	    $this->session->set('product_quantity_qty'.$deals,$quantity);
	    $this->session->set('product_size_qty'.$deals,$size);
	     /*  $product_deals = $this->products->get_cart_products($deals);
	    url::redirect(PATH.'product/'.$product_deals->current()->deal_key.'/'.$product_deals->current()->url_title.'.html');*/
	    echo $size; exit;

	}


	/* ADD MORE CART SIZE */
	public function addmore_cart_size($size,$deals,$quantity)
	{
	    $this->session->set('product_quantity_qty'.$deals,$quantity);
	    $this->session->set('product_size_qty'.$deals,$size);
	    url::redirect(PATH."cart_checkout.html");

	}

	/* ADD MORE COLOR */
	/*public function addmore_color($color,$deals)
	{

	    $this->session->set('product_color_qty'.$deals,$color);
	    $product_deals = $this->products->get_cart_products($deals);
	    url::redirect(PATH.'product/'.$product_deals->current()->deal_key.'/'.$product_deals->current()->url_title.'.html');


	} */

		/* ADD MORE COLOR */
	public function addmore_color($color,$deals)
	{
	    $this->session->set('product_color_qty'.$deals,$color);
	    //$product_deals = $this->products->get_cart_products($deals);
	    echo $color; exit;
	    //url::redirect(PATH.'product/'.$product_deals->current()->deal_key.'/'.$product_deals->current()->url_title.'.html');
	}

	/* ADD MORE PAY COLOR */
	public function addmore_paycolor($color,$deals)
	{
	    $this->session->set('product_color_qty'.$deals,$color);
	    url::redirect(PATH."cart_checkout.html");
	}

	/** PRODUCTS  LISTING - SEARCH BASED **/

	public function search_list($page = "")
	{
		
		
		
		
		$this->color_id="";
		$this->category_id = ""; // for subscribe page
	        $search = $this->input->get('q');
			
	        $maincatid= $this->input->get("d_id"); // for search with category in header
			
			
			
		$this->all_products_count = $this->products->get_products_count($search,"","","",$maincatid);
		
		
		
		
		
		$this->pagination = new Pagination(array(
				'base_url'       => '/products/search.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->all_products_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		

		$this->all_products_list = $this->products->get_products_list($search,"", $this->pagination->sql_offset, $this->pagination->items_per_page,"","",$maincatid);
				
       
		
		$this->view_products_list = $this->products->get_products_view();
		$this->view_hot_products_list = $this->products->get_hot_products_view();
		$this->products_list = $this->products->get_products_min_max();
		foreach ($this->products_list as $pro ){
		$this->pro_max=$pro->max_deal;
		$this->pro_min=$pro->min_deal;
		}
		$this->category_name = $search;
		$this->categeory_list = $this->products->get_subcategory_list();
		$this->template->title = rtrim($this->Lang["PRODUCTS"].'/'.$search." | ".SITENAME);
		$this->title_display = rtrim($this->Lang["PRODUCTS"].'/'.$search);
		$this->template->content = new View("themes/".THEME_NAME."/products/products");
		$this->size_list = $this->products->get_size_list();
		$this->color_list = $this->products->get_color_list();
	}

	/** VIEW PRODUCTS **/

	public function details_product($deal_key= "", $url_title = "",$type = "")
	{
	        $this->is_details = 1;
		$this->product_deatils = $this->products->get_product_details($deal_key, $url_title,$type);
		if(count($this->product_deatils)==0){
		        common::message(-1, $this->Lang["PAGE_NOT"]);
		        url::redirect(PATH);
		}
		foreach($this->product_deatils as $Deal){
                        $this->avg_rating =$this->products->get_product_rating($Deal->deal_id);
                        $this->sum_rating =$this->products->get_product_rating_sum($Deal->deal_id);
                        $this->delivery_details =$this->products->get_product_delivery($Deal->deal_id);
                        $this->all_products_list = $this->products->get_related_category_products_list($Deal->deal_id, $Deal->sec_category_id);
                        $this->products_list_name = $this->Lang['REL_PRODUCT'];
                        if(count($this->all_products_list) < 3){        
                        $this->all_products_list = $this->products->get_hot_all_products_view($Deal->deal_id);
                         $this->products_list_name = $this->Lang['HOT_PRODUCT'];
                                 if(count($this->all_products_list) < 3){ 
                                        $this->all_products_list = $this->products->get_related_category_products_list($Deal->deal_id, $Deal->sec_category_id);
                                         $this->products_list_name = $this->Lang['REL_PRODUCT'];
                                  }
                        }
                        $userflat_deatils = $this->products->get_userflat_amount($Deal->merchant_id);
                        $this->userflat_amount = $userflat_deatils->flat_amount;
                        $this->color_deatils = $this->products->get_color_data($Deal->deal_id);
                        $this->size_deatils = $this->products->get_size_data($Deal->deal_id);
                        $this->product_size = $this->products->get_product_one_size($Deal->deal_id);
                        $this->product_color = $this->products->get_product_color($Deal ->deal_id);
			$this->template->title = $Deal->deal_title."/".$Deal->category_name."/".CURRENCY_SYMBOL.$Deal->deal_value." | ".SITENAME;
			if($Deal->meta_description){
				$this->template->description = $Deal->meta_description;
			}
			if($Deal->meta_keywords){
				$this->template->keywords = $Deal->meta_keywords;
			}
			if($Deal->deal_key){
				$this->template->metaimage = PATH.'images/products/1000_800/'.$Deal->deal_key.'_1.png';
			}
		}
		$this->template->content = new View("themes/".THEME_NAME."/products/details_product");
	}

	/**  PRODUCT STAR RATING  **/
	public function product_rating()
	{
		$aResponse['error'] = false;
		if($this->UserID == "") $aResponse['error'] = true;
		$aResponse['message'] = '';
		$aResponse['server'] = '';
			if(isset($_POST['action']) && $this->UserID)
			{
				if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'rating')
				{
						$id = intval($_POST['idBox']);
						$rate = floatval($_POST['rate']);
						$deal_id=$_POST['deal_id'];
						$success = true;
						if($success)
						{
								$aResponse['message'] = 'Your rate has been successfuly recorded. Thanks for your rate :)';
								$aResponse['server'] = '<strong>Success answer :</strong> Success : Your rate has been recorded. Thanks for your rate :)<br />';
								$aResponse['server'] .= '<strong>Rate received :</strong> '.$rate.'<br />';
								$aResponse['server'] .= '<strong>Deal ID :</strong> '.$deal_id.'<br />';
								$aResponse['server'] .= '<strong>ID to update :</strong> '.$id;
								$this->userPost = $this->input->post();
								$this->product_rate = $this->products->save_product_rating(arr::to_object($this->userPost));
								$ch="auction_sess_".$_POST['deal_id'];
								$sta= $this->session->set($ch,$_POST['rate']);
								echo json_encode($aResponse);
						}
				}
		}
		echo json_encode($aResponse);
	        exit;

	}

	/**AJAX FILTER PRODUCTS **/
	public function ajax_post_products()
	{

		$this->color_id="";
		$price = $this->input->get('amount');
		$price_from = 0;
		$price_to = 100000;
		if($this->input->get('amount')){
			$price1 = explode('-',$price);


			$price_from = trim($price1[0]);
			$price_to = trim($price1[1]);
		}

			$price1_1 = explode(CURRENCY_SYMBOL,$price_from);
			$price1_2 = explode(CURRENCY_SYMBOL,$price_to);
			$this->all_products_list = $this->products->get_products_lists_byfilter($price1_1[1],$price1_2[1]);
			$this->view_products_list = $this->products->get_products_view();
			$this->view_hot_products_list = $this->products->get_hot_products_view();
		        echo new View("themes/".THEME_NAME."/products/products_list");

		exit;
	}

	/**ajax filter products
	public function ajax_post_color()
	{
			$color = $this->input->get('color');
			$this->all_products_list = $this->products->get_products_lists_bycolor($color);
			echo  new View("themes/".THEME_NAME."/products/products_list");
		exit;
	}
        **/

	/** AJAX FILTER PRODUCTS SIZE  **/
	public function ajax_post_size()
	{
		$size = $this->input->get('size');
		$this->color_id="";
		$this->all_products_list = $this->products->get_products_lists_bysize($size);
		$this->view_products_list = $this->products->get_products_view();
		$this->view_hot_products_list = $this->products->get_hot_products_view();
		echo  new View("themes/".THEME_NAME."/products/products_list");
		exit;
	}

	/** COLOR LIST **/
	public function color_list($id="",$page="")
	{
	    $this->color_filter = "1";
	    $this->category_id = "";
		$this->all_products_count = $this->products->get_products_lists_bycolor_count($id);
		$this->pagination = new Pagination(array(
				'base_url'       => 'products/color_filter/'.$id.'.html/page/'.$page,
				'uri_segment'    => 6,
				'total_items'    => $this->all_products_count,
				'items_per_page' => 12,
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->all_products_list = $this->products->get_products_lists_bycolor($id);
		$this->view_products_list = $this->products->get_products_view();
		$this->view_hot_products_list = $this->products->get_hot_products_view();
		$this->category_name = "";
		$this->color_id=$id;
		$this->categeory_list = $this->products->get_subcategory_list();
		$this->products_list = $this->products->get_products_min_max();
		foreach ($this->products_list as $pro ){
		$this->pro_max=$pro->max_deal;
		$this->pro_min=$pro->min_deal;
		}
		$this->color_list = $this->products->get_color_list();
		$this->size_list = $this->products->get_size_list();
		$this->template->content = new View("themes/".THEME_NAME."/products/products");
	}

	//Add to product compare
	public function add_compare()
	{

			$product_id=$this->input->get("product_id");
			$type=$this->input->get("type");
			$cate_detail = $this->products->get_category_details($product_id);
			$product_cat=$product_cat_name="";
			if(count($cate_detail)){
				$product_cat = $cate_detail[0]->category_id;
				$product_cat_name = $cate_detail[0]->category_name;
				$product_title = $cate_detail[0]->deal_title;
			}

			$action=$this->input->get("act");
			$compare_cat = $this->session->get("product_compare_cat");
			empty($compare_cat)?$this->session->set("product_compare_cat",$product_cat):"";

			$compare_cat = $this->session->get("product_compare_cat");
			if($compare_cat==$product_cat){

			if(((int)$product_id > 0) && is_string($action)){
				$compare = $this->session->get("product_compare");
				$ses_compare = !empty($compare)?$compare:array();
				$link = "<a href='".PATH."product-compare.html' title='".$this->Lang['PRODUCT_COMPARE']."'> ".$this->Lang['PRODUCT_COMPARE']." </a>";
				
				if(!in_array($product_id,$ses_compare) && (is_string($action) && $action=='true')){
				$arraycount = count($ses_compare);
				$link = $this->Lang['PRODUCT_COMPARE'];
				if($arraycount > 0){
				$link = "<a href='".PATH."product-compare.html' title='".$this->Lang['PRODUCT_COMPARE']."'> ".$this->Lang['PRODUCT_COMPARE']." </a>";
				}
					if(count($ses_compare) < 4){
						$ses_compare[]+=$product_id;
						$this->session->set("product_compare",$ses_compare);
						echo $this->Lang['PRD_CMP_ADD'].$product_title.$this->Lang['TXT_FOR'].$link.$arraycount;
						//echo "1";
						exit;
					}else{
						array_shift($ses_compare);
						$ses_compare[]+=$product_id;
						$this->session->set("product_compare",$ses_compare);
						echo $this->Lang['PRD_CMP_ADD'].$product_title.$this->Lang['TXT_FOR'].$link.$arraycount;
						//echo "1";
						exit;
					}
				}else if((is_string($action) && $action=='false')){
					$key = array_search($product_id, $ses_compare);
					$arraycount = count($ses_compare)-2;
					if (false !== $key) {
						unset($ses_compare[$key]);
					}
					$this->session->set("product_compare",$ses_compare);
					echo $this->Lang['REV_COMPARE'].$arraycount;
					exit;
				}else{
					echo ($type=='detail')?$this->Lang['PRD_CMP_ALREADY_ADD']:$this->Lang['REV_COMPARE'];
					exit;
					//echo $this->Lang['REV_COMPARE'];
				}
			}else{
				echo $this->Lang['ERR_PRD_CMP'];
				exit;
			}
		}
		else{

			//echo $link = $this->Lang['U_CANT_COMP']." ".$product_cat_name.$this->Lang['ABV_ITMS']." . <a href='".PATH."products/remove_compare/?product_id=d' title='".$this->Lang['PRODUCT_COMPARE']."'> (".$this->Lang['CLR_COMP_ITMS'].") </a>";
			echo $link = $this->Lang['U_CANT_COMP']." ".$product_cat_name.$this->Lang['ABV_ITMS']." . <a href='".PATH."product-compare.html' title='".$this->Lang['PRODUCT_COMPARE']."'> (".$this->Lang['CLR_COMP_ITMS'].") </a>";
		}
			exit;

	}

	public function productcompare()
	{
	        $this->is_details = 1;
		$this->template->title = $this->Lang["PRODUCT_COMPARE"]." | ".SITENAME;
		$this->title_display = $this->Lang["PRODUCT_COMPARE"];
		//To get products from session for compare
		$compare =$this->session->get("product_compare");
		$compare = !empty($compare)?$compare:array();
		//To get total count of products
		$this->tot_compate = count($compare);

		$this->product_compare = array();
		$this->attribute_groups = array();
		$this->product_colors=array();
		$this->product_sizes=array();

 		foreach($compare as $cmp){
			//To get average rating of the product
			$avg_rating =$this->products->get_product_rating($cmp);
			//To get rating count of the product
			$rating_count= $this->products->GetProductRatingCount($cmp);
			//To get the details of the product
			$cmp_prd = $this->products->get_productcompare($cmp);

				//To get attributes and attribute group of the product
				$attribute_groups= $this->products->getProductAttributes($cmp);

				$attribute_data = array();

				 foreach ($attribute_groups as $attribute_group) {
					foreach ($attribute_group['attribute'] as $attribute) {
						$attribute_data[$attribute['attribute_id']] = $attribute['text'];
					}
				}

				//To get products color
				$this->product_colors[$cmp]= $this->products->GetProductColor($cmp);
				//To get product sizes
				$this->product_sizes[$cmp]= $this->products->GetProductSize($cmp);

				foreach($cmp_prd as $p){
					$this->product_compare[$p['deal_id']]= array("deal_id"=>$p['deal_id'],"deal_title"=>$p['deal_title'],"url_title"=>$p['url_title'],"deal_key"=>$p['deal_key'], "deal_value"=>$p['deal_value'],"deal_price"=>$p['deal_price'],"deal_percentage"=>$p['deal_percentage'],"purchase_count"=>$p['purchase_count'], "user_limit_quantity"=>$p['user_limit_quantity'],"rating"=>$avg_rating,"rating_count"=>$rating_count,"deal_description"=>$p['deal_description'],"attribute"=> $attribute_data);

				}

				foreach ($attribute_groups as $attribute_group) {
					//To save the attribute group data
					$this->attribute_groups[$attribute_group['attribute_group_id']]['name'] = $attribute_group['name'];

					//To save the attribute data and attribute group data
					foreach ($attribute_group['attribute'] as $attribute) {
						$this->attribute_groups[$attribute_group['attribute_group_id']]['attribute'][$attribute['attribute_id']]['name'] = $attribute['name'];
					}
				}

		}

		//$this->product_compare = arr::to_object($this->product_compare);
		//print_r($this->attribute_groups); exit;
		//print_r($this->product_compare); exit;
 		$this->template->content = new View("themes/".THEME_NAME."/products/product_compare");
	}


	//Add to wish list
	public function remove_compare()
	{
		$product_id=$this->input->get("product_id");

		$redirect_url = $this->input->get("redirect");
		$redirect_url = base64_decode($redirect_url);
		if((int)$product_id > 0){
                        
			$compare = $this->session->get("product_compare");
			if(!empty($compare) && in_array($product_id,$compare))
			{
				$key = array_search($product_id,$compare);
				unset($compare[$key]);
				$this->session->set("product_compare",$compare);
				$compare = $this->session->get("product_compare");
				if(count($compare) > 0){
					$this->session->set("product_compare",$compare);
				}else{
				        $this->session->delete("product_compare_cat");
					$this->session->delete("product_compare");
				}

				common::message(1,"You have modified your product compare!");
				if($redirect_url){
				 url::redirect($redirect_url);
				}
				 url::redirect(PATH."product-compare.html");


			}
		}
		else if($product_id =="d"){
			$this->session->delete("product_compare");
			$this->session->delete("product_compare_cat");
				 url::redirect(PATH."product-compare.html");
		}
		else
		{
			common::message(-1,"Error: No Data Found");
			 url::redirect(PATH."product-compare.html");

		}
	}

	//Add to wish list
	public function add_wishlist()
	{
		if($this->UserID)
		{
			$id=$_GET["product_id"];
			$wishlist = array();
			$status = $this->products->get_productcount($id);
			$wishlist[] = $id;
			if(count($status) > 0)
			{
				$result = $this->products->get_userwishlist();
				$pro_id = unserialize($result->wishlist);
				if(isset($result->wishlist) && $result->wishlist!="")
				{
					foreach($pro_id as $p)
					{
						if($p != $id)
						{
							$wishlist[] = $p;
						}
						else
						{
							echo "2"; exit;
						}
					}
				}
				$result = $this->products->update_wishlist($wishlist);
				if($result == 1)
				{
					echo $result; exit;
				}
			}
			else
			{
				echo "0"; exit;
			}
		}
		else
		{
			echo "3"; exit;
		}
	}

	public function wishlist()
	{
                if(!$this->UserID){
                        url::redirect(PATH);
                }
                $this->is_details = 1;
		$this->limit = (isset($_GET['limit']) && $_GET['limit']!="")?$_GET['limit']:"20";
		$this->template->title = $this->Lang["WISH_LIST"]." | ".SITENAME;
		$this->title_display = $this->Lang["WISH_LIST"];
		$wishlist_count = $this->products->get_user_wish_count();
		$this->user_wishlist_count=(count($wishlist_count))?unserialize($wishlist_count[0]->wishlist):0;
		$this->user_wishlist = $this->products->get_user_wish_list();
		$this->template->content = new View("themes/".THEME_NAME."/users/wishlist");
	}


	//Add to wish list
	public function remove_wishlist($id="")
	{
		$wishlist = array();
		$status = $this->products->get_productcount($id);
		$wishlist[] = $id;
		if(count($status) > 0)
		{
			$result = $this->products->get_userwishlist();
			$pro_id = unserialize($result->wishlist);
			if(isset($result->wishlist) && $result->wishlist!="")
			{
				$key = array_search($id, $pro_id);
				if(count($key)>0)
				{
					$p_data = array_flip($pro_id);
					unset($p_data[$id]);
					$pr_data = array_flip($p_data);
					$result = $this->products->update_wishlist($pr_data);
					if($result == 1)
					{
						common::message(1, "Success: You have deleted the product in your wishlist!");
						url::redirect(PATH."wishlist.html");
					}
				}
				else
				{
					common::message(-1, "Error: No Data Found");
					url::redirect(PATH."wishlist.html");
				}
			}
		}
		else
		{
			common::message(-1, "Error: No Data Found");
			url::redirect(PATH."wishlist.html");
		}
	}

	public function update_shipping_address()
	{
		if($_POST){
			$status = $this->products->update_shipping_address(arr::to_object($_POST));
			common::shipping_address();
			exit;
		}
	}
}
