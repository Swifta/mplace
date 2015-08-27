    <div class="footer_outer">
        <div class="footer_inner">
            <div class="footer">
                     <div class="footer_coloumn_one footer_list">
                         <h3><?php echo $this->Lang['SERV']; ?></h3>
                          <ul>
                        <li> <a href="<?php echo PATH ?>about-us.html" title="<?php echo $this->Lang['ABT']; ?>"><?php echo $this->Lang["ABT"]; ?></a></li>
                        <li><a href="<?php echo PATH ?>contactus.html" title="<?php echo $this->Lang['CONTACT_US']; ?>"><?php echo $this->Lang["CONTACT_US"]; ?></a></li>
                       
                        <?php if ($this->faq_setting) { ?>
                            <li><a href="<?php echo PATH ?>faq.html" title="<?php echo $this->Lang['FAQ']; ?>"><?php echo $this->Lang['FAQ']; ?></a></li>
                        <?php } ?>
    <?php if ($this->blog_setting) { ?>
                            <li><a href="<?php echo PATH ?>blog" title="<?php echo $this->Lang['BLOG']; ?>"><?php echo $this->Lang["BLOG"]; ?></a></li>
                        <?php } ?>

    <?php if ($this->cms_setting == 0) {
        foreach ($this->get_all_cms_title as $d) { ?>
        <?php if($d->cms_title != "Help"){ ?>
                                <li> <a <?php if ($d->type == 3) { ?>href="<?php echo $d->cms_desc; ?>" <?php } else { ?> href="<?php echo PATH . $d->cms_url . '.php' ?>" <?php } ?> title="<?php echo $d->cms_title; ?>"> <span class="aerro_right_common1"> <?php echo $d->cms_title; ?></span></a></li>
                        <?php } ?>
                    <?php }
                } ?>
               </ul>
             </div>
                <?php  if ((ANDROID_PAGE) || (IPHONE_PAGE)) { ?>
                <div class="footer_coloumn_two footer_list">
                    <div class="footer_mobile_app">
                        <h3><?php echo $this->Lang['NOW_APP_STORE']; ?></h3>
                        <ul>
                            <?php if (ANDROID_PAGE) { ?>
                            <li><a href="<?php echo ANDROID_PAGE; ?>" title="<?php echo $this->Lang['DOWN_ANDROID']; ?>"  target="blank"  class="foot_andi"><?php echo $this->Lang['DOWN_ANDROID']; ?></a></li>
                            <?php } if (IPHONE_PAGE) { ?>
                            <li><a href="<?php echo IPHONE_PAGE; ?>" title="<?php echo $this->Lang['DOWN_IPHONE']; ?>"  target="blank" class="foot_andi foot_iphone"><?php echo $this->Lang['DOWN_IPHONE']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
                <div class="footer_coloumn_three footer_list">
                   <div class="cridit_cards"> <h3><?php echo $this->Lang['MERCHANT_ACC']; ?></h3>
                    <ul class="foot_merchant">
                         <li> <a  href="<?php echo PATH . 'merchant-login.html'; ?>" title="<?php  echo $this->Lang['MER_LOIN']; ?>"><?php echo $this->Lang['MER_LOIN']; ?></a></li>
                         <li>/ </li>
                    <li><a  href="<?php echo PATH . 'merchant-signup-step1.html'; ?>" title="<?php  echo $this->Lang['MER_REGI']; ?>"><?php echo $this->Lang['MER_REGI']; ?></a> </li>
                    </ul>
                </div>
                
                <div class="cridit_cards"> <h3><?php echo $this->Lang['PAY_MTD']; ?></h3>
                    <ul>
                         <li><img  src="<?php echo PATH; ?>themes/<?php echo THEME_NAME; ?>/images/new/payment_cards.png" alt="<?php echo $this->Lang['VISA']; ?>"/></li>
                    </ul>
                </div>
                </div>
                <div class="footer_coloumn_four footer_list">
                    <div class="social_icon">
                    <h3><?php echo $this->Lang['JOIN_US']; ?></h3>
                    <ul>
                        <?php if (FB_PAGE) { ?>
                            <li><a class="facebook1" href="<?php echo FB_PAGE; ?>"  target="blank" title="<?php echo $this->Lang['FB']; ?>"></a></li>
                        <?php }if (TWITTER_PAGE) { ?>
                            <li><a class="twitter1" href="<?php echo TWITTER_PAGE; ?>" target="blank" title="<?php echo $this->Lang['TW']; ?>"></a></li>
                        <?php }if (LINKEDIN_PAGE) { ?>
                            <li><a class="linke_in" href="<?php echo LINKEDIN_PAGE; ?>" target="blank" title="<?php echo $this->Lang['LINK']; ?>"></a></li>
                        <?php }if (YOUTUBE_URL) { ?>
                            <li><a class="youtube" href="<?php echo YOUTUBE_URL; ?>" target="blank" title="<?php echo $this->Lang['YOU_TUBE']; ?>"></a></li>
    <?php } ?>
    
    <?php if(CITY_SETTING) {
     if ($this->city_id) { ?>
        <?php foreach ($this->all_city_list as $CX) {
            if ($this->city_id == $CX->city_id) { ?>
                                    <li><a class="rss_1" href="<?php echo PATH . 'deals/rss/' . $this->city_id . '/' . $CX->city_url; ?>" target="blank" title="<?php echo $this->Lang['RSS_FEED']; ?>"></a></li>

            <?php }
        }
    } 
    
    }  else { ?>
    
    <li><a class="rss_1" href="<?php echo PATH . 'rss'; ?>" target="_blank" title="<?php echo $this->Lang['RSS_FEED']; ?>"></a></li>
    
  <?php  }?>                       
    <?php /* <li><a class="gooican" href="<?php echo YOUTUBE_URL; ?>" target="blank" title="google">Google+</a></li> */ ?>
                    </ul>
                    <div class="copy_right" >
                    <label> <?php echo $this->Lang['FOOTER_COPYRIGHT']; ?> <?php echo SITENAME; ?> <?php echo $this->Lang['FOOTER_ALLRIGHT']; ?></label>
                </div>
                </div>
                </div>






            </div>
        </div>
    </div>



