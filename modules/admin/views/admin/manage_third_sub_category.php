<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb">
<a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a>

<a href="<?php echo PATH."admin/manage-category.html"; ?>" title="<?php echo $this->Lang['TOP_CATEGORY']; ?>"><?php echo $this->Lang["TOP_CATEGORY"]; ?> <span class="fwn">&#155;&#155;</span></a>

<a href="<?php echo PATH."admin/manage-sub-category/".$this->main_category_id."/".$this->main_category_url.".html"; ?>" title="<?php echo $this->Lang['MAIN_CATEGORY']; ?>"><?php echo $this->Lang["MAIN_CATEGORY"]; ?> <span class="fwn">&#155;&#155;</span></a>

<a href="<?php echo PATH."admin/manage-sec-sub-category/".$this->sub_category_id."/".$this->sub_category_url.".html"; ?>" title="<?php echo $this->Lang['SUB_CAT']; ?>"><?php echo $this->Lang["SUB_CAT"]; ?> <span class="fwn">&#155;&#155;</span></a>

<p><?php echo $this->template->title; ?></p>
</div>


<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <div class="table_over_flow">
        <table class="fl clr list_table">
        	<tr><th><?php echo $this->Lang['S_NO']; ?></th>
            	<th width="26%"><?php echo $this->Lang["CATEGORY_NAME"]; ?></th>
                <!--<th  align="left" width="30%">Category Mapping</th>-->
                <?php /*<th align="left" width="10%">Image</th> */?>
                <th align="left" width="10%" ><?php echo $this->Lang["EDIT"]; ?></th>
                <th align="left" width="10%" ><?php echo $this->Lang["STATUS"]; ?></th>
                <th align="left" width="27%" ><?php echo $this->Lang["DELETE"]; ?></th>
            </tr>
            <?php $i=1; foreach($this->category_list as $c){ ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ucfirst(htmlspecialchars($c->category_name));?>
					
				</td>
               <!-- <td><?php echo $c->category_mapping ?></td>--->
					<?php /*<td align="left">
						<?php
						
						$Cat_img_URL = "images/category/icon/".url::title($c->category_name).".png";
						if(file_exists($Cat_img_URL)){?> <img src="<?php echo PATH."images/category/icon/".url::title($c->category_name).".png";?>" /> <?php } ?></td>
							*/ ?>
							
		                                

                    <td>
                  	<a href="<?php echo PATH.'admin/edit-third-sub-category/'.$c->category_id.'/'.$c->category_url;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_CATEGORY']; ?>"></a>
                    </td>
                    <td>
                    	<?php if($c->category_status == 1){?>
                    	<a onclick="return blockunblocksceSecCategory('<?php echo $c->sub_category_id; ?>','<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_CAT']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblocksceSecCategory('<?php echo $c->sub_category_id; ?>','<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_CAT']; ?>"></a>
                        <?php } ?>
                    </td>
                    <td>
                    	<a onclick="return thirddeleteCategory('<?php echo $c->category_id; ?>','<?php echo $c->category_url; ?>');" class="deleteicon" title="<?php echo $this->Lang['DELETE']; ?>" ></a>
                    </td>
            </tr>
            <?php $i++; } ?>
        </table>
        </div>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
