<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>				
<?php if (count($this->all_deals_list) > 0) { ?>
<?php   $deal_offset = $this->input->get('offset');
$i = 1;  foreach ($this->all_deals_list as $deals) {
if (($deals->maximum_deals_limit == $deals->purchase_count) || ($deals->maximum_deals_limit < $deals->purchase_count) || ($deals->enddate < time())) {  } else {
        $symbol = CURRENCY_SYMBOL; ?>
        <div class="product_listing <?php if(($i%4) == 1){ ?>margin-left0<?php } ?>">
                <div class="deal_listing_image wloader_parent">
                    <i class="wloader_img">&nbsp;</i>
                    <div class="hot_label deal_ribbon">
                        <p>OFF</p>
                        <b><?php echo round($deals->deal_percentage); ?>%</b>
                    </div>
		<?php if($this->session->get('cate')!="") { ?> <?php $url=$this->session->get('cate'); ?> <?php } else { ?> <?php $url=$deals->category_url; ?>  <?php } ?>
                    <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals->deal_key . '_1' . '.png')) { 
                      $image_url = PATH . 'images/deals/1000_800/' . $deals->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                    ?>
                        <a href="<?php echo PATH . 'deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>">
                        <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" > 
                        <?php } else { ?>
                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo PATH . 'deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" ></a>
        <?php } ?>
                </div>
                <div class="product_listing_detail">
                    <h2>
			<?php $type = ""; $categories = $deals->category_url; ?>
			<a class="cursor" href="<?php echo PATH . 'deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>"><?php echo substr(ucfirst($deals->deal_title),0,100); ?></a>
			</h2>

                    <div class="deal_list_time">
                        <div class="time_price_lft">                                                        
                            <label> <span time="<?php echo $deals->enddate; ?>" class="kkcount-down" ></span></label>
                        </div>
                    </div>
                <div class="deal_listing_price_details">
<!--<p><?php //echo $symbol . " " . $deals->deal_price; ?></p>   -->
                <p><?php echo $symbol." ".$deals->deal_value; ?></p>
                </div>
                <a class="buy_it list_buy_it" href="<?php echo PATH . 'deals/' . $deals->deal_key . '/' . $deals->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>                                                    
                </div>
        </div>
        <?php if(($i%4) == 0){ ?>
        <div class="listingspliter"></div>
        <?php } ?>
    <?php  $i ++; }  } ?>
<?php } else { ?>
<?php //echo new View("themes/".THEME_NAME."/subscribe_new"); ?>
<div class="nodata_list_block">
        <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/sorry_icon.png" >
        <p> <?php echo $this->Lang['SORRY_NO_ITEM_TODAY']; ?></p>
</div>
<?php } ?>
