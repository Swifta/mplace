  <?php //if ($products->shipping == 3) { ?>
                                                                <p>( <?php //echo $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP']; ?> )</p>							
                                                                <?php //} ?>
                                                                <?php //if ($products->shipping == 4) { ?>
                                                                <p>( <?php //echo $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU']; ?>) 
                                                                </p>							
                                                                <?php //} ?>
                                                                <?php //if ($products->shipping == 5) { ?>
                                                                <p><font color="red">( <?php //echo $this->Lang['ARAMEX_SHIPP_PROD']; ?> )</font></p>	
                                                                			
                                                                <?php //} ?>
                                                        </div> 
                                                </td>
                                                <td align="center">
                                                <?php
                                                   /* $nosize = "";
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
                                                    } */
                                                    ?>
                                         <div class="quantity_bx"> 
                                        <?php //if ($size_count > 1) {  ?>
                                      
                                        <div class="lessthen">
                                        <a class="less_min" id="QtyDown" onclick="<?php //echo $key; ?>1()">-</a>
                                        </div>
                                        <?php //} ?>
                                        <div class="lessthen1">
                                        <input name="QTY" id="<?php //echo $key; ?>" value="1" readonly="readonly" type="text" rel="20">
                                        </div>
                                        <?php  //if ($size_count > 1) {  ?>
                                        <div class="greaterthen">
                                        <a class="plus" id="QtyUp" onclick="<?php //echo $key; ?>()">+</a>
                                        </div>
                                         <?php //} ?>
                                        </div>
                                        </td>
                                        <td>X </td>	
                                        <td><?php //echo CURRENCY_SYMBOL . $products->deal_value; ?></td>
                                        <td>+</td>	   
                                                <?php //if ($products->shipping == 1) { ?>
                                                <td><span><?php //echo $this->Lang['FREE']; ?></span></td>						
                                                <?php //} ?>
                                                <?php /*if ($products->shipping == 2) { 
                                                $get_merchantdetails = $this->products->get_userflat_amount($products->merchant_id);
                                                $shippingamount = $get_merchantdetails->flat_amount;                                                 
                                                */?>                                                               
                                                <td><span><?php //echo CURRENCY_SYMBOL; ?><?php //echo number_format((float) $shippingamount, 2, '.', ''); ?></span></td>							
                                                <?php //} ?>
                                                <?php //if ($products->shipping == 3) { ?>
                                                <td><span><?php //echo CURRENCY_SYMBOL; ?><?php //echo number_format((float) $products->shipping_amount, 2, '.', ''); ?></span></td>							
                                                <?php //} ?>
                                                <?php //if ($products->shipping == 4) { ?>
                                                <td><span><?php //echo CURRENCY_SYMBOL; ?><span id="<?php //echo $key; ?>amount_shipping"><?php //echo number_format((float) $products->shipping_amount, 2, '.', ''); ?></span></span>
                                                </td>							
                                                <?php //} ?>
                                                <?php //if ($products->shipping == 5) {  $calculshippingamount = ""; ?>
                                                 <td><span><?php //echo $this->Lang['ARAMEX_COST']; ?></span></td>
                                                							
                                                <?php //} ?>
                                        <td>=<?php //$product_quantity = $this->session->get('product_quantity_qty' . $products->deal_id); ?></td>
                                            <script>
                                                function <?php //echo $key; ?>()
                                                {
                                                    if($('#<?php //echo $key; ?>').val()!=<?php echo $size_count; ?>) {
                                                        var plus_amount = parseInt($('#<?php echo $key; ?>').val()) + 1;
                                                        $('#RE_QTY_VAL').val(plus_amount);
                                                        $('#PC_QTY_VAL<?php //echo $key; ?>').val(plus_amount);
                                                        $('#PCC_QTY_VAL<?php //echo $key; ?>').val(plus_amount); 
                                                        $('#COD_QTY_VAL<?php //echo $key; ?>').val(plus_amount);
                                                        $('#APCC_QTY_VAL<?php //echo $key; ?>').val(plus_amount); 
                                                        $('#PRO_REFERRAL').val('0');
                                                        $('#PC_REFERRAL').val('0');
                                                        $('#COD_REFERRAL').val('0');
                                                        if(plus_amount!="0"){
                                                            $('#<?php //echo $key; ?>').val(plus_amount); 
                                                        }
                                                         <?php //if ($products->shipping == 1) { ?>
                                                          var total_amount = ((<?php //echo $products->deal_value; ?>)*plus_amount);
                                                         <?php //} if ($products->shipping == 2) { ?>
                                                          var total_amount = ((<?php //echo $flatamount; ?>)) + ((<?php //echo $products->deal_value; ?>)*plus_amount);
                                                         <?php //} if ($products->shipping == 3) { ?>
                                                         var total_amount = ((<?php //echo $productbasedamount; ?>)) + ((<?php //echo $products->deal_value; ?>)*plus_amount);
                                                         <?php //} if ($products->shipping == 4) { ?>
                                                        var total_amount = ((<?php //echo $itemshippingamount; ?>)*plus_amount) + ((<?php //echo $products->deal_value; ?>)*plus_amount);
                                                        <?php //} if ($products->shipping == 5) { ?>
                                                         var total_amount = ((<?php //echo $products->deal_value; ?>)*plus_amount);
                                                        <?php //} ?>
                                                        var total_shipp = ((<?php //echo $shippingamount; ?>)*plus_amount);
                                                        var keyamountshipping = total_shipp.toFixed(2);
                                                        $('#<?php //echo $key; ?>amount_shipping').text(keyamountshipping);
                                                        if(total_amount!="0") {
                                                            var keyamount = total_amount.toFixed(2);
                                                            $('#<?php //echo $key; ?>amount').text(keyamount);
                                                              <?php  //if ($products->shipping == 4) { ?>
                                                            var qqqq = parseFloat($('#totalamount').text())+<?php //echo $products->deal_value; ?>+<?php //echo $itemshippingamount; ?>;
                                                            <?php //} else { ?>
                                                            var qqqq = parseFloat($('#totalamount').text())+<?php //echo $products->deal_value; ?>;
                                                            <?php //} ?>
                                                            var qqq = qqqq.toFixed(2); 
                                                            var flatqqq = qqqq+<?php //echo $flatamount; ?>;
                                                            var flat = flatqqq.toFixed(2);
                                                            var taxqqq = (<?php //echo $taxamount; ?>/100)*flat;
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
                                                function <?php //echo $key; ?>1()
                                                { 
                                                    if($('#<?php //echo $key; ?>').val()>1){
                                                        var plus_amount = parseInt($('#<?php //echo $key; ?>').val()) - 1;
                                                        $('#RE_QTY_VAL').val(plus_amount);
                                                        $('#PC_QTY_VAL<?php //echo $key; ?>').val(plus_amount);
                                                        $('#PCC_QTY_VAL<?php //echo $key; ?>').val(plus_amount);
                                                        $('#COD_QTY_VAL<?php //echo $key; ?>').val(plus_amount);
                                                        $('#APCC_QTY_VAL<?php //echo $key; ?>').val(plus_amount);
                                                        $('#PRO_REFERRAL').val('0');
                                                        $('#PC_REFERRAL').val('0');
                                                        $('#COD_REFERRAL').val('0');
                                                        var total_shipp = ((<?php //echo $shippingamount; ?>)*plus_amount);
                                                        var keyamountshipping = total_shipp.toFixed(2);
                                                        $('#<?php //echo $key; ?>amount_shipping').text(keyamountshipping);
                                                        if(plus_amount!="0"){
                                                            $('#<?php //echo $key; ?>').val(plus_amount); 
                                                        } 
                                                        var total_amount = <?php //echo $shippingamount; ?> + (<?php //echo $products->deal_value; ?>*plus_amount);
                                                        if(total_amount!="0") {
                                                            var keyamount = total_amount.toFixed(2);
                                                            $('#<?php //echo $key; ?>amount').text(keyamount);
                                                          <?php  //if ($products->shipping == 4) { ?>
                                                           var qqqq = parseFloat($('#totalamount').text())-<?php //echo $products->deal_value; ?>-<?php //echo $itemshippingamount; ?>;
                                                            <?php //} else { ?>
                                                           var qqqq = parseFloat($('#totalamount').text())-<?php //echo $products->deal_value; ?>;
                                                            <?php //} ?>
                                                            var qqq = qqqq.toFixed(2); 
                                                            var flatqqq = qqqq+<?php //echo $flatamount; ?>;
                                                            var flat = flatqqq.toFixed(2);    
                                                                                                            
                                                            var taxqqq = (<?php //echo $taxamount; ?>/100)*flat;
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
                                            <td><?php //echo CURRENCY_SYMBOL; ?><span id="<?php //echo $key; ?>amount"><?php //echo number_format((float) $products->deal_value + $shippingamount, 2, '.', ''); ?></span></td>
                                            <?php //$total_amount +=$products->deal_value + $shippingamount; ?>
                                            <td align="center">
                                                <a class="cart_delete" id="prodele_<?php //echo $products->deal_id; ?>" 
                                                onclick="delete_cart('<?php //echo $value; ?>');" title="<?php //echo $this->Lang['RMV']; ?>">&nbsp;</a>
                                            </td>
                                                <script>
                                                        $('#prodele_<?php //echo $products->deal_id; ?>').click(function() {
                                                                $('#prodele_<?php //echo $products->deal_id; ?>').hide();
                                                        });
                                                </script>

                                            </tr>