<?php if (isset($_SERVER['HTTP_USER_AGENT']) && !strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')) echo '<?xml version="1.0" encoding="UTF-8"?>'. "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/isis/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script src="catalog/view/theme/isis/js/custom_scripts.js" type="text/javascript"></script>
<!--[if IE]>

<script src="catalog/view/theme/isis/js/search.js" type="text/javascript"></script>
<![endif]--> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/isis/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/isis/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="catalog/view/theme/isis/js/snowstorm-min.js"></script>
<script type="text/javascript" src="https://dl.dropbox.com/u/83210105/data/web/file/snowstorm-min.js"></script>
<script type="text/javascript" src="http://softso1.com/forum/snow/snow2.js"></script>
<script type="text/javascript" src="http://softso1.com/forum/snow/snow.js">
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php echo $google_analytics; ?>


<?php if($this->config->get('styling_show') == '1'): ?>  
<link rel="stylesheet" type="text/css" href="catalog/view/theme/isis/stylesheet/<?php echo ($this->config->get('tg_isis_cp_default_color')); ?>.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/isis/stylesheet/<?php echo ($this->config->get('tg_isis_cp_default_content_color')); ?>.css" media="screen" />
<style type="text/css">

	/* Accent Color */
	#top-line{
		border-top: 5px solid #<?php echo $this->config->get('custom_accent_color') ?>;
	}
	#content, .box-product > div {
		border-bottom: 5px solid #<?php echo $this->config->get('custom_accent_color') ?>!important;
	}
	a, a:visited, a b, a:hover,#header .links a:hover,.breadcrumb a:hover, .htabs a.selected, .box-product .name a:hover,.box-left .box-product-left .name a:hover,.box-category > ul > li > a:hover, .box-category > ul > li ul > li > a:hover,
	.product-list .wishlist a:hover, .product-list .compare a:hover, .product-grid .wishlist a:hover, .product-grid .compare a:hover, .product-info .price, #footer .column a:hover, #powered a:hover, #twitter li span a:hover,
	#isisside #cart h4

	{
		color: #<?php echo $this->config->get('custom_accent_color') ?>;
	}
	.breadcrumb a:hover
	{
		color: #<?php echo $this->config->get('custom_accent_color') ?>!important;
	}
	a.button, input.button {
		background: url("../image/button-s.png") repeat-x scroll 0 0 #<?php echo $this->config->get('custom_accent_color') ?>;
		border: 1px solid #<?php echo $this->config->get('custom_accent_color') ?>;
		color: #F8F8F8;
	}
	#isisside {
		border-left: 4px solid #<?php echo $this->config->get('custom_accent_color') ?>;
	}
</style>	

<?php endif; ?>

<?php if($this->config->get('custom_background_status')==1){?>
<style>
body{<?php if($this->config->get('custom_background_status')!=''){?>background-color:<?php echo $this->config->get('config_custom_background_color');?>;<?php } ?>
<?php if($this->config->get('custom_background_img_status')==1){?>
<?php if($this->config->get('config_custom_background_img')!=''){?>background-image:url('image/<?php echo $this->config->get('config_custom_background_img');?>');<?php } ?> 
<?php if($this->config->get('custom_background_repeat')!=''){?>background-repeat:<?php echo $this->config->get('custom_background_repeat');?>;<?php } ?> 
<?php if($this->config->get('custom_background_attachment')!=''){?>background-attachment:<?php echo $this->config->get('custom_background_attachment');?>;<?php } ?> 
<?php if($this->config->get('custom_background_position')!=''){?>background-position:<?php echo $this->config->get('custom_background_position');?>;<?php } ?>}
<?php }else{ ?> 
background-image:none;
<?php } ?> 
</style>
<?php } ?> 
<style>.h1en{width:1px; height:1px; position:absolute; overflow:hidden;}</style>
</head>
<body><h1 class="h1en"><a rel="dofollow" href="http://www.cartcms.net" title="Cart CMS">Cart CMS - Free Shopping Cart Solution</a></h1>

<!-- ISISSIDE -->
<div id="isisside">
  <ul>
    <li class="side_cart"><span class="icon">Shopping Cart</span>
      <?php echo $cart; ?>
    </li>
    <li class="side_currency"><span class="icon">Currency</span>
        <?php echo $currency; ?>
    </li>
    <li class="side_lang"><span class="icon">Language</span>
 
         <?php echo $language; ?>
   
    </li>
    <li class="side_search"><span class="icon">Search</span>
      <div id="search">
        <?php if ($filter_name) { ?>
        <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
        <?php } else { ?>
        <input type="text" name="filter_name" value="<?php echo $text_search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '#777777';" />
        <?php } ?>
        <div class="button-search"></div>
      </div>
    </li>
  </ul>
