<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    
    
     
                <div class="mergent_det2">
      <fieldset>
    		<legend><?php echo $this->template->title; ?></legend>
        <table class="list_table fl clr show_details_table">
            <?php foreach( $this->users_deatils as $d){			
		?>
              
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["FIRST_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->firstname)); ?></td>
                </tr>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["LAST_NAME"]; ?></th><th valign="top">:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->lastname)); ?></td>
                </tr>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["EMAIL_F"]; ?></th><th valign="top">:</th><td align="left"><?php echo $d->email; ?></td>
                </tr>

                <tr>
                   <th valign="top" align="left"><?php echo $this->Lang["PHONE"]; ?></th><th valign="top">:</th><td align="left"><?php echo nl2br($d->phone_number);?></td>
                </tr>
               
                <tr>
                        <th align="left" ><?php echo $this->Lang["ADDR1"]; ?></th><th>:</th><td align="left"><?php echo htmlspecialchars($d->address1); ?></td>
                </tr>
                <tr>
                        <th align="left"><?php echo $this->Lang["ADDR2"]; ?></th><th>:</th><td align="left"><?php echo htmlspecialchars($d->address2); ?></td>
                </tr>
                <tr>
                        <th align="left" ><?php echo $this->Lang["COUNTRY"]; ?></th><th>:</th><td align="left"><?php echo htmlspecialchars($d->country_name); ?></td>
                </tr> 	
                
                <tr>
                        <th align="left" ><?php echo $this->Lang["CITY"]; ?></th><th>:</th><td align="left"><?php echo ucfirst(htmlspecialchars($d->city_name)); ?></td>
                </tr>
                
                <tr>
                        <th align="left" ><?php echo $this->Lang["REFERAL_AMMOUNT_ERN"]; ?></th><th>:</th><td align="left"><?php echo CURRENCY_SYMBOL.$d->user_referral_balance; ?></td>
                </tr>
                
                <tr>
                        <th align="left" ><?php echo $this->Lang["REFERAL_LINK"]; ?></th><th>:</th><td align="left"><?php echo PATH;?>referral/<?php echo $d->referral_id;?></td>
                </tr>
                
		<tr>
                     <th valign="top" align="left" width="20%"><?php echo $this->Lang["LOGIN_TYPE"]; ?></th><th valign="top">:</th><td align="left">
                     <?php if($d->login_type=='1'){ ?><?php echo $this->Lang["NOR_USER"]; ?>
                     <img src="<?php echo PATH."images/user_icon.png";?>" title="<?php echo $this->Lang["NOR_USER"]; ?>"/>
                     <?php } elseif($d->login_type=='2') {?> <?php echo $this->Lang["ADMIN_USER"]; ?>
                     <img src="<?php echo PATH."images/mail_user.png";?>" title="<?php echo $this->Lang["ADMIN_USER"]; ?>"/>
                     <?php } elseif($d->login_type=='3') {?> <?php echo $this->Lang["FACEBOOK_USER"]; ?>
                     <img src="<?php echo PATH."images/facebook_link.png";?>" title="<?php echo $this->Lang["FACEBOOK_USER"]; ?>"/>
                     <?php } elseif($d->login_type=='4') {?> <?php echo $this->Lang["TWITER_USER"]; ?>
                     <img src="<?php echo PATH."images/twitter_link.png";?>" title="<?php echo $this->Lang["TWITER_USER"]; ?>"/>
                     <?php } ?>
                     </td>
                </tr>
                <tr>
                         <th valign="top" align="left" width="20%"><?php echo $this->Lang["JOIN_DATE"]; ?></th><th valign="top">:</th><td align="left"><?php echo date('d-M-Y H:m:s', $d->joined_date); ?></td>
                </tr>
                
                     <?php } ?> 
                     </table>
                     
                     <div class="chart_1 fl">
    <ul>
    <li  id="userdate" class=" selected fl"> 
      <div class="tab1"></div>
      <div class="tab2" ><a  onclick="return User_date();" id="userdate"><?php echo $this->Lang['DLS_TRANS_DET']; ?></a></div>
      <div class="tab3"></div>
    </li>
    <li class=" fl" id="usermonth">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_month();"  id="usermonth"><?php echo $this->Lang['PRODU_TR_DETAIL']; ?></a></div>
      <div class="tab3"></div>
    </li>
    
   <li class=" fl" id="useryear">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_year();"  id="useryear"><?php echo $this->Lang['AUC_TR_DETAIL']; ?></a></div>
      <div class="tab3"></div>
    </li>
    
    <li class=" fl" id="reflist">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_ref();"  id="reflist"><?php echo $this->Lang['REFERR_LIST']; ?></a></div>
      <div class="tab3"></div>
    </li>
  </ul>
