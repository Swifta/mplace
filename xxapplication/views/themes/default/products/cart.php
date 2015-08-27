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
                                if (document.getElementById('CitySD').value == ' ') { 
                                         $('#city_validation').html('This Field Is Required.');
                                        return false; 
                                }
				$.post('<?php echo PATH;?>products/update_shipping_address/', $("form#submit_changes").serialize(), function(data) { 
					$('#new_shipping_address').html(data);
					$('#city_validation').html('');
                                        $('#fade').css({'visibility' : 'hidden'});
					$('div#show').hide();
				}); 
			}
			});
		        $('#fade').css({'visibility' : 'visible'});
			$('div#show').show();
	}	
	function delete_cart(dealid)
	{
	        if(dealid){ 
	                window.location.href = Path+"payment_product/cart_remove/product_cart_id"+dealid;
	        }
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
                            <li><p><?php echo $this->Lang['PRODUCT_DET']; ?></p></li>
                        </ul>
                    </div>
                    <!--content start-->
                   <!--content start-->                        
            <div class="payouter_block">
            <div class="pay_br payleft_block">                                          
                        <div class="cart_table clearfix">
                            <table class="mcart_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0" >      
                            
                            <?php
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
                            
                                  <?php if($display_headerport == 1) { ?>                            
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
                                        <th >Remove</th>                                                                                                                
                                    </tr>
                                </thead>                                                                    
                                <?php } ?>
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
                                         <div class="quantity_bx"> 
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

                                    <?php
                                }
                            }
                        }
                        ?>

                <tfoot>                   
                        <!-- Total Amount -->     
                        <?php if ($total_amount != 0) { ?>    

                        <tr>
                                <td align="right" colspan="6">
                    <div class="continue-shop-text"><a href="<?php echo PATH ?>products.html"><?php echo $this->Lang['CONTINUE_SHOPPING']; ?></a></td>
                                <td align="right" colspan="6"><?php echo $this->Lang['TOTAL']; ?></td>
                                <td align="left">=</td>
                                <td align="left" colspan="6"><p><?php echo CURRENCY_SYMBOL; ?><span id="totalamount"><?php echo number_format((float) $total_amount, 2, '.', ''); ?></span></p></td>
                        </tr>
                        <?php } ?>
                </tfoot>
                </table>
                <?php if ($total_amount == 0) { ?> 
                <h2 class="paybr_title pay_titlebg"><?php echo $this->Lang['YOUR_SHOPPING_BAG']; ?></h2>
                <div class="p_inner_block">
                        <div class="content_empt_lft">
                            <h2><?php echo $this->Lang['YOUR_SHOP_CART_EMP']; ?></h2>                                                                       

                            <div class="checkout-button">                                                                    
                                <a class="buy_it" href="<?php echo PATH ?>products.html"><?php echo $this->Lang['CONTINUE_SHOPPING']; ?></a>
                            </div>
                        </div>  

                        <div class="content_empt_rgt">
                            <img alt="logo" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/cat_ta_img.png"/>
                        </div>
                </div>
                <?php } ?>
                </div> 
                </div>
                <div class="payright_block">
                        <div class="pay_br right_shipping_address">
                                <h3 class="paybr_title pay_titlebg shipping_edit_title clearfix ">
                                <span><?php echo $this->Lang['SHIP_ADD']; ?></span>
                                 <?php if (count($this->shipping_address) > 0) { ?>
                                <a onclick="show_dis();" title="<?php echo $this->Lang['EDIT']; ?>" class="saddress_edit"><?php echo $this->Lang['EDIT']; ?></a>        <?php } else { ?>
                                <a href="<?php echo PATH; ?>users/my-shipping-address.html" title="<?php echo $this->Lang['ADD']; ?>" class="saddress_edit"><?php echo $this->Lang['ADD']; ?></a>        
                                <?php } ?>
                                </h3>
                                <?php if (count($this->shipping_address) > 0) { ?>                    
                               <div id="new_shipping_address" > <?php common::shipping_address(); ?> </div>
                        <?php } ?>
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
                                                                        <input name="firstname" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_NAME']; ?>" type="text" class="required" maxlength="35" value="<?php echo $s->ship_name; ?>" autofocus />
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <label><?php echo $this->Lang['ADDR1']; ?> <span> * </span></label>
                                                                    <div class="fullname">
                                                                        <input  name="address1" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" class="required" maxlength="100" value="<?php echo $s->ship_address1; ?>" />
                                                                    </div>
                                                                </li>

                                                                <li class="frm_clr">
                                                                        <label><?php echo $this->Lang['ADDR2']; ?> <span> * </span></label>
                                                                        <div class="fullname">
                                                                        <input name="address2" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_ADD']; ?>" type="text" size="40"  maxlength="100" value="<?php echo $s->ship_address2; ?>"/>
                                                                        </div>
                                                                </li>
                                                                <li>
                                                                <label><?php echo $this->Lang['COUNTRY']; ?><span> * </span></label>                                    
                                                                <div class="fullname">
                                                                        <select class="select required" name="country" onchange="return city_change_merchant(this.value);">
                                                                                <?php foreach ($this->all_country_list as $countryL) { ?>
                                                                                <option <?php if ($countryL->country_id == $s->ship_country) {
                                                                                echo 'Selected="true"';
                                                                                } ?> value="<?php echo $countryL->country_id; ?>"><?php echo ucfirst($countryL->country_name); ?></option>
                                                                                <?php } ?>
                                                                        </select>      
                                                                </div>
                                                                </li>    
                                                                <li class="frm_clr">
                                                                        <label><?php echo $this->Lang['SEL_CITY']; ?>  <span> * </span></label>                                        
                                                                        <div class="clearfix fullname">
                                                                        <div class="select_box_outer country_select_box">
                                                                        <select name="city" class="select required" id="CitySD">
                                                                        <?php foreach ($this->all_city_list as $CityL) { ?>
                                                                          <?php if ($CityL->country_id == $s->ship_country) { ?>
                                                                        <option <?php if ($CityL->city_id == $s->ship_city) { echo 'Selected="true"';  } ?> 
                                                                        value="<?php echo $CityL->city_id; ?>"><?php echo ucfirst($CityL->city_name); ?></option>
                                                                        <?php } } ?>
                                                                        </select>  
                                                                        <div id="city_validation"> </div>                          
                                                                        </div>
                                                                </div>  
                                                                </li> 
                                                                <li>
                                                                        <label><?php echo $this->Lang['STATE']; ?><span> * </span></label>
                                                                        <div class="fullname">
                                                                        <input name="state" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_STATE']; ?>" type="text" size="40" class="required" maxlength="35" value="<?php echo $s->ship_state; ?>" />
                                                                        </div>
                                                                </li>                                                                       
                                                                <li class="frm_clr">
                                                                        <label><?php echo $this->Lang['POSTAL_CODE']; ?> <span> * </span></label>
                                                                        <div class="fullname">
                                                                        <input  name="zip_code" size="40" AUTOCOMPLETE="OFF"  placeholder="<?php echo $this->Lang['ENTER_POSTAL_CODE']; ?>" type="text" class="required number" maxlength="8" value="<?php echo $s->ship_zipcode; ?>"/>
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
                             <?php if ($total_amount != 0) { ?>   
                        <div class="payouter_block pay_br">
                        <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['SHIPPING_INFO']; ?></h3>
                                <div class="p_inner_block">  
                                        <div class="befor_login">
                                        <?php echo new View("themes/" . THEME_NAME . "/paypal/shipping_address"); ?>
                                        </div>
                                </div>
                        </div>
                      <?php } ?>                        
                        </div>
                    <!--Blog content ends-->
             </div>
      </div>
</div>
