</div> 
</div> 
<?php if($this->config->get('tg_isis_footer_status') == '0'): ?>
<div id="footerimage"> </div>
<?php endif; ?>

<div id="footer">
<?php if($this->config->get('tg_isis_footer_status') == '1'): ?>


  <div class="footer-area">
	<div class="footer-wrapper">

    	
    	<!-- information column -->
    	<?php if($this->config->get('tg_isis_footer_footer_info_enabled') == '1'): ?>  
    		<div class="column_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>">   
 			<div class="header_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>"><?php echo $this->config->get('mymodule_title' . $this->config->get('config_language_id')); ?></div>
		   		<?php echo html_entity_decode($this->config->get('mymodule_code' . $this->config->get('config_language_id')));?>
		    </div> <!-- class column (end) -->
 		<?php endif; ?>
 		
 		
 		<!-- contact us column -->
 		<?php if($this->config->get('tg_isis_footer_footer_contacts_enabled') == '1'): ?>   
 			<div class="column_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>">   
 			<div class="header_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>"><?php echo $this->config->get('mymodule_title2' . $this->config->get('config_language_id')); ?></div>
		   		<div class="column2">
				<ul>
				<?php if ($this->config->get('tg_isis_footer_phone_show') == "1") { ?>
      				<li><img src="catalog/view/theme/isis/image/homephone-iconnew.png" alt="" />&nbsp;&nbsp;<?php echo $this->config->get('tg_isis_footer_phone'); ?></li>
      			<?php } ?>
   
     		    <?php if ($this->config->get('tg_isis_footer_mobile_show') == "1") { ?>
    		  	   <li><img src="catalog/view/theme/isis/image/phone-icon.png" alt="" />&nbsp;&nbsp;<?php echo $this->config->get('tg_isis_footer_mobile'); ?></li>
     		    <?php } ?>
      
      			<?php if ($this->config->get('tg_isis_footer_email_show') == "1") { ?>
      			   <li><img src="catalog/view/theme/isis/image/email-icon.png" alt="" />&nbsp;&nbsp;<a href="mailto:<?php echo $this->config->get('tg_isis_footer_email'); ?>"><?php echo $this->config->get('tg_isis_footer_email'); ?></a></li>
      			<?php } ?>
      
     	 		<?php if ($this->config->get('tg_isis_footer_skype_show') == "1") { ?>
      			   <li><img src="catalog/view/theme/isis/image/skype-icon.png" alt="" />&nbsp;&nbsp;<a href="skype:<?php echo  $this->config->get('tg_isis_footer_skype'); ?>?chat" target="_blank"><?php echo  $this->config->get('tg_isis_footer_skype'); ?></a></li>
      			<?php } ?>
      
     	     	<?php if ($this->config->get('tg_isis_footer_address_show') == "1") { ?>
      			   <li><img src="catalog/view/theme/isis/image/address-icon.png" alt="" />&nbsp;&nbsp;<?php echo  $this->config->get('tg_isis_footer_address'); ?></li>
      			<?php } ?>
				</ul>
				</div> <!-- class column (end) -->

				
			</div> <!-- class column (end) -->
 		<?php endif; ?>
		
		<!-- twitter column -->
 		<?php if($this->config->get('tg_isis_footer_footer_twitter_enabled') == '1'): ?>
        	<div class="column_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>">   
 			<div class="header_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>"><?php echo $this->config->get('mymodule_title3' . $this->config->get('config_language_id')); ?></div>
		   	<div id="twitter" >		
          	<ul id="twitter_update_list"></ul>
          	<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
          	<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $this->config->get('tg_isis_footer_twitter_username'); ?>.json?callback=twitterCallback2&amp;count=<?php echo $this->config->get('tg_isis_footer_tweets'); ?>"></script>
    		</div><!-- twitter (end) -->
    		</div><!-- column (end) -->
        <?php endif; ?>
 		
 		<?php if($this->config->get('tg_isis_footer_footer_facebookfp_enabled') == '1'): ?>
        	<div class="column_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>">   
 			<div class="header_<?php echo 12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')); ?>"><?php echo $this->config->get('mymodule_title4' . $this->config->get('config_language_id')); ?></div>
			
			<div class="s_widget_holder">
	       		
       <fb:fan profileid="<?php echo $this->config->get('tg_isis_footer_facebook_id'); ?>" stream="0" connections="<?php echo (12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')))*2 ; ?>" logobar="0" width="<?php echo ((12 / ($this->config->get('tg_isis_footer_footer_info_enabled') + $this->config->get('tg_isis_footer_footer_contacts_enabled') + $this->config->get('tg_isis_footer_footer_twitter_enabled') + $this->config->get('tg_isis_footer_footer_facebookfp_enabled')))*80) - 20; ?>"   css="<?php echo HTTPS_SERVER; ?>catalog/view/theme/isis/stylesheet/facebook.css.php?343"></fb:fan>
      </div>
			</div>
    
        <?php endif; ?>
 		
	<?php if($this->config->get('tg_isis_footer_footer_facebookfp_enabled') == '1'): ?>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({appId: '0c18007de6f00f7ecda8c040fb76cd90', status: true, cookie: true,
     xfbml: true});
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
    '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
<?php endif; ?>	
 		
        
	</div> <!-- footer-holder (end) -->
			
	<!-- DEFAULT FOOTER -->
	<?php if ($this->config->get('tg_isis_footer_default_show') == "1") { ?>
	<div class="footer-default">
			
			<div class="column">
    <h4><?php echo $text_information; ?></h4>
    <ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <div class="column">
    <h4><?php echo $text_service; ?></h4>
    <ul>
      <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
      <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <h4><?php echo $text_extra; ?></h4>
    <ul>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
      <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
      <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
      <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <h4><?php echo $text_account; ?></h4>
    <ul>
      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
      <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
  </div>
</div>	</div> <!-- footer-default (end) -->


 <?php } ?>
    	</div> <!-- footer-wrapper (end) -->
    </div><!-- footer-area (end) -->

	
<?php endif; ?>



<div id="footer_bottom">
<div class="info">
<div id="footer_container">


	
	<div id="powered">
	<div id="powered-holder">

<?php if($this->config->get('tg_isis_paymentimages_status') == '1'): ?>	
<div id="paymentimage">
  	<?php if (unserialize($this->config->get('tg_isis_paymentimages_slide_image'))) {?>	
  		<?php foreach( unserialize($this->config->get('tg_isis_paymentimages_slide_image')) as $image): ?>
      		<?php if ($image['url']) {?>
      		<span style="margin-left:5px;"><a href="<?php echo $image['url'];?>" target="_blank"><img src="<?php echo HTTPS_SERVER . 'image/' . $image['file'];?>" /></a></span>
      	<?php } else { ?>
      		<span style="margin-left:5px;"><img src="<?php echo HTTPS_SERVER . 'image/' . $image['file'];?>" /></span>
      	<?php } ?>
    	<?php endforeach; ?>
    <?php } ?>

    </div> <!-- paymentimage (end) -->
</div>
</div>
	
	
	

<?php endif; ?> <!-- tg_isis_paymentimages_status (end) -->
</div> <!-- #footer_container (end) -->
</div>  <!-- #footer_bottom (end) -->
<?php foreach ($modules as $module) { ?>
<?php echo $module; ?>
<?php } ?>
</body>
</html>
