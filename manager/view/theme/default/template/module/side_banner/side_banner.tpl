 <div id="divAdLeft" style="display: none; position: absolute; top: 0px; z-index:999;">  
  <div id="left_banner<?php echo $module; ?>" class="banner">
  <?php foreach ($left_banners as $left_banner) { ?>
  <?php if ($left_banner['link']) { ?>
  <div><a href="<?php echo $left_banner['link']; ?>"><img src="<?php echo $left_banner['image']; ?>" alt="<?php echo $left_banner['title']; ?>" title="<?php echo $left_banner['title']; ?>" /></a></div>
  <?php } else { ?>
  <div><img src="<?php echo $left_banner['image']; ?>" alt="<?php echo $left_banner['title']; ?>" title="<?php echo $left_banner['title']; ?>" /></div>
  <?php } ?>
  <?php } ?>
</div></div>

<div id="divAdRight" style="display: none; position: absolute; top: 0px; z-index:999;">
    <div id="right_banner<?php echo $module; ?>" class="banner">
  <?php foreach ($right_banners as $right_banner) { ?>
  <?php if ($right_banner['link']) { ?>
  <div><a href="<?php echo $right_banner['link']; ?>"><img src="<?php echo $right_banner['image']; ?>" alt="<?php echo $right_banner['title']; ?>" title="<?php echo $right_banner['title']; ?>" /></a></div>
  <?php } else { ?>
  <div><img src="<?php echo $right_banner['image']; ?>" alt="<?php echo $right_banner['title']; ?>" title="<?php echo $right_banner['title']; ?>" /></div>
  <?php } ?>
  <?php } ?>
</div>
    </div>
    
    <script>
    document.write("<script type='text/javascript' language='javascript'>MainContentW=1024;LeftBannerW =<?php echo $width;?>;RightBannerW =<?php echo $width;?>;LeftAdjust = -15;RightAdjust =-15;TopAdjust = 10;ShowAdDiv();window.onresize=ShowAdDiv;;<\/script>");
    </script>




<script type="text/javascript"><!--
$(document).ready(function() {
	$('#left_banner<?php echo $module; ?> div:first-child').css('display', 'block');
	$('#right_banner<?php echo $module; ?> div:first-child').css('display', 'block');
});
var banner<?php echo $module; ?> = function() {
	$('#left_banner<?php echo $module; ?>').cycle({
		before: function(current, next) {
			$(next).parent().height($(next).outerHeight());
		}
	});	
	$('#right_banner<?php echo $module; ?>').cycle({
		before: function(current, next) {
			$(next).parent().height($(next).outerHeight());
		}
	});
}
setTimeout(banner<?php echo $module; ?>, 1000);
//--></script>