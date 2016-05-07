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
    <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_gen; ?></a><a href="#tab-info"><?php echo $tab_info; ?></a><a href="#tab_contact"><?php echo $tab_contact; ?></a><a href="#tab-twitter"><?php echo $tab_twitter; ?></a><a href="#tab-default"><?php echo $tab_default; ?></a></div>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    
    
    
<div id="tab-general">  
    <table class="form">
		<tr>
          <td><?php echo $entry_status; ?></td>
          <td><select name="tg_isis_footer_status">
              	<?php if ($tg_isis_footer_status) { ?>
             		 <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
             		 <option value="0"><?php echo $text_disabled; ?></option>
              	<?php } else { ?>
              	   	 <option value="1"><?php echo $text_enabled; ?></option>
              		 <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
          </td>
        </tr>
		
		<tr>
          <td>Default Opencart Footer:</td>
          <td colspan="3"><select name="tg_isis_footer_default_show">
              <?php if ($tg_isis_footer_default_show) { ?>
              <option value="1" selected="selected">Yes</option>
              <option value="0">No</option>
              <?php } else { ?>
              <option value="1">Yes</option>
              <option value="0" selected="selected">No</option>
              <?php } ?>
            </select></td>
        </tr>
		
		
    </table>
</div> <!-- tab_general (end) -->
    
     
<div id="tab-info">
 <table class="form">
    		<tr>
            	<td>Enabled</td> 
             		<td>
              			<select name="tg_isis_footer_footer_info_enabled">
                			<option value="1"<?php if($tg_isis_footer_footer_info_enabled == '1') echo ' selected="selected"';?>>Yes</option>
                			<option value="0"<?php if($tg_isis_footer_footer_info_enabled != '1') echo ' selected="selected"';?>>No</option>
   			  			</select>
   			 		</td>
      		</tr>
			
			
   	
   	
   	<?php foreach ($languages as $language) { ?>
		<tr> 
			<td><?php echo $text_info_title; ?></td> 
	  			<td> 
	    			<input type="text" name="mymodule_title<?php echo $language['language_id']; ?>" id="mymodule_title<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'mymodule_title' . $language['language_id']}; ?>" />
	   				 <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
     	  		</td>
		</tr>
	<?php } ?> 
	
	
	<?php foreach ($languages as $language) { ?> 
        <tr>
		  <td><?php echo $entry_code; ?></td>
          <td><textarea name="mymodule_code<?php echo $language['language_id']; ?>" cols="40" rows="10"><?php echo isset(${'mymodule_code' . $language['language_id']}) ? ${'mymodule_code' . $language['language_id']} : ''; ?></textarea>
		  <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
          </td>
        </tr>
	<?php } ?>
 </table>
</div> <!-- tab_info (end) -->



<div id="tab_contact">
   <table class="form">
  	  <tr>
         <td>Enabled</td> 
            <td>
            	<select name="tg_isis_footer_footer_contacts_enabled">
                	<option value="1"<?php if($tg_isis_footer_footer_contacts_enabled == '1') echo ' selected="selected"';?>>Yes</option>
                	<option value="0"<?php if($tg_isis_footer_footer_contacts_enabled != '1') echo ' selected="selected"';?>>No</option>
   			  	</select>
   			</td>
      </tr>
   
   		<?php foreach ($languages as $language) { ?>
		 <tr> 
			<td><?php echo $text_info_title; ?></td> 
	  		<td> 
	    		<input type="text" name="mymodule_title2<?php echo $language['language_id']; ?>" id="mymodule_title2<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'mymodule_title2' . $language['language_id']}; ?>" />
	    		<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
     	  	</td>
	
		 </tr>
		<?php } ?> 
   
   
   
	      <tr>
            <td>Static Phone</td>
            <td><input type="text" name="tg_isis_footer_phone" value="<?php echo $tg_isis_footer_phone; ?>" size="30" />
         	<input type="checkbox" value="1" name="tg_isis_footer_phone_show"<?php if($tg_isis_footer_phone_show == '1') echo ' checked="checked"';?> /> Show</td>
          </tr>
          
          <tr>
            <td>Mobile Phone</td>
            <td><input type="text" name="tg_isis_footer_mobile" value="<?php echo $tg_isis_footer_mobile; ?>" size="30" />
            <input type="checkbox" value="1" name="tg_isis_footer_mobile_show"<?php if($tg_isis_footer_mobile_show == '1') echo ' checked="checked"';?> /> Show</td>
          </tr>    
          
          <tr>
            <td>Email</td>
            <td><input type="text" name="tg_isis_footer_email" value="<?php echo $tg_isis_footer_email; ?>" size="30" />
            <input type="checkbox" value="1" name="tg_isis_footer_email_show"<?php if($tg_isis_footer_email_show == '1') echo ' checked="checked"';?> /> Show</td>
          </tr>   
        
          <tr>
            <td>Skype</td>
            <td><input type="text" name="tg_isis_footer_skype" value="<?php echo $tg_isis_footer_skype; ?>" size="30" />
            <input type="checkbox" value="1" name="tg_isis_footer_skype_show"<?php if($tg_isis_footer_skype_show == '1') echo ' checked="checked"';?> /> Show</td>
          </tr>   
        
          <tr>
            <td>Address</td>
            <td><input type="text" name="tg_isis_footer_address" value="<?php echo $tg_isis_footer_address; ?>" size="30" />
            <input type="checkbox" value="1" name="tg_isis_footer_address_show"<?php if($tg_isis_footer_address_show == '1') echo ' checked="checked"';?> /> Show</td>
          </tr>   
		  
		  
		
         
  </table>
</div> <!-- tab-contact (end) -->


<div id="tab-twitter">
  <table class="form">
  	<tr>
    	<td>Enabled</td> 
            <td>
              	<select name="tg_isis_footer_footer_twitter_enabled">
                	<option value="1"<?php if($tg_isis_footer_footer_twitter_enabled == '1') echo ' selected="selected"';?>>Yes</option>
                	<option value="0"<?php if($tg_isis_footer_footer_twitter_enabled != '1') echo ' selected="selected"';?>>No</option>
   			  	</select>
   			</td>
    </tr>
   
          		   
            <?php foreach ($languages as $language) { ?>
			<tr> 
				<td><?php echo $text_info_title; ?></td> 
	  			<td> 
	    			<input type="text" name="mymodule_title3<?php echo $language['language_id']; ?>" id="mymodule_title3<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'mymodule_title3' . $language['language_id']}; ?>" />
	    			<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
     	  		</td>
	
			</tr>
			<?php } ?> 
			<tr>
			    <td> Tweets number: </td>
				<td><select name="tg_isis_footer_tweets">
          		<?php if (isset($tg_isis_footer_tweets)) { $selected = "selected"; ?>
              		<option value="1" <?php if($tg_isis_footer_tweets=='1'){echo $selected;} ?>>1</option>
              		<option value="2" <?php if($tg_isis_footer_tweets=='2'){echo $selected;} ?>>2</option>
              		<option value="3" <?php if($tg_isis_footer_tweets=='3'){echo $selected;} ?>>3</option>
        		<?php } else { ?>
              		<option selected="selected"></option>
             		 <option value="1">1</option>
             		 <option value="2">2</option>
             		 <option value="3">3</option>
              	<?php } ?>
            	</select></td>
        	</tr>
        	
			<tr>
          		<td>Username:</td>
          		<td><input type="text" name="tg_isis_footer_twitter_username" value="<?php echo $tg_isis_footer_twitter_username; ?>" size="30" /></td>
        	</tr>

  </table>
</div> 


<div id="tab-default">
  <table class="form">
  	<tr>
    	<td>Enabled</td> 
            <td>
              	<select name="tg_isis_footer_footer_facebookfp_enabled">
                	<option value="1"<?php if($tg_isis_footer_footer_facebookfp_enabled == '1') echo ' selected="selected"';?>>Yes</option>
                	<option value="0"<?php if($tg_isis_footer_footer_facebookfp_enabled != '1') echo ' selected="selected"';?>>No</option>
   			  	</select>
   			</td>
    </tr>
   			
          		   
            <?php foreach ($languages as $language) { ?>
			<tr> 
				<td><?php echo $text_info_title; ?></td> 
	  			<td> 
	    			<input type="text" name="mymodule_title4<?php echo $language['language_id']; ?>" id="mymodule_title4<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'mymodule_title4' . $language['language_id']}; ?>" />
	    			<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
     	  		</td>
	
			</tr>
			<?php } ?> 
			
			<tr>
          		<td>ID:</td>
          		<td><input type="text" name="tg_isis_footer_facebook_id" value="<?php echo $tg_isis_footer_facebook_id; ?>" size="30" /></td>
        	</tr>
			
        	
		
  </table>
</div> 

</form> <!-- form action (end) -->
</div> <!-- content (end) -->
</div> <!-- box (end) -->


<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('mymodule_code<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script> 
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