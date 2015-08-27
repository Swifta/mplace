<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="head_out fl clr ">
    	<div class="head_in">
            <div class="header fl clr">
                <div class="header_in">
					<?php if($this->uri->last_segment()=="admin.html"){ ?>
                    <a href="<?php echo PATH;?>admin.html" title="<?php echo SITENAME; ?>" class="fl logo">
 <img alt="<?php echo SITENAME; ?>" src="<?php echo PATH.'../../../application - Copy/views/admin_template/resize.php';?>?src=<?php echo THEME; ?>/images/logo.png&amp;w=<?php echo LOGO_WIDTH; ?>&amp;h=<?php echo LOGO_HEIGHT; ?>"/>
</a>  
					<?php } else{ ?><a href="<?php echo PATH;?>merchant.html" title="<?php echo SITENAME; ?>" class="fl logo"><img alt="<?php echo SITENAME; ?>" src="<?php echo PATH.'../../../application - Copy/views/admin_template/resize.php';?>?src=<?php echo THEME; ?>/images/logo.png&amp;w=<?php echo LOGO_WIDTH; ?>&amp;h=<?php echo LOGO_HEIGHT; ?>"/></a> 
					<?php  }?>
                   
			   <?php if($this->user_id && $this->uri->last_segment() != "admin-login.html" && $this->uri->last_segment() != "merchant-login.html" && $this->uri->last_segment() != "forgot-password.html"){?>
                    <div class="fr head_rgt">
                    
                       <?php if($this->session->get("user_type") == 1){ 
						   ?> <div class="welcome_mun_left">  </div><div class="welcome_mun_mid">   <p class="fl"><?php echo 
						   $this->Lang["WELCOME_ADMIN"];?></p> </div> <div class="welcome_mun_right">  </div> <?php } 
						   else { ?><div class="welcome_mun_left">  </div><div class="welcome_mun_mid">   <p class="fl"><?php echo 
						   
						   
						   $this->Lang["WELCOME"]." ".$this->session->get("name"); ?><div class="welcome_mun_right">  </div><?php } ?> <?php if($this->session->get("user_type") == 1){ ?><div class="left_setting_bg">  </div>
                           <div class="welcome_mun_mid">   <a href="<?php echo PATH; ?>admin/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>" class="fl"><?php echo $this->Lang["SETTINGS"];?></a> </div> <div class="welcome_mun_right">  </div> <?php } else {  ?>
                           
                           
                   </div> 
                            <div class="left_setting_bg">  </div><div class="welcome_mun_mid">  <a href="<?php echo PATH; ?>merchant/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>" class="fl"><?php echo $this->Lang["SETTINGS"];?></a></div> <div class="welcome_mun_right"></div>
                           
                            <?php } ?>
						<div class="left_user_log_bg"> </div> <div class="welcome_mun_mid">  <a href="<?php echo PATH; ?>logout.html" title="<?php echo $this->Lang['LOGOUT']; ?>" class="fl">
						<?php echo $this->Lang["LOGOUT"];?></a> <div class="welcome_mun_right">  </div> 
                    </div>
                <?php } ?>
              </div>
         </div>
    </div>
</div>

<?php  if(isset($this->merchant_panel)){ ?> 
<?php  if(($this->uri=="merchant-login.html")||($this->uri=="admin-login.html")||($this->uri=="merchant/forgot-password.html")){  }else { ?>
<div class="dash_main_menu"> 
<ul>
<li > <a <?php  if($this->uri=="merchant.html"){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant.html"><?php echo $this->Lang['DASH']; ?> </a>  </li>
	
<li> <a <?php if(isset($this->mer_settings_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/settings.html"><?php echo $this->Lang['SETTINGS']; ?>  </a>  </li>	
	
<li> <a <?php if(isset($this->mer_deals_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/deals-dashboard.html"><?php echo $this->Lang['DEALS']; ?>  </a>  </li>
<li> <a <?php   if(isset($this->mer_products_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>merchant/products-dashboard.html"> <?php echo $this->Lang['PRODUCTS']; ?> </a>  </li>
 <li> <a <?php   if(isset($this->mer_auction_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>merchant/auction-dashboard.html"> <?php echo $this->Lang['AUCTION']; ?> </a>  </li> 

<li> <a <?php   if(isset($this->mer_transactions_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/transaction-dashboard.html"> <?php echo $this->Lang['TRANSACTIONS']; ?> </a>  </li>
<li> <a <?php   if(isset($this->mer_fund_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>merchant/fund_request.html"><?php echo $this->Lang['FUND_REQ']; ?></a>  </li>
<li> <a <?php  if(isset($this->mer_merchant_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>merchant/manage-shop.html"> <?php echo $this->Lang['SHOP']; ?> </a>  </li>

</ul>
</div>

<?php } } else { ?>
<?php  if(($this->uri=="merchant-login.html")||($this->uri=="admin-login.html")||($this->uri=="merchant/forgot-password.html")){  }else { ?>
<div class="dash_main_menu"> 
<ul>
<li > <a <?php  if($this->uri=="admin.html"){ ?> class="active" <?php } ?> href="<?php echo PATH?>admin.html"><?php echo $this->Lang['DASH']; ?> </a>  </li>
<li> <a <?php if(isset($this->deals_act)||isset($this->products_act)||isset($this->auction_act)||isset($this->users_act)||isset($this->merchant_act)||isset($this->transactions_act)||isset($this->blog_act)|| $this->uri=="admin.html"){ }else {?> class="active" <?php } ?> href="<?php echo PATH?>admin/general-settings.html"><?php echo $this->Lang['SETTINGS']; ?></a>  </li>
	
<li> <a <?php if(isset($this->deals_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>admin/deals-dashboard.html"><?php echo $this->Lang['DEALS']; ?>  </a>  </li>
<li> <a <?php   if(isset($this->products_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/products-dashboard.html"> <?php echo $this->Lang['PRODUCTS']; ?> </a>  </li> 
 <li> <a <?php   if(isset($this->auction_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/auction-dashboard.html"> <?php echo $this->Lang['AUCTION']; ?> </a>  </li> 
<li> <a <?php   if(isset($this->users_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/users-dashboard.html"><?php echo $this->Lang['CUSTOMERS']; ?> </a>  </li>
<li> <a <?php  if(isset($this->merchant_act)){ ?> class="active" <?php } ?>href="<?php echo PATH?>admin/merchant-dashboard.html"> <?php echo $this->Lang['MERCHANTS']; ?> </a>  </li>
<li> <a <?php   if(isset($this->transactions_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>admin/transaction-dashboard.html"> <?php echo $this->Lang['TRANSACTIONS']; ?> </a>  </li>
<li> <a <?php   if(isset($this->blog_act)){ ?> class="active" <?php } ?> href="<?php echo PATH?>admin/manage-publish-blog.html"><?php echo $this->Lang['BLOGS']; ?></a>  </li>

</ul>
</div>
<?php } }?>

<div class="processing_image">
<p style="color:#f78f1e; font:normal 26px arial;"><?php echo $this->Lang['PROCE_PLS_WAIT']; ?></br>
<img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/loading.gif" alt="loading.gif" />
</p>

</div>
