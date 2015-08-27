<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="mergent_det">
                       <fieldset>
                       <legend><?php echo $this->Lang['ADD_USER']; ?></legend>
        
        <form method="post"  class="admin_form">
                <table>
                        <tr>
                                <td><label><?php echo $this->Lang["FIRST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="firstname" maxlength="32"  value="<?php if(!isset($this->form_error['firstname']) && isset($this->userPost['firstname'])){echo $this->userPost['firstname'];}?>" autofocus />
                                <em><?php if(isset($this->form_error['firstname'])){ echo $this->form_error["firstname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["LAST_NAME"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="lastname" maxlength="32"  value="<?php if(!isset($this->form_error['lastname']) && isset($this->userPost['lastname'])){echo $this->userPost['lastname'];}?>"/>
                                <em><?php if(isset($this->form_error['lastname'])){ echo $this->form_error["lastname"]; }?></em>
                                </td>
                        </tr>
                        
                        <tr>
                                <td><label><?php echo $this->Lang["EMAIL_F"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="email" maxlength="255" value="<?php if(!isset($this->form_error['email']) && isset($this->userPost['email'])){echo $this->userPost['email'];}?>"/>
                                <em><?php if(isset($this->form_error['email'])){ echo $this->form_error["email"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["PHONE"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="mobile" maxlength="15" value="<?php if(!isset($this->form_error['mobile']) && isset($this->userPost['mobile'])){echo $this->userPost['mobile'];}?>"/>
                                <em><?php if(isset($this->form_error['mobile'])){ echo $this->form_error["mobile"]; }?></em>
                                </td>
                        </tr>
                         <tr>
                                <td><label><?php echo $this->Lang["ADDR1"]; ?></label><span>*</span></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address1" maxlength="100" value="<?php if(isset($this->userPost['address1'])){echo $this->userPost['address1'];}?>"/>
                                <em><?php if(isset($this->form_error['address1'])){ echo $this->form_error["address1"]; }?></em>
                                </td>
                        </tr>
                        <tr>
                                <td><label><?php echo $this->Lang["ADDR2"]; ?></label></td>
                                <td><label>:</label></td>
                                <td><input type="text" name="address2" maxlength="100" value="<?php if(isset($this->userPost['address2'])){echo $this->userPost['address2'];}?>"/>
                                <em><?php if(isset($this->form_error['address2'])){ echo $this->form_error["address2"]; }?></em>
                                </td>
                        </tr>                        
                       
                        <tr>
                    <td><label><?php echo $this->Lang["SEL_COUNTRY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="country" onchange="return city_change(this.value);">
                        <option value=""><?php echo $this->Lang["SEL_COUNTRY"]; ?></option>
                        
                        <?php foreach($this->country_list as $d){ ?>
                        
                        <option value="<?php echo $d->country_id ?>" <?php if(!isset($this->form_error['country']) && isset($_POST['country'])){ if($_POST['country'] == $d->country_id){ ?> selected <?php } } ?>><?php echo $d->country_name; ?></option>
                          <?php } ?>
                        </select>
                       <em><?php if(isset($this->form_error["country"])){ echo $this->form_error["country"]; }?></em>
                     </td>
                     </tr>
                     
                        <tr id="CitySD">
                    <td><label><?php echo $this->Lang["SEL_CITY"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                        <?php if(!isset($this->form_error['city']) && isset($_POST['city'])){ ?>
				<select name="city">
				<?php foreach($this->city_list as $s){ ?>
				<?php if($s->city_id == $_POST['city']){ ?>
			                <option value="<?php echo $s->city_id; ?>" <?php if(isset($_POST['city'])){ if($_POST['city'] == $s->city_id){ ?> selected <?php } } ?>><?php echo $s->city_name; ?></option>
				<?php } } ?>
		                </select>
			<?php } else{ ?>
		                <select name="city">
		                <option value=""> <?php echo $this->Lang["CITY_FIRST"]; ?></option>
		                </select>
                        <?php } ?>
                        <em><?php if(isset($this->form_error["city"])){ echo $this->form_error["city"]; }?></em>
					</td>
                        </tr> 
                        <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" id="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-user.html'"/></td>
                        </tr>
                </table>
        </form>
        </fieldset>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>






