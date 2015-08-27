<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript"> 
        $(document).keyup(function(e) {
                if (e.keyCode == 27) { // esc keycode
                        $('div#show').hide();
                        $('div#show_tc').hide();
                        $('#fade').css({'visibility' : 'hidden'});
                        //location.reload();
                        return false;
                }
        });
        $(document).ready(function(){ 
                function blink(selector){
                        $(selector).fadeOut('slow', function(){
                                $(this).fadeIn('slow', function(){
                                        blink(this);
                                });
                        });
                }
                blink('.blink');
                <?php if ($this->paypal_setting) { ?> 
                        $('.cancel_login').hide();
                <?php } else { ?>
                        $('.befor_login').hide();
                        $('.cancel_login').show();
                <?php } ?>
                $('.AuthorizeNet_pay').hide();
                $('.cash_pay').hide();
                $('.what_happens').hide();
                $('.what_buygift').hide();
                $('.can_change').hide();
                $('.ref_paypal').hide();
                $('#down1').hide();
                $('#down2').hide();
                $('#down3').hide();
                var tooltipTimeout;
                $("#someelem").hover(function()
                {tooltipTimeout = setTimeout(showTooltip, 2);}, 
                hideTooltip);
                function hideTooltip()
                {
                        clearTimeout(tooltipTimeout);
                        $("#tooltip").fadeOut().remove();
                }

                var tooltipTimeouttax;
                $("#someelemtax").hover(function()
                {tooltipTimeouttax = setTimeout(showTooltiptax, 2);}, 
                hideTooltiptax);
                function hideTooltiptax()
                {
                        clearTimeout(tooltipTimeouttax);
                        $("#tooltiptax").fadeOut().remove();
                }
                function showTooltiptax()
                {
                        var tooltiptax = $("<div id='tooltiptax' class='tooltiptax'> <?php echo $this->Lang['TX_AMT']; ?> = <?php echo TAX_PRECENTAGE_VALUE; ?>% <br><?php echo $this->Lang['TOT_AMT']; ?><br><?php echo $this->Lang['TX']; ?></div>");
                        tooltiptax.appendTo($("#someelemtax"));
                }
        });
</script>
<script type="text/javascript"> 
        $('.cancel_login').hide();
        function SimilarDeals() {
                $('.error').html('');
                $('.cancel_login').show();
                $('.befor_login').hide();
                $('.AuthorizeNet_pay').hide();
                $('.cash_pay').hide();
        }
        function SimilarProducts() {
                $('.error').html('');
                $('.befor_login').show();
                $('.cancel_login').hide();
                $('.AuthorizeNet_pay').hide();
                $('.cash_pay').hide();
        }
        function Authorize() {
                $('.error').html('');
                $('.befor_login').hide();
                $('.cancel_login').hide();
                $('.AuthorizeNet_pay').show();
                $('.cash_pay').hide();
        }
        function cash_delivery() {
                $('.error').html('');
                $('.cash_pay').show();
                $('.befor_login').hide();
                $('.cancel_login').hide();
                $('.AuthorizeNet_pay').hide();
        }
</script>
<script type="text/javascript"> 
        function WhatHappens() {
                $('.what_happens').slideToggle(300);
                $('#down1').slideToggle(300);
                $('#right1').slideToggle(300);
        }
        function Whatbuygift() {
                $('.what_buygift').slideToggle(300);
                $('#down2').slideToggle(300);
                $('#right2').slideToggle(300);
        }
        function CanChange() {
                $('.can_change').slideToggle(300);
                $('#down3').slideToggle(300);
                $('#right3').slideToggle(300);
        }
        function show_dis()
	{
		$("form#submit_changes").validate({
			submitHandler: function(form) {  // How to repace this? 
				$.post('<?php echo PATH;?>products/update_shipping_address/', $("form#submit_changes").serialize(), function(data) { 
					$('#new_shipping_address').html(data);
                                        $('#fade').css({'visibility' : 'hidden'});
					$('div#show').hide();
				}); 
			}
			});
		        $('#fade').css({'visibility' : 'visible'});
			$('div#show').show();
	}	
	function hide_shipping_addr()
	{
		$('div#show').hide();
                $('#fade').css({'visibility' : 'hidden'});
	}
	function show_dis_tc()
	{
	        $('#fade').css({'visibility' : 'visible'});
		$('div#show_tc').show();
	}	
	
	function hide_shipping_addr_tc()
	{
		$('div#show_tc').hide();
                $('#fade').css({'visibility' : 'hidden'});
	}
