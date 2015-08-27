<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo PATH ?>css/jquery.cleditor.css">
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.cleditor.min.js"></script>

<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form">
            <table>
                <tr>
    <td><label><?php echo $this->Lang["CITY"]; ?></label><span>*</span></td>
    <td><label>:</label></td>
    <td><select name="city" autofocus tabindex="1" > 
                <?php 
                if(!isset($this->form_error["city"]) && isset($this->userPost["city"])){
                        foreach($this->city_list as $c){
                                if($c->city_id == $this->userPost["city"]){
									$cityname=$c->city_name;
									$cityid=$c->city_id;
                                } elseif($this->userPost["city"]=="all") { $cityname="all"; $cityid="all"; ?>
									
								<?php } 
                        } ?>
                        <option value="<?php echo $cityid; ?>"><?php echo ucfirst($cityname); ?></option> 
                        <?php
                }
                else{
                ?>
            <option value=""> <?php echo $this->Lang['SEL_CITY']; ?> </option>
            <option value="<?php echo $this->Lang['ALL2']; ?>"><?php echo $this->Lang['ALL']; ?></option>
	    <?php } foreach($this->city_list as $c){ ?>
            <option value="<?php echo $c->city_id; ?>"><?php echo ucfirst($c->city_name); ?></option>  
            <?php } ?>
        </select>
        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
    </td>
                  </tr>
                  <tr>
                        <td><label><?php echo $this->Lang["SUBJECT"]; ?></label><span>*</span></td>
                        <td><label>:</label></td>
                        <td><input type="text" name="subject"  value="<?php if(!isset($this->form_error['subject']) && isset($this->userPost['subject'])){ echo $this->userPost['subject']; }?>" />
                        <em><?php if(isset($this->form_error["subject"])){ echo $this->form_error["subject"]; }?></em></td>
                 </tr>
                 <tr>
                        <td valign="top"><label><?php echo $this->Lang["MSGG"]; ?></label><span>*</span></td>
                        <td valign="top"><label>:</label></td>
                        <td><textarea cols="20" rows="5" name="message" class="TextArea"><?php if(!isset($this->form_error['message']) && isset($this->userPost['message'])){echo $this->userPost['message'];}?></textarea>
                        </td>
                 </tr>
                 <tr>
                        <td></td>
                        <td></td>
                        <td><input type="submit" value="<?php echo $this->Lang['SEND']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin.html"'/></td>
                 </tr>
            </table>
        </form>
    </div>

    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>

</div>


