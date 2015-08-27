<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if (count($this->all_products_list) > 0) { ?>
<?php  $deal_offset = $this->input->get('offset');
$i = 1;
foreach ($this->all_products_list as $products) {
        $symbol = CURRENCY_SYMBOL;
?>
<div class="product_listing <?php if(($i%4) == 1){ ?>margin-left0<?php } ?>">
    <div class="product_listing_image wloader_parent">        
        <i class="wloader_img">&nbsp;</i>
        <?php if (file_exists(DOCROOT . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png')) { 
                $image_url = PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png';
                $size = getimagesize($image_url); ?>
                    <a class="" href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>">                        
                    <?php if(($size[0] > PRODUCT_LIST_WIDTH) && ($size[1] > PRODUCT_LIST_HEIGHT)) { ?>
                        <img src="<?php echo PATH . 'resize.php'; ?>?src=<?php echo PATH . 'images/products/1000_800/' . $products->deal_key . '_1' . '.png' ?>&w=<?php echo PRODUCT_LIST_WIDTH; ?>&h=<?php echo PRODUCT_LIST_HEIGHT; ?>" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                        <?php } else { ?>
                                 <img src="<?php echo PATH .'images/products/1000_800/'.$products->deal_key.'_1'.'.png'?>" />
                                <?php } ?>
                        
                    </a>
            <?php /* <img src="<?php echo PATH .'images/products/290_215/'.$products->deal_key.'_1'.'.png'?>"  alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>"/> */ ?>
        <?php } else { ?>
                    <a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>">
                        <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/noimage_products_list.png" alt="<?php echo $products->deal_title; ?>" title="<?php echo $products->deal_title; ?>" />
                    </a>
        <?php } ?>
            </div>
        <?php $type = "products";
        $categories = $products->category_url; ?>
            <div class="product_listing_detail">
                <h2><a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $products->deal_title; ?>"><?php echo substr(ucfirst($products->deal_title), 0, 100) ; ?></a>                </h2>
<!--<h3><?php //echo substr(ucfirst(strip_tags($products->deal_description)), 0, 25) . ".."; ?></h3>-->
                <div class="product_listing_price_details">
                <!--<p><?php //echo $symbol . " " . $products->deal_price; ?></p>-->
                <p><?php echo $symbol . " " . $products->deal_value; ?></p>
                </div>
                <div class="product_view_detail">
                     <a href="<?php echo PATH . 'product/' . $products->deal_key . '/' . $products->url_title . '.html'; ?>" title="<?php echo $this->Lang['ADD_TO_CART']; ?>"></a>
                 </div>
                <?php  if (isset($this->sub_cat) && ($this->sub_cat != "")) {    // for product comparision
                $checked = "";
                $compare = $this->session->get("product_compare");
                if (is_array($compare) && count($compare) && (in_array($products->deal_id, $compare))) {
                $checked = "checked";
                } ?>
                <p class="compare_check"><input type="checkbox" name="add_to_comp" <?php echo $checked; ?> onclick="addToCompare('<?php echo $products->deal_id; ?>', this,'list')" data-added="" data-unadded="0" >
                    <span><?php echo $this->Lang['ADD_COMPARE']; ?></span>
                </p>
                <?php } ?>
            </div>
        </div>
        <?php if(($i%4) == 0){ ?>
        <div class="listingspliter"></div>
        <?php } ?>
    <?php $i++; } $deal_offset++; } else { ?>
<?php //echo new View("themes/".THEME_NAME."/subscribe_new"); ?>
<div class="nodata_list_block">
        <img src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/sorry_icon.png" >
        <p> <?php echo $this->Lang['SORRY_NO_ITEM_TODAY']; ?></p>
</div>

<?php } ?>
