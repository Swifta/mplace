<?php defined('SYSPATH') OR die('No direct access allowed.');
class Seller_Controller extends Layout_Controller {

	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
			$this->seller = new Seller_Model();
	        $this->UserID = $this->session->get("UserID");
	       if(LANGUAGE == "french" ){
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/french_style.css',PATH.'themes/'.THEME_NAME.'/css/fr_multi_style.css')); 
		} else if(LANGUAGE == "spanish") {
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/spanish_style.css',PATH.'themes/'.THEME_NAME.'/css/sp_multi_style.css'));
		}
		else{
			$this->template->style .= html::stylesheet(array(PATH.'themes/'.THEME_NAME.'/css/style.css',PATH.'themes/'.THEME_NAME.'/css/multi_style.css'));
		}
	        $this->is_seller = 1;
	        $this->seller_signup = 0;
	}
	
	/** SELLER  SIGNUP STEP 1 **/

	public function seller_signup_step1()
	{
		$this->template->title = $this->Lang['MER_SIGN_1'];
		$this->template->content = new View("themes/".THEME_NAME."/seller/seller_signup_step1");
		
	}

	/** SELLER  SIGNUP STEP 2 **/

	public function seller_signup_step2()
	{
			if($_POST){ 
			$this->userPost = $this->input->post();
			$post = new Validation($_POST);
			$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('firstname', 'required')
						->add_rules('mr_mobile', 'required',array($this, 'validphone'), 'chars[0-9-+(). ]')
						->add_rules('mr_address1', 'required')
						->add_rules('mr_address2', 'required')
						->add_rules('lastname', 'required')
						->add_rules('payment_acc', 'required','valid::email')
						->add_rules('email', 'required','valid::email',array($this, 'email_available'));
						//->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
	
					if($post->validate())
					{
					
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
                                                
						 $this->session->set(array("firstname" => $post->firstname,"lastname" => $post->lastname, 'mraddress1' => $post->mr_address1, 'mraddress2' => $post->mr_address2, 'mphone_number' => $post->mr_mobile,"memail"=>$post->email,"payment_acc" => $post->payment_acc,"free" => $free,"flat" => $flat, "product" => $product,'quantity' => $quantity, 'aramex' => $aramex));

							common::message(1, $this->Lang['SUCC_COM_STEP2']);
							url::redirect(PATH."merchant-signup-step3.html");
							
					} else {
							$this->form_error = error::_error($post->errors());	
					}
			}
		        $this->all_setting_module = $this->seller->get_setting_module_list();
		        foreach($this->all_setting_module as $setting){
                                $this->free_shipping_setting = $setting->free_shipping;
                                $this->flat_shipping_setting = $setting->flat_shipping;
                                $this->per_product_setting = $setting->per_product;
                                $this->per_quantity_setting = $setting->per_quantity;
                                $this->aramex_setting = $setting->aramex;
		        }
		$this->template->title = $this->Lang['MER_SIGN_2'];
		$this->template->content = new View("themes/".THEME_NAME."/seller/seller_signup_step2");
		
	}
	
	/** SELLER  SIGNUP STEP 3 **/

	public function seller_signup_step3($seller_id = "")
	{ 
		if(($this->session->get('firstname') != "") && ($this->session->get('memail') != "") && ($this->session->get('payment_acc') != "")){
			if($_POST){ 
				$this->userPost = $this->input->post();
				$post = new Validation($_POST);
				$post = Validation::factory(array_merge($_POST,$_FILES))
							->add_rules('city', 'required')
							->add_rules('mobile', 'required', array($this, 'validphone'), 'chars[0-9-+(). ]')
							->add_rules('address1', 'required')
							->add_rules('address2', 'required')
							->add_rules('storename', 'required')
							->add_rules('zipcode', 'required', 'chars[0-9.]')
							->add_rules('website','valid::url')
							->add_rules('latitude', 'required','chars[0-9.-]')
							->add_rules('longitude', 'required','chars[0-9.-]')
							->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
						if($post->validate())
						{
							$store_key = text::random($type = 'alnum', $length = 8);
							$password = text::random($type = 'alnum', $length = 8);
							 $status = $this->seller->add_merchant(arr::to_object($this->userPost),$store_key,$password); 
								if($status){
									$to=($status['email'])?$status['email']:CONTACT_EMAIL;
										$from = CONTACT_EMAIL;
                                                                                $this->country_list = $this->seller->getcountrylist();
                                                                                $country_name = "";
                                                                                $city_name = ""; 
                                                                                foreach($this->country_list as $count){
                                                                                        if($count->country_id == $post->country ){
                                                                                                $city_list = $this->seller->get_city_by_country($post->country);
                                                                                                $city_name = $city_list->current()->city_name;
                                                                                                $country_name = $count->country_name;
                                                                                        }
                                                                                }
                                                                                    
										/** for send mail to the admin  **/
										$subject=$this->Lang['NEW_MERCHANT_ADD']." ".SITENAME;
										$admin_message = "<p><b>".$this->Lang['NEW_MERCHANT_ADD']." ".SITENAME."  </b></p><p></p><p> ".$this->Lang['EMAIL1']." : ".$this->session->get('memail')."</p> <p>".$this->Lang['STORE_NAME']." : ".$post->storename."<p/><p>".$this->Lang['SHOP_ADDR']."   : ".$post->address1.",".$post->address2." <p/><p>".$this->Lang['CITY']."   : ".$city_name." <p/><p>".$this->Lang['COUNTRY']."   : ".$country_name." <p/><p>".$this->Lang['ZIP_CODE']."   : ".$post->zipcode." <p/><p>".$this->Lang['SHOP_WEB']."  : ".$post->website." <p/>";

										/** for send mail to the merchant  **/
										$merchant_subject = SITENAME." - ".$this->Lang['MERCHANT_ADD_SUC'];
										$merchant_message = "<p><b>".$this->Lang['MERCHANT_ADD_SUC']." </b> </p><p></p><p> ".$this->Lang['YOR_EMAIL']." : ".$this->session->get('memail')."</p> <p>".$this->Lang['YOUR_PASS'].": ".$password."</p> <p>".$this->Lang['YOUR_SHOP_NAM']." : ".$post->storename."<p/><p>".$this->Lang['SHOP_ADDR']."   : ".$post->address1.",".$post->address2." <p/><p>".$this->Lang['CITY']."   : ".$city_name." <p/><p>".$this->Lang['COUNTRY']."   : ".$country_name." <p/><p>".$this->Lang['ZIP_CODE']."   : ".$post->zipcode." <p/><p>".$this->Lang['SHOP_WEB']."  : ".$post->website." <p/>";
										
										$this->adminname = $this->Lang['ADMIN'];
										$this->admin_message = $admin_message;
										
										$this->name = ucfirst($this->session->get('firstname'))." ".$this->session->get('lastname');
										$this->merchant_message = $merchant_message;
										
										$adminmessage = new View("themes/".THEME_NAME."/merchant_signup_admin_mail_template");
										$merchantmessage = new View("themes/".THEME_NAME."/merchant_signup_mail_template");
										
										//echo $adminmessage; echo "<br> <br> <br>"; echo $merchantmessage; exit;
										if($_FILES['image']['name']){
											$filename = upload::save('image'); 						
											$IMG_NAME = $status['image'].'.png';						
											common::image($filename, STORE_DETAIL_WIDTH, STORE_DETAIL_HEIGHT, DOCROOT.'images/merchant/600_370/'.$IMG_NAME);
											common::image($filename, STORE_LIST_WIDTH, STORE_LIST_HEIGHT, DOCROOT.'images/merchant/290_215/'.$IMG_NAME);
											unlink($filename);
										}

										if(EMAIL_TYPE==2){	
										
										
											if(email::smtp($from, $to, $subject , $adminmessage))
												
											
											if(email::smtp($from, $this->session->get('memail'), $merchant_subject , "<p>".SITENAME ." - ".$this->Lang['CRT_MER_ACC']."</p>".$merchantmessage)){
												
												common::message(1, "Thanks for registration. Please check your email for your login password.");	
											}
											
											
										}
										else{
											email::sendgrid($from, $to, $subject , $adminmessage);
											email::sendgrid($from, $this->session->get('memail'), $merchant_subject , "<p>".SITENAME ." - ".$this->Lang['CRT_MER_ACC']."</p>".$merchantmessage);
										}
										
										//  unset the merchant session for next merchant
										$this->session->delete('firstname');
										$this->session->delete('lastname');
										$this->session->delete('memail');
										$this->session->delete('mraddress1');
										$this->session->delete('mraddress2');
										$this->session->delete('mphone_number');
										$this->session->delete('payment_acc'); 
										common::message(1, $this->Lang['SUCC_COM_FINAL']);
											url::redirect(PATH);
											
											
								}
								
								
								else{
									common::message(-1, $this->Lang['PLZ_TRY_ONS']);
									url::redirect(PATH);
								}
						}else{
								$this->form_error = error::_error($post->errors());	
						}
				
			}
			$this->country_list = $this->seller->getcountrylist();
			$this->template->title = $this->Lang['MER_SIGN_3'];
			$this->template->content = new View("themes/".THEME_NAME."/seller/seller_signup_step3");
		}
		else{
			 common::message(1, $this->Lang['PLZ_CORR_FILL']);
			 url::redirect(PATH."merchant-signup-step2.html");
		}
		
	}
	
	
	
	/** CHECK VALID PHONE OR NOT **/
	
	public function validphone($phone = "")
	{
		if(valid::phone($phone,array(7,10,11,12,13,14)) == TRUE){
			return 1;
		}
		return 0;
	}
	
	/** CHECK EMAIL EXIST **/
	 
	public function email_available($email= "")
	{
		$exist = $this->seller->exist_email($email);
		return ! $exist;
	}

}
