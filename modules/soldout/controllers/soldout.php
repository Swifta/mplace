<?php defined('SYSPATH') OR die('No direct access allowed.');
class Soldout_Controller extends Layout_Controller
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
		$this->is_soldout = 1;
		$this->sold = new Soldout_Model();
		if(!$this->past_deal_setting){
		        url::redirect(PATH);
		}
	}
	
	/* ALL SOLDOUT */
	public function all_soldout($cityid="")
	{
		$cityid = $this->session->get('CityID');
		
		$this->get_sold_deals = $this->sold->get_solddeals_list($cityid);
		$this->get_sold_products = $this->sold->get_soldproducts_list($cityid);
		$this->get_sold_auction = $this->sold->get_soldauction_list($cityid);
		
		//$this->get_city = $this->home->get_all_city_list();
		//$this->products_details = $this->home->products_details($cityid);		
		//$this->deals_details = $this->home->deals_details($cityid);
		$this->template->title = $this->Lang['SOLD_OUT2']." | ".SITENAME;
		$this->template->content = new View("themes/".THEME_NAME."/soldout/all_soldout");
		
			
	}
	
	
}
