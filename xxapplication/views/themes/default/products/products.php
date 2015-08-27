<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php // for filter functionality
$main_cat = (isset($this->sub_cat) && ($this->sub_cat == "") && ($this->sub_cat !=2) && ($this->sub_cat !=3)) ? $this->category_url : "";
$sub_cat = (isset($this->sub_cat) && ($this->sub_cat != "") && ($this->sub_cat !=2) && ($this->sub_cat !=3)) ? $this->category_url : "";
$sec_cat = (isset($this->sub_cat) && ($this->sub_cat != "") && ($this->sub_cat ==2) && ($this->sub_cat !=3)) ? $this->category_url : "";
$third_cat = (isset($this->sub_cat) && ($this->sub_cat != "") && ($this->sub_cat !=2) && ($this->sub_cat ==3)) ? $this->category_url : "";
$symbol = CURRENCY_SYMBOL;
?>
<script type="text/javascript" src="<?php echo PATH; ?>js/timer/kk_countdown_1_2_jquery_min.js"></script>
<?php /* Pagination */ ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#size_filter').hide();
        $('#color_filter').hide();
        $('#discount_filter').hide();
        $('#price_filter').hide();
        $('#pricetext_filter').hide();
        $('a.view_more1').live("click", function(e) {
            var offset = 0;
			var size = "";
			$(".size input:checked").each(function() {
				size += this.value+',';
			});
			var color = "";
			$(".color input:checked").each(function() {
				color += this.value+',';
			});
			var discount = "";
			$(".discount input:checked").each(function() {
				discount += this.value+',';
			});
			var price = "";
			$(".price input:checked").each(function() {
				price += this.value+',';
			});
			var price_text = $("#amount1").val();
			if(price_text==undefined){
			        var price_text = "";
			}
            offset = document.getElementById('offset').value;
            var record = document.getElementById('record').value;
            var record1 = document.getElementById('record1').value;
            var url = '<?php echo PATH; ?>' + 'products/all_products_1?offset=' + offset + '&record=' + record+'&size='+size+'&color='+color+'&discount='+discount+'&price='+price+'&main='+'<?php echo $main_cat; ?>'+'&sub='+'<?php echo $sub_cat; ?>'+'&sec='+'<?php echo $sec_cat; ?>'+'&third='+'<?php echo $third_cat; ?>'+'&price1='+price_text;
            $.post(url, function(check) {
                if (check) {
                    $('#product').append(check);
                    $('#loading').show();
                    $('.wloader_img').hide();
                    offset = parseInt(offset) + 12;
                    $("#offset").val(offset);
                    if (offset >= record1) {
                        $('#loading').hide();
                    }} });  }); });
</script>
<!--slider css-->
<div class="contianer_outer">
    <div class="contianer_inner">
        <div class="contianer">
            <?php /*<div class="bread_crumb">
                <ul>
                    <li><p><a href="<?php echo PATH; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang['HOME']; ?></a></p></li>
                    <li><p>
                            <?php if (($this->uri->last_segment() != "products.html")) { ?>
                                <a href="<?php echo PATH; ?>products.html" title="<?php echo $this->Lang['PRODUCTS']; ?>"><?php echo $this->Lang["PRODUCTS"]; ?></a></p>
                        <?php
                        } else {
                            echo $this->Lang['PRODUCTS'];
                        }
                        ?>
                    </li>
<?php if (($this->uri->last_segment() != "products.html")) { ?>

                        <li class="bread_crum_about">

                            <?php if (isset($this->sub_cat) && ($this->sub_cat != "")) { ?>
                                <p><a href="<?php echo PATH; ?>products/c/<?php echo base64_encode("main"); ?>/<?php echo strtolower($this->category_name); ?>.html"><?php echo $this->category_name; ?></a>&nbsp;&nbsp;&nbsp;<?php echo $this->sub_cat; ?></p>
                            <?php } else { ?>
                                <p>  <?php echo $this->category_name; ?></p>
                        <?php } ?>
                        </li>
            <?php } ?>
                </ul>
            </div> */?>
