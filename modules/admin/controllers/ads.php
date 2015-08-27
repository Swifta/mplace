<?php defined('SYSPATH') OR die('No direct access allowed.');
class Ads_Controller extends website_Controller 
{
	const ALLOW_PRODUCTION = FALSE;
	public $template = 'admin_template/template';
	public function __construct()
	{
		parent::__construct();
		if((!$this->user_id || $this->user_type != 1) && $this->uri->last_segment() != "admin-login.html"){
			url::redirect(PATH);
		} 
		$this->ads = new Ads_Model();
		$this->ads_act = "1";
	}
		
	/* INSERT NEW ADS */
	
	public function add_adds()
	{
		if($_POST){
			
			$this->AddPost = $this->input->post();
			$post = Validation::factory(array_merge($_POST,$_FILES))
				->pre_filter('trim')
				->add_rules('ads_position', 'required')
				->add_rules('pages','required',array($this,'position_exist'))
				->add_rules('add_title', 'required','chars[a-zA-Z0-9 \,.&_-]')
				->add_rules('redirect_url','required', 'valid::url')
				->add_rules('image', 'upload::required','upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
				//->add_rules('add_code','required');
				
			if($post->validate()){ 
				//$addCode = $this->input->raw("post",'add_code');
				//$addCode = stripslashes($addCode);
				$addtitle = $this->AddPost["add_title"];
				$position = $this->AddPost["ads_position"];
				$page_position = $this->AddPost["pages"];
				$redirect_url = $this->AddPost["redirect_url"];	
				$status = $this->ads->add_ads($addtitle,$position,$page_position,$redirect_url);
				if($status){ 
					$filename = upload::save('image');
						$IMG_NAME =$status.".png";	
						if($position =="th") {
							common::image($filename, 775, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
						
						}elseif($position =="ls") {
							common::image($filename, 180, 500, DOCROOT.'images/ad_image/'.$IMG_NAME);
						
						}elseif($position =="bf") {
							common::image($filename, 790, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
						
						}elseif($position =="hr") {
							common::image($filename, 350, 250, DOCROOT.'images/ad_image/'.$IMG_NAME);
						
						}
						unlink($filename);
						common::message(1,$this->Lang["ADDS_ADD_SUC"]);
						url::redirect(PATH."adds_mgmt/manage_adds.html");
					}
					else{
						common::message(1, "Error Please try again");
						url::redirect(PATH."admin/add-banner-image.html");		
					}
			
			}
			else{
				$this->form_error = error::_error($post->errors());
			}
		}
		$this->template->title = $this->Lang["ADDS_ADD_PAGE"]." | ".SITENAME;
		$this->template->content = new View("adds_mgt/add_adds");
	}
	
	/* MANAGE ADS  */
	
	public function view_adds()
	{
		$this->ad_details=$this->ads->manage_ad();
		$this->template->title=$this->Lang["MANAGE_ADD_PAGE"]." | ".SITENAME;
		$this->template->content=new View("adds_mgt/manage_adds");
	}

	/* CHECK ADD IS EXIST*/
	
	public function position_exist($page_position = "")
	{
		$ads_position=$this->input->post('ads_position');
		
		$exist = $this->ads->position_exist($page_position,$ads_position);
		
		return ! $exist;
	}

	/* EDIT ADS */
	
	public function edit_ads($id = "")
	{ 
		$get_code = explode("_", $id);
		$id = $get_code[0];
		$position = $get_code[1];
		$pg_position = $get_code[2];
		
			if($_POST){ 
				$this->AddPost = $this->input->post();
				//$addCode = $this->input->raw("post",'ad_code');
				//$addCode = stripslashes($addCode);
				$addtitle = $this->AddPost["ad_title"];
				$new_position = $this->AddPost["ads_position"];
				$page_position = $this->AddPost["pages"];
				$redirect_url = $this->AddPost["redirect_url"];	
				
				$post = Validation::factory(array_merge($_POST,$_FILES))
						->add_rules('ads_position', 'required')
						->add_rules('pages','required')
						->add_rules('ad_title', 'required','chars[a-zA-Z0-9 \,.&_-]')
						->add_rules('redirect_url','required', 'valid::url')
						->add_rules('image','upload::valid', 'upload::type[gif,jpg,png,jpeg]', 'upload::size[1M]');
												
				if($post->validate()){
					$status=$this->ads->ad_update($addtitle,$position,$pg_position,$page_position,$redirect_url,$new_position,$id);
					
					if($status == 9){
						common::message(-1,$this->Lang["ADD_POS_EXIST"]);
					}
					else{ 
						if($_FILES['image']['name']) { 
							
							$filename = upload::save('image');
							$IMG_NAME =$status.".png";	
							if($new_position =="th") {
								common::image($filename, 775, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
							
							}elseif($new_position =="ls") {
								common::image($filename, 170, 500, DOCROOT.'images/ad_image/'.$IMG_NAME);
							
							}elseif($new_position =="bf") {
								common::image($filename, 800, 100, DOCROOT.'images/ad_image/'.$IMG_NAME);
							
							}elseif($position =="hr") {
							common::image($filename, 350, 250, DOCROOT.'images/ad_image/'.$IMG_NAME);
						
						}
							unlink($filename); 
						
					} 
								
						common::message(1,$this->Lang["UPD_ADD_SUC"]);
					}
					url::redirect(PATH."adds_mgmt/manage_adds.html");
				}
				else{
					$this->form_error = error::_error($post->errors());
				}
			}
		$this->get_record = $this->ads->get_one_record($id, $position);
		if(count($this->get_record)== 0){
			common::message(1,$this->Lang["RECORD_NOT"]);
			url::redirect(PATH."adds_mgmt/manage_adds.html");
		}
		$this->template->content= new View("adds_mgt/edit_ads");
	}	
	
	/* BLOCK AND UNBLOCK ADS */

	public function block_ads($type = "", $id = "")
	{
	
                if($id){
                        $status = $this->ads->blockunblock_Ad($type, $id);
                        if($status == 1){
                                if($type == 1){
                                        common::message(1, $this->Lang["AD_UNB_SUC"]);
                                }
                                else{
                                        common::message(1, $this->Lang["AD_BL_SUC"]);
                                }
                        }
                        else{
                                common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
                        }
                }
                url::redirect(PATH."adds_mgmt/manage_adds.html");
	}

	/* DELETE ADS */

	public function delete_ads($id = "")
	{
		$status = $this->ads->delete_ads($id);
		if($status == 1){
				common::message(1, $this->Lang["ADD_DEL_SUC"]);
			}
			else{
				common::message(-1, $this->Lang["NO_RECORD_FOUND"]);
			}		
		url::redirect(PATH."adds_mgmt/manage_adds.html");
	}
}


