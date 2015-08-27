<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.noConflict();
        $("body").kkCountDown({
            colorText:'#ED7E2C',
            colorTextDay:'#ED7E2C',
            addClass : 'shadow',
            dayText:"<?php echo $this->Lang['DAY_TEXT']; ?>",
            daysText:"<?php echo $this->Lang['DAYS_TEXT']; ?>"
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#messagedisplay1').hide();
    });
</script>

<!--Carousel Script-->
<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery.jcarousel.min.js"></script>

<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
            wrap: 'circular'
        });
    });

</script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel2').jcarousel({
            wrap: 'circular'
        });
    });

</script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel3').jcarousel({
            wrap: 'circular'
        });
    });

</script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel4').jcarousel({
            wrap: 'circular'
        });
    });

</script>


</div>
</div>
</div>
<!--end-->




<div class="contianer_outer1">
    <div class="contianer_inner">
        <div class="contianer">
            <div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p><a href="<?php echo PATH; ?>stores.html" title="<?php echo $this->Lang['STORES']; ?>"><?php echo $this->Lang['STORES']; ?></a></p></li>
                    <?php foreach ($this->get_store_details as $store) { ?>
                        <li><p><?php echo ucfirst($store->store_name); ?></p></li>
                    <?php } ?>
                </ul>
            </div>
            <div  id="messagedisplay1" style="display:none;">      
                <div class="session_wrap">
                    <div class="session_container">
                        <div class="success_session">
                            <p><span ><?php echo $this->Lang['COMM_POST_SUCC']; ?>.</span></p>
                            <div class="close_session_2">
                                <a class="closestatus cur" title="<?php echo $this->Lang['CLOSE']; ?>"  onclick="return closeerr();" >&nbsp;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--content start-->
            <?php foreach ($this->get_store_details as $store) { ?>               
            <div class="store_detail_block">               
                <div class="deal_content store_content">
                    <div class="store_image wloader_parent">
                        <i class="wloader_img" style="min-height: 300px;">&nbsp;</i>           
                        <?php if (file_exists(DOCROOT . 'images/merchant/600_370/' . $store->merchant_id . '_' . $store->store_id . '.png')) { ?>
                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/merchant/600_370/' . $store->merchant_id . '_' . $store->store_id . '.png' ?>&w=<?php echo STORE_DETAIL_WIDTH; ?>&h=<?php echo STORE_DETAIL_HEIGHT; ?>" alt="<?php echo $this->Lang['IMAGE']; ?>" />
                        <?php } else { ?>
                            <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_details.png&w=<?php echo STORE_DETAIL_WIDTH; ?>&h=<?php echo STORE_DETAIL_HEIGHT; ?>"  alt="<?php echo $this->Lang['IMAGE']; ?>">
                        <?php } ?>
                    </div>
                    <div class="deal_address">
                    <h2 class="deal_sub_title store_address_title"><?php echo ucfirst($store->store_name) ; ?></h2>
                    
                        <?php /* <h2 class="deal_sub_title store_address_title"><?php echo $this->Lang['ADDRES']; ?></h2> */ ?>
                        <address class="deal_map_address">
                            <!--<h3><?php echo $store->store_name; ?>,</h3>-->
                            <p><?php echo $store->address1; ?>,</p>
                            <p><?php echo $store->address2; ?>,  </p>                                    
                            <p><?php echo $store->city_name; ?>, <?php echo $store->country_name; ?>. </p>                  
                            <p><?php echo $this->Lang['MOBILE']; ?>: <?php echo $store->phone_number; ?> </p>
                            <p><?php echo $this->Lang['WEBSITE']; ?>: <a href="<?php echo $store->website; ?>" target="blank" class="deal_web_link"> <?php echo $store->website; ?></a></p>
                        </address>
                        <div class="clearfix wloader_parent">
                            <i class="wloader_img">&nbsp;</i>
                            <div id="map_main" style="height:246px;"></div>
                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                            <script type="text/javascript">
                                var latlng = new google.maps.LatLng(<?php echo $store->latitude; ?>,<?php echo $store->longitude; ?>);
                                var myOptions = {
                                    zoom: 12,
                                    center: latlng,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    navigationControl: true,
                                    mapTypeControl: true,
                                    scaleControl: true
                                };
                            
                                var map = new google.maps.Map(document.getElementById("map_main"), myOptions);
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    animation: google.maps.Animation.BOUNCE
                                });
                            
                                var infowindow = new google.maps.InfoWindow({
                                    content: '<b><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->store_name); ?></b><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->address1); ?></p><p><?php echo preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $store->address2); ?></p><p><?php echo $store->city_name; ?>,<?php echo $store->country_name; ?></p>'
                                });
                            
                                google.maps.event.addListener(marker, 'click', function() { 
                                    infowindow.open(map, marker);
                                });
                                marker.setMap(map);
                            
                            </script>
                        </div>                                                                                                                        
                    </div>
                </div>
                <?php } ?>
                <div class="store_lists_block">
                    <!--   my carousel2  -->
                    <?php if (count($this->get_product_categories) > 0) { ?>  
                        <?php if ($this->product_setting) { ?>                                                                            
                            <?php if (count($this->get_product_categories) > 0) { ?>
                    <div class="store_slide_list clearfix">
                                <h2 class="inner_commen_title" style="text-transform:uppercase;"><?php echo $this->Lang['RE_PRO']; ?></h2>
                            <?php } ?>                                        
                            <div class="slider_wrap">
                                    <ul  <?php if (count($this->get_product_categories) > 4) { ?> id="mycarousel2" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>                         
                                        <?php
                                        $i = 1;
                                        foreach ($this->get_product_categories as $products) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li>

                                                <div class="product_listing">
                                                    <div class="product_listing_image wloader_parent">
                                                        <i class="wloader_img">&nbsp;</i>
                                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { 
                                                        $image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png';
                                                        $size = getimagesize($image_url);
                                                        ?>
                                                            <a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>">
                                                            <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                                                                 <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                                
                                                                <?php /* <img src="<?php echo PATH.'images/products/290_215/'.$products->deal_key.'_1'.'.png';?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"> */ ?></a>
                                                        <?php } else { ?>
                                                            <a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"></a>
                                                        <?php } ?>

                                                    </div>

                                                    <div class="product_listing_detail">

                                                        <h2><a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100); ?></a></h2>
                                                        <!--<h3><a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 20) . '...'; ?>"><?php echo substr(ucfirst(strip_tags($products->deal_description)), 0, 25) . '...'; ?></a></h3>-->

                                                        <div class="product_listing_price_details">

                                                            <?php /* <p> <?php echo $symbol . " " . $products->deal_price; ?> <?php echo CURRENCY_CODE; ?></p> */ ?>
                                                            <p><?php echo $symbol . " " . $products->deal_value; ?> <?php echo CURRENCY_CODE; ?> </p>

                                                        </div>
                                                        <div class="product_view_detail">
                                                            <a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"><?php /* echo $this->Lang['ADD_TO_CART']; */ ?></a>                                                                     
                                                        </div>
                                                    </div>
                                                </div> 
                                            </li>
                                        <?php } ?>

                                    </ul>
                              
                            </div>
                                </div>
                        <?php } ?>        
                          <?php } ?>                     
                          <?php if (count($this->get_deals_categories) > 0) { ?>                                                                         
                        <?php if (($this->deal_setting)) { ?>
                            <?php if (count($this->get_deals_categories) > 0) { ?>
                    <div class="store_slide_list clearfix"> 
                                <h2 class="inner_commen_title" style="text-transform:uppercase;"><?php echo $this->Lang['FEAT_DEALS']; ?> <span class="right_top_ae">&nbsp; </span></h2>
                            <?php } ?>                                                                        
                            <div class="slider_wrap">
                                
                                    <ul  <?php if (count($this->get_deals_categories) > 4) { ?> id="mycarousel3" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>

                                        <?php
                                        foreach ($this->get_deals_categories as $deals_categories) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>
                                            <li>

                                                <div class="product_listing">


                                                    <div class="deal_listing_image wloader_parent">
                                                        <i class="wloader_img">&nbsp;</i>
                                                        <?php if (file_exists(DOCROOT . 'images/category/icon/' . $deals_categories->category_url . '.png')) { ?>

                                                        <?php } else { ?>

                                                        <?php } ?>

                                                        <?php if (file_exists(DOCROOT . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png')) {
                                                           $image_url = PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png';
                                                           $size = getimagesize($image_url); ?>
                                                            <a href="<?php echo PATH . 'deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" >
                                                             <?php if(($size[0] > DEAL_LIST_WIDTH) && ($size[1] > DEAL_LIST_HEIGHT)) { ?>
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/deals/1000_800/' . $deals_categories->deal_key . '_1' . '.png'; ?>&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>" alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>" />
                                                                <?php } else { ?>
                                                                 <img src="<?php echo PATH .'images/deals/1000_800/'.$deals_categories->deal_key.'_1'.'.png'?>" />
                                                                <?php } ?>
                                                                <?php /* <img src="<?php echo PATH.'images/deals/220_160/'.$deals_categories->deal_key.'_1'.'.png';?>"   alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>" > */ ?></a>
                                                        <?php } else { ?>
                                                            <a href="<?php echo PATH . 'deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" ><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_deals_list.png&w=<?php echo DEAL_LIST_WIDTH; ?>&h=<?php echo DEAL_LIST_HEIGHT; ?>"   alt="<?php echo $this->Lang['IMAGE']; ?>" title="<?php echo $this->Lang['IMAGE']; ?>"  ></a>
                                                        <?php } ?>                                                                                                                                            

                                                    </div>
                                                    <div class="product_listing_detail">
                                                        <h2><?php $type = "";
                                            $categories = $deals_categories->category_url;
                                                        ?>
                                                            <a class="cursor" href="<?php echo PATH . 'deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo substr(ucfirst($deals_categories->deal_title), 0, 25) . "..."; ?>"><?php echo substr(ucfirst($deals_categories->deal_title), 0, 100) ; ?></a>
                                                        </h2>                                                                    
                                                        <div class="deal_list_time">
                                                            <div class="time_price_lft">
                                                                <label> <span time="<?php echo $deals_categories->enddate; ?>" class="kkcount-down" ></span></label>
                                                            </div>
                                                        </div>
                                                        <div class="deal_listing_price_details">
            <?php /* <p><?php echo $symbol . " " . $deals_categories->deal_price; ?></p> */ ?>
                                                            <p><?php echo $symbol . " " . $deals_categories->deal_value; ?></p>
                                                        </div>
                                                        <a class="buy_it list_buy_it" href="<?php echo PATH . 'deals/' . $deals_categories->deal_key . '/' . $deals_categories->url_title . '.html'; ?>" title="<?php echo $this->Lang['BUY_NOW2']; ?>"><?php echo $this->Lang['BUY_NOW2']; ?></a>                                                                    
                                                    </div>

                                                </div> 
                                            </li>
                                    <?php } ?>
                                    </ul>
                           
                            </div>
                                </div>
                                 <?php } ?>
                                <?php } ?>                                                  
                    <!--   my carousel4  -->  
                      <?php if (count($this->get_auction_categories) > 0) { ?>
                        <?php if (($this->auction_setting)) { ?>
                            <?php if (count($this->get_auction_categories) > 0) { ?>
                    <div class="store_slide_list clearfix">                                                                
                                <h2 class="inner_commen_title" style="text-transform:uppercase;"><?php echo $this->Lang['RE_AUC']; ?> <span class="right_top_ae">&nbsp; </span></h2>
                                <?php } ?>                                                                            
                            <div class="slider_wrap">
  
                                    <ul  <?php if (count($this->get_auction_categories) > 4) { ?> id="mycarousel4" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?>>

                                        <?php
                                        foreach ($this->get_auction_categories as $deals1) {
                                            $symbol = CURRENCY_SYMBOL;
                                            ?>			
                                            <li>

                                                <div class="product_listing auction_listing">
                                                    <div class="product_listing_image wloader_parent">
                                                        <i class="wloader_img">&nbsp;</i>
            <?php if (file_exists(DOCROOT . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png')) { 
               $image_url = PATH . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                ?>
                                                            <a href="<?php echo PATH . 'auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>">
                                                                               <?php if(($size[0] > AUCTION_LIST_WIDTH) && ($size[1] > 130)) { ?>
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/auction/1000_800/' . $deals1->deal_key . '_1' . '.png'; ?>&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=130" alt="<?php echo $deals1->deal_title; ?>" alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" />
                                                                <?php } else { ?>
                                 <img src="<?php echo PATH .'images/auction/1000_800/'.$deals1->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                                
                                                            <?php /* <img src="<?php echo PATH.'images/auction/220_160/'.$deals1->deal_key.'_1'.'.png';?>"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>" border="0" /> */ ?></a>

                                                        <?php } else { ?>
                                                            <a  href="<?php echo PATH . 'auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_auctions_list.png&w=<?php echo AUCTION_LIST_WIDTH; ?>&h=130"  alt="<?php echo $deals1->deal_title; ?>" title="<?php echo $deals1->deal_title; ?>"  border="0" /></a>
            <?php } ?>                                                                                                                                                   

                                                    </div>
                                                    <div class="product_listing_detail">
                                                        <h2><?php $type = "";
            $categories = $deals1->category_url;
            ?>
                                                            <a class="cursor" href="<?php echo PATH . 'auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $deals1->deal_title; ?>"><?php echo substr(ucfirst($deals1->deal_title), 0, 100); ?></a>
                                                        </h2>                                                                    

                                                        <div class="bid_cont">

                                                            <?php $q = 0;
                                                            foreach ($this->all_payment_list as $payment) {
                                                                ?>
                                                                <?php
                                                                if ($payment->auction_id == $deals1->deal_id) {
                                                                    $firstname = $payment->firstname;
                                                                    $transaction_time = $payment->transaction_date;
                                                                    $q = 1;
                                                                }
                                                            }
                                                            ?>
            <?php if ($q == 1) { ?>

                                                                <div class="bid_value">					
                                                                    <label class="bidvalue_label">  <?php echo $this->Lang['LAST_BID']; ?>:</label>
                                                                    <span><?php echo substr(ucfirst($firstname), 0, 10) . '..'; ?></span>
                                                                </div>
                                                                <div class="bid_value">					
                                                                    <label> <?php echo $this->Lang['BID']; ?>:</label>
                <?php /* <span> <?php echo date("d-m-Y ", $transaction_time); ?><?php echo date("h:i A", $transaction_time); ?></span> */ ?>
                                                                    <span><?php echo $symbol . " " . $deals1->deal_value; ?>	</span>
                                                                </div>


            <?php } ?>
            <?php if ($q == 0) { ?>
                                                                <div class="bid_value">  



                                                                    <label class="bidvalue_label"> <?php echo $this->Lang['LAST_BID']; ?>  :</label>
                                                                    <span> <?php echo $this->Lang['NOT_YET_BID']; ?></span>
                                                                </div>
                                                                <div class="bid_value">    
                                                                    <label> <?php echo $this->Lang['CLOSE_T']; ?>:</label>
                                                                <?php /* <span><?php echo date("d-m-Y", $deals1->enddate); ?><?php echo date("h:i A", $deals1->enddate); ?></span> */ ?>
                                                                    <span><?php echo $symbol . " " . $deals1->deal_price; ?></span>
                                                                </div>	
            <?php } ?>
                                                            <div class="deal_list_time">
                                                                <div class="time_price_lft">                                                                            
                                                                    <label><span time="<?php echo $deals1->enddate; ?>" class="kkcount-down" ></span></label>
                                                                </div>
                                                            </div>
                                                            <a class="buy_it list_buy_it bid_it" href="<?php echo PATH . 'auction/' . $deals1->deal_key . '/' . $deals1->url_title . '.html'; ?>" title="<?php echo $this->Lang['BID_NOW1']; ?>"><?php echo $this->Lang['BID_NOW1']; ?></a>                                                                    

                                                        </div>



                                                    </div>
                                                </div> 
                                            </li>
                                        <?php  } ?>
                    
                                </ul>
                            </div>                                    
                        </div>


              <?php   }   ?>
<?php } ?>
                
                <div class="store_comment_block clearfix">  
                    <div class="store_branch_list">
                        
                                    <?php if (count($this->get_sub_store_details) > 0) { ?>     
                        <div class="store_slide_list clearfix">
                                <h2 class="inner_commen_title" style="text-transform:uppercase;"> <?php echo $this->Lang['BRANCHES']; ?><span class="right_top_ae">&nbsp; </span></h2>                                                                        
                                <div class="slider_wrap">
                                    <ul <?php if (count($this->get_sub_store_details) > 2) { ?> id="mycarousel" class="jcarousel-skin-tango2" <?php } else { ?> <?php } ?> >


                                                    <?php foreach ($this->get_sub_store_details as $stores) { ?>

                                            <li>

                                                <div class="product_listing auction_listing branch_listing">                                                                                                                        
                                                    <div class="product_listing_image wloader_parent">      
                                                        <i class="wloader_img">&nbsp;</i>
                                                        <?php if (file_exists(DOCROOT . 'images/merchant/290_215/' . $stores->merchant_id . '_' . $stores->store_id . '.png')) { ?>
                                                            <a href="<?php echo PATH . 'stores/' . $stores->store_key . '/' . $stores->store_url_title . '.html'; ?>" title="<?php echo $stores->store_name; ?>">
                                                                <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/merchant/290_215/' . $stores->merchant_id . '_' . $stores->store_id . '.png' ?>&w=150&h=130" alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>" />
            <?php /* <img  src="<?php echo PATH.'images/merchant/290_215/'.$stores->merchant_id.'_'.$stores->store_id.'.png';?>"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>"> */ ?></a>
        <?php } else { ?>
                                                            <a href="<?php echo PATH . 'stores/' . $stores->store_key . '/' . $stores->store_url_title . '.html'; ?>" title="<?php echo $stores->store_name; ?>"><img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_stores_list.png&w=150&h=130"   alt="<?php echo $stores->store_name; ?>" title="<?php echo $stores->store_name; ?>" ></a>
        <?php } ?>                                                   
                                                    </div>
                                                    <div class="product_listing_detail">
                                                        <h2><a href="<?php echo PATH . 'stores/' . $stores->store_key . '/' . $stores->store_url_title . '.html'; ?>" title="<?php echo $stores->store_name; ?>"><?php echo substr(ucfirst($stores->store_name), 0, 100) ; ?></a></h2>
                                                        <!--<h3> <a title="<?php echo $stores->address1; ?>"><?php echo $stores->address1; ?></a></h3>-->                                                                                                                                                                                                                                                                                              
                                                        <a class="buy_it list_buy_it" href="<?php echo PATH . 'stores/' . $stores->store_key . '/' . $stores->store_url_title . '.html'; ?>" title="<?php echo $this->Lang['VIEW_DETAILS']; ?>"><?php echo $this->Lang['VIEW_DETAILS']; ?></a>                                                                                                                                                    
                                                    </div>                                                                                                                        
                                                </div> 
                                            </li>
                                <?php } ?>   


                                    </ul>
                                </div>                                                                 
                                </div>
<?php } ?>
                            <!--   my carousel3  -->                         
                    </div> 
                    <div class="fbok_comment_block">
                        <h2 class="inner_commen_title" style="text-transform:uppercase;"><?php echo $this->Lang['COMM']; ?> <span class="right_top_ae">&nbsp; </span></h2>                                
                        <div class="fbok_comment wloader_parent" style="min-height:220px;">
                            <i class="wloader_img">&nbsp;</i>
                            <div id="fb-root"></div>
                            <script>
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;

                                    js = d.createElement(s); js.id = id;
                                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
														
                            </script>

                            <div width="370" class="fb-comments" data-href="<?php echo PATH . 'stores/' . $store->store_key . '/' . $store->store_url_title . '.html'; ?>" data-num-posts="10" ></div>
                        </div>
                    </div>                                                                                   

                </div>

            </div>                            

        </div>




        <!--end-->

    </div>
</div>


