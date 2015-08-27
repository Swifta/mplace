<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php 

print_r($this->paypal_setting);
print_r($this->Lang['TX_AMT']);
echo TAX_PRECENTAGE_VALUE;
echo $this->Lang['TOT_AMT'];
echo $this->Lang['TX'];
echo PATH;

echo $this->Lang['HOME'];
echo $this->Lang['PRODUCT_DET'];


 $total_amount = "0";
                                $shippingamount = "0";
                                $flatamount = "0";
                                $per_productshipping = "0";
                                $add_productshipping = "0";
                                $itemshippingamount = "0";
                                $taxamount = "0";
                                $productbasedamount = "0";
                                $display_headerport = "0";
                                if ($this->shipping_setting == 3) {
                                    foreach ($_SESSION as $key => $value) {
                                        if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                            $this->products = new Products_Model();
                                            $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                            foreach ($this->get_cart_products as $products) {
                                                $display_headerport = "1";
                                                $per_productshipping += $products->shipping_amount;
                                                $add_productshipping .= number_format((float) $products->shipping_amount, 2, '.', '') . " + <br> ";
                                            }
                                        }
										
										echo $add_productshipping;
									echo $this->Lang['SHIP_AMOU']; 
									
									echo number_format((float) $per_productshipping, 2, '.', '');
									
									}
                                }    
								
								if($display_headerport == 1) {
									
									echo $this->Lang['IMAGE'];
									
									if ($this->shipping_setting != 4) {
										
										}
										
										 echo $this->Lang['DESC'];
										 
										 echo $this->Lang['QUAN'];
										 
										 echo $this->Lang['PRI'];
										 
										 echo $this->Lang['SHIP_ING'];
										 
										 echo $this->Lang['TOTAL'];
										 
										 }
										 
										 $totshoppamount = "0";
                                foreach ($_SESSION as $key => $value) {
                                    if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                        $this->products = new Products_Model();
                                        $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                        foreach ($this->get_cart_products as $products) {
                                            $get_size_name = $this->products->get_size_data($products->deal_id);
                                            $get_color_data = $this->products->get_color_data($products->deal_id);
                                            $taxamount = TAX_PRECENTAGE_VALUE;
                                            
                                            
                                            /* 1- Free Shipping ,  2- Flat Shipping, 3- Per Product Shipping , 4- Per Item Shipping */
                                            /*if ($products->shipping == 1) {
                                                $shippingamount = 0;
                                            } elseif ($products->shipping == 2) {
                                                $shippingamount = 0;
                                                $flatamount = FLAT_SHIPPING_AMOUNT;
                                            } elseif ($products->shipping == 3) {
                                                $shippingamount = 0;
                                                $flatamount = $products->shipping_amount;
                                            } elseif ($products->shipping == 4) {
                                                $itemshippingamount = $products->shipping_amount;
                                                $shippingamount = $products->shipping_amount;
                                            } */ 
                                            
                                            if ($products->shipping == 1) {
                                                $shippingamount = 0;
                                                $totshoppamount = "0";
                                            } elseif ($products->shipping == 2) {
                                                $get_merchantdetails = $this->products->get_userflat_amount($products->merchant_id);
                                                $shippingamount = $get_merchantdetails->flat_amount;
                                                $totshoppamount += $shippingamount;
                                                $flatamount = $shippingamount;
                                            } elseif ($products->shipping == 3) {
                                                $shippingamount = $products->shipping_amount;
                                                 $totshoppamount += $shippingamount;
                                                 $flatamount = $products->shipping_amount;
                                                  $productbasedamount = $products->shipping_amount;
                                            } elseif ($products->shipping == 4) {
                                                $shippingamount = $products->shipping_amount;
                                                $itemshippingamount = $products->shipping_amount;
                                                $totshoppamount += $shippingamount;
                                            } elseif ($products->shipping == 5) {
                                                $shippingamount = 0;
                                                $totshoppamount = "0";
                                            } 
											
											if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { 
											
											echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html';
											echo $products->deal_title; 
											echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png'; 
											
											echo $products->deal_title;
											echo $products->deal_title; 
											
											} else {
												
												echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; 
												
												echo $products->deal_title;
												
												echo PATH; ?>themes/<?php echo THEME_NAME;
												
												echo $products->deal_title;
												
												echo $products->deal_title;
												
												}
												
												if ($this->shipping_setting != 4) {
													 }
													 
													 echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; 
													 
													 echo ucfirst($products->deal_title);
													 
													 echo substr(strip_tags($products->deal_description), 0, 50);
													 
													 if ($products->shipping == 1) {
														 echo $this->Lang['FREE_SHIPP_PROD']; 
														  }
										if ($products->shipping == 2) {
											 echo $this->Lang['FLAT_SHIPP_T_PRO'];
											  } 
											  
											  /*
											  
											  SKIPPED SLOT
											  */
										}}}
										
										if ($total_amount != 0) {
											
											echo PATH;
											
											echo $this->Lang['CONTINUE_SHOPPING']; 
											
											echo $this->Lang['TOTAL'];
											
											echo CURRENCY_SYMBOL;
											
											echo number_format((float) $total_amount, 2, '.', ''); 
											
											}
											
											if ($total_amount == 0) { 
											
											echo $this->Lang['YOUR_SHOPPING_BAG']; 
											
											echo $this->Lang['YOUR_SHOP_CART_EMP'];
											
											echo PATH ?>products.html"><?php echo $this->Lang['CONTINUE_SHOPPING']; 
											
											echo PATH; ?>themes/<?php echo THEME_NAME; 
											
											}
											
											echo $this->Lang['SHIP_ADD']; 
											
											if (count($this->shipping_address) > 0) { 
											
											echo $this->Lang['EDIT']; ?>" class="saddress_edit"><?php echo $this->Lang['EDIT']; 
											
											 } else { 
											 
											 echo PATH; 
											 echo $this->Lang['ADD']; 
											 
											  echo $this->Lang['ADD']; 
											  
											   }
											   
											   if (count($this->shipping_address) > 0) { 
											   
											   common::shipping_address(); 
											   
											    } 
												
												foreach($this->shipping_address as $s) {
													
													echo $this->Lang['SHIP_ADDR'];
													echo $this->Lang['NAME']; 
													
													echo $this->Lang['ENTER_NAME'];
													
													echo $s->ship_name;
													
													 echo $this->Lang['ADDR1'];
													 
													 echo $s->ship_address1;
													 
													 echo $this->Lang['ADDR2'];
													 
													  echo $this->Lang['ENTER_ADD']; 
													  
													   echo $s->ship_address2; 
													   
													   echo $this->Lang['COUNTRY'];
													   
													   foreach ($this->all_country_list as $countryL) { 
													   
													   if ($countryL->country_id == $s->ship_country) {
                                                                                echo 'Selected="true"';
                                                                                }
																				
																				echo $countryL->country_id;
																				echo ucfirst($countryL->country_name); 
													   }
													   
													    echo $this->Lang['SEL_CITY'];
														
												foreach ($this->all_city_list as $CityL) {
													
													 if ($CityL->country_id == $s->ship_country) {
														 
														 if ($CityL->city_id == $s->ship_city) { echo 'Selected="true"';  } 
														 
														 echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); 
														 
														 } } 
														 
														  echo $this->Lang['STATE']; 
														  
														  echo $this->Lang['ENTER_STATE']; 
														  
														  echo $s->ship_state; 
														  
														  echo $this->Lang['POSTAL_CODE']; 
														  
														   echo $this->Lang['ENTER_POSTAL_CODE'];
														   
														   echo $s->ship_zipcode; 
														   
														   echo $this->Lang['PHONE']; 
														   
														   echo $this->Lang['ENTER_PHONE'];
														   
														    echo $s->ship_mobileno; 
															
															 }
															 
															 if ($total_amount != 0) {
																 
																 echo $this->Lang['SHIPPING_INFO']; 
																 
																  echo new View("themes/" . THEME_NAME . "/paypal/shipping_address"); 
																  
																  } 


?>
