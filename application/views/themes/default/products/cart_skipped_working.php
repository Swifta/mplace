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
                                            if ($products->shipping == 1) {
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
                                            } 
                                            
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

  
  
  
  <?php if ($products->shipping == 3) { ?>
   <p>( <?php echo $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP']; ?> )</p>							
 <?php } ?>
 
 
 
                                                                <?php if ($products->shipping == 4) { ?>
                                                                <p>( <?php echo $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU']; ?>) 
                                                                </p>							
                                                                <?php } ?>
                                                                <?php if ($products->shipping == 5) { ?>
                                                                <p><font color="red">( <?php echo $this->Lang['ARAMEX_SHIPP_PROD']; ?> )</font></p>	
                                                                			
                                                                <?php } ?>
                                                        </div> 
                                                </td>
                                                
                                                 <td align="center">
                                                <?php
                                                    $nosize = "";
                                                    $size_count = "";
                                                    if (count($get_size_name) > 0) {
                                                        foreach ($get_size_name as $gs) {
                                                                if ($gs->size_name == "None") {
                                                                        $nosize = 1;
                                                                        $this->session->set('product_quantity_qty' . $products->deal_id, $gs->quantity);
                                                                        $size_count = $get_size_name[0]->quantity;
                                                                } else {
                                                                if ($gs->size_id == $this->session->get('product_size_qty' . $products->deal_id)) {
                                                                        $this->session->set('product_quantity_qty' . $products->deal_id, $gs->quantity);
                                                                        $size_count = $gs->quantity;
                                                                }
                                                            }
                                                        }
                                                    } 
                                                    ?>
                                                    
                                                    
                                                    
                                                     <?php if ($size_count > 1) {  ?>
                                      
                                        <div class="lessthen">
                                        <a class="less_min" id="QtyDown" onclick="<?php echo $key; ?>1()">-</a>
                                        </div>
                                        <?php } ?>
                                        <div class="lessthen1">
                                        <input name="QTY" id="<?php echo $key; ?>" value="1" readonly="readonly" type="text" rel="20">
                                        </div>
                                        <?php  if ($size_count > 1) {  ?>
                                        <div class="greaterthen">
                                        <a class="plus" id="QtyUp" onclick="<?php echo $key; ?>()">+</a>
                                        </div>
                                         <?php } ?>
                                        </div>
                                        </td>
                                        <td>X </td>	
                                        <td><?php echo CURRENCY_SYMBOL . $products->deal_value; ?></td>
                                        <td>+</td>	   
                                                <?php if ($products->shipping == 1) { ?>
                                                <td><span><?php echo $this->Lang['FREE']; ?></span></td>						
                                                <?php } ?>
                                                <?php if ($products->shipping == 2) { 
                                                $get_merchantdetails = $this->products->get_userflat_amount($products->merchant_id);
                                                $shippingamount = $get_merchantdetails->flat_amount;                                                 
                                                ?>                                                               
                                                <td><span><?php echo CURRENCY_SYMBOL; ?><?php echo number_format((float) $shippingamount, 2, '.', ''); ?></span></td>							
                                                <?php } ?>
                                                <?php if ($products->shipping == 3) { ?>
                                                <td><span><?php echo CURRENCY_SYMBOL; ?><?php echo number_format((float) $products->shipping_amount, 2, '.', ''); ?></span></td>							
                                                <?php } ?>
                                                <?php if ($products->shipping == 4) { ?>
                                                <td><span><?php echo CURRENCY_SYMBOL; ?><span id="<?php echo $key; ?>amount_shipping"><?php echo number_format((float) $products->shipping_amount, 2, '.', ''); ?></span></span>
                                                </td>							
                                                <?php } ?>
                                                <?php if ($products->shipping == 5) {  $calculshippingamount = ""; ?>
                                                 <td><span><?php echo $this->Lang['ARAMEX_COST']; ?></span></td>
                                                							
                                                <?php } ?>
                                                
                                                
                                                
                                                 <td>=<?php $product_quantity = $this->session->get('product_quantity_qty' . $products->deal_id); ?></td>
                                            <script>
                                                function <?php echo $key; ?>()
                                                {
                                                    if($('#<?php echo $key; ?>').val()!=<?php echo $size_count; ?>) {
                                                        var plus_amount = parseInt($('#<?php echo $key; ?>').val()) + 1;
                                                        $('#RE_QTY_VAL').val(plus_amount);
                                                        $('#PC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#PCC_QTY_VAL<?php echo $key; ?>').val(plus_amount); 
                                                        $('#COD_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#APCC_QTY_VAL<?php echo $key; ?>').val(plus_amount); 
                                                        $('#PRO_REFERRAL').val('0');
                                                        $('#PC_REFERRAL').val('0');
                                                        $('#COD_REFERRAL').val('0');
                                                        if(plus_amount!="0"){
                                                            $('#<?php echo $key; ?>').val(plus_amount); 
                                                        }
                                                         <?php if ($products->shipping == 1) { ?>
                                                          var total_amount = ((<?php echo $products->deal_value; ?>)*plus_amount);
                                                         <?php } if ($products->shipping == 2) { ?>
                                                          var total_amount = ((<?php echo $flatamount; ?>)) + ((<?php echo $products->deal_value; ?>)*plus_amount);
                                                         <?php } if ($products->shipping == 3) { ?>
                                                         var total_amount = ((<?php echo $productbasedamount; ?>)) + ((<?php echo $products->deal_value; ?>)*plus_amount);
                                                         <?php } if ($products->shipping == 4) { ?>
                                                        var total_amount = ((<?php echo $itemshippingamount; ?>)*plus_amount) + ((<?php echo $products->deal_value; ?>)*plus_amount);
                                                        <?php } if ($products->shipping == 5) { ?>
                                                         var total_amount = ((<?php echo $products->deal_value; ?>)*plus_amount);
                                                        <?php } ?>
                                                        var total_shipp = ((<?php echo $shippingamount; ?>)*plus_amount);
                                                        var keyamountshipping = total_shipp.toFixed(2);
                                                        $('#<?php echo $key; ?>amount_shipping').text(keyamountshipping);
                                                        if(total_amount!="0") {
                                                            var keyamount = total_amount.toFixed(2);
                                                            $('#<?php echo $key; ?>amount').text(keyamount);
                                                              <?php  if ($products->shipping == 4) { ?>
                                                            var qqqq = parseFloat($('#totalamount').text())+<?php echo $products->deal_value; ?>+<?php echo $itemshippingamount; ?>;
                                                            <?php } else { ?>
                                                            var qqqq = parseFloat($('#totalamount').text())+<?php echo $products->deal_value; ?>;
                                                            <?php } ?>
                                                            var qqq = qqqq.toFixed(2); 
                                                            var flatqqq = qqqq+<?php echo $flatamount; ?>;
                                                            var flat = flatqqq.toFixed(2);
                                                            var taxqqq = (<?php echo $taxamount; ?>/100)*flat;
                                                            var taxvalue = taxqqq.toFixed(2);
                                                            $('#totalamount').text(qqq);  
                                                            $('#Grandamount').text(qqq);
                                                            $('#TotalAmount').val(qqq);
                                                            $('#P_TotalAmount').val(qqq);
                                                            $('#COD_TotalAmount').val(qqq);
                                                            $('#ref').val('0');
                                                            $('#PRO_REFERRAL').val('0');
                                                            $('#PC_REFERRAL').val('0');
                                                            $('#COD_REFERRAL').val('0');
                                                        }
                                                    }
                                                    $('#taxamount').text(taxvalue); 
                                                    var totgrand = (parseFloat(flat)+parseFloat(taxvalue));
                                                    var totgrandval = totgrand.toFixed(2);
                                                    if(totgrandval != "NaN"){
                                                        $('#Grandamount').text(totgrandval); 
                                                    }
                                                }
                                                function <?php echo $key; ?>1()
                                                { 
                                                    if($('#<?php echo $key; ?>').val()>1){
                                                        var plus_amount = parseInt($('#<?php echo $key; ?>').val()) - 1;
                                                        $('#RE_QTY_VAL').val(plus_amount);
                                                        $('#PC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#PCC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#COD_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#APCC_QTY_VAL<?php echo $key; ?>').val(plus_amount);
                                                        $('#PRO_REFERRAL').val('0');
                                                        $('#PC_REFERRAL').val('0');
                                                        $('#COD_REFERRAL').val('0');
                                                        var total_shipp = ((<?php echo $shippingamount; ?>)*plus_amount);
                                                        var keyamountshipping = total_shipp.toFixed(2);
                                                        $('#<?php echo $key; ?>amount_shipping').text(keyamountshipping);
                                                        if(plus_amount!="0"){
                                                            $('#<?php echo $key; ?>').val(plus_amount); 
                                                        } 
                                                        var total_amount = <?php echo $shippingamount; ?> + (<?php echo $products->deal_value; ?>*plus_amount);
                                                        if(total_amount!="0") {
                                                            var keyamount = total_amount.toFixed(2);
                                                            $('#<?php echo $key; ?>amount').text(keyamount);
                                                          <?php  if ($products->shipping == 4) { ?>
                                                           var qqqq = parseFloat($('#totalamount').text())-<?php echo $products->deal_value; ?>-<?php echo $itemshippingamount; ?>;
                                                            <?php } else { ?>
                                                           var qqqq = parseFloat($('#totalamount').text())-<?php echo $products->deal_value; ?>;
                                                            <?php } ?>
                                                            var qqq = qqqq.toFixed(2); 
                                                            var flatqqq = qqqq+<?php echo $flatamount; ?>;
                                                            var flat = flatqqq.toFixed(2);    
                                                                                                            
                                                            var taxqqq = (<?php echo $taxamount; ?>/100)*flat;
                                                            var taxvalue = taxqqq.toFixed(2);
                                                                                                            
                                                            $('#totalamount').text(qqq);
                                                            $('#Grandamount').text(qqq);
                                                            $('#TotalAmount').val(qqq);
                                                            $('#P_TotalAmount').val(qqq);
                                                            $('#COD_TotalAmount').val(qqq);
                                                            $('#ref').val('0');
                                                            $('#PRO_REFERRAL').val('0');
                                                            $('#PC_REFERRAL').val('0');
                                                            $('#COD_REFERRAL').val('0');
                                                        }
                                                    }
                                                                                                    
                                                    $('#taxamount').text(taxvalue); 
                                                    var totgrand = (parseFloat(flat)+parseFloat(taxvalue));
                                                    var totgrandval = totgrand.toFixed(2);
                                                    if(totgrandval != "NaN"){
                                                        $('#Grandamount').text(totgrandval); 
                                                    }
                                                }  
                                            </script>
                                            <td><?php echo CURRENCY_SYMBOL; ?><span id="<?php echo $key; ?>amount"><?php echo number_format((float) $products->deal_value + $shippingamount, 2, '.', ''); ?></span></td>
                                            <?php $total_amount +=$products->deal_value + $shippingamount; ?>
                                            <td align="center">
                                                <a class="cart_delete" id="prodele_<?php echo $products->deal_id; ?>" 
                                                onclick="delete_cart('<?php echo $value; ?>');" title="<?php echo $this->Lang['RMV']; ?>">&nbsp;</a>
                                            </td>
                                                <script>
                                                        $('#prodele_<?php echo $products->deal_id; ?>').click(function() {
                                                                $('#prodele_<?php echo $products->deal_id; ?>').hide();
                                                        });
                                                </script>

                                            </tr>
                                                               
                                                                