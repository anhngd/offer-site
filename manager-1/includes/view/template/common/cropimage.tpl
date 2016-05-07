<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<title></title>
<base href="<?php echo $base; ?>" />
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/imagemanager/jcrop/jquery.Jcrop.css" />
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/imagemanager/jcrop/jquery.Jcrop.min.js"></script>
<style type="text/css">
body {
	padding: 0;
	margin: 0;
	background: #F7F7F7;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
img {
	border: 0;
}
.error {color:red;}
</style>
<script type="text/javascript"><!--
$(document).ready(function () {
	var obj_jcrop, boundx, boundy;
	$('#target').Jcrop({
		trueSize: [<?php echo $width;?>,<?php echo $height;?>],
		onChange: showCoords,
		onSelect: showCoords
	}, function(){
		// Use the API to get the real image size
        var bounds = this.getBounds();
        boundx = bounds[0];
        boundy = bounds[1];
		obj_jcrop = this;
	});

	$('#crop_info input').blur(function(){
		var x1 = parseInt($('#x1').val());
		var y1 = parseInt($('#y1').val());
		var h = parseInt($('#h').val());
		var w = parseInt($('#w').val());
		obj_jcrop.animateTo([x1, y1, w + x1, h + y1]);
		return false;
	});
	
	function showCoords(c)
	{
		$('#x1').val(c.x);
		$('#y1').val(c.y);
		$('#x2').val(c.x2);
		$('#y2').val(c.y2);
		$('#w').val(c.w);
		$('#h').val(c.h);
		
		if (parseInt(c.w) > 0)
		{
		  var rx = <?php echo $rate;?>;
		  var ry = <?php echo $rate;?>;
		  $('#priview-container').css({width: Math.round(rx * c.w) + 'px', height: Math.round(ry * c.h) + 'px'});
		  $('#preview').css({
			width: Math.round(rx * boundx) + 'px',
			height: Math.round(ry * boundy) + 'px',
			marginLeft: '-' + Math.round(rx * c.x) + 'px',
			marginTop: '-' + Math.round(ry * c.y) + 'px'
		  });
		}
	};
	$('#cancel').click(function(){$('#cropwindow', parent.document.body).hide();$('#cropwindow', parent.document.body).contents().find('#container').html('');});
	$('#submit').click(function(){
		if ($('#w').val() == 0 || $('#w').val() == 'NaN' || $('#h').val() == 0 || $('#h').val() == 'NaN'){
			alert('<?php echo $select_size_error;?>');
			return;
		}
		if ($('#savename').val().trim().length < 3){
			alert('<?php echo $filename_error;?>');
			return;
		}
		var c_width = $('#w').val();
		var c_height = $('#h').val();
		var c_x1 = $('#x1').val();
		var c_y1 = $('#y1').val();
		var c_x2 = $('#x2').val();
		var c_y2 = $('#y2').val();
		var c_name = $('#savename').val();
		var c_image = $('#target').attr('title');
		$.ajax({ 
			url: 'index.php?route=common/cropimage/cropimage&token=<?php echo $token; ?>',
			type: 'POST',
			data: 'width=' + c_width + '&height=' + c_height + '&x1=' + c_x1 + '&y1=' + c_y1 + '&x2=' + c_x2 + '&y2=' + c_y2 + '&name=' + c_name + '&image=' + c_image,
			dataType: 'json',
			beforeSend:function(XMLHttpRequest){
				$('#loading').show();
            },
			complete:function(XMLHttpRequest,textStatus){
				$('#loading').hide();
			},
			success: function(json) {
				if (json.error) {
					alert(json.error);
				}else{
					window.parent.force_refresh();
					$('#cropwindow', parent.document.body).hide(); $('#cropwindow', parent.document.body).contents().find('#container').html('');
				}
			}
		});
	});
});


//-->
</script>
</head>
<body>
<div id="container">
<?php if (isset($error)){?>
	<div class="error"><?php echo $error;?></div>
<?php }else{?>
	<div style="float:left; margin:10px;"><img id="target" title="<?php echo $imagename;?>" src="<?php echo $image;?>" width="<?php echo $fixwidth; ?>" height="<?php echo $fixheight;?>"/></div>
	<div style="float:left; min-height:300px; margin:10px;">
		<div id="priview-container" style="overflow:hidden;">
			<img src="<?php echo $image;?>" width="0" height="0" id="preview" alt="Preview">
		</div>
		<br/>
		<div id="crop_info">
			<label style="display:none;">X1 <input type="text" size="4" id="x1" name="x1" /></label>
			<label style="display:none;">Y1 <input type="text" size="4" id="y1" name="y1" /></label>
			<label style="display:none;">X2 <input type="text" size="4" id="x2" name="x2" /></label>
			<label style="display:none;">Y2 <input type="text" size="4" id="y2" name="y2" /></label>
			<label>Width: <input type="text" size="4" id="w" name="w" /></label>
			<label>Height: <input type="text" size="4" id="h" name="h" /></label>
		</div>
		<br/>
		<div id="save_info">
			<label>Save as: </label>
			<input type="text" size="20" id="savename" name="savename" value="<?php echo $save_as_name;?>" />
		</div>
	</div>
	<div style="float:right; position:absolute; bottom:30px; right:30px;">
		<div>
			<img id="loading" src="view/javascript/jquery/imagemanager/jcrop/loading.gif" style="display:none;margin-right:10px;"><input type="button" id="submit" value="Submit" />&nbsp;&nbsp;<input type="button" id="cancel" value="Cancel">
		</div>
	</div>
<?php }?>
</div>
</body>
</html>