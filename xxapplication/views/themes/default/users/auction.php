<table class="maccount_table_inner" width="100%" cellspacing="0" cellpadding="5" border="0">
<?php if(count($this->auctions_coupons_list) > 0 ) { ?>
    <thead>
        <tr>
            <th width="100" align="left"><?php echo $this->Lang['TITLE']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['STORE_NAME']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['PURCHASE_DATE']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['ADDRES']; ?></th>
            <th width="100" align="left"><?php echo $this->Lang['STATUS1']; ?></th>            
        </tr>
    </thead>
<?php } ?>
<?php if(count($this->auctions_coupons_list) > 0 ) { ?>
				<?php foreach($this->auctions_coupons_list as $p){ ?>
			 
				  <tr>
				    <td><a href="<?php echo PATH.'../../../../../application - Copy/views/themes/default/users/auction'.$p->deal_key.'/'.$p->url_title.'.html';?>" title="<?php echo $p->deal_title;?>" class="fl clear"><?php echo $p->deal_title;?></a></td>
				    <td><a href="<?php echo PATH.'../../../../../application - Copy/views/themes/default/users/stores'.$p->store_key.'/'.$p->store_url_title.'.html';?>" title="<?php echo $p->store_name; ?>"><?php echo $p->store_name; ?></a></td>
				    <td><?php echo date('d-M-Y',$p->transaction_date);?></td>
                                    <td><?php echo $p->de_add1.",".$p->de_add2;?></td>
                                    <td><?php if($p->delivery_status==0) { echo $this->Lang['PENDING']; } elseif($p->delivery_status==1) { echo $this->Lang['ORDER_PACKED']; } elseif($p->delivery_status==2) { echo $this->Lang['SHIPPED_DELI_CENT'];  } elseif($p->delivery_status==3) { echo $this->Lang['OR_OUT_DELI']; } elseif($p->delivery_status==4) { echo $this->Lang['DELIVERED']; } ?></td>
				  </tr>
				<?php } } ?>
				
		</table>		
				<?php if(count($this->auctions_coupons_list) == 0 ) { ?>
				<tr><td colspan="5"><p class="no_referal"><?php echo $this->Lang['NO_AUC_FOUND']; ?></p></td></tr>
				<?php }?>
			     
