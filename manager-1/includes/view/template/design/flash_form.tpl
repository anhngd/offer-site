<?php echo $header; ?>
<style>
	.hidden{
		display:none;
	}
</style>
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
      <h1><img src="view/image/flash.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_name; ?></td>
            <td><input type="text" name="name" value="<?php echo $name; ?>" size="100" />
              <?php if ($error_name) { ?>
              <span class="error"><?php echo $error_name; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="status">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
		 <tr>
		  <td><?php echo $entry_flash;?></td>
		  <td valign="left">
					<input type="hidden" name="file_name" value="<?php echo $file_name; ?>" id="file_name" />
					<a class="button" id="flash_file"><span id="txt_upload"><?php echo $text_upload;?></span></a>
					<span id="txt_file_name"><?php echo $file_name; ?></span>
					<span id="button_delete">
					<a class="button"  onclick="delete_file('<?php echo $file_name; ?>','<?php echo $flash_id;?>');"><span ><?php echo $text_delete;?></span></a><br>
					</span>
				</td>
				
				 
				</tr>
        </table>
       
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		if($('#file_name').val() == ""){
			$('#button_delete').addClass('hidden');
		}
	});
</script>
<script type="text/javascript" src="view/javascript/jquery/ajaxupload.js"></script>
<script type="text/javascript">
	$(function (){
		var interval;
		new AjaxUpload($('#flash_file'),{
			action 		:'index.php?route=design/flash/upload&token=<?php echo $token; ?>',
			name		:'flash_file',
			autoSubmit	:true,
			responseType:'json',
			onSubmit  	:function (file, ext){
							$('#txt_upload').text('Uploading');
							this.disable();
							interval = window.setInterval(function (){
								if($('#txt_upload').text().length  <15 ){
									$('#txt_upload').text($('#txt_upload').text()+ '.');
								}else{
									$('#txt_upload').text('Uploading');
								}
							}, 200);
						},
			onComplete	:function (file, response){
						if(response.success){
							$('#txt_file_name').text(response.flash_name);
							$('#file_name').val(response.flash_name);
							$('#button_delete').removeClass('hidden');
						}
						if(response.error){
							alert(response.error);
						}
						$('#txt_upload').text('Upload');
						window.clearInterval(interval);
						this.enable();
			}
			
		});
	});
</script>
<script type="text/javascript"><!--
function delete_file(file_name,flash_id){
	var cuccuc=confirm('Do you want delete this flash?');
	if(cuccuc){
		$.ajax({
			type:"GET",
			data:{file_name:file_name,flash_id:flash_id},
			url:"index.php?route=design/flash/deletefile&token=<?php echo $token; ?>",
			success:function(){
				$('#txt_file_name').remove();
				<?php $file_name="";?>
				$('#file_name').remove();
				 html  = '<span id="txt_file_name"><?php echo $file_name; ?></span>';
				 html += '<input type="hidden" name="file_name" value="<?php echo $file_name; ?>" id="file_name" />';
				 $('#flash_file').after(html);	
				 $('#button_delete').addClass('hidden');
			},
			error:function (){
				alert('Error...');
			}
		});
	}
}
//--></script>
<?php echo $footer; ?>