<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">	
         <form action="" method="post" class="admin_form" enctype="multipart/form-data">
            <table width="100%">
			<tr><td><label><?php echo $this->Lang["ADD_TITLE"]; ?>:</label><span>*</span></td>

			<td><input type="text" name="add_title" value="<?php if(!isset($this->form_error['add_title']) && isset($this->AddPost['add_title'])){ echo $this->AddPost['add_title']; }?>" autofocus ><em><?php if(isset($this->form_error["add_title"])){ echo $this->form_error["add_title"]; }?></em></td>
</tr>
			
               <tr>

        	<td><label><?php echo $this->Lang["ADS_POSITION"]; ?> :</label><span>*</span></td>
               <td>
            <select name="ads_position" onchange="mychange(this.value)">            
                        <?php 
			        $ads_position = Kohana::config('settings'); 
			        if(!isset($this->form_error['ads_position']) && isset($this->AddPost['ads_position'])){   
			        foreach($ads_position["ads_position"] as $index => $position){
			        if($this->AddPost['ads_position'] == $index){
			?>
            	<option value="<?php echo $index; ?>"><?php echo $position;?></option>
            <?php }}}else{ ?>
            <option value=""><?php echo $this->Lang['SEL_ADS_POS']; ?></option>  
                        <?php  
				} 
				foreach($ads_position["ads_position"] as $index => $position){
			?>
            	<option value="<?php echo $index; ?>"><?php echo $position;?></option>
            <?php } ?>
		    </select><em><?php if(isset($this->form_error["ads_position"])){ echo $this->form_error["ads_position"]; }?>
               </td> 
               </tr>

		<?php /*
		<tr>
			<td><label><?php echo $this->Lang["ADD_CODE"]; ?> :</label><span>*</span></td>
			<td><textarea  cols="5" rows="5" name="add_code"value="<?php if(!isset($this->form_error['add_code']) && isset($this->AddPost['add_code'])){ echo $this->AddPost['add_code']; }?>" rows="6" cols="80"></textarea><em><?php if(isset($this->form_error["add_code"])){ echo $this->form_error["add_code"]; }?></em></td>
		</tr> */ ?>
		
				<tr>
                    <td><label><?php echo $this->Lang['PAGE']; ?>*</label></td>
                    
                    <td>
                    	<select name="pages">
							<option value=""><?php echo $this->Lang['SEL_PAGE']; ?></option>
							<option value="1"<?php if(isset($this->AddPost['pages']) && ($this->AddPost['pages'] =="1")) { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['HOME']; ?></option>
							<option value="2"<?php if(isset($this->AddPost['pages']) && ($this->AddPost['pages'] =="2")) { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['DEALS']; ?></option>
							<option value="3" <?php if(isset($this->AddPost['pages']) && ($this->AddPost['pages'] =="3")) { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['PRODUCT']; ?></option>
							<option value="4"<?php if(isset($this->AddPost['pages']) && ($this->AddPost['pages'] =="4")) { ?> selected="selected" <?php } ?> ><?php echo $this->Lang['AUCTION']; ?></option>
							
                    	</select>
                    	<em><?php if(isset($this->form_error["pages"])){ echo $this->form_error["pages"]; }?></em>
                    </td>
                </tr>
                <tr>
                    <td><label><?php echo $this->Lang['REDIRECT']; ?>*</label></td>
                    
                    <td>
                    	<input type="text" name="redirect_url" value="<?php if(!isset($this->form_error['redirect_url']) && isset($this->userPost['redirect_url'])){ echo $this->userPost['redirect_url']; }?>" />
                    	<em><?php if(isset($this->form_error["redirect_url"])){ echo $this->form_error["redirect_url"]; }?></em>
                    </td>
                </tr>
                 <tr>
              <td><label><?php echo $this->Lang['UPLOAD']; ?>*</label></td>
              
              <td>
                  	<input type="file" name="image" /><label id="show_size" style="display:none;"></label>
                   	<em><?php if(isset($this->form_error["image"])){ echo $this->form_error["image"]; }?></em>
              </td>
                </tr>

		<tr><td></td>
			<td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>"/>
			<input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>adds_mgmt/add_adds.html'"/></td>
		</tr>
            </table>
        </form>
        </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
<script>
function mychange(a)
{ 
	$('label#show_size').hide();
	if(a =='hr') { $('label#show_size').html('Image upload size 350px x 250px');
	$('label#show_size').show();
} else if(a =='ls') { $('label#show_size').html('Image upload size 180px x 500px');
	$('label#show_size').show();
}else if(a =='bf') { $('label#show_size').html('Image upload size 790px x 100px');
	$('label#show_size').show();
}
}
</script>
