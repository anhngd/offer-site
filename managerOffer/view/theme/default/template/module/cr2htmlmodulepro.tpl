<?php
echo $csscode;
if ($borderless) { echo $code; }
else { ?>
<div class="box<?php echo " ".$classname; echo ($boxstyle!="nobox"?" cr2".$boxstyle:""); ?>">
  <div class="box-heading"<?php if (!$title) {echo " style=\"height: 5px; background-image: none; border-bottom: none; padding: 0 !important;\""; }; ?>>
	<?php if($title) { echo $title; } else { echo "&nbsp;"; } ?>
  </div>
    <div class="box-content" style="text-align: left;">
    <?php echo $code; ?>
  </div>
</div>
<?php }; ?>