<?php defined('SYSPATH') OR die('No direct access allowed.');
class Admin_merchant_Controller extends website_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id || $this->user_type != 1) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		$this->merchant = new Admin_merchant_Model();	
		$this->merchant_act = "1";		
	}
	
	/** ADD MERCHANT **/
	
	public function add_merchant()
	{
		$this->add_merchant = "1";
		$adminid=$this->session->get('user_id');
		if($_POST){
		
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			
			//$post->add_callbacks('payment_acc', array($this, 'existing_account_zenith'));
			
			
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('firstname', 'required')
						->add_rules('lastname', 'required')
						->add_rules('email', 'required','valid::email',array($this, 'email_available'))
						->add_rules('mobile', 'required', array($this, 'validphone'))
						->add_rules('address1', 'required')
						->add_rules('address2', 'required')
						->add_rules('mr_mobile', 'required', array($this, 'validphone'))
						->add_rules('mr_address1', 'required')
						->add_rules('mr_address2', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required')
						->add_rules('payment_acc', 'required', 'valid::digit', array($this,'existing_account_zenith'))
						->add_rules('storename', 'required')
						->add_rules('zipcode', 'required', 'chars[a-zA-Z0-9.]')
						//->add_rules('website', 'required','valid::url')
						->add_rules('website', array($this, 'valid_website'))
						->add_rules('latitude', 'required','chars[0-9.-]')
						->add_rules('longitude', 'required','chars[0-9.-]')
						->add_rules('commission','required',array($this, 'valid_commision'),'chars[0-9]')
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
						
						
						
						
						
						
						
					if($post->validate())
					{
						
						
						$password = text::random($type = 'alnum', $length = 8);
						$store_key = text::random($type = 'alnum', $length = 8);
						$status = "1";
						$status = $this->merchant->add_merchant(arr::to_object($this->userPost),$adminid,$store_key,$password);
							if($status){
							        $this->password = $password;
								$from = CONTACT_EMAIL;  
								$this->country_list = $this->merchant->getcountrylist();
		                                                $this->city_list = $this->merchant->getCityList();
                                                                $this->country_name = "";
                                                                $this->city_name = ""; 
                                                                foreach($this->country_list as $count){
                                                                        if($count->country_id == $post->country ){                                
                                                                                $this->country_name = $count->country_name;
                                                                        }
                                                                }
                                                                
                                                                foreach($this->city_list as $city){
                                                                        if($city->city_id == $post->city ){                                
                                                                                $this->city_name = $city->city_name;
                                                                        }
                                                                }
                         
                                /* $message = "<b> ".$this->Lang['DEAR']." :".ucfirst($post->firstname)." ".$post->lastname.",</b>";
				$message .= "<p>".$this->Lang['MERCHANT_ADD_SUC']."  </p><p> ".$this->Lang['YOR_EMAIL']." : ".$post->email."</p> <p>".$this->Lang['YOUR_PASS'].": ".$password."</p> <p>".$this->Lang['UR_DEAL_COMM']."  : ".$post->commission." % <p/> <p>".$this->Lang['YOUR_SHOP_NAM']." : ".$post->storename."<p/><p>".$this->Lang['SHOP_ADDR']."   : ".$post->address1.",".$post->address2." <p/><p>".$this->Lang['SHOP_WEB']."  : ".$post->website." <p/><br /> <a href='".PATH."merchant-login.html' >".$this->Lang['LOGIN_URL']."</a><br/><p>".$this->Lang['THANK'].",</p>"; */ 
				
								$message = new View("themes/".THEME_NAME."/merchant_signin_mail_template");
				                               // echo $message;  exit;
									if($_FILES['image']['name']){
										$filename = upload::save('image'); 						
										$IMG_NAME = $status.'.png';						
										common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
										common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
										unlink($filename);
									}
									
									if(EMAIL_TYPE==2){				
										email::smtp($from, $post->email, SITENAME ." - ".$this->Lang['CRT_MER_ACC'] , $message);
									}
									else{
										email::sendgrid($from, $post->email, SITENAME ." - ".$this->Lang['CRT_MER_ACC'] , $message);
									}

										common::message(1, $this->Lang["MERCHANT_ADD_SUC"]);
										url::redirect(PATH."admin/merchant.html");
							}
					}else{
							$this->form_error = error::_error($post->errors());	
					}
			}
		$this->country_list = $this->merchant->getcountrylist();
		$this->city_list = $this->merchant->getCityList();
		                                                       
		$this->template->title = $this->Lang["MERCHANT_ADD"];
		$this->template->content = new View("admin_merchant/add_merchant");
	}
	
	/** VERIFY ZENITH ACCOUNT **/
	
	public function existing_account_zenith($value = ""){
		
		
		//echo $this->Lang["BANK_ACC_ERR"];
		return 0;
		
		
	}
	
	
	public function valid_website($url = ""){
		
		if(isset($url)){
			$url = trim($url);
			if(valid::url($url)){
				return 1;
			}	
		}
		
		return 0;
	}
	
	/** MANAGE MERCHANT **/
	
	public function manage_merchant($page = "")
	{
	        if($_POST){
			$post = Validation::factory($_POST)->pre_filter('trim')->add_rules('message', 'required');		
				if($post->validate()){

				$email_id = $this->input->post('email');
				$this->email_id = $this->input->post('email');
				$this->name = $this->input->post('name');
				$this->message = $this->input->post('message');
				$fromEmail = NOREPLY_EMAIL;
				$message = new View("themes/".THEME_NAME."/admin_mail_template");
				if(EMAIL_TYPE==2){
				email::smtp($fromEmail,$email_id, SITENAME, $message);
				}
			   	else{
				email::sendgrid($fromEmail,$email_id, SITENAME, $message);
				}
				common::message(1, "Mail Successfully Sended");
				url::redirect(PATH."admin/merchant.html");
			}
			else{	
				$this->form_error = error::_error($post->errors());
			}
		}
		
		$this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
                $this->type = $this->input->get('sort');
                $this->sort = $this->input->get('param');
                $serch=$this->input->get("id");
                $this->today = $this->input->get("today");
		$this->startdate  = $this->input->get("startdate");
		$this->enddate  = $this->input->get("enddate");	
		$this->date_range = isset($_GET['date_range'])?1:0;
		$this->page = $page ==""?1:$page; // for export per page
		$this->url="admin/merchant.html"; // for export
		$this->manage_merchant = "1";
		$this->sort_url= PATH.'admin/merchant.html?';
                $this->count_merchant = $this->merchant->get_merchant_count($this->input->get('name'), $this->input->get('email'), $this->input->get('city'),$this->type,$this->sort,$this->today,$this->startdate,$this->enddate);
                   $this->pagination = new Pagination(array(
		                'base_url'       => 'admin/merchant.html/page/'.$page."/",
		                'uri_segment'    => 4,
		                'total_items'    => $this->count_merchant,
		                'items_per_page' => 10, 
		                'style'          => 'digg',
		                'auto_hide'      => TRUE
	                ));
		$search=$this->input->get("id");
                $this->search = $this->input->get();
                $this->search_key = arr::to_object($this->search);
                $this->city_list = $this->merchant->getCityListOnly();
                $this->getstoreslist = $this->merchant->getstoreslist();
                
                $this->users_list = $this->merchant->get_merchant_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'),$this->type,$this->sort,0,$this->today,$this->startdate,$this->enddate);
                if($search =='all'){
					$this->users_list = $this->merchant->get_merchant_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('name'), $this->input->get('email'), $this->input->get('city'),$this->type,$this->sort,1,$this->today,$this->startdate,$this->enddate);
				}
                
			if($search){
				$out = '"S.No","First Name","Last Name","Shop Name","Email","Joined Date","Mobile","Address1","Address2","Payment Account","Country","City"'."\r\n";

				$i=0; 
				$first_item = $this->pagination->current_first_item;
				foreach($this->users_list as $d)
				{
			
					$out .= $i + $first_item.',"'.$d->firstname.'","'.$d->lastname.'","'.$d->store_name.'","'.$d->email.'","'.date('d-M-Y h:m:i a',$d->joined_date).'","'.$d->user_phone_number.'","'.$d->user_address1.'","'.$d->user_address2.'","'.$d->payment_account_id.'","'.$d->country_name.'","'.$d->city_name.'"'."\r\n";
					$i++;
				}
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream'); 
					header('Content-Disposition: attachment; filename=Merchants.xls');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					echo "\xEF\xBB\xBF"; // UTF-8 BOM
					echo $out; 
					exit;
			}
				$this->template->title = $this->Lang["MERCHANT_MANAGE"];
                $this->template->content = new View("admin_merchant/manage_merchant");
	}

	/** MERCHANT UPDATE **/
	
	public function edit_merchant($userid = "")
	{ 
		$this->manage_merchant = "1";
	    if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('firstname', 'required')
						->add_rules('lastname', 'required')
						->add_rules('email', 'required','valid::email')
						->add_rules('mer_mobile', 'required', array($this, 'validphone'))
						->add_rules('mer_address1', 'required')
						->add_rules('mer_address2', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required')
						->add_rules('commission','required', array($this, 'valid_commision'),'chars[0-9]')
						->add_rules('payment_acc', 'required','valid::email');
				if($post->validate())
				{
					$status = $this->merchant->edit_merchant($userid, arr::to_object($this->userpost));
						if($status == $userid)
						{
							common::message(1, $this->Lang["MERCHANT_SET_SUC"]);
							$lastsession = $this->session->get("lasturl");
		                                        if($lastsession){
		                                        url::redirect(PATH.$lastsession);
		                                        } else {
		                                        url::redirect(PATH."admin/merchant.html");
		                                        }
						}
						elseif($status == 2 )
						{
							$this->form_error["email"] = $this->Lang["EMAIL_AL_E"];
						} 
				}
				else
				{
					$this->form_error = error::_error($post->errors());
				}
		}
		$this->city_list = $this->merchant->getCityList();
		$this->country_list = $this->merchant->getcountrylist();
		$this->user_data = $this->merchant->get_merchant_data($userid);	
		$this->shipping_data = $this->merchant->get_shipping_data($userid);

		if(count($this->user_data) == 0)
		{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			url::redirect(PATH."admin/merchant.html");
		}
		$this->template->title = $this->Lang["EDIT_MERCHANT"];
		$this->template->content = new View("admin_merchant/edit_merchant");
	
	}

	/** BLOCK AND UNBLOCK MERCHANT **/
	
	public function block_merchant($type = "", $email="", $uid = "")
	{
	    $email = base64_decode($email);
		$status = $this->merchant->blockunblockmerchant($type, $uid, $email);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["MERCHANT_UNB"]);
			}
			else{
				common::message(1, $this->Lang["MERCHANT_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/merchant.html");
		}
		
	}
	
		
	/** ADD MERCHANT SHOP**/
	
	public function add_merchant_shop($uid= "")
	{
		$this->m_id=$uid;
		$this->add_merchant = "1";
	    $adminid=$this->session->get('user_id');
	        if($_POST){
		        $this->userPost = $this->input->post();
		        $post = new Validation($_POST);
		        $post = Validation::factory(array_merge($_POST,$_FILES))
					        ->add_rules('mobile', 'required', array($this, 'validphone'))
					        ->add_rules('address1', 'required')
					        ->add_rules('address2', 'required')
					        ->add_rules('country', 'required')
					        ->add_rules('city', 'required')
					        ->add_rules('storename', 'required')
					        ->add_rules('zipcode', 'required', 'chars[a-zA-Z0-9.]')
					        ->add_rules('website', 'required','valid::url')
					        ->add_rules('latitude', 'required','chars[0-9.-]')
					        ->add_rules('longitude', 'required','chars[0-9.-]')
					        ->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
			
			if($post->validate())
			{	
				$store_key = text::random($type = 'alnum', $length = 8);
				$status = $this->merchant->add_merchant_shop(arr::to_object($this->userPost),$uid,$adminid,$store_key);

				if($status){
				
				        $from = CONTACT_EMAIL;  
				        
				                                
				                                $shop_detail = $this->merchant->get_merchant_shop_data($status);
								$user_detail = $this->merchant->user_details($shop_detail->current()->merchant_id);
								//print_r($user_detail); exit;
								$this->email = $user_detail->current()->email;
								$this->firstname = $user_detail->current()->firstname;
								$this->country_list = $this->merchant->getcountrylist();
		                                                $this->city_list = $this->merchant->getCityList();
                                                                $this->country_name = "";
                                                                $this->city_name = ""; 
                                                                foreach($this->country_list as $count){
                                                                        if($count->country_id == $post->country ){                                
                                                                                $this->country_name = $count->country_name;
                                                                        }
                                                                }
                                                                
                                                                foreach($this->city_list as $city){
                                                                        if($city->city_id == $post->city ){                                
                                                                                $this->city_name = $city->city_name;
                                                                        }
                                                                }
			
								$message = new View("themes/".THEME_NAME."/merchant_shop_add_mail_template");
				                              //  echo $message;  exit;
									if($_FILES['image']['name'])
					                                {						
							                                $filename = upload::save('image'); 						
							                                $IMG_NAME = $uid."_".$status.'.png';			
							                                common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
						                                        common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
							                                unlink($filename);
					                                }
									
									if(EMAIL_TYPE==2){				
										email::smtp($from, $this->email, SITENAME ." - ".$this->Lang['CRT_NEWSHOP_ACC'] , $message);
									}
									else{
										email::sendgrid($from, $this->email, SITENAME ." - ".$this->Lang['CRT_NEWSHOP_ACC'] , $message);
									}
									
					
					common::message(1, $this->Lang["MERCHANT_STORES_ADD_SUC"]);
					url::redirect(PATH."admin/merchant.html");
				}
			}
			else
			{
				$this->form_error = error::_error($post->errors());	
			}
		}
                $this->country_list = $this->merchant->getcountrylist();
                $this->city_list = $this->merchant->getCityList();
                $this->template->title = $this->Lang["MERCHANT_STORES_ADD"];
                $this->template->content = new View("admin_merchant/add_merchant_shop");
	}
	
	/** MANAGE MERCHANT SHOP **/
	
	public function manage_merchant_shop($uid = "",$page = "")
	{
	$this->manage_merchant = "1";
        $this->get_merchant_shop_count = $this->merchant->get_merchant_shop_count($this->input->get('storename'),  $this->input->get('city'),$uid);
                   $this->pagination = new Pagination(array(
		                'base_url'       => 'admin/merchant-shop/'.$uid.'.html/page/'.$page,
		                'uri_segment'    => 5,
		                'total_items'    => $this->get_merchant_shop_count,
		                'items_per_page' => 25, 
		                'style'          => 'digg',
		                'auto_hide'      => TRUE
	                ));
                $this->search = $this->input->get();
                $this->search_key = arr::to_object($this->search);
                $this->users_list = $this->merchant->get_merchant_list_shop($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('storename'),$this->input->get('city'),$uid);

                $this->city_list = $this->merchant->getCityListOnly();
                $this->template->title = $this->Lang["MERCHANT_STORES_MANAGE"];
                $this->template->content = new View("admin_merchant/manage_merchant_shop");
	}
	
	/** MERCHANT SHOP UPDATE **/
	
	public function edit_merchant_shop($storeid = "",$merchantid="")
	{ 
		$this->manage_merchant = "1";
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('mobile', 'required', array($this, 'validphone'))
						->add_rules('address1', 'required')
						->add_rules('address2', 'required')
						->add_rules('country', 'required')
						->add_rules('city', 'required')
						->add_rules('storename', 'required')
						->add_rules('zipcode', 'required', 'chars[a-zA-Z0-9.]')
						->add_rules('website', 'required','valid::url')
						->add_rules('latitude', 'required','chars[0-9.-]')
						->add_rules('longitude', 'required','chars[0-9.-]')
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
			if($post->validate()){
							
					$status = $this->merchant->edit_merchant_shop($storeid,arr::to_object($this->userpost));
					if($status > 0)
					{
						if($_FILES['image']['name'])
						{						
							$filename = upload::save('image'); 						
							$IMG_NAME = $merchantid."_".$storeid.'.png';
							common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
						    common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
							unlink($filename);
						}
						common::message(1, $this->Lang["MERCHANT_STORES_SET_SUC"]);
						url::redirect(PATH."admin/merchant-shop/".$merchantid.".html");
					}                                                               
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		
		$this->country_list = $this->merchant->getcountrylist();
	    $this->city_list = $this->merchant->getCityList();
		$this->user_data = $this->merchant->get_merchant_shop_data($storeid);
		if(count($this->user_data) == 0)
		{
		        common::message(-1, $this->Lang["STORE_CANT_EDIT"]);
			    url::redirect(PATH."admin/merchant-shop/".$merchantid.".html");
		}
		$this->template->title = $this->Lang["EDIT_STORES_MERCHANT"];
		$this->template->content = new View("admin_merchant/edit_merchant_shop");  
	}
	
	/** BLOCK AND UNBLOCK MERCHANT  SHOP **/
	
	public function block_merchant_shop($type = "", $storesid = "", $merchantid= "")
	{
		$status = $this->merchant->blockunblockmerchantshop($type, $storesid);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["MERCHANT_STORES_UNB"]);
			}
			else{
				common::message(1, $this->Lang["MERCHANT_STORES_B"]);
			}
		}
		else if($status == -1){
			common::message(-1, $this->Lang["MERCHANT_BLOCKED"]);
		}
		url::redirect(PATH."admin/merchant-shop/".$merchantid.".html");
	}
	
	/** MANAGE USER COMMENTS **/
	
	public function manage_users_comments($page = "")
	{		 
		$this->store_comments = 1;		
		$this->count_user = $this->merchant->get_users_comments_count($this->input->get('firstname'));
				$this->pagination = new Pagination(array(
				'base_url'       => 'admin/manage-store-comments.html/page/'.$page."/",
				'uri_segment'    => 4,
				'total_items'    => $this->count_user,
				'items_per_page' => 20, 
				'style'          => 'digg',
				'auto_hide'      => TRUE
				));
		$this->search = $this->input->get();
		$this->search_key = arr::to_object($this->search);
		$this->users_list = $this->merchant->get_users_comments_list($this->pagination->sql_offset, $this->pagination->items_per_page, $this->input->get('firstname'));
		
		$this->template->title = $this->Lang["USER_COMM"];
		$this->template->content = new View("admin_merchant/manage_users_comments");
	}
	
	/** UPDATE USER COMMENTS **/
	
	public function edit_users_comments($commentsid = "")
	{ 
		$this->store_comments = 1;
		if($_POST){
			$this->userpost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory($_POST)
						->add_rules('comments', 'required');
			if($post->validate()){
				$status = $this->merchant->edit_users_comments($commentsid, arr::to_object($this->userpost));
					if($status ==1){
                        common::message(1, $this->Lang["COMM_SET_SUC"]);
                        url::redirect(PATH.'admin/manage-store-comments.html');
                	}          
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		
		$this->users_comments_data = $this->merchant->get_users_comments_data($commentsid);	
			if(count($this->users_comments_data) == 0){
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
				url::redirect(PATH."admin/manage-store-commants.html");
			}
		$this->template->title = $this->Lang["COMM_MERCHANT"];
		$this->template->content = new View("admin_merchant/edit_users_comments");
	
	}
	
	/** BLOCK AND UNBLOCK USERCOMMENTS **/
	
	public function block_users_comments($type = "", $uid = "")
	{
		$status = $this->merchant->blockunblockusercomments($type, $uid);
		if($status == 1){
			if($type == 1){
				common::message(1, $this->Lang["COMM_UNB"]);
			}
			else{
				common::message(1, $this->Lang["COMM_B"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		url::redirect(PATH."admin/manage-store-comments.html");
	}

	/** DELETE USERCOMMENTS **/
	
	public function delete_users_comments($discussion_id = "")
	{ 
		$status = $this->merchant->deleteusercomments($discussion_id);
		if($status == 1){			
				common::message(1, $this->Lang["COMM_DEL"]);
			}			
		url::redirect(PATH."admin/manage-store-comments.html");
	}

	/** CHECK PASSWORD EXIST **/
	 
	public function check_password($password = "")
	{
		$exist = $this->merchant->exist_password($password, $this->user_id);
		return $exist;
	}
	
	/** CHECK EMAIL EXIST **/
	 
	public function email_available($email= "")
	{
		
		$exist = $this->merchant->exist_email($email);
		return ! $exist;
	}
	
	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
		
		
	        if(valid::numeric($phone)){
		        if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			        return 1;
		        }
		}
		return 0;
	}
	
	
	
	/** CHECK VALID COMMISSION OR NOT **/
	
	public function valid_commision($merchant_commission = "")
	{
		if($merchant_commission <= "100"){
			return 1;
		}
		return 0;
	}
	/** CITY SELECT SCRIPT  **/
			
	public function CityS($country = "")
	{
		if($country == -1){
			$list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td><td><label>:</label></td><td><select name="city">';
			$list .='<option value=" " >'.$this->Lang["CITY_FIRST"].'</option>';
			echo $list .='</select></td>';
		exit;
		}
		else{
		
		        $CitySlist = $this->merchant->get_city_by_country($country);
		        if(count($CitySlist) == 0){
		                $list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td><td><label>:</label></td><td><select name="city">';
			        $list .='<option value="">'.$this->Lang["NO_CITY"].'</option>';
			        echo $list .='</select></td>';
		                exit;
		        }
		        else{
		                foreach($CitySlist as $s) {	
		                if($s->city_id != 0)
		                {
		                $list = '<td><label>'.$this->Lang["SEL_CITY"].'*</label></td>
                                    <td><label>:</label></td>
                                    <td><select name="city">';
                                    
                                    } 
                                }
		                foreach($CitySlist as $s){
			
			                $list .='<option value="'.$s->city_id.'">'.ucfirst($s->city_name).'</option>';
		                }
		                echo $list .='</select></td>';
		                exit;
		          }
		}
	}
	
	/** SHOP RATING **/
	public function shop_rating($merchant_id = "", $rate = "")
	{
		$status = $this->merchant->update_shop_rating($merchant_id,$rate);
		echo $status;
		exit;
	}
	/** MERCHANT DETAILS **/
	
	public function merchant_details($id = "")
	{
		$this->manage_merchant = "1";

		$id = base64_decode($id);
		$this->shipping_data = $this->merchant->get_shipping_data($id);
		$this->merchant_details = $this->merchant->get_merchant_details($id);
		$this->store_details = $this->merchant->get_store_details($id);
		$this->template->title = $this->Lang["MERCHANT_DETAILS"];
		$this->template->content = new View("admin_merchant/merchant_details");
	}
	
	/** MERCHANT DASHBOARD LIST **/
	public function dashboard_merchant()
	{
		$this->dashboard_merchant = "1";

		$this->start_date = "";
		$this->end_date = "";

		if($_GET){
			$this->start_date = $this->input->get('start_date');
			$this->end_date = $this->input->get('end_date');
		}

	    $this->template->javascript .= html::script(array(PATH.'js/jquery-1.5.1.min.js', PATH.'js/jquery-ui-1.8.11.custom.min.js', PATH.'js/jquery-ui-timepicker-addon.js'));
	    $this->start_date = $this->input->get("start_date");
	    $this->end_date = $this->input->get("end_date");	   
		$this->template->style .= html::stylesheet(array(PATH.'css/datetime.css'));
		$this->user_list = $this->merchant->get_user_list();
		$this->stores_list = $this->merchant->getstoreslist();
		$this->admin_details = $this->merchant->get_admin_details_data();
		$this->admin_id = $this->admin_details->current()->user_id; 
		$this->template->content = new View("admin_merchant/merchant_dashboard");
		$this->template->title = $this->Lang["MERCHANT_DASHBOARD"];
	}

	public function approvedisapprove_merchant($type = "",$merchant_id="")
	{ 
	
		$status = $this->merchant->approvedisapprove_merchant($type,base64_decode($merchant_id));
		if($status == 1){
			$details = $this->merchant->get_merchant_details(base64_decode($merchant_id));
			if($type == 1){
				
				$from = CONTACT_EMAIL;
				$subject = SITENAME." - ".$this->Lang['MER_APP'];
				
				$merchant_message = "<p> <b>".$this->Lang['CONGRA']."! ".$this->Lang['YOUR_APP_MER']."  </b></p><p> ".$this->Lang['YOR_EMAIL']." : ".$details[0]->email."</p> <p>".$this->Lang['UR_DEAL_COMM']."  : ".$details[0]->merchant_commission." % <p/> <p> ".$this->Lang['LOGIN_URL']." :  <a href='".PATH."merchant-login.html' > Click here </a>";
				
				$this->name = ucfirst($details[0]->firstname)." ".$details[0]->lastname;
				$this->merchant_message = $merchant_message;
				$merchantmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");		
				if(EMAIL_TYPE==2){				
					email::smtp($from, $details[0]->email, $subject ,$merchantmessage);
				}
				else{
					email::sendgrid($from, $details[0]->email, $subject , $merchantmessage);
				}
				
				common::message(1, $this->Lang["COMM_DIS_SUCC"]);
			}
			else{
				$from = CONTACT_EMAIL;
				$subject = SITENAME." - ".$this->Lang['MER_DIS_APP'];
				$merchant_message = "<p> <b>".$this->Lang['YOUR_DIS_APP_MER']." </b></p><p> ".$this->Lang['YOR_EMAIL']." : ".$details[0]->email."</p>";
				
				$this->name = ucfirst($details[0]->firstname)." ".$details[0]->lastname;
				$this->merchant_message = $merchant_message;
				$merchantmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
				
				echo $merchantmessage; exit;
				
				if(EMAIL_TYPE==2){				
					email::smtp($from, $details[0]->email, $subject ,$merchantmessage);
				}
				else{
					email::sendgrid($from, $details[0]->email, $subject , $merchantmessage);
				}
				
				common::message(1, $this->Lang["COMM_APP_SUCC"]);
			}
		}
		else{
			common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
		}
		$lastsession = $this->session->get("lasturl");
		if($lastsession){
		url::redirect(PATH.$lastsession);
		} else {
		url::redirect(PATH."admin/merchant.html");
		}
		
	}
}
