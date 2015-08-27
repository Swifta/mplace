<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<script src="<?php echo PATH.'../../../../../application - Copy/views/themes/default/seller/themes'.THEME_NAME.'/js/jquery.validate.js'; ?>" type="text/javascript"></script>
<style>
.error{float: left;width: 50%; } 
</style>

<!-- SELLER SIGNUP -->
    <div class="contianer_outer">
        <div class="contianer_inner">
            <div class="contianer">                
                <h2 class="seller_sign_title"><?php echo $this->Lang['WEL_SEL_SIGN']; ?></h2>
                <p class="seller_sign_info"><?php echo $this->Lang['YOU_GUIDED_CRTE_STRE']; ?></p>
                <div class="seller_signup clearfix">
                    <div class="seller_signup_menu">
                        <div class="seller_signup_introduction">
                            <span>01</span>
                            <p><?php echo $this->Lang['INTRO']; ?></p>
                        </div>
                        <div class="seller_signup_form_submit active_tab">
                            <span>02</span>
                            <p><?php echo $this->Lang['SIGN_UP']; ?></p>                            
                        </div>
                        <div class="seller_signup_finish">                            
                            <span>03</span>
                            <p><?php echo $this->Lang['FINISH']; ?></p>                            
                        </div>
                    </div>
                <form action="" method="post" name="signup2" id="signup2"  onclick="return atleast_onecheckbox(event)" >
                    <div class="payouter_block pay_br">
                        <h3 class="paybr_title pay_titlebg"><?php echo $this->Lang['CRTE_YR_STRE']; ?>: <?php echo $this->Lang['SIGN_UP']; ?></h3>
                        <div class="p_inner_block clearfix">
                            <div class="payment_form_section">
                                <div class="payment_form payment_shipping_form ">
                                <ul>
                                    <li>
                                        <label><?php echo $this->Lang["FIRST_NAME"]; ?>:</label>
                                <div class="fullname">
									<input autofocus type="text" name="firstname" class="required" 
									<?php if($this->session->get('firstname')) { ?>
									value="<?php  echo $this->session->get('firstname'); ?>" placeholder= "<?php echo $this->Lang['FIRST_NAME']; ?>" /> 			<?php } else { ?>
									value="<?php  if(!isset($this->form_error['firstname']) && isset($this->userPost['firstname'])){echo $this->userPost['firstname'];} ?>" placeholder= "<?php echo $this->Lang['FIRST_NAME']; ?>" />
									<?php } ?>
									<em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
								</div>
                                    </li>
					<li>			
                                            <label><?php echo $this->Lang["LAST_NAME"]; ?>:</label>
								<div class="fullname">
								        
									<input type="text" name="lastname" class="required" 
									<?php if($this->session->get('lastname')) { ?>
									value="<?php  echo $this->session->get('lastname'); ?>" placeholder= "<?php echo $this->Lang['LAST_NAME']; ?>" /> 			                <?php } else { ?>
									value="<?php if(!isset($this->form_error['firstname']) && isset($this->userPost['lastname'])){echo $this->userPost['lastname'];}?>" placeholder= "<?php echo $this->Lang["LAST_NAME"]; ?>"  />
									<?php } ?>
									<em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
								</div>
                                    </li>
                                    <li>
                                        <label><?php echo $this->Lang["EMAIL_F"]; ?>:</label>
								<div class="fullname">
									<input type="text" name="email"  class="required email" 
									<?php if($this->session->get('memail')) { ?>
									value="<?php  echo $this->session->get('memail'); ?>" placeholder= "<?php echo $this->Lang['EMAIL_F']; ?>" /> 			                <?php } else { ?>
									 value="<?php if(!isset($this->form_error['email']) && isset($this->userPost['email'])){echo $this->userPost['email'];}?>" placeholder= "<?php echo $this->Lang["EMAIL_F"]; ?>"  />
									 <?php  } ?>
									<label class="error"><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></label>
								</div>
                                    </li>
                                    <li>
                                        <label><?php echo $this->Lang['ADD_PAYPAL_ACC']; ?>:</label>
                                <div class="fullname">
                                
									<input type="text" name="payment_acc" class="required email" 
									<?php if($this->session->get('payment_acc')) { ?>
									value="<?php  echo $this->session->get('payment_acc'); ?>" placeholder= "<?php echo $this->Lang['ADD_PAYPAL_ACC']; ?>" /> 			                        <?php } else { ?>
									value="<?php if(!isset($this->form_error['payment_acc']) && isset($this->userPost['payment_acc'])){echo $this->userPost['payment_acc'];}?>" placeholder="<?php echo $this->Lang['ADD_PAYPAL_ACC']; ?>" />
									<?php } ?>
									<em><?php if(isset($this->form_error['payment_acc'])){ echo $this->form_error["payment_acc"]; }?></em>
                                </div>
                                    </li>                                    
					<li class="frm_clr">			
                                            <label><?php echo $this->Lang["ADDR1"]; ?>:</label>
								<div class="fullname">
									<input type="text" name="mr_address1" class="required" 
									<?php if($this->session->get('mraddress1')) { ?>
									value="<?php  echo $this->session->get('mraddress1'); ?>" placeholder= "<?php echo $this->Lang['ADDR1']; ?>" /> 			 <?php } else { ?>
									value="<?php if(isset($this->userPost['mr_address1'])){echo $this->userPost['mr_address1'];}?>" placeholder="<?php echo $this->Lang["ADDR1"]; ?>" />
									<?php } ?>
									<em><?php if(isset($this->form_error['mr_address1'])){ echo $this->form_error["mr_address1"]; }?></em>
                                        </div>
                                    </li>
                                    
                                <li>
                                    <label><?php echo $this->Lang["ADDR2"]; ?>:</label>
                                 <div class="fullname">
									<input type="text" name="mr_address2" class="required" 
									<?php if($this->session->get('mraddress2')) { ?>
									value="<?php  echo $this->session->get('mraddress2'); ?>" placeholder= "<?php echo $this->Lang['ADDR2']; ?>" /> 			 <?php } else { ?>
									value="<?php if(isset($this->userPost['mr_address2'])){echo $this->userPost['mr_address2'];}?>" placeholder="<?php echo $this->Lang["ADDR2"]; ?>" />
									<?php } ?>
									<em><?php if(isset($this->form_error['mr_address2'])){ echo $this->form_error["mr_address2"]; }?></em>
                                 </div>
                                </li>
                                <li class="frm_clr">
                                        <label><?php echo $this->Lang["PHONE"]; ?>:</label>
								<div class="fullname">
									<input type="text" name="mr_mobile" class="required number" 
									<?php if($this->session->get('mphone_number')) { ?>
									value="<?php  echo $this->session->get('mphone_number'); ?>" placeholder= "<?php echo $this->Lang['PHONE']; ?>" /> 			 <?php } else { ?>
									value="<?php if(!isset($this->form_error['mr_mobile']) && isset($this->userPost['mr_mobile'])){echo $this->userPost['mr_mobile'];}?>" placeholder="<?php echo $this->Lang["PHONE"]; ?>"  />
									<?php } ?>
									<em><?php if(isset($this->form_error['mr_mobile'])){ echo $this->form_error["mr_mobile"]; }?></em>
                                </div>
                                </li>
                                
                                <li>
                                    <label>Shipping method:</label>
                         <table> 
                                 <label>
                                        <?php if($this->free_shipping_setting == 1){ ?>
                                        <tr><td><label><input type="checkbox" name="free" value="1" 
                                        <?php if($this->session->get('payment_acc')) { if($this->session->get('free')) { ?>
                                        checked <?php } } else { ?> checked <?php } ?>>Free Shipping</label></td>
                                        <?php } else { ?>
                                        <input type="hidden" name="free" value="0" >
                                        <?php } if($this->flat_shipping_setting == 1){ ?>
                                       <td><label><input type="checkbox" name="flat" value="1" <?php if($this->session->get('payment_acc')) { if($this->session->get('flat')) { ?>
                                        checked <?php } } else { ?> checked <?php } ?>>Flat Shipping</label></td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="flat" value="0" >
                                        <?php } if($this->per_product_setting == 1){ ?>
                                        <tr><td><label><input type="checkbox" name="product" value="1" <?php if($this->session->get('payment_acc')) { if($this->session->get('product')) { ?>
                                        checked <?php } } else { ?> checked <?php } ?>>Per product base Shipping</label></td>
                                        <?php } else { ?>
                                        <input type="hidden" name="product" value="0" >
                                        <?php } if($this->per_quantity_setting == 1){ ?>
                                        <td><label><input type="checkbox" name="quantity" value="1" <?php if($this->session->get('payment_acc')) { if($this->session->get('quantity')) { ?>
                                        checked <?php } } else { ?> checked <?php } ?>>Per quantity base Shipping</label></td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="quantity" value="0" >
                                        <?php } if($this->aramex_setting == 1){ ?>
                                        <tr><td><label><input type="checkbox" name="aramex" value="1" <?php if($this->session->get('payment_acc')) { if($this->session->get('aramex')) { ?>
                                        checked <?php } } else { ?> checked <?php } ?>>Aramex Shipping</label></td><td></td></tr>
                                        <?php } else { ?>
                                        <input type="hidden" name="aramex" value="0" >
                                        <?php } ?>
                                        </label>
                                        </table>
                                </li>
                                
                                    </ul>
                                    <div>
                            </div>
                        </div>
                    </div>
                    <div class="buy_it complete_order_button">
                        <input type="submit" title="<?php echo $this->Lang['SAVE']; ?> & <?php echo $this->Lang['CONTINUE']; ?>" value="<?php echo $this->Lang['SAVE']; ?> & <?php echo $this->Lang['CONTINUE']; ?>" >
                    </div>
               </form>
                </div>
            </div>
        </div>
    </div>
        </div>
    <!-- SELLER SIGNUP -->
    
 <script>
 
    $(document).ready(function(){
         $("#signup2").validate({
			 messages: {				 
		   firstname: {
			   required: "<?php echo $this->Lang['PLS_ENT_FNAM']; ?>"                         
		   },

		   lastname: {
			   required: "<?php echo $this->Lang['PLS_ENT_LNAM']; ?>"                         
		   },

		   email: {
				required:"<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>",
				email:"<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                       
			},
		   
		   mr_address1: {
			   required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"                         
		   },
		     mr_address2: {
			   required: "<?php echo $this->Lang['PLS_ENT_VLD_ADDR']; ?>"                         
		   },
		  mr_mobile : {
			   required: "<?php echo $this->Lang['PLZ_ETR_PHO']; ?>",
			   number: "<?php echo $this->Lang['PLS_ENT_NO']; ?>"                             
			},
			payment_acc: {
				required:"<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>",
				email:"<?php echo $this->Lang['PLS_ENT_EMAIL']; ?>"                       
			},
    },
 submitHandler: function(form) {
   // some other code
   // maybe disabling submit button
   // then:
	// $('div#submit').hide();
   form.submit();
 }
});
});
   


 function submit_form()
 {
	document.signup2.submit();
	 
 }
 </script>
 
 <script> 
	function atleast_onecheckbox(e) {
          if ($("input[type=checkbox]:checked").length === 0) {
              e.preventDefault();
              alert('Shipping Method Should be Mandatory, You should choose any one of the shipping method');
              return false;
          }
}
	</script>
