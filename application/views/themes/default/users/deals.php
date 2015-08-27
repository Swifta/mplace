<table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
<?php if(count($this->deals_coupons_list) > 0 ) { ?>
    <thead>
        <tr>
            <th width="100" align="left"><?php echo $this->Lang['TITLE']; ?> </th>
            <th width="100" align="left"><?php echo $this->Lang['STORE_NAME']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['PURCHASE_DATE']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['EXPIRY']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['STATUS1']; ?></th>
            <th width="100" align="center"><?php echo $this->Lang['DAYS_LEFT']; ?></th>
            <th width="100" align="center"><?php echo $this->Lang['DOWNLOAD']; ?></th>
        </tr>
    </thead>
                                
<?php } ?>

<?php if(count($this->deals_coupons_list) > 0 ) { ?>
					<?php foreach($this->deals_coupons_list as $u){
					  $enddate=date('d-M-Y',$u->expirydate);
					  $current_date=Date("d -F - Y");
					  $start_time = strtotime($current_date);
				  	  $end_time = strtotime($enddate);
				  	  $days_left =  round(($end_time-$start_time)/(3600*24));
				  	  $m=round(($u->expirydate-time())/60);
				  	  $j=0;
				 	  ?>

				 


                                        <tr>
					    <td><a href="<?php echo PATH.'deals/'.$u->deal_key.'/'.$u->url_title.'.html';?>" title="<?php echo $u->deal_title;?>" class="fl clear"><?php echo $u->deal_title;?></a></td>
					    <td><a href="<?php echo PATH.'stores/'.$u->store_key.'/'.$u->store_url_title.'.html';?>" title="<?php echo $u->store_name; ?>"><?php echo $u->store_name; ?></a></td>
					    <td><?php echo date('d-M-Y',$u->transaction_date);?></td>
					    <td><?php echo date('d-M-Y',$u->expirydate);?></td>
                                            <td>
                                                <?php  if(($u->minimum_deals_limit > $u->purchase_count)||($u->captured == 1)) {?>
                                                <span class="ornage"><?php echo $this->Lang['PENDING']; ?></td>
                                                 <?php } else { ?>    
                                                <?php if($u->coupon_code_status =="1") { ?>
                                                <?php if($m > 0){ ?>
                                                <span class="green"><?php echo $this->Lang['ACTIVE']; ?></span>
                                                <?php } else { ?>
                                                <span class="red"><?php echo $this->Lang['EXPIRY']; ?></span>
                                                <?php } } else { $j=1; // for no need to show the coupon  ?>
                                                <span class="black"><?php echo $this->Lang['CLOSED']; ?></span>
                                                <?php } }?>
                                            </td>
					    
					    
					    <td align="center">
					    <?php if(($days_left == "0")and($m > 0)){ ?>
					    <?php echo $m; ?><?php echo $this->Lang['MINUTES']; ?>
					    <?php } else if($m < 0 ) {?>
					    ----
					    <?php } else {?>
					    <?php echo $days_left; ?><?php echo $this->Lang['DAYS']; ?>
					    
					    <?php } ?>
					    </td>


					    <?php  if(($m < 0)||($u->minimum_deals_limit > $u->purchase_count)||($u->captured == 1) || ($j==1) ) {?>
					     <td align="center">----</td>    
					    <?php } /*else if($u->trans_type == 5) {?>
							 <li class="my_buy_downloadcoupon"> <center><?php echo $this->Lang['CO_D']; ?></center> </li>    
						<?php } */ else { ?>
					   <td align="center">
					  <script>
					    function pdf(id)
					    {

						window.location = "<?php echo PATH; ?>pdf.html?id="+id;
					    }
					  </script>
                                          <a class="cur" title="click to download" onclick="pdf('<?php echo $u->coupon_code;?>')"><img src="<?php echo PATH;?>images/user/150_115/pdfimg.png" /></a>
                                           </td>
					 
					 <?php } ?>
					      
					  </tr>
					<?php } } ?>
					</table>
					<?php if(count($this->deals_coupons_list) == 0 ) { ?>
				      <tr><td colspan="6"><p class="no_referal"><p class="no_referal"><?php echo $this->Lang['NO_DEALS']; ?></p></td></tr>
					<?php }?>

