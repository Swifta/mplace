<table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
 <?php if(count($this->products_coupons_list) > 0 ) { ?>
<thead>
        <tr>
            <th width="100" align="left"><?php echo $this->Lang['TITLE']; ?> </th>
            <th width="100" align="left"><?php echo $this->Lang['STORE_NAME']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['PURCHASE_DATE']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['ADDRES']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['STATUS1']; ?></th>
            <th width="100" align="center"><?php echo $this->Lang['VIEW']; ?></th>            
        </tr>
    </thead>
    <?php } ?>
        <?php if(count($this->products_coupons_list) > 0 ) { ?>
		<?php foreach($this->products_coupons_list as $p){ ?>
			 	<tr>
                                <td><a href="<?php echo PATH.'product/'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $p->deal_title;?>" class="fl clear"><?php echo $p->deal_title;?></a></td>
                                <td><a href="<?php echo PATH.'stores/'.$p->store_key.'/'.$p->store_url_title.'.html';?>" title="<?php echo $p->store_name; ?>"><?php echo $p->store_name; ?></a></td>
                                <td><?php echo date('d-M-Y',$p->transaction_date);?></td>
                                <td><?php echo $p->saddr1.",".$p->saddr2;?></td>
                                <td><?php if($p->delivery_status==0) { echo $this->Lang['PENDING']; } elseif($p->delivery_status==1) { echo $this->Lang['ORDER_PACKED']; } elseif($p->delivery_status==2) { echo $this->Lang['SHIPPED_DELI_CENT'];  } elseif($p->delivery_status==3) { echo $this->Lang['OR_OUT_DELI']; } elseif($p->delivery_status==4) { echo $this->Lang['DELIVERED']; } ?></td>
                                <td align="center"><a id="details-panel<?php echo $p->shipping_id; ?>" title="<?php echo $this->Lang['VIEW_DET']; ?>"  href="javascript:;" ><img src="<?php echo PATH;?>images/details_view.gif"><input type="hidden" name="email1" id="mail" value="<?php echo $p->email; ?>"></a>		
            <div class="pop_show_rel">
			<div class="popup_show1 popup_show_user" id="lightboxdetails-panel<?php echo $p->shipping_id; ?>" style="display:none;"  >
			<div id="divToPrint<?php echo $p->shipping_id; ?>"   class="divToPrintval" >
			<div class="rejected_shipping" id="details-close<?php echo $p->shipping_id; ?>" ></div>
			<div class="printer_shipping blink" onclick="PrintDiv('<?php echo $p->shipping_id; ?>');" ></div>
			
                        <script type="text/javascript">     
                        function PrintDiv(val) {    
                        var divid = 'divToPrint'+val;
                        var divToPrint = document.getElementById(divid);          
                        var popupWin = window.open('', '_blank', 'width=800,height=1000');
                        $('.print_div').hide();
                        popupWin.document.open();
                        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                        popupWin.document.close();
                        $('.print_div').show();
                        }
                        </script> 

                        <script type="text/javascript">     
                        $(document).ready(function(){
                        $('a#details-panel<?php echo $p->shipping_id; ?>').click(function(){ 
                        $('#lightboxdetails-panel<?php echo $p->shipping_id; ?>').show();
                        $('.divToPrintval').show();
                        })
                        $('#details-close<?php echo $p->shipping_id; ?>').click(function(){ 
                        $('#lightboxdetails-panel<?php echo $p->shipping_id; ?>').hide();
                        })
                        })
                        </script> 	
     
			<div class="product_buy_popup" > 
		         <div style="width:99%;">
		            <div style="float:right; margin-right: 5px;text-align:center;">
		                <div style="font-weight: bold; font-size: 15px; float:left; margin: 60px 10px 0 0;"></div>
		               <div style="clear:both;"></div>
		            </div>
		        </div>
		        <div style="text-align:center;">
		            <strong style="font-size: 15px; font-weight:bold; font-family: Arial;"><?php echo $this->Lang['SHIP_DET']; ?></strong><br>
		            <b><?php echo $this->Lang['NOTE']; ?>:</b> <?php echo $this->Lang['THIS_SH_CON_FO_IT']; ?><br><br>
		        </div>
		        <table cellpadding="0" cellspacing="0" width="99%">
    <tbody><tr>
        <td><hr style="border: 1px solid black;"></td>
    </tr>
    <tr>
    <td>
            <table class="printtable" cellpadding="0" cellspacing="0" width="99%">
        <tbody>
        <tr>
                        <td colspan="7"><b>1.  <?php echo $p->deal_title; ?></b></td>
        </tr>
        
                        <tr>
                        <td width="10%">&nbsp;</td>
                        <td width="13%" align="center"><?php echo $this->Lang['COLOR']; ?></td>
                        <td width="13%" align="center"><?php echo $this->Lang['SIZE']; ?></td>
                        <td width="13%" align="center"><?php echo $this->Lang['QUAN']; ?></td>
                        <td width="13%" align="center"><?php echo $this->Lang['UNIR_PR']; ?></td>
                        <td width="13%" align="center"><?php echo $this->Lang['DEALVALUE']; ?></td>
                        <td width="13%" align="right"><?php echo $this->Lang['SUB_TOT']; ?></td>
                        </tr>
                        <tr><td>&nbsp;</td><td colspan="6"><hr style="border:1px dotted #AAAAAA;"></td></tr>
                        <tr>
			<td width="16%">&nbsp;</td>											
					<?php if($p->product_color !=0 ) { foreach($this->product_color as $pro){ ?>
					<?php if($p->product_color == $pro->id){ ?>                   
					<td align="center">
					<?php echo ucfirst($pro->color_name); ?></td>
					<?php } } } else { ?><td align="center">-</td> <?php } ?>
					 <?php if($p->product_size != 0 ){ foreach($this->product_size as $size){ ?>
					<?php if($p->product_size == $size->size_id){ ?>                 
					<td align="center">
					<?php echo $size->size_name; ?></td>
					<?php } } } else { ?><td align="center">-</td> <?php } ?>
				<td align="center"><?php echo $p->quantity; ?></td>
				<td align="center"><?php echo CURRENCY_SYMBOL.$p->deal_price; ?></td>
				<td align="center"><?php echo CURRENCY_SYMBOL.$p->deal_value; ?></td>
				<td align="right"><?php echo CURRENCY_SYMBOL.$p->deal_value * $p->quantity; ?></td>
			</tr>
         
    </tbody></table>
    
    <table class="printtable" cellpadding="0" cellspacing="0" width="99%">
                                                                <tbody>
                                                                
                                                                <?php $ship_dispay = ""; if($p->shipping_methods == 1){ 
                                                                $ship_dispay = $this->Lang['FREE_SHIPP_PROD'];
                                                                } ?>                                                                
                                                                <?php if($p->shipping_methods == 2){ 
                                                                $ship_dispay = $this->Lang['FLAT_SHIPP_T_PRO'];
                                                                } ?>                                                                
                                                                <?php if($p->shipping_methods == 3){ 
                                                                $ship_dispay = $this->Lang['PER_PRO_SHIPP_PRODUCT_SHIPP'];
                                                                } ?>                                                                
                                                                <?php if($p->shipping_methods == 4){ 
                                                                $ship_dispay = $this->Lang['PER_ITEM_PRODU_SHIPPING_AMOU'];
                                                                } ?>
                                                                 <?php if($p->shipping_methods == 5){ 
                                                                $ship_dispay = $this->Lang['ARAMEX_SHIPP_PROD'];
                                                                } ?>
                                                                <tr>
                                                                <td width="60%">&nbsp;</td>
                                                               <td align="right"><?php echo $ship_dispay; ?> <?php if(($p->shipping_methods != 1) && ($p->shipping_methods != 5) ){ ?> ( <?php echo CURRENCY_SYMBOL.$p->shipping; ?> )  <?php } ?></td>
                                                                
                                                                </tr>
                                                                
                                                                <?php if($p->shipping_methods == 5){ ?>
                                                                <tr>
                                                                <td align="right"><?php echo $this->Lang['CUUR_CODE']; ?> ( <?php echo $p->aramex_currencycode; ?> ) </td>
                                                                <td align="right"><?php echo $this->Lang['ARAMEX_COST']; ?> ( <?php echo $p->aramex_value; ?> ) </td>
                                                                 </tr>
                                                                <?php } ?>
                                                               
                                                                </tbody>
                                                                </table>
        </td>
    </tr>
    <tr>
        <td><hr style="border: 1px solid black;"></td>
    </tr>
</tbody></table>

 <div style="clear:both;"></div>
		    <div style="width:99%;  line-height: 2em; text-align:left; page-break-before: auto;">
	        <div style="float:left; width: 55%">&nbsp;</div>
	        <div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['SHIP_VAL']; ?></div>
	        <div style="float:left; width: 18%; text-align:right;"><b><?php echo CURRENCY_SYMBOL.$p->deal_value * $p->quantity; ?></b></div>
	        <div style="clear:both;"></div>
	    
	        	        	        	        	    
		    <div style="float:left; width: 55%">&nbsp;</div>
		    <div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['SHIP_ING']; ?></div>
		    <div style="float:left; width: 18%; text-align:right;"><b><?php if($p->shipping != 0 ) echo CURRENCY_SYMBOL.$p->shipping; else echo '-'; ?> </b></div>
		    <div style="clear:both;"></div>
		    
		    <?php /* <div style="float:left; width: 55%">&nbsp;</div>
							<div style="float:left; width: 27%; text-align:left;"><?php echo $this->Lang['TAX']; ?></div>
							<div style="float:left; width: 18%; text-align:right;"><b><?php if($p->tax_amount != 0 ) echo CURRENCY_SYMBOL.$p->tax_amount; else echo '-'; ?> </b></div>
							<div style="clear:both;"></div> */ ?>
	    
		    		        		            <div style="float:left; width: 55%; margin-top: 10px;">
		                &nbsp;		            </div> 
		            <div style="float:left; width: 45%; margin-top: 10px;">
		                <div style="padding: 10px 0px; border-top: solid 0.15em; border-bottom: 0.15em solid;">
		                    <div style="width:50%; float:left;"><?php if($p->type !=5) { echo $this->Lang["AMTPAID"]; } else if(($p->type==5) || ($p->delivery_status ==4)) { echo $this->Lang["AMTPAID"]; } else { echo $this->Lang['AMO_TO_B_PAID']; } ?></div>
		                    <div style="text-align:right; float:right; width:50%;">
								<strong style="font-size: 17px;"><?php echo CURRENCY_SYMBOL.(($p->deal_value * $p->quantity) + ($p->shipping) ); ?></strong>
							</div>
		                    <div style="clear:both;"></div>
		                </div>
		           </div>
		           <div style="clear:both"></div>
		           
		           
		        		    	    </div>
		
	 <div style="clear:both"></div>
	 
	 <hr style="border: 1px solid black; padding:0; margin: 20px 0 0 0; width: 99%;">
		        
		        <div style="margin-top: 20px; width:99%;">
		            			            <div style="float:left; margin-top: 20px;">
			              
			            </div>
		            		            <div style="float:left; width: 45%; font-size:15px; border-right: 1px dotted #666666; margin-left: 10px;">
		            		           
		                		                	<strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['OR_DATE']; ?>: </strong><br>
		                		                	<strong style="font-size: 12px; "><?php echo date("d-M-Y h:i:s A",$p->transaction_date); ?></strong>
		               
		                			        </div>
		                			         <div style="float:left; width: 45%; font-size:15px;  margin-left: 10px;">
		            		           
		                		                	<strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['DELIVERY_STA']; ?>:</strong><br>
		                		                	<strong style="font-size: 12px; "> <?php if($p->delivery_status ==4) { echo $this->Lang['DELIVERED']; } else { echo $p->delivery_period." ".$this->Lang['DELI_DAYS']; } ?> </strong>
		               
		                			        </div>
		                			         <div style="clear:both;"></div>
		           
		        </div>
		        
	 <hr style="border: 1px solid black; padding:0; margin: 20px 0 0 0; width: 99%;">
		        
		        <div style="margin-top: 20px; width:99%;">
		            			            <div style="float:left; margin-top: 20px;">
			              
			            </div>
		            		            <div style="float:left; width: 45%; font-size:15px; border-right: 1px dotted #666666; margin-left: 10px;">
		            		            <strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['SHOP_ADDR']; ?></strong>
			                <br>
		                		                <strong style="font-size: 15px; font-weight:bold;"><?php echo $p->store_name ; ?> </strong><br>
		              
									<?php echo $p->addr1.','.$p->addr2 ; ?>,<br>
									<?php echo common::get_city_name($p->str_city_id).'-'.$p->zipcode; ?>.<br>
		                		                	<strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['PHO']; ?>: <?php echo $p->str_phone; ?> </strong><br>
		                		                	<strong style="font-size: 15px; font-weight:bold;width: 100%;word-wrap:break-word;"><?php echo $this->Lang['WEBSITE']; ?>: <?php echo $p->website; ?> </strong>
		               
		                			        </div>
		            <div style="float:left; width: 45%; margin-left: 20px;">
			            			                 <strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['SHIP_ADDR']; ?></strong>
			                <br>
		                		                <strong style="font-size: 15px; font-weight:bold;"><?php echo ucfirst($p->name); ?> </strong><br>
		                <?php echo $p->saddr1."<br />".$p->saddr2; ?>,<br>
										<?php echo $p->city_name . '-' . $p->postal_code; ?><br>
										<?php echo $p->state; ?> , <?php echo $p->country; ?><br>
		                		                	<strong style="font-size: 15px; font-weight:bold;"><?php echo $this->Lang['PHO']; ?>: <?php echo $p->phone; ?> </strong>
		                		                				            		                		            </div>
		            <div style="clear:both;"></div>
		        </div>
		        
		        <hr style="border: 1px dotted black; padding:0; margin: 20px 0 0 0; width: 99%;">
		    	       
		</div>
		
			
               
	    </div>
			</div>
			
                                            </div>
			</td>
				  </tr>
				<?php } } ?>
				</table>
				 <?php if(count($this->products_coupons_list) == 0 ) { ?>
				<tr><td colspan="6"><p class="no_referal"><?php echo $this->Lang['NO_PRODUCTS']; ?></p></td></tr>
				<?php }?>
                                				
				<script type="text/javascript">     
                $(document).keyup(function(e) {
if (e.keyCode == 27) 
  {
$('.popup_show_user').hide();
 } 
});
</script>
