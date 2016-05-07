<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet2.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
    	
    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
});
</script>
</head>
<body>
  <?php if ($logged) { ?>
<div id="container">
<?php } ?>
<div id="container2"> 
<div id="header">
  <?php if ($logged) { ?>
  <div class="div1">
  <?php } ?>  
    <div class="div2">
      <?php if ($logged) { ?>
      <h1><?php echo $heading_title ;?></h1>
      <?php } ?>    
    </div>
    <?php if ($logged) { ?>
    <div class="div3"><img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />&nbsp;<?php echo $logged; ?></div>
    
    <div id="div4" class="div4">
        <a onClick="window.open('<?php echo $store; ?>');"><?php echo $text_front; ?></a>
      
        <?php foreach ($stores as $stores) { ?>
              <a onClick="window.open('<?php echo $stores['href']; ?>');"><?php echo $stores['name']; ?>
        <?php } ?>
        <a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a>
          
    </div>
    <div id="div5" class="div5">
        <a onClick="window.open('<?php echo $store; ?>');"><?php echo $text_front; ?></a>
       
        <?php foreach ($stores as $stores) { ?>
              <a onClick="window.open('<?php echo $stores['href']; ?>');"><?php echo $stores['name']; ?>
        <?php } ?>
        <a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a>
          
    </div>
      
    <?php } ?>
  </div> 
 
  <?php if ($logged) { ?>
<div id="left">  
  <ul class="dashboard"><span></span><p><a href="<?php echo $home; ?>"><?php echo $text_dashboard; ?></a></p>
  </ul>

  <ul class="catalog"><span></span><p><?php echo $text_catalog; ?></p>
    <li><img alt="" src="view/image/category.png"><a href="<?php echo $category; ?>"><?php echo $text_category; ?></a></li>
    <li><img alt="" src="view/image/product.png"><a href="<?php echo $product; ?>"><?php echo $text_product; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $attribute; ?>"><?php echo $text_attribute; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $attribute_group; ?>"><?php echo $text_attribute_group; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $option; ?>"><?php echo $text_option; ?></a></li>
    <li><img alt="" src="view/image/shipping.png"><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
    <li><img alt="" src="view/image/download.png"><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
    <li><img alt="" src="view/image/review.png"><a href="<?php echo $review; ?>"><?php echo $text_review; ?></a></li>
    <li><img alt="" src="view/image/information.png"><a href="<?php echo $information; ?>"><?php echo $text_information; ?></a></li>
  </ul>

  <ul class="extension"><span></span><p><?php echo $text_extension; ?></p>
    <li><img alt="" src="view/image/module.png"><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
    <li><img alt="" src="view/image/shipping.png"><a href="<?php echo $shipping; ?>"><?php echo $text_shipping; ?></a></li>
    <li><img alt="" src="view/image/payment.png"><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
    <li><img alt="" src="view/image/total.png"><a href="<?php echo $total; ?>"><?php echo $text_total; ?></a></li>
    <li><img alt="" src="view/image/feed.png"><a href="<?php echo $feed; ?>"><?php echo $text_feed; ?></a></li>
  </ul>

  <ul class="sale"><span></span><p><?php echo $text_sale; ?></p>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
    <li><img alt="" src="view/image/customer.png"><a href="<?php echo $customer; ?>"><?php echo $text_customer; ?></a></li>
    <li><img alt="" src="view/image/customer.png"><a href="<?php echo $customer_group; ?>"><?php echo $text_customer_group; ?></a></li>
    <li><img alt="" src="view/image/customer.png"><a href="<?php echo $customer_blacklist; ?>"><?php echo $text_customer_blacklist; ?></a></li>
    <li><img alt="" src="view/image/customer.png"><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
    <li><img alt="" src="view/image/customer.png"><a href="<?php echo $coupon; ?>"><?php echo $text_coupon; ?></a></li>
    <li><img alt="" src="view/image/payment.png"><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
    <li><img alt="" src="view/image/payment.png"><a href="<?php echo $voucher_theme; ?>"><?php echo $text_voucher_theme; ?></a></li>
    <li><img alt="" src="view/image/mail.png"><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
  </ul>

  <ul class="system"><span></span><p><?php echo $text_system; ?></p>
    <li><img alt="" src="view/image/setting.png"><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>    
    <li><img alt="" src="view/image/layout.png"><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
    <li><img alt="" src="view/image/banner.png"><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
    <li><img alt="" src="view/image/banner.png"><a href="<?php echo $banner_flash; ?>"><?php echo $text_banner_flash; ?></a></li>
    <li><img alt="" src="view/image/user.png"><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
    <li><img alt="" src="view/image/user-group.png"><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
   

    <li><img alt="" src="view/image/language.png"><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
    <li><img alt="" src="view/image/payment.png"><a href="<?php echo $currency; ?>"><?php echo $text_currency; ?></a></li>
    <li><img alt="" src="view/image/stock-status.png"><a href="<?php echo $stock_status; ?>"><?php echo $text_stock_status; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $return_status; ?>"><?php echo $text_return_status; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $return_action; ?>"><?php echo $text_return_action; ?></a></li>
    <li><img alt="" src="view/image/order.png"><a href="<?php echo $return_reason; ?>"><?php echo $text_return_reason; ?></a></li>
    <li><img alt="" src="view/image/country.png"><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
    <li><img alt="" src="view/image/country.png"><a href="<?php echo $zone; ?>"><?php echo $text_zone; ?></a></li>
    <li><img alt="" src="view/image/country.png"><a href="<?php echo $geo_zone; ?>"><?php echo $text_geo_zone; ?></a></li>
    <li><img alt="" src="view/image/tax.png"><a href="<?php echo $tax_class; ?>"><?php echo $text_tax_class; ?></a></li>
    <li><img alt="" src="view/image/tax.png"><a href="<?php echo $tax_rate; ?>"><?php echo $text_tax_rate; ?></a></li>
    <li><img alt="" src="view/image/length.png"><a href="<?php echo $length_class; ?>"><?php echo $text_length_class; ?></a></li>
    <li><img alt="" src="view/image/shipping.png"><a href="<?php echo $weight_class; ?>"><?php echo $text_weight_class; ?></a></li>
    <li><img alt="" src="view/image/log.png"><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
    <li><img alt="" src="view/image/backup.png"><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
  </ul>

  <ul class="reports"><span></span><p><?php echo $text_reports; ?></p>
      <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
      <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_sale_tax; ?>"><?php echo $text_report_sale_tax; ?></a></li>
      <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_sale_shipping; ?>"><?php echo $text_report_sale_shipping; ?></a></li>
      <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_sale_return; ?>"><?php echo $text_report_sale_return; ?></a></li>
      <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_sale_coupon; ?>"><?php echo $text_report_sale_coupon; ?></a></li>      
    <li><img alt="" src="view/image/report.png"><?php echo $text_product; ?></li>
    <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_product_viewed; ?>"><?php echo $text_report_product_viewed; ?></a></li>
    <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_product_purchased; ?>"><?php echo $text_report_product_purchased; ?></a></li>
    <li><img alt="" src="view/image/report.png"><?php echo $text_customer; ?></li>
    <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_customer_order; ?>"><?php echo $text_report_customer_order; ?></a></li>
    <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_customer_reward; ?>"><?php echo $text_report_customer_reward; ?></a></li>
    <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_customer_credit; ?>"><?php echo $text_report_customer_credit; ?></a></li>
    <li><img alt="" src="view/image/report.png"><?php echo $text_affiliate; ?></li>
    <li><img alt="" src="view/image/report.png"><a href="<?php echo $report_affiliate_commission; ?>"><?php echo $text_report_affiliate_commission; ?></a></li>
  </ul>


  </ul>
</div>
<?php } ?>
<script type='text/javascript'>
$(function(){$(window).scroll(function(){if($(this).scrollTop()!=0){$('#div5').fadeOut();}else{$('#div5').fadeIn();}});$('#div5 ').click(function(){$('body,html').animate({scrollTop:80},0);});});
</script>
<script type='text/javascript'>
$(function(){$(window).scroll(function(){if($(this).scrollTop()!=0){$('#div4').fadeIn();}else{$('#div4').fadeOut();}});$('#div4 ').click(function(){$('body,html').animate({scrollTop:0},800);});});
</script>