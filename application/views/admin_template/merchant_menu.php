<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript">
function toggle(ids){
	$(".toggleul_"+ids).slideToggle();
	var imgSrc = document.getElementById("left_menubutton_"+ids).src;
	imgSrc = imgSrc.substr(-13, 13);
	if(imgSrc == "minus_but.png"){
		document.getElementById("left_menubutton_"+ids).src = "<?php echo PATH; ?>images/plus_but.png"
	}
	else{
		document.getElementById("left_menubutton_"+ids).src = "<?php echo PATH; ?>images/minus_but.png"
	}		
}
</script>
<div class="menu">
  <div class="menu_container">
    <?php if(isset($this->mer_deals_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_deals.png" alt="<?php echo $this->Lang['DEALS']; ?>"/><span><?php echo $this->Lang['DEALS']; ?></span></p></div>
	<?php } ?>
	<?php if(isset($this->mer_products_act)){ ?>
	 <div class="menu_title"><p><img src="<?php echo PATH ?>images/title_products.png" alt="<?php echo $this->Lang['PRODUCTS']; ?>"/><span><?php echo $this->Lang['PRODUCTS']; ?></span></p></div>
	<?php } ?>
	<?php if(isset($this->mer_auction_act)){ ?>
	 <div class="menu_title"><p><img src="<?php echo PATH ?>images/title_products.png" alt="<?php echo $this->Lang['AUCTION']; ?>"/><span><?php echo $this->Lang['AUCTION']; ?></span></p></div>
	<?php } ?>
	<?php if(isset($this->mer_merchant_act)){ ?>
	 <div class="menu_title"><p><img src="<?php echo PATH ?>images/title_merchant.png" alt="<?php echo $this->Lang['SHOP']; ?>"/><span><?php echo $this->Lang['SHOP']; ?></span></p></div>
	<?php } ?>
	<?php if(isset($this->mer_transactions_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_balance.png" alt="<?php echo $this->Lang['TRANS']; ?>"/><span><?php echo $this->Lang['TRANS']; ?></span></p></div>
	<?php } ?>
	<?php if(isset($this->mer_fund_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_fund_request.png" alt="<?php echo $this->Lang['FUND_REQ']; ?>"/><span><?php echo $this->Lang['FUND_REQ']; ?></span></p></div>
	<?php } ?>
	<?php if(isset($this->mer_settings_act)){ ?>
	 <div class="menu_title"><p> <img src="<?php echo PATH ?>images/title_module_settings.png" alt="<?php echo $this->Lang['SETTINGS']; ?>" /><span><?php echo $this->Lang['SETTINGS']; ?></span></p></div>
	<?php } ?>
    <ul>   
        
        <?php if(isset($this->mer_deals_act)){ ?>
        <li <?php if(isset($this->dashboard_deals)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/deals-dashboard.html" title="<?php echo $this->Lang['DEAL_DASH']; ?>"><span class="fund_management fl"><?php echo $this->Lang['DEAL_DASH']; ?></span></a></li>
        <li <?php if(isset($this->add_deal)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add-deals.html" title="<?php echo $this->Lang["ADD_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_DEALS"]; ?></span></a></li>
        <li <?php if(isset($this->manage_deals)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/manage-deals.html" title="<?php echo $this->Lang["MANAGE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_DEALS"]; ?></span></a></li>
        <li <?php if(isset($this->archive_deals)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/archive-deals.html" title="<?php echo $this->Lang["ARCHIVE_DEALS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ARCHIVE_DEALS"]; ?></span></a></li>        
        <li <?php if(isset($this->couopn_code)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/couopn_code.html" title="<?php echo $this->Lang["COUPON_VALIDATE"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["COUPON_VALIDATE"]; ?></span></a></li>
        <li <?php if(isset($this->close_code)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/close-couopn-list.html" title="<?php echo $this->Lang["REDEM_COU_LI"]; ?>"><span class="fund_management fl"><?php echo $this->Lang['REDEM_COU_LI']; ?></span></a></li>
        <?php } ?>
    
        <?php if(isset($this->mer_products_act)){ ?>
        <li <?php if(isset($this->dashboard_products)){ ?> class="menu_active"  <?php } ?>>
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/products-dashboard.html" title="<?php echo $this->Lang['PRODUCT_DASH']; ?>"><span class="fund_management fl"><?php echo $this->Lang['PRODUCT_DASH']; ?></span></a></li>
        <li <?php if(isset($this->add_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add-products.html" title="<?php echo $this->Lang["ADD_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ADD_PRODUCTS"]; ?></span></a></li>
        <li <?php if(isset($this->manage_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/manage-products.html" title="<?php echo $this->Lang["MANAGE_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_PRODUCTS"]; ?></span></a></li>
        <li <?php if(isset($this->archive_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/sold-products.html" title="<?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["ARCHIVE_PRODUCTS"]; ?></span></a></li>
        <li <?php if(isset($this->import_product)){ ?> class="menu_active"  <?php } ?> >
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/product-import.html" title="<?php echo $this->Lang["PRODUCT_IMPORT"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["PRODUCT_IMPORT"]; ?></span></a></li>
        <li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH; ?>merchant/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>
        <li <?php if(isset($this->cash_delivery)){ ?> class="menu_active"  <?php } ?> >
        <a href="<?php echo PATH; ?>merchant/cash-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>
        <?php } ?>
        
        <?php   if(isset($this->mer_auction_act)){ ?>
        <li <?php if(isset($this->auction_products)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant/auction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['ACT_DASH']; ?>"><span class="customer_comments"><?php echo $this->Lang['ACT_DASH']; ?></span></a></li>
        <li <?php if(isset($this->add_auction)){ ?> class="menu_active"  <?php } ?>>        
        <a href="<?php echo PATH; ?>merchant/add-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ADD_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ADD_ACT_PRO']; ?></span></a></li>
        <li <?php if(isset($this->manage_auction)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant/manage-auction.html" class="menu_rgt" title="<?php echo $this->Lang['MAG_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['MAG_ACT_PRO']; ?></span></a></li>
        <li <?php if(isset($this->archive_auction)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant/archive-auction.html" class="menu_rgt" title="<?php echo $this->Lang['ARCH_ACT_PRO']; ?>"><span class="customer_comments"><?php echo $this->Lang['ARCH_ACT_PRO']; ?></span></a></li>
        <li <?php if(isset($this->winner)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant-auction/winner-list.html" class="menu_rgt" title="<?php echo $this->Lang['WIN_LIST2']; ?>"><span class="customer_comments"><?php echo $this->Lang['WIN_LIST2']; ?></span></a></li>
        <li <?php if(isset($this->shipping_delivery)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant-auction/shipping-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['SHIP_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['SHIP_DEL']; ?></span></a></li>        
        <li <?php if(isset($this->cod_delivery)){ ?> class="menu_active"  <?php } ?> >        
        <a href="<?php echo PATH; ?>merchant-auction/cod-delivery.html" class="menu_rgt" title="<?php echo $this->Lang['CASH_ON_DEL']; ?>"><span class="customer_comments"><?php echo $this->Lang['CASH_ON_DEL']; ?></span></a></li>
        <?php }  ?>

        <?php if(isset($this->mer_merchant_act)){ ?>
        <li <?php if(isset($this->manage_merchant_shop)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/manage-shop.html" title="<?php echo $this->Lang["MANAGE_SHOP"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["MANAGE_SHOP"]; ?></span></a></li>
        <li <?php if(isset($this->add_merchant_shop)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add-shop.html" title="<?php echo $this->Lang['ADD_SHOPS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['ADD_SHOPS']; ?></span></a></li>
        <?php } ?>
        
        <?php if(isset($this->mer_fund_act)){ ?>	
        <li <?php if(isset($this->manage_fund_request)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/fund_request.html" title="<?php echo $this->Lang["FUND_REQ_REP"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["FUND_REQ_REP"]; ?></span></a></li>
        <li <?php if(isset($this->add_fund_request)){ ?> class="menu_active"  <?php } ?>>        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/add_fund_request.html" title="<?php echo $this->Lang["WITHDRAW_FUND"]; ?>"><span class="fund_management fl"><?php echo $this->Lang["WITHDRAW_FUND"]; ?></span></a></li>
        <?php } ?>

	<?php   if(isset($this->mer_transactions_act)){ ?>    
	<li <?php if(isset($this->dashboard_transaction)){ ?> class="menu_active"  <?php } ?>>        
        <a href="<?php echo PATH; ?>merchant/transaction-dashboard.html" class="menu_rgt" title="<?php echo $this->Lang['TRANS_DASH']; ?>"><span class="payment_transactions"><?php echo $this->Lang['TRANS_DASH']; ?></span></a></li>		
		<li onclick="toggle(12)" <?php if(isset($this->deal_trans)){ ?> class="menu_active"  <?php } ?> >        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['DLS_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['DLS_TRANS']; ?></span><img id="left_menubutton_12" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_12">
			<li><a href="<?php echo PATH; ?>merchant/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>			
			<li>
        
        <a href="<?php echo PATH; ?>merchant/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span></a></li>
                    <li><a href="<?php echo PATH; ?>merchant/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li><a href="<?php echo PATH; ?>merchant/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li><a href="<?php echo PATH; ?>merchant/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>

		<li onclick="toggle(11)" <?php if(isset($this->pro_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_TRANS']; ?></span><img id="left_menubutton_11" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_11">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-product/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			<?php /* <li>
        		
        			<a href="<?php echo PATH; ?>merchant-product/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>
            <li>
        
        <a href="<?php echo PATH; ?>merchant-product/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-product/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-product/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
		<li onclick="toggle(13)" <?php if(isset($this->cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['PRO_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['PRO_COD']; ?></span><img id="left_menubutton_13" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_13">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-cod/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH; ?>merchant-cod/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-cod/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-cod/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
		<li onclick="toggle(10)" <?php if(isset($this->act_trans)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_TRANS']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_TRANS']; ?></span><img id="left_menubutton_10" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>
        <ul class="toggleul_10">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>

			<?php /* <li>
        		
        			<a href="<?php echo PATH; ?>merchant-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['SUCC_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['SUCC_TRAN']; ?></span>
					</a>
			</li> */ ?>
			
            <li>
        
        <a href="<?php echo PATH; ?>merchant-auction/completed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>

      <li onclick="toggle(15)" <?php if(isset($this->auction_cod_trans)){ ?> class="menu_active"  <?php } ?> >
        
        
        <a class="menu_rgt"  href="javascript:;" title="<?php echo $this->Lang['ACT_COD']; ?>"><span class="category_management fl"><?php echo $this->Lang['ACT_COD']; ?></span><img id="left_menubutton_15" src="<?php echo PATH; ?>images/plus_but.png" alt="<?php echo $this->Lang['IMAGE']; ?>" /></a>


        <ul class="toggleul_15">
			<li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/all-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['ALL_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['ALL_TRAN']; ?></span></a></li>
			
            <li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/success-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['COMP_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['COMP_TRAN']; ?></span></a></li>
        <li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/hold-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['HOLD_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['HOLD_TRAN']; ?></span></a></li>
	<li>
        
        <a href="<?php echo PATH; ?>merchant-cod-auction/failed-transaction.html" class="menu_rgt1" title="<?php echo $this->Lang['FAI_TRAN']; ?>"><span class="pl15"><?php echo $this->Lang['FAI_TRAN']; ?></span></a></li>
        </ul>
      </li>
      
    <?php } ?>


    <?php if(isset($this->mer_settings_act)){ ?>	
	
	    <li <?php if(isset($this->merchant_settings)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/settings.html" title="<?php echo $this->Lang['SETTINGS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SETTINGS']; ?></span></a></li>
        <li <?php if(isset($this->edit_merchant)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/Edit_info.html" title="<?php echo $this->Lang['EDIT_ACC']; ?>"><span class="fund_management fl"><?php echo $this->Lang['EDIT_ACC']; ?></span></a></li>
        <li <?php if(isset($this->merchant_password)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/change_password.html" title="<?php echo $this->Lang['CHANGE_PASS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['CHANGE_PASS']; ?></span></a></li>
        
        <li <?php if(isset($this->flat_amount)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/change_shipping_setting.html" title="<?php echo $this->Lang['SHIPP_MODULE'].' '.$this->Lang['SETTINGS']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SHIPP_MODULE'].' '.$this->Lang['SETTINGS']; ?></span></a></li>
        
                <?php /* if($this->aramex_setting == 1){ ?>
                <li <?php if(isset($this->shipp_acc_setting)){ ?> class="menu_active"  <?php } ?> >
        
        <a class="menu_rgt"  href="<?php echo PATH; ?>merchant/shipping-account-settings.html" title="<?php echo $this->Lang['SHIPP_ACC_SETT']; ?>"><span class="fund_management fl"><?php echo $this->Lang['SHIPP_ACC_SETT']; ?></span></a></li>  
                <?php }  */ ?>            
        
        
    <?php } ?>
    </ul>

  </div>
</div>
