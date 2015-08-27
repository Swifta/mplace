<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
      
        <?php foreach($this->user_data as $u){ ?>
        <form method="post" class="admin_form" name="edit_users" >
                <table>
                        <tr> 
                                <td><label><?php echo $this->Lang["FIRST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="firstname" maxlength="32"  value="<?php echo $u->firstname;?>" autofocus />
                                <em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr> 
                                <td><label><?php echo $this->Lang["LAST_NAME"]; ?></label><span></span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="lastname" maxlength="32"  value="<?php echo $u->lastname;?>"/>
                                 <em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="email" maxlength="255" value="<?php echo $u->email;?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" maxlength="15" value="<?php echo $u->phone_number;?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr> 
                          <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" maxlength="100" value="<?php echo $u->address1;?>"/>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" maxlength="100" value="<?php echo $u->address2;?>"/>
                                </td>
                        </tr>                            
                       <tr>
                    <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="country" onchange="return city_change(this.value);">
                        <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>
                        
                        
                        <?php foreach($this->country_list as $d){ ?>
                        <option value="<?php echo $d->country_id ?>" <?php if($d->country_id==$u->country_id) { ?> selected="selected" <?php } ?>><?php echo $d->country_name; ?></option>
                          <?php }  ?>
                        </select>
                        <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
                      
                     </td>
                     </tr>                            
                        <tr id="CitySD">
                    <td><label><?php echo $this->Lang["SEL_CITY"]; ?></label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="city">
                        <option value="" <?php if($u->city_id==0){ ?>selected="selected" <?php } ?>><?php echo $this->Lang["CITY_FIRST"]; ?></option>
	                <?php foreach($this->city_list as $d){ if($u->country_id == $d->country_id) { ?>
	                <option value=<?php echo $d->city_id; ?> <?php if($u->city_id==$d->city_id) { ?> selected="selected" <?php  } ?>><?php echo $d->city_name; ?></option>
	                <?php } }  ?> 
                        </select>
                        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
					</td>
                        </tr>
                        <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>admin/manage-user.html"'/></td>
                        </tr>
                      
                </table>
        </form>
          <?php  }?>
	  
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
