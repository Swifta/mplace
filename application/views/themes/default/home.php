<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>  
<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
		
		
		
		
		
        $("body").kkCountDown({
            colorText:'#000000',
            colorTextDay:'#000000'	
        });
         $('.submit-link')
               .click(function(e){ 
			$('input[name="c"]').val(btoa($(this).attr('id').replace('sample-','')));
			$('input[name="c_t"]').val('<?php echo base64_encode("main"); ?>');
                       e.preventDefault();
                       $(this).closest('form')
                               .submit();                                               
                });
        });
		

$(function() {
$(".slidetabs").tabs(".images > div", {
	effect: 'fade',
	fadeOutSpeed: "medium",
	rotate: true
}).slideshow();
});
</script>
<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">
            <!--content start-->    
                
                     <div class="content_right">
						 <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "th" && $ads->page_position==1) {  ?>  
                                    <div class="right_addess_for_addess wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										<a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
                                  </div>  <?php } ?>
        <?php } ?>
    <?php } ?>
                     <div class="clearfix">
                <?php if (count($this->banner_details) > 0) {   ?>
                <?php if(count($this->banner_details) != 1) {   ?>                         
                            <div class="banner">
                                <div class="slider_home">
                                    <div class="images wloader_parent">
                                        <i class="wloader_img" style="min-height: 248px;">&nbsp;</i>   
					<?php foreach ($this->banner_details as $banner) { ?>                                        
                                    <div style="display: none;">                                                                                
                                   <?php
								   /*  
								    *	
								   	*	Modification to add club membership signup banner conditions
									*	@Live
								   	*/
									 if(strcmp($banner->banner_id, '11') == 0){?>
										  <a target="_self" id="id_banner_club"  href="javascript:load_club();"<?php //echo $banner->redirect_url;?>
										 <?php }else{?>
                                         <a target="_blank" href="<?php echo $banner->redirect_url;	 
										 }?>"  title = "<?php echo $banner->image_title; ?>">
                                        <img src="<?php echo PATH . 'images/banner_images/' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>">
                                    </a>
                                    </div>
                                 <?php } ?>      </div>                             
                                            <div class="controls">
                                                    <div class="for_back">
                                                             <a class="backward">&nbsp;</a>
                                                             <a class="forward">&nbsp;</a>
                                                    </div>
                                                            <div class="slidetabs">                                                    
								 <?php for($i=1;$i<=count($this->banner_details);$i++) { ?>                                                           
                                                            <a href="" class="current">&nbsp;</a>  <?php } ?>                                                           
                                                    </div>                                                                                                   
                                                      </div>
                                    </div>
                                                                 </div>
                        <?php }  else { ?>
                        
                        <div class="banner">
                        <div class="images  wloader_parent">
                        <i class="wloader_img" style="min-height: 248px;">&nbsp;</i>  
                                <?php foreach ($this->banner_details as $banner) { ?>
                                                                        <a  target="_blank" href="<?php echo $banner->redirect_url; ?>" title = "<?php echo $banner->image_title; ?>" ><img src="<?php echo PATH . 'images/banner_images/' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>"></a>
                                                                     <?php } ?>  
                         </div>                        						

                            </div>                        
                   <?php } }  ?>
 <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "hr" && $ads->page_position==1) {  ?>                     
                                  <div class="banner_right_add wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
										 <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a>
										<?php /*<iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-138286787903644940' frameborder=0 height=250 width=300></iframe>  */ ?>
                                  </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
  </div>
    <?php if($this->product_setting) { ?>
    <?php if (count($this->view_hot_products_list ) > 0) { ?>
                        <div class="hot_prodocuts">
                            <ul>
                                <?php foreach ($this->view_hot_products_list as $h) {
                                        $symbol = CURRENCY_SYMBOL;  ?>
                                <li>
                                    <div class="hot_product_image wloader_parent">
                                        <i class="wloader_img">&nbsp;</i>
                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $h->deal_key . '_1' . '.png')) { 
                                        $image_url = PATH . 'images/products/1000_800/' . $h->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                        ?>
                                                    <a href="<?php echo PATH . 'product/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>">
                                                     <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                         <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$h->deal_key.'_1'.'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>"   border="0" />
                                                         <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$h->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                     </a>
                                                <?php } else { ?>
                                                    <a href="<?php echo PATH . 'product/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>">
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>" /></a>
            <?php } ?>
                                        <div class="hot_label">
                                            <p>OFF</p>
                                            <b><?php echo round($h->deal_percentage); ?>%</b>
                                        </div>
                                    </div>
                                    <div class="hot_ptoduct_details">
                                        <a class="cursor" href="<?php echo PATH . 'product/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"><h2><?php echo substr(ucfirst($h->deal_title), 0, 100); ?></h2></a>
                                        <span>
                                        <b><?php echo $symbol . " " . $h->deal_value; ?></b>
                                        <a href="<?php echo PATH . 'product/' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"  class="more_details"></a>
                                        </span>                                        
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                           <?php } } ?>
                            <?php if($this->category_list){  foreach ($this->category_list as $d) { ?>
                            <?php $this->home = new Home_Model();
                          
                            $this->products_details = $this->home->products_details($this->curr_city_id,$d->category_id); 

                            //$this->products_details1 = $this->home->products_details1($this->curr_city_id,$d->category_id); 
                            ?>
                               <!-- product list-->
                                <?php if ($this->product_setting) { ?>
                                    <?php if (count($this->products_details) > 0) { ?>
                            <div class="product_details">
                                <div class="pro_top clearfix">
                                    <div class="pro_title">
                                        <h2> <?php echo ucfirst($d->category_name); ?></h2>
                                    </div>
<?php if (count($this->products_details) > 3) { ?>
<?php $type = "products";  $categories = $d->category_url; ?>
<a class="view_more" onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo $this->Lang['SEE_MO']; ?>"><?php echo $this->Lang['SEE_MO']; ?></a><?php } ?>
                                </div>
                                <div class="pro_mid">
                                            <?php foreach ($this->products_details as $p) {
                                                $symbol = CURRENCY_SYMBOL; ?>
                                        <div class="product_listing">
                                            <div class="product_listing_image wloader_parent">
                                            <i class="wloader_img">&nbsp;</i>
                                        <?php $url = $p->category_url; if( $this->cat != "" ) $url = $this->cat; if (file_exists(DOCROOT . 'images/category/icon/' . $url . '.png')) { ?>
                                        <?php } else { ?>
                                        <?php } ?>
            <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $p->deal_key . '_1' . '.png')) { 
             $image_url = PATH . 'images/products/1000_800/' . $p->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
            ?>
                                                    <a href="<?php echo PATH . 'product/' . $p->deal_key . '/' . $p->url_title . '.html'; ?>" title="<?php echo $p->deal_title; ?>">
                                                    <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                         <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$p->deal_key.'_1'.'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $p->deal_title; ?>"   border="0" />
                                                         <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$p->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                     <?php  /* <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/no-image/product_listing-no-image.png" alt="<?php echo $p->deal_title; ?>" /> */
 /*<img src="<?php echo PATH . 'images/products/290_215/' . $p->deal_key . '_1' . '.png'; ?>" alt="<?php echo $p->deal_title; ?>"   border="0" />
*/ ?></a>
                                                <?php } else { ?>
                                                    <a href="<?php echo PATH . 'product/' . $p->deal_key . '/' . $p->url_title . '.html'; ?>" title="<?php echo $p->deal_title; ?>">
                                                        <img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $p->deal_title; ?>" /></a>
            <?php } ?>
                                                    
                                            </div>

                                            <div class="product_listing_detail">
                                                <?php $type = "products";  $categories = $p->category_url; ?>

                                                <h2><a class="cursor" href="<?php echo PATH . 'product/' . $p->deal_key . '/' . $p->url_title . '.html'; ?>" title="<?php echo $p->deal_title; ?>"><?php echo substr(ucfirst($p->deal_title), 0, 100) ; ?></a></h2>

                                                <div class="product_listing_price_details">
<!--                                                <p><?php //echo $symbol . " " . $p->deal_price; ?></p>   -->
                                                <p><?php echo $symbol . " " . $p->deal_value; ?></p>
                                                </div>
                                                <div class="product_view_detail">                                               
                                                                <a href="<?php echo PATH . 'product/' . $p->deal_key . '/' . $p->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"></a>
                                                </div>
                                            </div>
                                        </div>
                                 <?php } ?>
                                </div>
                            </div>
                  <?php }  }  ?> 
          <?php }  }  ?> 
          <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "bf" && $ads->page_position==1) {  ?>       
                                       <div class="side_footer_part wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                        <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " width="790" height="100" /></a>
                                    </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
          
        </div>
            <!--sidebar start-->

                                     <div class="conntent_left">
                                     			
                        <div class="category_sidebar">                            
                                <h1 class="cate_title"><a href="<?php echo PATH; ?>shop-all-category.html" title="<?php echo $this->Lang['SHOP_AL']; ?>"><?php echo $this->Lang['SHOP_AL']; ?></a></h1>
                                <form>
                                <?php if($this->product_setting) { ?>
                                <ul class="cate_menu">
                                    <?php $cat = explode(",", substr($this->session->get('categoryID'), 0, -1));
                                    $cat1 = array_unique($cat);
                                    ?>

                                        <?php if($this->categeory_list_product){  foreach ($this->categeory_list_product as $d) {
                                        $check_sub_cat = $d->product_count;
                                         /*   COUNT OF SUBCATEGORY   */
                                        //$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
                                        $subcate_count = 1;
                                        $subcat_style = ($subcate_count==0)?"background:none":"";
                                        $encode_catid = $d->category_id;
                                        if(($check_sub_cat !=-1 )&&($check_sub_cat !=0)) {
                                        ?>
                                        <li <?php if((isset($_GET['c']) && $_GET['c'] == base64_encode($d->category_id)) || (isset($_GET['m_c']) && $_GET['m_c'] == base64_encode($d->category_id) )) { ?> class="li_active" <?php } ?>>

        <?php $type = "products";

        $categories = $d->category_url; ?>
                                            <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>"  onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" class="sample_12 cate_subarr" id="sample-<?php echo $encode_catid; ?>"  title="<?php echo ucfirst($d->category_name); ?>">
						<?php echo ucfirst($d->category_name).' ('.$check_sub_cat.')'; ?>
                                            </a>                                            
                                            <ul class="cate_supmenu" id="sub_category_<?php echo $encode_catid; ?>">
                                               <div id="categeory1-<?php echo $encode_catid; ?>"></div>
                                            </ul>                                            
                                        </li>
                                <?php } } } ?>    
                                </ul>
                                <?php } ?>
                                <input type="hidden" name="c" />
                                <input type="hidden" name="c_t" />
                                <input type="hidden" name="m_c">
<p><input type="submit" style="display:none;"> </p>
	</form>
	                        </div>                                			 <!--slider_right content start-->
	                        
	                        <?php if($this->product_setting) { ?>
    <?php if(count($this->view_products_list) >  0){ ?>        
    <div class="sidebar_view_product">
                <div class="sidebar_view_product_title">
                    <h2> <?php echo $this->Lang['MOST_PRO']; ?></h2>
                </div>          
                    <ul >
                            <?php $deal_offset = $this->input->get('offset'); foreach( $this->view_products_list as $products_list){
$symbol = CURRENCY_SYMBOL; 
?>
                            <li>
                                <div class="sidebar_more_product">
                                    <div class="more_product_image wloader_parent">
                                        <i class="wloader_img">&nbsp;</i>
                                        <?php if(file_exists(DOCROOT.'images/category/icon/'.$products_list->category_url.'.png')){ ?>
					<?php } else { ?>												
                                            <?php } ?>
                                         <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$products_list->deal_key.'_1'.'.png')){ 
                                         $image_url = PATH . 'images/products/1000_800/' . $products_list->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                         ?>
                                        <a   href="<?php echo PATH.'product/'.$products_list->deal_key.'/'.$products_list->url_title.'.html';?>" title="<?php echo $products_list->deal_title; ?>" >
                                        <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
											<img src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$products_list->deal_key.'_1'.'.png'?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products_list->deal_title; ?>" title="<?php echo $products_list->deal_title; ?>" />
											
											<?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$products_list->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                
                                           <?php /* <img title=" " alt="" src="<?php echo PATH.'images/products/290_215/'.$products_list->deal_key.'_1'.'.png'?>"> */ ?>
                                        </a>
                                                 <?php } else { ?>
 
                                        <a  href="<?php echo PATH.'product/'.$products_list->deal_key.'/'.$products_list->url_title.'.html';?>" title="<?php echo $products_list->deal_title; ?>">
                                            <img title=" " alt="" src="<?php echo PATH.'resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" >
                                        </a>
                                         <?php }?>
                                        <?php $url=PATH.'product/'.$products_list->deal_key.'/'.$products_list->url_title.'.html';?>
                                       
                                    </div>
                                    <div class="side_porduct_detail">
                                        <h2>
                                            <a class="cursor"  href="<?php echo PATH.'product/'.$products_list->deal_key.'/'.$products_list->url_title.'.html';?>" title="<?php echo $products_list->deal_title;?>"><?php echo substr(ucfirst($products_list->deal_title),0,100);?></a>
                                        </h2>
 <div class="side_product_price">
<!--  <p><?php //echo $symbol . " " . $products_list->deal_price; ?></p>-->
                                        <b><?php echo $symbol . " " . $products_list->deal_value; ?></b>
                                    </div>
                                    </div>
                                    
                                       
                                </div>
                            </li>
                                              
                          <?php } $deal_offset++; ?>
             </ul>                                 
  </div>
    <?php } }  ?>
            <!--slider_right content end -->
            

                               <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "ls" && $ads->page_position==1) {  ?>  
                                      <div class="side_advertise_part wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                     
                                        <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " width="180" height="500" /></a>
                                    </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
                    </div>
                    <!--end-->
    </div>
</div>
</div>