</div> 
                </fieldset>
                </div>
                       <div class="mergent_det2 user_date">
      <fieldset>
    		<legend ><?php echo $this->Lang['DLS_TRANS_DET']; ?></legend>
        <table class="list_table fl clr show_details_table">
                    
                   
                <tr> 
                <td colspan="3"> <?php echo new View("payment/transaction_list"); ?></td>

                 </tr> 
                 
              </table>
			  </fieldset>
			  </div>   		
			  
			  <div class="mergent_det2 user_month">
      <fieldset>
    		<legend><?php echo $this->Lang['PRODU_TR_DETAIL']; ?></legend>
        <table class="list_table fl clr show_details_table">
                    
                   
                <tr> 
                <td colspan="3"> <?php echo new View("payment/product_transaction_list"); ?></td>

                 </tr> 
                 
              </table>
			  </fieldset>
			  </div>   		  
			    
			  
			  <div class="mergent_det2 user_year">
      <fieldset>
    		<legend><?php echo $this->Lang['AUC_TR_DETAIL']; ?></legend>
        <table class="list_table fl clr show_details_table">
                    
                   
                <tr> 
                <td colspan="3"> <?php echo new View("payment/biding_transaction_list"); ?></td>

                 </tr> 
                 
              </table>
			  </fieldset>
			  </div>   
                 
                 <div class="mergent_det2 user_ref">
      <fieldset>
    		<legend><?php echo $this->Lang['REFER_LIST']; ?></legend>
        <table class="list_table fl clr show_details_table">
              
    
                    
                <tr> 
                <?php if(count($this->user_refrel_list) > 0 ) { ?>
                <td colspan="3"> 
                <table class="list_table fl clr mt20">
                        
        	        <tr>
			<th align="left" ><?php echo $this->Lang['S_NO']; ?></span></th>
			<th align="left" ><?php echo $this->Lang['USER_NAME']; ?></span></th>
			<th align="left" ><?php echo $this->Lang['EMAIL_ID']; ?></span></th>
			<th align="left" ><?php echo $this->Lang['JOIN_DATE']; ?></span></th>
			<th align="left" ><?php echo $this->Lang['PURCHACE_COUNT']; ?></span></th>
                        </tr>
                       
                         <?php $i=1; foreach($this->user_refrel_list as $u){ ?>
                         <tr> 
         	         <td align="left"><?php echo $i; ?></span></td>
         	         <td align="left"><?php echo $u->firstname;?></span></td>
         	         <td align="left"><?php echo $u->email;?></span></td>
         	         <td align="left"><?php echo  date('d-M-Y',$u->joined_date);?></span></td>
         	         <td align="left"><?php echo $u->deal_bought_count;?></span></td>
         	         </tr>
         	          <?php $i++;  } ?>
         	         
         	         </table>
					
                
                </td>
                <?php } else { ?>
                 <td colspan="3">
                <p class="nodata"> <?php echo $this->Lang['NO_REFERAL']; ?>   </p>
                </td>
                
                 <?php }?>

                 </tr>
				 </table>
				 </fieldset>
				 </div>
                     
                <tr><td colspan="3"><a href="javascript:history.back();" class="back_btn"><?php echo $this->Lang["BACK"]; ?></a></td></tr>  
                
        </table>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
