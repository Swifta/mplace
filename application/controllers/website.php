<?php defined('SYSPATH') OR die('No direct access allowed.');
class Website_Controller extends Template_Controller 
{          
	public $template='themes/template';                 
	function __construct()
	{
		parent::__construct();
		$this->session = Session::instance();
		include Kohana::find_file('vendor/language/admin_language', DEFAULT_LANGUAGE);
		$this->Lang = $content_text;
		$this->template->title = $this->Lang["ADMIN_TITLE"];
		$this->template->content = "";
		
		$actual_link = $_SERVER['HTTP_HOST']; 
		$serverurl= $_SERVER['HTTP_HOST']; 
                if( $actual_link != $serverurl)
                {
                echo  DEFAULT_WEBSITE_MESSAGE;
                exit;
                }
                else
                {
                
		if(DEFAULT_LANGUAGE == "french" ){
			$this->template->style = html::stylesheet(array(PATH.'css/french_main.css'));
		} elseif(DEFAULT_LANGUAGE == "spanish"){
			$this->template->style = html::stylesheet(array(PATH.'css/spanish_main.css'));
		} else {
			$this->template->style = html::stylesheet(array(PATH.'css/main.css'));
		}
		$this->template->javascript = html::script(array(PATH.'js/jquery.js',PATH.'js/script.js'));
		$this->user_id = $this->session->get("user_id");
		$this->user_type = $this->session->get("user_type");
		$this->response = $this->session->get('Success');
		$this->session->delete('Success');
		$this->error_response = $this->session->get('Error');
		$this->session->delete('Error'); 
		$this->settings = new Settings_Model(); 
		$this->all_setting_module = $this->settings->get_setting_module_list();
	        foreach($this->all_setting_module as $setting){
                        $this->free_shipping_setting = $setting->free_shipping;
                        $this->flat_shipping_setting = $setting->flat_shipping;
                        $this->per_product_setting = $setting->per_product;
                        $this->per_quantity_setting = $setting->per_quantity;
                        $this->aramex_setting = $setting->aramex;
	        }
	        define('REQUEST_URL_COUNT', 1);
		$this->resize_setting = $this->settings->get_image_resize_data();
		foreach($this->resize_setting as $row) {
			if($row->type == 1){
				define('LOGO_WIDTH', $row->list_width);
				define('LOGO_HEIGHT', $row->list_height);
				define('FAVICON_WIDTH', $row->detail_width);		
				define('FAVICON_HEIGHT', $row->detail_height);
				define('CATEGORY_WIDTH', $row->thumb_width);		
				define('CATEGORY_HEIGHT', $row->thumb_height);
			}
			if($row->type == 2){
				define('DEAL_LIST_WIDTH', $row->list_width);
				define('DEAL_LIST_HEIGHT', $row->list_height);
				define('DEAL_DETAIL_WIDTH', $row->detail_width);		
				define('DEAL_DETAIL_HEIGHT', $row->detail_height);
				define('DEAL_THUMB_WIDTH', $row->thumb_width);
				define('DEAL_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 3){
				define('PRODUCT_LIST_WIDTH', $row->list_width);
				define('PRODUCT_LIST_HEIGHT', $row->list_height);
				define('PRODUCT_DETAIL_WIDTH', $row->detail_width);		
				define('PRODUCT_DETAIL_HEIGHT', $row->detail_height);
				define('PRODUCT_THUMB_WIDTH', $row->thumb_width);
				define('PRODUCT_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 4){
				define('AUCTION_LIST_WIDTH', $row->list_width);
				define('AUCTION_LIST_HEIGHT', $row->list_height);
				define('AUCTION_DETAIL_WIDTH', $row->detail_width);		
				define('AUCTION_DETAIL_HEIGHT', $row->detail_height);
				define('AUCTION_THUMB_WIDTH', $row->thumb_width);
				define('AUCTION_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 5){
				define('STORE_LIST_WIDTH', $row->list_width);
				define('STORE_LIST_HEIGHT', $row->list_height);
				define('STORE_DETAIL_WIDTH', $row->detail_width);		
				define('STORE_DETAIL_HEIGHT', $row->detail_height);
				define('STORE_THUMB_WIDTH', $row->thumb_width);
				define('STORE_THUMB_HEIGHT', $row->thumb_height);
			}
			if($row->type == 6){
				define('BANNER_WIDTH', $row->thumb_width);
				define('BANNER_HEIGHT', $row->thumb_height);
			}
                        if($row->type == 7){
				define('MAP_LIST_WIDTH', $row->list_width);
				define('MAP_LIST_HEIGHT', $row->list_height);
			}
		}
	}
	
	}
}
