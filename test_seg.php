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