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
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <div id="tabs" class="htabs">
        <?php for ($i=1;$i<=10;$i++) { ?><a href="#tab-<?php echo $i;?>"><span><?php echo $entry_area; ?> <?php echo $i;?></span></a><?php }; ?>
        <a href="#tab-11"><span><?php echo $entry_style; ?></span></a>
    </div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    <?php for ($i=1;$i<=10;$i++) { ?>
    <div id="tab-<?php echo $i;?>" style="clear: both;">
      <table class="form">
	<?php foreach ($languages as $language) { ?>
	<tr>
	<td><?php echo $entry_title; ?></td>
	  <td>
	    <input type="text" name="cr2htmlmodulepro_title<?php echo $i.'_'.$language['language_id']; ?>" id="cr2htmlmodulepro_title<?php echo $i.'_'.$language['language_id']; ?>" size="30" value="<?php echo ${'cr2htmlmodulepro_title' . $i.'_'.$language['language_id']}; ?>" />
	    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
     	  </td>
	</tr>
	<?php } ?>
	<tr>
	  <td><?php echo $entry_header; ?></td>
	  <td>
	    <?php
		if(${'cr2htmlmodulepro_header'.$i}) {
		   $checked1 = ' checked="checked"';
		   $checked0 = '';
		}else{
		   $checked1 = '';
		   $checked0 = ' checked="checked"';
	    } ?>
		<label for="cr2htmlmodulepro_header<?php echo $i;?>_1"><?php echo $entry_yes; ?></label>
		<input type="radio"<?php echo $checked1; ?> id="cr2htmlmodulepro_header<?php echo $i;?>_1" name="cr2htmlmodulepro_header<?php echo $i;?>" value="1" />
		<label for="cr2htmlmodulepro_header<?php echo $i;?>_0"><?php echo $entry_no; ?></label>
		<input type="radio"<?php echo $checked0; ?> id="cr2htmlmodulepro_header<?php echo $i;?>_0" name="cr2htmlmodulepro_header<?php echo $i;?>" value="0" />
	  </td>
	</tr>

	<tr>
	  <td><?php echo $entry_borderless; ?></td>
	  <td>
	    <?php
		if(${'cr2htmlmodulepro_borderless'.$i}) {
		   $checked1 = ' checked="checked"';
		   $checked0 = '';
		}else{
		   $checked1 = '';
		   $checked0 = ' checked="checked"';
	    } ?>
		<label for="cr2htmlmodulepro_borderless<?php echo $i;?>_1"><?php echo $entry_yes; ?></label>
		<input type="radio"<?php echo $checked1; ?> id="cr2htmlmodulepro_borderless<?php echo $i;?>_1" name="cr2htmlmodulepro_borderless<?php echo $i;?>" value="1" />
		<label for="cr2htmlmodulepro_borderless<?php echo $i;?>_0"><?php echo $entry_no; ?></label>
		<input type="radio"<?php echo $checked0; ?> id="cr2htmlmodulepro_borderless<?php echo $i;?>_0" name="cr2htmlmodulepro_borderless<?php echo $i;?>" value="0" />
		<span class="help"><?php echo $entry_borderlesswarn; ?></span>
	  </td>
	</tr>

	<?php foreach ($languages as $language) { ?>
        <tr>
	  <td><?php echo $entry_code; ?></td>
          <td><textarea name="cr2htmlmodulepro_code<?php echo $i;?>_<?php echo $language['language_id']; ?>" cols="40" rows="10"><?php echo isset(${'cr2htmlmodulepro_code' . $i.'_'.$language['language_id']}) ? ${'cr2htmlmodulepro_code' . $i.'_'.$language['language_id']} : ''; ?></textarea>
	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
          </td>
        </tr>
	<?php } ?>
      </table>
     </div><!--area $i-->
     <?php } // for i=1..10 ?>
    <div id="tab-11" style="clear: both;">
      <table class="form">
        <tr>
	  <td><?php echo $entry_customcss; ?></td>
          <td><textarea name="cr2htmlmodulepro_customcss" cols="100" rows="20"><?php echo isset($cr2htmlmodulepro_customcss) ? $cr2htmlmodulepro_customcss : ''; ?></textarea><br />
          </td>
        </tr>
      </table>
    </div><!--area11-->
      <table id="module" class="list">
        <thead>
          <tr>
            <td class="left"><?php echo $entry_area_id; ?></td>
            <td class="left"><?php echo $entry_classname; ?></td>
            <td class="left"><?php echo $entry_boxstyle; ?></td>
            <td class="left"><?php echo $entry_layout; ?></td>
            <td class="left"><?php echo $entry_position; ?></td>
            <td class="left"><?php echo $entry_status; ?></td>
            <td class="right"><?php echo $entry_sort_order; ?></td>
            <td></td>
          </tr>
        </thead>
        <?php $module_row = 0; ?>
        <?php foreach ($modules as $module) { ?>
        <tbody id="module-row<?php echo $module_row; ?>">
          <tr>
            <td class="left">
              <select name="cr2htmlmodulepro_module[<?php echo $module_row; ?>][area_id]">
              <?php for ($i=1; $i<=10; $i++) { ?>
               <option value="area<?php echo $i; ?>" <?php if ($module['area_id']=="area".$i) {echo "selected=\"selected\"";}; ?>>Area <?php echo $i; ?></option>
              <?php }; ?>
               <!--<option value="customcss" <?php if ($module['area_id'] == "customcss") {echo "selected=\"selected\"";}; ?>>Custom CSS</option>-->
              </select></td>
            <td class="left">
              <input type="text" name="cr2htmlmodulepro_module[<?php echo $module_row; ?>][classname]" value="<?php echo $module['classname']; ?>" size="15" />
            </td>
            <td class="left">
              <select name="cr2htmlmodulepro_module[<?php echo $module_row; ?>][boxstyle]">
               <option value="nobox" <?php if ($module['boxstyle']=="nobox") {echo "selected=\"selected\"";}; ?>> - <?php echo $entry_nobox; ?> - </option>
               <option value="darkbox" <?php if ($module['boxstyle']=="darkbox") {echo "selected=\"selected\"";}; ?>><?php echo $entry_darkbox; ?></option>
               <option value="bluebox" <?php if ($module['boxstyle']=="bluebox") {echo "selected=\"selected\"";}; ?>><?php echo $entry_bluebox; ?></option>
               <option value="redbox" <?php if ($module['boxstyle']=="redbox") {echo "selected=\"selected\"";}; ?>><?php echo $entry_redbox; ?></option>
               <option value="greenbox" <?php if ($module['boxstyle']=="greenbox") {echo "selected=\"selected\"";}; ?>><?php echo $entry_greenbox; ?></option>
               <option value="yellowbox" <?php if ($module['boxstyle']=="yellowbox") {echo "selected=\"selected\"";}; ?>><?php echo $entry_yellowbox; ?></option>
              </select>
            </td>
            <td class="left"><select name="cr2htmlmodulepro_module[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            <td class="left"><select name="cr2htmlmodulepro_module[<?php echo $module_row; ?>][position]">
                <?php if ($module['position'] == 'content_top') { ?>
                <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                <?php } else { ?>
                <option value="content_top"><?php echo $text_content_top; ?></option>
                <?php } ?>
                <?php if ($module['position']  == 'content_bottom') { ?>
                <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                <?php } else { ?>
                <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                <?php } ?>
                <?php if ($module['position']  == 'column_left') { ?>
                <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                <?php } else { ?>
                <option value="column_left"><?php echo $text_column_left; ?></option>
                <?php } ?>
                <?php if ($module['position']  == 'column_right') { ?>
                <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                <?php } else { ?>
                <option value="column_right"><?php echo $text_column_right; ?></option>
                <?php } ?>
              </select></td>
            <td class="left"><select name="cr2htmlmodulepro_module[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
            <td class="right"><input type="text" name="cr2htmlmodulepro_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
            <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
          </tr>
        </tbody>
        <?php $module_row++; ?>
        <?php } ?>
        <tfoot>
          <tr>
            <td colspan="7"></td>
            <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
          </tr>
        </tfoot>
      </table>
     </form>
    </div>
	<div style="text-align:center; color:#666666;">
		CR2 HTML Module Pro v<?php echo $cr2htmlmodulepro_version; ?> - <a href="http://www.riotreactions.eu/cat/opencart-modules/html-module/" target="_blank">Support</a>
	</div>
