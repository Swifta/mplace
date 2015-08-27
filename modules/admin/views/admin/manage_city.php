<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH.'admin.html'; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
    <form method="post">
        <div class="table_over_flow">
        <table class="list_table fl clr">
        <?php $this->session->set("lasturl",substr($_SERVER['REQUEST_URI'], REQUEST_URL_COUNT));  ?>
        	<tr><th align="left"><?php echo $this->Lang['S_NO']; ?></th>
            	<th align="left"><?php echo $this->Lang["CITY"]; ?></th>
            	<th align="left"><?php echo $this->Lang["COUNTRY"]; ?></th>
                <th align="left"><?php echo $this->Lang["EDIT"]; ?></th>
                <th align="left"><?php echo $this->Lang["STATUS"]; ?></th>
               <th align="left"><?php echo $this->Lang["DELETE"]; ?></th> 
                <?php /** <th align="left"><?php echo $this->Lang["CITY_MAPPING"]; ?></th> **/ ?>
                <th align="left"><?php echo $this->Lang["DEFAULT"]; ?></th>
            </tr>
            <?php  $i= 1; foreach($this->cityDataList as $c){?>
                <tr><td align="left"><?php echo $i;?></td>
                    <td align="left"><?php echo ucfirst(htmlspecialchars($c->city_name)) ; ?></td>
                     <td align="left"><?php echo ucfirst(htmlspecialchars($c->country_name)) ; ?></td>
                    <td align="left">
                    	<a href="<?php echo PATH.'admin/edit-city/'.$c->country_id.'/'.$c->city_url;?>.html" class="editicon" title="<?php echo $this->Lang['EDIT_CITY']; ?>"></a>
                    </td>
                    <td>
			<?php if($c->default == 1){ ?>
                    	<?php if($c->city_status == 1){ ?>
                    	<div class="blockicon" title="<?php echo $this->Lang['BLO_CITY']; ?>"></div>
                        <?php } else {  ?>
                        <a onclick="return blockunblockCity('<?php echo $c->country_id; ?>','<?php echo $c->city_url; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_CITY']; ?>"></a>
                        <?php } ?>
			<?php } else { ?>

			                 	<?php if($c->city_status == 1){?>
                    	<a onclick="return blockunblockCity('<?php echo $c->country_id; ?>','<?php echo $c->city_url; ?>','block');" class="blockicon" title="<?php echo $this->Lang['BLO_CITY']; ?>"></a>
                        <?php } else{  ?>
                        <a onclick="return blockunblockCity('<?php echo $c->country_id; ?>','<?php echo $c->city_url; ?>','unblock');" class="unblockicon" title="<?php echo $this->Lang['UNBLO_CITY']; ?>"></a>

			<?php } ?>
			<?php } ?>
                    </td>
                   <td>
                    	<a onclick="return deleteCity('<?php echo $c->country_id; ?>','<?php echo $c->city_url; ?>');" class="deleteicon" title="<?php echo $this->Lang['DEL_CITY']; ?>" ></a>
                    </td>
                 <?php /* <td><a href="<?php echo PATH;?>admin/city-maping/<?php echo $c->country_id; ?>/<?php echo $c->city_id; ?>/<?php echo $c->city_url; ?>.html">Mapping</a></td> */ ?>
                    <td>
                    	<input type="radio" name="default_city" <?php if($c->default == 1){?>checked = "checked"<?php }?> value="<?php echo $c->city_id; ?>"/>
                    </td> 
    
                   
                </tr>
               
            <?php  $i++; } ?>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['UPDATE']; ?>" /></td>
                </tr>   
        </table>
    </div>
        </form>
        
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