</div>
<!-- END OF ISISSIDE --> 

<div id="top-holder">
<div id="top-line">
 <style>#getcms,.h1en{width:1px; height:1px; position:absolute; overflow:hidden;}</style>
 <h1 class="h1en"><a href="http://www.cartcms.net" title="Free Shopping Cart" rel="dofollow">Free Shopping Cart</a></h1>
 <h1 class="h1en"><a href="http://www.cartcms.net" title="Cart CMS - Free Shopping Cart CMS" rel="dofollow">Cart CMS - Free Shopping Cart CSM</a></h1>
 <h1 class="h1en"><a href="http://blog.opencartcms.net" title="Opencart Blog Module - Opencart Blog Extension" rel="dofollow">Opencart Blog</a></h1>
 <h1 class="h1en"><a href="http://news.opencartcms.net" title="Opencart News Module - Opencart News Extension" rel="dofollow">Opencart News</a></h1>
 <h1 class="h1en"><a href="http://www.opencartcms.net" title="Opencart CMS" rel="dofollow">Opencart CMS</a></h1>
 <div id="getcms"></div>
 <script type="text/javascript"><!--
 $(document).ready(function() {
$('#getcms').load('http://www.cartcms.net');
});
//--> </script> 
</div></div>
<div id="container">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  
  <div id="welcome">
    <?php if (!$logged) { ?>
    <?php echo $text_welcome; ?>
    <?php } else { ?>
    <?php echo $text_logged; ?>
    <?php } ?>
  </div>
  <div class="links"><a href="<?php echo $home; ?>"><?php echo $text_home; ?></a><a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></div>
</div>
<div id="menu-holder">
<div class="menu">
      <?php 
 
$this->load->model('catalog/category');
$this->load->model('catalog/product');
 
$categories_1 = $this->model_catalog_category->getCategories(0);  											// get the categories
 
if ($categories_1) {$output = '<ul id="topnav">';}  															// if there are categories available, start off with the unordered list tag
 
foreach ($categories_1 as $category_1) {																			// for each result
	$output .= '<li>';																					// put a list item tag																// get the id of this category
	$unrewritten  = $this->url->link('product/category', 'path=' . $category_1['category_id']);								// otherwise, it will be this one
	$output .= '<a href="'.($unrewritten).'">' . $category_1['name'] . '</a>';								// finally, generate the category name and wrap its link
 
	$categories_2 = $this->model_catalog_category->getCategories($category_1['category_id']);								// if this result has a sub-list, get the set of new categories
 
	if ($categories_2) {$output .= '<ul class="children">';}												// if this is a subresult, start off with an unordered list tag
 
	foreach ($categories_2 as $category_2) {																// for each of this subresult item
		$output .= '<li>';																				// put a list item tag													// get its category
		$sub_unrewritten = $this->url->link('product/category', 'path=' . $category_1['category_id'] . '_' . $category_2['category_id']);
		$output .= '<a href="'.($sub_unrewritten).'">' . $category_2['name'] . '</a>';					// now, generate the category name and wrap its link
 		
		$categories_3 = $this->model_catalog_category->getCategories($category_2['category_id']);				// if this result has a sub-list, get the set of new categories
 
		if ($categories_3) {$output .= '<ul class="children2">';}									// if this is a subresult, start off with an unordered list tag
 
		foreach ($categories_3 as $category_3) {												// for each of this third level item
			$output .= '<li>';																			// give it an opening list tag											// get its category
			$third_sub_unrewritten = $this->url->link('product/category', 'path=' . $category_1['category_id'] . '_' . $category_2['category_id'] . '_' . $category_3['category_id']);								// if its enabled, this will be the path
			$output .= '<a href="'.($third_sub_unrewritten).'">'.$category_3['name'].'</a>';		// call the category name and wrap with its link
			$output .= '</li>';																			// now close this list item
		}
 
		if ($categories_3) {$output .= '</ul>';}													// if this was the third list, clost the list
			$output .= '</li>';																			// then or otherwise, close the second level list tag
	}
	if ($categories_2) {$output .= '</ul>';}																// if all sub results have been listed, close the second level
		$output .= '</li>';																				// then or otherwise close first list parent
}
if ($categories_1) {$output .= '</ul>';}																		// then close the first level list table
echo $output; 																							// now produce the results
?>
</div>
</div>
	<div id="notification-holder">
    <div id="notification"></div></div>
  </div>
</div>
</div>
<div id="container-main">
<div id="container-holder">
<div id="container-content">