</div>
</div>
<?php echo $footer; ?>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
<?php for ($i=1;$i<=10;$i++) { ?>
CKEDITOR.replace('cr2htmlmodulepro_code<?php echo $i.'_'.$language['language_id']; ?>', {
     filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php }; //for $i ?>
<?php }; //foreach ?>
//CKEDITOR.replace('cr2htmlmodulepro_customcss', {
	//filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	//filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	//filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	//filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	//filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
//});

//--></script>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="cr2htmlmodulepro_module[' + module_row + '][area_id]" > <?php for ($i=1; $i<=10; $i++) { ?><option value="area<?php echo $i;?>">Area <?php echo $i; ?></option><?php }; ?> <!--<option value="customcss">Custom CSS</option> </select>--> </td>';
	html += '    <td class="left"><input type="text" name="cr2htmlmodulepro_module[' + module_row + '][classname]" value="" size="15" /></td>';
     html += '    <td class="left"><select name="cr2htmlmodulepro_module[' + module_row + '][boxstyle]">\
                              <option value="nobox" selected="selected"> - <?php echo $entry_nobox; ?> - </option>\
                              <option value="darkbox"><?php echo $entry_darkbox; ?></option>\
                              <option value="bluebox"><?php echo $entry_bluebox; ?></option>\
                              <option value="redbox"><?php echo $entry_redbox; ?></option>\
                              <option value="greenbox"><?php echo $entry_greenbox; ?></option>\
                              <option value="yellowbox"><?php echo $entry_yellowbox; ?></option></select></td>';
	html += '    <td class="left"><select name="cr2htmlmodulepro_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="cr2htmlmodulepro_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="cr2htmlmodulepro_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="cr2htmlmodulepro_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';

	$('#module tfoot').before(html);

	module_row++;
}

/*$('#form').bind('submit', function() {
	var module = new Array();

	$('#module tbody').each(function(index, element) {
		module[index] = $(element).attr('id').substr(10);
	});

	$('input[name=\'cr2htmlmodulepro_module\']').attr('value', module.join(','));

});*/
//--></script>
<script type="text/javascript"><!--
$(function() { $('#tabs a').tabs();  });
//--></script>
<script type="text/javascript"><!--
function image_upload(field, preview) {
	$('#dialog').remove();

	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

	$('#dialog').dialog({
		title: 'Image Manager',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>',
					type: 'POST',
					data: 'image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" class="image" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
					}
				});
			}
		},
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};