
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
  
   <div id="tabs" class="htabs"><a href="#tab_styling">Styling Options</a></div>
   

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      

		
					
					<tr>
						<td>Disable / enable custom styling options? </td>
						<td><select name="styling_show">
						<?php if ($styling_show) { ?>
							<option value="1" selected="selected">Enable</option>
							<option value="0">Disable</option>
						<?php } else { ?>
							<option value="1">Enable</option>
							<option value="0" selected="selected">Disable</option>
						<?php } ?>
						</select>
						</td>
					</tr>
					</span>
					<br/>
					<br/>
					<div id="tab_background">
						<div class="slider wrap">
						<div class="rght">
							<table class="form-table cmsmasters-options">
								
								<tr valign="top">
									<th align="left"><span class="label">Primary Color</span> <br/>
									<div class="dn" id="custom_background_color_light">Select your website primary color from our colors gallery or choose your custom background color.</div></th>
								</tr>
								
								<tr>
          <td><span style="font-weight:bold">Primary Color</span>
          <select name="tg_isis_cp_default_color">
              
              <?php if (isset($tg_isis_cp_default_color)) {
              $selected = "selected";
              ?>
											
              
              <option value="blue" <?php if($tg_isis_cp_default_color=='blue'){echo $selected;} ?>>Blue</option>
			  <option value="brown" <?php if($tg_isis_cp_default_color=='brown'){echo $selected;} ?>>Brown</option>
			  <option value="dark" <?php if($tg_isis_cp_default_color=='dark'){echo $selected;} ?>>Dark</option>
			  <option value="light" <?php if($tg_isis_cp_default_color=='light'){echo $selected;} ?>>Light</option>
			  <option value="light-blue" <?php if($tg_isis_cp_default_color=='light-blue'){echo $selected;} ?>>Light Blue</option>
			  <option value="light-orange" <?php if($tg_isis_cp_default_color=='light-orange'){echo $selected;} ?>>Light Orange</option>
			  <option value="midnight-blue" <?php if($tg_isis_cp_default_color=='midnight-blue'){echo $selected;} ?>>Midnight Blue</option>
			  <option value="mint" <?php if($tg_isis_cp_default_color=='mint'){echo $selected;} ?>>Mint</option>
			  <option value="orange" <?php if($tg_isis_cp_default_color=='orange'){echo $selected;} ?>>Orange</option>
			  <option value="purple" <?php if($tg_isis_cp_default_color=='purple'){echo $selected;} ?>>Purple</option>
			  <option value="red" <?php if($tg_isis_cp_default_color=='red'){echo $selected;} ?>>Red</option>
			  <option value="tan" <?php if($tg_isis_cp_default_color=='tan'){echo $selected;} ?>>Tan</option>
			  
			  <?php } else { ?>
              <option value="blue">Blue</option>
              <option value="brown">Brown</option>
              <option value="dark">Dark</option>
              <option value="light">Light</option>
			  <option value="light-blue">Light Blue</option>
              <option value="light-orange">Light Orange</option>
              <option value="midnight">Midnight Blue</option>
              <option value="mint">Mint</option>
			  <option value="orange">Orange</option>
              <option value="purple">Purple</option>
              <option value="red">Red</option>
              <option value="tan">Tan</option>
	
              <?php } ?>
           </select></td>
		   
        </tr>
		
		<tr>
		<td><span style="font-weight:bold">Content Color</span>
          <select name="tg_isis_cp_default_content_color">
              
              <?php if (isset($tg_isis_cp_default_content_color)) {
              $selected = "selected";
              ?>
											
              
              <option value="content-blue" <?php if($tg_isis_cp_default_content_color=='content-blue'){echo $selected;} ?>>Blue</option>
			  <option value="content-brown" <?php if($tg_isis_cp_default_content_color=='content-brown'){echo $selected;} ?>>Brown</option>
			  <option value="content-dark" <?php if($tg_isis_cp_default_content_color=='content-dark'){echo $selected;} ?>>Dark</option>
			  <option value="content-light" <?php if($tg_isis_cp_default_content_color=='content-light'){echo $selected;} ?>>Light</option>
			  <option value="content-light-blue" <?php if($tg_isis_cp_default_content_color=='content-light-blue'){echo $selected;} ?>>Light Blue</option>
			  <option value="content-light-orange" <?php if($tg_isis_cp_default_content_color=='content-light-orange'){echo $selected;} ?>>Light Orange</option>
			  <option value="content-midnight-blue" <?php if($tg_isis_cp_default_content_color=='content-midnight-blue'){echo $selected;} ?>>Midnight Blue</option>
			  <option value="content-mint" <?php if($tg_isis_cp_default_content_color=='content-mint'){echo $selected;} ?>>Mint</option>
			  <option value="content-orange" <?php if($tg_isis_cp_default_content_color=='content-orange'){echo $selected;} ?>>Orange</option>
			  <option value="content-purple" <?php if($tg_isis_cp_default_content_color=='content-purple'){echo $selected;} ?>>Purple</option>
			  <option value="content-red" <?php if($tg_isis_cp_default_content_color=='content-red'){echo $selected;} ?>>Red</option>
			  <option value="content-tan" <?php if($tg_isis_cp_default_content_color=='content-tan'){echo $selected;} ?>>Tan</option>
			  
			  <?php } else { ?>
              <option value="content-blue">Blue</option>
              <option value="content-brown">Brown</option>
              <option value="content-dark">Dark</option>
              <option value="content-light">Light</option>
			  <option value="content-light-blue">Light Blue</option>
              <option value="content-light-orange">Light Orange</option>
              <option value="content-midnight">Midnight Blue</option>
              <option value="content-mint">Mint</option>
			  <option value="content-orange">Orange</option>
              <option value="content-purple">Purple</option>
              <option value="content-red">Red</option>
              <option value="content-tan">Tan</option>
	
              <?php } ?>
           </select></td>
		 </tr>
								<tr>
								
									<th align="r"><span class="label">Accent Color</span>
						
								<div class="customchar">#</div>
									<input size="10" name="custom_accent_color" id="custom_accent_color" type="text" value="<?php echo $custom_accent_color; ?>" class="fl" />
					
									<div class="mycolorpicker_parent">
										<div class="mycolorpicker" id="custom_accent_color_mycolor"></div>
										<div id="custom_accent_color_colorpicker" style="background-color:#<?php echo $custom_accent_color; ?>;"></div>
									</div> <!-- mycolorpicker_parent (end) --> 

									<script type="text/javascript">
										jQuery(document).ready(function(){
										jQuery('#custom_accent_color, #custom_accent_color_mycolor').ColorPicker({
										onSubmit: function(hsb, hex, rgb, el) {
										jQuery('#custom_accent_color').val(hex);
										jQuery('#custom_accent_color_colorpicker').css('backgroundColor', '#' + hex)
										jQuery(el).ColorPickerHide();
									},
										onBeforeShow: function () {
										jQuery(this).ColorPickerSetColor(jQuery('#custom_accent_color').val());
									}
									});
									});
									</script>
								
						 </tr>
								
								
							
							
								
							</table>	

						</div>
					</div>
				</div>
			

		
				
				
		
			
			</div> <!-- #tab_styling (end) -->
			
			
			
			
	</form>


<script type="text/javascript" src="view/javascript/jquery/ui/ui.draggable.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/ui.resizable.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/ui.dialog.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/external/bgiframe/jquery.bgiframe.js"></script>
<script type="text/javascript"><!--
function image_upload(field, preview) {
	$('#dialog').remove();

	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&field=' + encodeURIComponent(field) + '&token=<?php echo $this->session->data['token']; ?>" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $this->session->data['token']; ?>',
					type: 'POST',
					data: 'image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" style="border: 1px solid #EEEEEE;" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
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
//--></script>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();
//--></script> 


