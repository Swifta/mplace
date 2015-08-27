<?php defined('SYSPATH') OR die('No direct access allowed.');
class Creditcard_paypal_Controller extends Layout_Controller
{
	const ALLOW_PRODUCTION = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->paypal = new Paypal_Model;
		$this->creditcard_paypal_pay = new Creditcard_paypal_Model;
		foreach($this->generalSettings as $s){
			$this->Api_Username = $s->paypal_account_id;
			$this->Api_Password = $s->paypal_api_password;
			$this->Api_Signature = $s->paypal_api_signature;

			$this->Live_Mode = $s->paypal_payment_mode;
			$this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
			$this->Paypal_Url = "https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=";

			if($this->Live_Mode == 1){
				$this->API_Endpoint = "https://api-3t.paypal.com/nvp";
				$this->Paypal_Url = "https://www.paypal.com/webscr&cmd=_express-checkout&token=";
			}
		}
		$this->Api_Version = "76.0";
		$this->Api_Subject = $this->AUTH_token = $this->AUTH_signature = $this->AUTH_timestamp = '';
	}

	/** Paypal Payment - Express check out **/
	public function expresscheckout()
	{
		echo "program is here";
	   //	url::redirect(PATH."payment_product/problem_payment_paypal.html");
	}
}
