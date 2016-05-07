<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td>
                  <?php if ($custom_background_status) { ?>
                <input type="radio" name="custom_background_status" value="1" checked="checked" />
                <?php echo $text_enabled; ?>
                <input type="radio" name="custom_background_status" value="0" />
                <?php echo $text_disabled; ?>
                <?php } else { ?>
                <input type="radio" name="custom_background_status" value="1" />
                <?php echo $text_enabled; ?>
                <input type="radio" name="custom_background_status" value="0" checked="checked" />
                <?php echo $text_disabled; ?>
                <?php } ?></td>
          </tr>
          
            <tr>
              <td><?php echo $entry_background_image; ?></td>
              <td><div class="image"><img src="<?php echo $custom_background_img; ?>" alt="" id="thumb-custom_background_img" />
                  <input type="hidden" name="config_custom_background_img" value="<?php echo $config_custom_background_img; ?>" id="custom_background_img" />
                  <br />
                  <a onclick="image_upload('custom_background_img', 'thumb-custom_background_img');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb-custom_background_img').attr('src', '<?php echo $no_image; ?>'); $('#custom_background_img').attr('value', '');"><?php echo $text_clear; ?></a></div>
                  
                  <?php if ($custom_background_img_status) { ?>
                <input type="radio" name="custom_background_img_status" value="1" checked="checked" />
                <?php echo $text_enabled; ?>
                <input type="radio" name="custom_background_img_status" value="0" />
                <?php echo $text_disabled; ?>
                <?php } else { ?>
                <input type="radio" name="custom_background_img_status" value="1" />
                <?php echo $text_enabled; ?>
                <input type="radio" name="custom_background_img_status" value="0" checked="checked" />
                <?php echo $text_disabled; ?>
                <?php } ?>
                  </td>
            </tr>
            
            <tr>
              <td><?php echo $entry_background_color; ?></td>
              <td><input type="text" name="config_custom_background_color" class="color-picker" size="6" autocomplete="on" maxlength="10" value="<?php echo $config_custom_background_color; ?>"/></td>
            </tr>
            <tr>
              <td><?php echo $entry_background_position; ?></td>
              <td><select name="custom_background_position">
                  <?php if ($custom_background_position=='top left') { ?>
                  <option value="top left" selected="selected">top left</option>
                    <option value="top center">Top center</option>
                    <option value="top right">Top right</option>
                    <option value="bottom left">Bottom left</option>
                    <option value="bottom center">Bottom center</option>
                    <option value="bottom right">Bottom right</option>
                  <?php } elseif($custom_background_position=='top center') { ?>
                  <option value="top left">Top left</option>
                    <option value="top center" selected="selected">Top center</option>
                    <option value="top right">Top right</option>
                    <option value="bottom left">Bottom left</option>
                    <option value="bottom center">Bottom center</option>
                    <option value="bottom right">Bottom right</option>
                  <?php } elseif($custom_background_position=='top right') { ?>
                  <option value="top left"top left</option>
                    <option value="top center">>Top center</option>
                    <option value="top right" selected="selected">Top right</option>
                    <option value="bottom left">Bottom left</option>
                    <option value="bottom center">Bottom center</option>
                    <option value="bottom right">Bottom right</option>
                  <?php } elseif($custom_background_position=='bottom left') { ?>
                  <option value="top left"top left</option>
                    <option value="top center">>Top center</option>
                    <option value="top right">Top right</option>
                    <option value="bottom left" selected="selected">Bottom left</option>
                    <option value="bottom center">Bottom center</option>
                    <option value="bottom right">Bottom right</option>
                  <?php } elseif($custom_background_position=='bottom center') { ?>
                  <option value="top left"top left</option>
                    <option value="top center">>Top center</option>
                    <option value="top right">Top right</option>
                    <option value="bottom left">Bottom left</option>
                    <option value="bottom center" selected="selected">Bottom center</option>
                    <option value="bottom right">Bottom right</option>
                  <?php } elseif($custom_background_position=='bottom right') { ?>
                  <option value="top left"top left</option>
                    <option value="top center">>Top center</option>
                    <option value="top right">Top right</option>
                    <option value="bottom left">Bottom left</option>
                    <option value="bottom center">Bottom center</option>
                    <option value="bottom right" selected="selected">Bottom right</option>
                  <?php }else{ ?>
                    <option value="top center">Top center</option>
                    <option value="top right">Top right</option>
                    <option value="bottom left">Bottom left</option>
                    <option value="bottom center">Bottom center</option>
                    <option value="bottom right">Bottom right</option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_background_repeat; ?></td>
              <td><select name="custom_background_repeat">
                  <?php if ($custom_background_repeat=='repeat') { ?>
                  <option value="repeat" selected="selected">repeat</option>
                  <option value="repeat-x">repeat-x</option>
                  <option value="repeat-y">repeat-y</option>
                  <option value="no-repeat">no-repeat</option>
                  <?php } elseif($custom_background_repeat=='repeat-x') { ?>
                  <option value="repeat">repeat</option>
                  <option value="repeat-x" selected="selected">repeat-x</option>
                  <option value="repeat-y">repeat-y</option>
                  <option value="no-repeat">no-repeat</option>
                  <?php } elseif($custom_background_repeat=='repeat-y') { ?>
                  <option value="repeat">repeat</option>
                  <option value="repeat-x">repeat-x</option>
                  <option value="repeat-y" selected="selected">repeat-y</option>
                  <option value="no-repeat">no-repeat</option>
                  <?php } elseif($custom_background_repeat=='no-repeat') { ?>
                  <option value="repeat">repeat</option>
                  <option value="repeat-x">repeat-x</option>
                  <option value="repeat-y">repeat-y</option>
                  <option value="no-repeat" selected="selected">no-repeat</option>
                  <?php }else{ ?>
                  <option value="repeat">repeat</option>
                  <option value="repeat-x">repeat-x</option>
                  <option value="repeat-y">repeat-y</option>
                  <option value="no-repeat">no-repeat</option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_background_attachment; ?></td>
              <td><select name="custom_background_attachment">
                  <?php if ($custom_background_attachment=='scroll') { ?>
                  <option value="scroll" selected="selected">scroll</option>
                  <option value="fixed">fixed</option>
                  <?php } elseif($custom_background_attachment=='repeat-x') { ?>
                  <option value="scroll">scroll</option>
                  <option value="fixed" selected="selected">fixed</option>
                  <?php }else{ ?>
                  <option value="scroll">scroll</option>
                  <option value="fixed">fixed</option>
                  <?php } ?>
                </select></td>
            </tr>
            
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
			$(document).ready( function() {
				$(".color-picker").miniColors({
					letterCase: 'uppercase',
					change: function(hex, rgb) {
						logData(hex, rgb);
					}
				});
			});
</script>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<?php echo $footer; ?>