<?php if (count($this->all_products_list) > 0) { ?>
                <!--content start-->
                <div class="content">

                    <div class="content_right">
                        <?php if (count($this->ads_details) > 0) { ?>
                            <?php foreach ($this->ads_details as $ads) { ?>
                                <?php if ($ads->ads_position == "th" && $ads->page_position == 1) { ?>
                                    <div class="cat_outer4 wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                        <div class="right_left">
                                            <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a> 
                                            <?php /* <iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-138286787903644940' frameborder=0 height=250 width=300></iframe> */ ?>
                                        </div>
                                    </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
                        <div class="clearfix">
                                    <?php if (count($this->banner_details) > 0) { ?>
                                        <?php if (count($this->banner_details) != 1) { ?>                        
                                <div class="banner">
                                    <div class="slider_home">
                                        <div class="images wloader_parent">                                                    
                                            <i class="wloader_img" style="min-height: 248px;">&nbsp;</i>
                                            
                                            
                                            
                                          <!--  <?php foreach ($this->banner_details as $banner) { ?>
                                                <div style="display: none;">                                                                                                        
                                                    <a target="_blank" href="<?php echo $banner->redirect_url; ?>" title = "<?php echo $banner->image_title; ?>">                                                       
                                                        <img src="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/images/banner_images' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>"></a>
                                                </div>
            <?php } ?>
                         -->                   
                                            
                                            
                                            
                                            
                                                                                                
            
                                        </div>
                                        <div class="controls">
                                            <div class="for_back">
                                                <a class="backward">&nbsp;</a>
                                                <a class="forward">&nbsp;</a>
                                            </div>
                                            <div class="slidetabs">
            <?php for ($i = 1; $i <= count($this->banner_details); $i++) { ?>
                                                    <a href="" class="current">&nbsp;</a>
            <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
        <?php } else { ?>
                                <div class="banner">
                                    <div class="images">
                                <?php foreach ($this->banner_details as $banner) { ?>
                                            <a  target="_blank" href="<?php echo $banner->redirect_url; ?>"  title = "<?php echo $banner->image_title; ?>"><img src="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/images/banner_images' . $banner->banner_id . '.png'; ?>" alt="<?php echo $banner->image_title; ?>"></a>

            <?php } ?>
                                    </div>
                                </div>
                            <?php }
                        } ?>

                        <?php if (count($this->ads_details) > 0) { ?>
        <?php foreach ($this->ads_details as $ads) { ?>
            <?php if ($ads->ads_position == "hr" && $ads->page_position == 3) { ?>
                                    <div class="banner_right_add wloader_parent">
                                        <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                        <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " /></a> 
                                        <?php /* <iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-138284106133345107' frameborder=0 height=250 width=300></iframe> */ ?>
                                    </div>
                        
            <?php } ?>
        <?php } ?>
    <?php } ?>
                            </div>
                         <?php if (count($this->view_hot_products_list ) > 0) { ?>
                        <div class="hot_prodocuts">
                            <ul>
                             <?php
                                            foreach ($this->view_hot_products_list as $h) {
                                                $symbol = CURRENCY_SYMBOL;
                                                ?>
                                <li>
                                    <div class="hot_product_image wloader_parent">
                                        <i class="wloader_img">&nbsp;</i>
                                        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $h->deal_key . '_1' . '.png')) { 
                                         $image_url = PATH . 'images/products/1000_800/' . $h->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                        ?>
                                                    <a href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/product' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>">
                                                    <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                                                         <img src="<?php echo PATH.'../../../../../application - Copy/views/themes/default/products/resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$h->deal_key.'_1'.'.png'?>&amp;w=<?php echo PRODUCT_LIST_WIDTH; ?>&amp;h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>"   border="0" />
                                                          <?php } else { ?>
                                 <img src="<?php echo PATH .'../../../../../application - Copy/views/themes/default/products/images/products/1000_800'.$h->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                                     </a>
                                                <?php } else { ?>
                                                    <a href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/product' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>">
                                                        <img src="<?php echo PATH.'../../../../../application - Copy/views/themes/default/products/resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&amp;w=<?php echo PRODUCT_LIST_WIDTH; ?>&amp;h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $h->deal_title; ?>" title="<?php echo $h->deal_title; ?>" /></a>
            <?php } ?>
                                        <div class="hot_label">
                                            <p>OFF</p>
                                            <b><?php echo round($h->deal_percentage); ?>%</b>
                                        </div>
                                    </div>
                                    <div class="hot_ptoduct_details">
                                        <a class="cursor" href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/product' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"><h2><?php echo substr(ucfirst($h->deal_title), 0, 100); ?></h2></a>
                                        <span>
                                        <b><?php echo $symbol . " " . $h->deal_value; ?></b>
                                        <a href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/product' . $h->deal_key . '/' . $h->url_title . '.html'; ?>" title="<?php echo $h->deal_title; ?>"  class="more_details"></a>
                                        </span>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>

                        </div>
                           <?php } ?>
                        <div class="product_details_list">
                            <div class="pro_top clearfix">
                                <div class="pro_title"><h2><?php echo $this->title_display; ?></h2></div>
                                <!--a class="view_more" href="#" title="VIEW MORE ">VIEW MORE</a-->
                            </div>

                            <div class="pro_mid product_lisitng" id="product">
    <?php echo new View("themes/" . THEME_NAME . "/products/products_list"); ?>

                            </div>
    <?php if (($this->all_products_count > 1)) { ?>
                                <div id="loading">
        <?php if (($this->pagination) != "") { ?>
                                        <div class="feature_viewmore">
                                            <div class="fea_view_more">                                                
                                                <a class="view_more view_more1 view_more_but">
                                                    <span class="view_more_icon">&nbsp;</span><?php echo $this->Lang['SEE_M_PROD']; ?><span class="view_more_icon">&nbsp;</span>
                                                </a> 
                                            </div>
                                        </div>
        <?php } ?>
                                </div>
            <?php } ?>
            
            <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "bf" && $ads->page_position==3) {  ?>  
                                     <div class="side_footer_part wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                        <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " width="790" height="100" /></a>
                                    </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    
                        </div>
                    </div>
                    
                                        <!--sidebar start-->
                    <div class="conntent_left">
                        <div class="category_sidebar">
                                <h1 class="cate_title"><a href="<?php echo PATH; ?>shop-all-category.html" title=""><?php echo $this->Lang['SHOP_AL']; ?></a></h1>
                                <form action="" method="get" name="form1"  >
                                    <ul class="cate_menu">
                                        <?php
                                        $cat = explode(",", substr($this->session->get('categoryID'), 0, -1));
                                        $cat1 = array_unique($cat);
                                        ?>
                                        <?php
                                        foreach ($this->categeory_list_product as $d) {
                                            //$check_sub_cat = common::get_subcat_count($d->category_id, 3, "main", $d->category_url); /*   COUNT OF SUBCATEGORY   */
                                            $check_sub_cat = $d->product_count;
                                            //$subcate_count = common::get_subcat_count1($d->category_id,$d->type);
                                            $subcate_count = 1;
											$subcat_style = ($subcate_count==0)?"background:none":"";
											$encode_catid = $d->category_id;

                                            if ($d->product == 1 && ($check_sub_cat != -1) && ($check_sub_cat !=0)) {
                                                ?>
                                                <li <?php if ($this->category_id == $d->category_id) { ?> class="li_active" <?php } ?>>

														<?php $type = "products";
														$categories = $d->category_url; ?>
                                                    <a style="cursor:pointer;<?php echo $subcat_style;?>" data-subcat="<?php echo $subcate_count; ?>" onclick="filtercategory('<?php echo $categories; ?>', '<?php echo $type; ?>', '<?php echo base64_encode("main"); ?>');" title="<?php echo $d->category_name; ?>"   class="sample cate_subarr" id="sample-<?php echo $encode_catid; ?>" title="<?php echo ucfirst($d->category_name); ?>">
														<?php echo ucfirst($d->category_name) . ' (' . $check_sub_cat . ')'; ?>
                                                    </a>
                                                    <div class="cate_supmenu" id="today_product_sub_category_<?php echo $encode_catid; ?>">
                                                        <ul  id="categeory-<?php echo $encode_catid; ?>"></ul>
                                                    </div>
                                                </li>
        <?php }
    } ?>
                                        <input type="submit" value="submit" id="submit" style="display:none;">
                                    </ul>
                                </form>
<script type="text/javascript">
	$(function() {

		$('.sample').mouseover(function() {
			var getUID =  $(this).attr('id').replace('sample-','');
			var id_val = $('#sample-'+getUID).attr('data-subcat');
			if(id_val==0)
			{
				$('#today_product_sub_category_'+getUID).css('display','none');
				$('#categeory-'+getUID).css('background','none');
			}
			else{
				//var getUID =  $(this).attr('id').replace('sample32-','');
				var url = Path+"products/all_products/?cate_id="+(getUID)+'&t=1';
				$.post(url,function(check){
					if(getUID!=""){
						$('#categeory-'+getUID).html(check);
						$('#categeory-'+getUID).show();
					}
				});
			}

		});
	});
</script>
                        </div>
    <?php
			if(!empty($main_cat) || !empty($sub_cat) || !empty($sec_cat) || !empty($third_cat)) {
    ?>
                        <div class="product_filter_side">
                            <div class="product_filter_title">
                                <h1>
                                    <span><?php echo $this->Lang['SIZES']; ?></span>
                                    <a id="size_filter" class="filter_deleticon" href="javascript:clear_filter('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>','<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>','size','1');"><?php echo $this->Lang['CLR']; ?></a>
                                </h1>
                                <div class="size side_filter_list"> <?php  /* size class used in ajax don't remove that */ ?>
                                    <ul>
                                    <?php foreach ($this->size_list as $size) { ?>
                                        <li>
                                            <input type="checkbox"  value="<?php echo $size->size_id; ?>" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>','<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $size->size_name; ?></p>
                                           </li>    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php if(count($this->color_list) > 0 ) { ?>
                        <div class="product_filter_side">
                            <div class="product_filter_title">
                                <h1>
                                    <span><?php echo $this->Lang['COLORS']; ?></span>
                                    <a id="color_filter" class="filter_deleticon"  href="javascript:clear_filter('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>','<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>','color','1');"><?php echo $this->Lang['CLR']; ?></a>
                                </h1>
                                <div class="color side_filter_list fulli"> <?php  /* color class used in ajax don't remove that */ ?>
                                    <ul>
                                    <?php foreach ($this->color_list as $color) { ?>
                                        <li>

                                                <input type="checkbox"  value="<?php echo $color->color_code_id; ?>" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/>
                                                 <p class="show_color_block">
                                                     <span class="show_color" style='background:#<?php echo $color->color_name; ?>; '></span>
                                                     <b class="show_color_name"><?php echo $color->color_code_name; ?></b>
                                                 </p>
                                             </li>   <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="product_filter_side">
                            <div class="product_filter_title">
                                <h1>
                                    <span><?php echo $this->Lang['DISCOUNT']; ?></span>
                                    <a id="discount_filter" class="filter_deleticon"  href="javascript:clear_filter('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>','<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>','discount','1');"><?php echo $this->Lang['CLR']; ?></a>
                                </h1>
                                <div class="discount side_filter_list fulli"> <?php  /* discount class used in ajax don't remove that */ ?>
                                    <ul>
                                        <li><input type="checkbox"  value="1" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['BELW']; ?> 10% </p></li>
                                        <li><input type="checkbox"  value="2" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>10% - 20% </p></li>
                                        <li><input type="checkbox"  value="3" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>20% - 30% </p></li>
                                        <li><input type="checkbox"  value="4" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>30% - 50%</p></li>
                                        <li><input type="checkbox"  value="5" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p>50% - 75%</p></li>
                                        <li><input type="checkbox"  value="6" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['ABV']; ?> 75% </p></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                         <div class="product_filter_side">
                            <div class="product_filter_title">
                                <h1>
                                    <span><?php echo $this->Lang['PRI']; ?></span>
                                    <a id="price_filter"  class="filter_deleticon"  href="javascript:clear_filter('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>','<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>','price','1');"><?php echo $this->Lang['CLR']; ?></a>
                                </h1>
                                <div class="price side_filter_list fulli"> <?php  /* price class used in ajax don't remove that */ ?>
                                    <ul>
                                        <li><input type="checkbox"  value="1" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['BELW']; ?> <?php echo $symbol; ?> 500 </p></li>
                                        <li><input type="checkbox"  value="2" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 501 - <?php echo $symbol; ?> 1000 </p></li>
                                        <li><input type="checkbox"  value="3" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 1001 - <?php echo $symbol; ?> 1500 </p></li>
                                        <li><input type="checkbox"  value="4" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 1501 - <?php echo $symbol; ?> 2000 </p></li>
                                        <li><input type="checkbox"  value="5" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $symbol; ?> 2001 - <?php echo $symbol; ?> 2500 </p></li>
                                        <li><input type="checkbox"  value="6" onchange="show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');"	/> <p><?php echo $this->Lang['ABV']; ?> <?php echo $symbol; ?> 2500 </p></li>

                                    </ul>
								</div>
                            </div>
                        </div>
    <?php if (count($this->all_products_list) > 1) { ?>
                            <div class="product_filter_side">
                            <div class="product_filter_title">
								<?php $val = CURRENCY_SYMBOL.$this->pro_min." - " .CURRENCY_SYMBOL.$this->pro_max; ?>
                                    <h1>
                                        <span><?php echo $this->Lang['PRICE_RANGE']; ?></span>
                                        <a id="pricetext_filter" class="filter_deleticon" href="javascript:clearprice();"><?php echo $this->Lang['CLR']; ?></a>
                                    </h1>
                                <div class="pricerange_inner">
                                    <div class="catogory_list2">
                                        <div id="slider-range"></div>
                                        <div><input class="pricerange_input" type="text"  id="amount" style="border:none; color:#333;  font-weight:normal;" readonly="readonly" name="amount"/></div>
                                       </div>
                                       <input type="hidden" id="amount1" style="border: 0;text-align:center;" />
                                </div>
                                </div>
                            </div>    <?php } ?>
    <?php }   ?>
    
                         <?php 
			if(empty($main_cat) && empty($sub_cat) && empty($sec_cat) && empty($third_cat)) {
    ?>
                        <!--slider_right content start-->
                                        <?php if (count($this->view_products_list) > 0) { ?>
                            <div class="sidebar_view_product">
                                <div class="sidebar_view_product_title">
                                    <h2><?php echo $this->Lang['MOST_PRO']; ?></h2>
                                </div>

                                        <ul >
                                                        <?php
                                                        $deal_offset = $this->input->get('offset');
                                                        foreach ($this->view_products_list as $products_list) {
                                                            $symbol = CURRENCY_SYMBOL;
                                                            ?>
                                                <li>
                                                    <div class="sidebar_more_product">
                                                        <div class="more_product_image wloader_parent">
                                                            <i class="wloader_img">&nbsp;</i>
                                                            <?php if (file_exists(DOCROOT . 'images/category/icon/' . $products_list->category_url . '.png')) { ?>

            <?php } else { ?>

            <?php } ?>
                                                            <?php  if(file_exists(DOCROOT.'images/products/1000_800/'.$products_list->deal_key.'_1'.'.png')){ 
                                                            $image_url = PATH . 'images/products/1000_800/' . $products_list->deal_key . '_1' . '.png';
                                $size = getimagesize($image_url);
                                                            ?>
                                        <a   href="<?php echo PATH.'../../../../../application - Copy/views/themes/default/products/product'.$products_list->deal_key.'/'.$products_list->url_title.'.html';?>" title="<?php echo $products_list->deal_title; ?>" >
                                        <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
											<img src="<?php echo PATH.'../../../../../application - Copy/views/themes/default/products/resize.php';?>?src=<?php echo PATH .'images/products/1000_800/'.$products_list->deal_key.'_1'.'.png'?>&amp;w=<?php echo PRODUCT_LIST_WIDTH; ?>&amp;h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products_list->deal_title; ?>" title="<?php echo $products_list->deal_title; ?>" />
											
											 <?php } else { ?>
                                 <img src="<?php echo PATH .'../../../../../application - Copy/views/themes/default/products/images/products/1000_800'.$products_list->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                                           <?php /* <img title=" " alt="" src="<?php echo PATH.'images/products/290_215/'.$products_list->deal_key.'_1'.'.png'?>"> */ ?>
                                        </a>
                                                 <?php } else { ?>

                                        <a  href="<?php echo PATH.'../../../../../application - Copy/views/themes/default/products/product'.$products_list->deal_key.'/'.$products_list->url_title.'.html';?>" title="<?php echo $products_list->deal_title; ?>">
                                            <img src="<?php echo PATH.'../../../../../application - Copy/views/themes/default/products/resize.php';?>?src=<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png&amp;w=<?php echo PRODUCT_LIST_WIDTH; ?>&amp;h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products_list->deal_title; ?>" title="<?php echo $products_list->deal_title; ?>" />
                                        </a>
                                         <?php }?>

            <?php $url = PATH . 'product/' . $products_list->deal_key . '/' . $products_list->url_title . '.html'; ?>

                                                        </div>
                                                        <div class="side_porduct_detail">
                                                            <h2>
                                                                 <a class="cursor"  href="<?php echo PATH.'../../../../../application - Copy/views/themes/default/products/product'.$products_list->deal_key.'/'.$products_list->url_title.'.html';?>" title="<?php echo $products_list->deal_title;?>"><?php echo substr(ucfirst($products_list->deal_title),0,100);?></a>
                                                            </h2>

                                                        <div class="deal_listing_price_details">
                                                            <p><?php echo $symbol . " " . $products_list->deal_price; ?></p>
<!--                                                            <b><?php //echo $symbol . " " . $products_list->deal_value; ?></b>-->
                                                        </div>

                                                              </div>
                                                    </div>
                                                </li>
                            <?php } $deal_offset++; ?>
                                        </ul>

                            </div>
                        <?php } ?>
                        <!--slider_right content end -->
                        
                        <?php if (count($this->ads_details) > 0) { ?>   
                                    <?php foreach ($this->ads_details as $ads) { ?>    
            <?php if ($ads->ads_position == "ls" && $ads->page_position==3) {  ?>    
                                       <div class="side_advertise_part wloader_parent">
                                      <i class="wloader_img" style="min-height:250px;">&nbsp;</i>
                                        <a href="<?php echo $ads->redirect_url; ?>" target="blank" title="<?php echo ucfirst($ads->ads_title); ?>"><img src="<?php echo PATH; ?>images/ad_image/<?php echo $ads->ads_id; ?>.png " width="180" height="500" /></a>
                                    </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php } ?>
                    </div>
                    <!--end-->
                </div>
            </div>
            <!--end-->
<?php } else { ?>
    <?php echo new View("themes/" . THEME_NAME . "/subscribe"); ?>
<?php } ?>
    </div>
</div>
</div>
<!--scroll filter start-->
<input type="hidden" name="offset" id="offset" value="12">
<input type="hidden" name="record" id="record" value="12">
<input type="hidden" name="record" id="record1" value="<?php echo $this->all_products_count; ?>">
<link rel="stylesheet" href="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/themes' . THEME_NAME . '/css/jquery-ui.css' ?>" />
<script src="<?php echo PATH . '../../../../../application - Copy/views/themes/default/products/themes' . THEME_NAME . '/js/jquery-ui.js' ?>"></script>
<script>
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: <?php echo $this->pro_min; ?>,
            max: <?php echo $this->pro_max; ?>,
            values: [<?php echo $this->pro_min; ?>,<?php echo $this->pro_max; ?>],
            slide: function(event, ui) {
					$("#amount").val("<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 0 ] + " - " + "<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 1 ]);
					 $("#amount1").val("<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 0 ] + " - " + "<?php echo CURRENCY_SYMBOL; ?>" + ui.values[ 1 ]);
				   show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');

                  },

		  });
        $("#amount").val("<?php echo CURRENCY_SYMBOL; ?>" + $("#slider-range").slider("values", 0) +
                " - " + "<?php echo CURRENCY_SYMBOL; ?>" + $("#slider-range").slider("values", 1));
    });

    function clearprice() {
       $(function() {
       $( "#slider-range" ).slider({


           range: true,
           min: <?php echo $this->pro_min; ?>,
           max: <?php echo $this->pro_max; ?>,
           values: [<?php echo $this->pro_min; ?>,<?php echo $this->pro_max; ?>  ]

       });

       $( "#amount" ).val("<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 0 ) +
           " - " +"<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 1 ) );

           $( "#amount1" ).val("<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 0 ) +
           " - " +"<?php echo CURRENCY_SYMBOL; ?>" + $( "#slider-range" ).slider( "values", 1 ) );
			/* for show the ajax result */
	   show_page('<?php echo $main_cat; ?>', '<?php echo $sub_cat; ?>', '<?php echo $sec_cat; ?>', '<?php echo $third_cat; ?>');

   });
       }

</script>
<!--price filter end-->

<script src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/js/jquery(1).js"  type="text/javascript"></script>
<script language="JavaScript">
	var j = $.noConflict();
    j(function() {
        j(".slidetabs").tabs(".images > div", {
            effect: 'fade',
            fadeOutSpeed: "medium",
            rotate: true
        }).slideshow();
    });
</script>
