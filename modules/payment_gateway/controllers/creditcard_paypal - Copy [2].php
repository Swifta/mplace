 /*-- MODULE X --*/
 
if($_POST){
		        $referral_amount = $this->input->post("p_referral_amount");
		        $this->userPost = $this->input->post();
		        $total_amount="";
		        $total_qty="";
		        $product_title="";
		        $produ_qty="";
		        $pay="";
		        $total_shipping="";
		        $total_pro_amount = "";
		        $i=0;
		foreach($_SESSION as $key=>$value){
                    if($value && (is_string($value)) && ($key=='product_cart_id'.$value)){
                    $deal_id = $_SESSION[$key];
                    $item_qty = $this->session->get('product_cart_qty'.$deal_id);
                    //$this->session->set('product_cart_qty'.$deal_id,$item_qty);
                    $amount = $this->input->post("amount");
			        $this->deals_payment_deatils = $this->creditcard_paypal_pay->get_product_payment_details($deal_id);
					
					
					if(count($this->deals_payment_deatils) == 0){
                        unset($_SESSION[$key]);
                        $this->session->delete('product_cart_qty'.$value);
                        $this->session->delete("count");
				        common::message(-1, $this->Lang["PAGE_NOT"]);
				        url::redirect(PATH."products.html");
			        }
			        foreach($this->deals_payment_deatils as $UL){
			            $purchase_qty = $UL->purchase_count;
				        $deal_title = $UL->deal_title;
				        $deal_key  = $UL->deal_key;
				        $url_title = $UL->url_title;
					$deal_value = $UL->deal_value;
					$merchant_id = $UL->merchant_id;
					$deal_value1 = common::currency_conversion(CURRENCY_CODE,"USD",$UL->deal_value);
					/// for Currency conversion  
				        $shipping_amount = $UL->shipping_amount;
				        $shipping_methods = $UL->shipping;
				        $product_amount = $UL->deal_value*$item_qty;
				        //$product_amount_org = common::currency_conversion(CURRENCY_CODE,"USD",$product_amount);
				        $product_amount_org = $deal_value1*$item_qty;
			        }
					
					
					
					
					
			        
			        $total_amount +=$product_amount;
			        $total_pro_amount +=$product_amount_org;
			        if($shipping_methods  == 1){
			        $total_shipping += 0;
			        }  elseif($shipping_methods  == 2){
			        $merchant_flat_amount = $this->creditcard_paypal_pay->get_userflat_amount($merchant_id);
			        $total_shipping += $merchant_flat_amount->flat_amount;
			        } elseif($shipping_methods  == 3){
			        $total_shipping +=$shipping_amount;
			        } elseif($shipping_methods  == 4){
			        $total_shipping +=$shipping_amount*$item_qty;
			        } elseif($shipping_methods  == 5){
			        $total_shipping += 0;
			        }

			        $total_qty += $item_qty;
			        $product_title .=$deal_title.",";
			        $produ_qty .=$item_qty.",";

			        if(CURRENCY_CODE !="USD"){    // for Currency conversion
						$deal_value = $deal_value1;
				}

			       $pay .="&L_PAYMENTREQUEST_0_NAME$i=".preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%-]/s", '', $deal_title)."&L_PAYMENTREQUEST_0_NUMBER$i=".$deal_key."&L_PAYMENTREQUEST_0_AMT$i=".$deal_value."&L_PAYMENTREQUEST_0_QTY$i=".$item_qty."&LOGOIMG=".PATH.'themes/'.THEME_NAME.'/images/logo.png';
				   
				   
				   
				   
				   
				   
				   

			        $i++;
			       }
				   
				   
				   
				   
				   
	            }

                  /* $currencyCodeType = CURRENCY_CODE;
                    $pay_amount1=0; // for total transaction amount for success page

                $total_tax = (TAX_PRECENTAGE_VALUE/100)*($total_amount+$total_shipping);
                $total_shipping_amount = $pay_amount1 = $total_amount+$total_shipping+$total_tax;

					if(CURRENCY_CODE !="USD"){ // for Currency conversion
						$total_shipping = common::currency_conversion(CURRENCY_CODE,"USD",$total_shipping);
						$total_tax = (TAX_PRECENTAGE_VALUE/100)*($total_pro_amount+$total_shipping);
						$total_tax = common::truncate_digits($total_tax); // Truncate and get only the two digits.
						$total_shipping_amount = $total_pro_amount+$total_shipping+$total_tax;
						$currencyCodeType = "USD";
					}

                                        $to_pay ="&PAYMENTREQUEST_0_SHIPPINGAMT=".$total_shipping."&PAYMENTREQUEST_0_TAXAMT=".$total_tax."&PAYMENTREQUEST_0_ITEMAMT=".$total_pro_amount."&PAYMENTREQUEST_0_AMT=".$total_shipping_amount;
                                        $friend_name = $this->input->post("friend_name");
                                        $friend_email = $this->input->post("friend_email");
                                        $friend_gift_status = $this->input->post("friend_gift");
                                        $userPost_status = arr::to_object($this->userPost);
                                        $captured =0;
										
										
									
										
		        $deal_custom_details = $deal_id."--".$referral_amount."--".$total_qty."--".$purchase_qty."--".$captured."--".$friend_name."--".$friend_email."--".$friend_gift_status;
				
				
				
		       
			    $returnURL = urlencode(PATH."creditcard_paypal/authorize/".$deal_id."/".$friend_name."/".$friend_email."/".$friend_gift_status."/".$userPost_status->adderss1."/".$userPost_status->address2."/".$userPost_status->state."/".$userPost_status->city."/".$userPost_status->country."/".$userPost_status->shipping_name."/".$userPost_status->postal_code."/".$userPost_status->phone."/".$pay_amount1."/");
				
				
				
		        $cancelURL = urlencode(PATH."cart_checkout.html");

		        $paymentType = "Sale";
		       $nvpstr="&METHOD=".'SetExpressCheckout'."&RETURNURL=".$returnURL."&CANCELURL=".$cancelURL."&PAYMENTREQUEST_0_PAYMENTACTION=".$paymentType.$pay.$to_pay."&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCodeType;*/
			   
			   
			   
			   
      			//$resArray = $this->hash_call("SetExpressCheckout",$nvpstr);
				
				

		       /* $ack = strtoupper($resArray["ACK"]);
	            if($ack == "SUCCESS" || $ack == 'SUCCESSWITHWARNING'){
		            $this->session->set("IS_authorize", 1);
		            url::redirect($this->Paypal_Url.urldecode($resArray["TOKEN"]));
	            }
	            else{
		            common::message(-1, $this->Lang["PLES_TRY_SOMETIMES"]);
		            url::redirect(PATH."cart.html");
	            }*/

               /// $this->referral_amount_payment_deatils = $this->creditcard_paypal_pay->products_referral_amount_payment_deatils($referral_amount);
				
                common::message(1, $this->Lang["THANK_FOR_PURCH"]);
                url::redirect(PATH."payment_product/cart_order_complete.html");
	       }
	       else{

			common::message(-1, $this->Lang["PAGE_NOT"]);
		}
        
        
        
	
        
        
        /*<!-- MODULE X END-->*/
		 ////