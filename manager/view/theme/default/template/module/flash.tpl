<div style="text-align:center;">
  <?php foreach ($flashs as $flash) { ?>
  <object>
	<embed src="image/<?php echo $flash['flash_name'];?>" width="<?php echo $flash['width'];?>" height="<?php echo $flash['height'];?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" menu="false" wmode="transparent"></embed></object>
	
  <?php } ?>
</div>

