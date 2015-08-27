<?php defined('SYSPATH') OR die('No direct access allowed.');
class Stores_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css')); 
		}else if(LANGUAGE == "spanish"){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
		$this->stores = new Stores_Model();
		$this->is_store = 1;
		if(!$this->store_setting){
		        url::redirect(PATH);
		}
	}
	
	/** STORE LIST  PAGE **/

	public function store_list($page = "" )
	{		
		$this->store_details_count = $this->stores->store_details_count();
		
		$this->pagination = new Pagination(array(
				'base_url'       => 'stores/page/'.$page."/",
				'uri_segment'    => 3,
				'total_items'    => $this->store_details_count,
				'items_per_page' => 8, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->template->title = $this->Lang["STORE_LIST"]." | ".SITENAME;
		$this->store_details = $this->stores->get_store_details($this->pagination->sql_offset, $this->pagination->items_per_page);
		
		$this->template->content = new View("themes/".THEME_NAME."/store_listing");
	}
		/** STORE VIEWMORE **/
		
	public function store_list_1($page = "")
	{
		
		$deal_record = $this->input->get('record');
		$deal_offset = $this->input->get('offset');
		$this->store_details_count = $this->stores->store_details_count();
		$this->record = $this->input->get('record');
		$this->template->title = $this->Lang["STORE_LIST"]." | ".SITENAME;
		$this->store_details = $this->stores->get_store_details($deal_offset, $deal_record);
		echo new View("themes/".THEME_NAME."/all_store_listing");
		exit;
		
		
	}
	
	/** STORE  LISTING - SEARCH BASED **/
	
	public function search_list($page = "")
	{
	    $search = $this->input->get('q');
		$this->store_details_count = $this->stores->get_store_count($search);
		$this->pagination = new Pagination(array(
				'base_url'       => '/stores/search.html/page/'.$page,
				'uri_segment'    => 4,
				'total_items'    => $this->store_details_count,
				'items_per_page' => 8, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->store_details = $this->stores->get_store_list($search,$this->pagination->sql_offset, $this->pagination->items_per_page);

		$this->store_search = $search;
		$this->template->title = $this->Lang["STORE_LIST"]." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/store_listing");
	}
	
	/** STORE DETAILS  PAGE **/

	public function store_detail($storekey = "",$store_url_title = "" )
	{
		
		$this->is_store_details = 1;
		$search="";
		if($this->input->get('q')) {
			$search = $this->input->get('q');	
		}		
		$this->get_store_details = $this->stores->get_store_detailspage($storekey,$store_url_title); 
		if(count($this->get_store_details) == 0){		
		        common::message(-1, $this->Lang["NO_DATA_F"]);
		        url::redirect(PATH);
		}
		foreach($this->get_store_details as $store) {
                        $this->avg_rating =$this->stores->get_store_rating($store->store_id);
                        $this->get_sub_store_details = $this->stores->get_sub_store_detailspage($store->store_id);
                        $this->get_deals_categories = $this->stores->get_deals_categories($store->store_id,$search);
                        $this->get_auction_categories = $this->stores->get_auction_categories($store->store_id,$search);
                        $this->get_product_categories = $this->stores->get_product_categories($store->store_id,$search);
                        
                        $this->all_payment_list = $this->stores->payment_list();
                        $this->comments_deatils = $this->stores->get_comments_data($store->store_id);
                        $this->like_details = $this->stores->get_like_data($store->store_id);
                        $this->unlike_details = $this->stores->get_unlike_data($store->store_id);
		        $this->template->title = $store->store_name." | ".SITENAME;
			    if($store->meta_description){
				    $this->template->description = $store->meta_description;
			    }
			    if($store->meta_keywords){
				    $this->template->keywords = $store->meta_keywords;
			    }
			    if($store->merchant_id){ 
				    $this->template->metaimage = PATH.'images/merchant/600_370/'.$store->merchant_id.'_'.$store->store_id.'.png';
			    }
		}
		$this->template->content = new View("themes/".THEME_NAME."/store_detail");		
	}
/* STORE COMMENTS */
        public function store_list_details($page = "" )
	{		
		$this->store_details_count = $this->stores->get_user_bought($page);
		url::redirect(PATH);
		
	}
	
	public function comments()
	{ 
			$action_type = $this->input->get("action_type"); 
			$comments = $this->input->get("comment"); 
			$store_id = $this->input->get("store_id");
			//$type = $this->input->get("type");
			
			$discussion_id = $this->input->get("dis_id");
			if($action_type=="update") {
				
				$status = $this->stores->update_comments($comments,$store_id,$discussion_id);
			} else {
				
				$status = $this->stores->add_comments($comments,$store_id);
			}
			
			$this->comments_deatils = $this->stores->get_comments_data($store_id);
			$this->like_details = $this->stores->get_like_data($store_id);
			$this->unlike_details = $this->stores->get_unlike_data($store_id);
			echo new View("themes/".THEME_NAME."/store_comments");
			exit;

					
	}

/* STORE LIKE COMMENTS */
	 public function like()
        {
			$store_id = $this->input->get('store_id');
			$user_id = $this->input->get('user_id');
			$dis_id = $this->input->get('dis_id');	
            $status = $this->stores->like($store_id,$user_id,$dis_id);
            $get_data = $this->stores->get_like_details($dis_id);
            $get_data1 = $this->stores->get_unlike_details($dis_id);
            $data = ' <div class="lode_over"><a class="like" title="like">('.$get_data.')</a></div>';
            echo $data .= '<div class="lode_over2" ><a class="dislike" title="unlike" onclick="unlike('.'&#39;'.$store_id.'&#39;'.',&#39;'.$user_id.'&#39;'.',&#39;'.$dis_id.'&#39;'.');">('.$get_data1.')</a></div>';
            exit;
        }
        /* STORE UNLIKE */
        public function unlike()
        {
			$store_id = $this->input->get('store_id');
			$user_id = $this->input->get('user_id');
			$dis_id = $this->input->get('dis_id');			
            $status = $this->stores->unlike($store_id,$user_id,$dis_id);
            $get_data = $this->stores->get_unlike_details($dis_id);
             $get_data1 = $this->stores->get_like_details($dis_id);
            $data = '<div class="lode_over"><a class="like" title="unlike" onclick="like('.'&#39;'.$store_id.'&#39;'.',&#39;'.$user_id.'&#39;'.',&#39;'.$dis_id.'&#39;'.');">('.$get_data1.')</a></div>';
            echo $data .= '<div class="lode_over2"><a class="dislike" title="unlike">('.$get_data.')</a></div>';
            exit;
        }
        
        /* STORE RATING */
		public function store_rating()
	{	
		$aResponse['error'] = false;
		$aResponse['message'] = '';
		$aResponse['server'] = ''; 
			if(isset($_POST['action']))
			{
				if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'rating')
				{
						$id = intval($_POST['idBox']);
						$rate = floatval($_POST['rate']);
						$store_id=$_POST['deal_id'];
						$success = true;
						if($success)
						{
								$aResponse['message'] = 'Your rate has been successfuly recorded. Thanks for your rate :)';
								$aResponse['server'] = '<strong>Success answer :</strong> Success : Your rate has been recorded. Thanks for your rate :)<br />';
								$aResponse['server'] .= '<strong>Rate received :</strong> '.$rate.'<br />';
								$aResponse['server'] .= '<strong>Deal ID :</strong> '.$store_id.'<br />';
								$aResponse['server'] .= '<strong>ID to update :</strong> '.$id;			
								$this->userPost = $this->input->post(); 
								$this->auction_rate = $this->stores->save_store_rating($store_id,$rate);
								$ch="auction_sess_".$_POST['deal_id'];
								$sta= $this->session->set($ch,$_POST['rate']);
								echo json_encode($aResponse);
						}		
				}	
		}
exit;
	
	}
}