</script>
<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">
        <div class="bread_crumb">
            <ul>
                <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                <li><p><?php echo $this->Lang['PRO_PAY']; ?></p></li>
            </ul>
        </div>
            <!--content start-->                        
            <div class="payouter_block">
            <div class="pay_br payleft_block">                                          
                        <div class="cart_table clearfix">
                            <table class="mcart_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0" >                                        
                                <thead class="pay_titlebg">
                                    <tr>                                            
                                        <th  align="left"><?php echo $this->Lang['IMAGE']; ?></th>
                                        <th align="left" <?php if ($this->shipping_setting != 4) { ?> colspan="6"
                                        <?php } ?> ><?php echo $this->Lang['DESC']; ?></th>
                                        <th  align="left"><?php echo $this->Lang['QUAN']; ?></th>
                                        <th  align="left"></th>
                                        <th  align="left"><?php echo $this->Lang['PRI']; ?></th>
                                        <th  align="left"></th>
                                        <th  align="left"><?php echo $this->Lang['SHIP_ING']; ?></th>
                                        <th  align="left"></th>
                                        <th  align="left"><?php echo $this->Lang['TOTAL']; ?></th>
                                    </tr>
                                </thead>                                                                    
                                <?php
                                $total_amount = "0";
                                $shippingamount = "0";
                                $flatamount = "0";
                                $per_productshipping = "0";
                                $add_productshipping = "0";
                                $itemshippingamount = "0";
                                $taxamount = "0";
                                $productbasedamount = "0";
                                if ($this->shipping_setting == 3) {
                                    foreach ($_SESSION as $key => $value) {
                                        if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                            $this->products = new Products_Model();
                                            $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                            foreach ($this->get_cart_products as $products) {
                                                $per_productshipping += $products->shipping_amount;
                                                $add_productshipping .= number_format((float) $products->shipping_amount, 2, '.', '') . " + <br> ";
                                            }
                                        }
                                        ?>
                                        <script type="text/javascript"> 
                                            function showTooltip()
                                            {      
                                                var tooltip = $("<div id='tooltip' class='tooltip'><?php echo $add_productshipping; ?> <hr> <?php echo $this->Lang['SHIP_AMOU']; ?> = <?php echo number_format((float) $per_productshipping, 2, '.', ''); ?>   </div>");
                                                tooltip.appendTo($("#someelem"));
                                            }            
                                        </script>
                                 <?php   }
                                }    ?>
                                <?php
                                $totshoppamount = "0";
                                foreach ($_SESSION as $key => $value) {
                                    if ((is_string($value)) && ($key == 'product_cart_id' . $value)) {
                                        $this->products = new Products_Model();
                                        $this->get_cart_products = $this->products->get_cart_products($this->session->get($key));
                                        foreach ($this->get_cart_products as $products) {
                                            $get_size_name = $this->products->get_size_data($products->deal_id);
                                            $get_color_data = $this->products->get_color_data($products->deal_id);
                                            $taxamount = TAX_PRECENTAGE_VALUE;
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
                                            ?>
                                            <tr>
                                                <td>
                                                <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { ?>
                                                        <a href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/product' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>">
                                                        <img src="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png'; ?>&amp;w=80&amp;h=80" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" /></a>
                                                <?php } else { ?>
                                                        <a href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/product' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" width="80" height="80" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"></a>
                                                <?php } ?> 
                                                </td>                                                                
                                                <td <?php if ($this->shipping_setting != 4) { ?> colspan="6"
                                                <?php } ?>>                                                                        
                                                <h3 class="cart_desc_title"><a href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/product' . $products->deal_key . '/' . $products->url_title . '.html'; ?>"><?php echo ucfirst($products->deal_title); ?></a></h3>
                                                <p><?php echo substr(strip_tags($products->deal_description), 0, 50); ?></p>	
                                                        <div  class="clearfix">    
                                                                <?php if ($products->shipping == 1) { ?>
                                                                <p>( <?php echo $this->Lang['FREE_SHIPP_PROD']; ?> )</p>							
                                                                <?php } ?>
                                                                <?php if ($products->shipping == 2) { ?>                                                               
                                                                <p>( <?php echo $this->Lang['FLAT_SHIPP_T_PRO']; ?> )</p>							
                                                                <?php } ?>
                                                                <?php if ($products->shipping == 3) { ?>
                                                                <p>( <?php echo $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP']; ?> )</p>							
                                                                <?php } ?>
                                                                <?php if ($products->shipping == 4) { ?>
                                                                <p>( <?php echo $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU']; ?>) 
                                                                </p>							
                                                                <?php } ?>
                                                                
                                                                <?php if ($products->shipping == 5) { ?>
                                                                <p><font color="red">( <?php echo $this->Lang['ARAMEX_SHIPP_PROD']; ?> )</font></p>	
                                                                <p><font color="red"><?php echo $this->Lang['CURR_CODE']; ?> : ( <?php echo $this->session->get('aramex_currencycode' . $products->deal_id); ?>  )</font></p>
                                                                <p><font color="red"><?php echo $this->Lang['SHIP_AMOU']; ?> : ( <?php echo $this->session->get('aramex_value' . $products->deal_id); ?> )</font></p>						
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
                                         <div class="lessouter">
                                        <div class="lessthen1">
                                        
                                        <input name="QTY" id="<?php echo $key; ?>" value="<?php  if($this->session->get('product_cart_qty'.$products->deal_id)) { echo $this->session->get('product_cart_qty'.$products->deal_id); } else { echo'1'; }?>" readonly="readonly" type="text" rel="20">
                                        </div>
                                        </div>
                                        </td>
                                        <td>X </td>	
                                        <td><?php echo CURRENCY_SYMBOL . $products->deal_value; ?></td>
                                        <td>+</td>	   
                                                <?php if ($products->shipping == 1) {  $calculshippingamount = ""; ?>
                                                 <td><span><?php echo $this->Lang['FREE']; ?></span></td>
                                                							
                                                <?php } ?>
                                                <?php if ($products->shipping == 2) { 
                                                $get_merchantdetails = $this->products->get_userflat_amount($products->merchant_id);
                                                $shippingamount = $get_merchantdetails->flat_amount;  
                                                $calculshippingamount = $shippingamount;                                               
                                                ?>                                                               
                                                <td><span><?php echo CURRENCY_SYMBOL; ?><?php echo number_format((float) $shippingamount, 2, '.', ''); ?></span></td>							
                                                <?php } ?>
                                                <?php if ($products->shipping == 3) { 
                                                 $calculshippingamount = $products->shipping_amount;        
                                                ?>
                                                <td><span><?php echo CURRENCY_SYMBOL; ?><?php echo number_format((float) $products->shipping_amount, 2, '.', ''); ?></span></td>	
                                                						
                                                <?php } ?>
                                                <?php if ($products->shipping == 4) { 
                                                $calculshippingamount = $products->shipping_amount*$this->session->get('product_cart_qty'.$products->deal_id);       
                                                ?>
                                                <td><span><?php echo CURRENCY_SYMBOL; ?><span id="<?php echo $key; ?>amount_shipping"><?php echo number_format((float) $calculshippingamount, 2, '.', ''); ?></span></span>
                                                </td>							
                                                <?php } ?>
                                                
                                                <?php if ($products->shipping == 5) {  $calculshippingamount = ""; ?>
                                                 <td><span><?php echo $this->Lang['ARAMEX_COST']; ?></span></td>
                                                							
                                                <?php } ?>
                                                <td>=<?php $product_quantity = $this->session->get('product_cart_qty' . $products->deal_id); ?></td>
                                            
                                            <?php $dealamountdispaly = $products->deal_value * $this->session->get('product_cart_qty' . $products->deal_id); ?>
                                            <td><?php echo CURRENCY_SYMBOL; ?><span id="<?php echo $key; ?>amount"><?php echo number_format((float) $dealamountdispaly + $calculshippingamount, 2, '.', ''); ?></span></td>
                                            <?php $total_amount +=$dealamountdispaly + $calculshippingamount; ?>
                                                <script>
                                                        $('#prodele_<?php echo $products->deal_id; ?>').click(function() {
                                                                $('#prodele_<?php echo $products->deal_id; ?>').hide();
                                                        });
                                                </script>

                                            </tr>

                                    <?php
                                }
                            }
                        }
                        ?>

                <tfoot>                   
                        <!-- Total Amount -->         
                        <tr>
                                <td align="right" colspan="12"><?php echo $this->Lang['TOTAL']; ?></td>
                                <td align="left">=</td>
                                <td align="left" colspan="12"><p><?php echo CURRENCY_SYMBOL; ?><span id="totalamount"><?php echo number_format((float) $total_amount, 2, '.', ''); ?></span><p></td>
                        </tr>
                
                </tfoot>
                </table>
                </div> 
                </div>
                <div class="payright_block">
                        <div class="pay_br right_shipping_address">
                                <h3 class="paybr_title pay_titlebg shipping_edit_title clearfix ">
                                <span><?php echo $this->Lang['SHIP_ADD']; ?></span>
                                 
                                <a href="<?php echo PATH; ?>cart.html" title="<?php echo $this->Lang['EDIT']; ?>" class="saddress_edit"><?php echo $this->Lang['EDIT']; ?></a>      
                                </h3>                  
                               <div id="new_shipping_address" >
                                <address>
                                <p><?php echo ucfirst($this->session->get('shipping_name')); ?> , </p>
                                <p><?php echo ucfirst($this->session->get('shipping_address1')); ?>, </p>
                                <p><?php echo ucfirst($this->session->get('shipping_address2')); ?> ,</p>
                                 <p><?php echo ucfirst($this->session->get('shipping_state')); ?> ,</p>
                                 <p>
                                <?php foreach ($this->all_city_list as $CityL) {  ?>
                                <?php if ($CityL->city_id == $this->session->get('shipping_city')) {  echo ucfirst($CityL->city_name); } ?>
                                <?php } ?> , <?php echo ucfirst($this->session->get('shipping_country')); ?> </p>
                                <p>Zipcode : <?php echo $this->session->get('shipping_postal_code'); ?></p>
                                <p>Phone : <?php echo $this->session->get('shipping_phone'); ?></p>
                                
                                </address>                         
                        </div>
                </div>
        </div>
         <div id="show" class="popup_block5" style="display:none;">                                                                   
                                <?php foreach($this->shipping_address as $s) { ?> 
                                <form method="post" id="submit_changes">
                                <div class="sign_up_outer"> 
                                       <a onclick="hide_shipping_addr()" class="close2" title="close" id="close" style="cursor:pointer;">&nbsp;</a>
                                                <div class="signup_content clearfix">
                                                    <h2 class="signup_title shipping_poptitle"><?php echo $this->Lang['SHIP_ADDR']; ?></h2>
                                                    <div class="payment_form payment_shipping_form">
                                                        <ul class="clearfix">
                                                                <li>
                                                                    <label><?php echo $this->Lang['NAME']; ?>  <span> * </span></label>
                                                                    <div class="fullname">                                                                            
                                                                        <input tabindex="1" name="firstname" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" class="required" maxlength="256" value="<?php echo $s->ship_name; ?>" autofocus />
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <label><?php echo $this->Lang['ADDR1']; ?> <span> * </span></label>
                                                                    <div class="fullname">
                                                                        <input  name="address1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" class="required" maxlength="256" value="<?php echo $s->ship_address1; ?>" />
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                <label><?php echo $this->Lang['ADDR2']; ?> <span> * </span></label>
                                                                <div class="fullname">
                                                                <input name="address2" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" size="40"  maxlength="256" value="<?php echo $s->ship_address2; ?>"/>
                                                                </div>
                                                        </li>
                                                        <li>
                                                                <label><?php echo $this->Lang['COUNTRY']; ?><span> * </span></label>                                    
                                                                <div class="fullname">
                                                                        <select class="select" name="country" onchange="return city_change_merchant(this.value);">
                                                                                <?php foreach ($this->all_country_list as $countryL) { ?>
                                                                                <option <?php if ($countryL->country_id == $s->ship_country) {
                                                                                echo 'Selected="true"';
                                                                                } ?> value="<?php echo $countryL->country_id; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                                                                <?php } ?>
                                                                        </select>      
                                                                </div>
                                                        </li>                                 
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['STATE']; ?><span> * </span></label>
                                                                <div class="fullname">
                                                                    <input name="state" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" size="40" class="required" maxlength="256" value="<?php echo $s->ship_state; ?>" />
                                                                </div>
                                                        </li>
                                                         <li>
                                                                <label><?php echo $this->Lang['SEL_CITY']; ?>  <span> * </span></label>                                        
                                                                <div class="clearfix fullname">
                                                                        <div class="select_box_outer country_select_box">
                                                                        <select name="city" class="select" id="CitySD">
                                                                        <?php foreach ($this->all_city_list as $CityL) { ?>
                                                                        <option <?php if ($CityL->city_id == $s->ship_city) {
                                                                        echo 'Selected="true"';
                                                                        } ?> value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                                                        <?php } ?>
                                                                        </select>                            
                                                                        </div>
                                                                </div>  
                                                        </li>        
                                                        <li class="frm_clr">
                                                                <label><?php echo $this->Lang['POSTAL_CODE']; ?> <span> * </span></label>
                                                                <div class="fullname">
                                                                    <input  name="zip_code" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" class="required number" maxlength="256" value="<?php echo $s->ship_zipcode; ?>"/>
                                                                </div>
                                                        </li>
                                                        <li>
                                                                <label><?php echo $this->Lang['PHONE']; ?><span> * </span></label>
                                                                <div class="fullname">
                                                                <input name="mobile" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_PHONE']; ?>" type="text" class="required number" maxlength="18" value="<?php echo $s->ship_mobileno; ?>" />
                                                                </div>
                                                        </li>
                                                </ul>
                                          </div>
                                          <input type="submit" value="Update" class="sign_submit" />
                                          <input class="sign_cancel" type="button" value="Cancel" onclick="hide_shipping_addr()" />
                                </div>
                                </div>
                        </form>
                <?php } ?>
                </div>
             </div>
             <?php if(count($this->cms_tc) > 0){ ?>
                <div id="show_tc" class="popup_block6" style="display:none;">   
                        <div class="sign_up_outer"> 
                        <a onclick="hide_shipping_addr_tc()" class="close2" title="close" id="close" style="cursor:pointer;">&nbsp;</a>
                                <div class="signup_content clearfix">
                                <h2 class="signup_title shipping_poptitle"><?php echo $this->cms_tc->current()->cms_title; ?></h2>
                                        <div class="content_abouts">
                                                <div class="content_abou_common">                                                                                     
                                                        <div class="content_abou_text">
                                                        <p><?php echo $this->cms_tc->current()->cms_desc;?></p>
                                                        </div>
                                                </div>  
                                        </div>
                                </div>
                        </div>				
                </div>
                <?php } ?>
                <div class="payouter_block pay_br">
                <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['TYPE_PAY']; ?></h3>
                        <div class="p_inner_block">                            
                                <div class="payment_select"> 
                                        <?php if ($this->paypal_setting) { ?>
                                                <div class="payment_sel_lft">
                                                <a onclick="return SimilarProducts();" id="SimilarProducts"  >
                                                <input id="paypal_radio" type="radio" name="name"  checked /></a><p><?php echo $this->Lang['PAYPAL']; ?></p></div>
                                        <?php } ?>
                                        <?php if ($this->credit_card_setting) { ?>
                                                <div class="payment_sel_lft">  <a onclick="return SimilarDeals();" id="SimilarDeals"  >
                                                <input type="radio" name="name"  <?php if ($this->paypal_setting) {
                                                } else {  ?> checked <?php } ?>  /></a><p><?php echo $this->Lang['PAYPAL_CREDIT']; ?></p></div>
                                        <?php } ?>
                                        <?php if ($this->authorize_setting) { ?>
                                                <div class="payment_sel_lft"> 
                                                <a onclick="return Authorize();" id="Authorize"  > <input type="radio" name="name"  /></a> <p><?php echo $this->Lang['AUTHORIZE']; ?></p></div>
                                        <?php } ?>
                                        <?php if ($this->uri->last_segment() != "payment_details_friend.html") { ?>
                                                <?php if ($this->cash_on_delivery_setting) { ?>
                                                <div class="payment_sel_lft"> <a onclick="return cash_delivery();" > <input type="radio" name="name"  /></a> <p><?php echo $this->Lang['CASH_ON_DEL']; ?></p></div>
                                                <?php } ?>
                                        <?php } ?>
                                </div>
                                <div class="befor_login">
                                <?php echo new View("themes/" . THEME_NAME . "/paypal/p_paypal"); ?>
                                </div>
                                <div class="AuthorizeNet_pay">
                                <?php echo new View("themes/" . THEME_NAME . "/paypal/p_Authorize"); ?>
                                </div>
                                <?php if ($this->uri->last_segment() != "payment_details_friend.html") { ?>
                                <div class="cash_pay">
                                <?php echo new View("themes/" . THEME_NAME . "/paypal/cash_delivery"); ?>
                                </div>
                                <?php } ?>
                                <div class="cancel_login">
                                <?php echo new View("themes/" . THEME_NAME . "/paypal/p_dodirect_creditcard"); ?>
                                </div>
                                </div>
                                </div>
                                <!--Blog content ends-->
                        </div>
                </div>
    </div>
