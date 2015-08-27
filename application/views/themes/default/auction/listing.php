<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

       <?php $i = 1; if(count($this->all_deals_list)>0){ ?>
                    <?php foreach( $this->all_deals_list as $deals){
                    $symbol = CURRENCY_SYMBOL;
                    $time = ($deals->enddate-time());
                    ?>
                    <?php if(888483 > $time ) { $closetime = $time*1000; ?>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        setTimeout(function() {
                        $('#deallisting<?php echo $deals->deal_id; ?>').fadeOut('fast');
                        }, parseInt(<?php echo $closetime; ?>) );
                        setTimeout(function() {
                        $('#deallistinggallery<?php echo $deals->deal_id; ?>').fadeOut('fast');
                        }, parseInt(<?php echo $closetime; ?>) );
                        setTimeout(function() {
                        $('#deallistinglistview<?php echo $deals->deal_id; ?>').fadeOut('fast');
                        }, parseInt(<?php echo $closetime; ?>) );

                        setTimeout(callback, parseInt(<?php echo $closetime; ?>));
                        function callback()
                        {
							 //window.location.href = Path+"welcome/auction_winner/"+<?php echo $deals->deal_id; ?>;
                        }
                    });
                    </script>
                    <?php } ?>
<div class="product_listing auction_listing <?php if(($i%4) == 1){ ?>margin-left0<?php } ?>">
	<div class="product_listing_image auction_listing_image wloader_parent">
            <i class="wloader_img">&nbsp;</i>

				<?php if($this->session->get('cate')!="") { ?> <?php $url=$this->session->get('cate'); ?> <?php } else { ?> <?php $url=$deals->category_url; ?>  <?php } ?>
					
					<?php  if(file_exists(DOCROOT.'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png')){ 
					$image_url = PATH . 'images/auction/1000_800/' . $deals->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
					?>
						<a href="<?php echo PATH.'auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>">
						 <?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > AUCTION_LIST_HEIGHT)) { ?>
							<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png'?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>" alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" />
							   <?php } else { ?>
                                 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                
							<?php /* <img src="<?php echo PATH.'images/auction/220_160/'.$deals->deal_key.'_1'.'.png'?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" />*/ ?> </a>
					<?php } else { ?>
						<a href="<?php echo PATH.'auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title; ?>"><img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=<?php echo AUCTION_LIST_HEIGHT; ?>"  alt="<?php echo $deals->deal_title; ?>" title="<?php echo $deals->deal_title; ?>" border="0" /></a>
					<?php }?>

<!--				<div class="normal_view">
					<div class="normal_view2">
						<div class="view_mid">
						   <a href="<?php echo PATH.'auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php echo $this->Lang['BID_NOW1']; ?></a>
						</div>
					</div>
				</div>-->
			</div>
			<div class="product_listing_detail">
				<h2><?php $type = ""; $categories = $deals->category_url; ?>
						<a class="cursor" href="<?php echo PATH.'auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $deals->deal_title;?>"><?php echo substr(ucfirst($deals->deal_title),0,100);?></a>
				</h2>


			<div class="bid_cont">
				   <?php $q=0; foreach($this->all_payment_list as $payment){ ?>
					<?php if($payment->auction_id==$deals->deal_id){
							$firstname = $payment->firstname;
							$transaction_time = $payment->transaction_date;
							$q=1;
					}     } ?>
			  <?php if($q==0){ ?>
				<div class="bid_value">
					<label class="bidvalue_label">  <?php echo $this->Lang['LAST_BID']; ?> :</label>
					<span> <?php echo $this->Lang['NOT_YET_BID']; ?></span>
                                </div>
                                <div class="bid_value">
                                        <label><?php echo $this->Lang['BID_AMOUNT']; ?> :</label>
                                        <span><?php /* echo date("d-m-Y",$deals->enddate); */ ?><?php echo $symbol . " " . $deals->deal_value; ?>	</span>
                                </div>
			<?php } ?>
			
			<?php if($q==1){ ?>
				<div class="bid_value">
					<label class="bidvalue_label">  <?php echo $this->Lang['LAST_BID']; ?> :</label>
					<span> <?php echo $firstname; ?></span>
                                </div>
                                <div class="bid_value">
                                        <label><?php echo $this->Lang['LAST_BID_AMOUNT']; ?> :</label>
                                        <span><?php /* echo date("d-m-Y",$deals->enddate); */ ?><?php echo $symbol . " " . $deals->deal_price; ?>	</span>
                                </div>
			<?php } ?>
			
				<div class="deal_list_time">
                                    <div class="time_price_lft">
					<!--<label><?php echo $this->Lang['TIME_LEFT']; ?> :</label>-->
					<label><span time="<?php echo $deals->enddate; ?>" class="kkcount-down"></span></label>
                                    </div>
				</div>				
                            
                                <a class="buy_it list_buy_it bid_it" href="<?php echo PATH.'auction/'.$deals->deal_key.'/'.$deals->url_title.'.html';?>" title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php echo $this->Lang['BID_NOW1']; ?></a>
                           

		</div>
	</div>
</div>

<?php if(($i%4) == 0){ ?>
        <div class="listingspliter"></div>
        <?php } ?>
<?php $i++; }?>

<?php }else { ?>
<?php //echo new View("themes/".THEME_NAME."/subscribe_new"); ?>
<div class="nodata_list_block">
        <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/sorry_icon.png" >
        <p> <?php echo $this->Lang['SORRY_NO_ITEM_TODAY']; ?></p>
</div>
<?php } ?>
