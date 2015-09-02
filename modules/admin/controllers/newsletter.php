<?php defined('SYSPATH') OR die('No direct access allowed.');
class Newsletter_Controller extends website_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id || $this->user_type != 1) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		$this->news = new Newsletter_Model();	

		$this->city_id= $this->session->get("CityID");
			
	}

	/** SUBSCRIBED USER **/
	
	public function subscribed_user($page = '')
	{   

                
                url::redirect(PATH."admin.html");
        	$this->subscriber_count = $this->news->subscriber_list_count();

		$this->pagination = new Pagination(array(
				'base_url'       => 'admin/subscribed-user.html/page/'.$page.'/',
				'uri_segment'    => 4,
				'total_items'    => $this->subscriber_count,
				'items_per_page' => 25, 
				'style'          => 'digg',
				'auto_hide' => TRUE
		));
		$this->subscriber = $this->news->subscriber_list($this->pagination->sql_offset, $this->pagination->items_per_page);

        $this->template->title = $this->Lang['MANAGE_SUBSCRIBER'];
        $this->template->content = new View("newsletter/subscriber");
	}
	
	/** BLOCK UNBLOCK SUBSCRIBER **/
	
	public function block_subscriber($type = "", $user_id = "")
	{   
			
		$status = $this->news->blockunblocksubscriber($type,$user_id);

		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang['SUB_SUCCESS']);
			}
			else{
				common::message(1, $this->Lang['SUCCESS_UNSUBSCRIBE']);
			}
		}
		else{
			common::message(-1, $this->Lang['NO_RECORD_FOUND']);
		}
		url::redirect(PATH."admin/subscribed-user.html");
	}
	
	/** DELETE SUBSCRIBER **/
	
	public function delete_subscriber($user_id ="")
	{   

		if($user_id){
			$status = $this->news->deletesubscriber($user_id);
			if($status == 1){
				common::message(1, $this->Lang['SUB_DELETE']);
			}
			else{
				common::message(-1, $this->Lang['NO_RECORD_FOUND']);
			}
		}
		url::redirect(PATH."admin/subscribed-user.html");
	}
	
	/** SEND EMAILS **/
	
	public function send_emails()
	{
		$this->news_letter = "1";
	    if($_POST){

			$this->userPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('city','required')
							->add_rules('subject', 'required');
									
							 
				if($post->validate()){
		       		 $status = $this->news->send_newsletter(arr::to_object($this->userPost));

		             	if($status == 1){
				        common::message(1, $this->Lang['NEWS_SENT']);
			        }
			        else{
				        common::message(-1, $this->Lang['NEWS_NOT_SENT']);
			        }
		       		 url::redirect(PATH."admin/subscribed-user.html");
		        }
		        else{
		            $this->form_error = error::_error($post->errors());
		        }
		}
	$this->city_list = $this->news->getCityList();       
        $this->template->title = $this->Lang['SEND_NEWSL'];
        $this->template->content = new View("newsletter/send_emils");	
	}

	/** SEND DAILY DEALS NEWS LETTER **/

	public function send_daily_deals()
	{
		
		if($_POST){

			$city_list = $this->input->post("citydata");
			

			newsletter::send($city_list);
			common::message(1, $this->Lang['DAILY_DEALS_SENT']);
			url::redirect(PATH."admin/send-daily-deals.html");
			
		}
		//$this->cityDataList  = $this->news->getCityList();
		
		$this->categorylist = $this->news->get_top_category_list();
		
		$this->template->title = $this->Lang['SEND_NEWSL'];
		
		$this->template->content = new View("newsletter/send_daily_deal");
	}


	/** SEND DAILY DEALS NEWS LETTER **/

	public function send_daily()
	{
		if($_POST){
		$this->city_list = $this->input->post("citydata");
		
		$this->newsletter_user_list = $this->news->get_subscribed_user_list();


		$this->all_category_list = $this->news->get_category_list();
			$cnt = 0;

		foreach($this->newsletter_user_list as $UList){

			$userLists[ $UList->user_id] = array("user_id" => $UList->user_id,  "email" => $UList->email_id,"country_id" => explode(",", $UList->country_id), "city_id" => explode(",", $UList->city_id), "category_id" => explode(",", $UList->category_id));
		}
		
		foreach($this->city_list as $C){

			$Cdata = explode("__", $C);
			if(isset($Cdata[0]) && isset($Cdata[1])){
				$country_id = $Cdata[0]; $city_id = $Cdata[1];

				$this->all_deals_list_by_city = $this->news->get_city_daily_deals_list($country_id, $city_id);
				foreach($userLists as $UL){
					$this->single_userdata = $UL;
					if(in_array($city_id, $UL["city_id"]) && count($this->all_deals_list_by_city) > 0){

						foreach($this->all_deals_list_by_city as $DList){
 							$this->cityName = ucfirst($DList->city_name);
							if(in_array($DList->category_id, $UL["category_id"])){
				
								 $cnt =  $cnt + 1;
							}
						}
						
					}
					
				}
				
                             }
                        }
                }
		$this->template->title = $this->Lang['SEND_NEWSL'];
		$this->template->content = new View("themes/".THEME_NAME."/send_daily_deal_template");
	}
	
}
