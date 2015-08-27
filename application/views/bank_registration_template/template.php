<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->template->title; ?></title>
<link rel="shortcut icon" href="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/favicon.png" type="image/x-icon" />



<?php 
echo $this->template->style; 
echo $this->template->javascript;
?>


</head>
<body>
    <div class="container_outer fl clr">
		<?php  echo new View("bank_registration_template/header"); ?>

        <div class='success_msg_out'>
		    <?php if(!empty($this->response)){ ?>
            <div class="status success" id="messagedisplay" >
            	<p class="closestatus cursur" ><a title="<?php echo $this->Lang['CLOSE']; ?>" onclick="return closeerr();" >x</a></p>
            	<p>
                	<img src="<?php echo PATH; ?>images/icon_success.png" alt="<?php echo $this->Lang['SUCCESS']; ?>" />
                	<span><?php echo $this->Lang["SUCCESS"]; ?>!&nbsp;</span><span class="align_c" ><?php echo $this->response; ?></span>
                </p>
            </div>
            <?php } ?>
            <?php  if(!empty($this->error_response)){ ?>
            <div class="status error" id="error_messagedisplay" >
            	<p class="closestatus cursur" ><a  title="<?php echo $this->Lang['CLOSE']; ?>"  onclick="return closeerr('err');" >x</a></p>
            	<p>
                	<img src="<?php echo PATH; ?>images/icon_error.png" alt="<?php echo $this->Lang['ERROR']; ?>" />
                	<span><?php echo $this->Lang["ERROR"]; ?>!&nbsp;</span> <?php echo $this->error_response; ?>
                </p>
            </div>
            <?php } ?>
		
		</div>
         
       <?php
		if($this->uri->last_segment() == "admin-login.html" || $this->uri->last_segment() == "merchant-login.html" || $this->uri->last_segment() == "forgot-password.html"|| $this->uri->last_segment() == "admin.html" || $this->uri->last_segment() == "merchant.html" && $this->uri!= "admin/merchant.html"){      
			echo $this->template->content; 
		} 

		else {
			
		?>
        <div class="con_out fl clr">
            <div class="con_in"> 
                <div class="con_bdy fl">
				<?php if($this->session->get("user_type") == 1){ ?>
				<?php  echo new View("bank_registration_template/admin_menu"); ?>
				<?php } else if($this->session->get("user_type") == 3) { ?>
					<?php  echo new View("bank_registration_template/merchant_menu"); ?>
					<?php } ?>
                    <div class="cont_rgt fl">
                        <div class="container_rgt_head fl clr">
                        	<h1><?php echo $this->template->title; ?></h1>
                        </div>
                        <div class="container_content fl clr">
                        	<?php echo $this->template->content; ?>
                        </div>
                    </div>
                </div>               
            </div>
        </div> 
        
        <?php } ?>
        <?php  echo new View("bank_registration_template/footer"); ?>   
    </div>
</body>
</html>
<html>
<head>




