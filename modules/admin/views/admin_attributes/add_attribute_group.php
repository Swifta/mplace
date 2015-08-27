<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
	
        <form action="" method="post" class="admin_form">
            <table>
                 <tr>
                    <td><label><?php echo $this->Lang['ATTR_GROUP_LABEL']; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td><input type="text" name="groupname" maxlength="100" value="<?php if(!isset($this->form_error['groupname']) && isset($this->userPost['groupname'])){ echo $this->userPost['groupname']; }?>" autofocus />
                    <em><?php if(isset($this->form_error["groupname"])){ echo $this->form_error["groupname"]; }?></em></td>
                </tr>
                
				<tr>
                    <td><label><?php echo $this->Lang['SORT_ORDER']; ?></label> </td>
                    <td><label>:</label></td>
                    <td><input type="text" name="sort_order" size="2" style="width:10%" maxlength="2" value="<?php if(!isset($this->form_error['sort_order']) && isset($this->userPost['sort_order'])){ echo $this->userPost['sort_order']; }?>" />
                    <em><?php if(isset($this->form_error["sort_order"])){ echo str_replace("sort_order","sort order",$this->form_error["sort_order"]); }?></em></td>
                </tr>
				
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>admin/add-attribute-group.html'"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>