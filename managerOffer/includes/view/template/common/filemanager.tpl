<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="view/javascript/jquery/ui/external/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jstree/jquery.tree.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jstree/lib/jquery.cookie.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jstree/plugins/jquery.tree.cookie.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ajaxupload.js"></script>
<script type="text/javascript" src="view/javascript/jquery/imagemanager/swfupload/swfupload.js"></script>
<script type="text/javascript" src="view/javascript/jquery/imagemanager/swfupload/jquery.swfupload.js"></script>
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
#container {
	padding: 0px 10px 7px 10px;
	height: 340px;
}
#menu {
	clear: both;
	height: 29px;
	margin-bottom: 3px;
}
#column-left {
	background: #FFF;
	border: 1px solid #CCC;
	float: left;
	width: 20%;
	height: 320px;
	overflow: auto;
}
#column-right {
	background: #FFF;
	border: 1px solid #CCC;
	float: right;
	width: 78%;
	height: 320px;
	overflow: auto;
	text-align: center;
}
#column-right div {
	text-align: left;
	padding: 5px;
}
#column-right a {
	display: inline-block;
	text-align: center;
	border: 1px solid #EEEEEE;
	cursor: pointer;
	margin: 5px;
	padding: 5px;
}
#column-right a.selected {
	border: 1px solid #7DA2CE;
	background: #EBF4FD;
}
#column-right input {
	display: none;
}
#dialog {
	display: none;
}
.button {
	display: block;
	float: left;
	padding: 8px 5px 8px 25px;
	margin-right: 5px;
	background-position: 5px 6px;
	background-repeat: no-repeat;
	cursor: pointer;
}
.button:hover {
	background-color: #EEEEEE;
}
.thumb {
	padding: 5px;
	width: 105px;
	height: 105px;
	background: #F7F7F7;
	border: 1px solid #CCCCCC;
	cursor: pointer;
	cursor: move;
	position: relative;
}
#cropwindow {margin:0; padding:0; left:0; top:0; position:absolute; border:0; width:100%; height:100%;}
.crop{cursor: pointer; margin:0; background:url(view/image/filemanager/edit-cut.png); height:16px; width:16px;}
#swfupload-control {height:352px;}
#swfupload-control .swfupload{cursor: pointer;}
#swfupload-control .status-container{font-size:0pt; background:url(view/javascript/jquery/imagemanager/swfupload/bg.png) repeat scroll 0 0 #FFF; margin: 0 0 0 170px; position: absolute; width: 610px; filter:alpha(opacity=80); -moz-opacity:0.8;	-khtml-opacity: 0.8; opacity: 0.8;}
#upload-status li{height:25px; line-height:25px; font-size:11px;}
#upload-status span.error{color:red;}
#upload-status span.close{background:url(view/image/delete.png); float:right; margin:5px 20px 0 0; height:16px; width:16px; cursor:pointer;}
#search-container{position:absolute; margin:2px 0 0 550px;  background-color: #FFFFFF; border: 1px solid #CCCCCC; border-radius: 5px 5px 5px 5px;    height: 23px; line-height: 24px; width: 160px;}
#search-keyword{background-color: #FFFFFF; border: medium none; padding:0; margin:0;  position: absolute; top:3px;}
#search-submit{background-color: #FFFFFF; border: medium none; padding-top:3px; position: absolute; right:3px; top:0;}
</style>
</head>
<body>
<div id="container">
  <div id="menu"><a id="create" class="button" style="background-image: url('view/image/filemanager/folder.png');"><?php echo $button_folder; ?></a><a id="delete" class="button" style="background-image: url('view/image/filemanager/edit-delete.png');"><?php echo $button_delete; ?></a><a id="move" class="button" style="background-image: url('view/image/filemanager/edit-move.png');"><?php echo $button_move; ?></a><a id="copy" class="button" style="background-image: url('view/image/filemanager/edit-copy.png');"><?php echo $button_copy; ?></a><a id="rename" class="button" style="background-image: url('view/image/filemanager/edit-rename.png');"><?php echo $button_rename; ?></a><a id="upload" class="button" style="background-image: url('view/image/filemanager/upload.png'); display:none;"><?php echo $button_upload; ?></a><a id="refresh" class="button" style="background-image: url('view/image/filemanager/refresh.png');"><?php echo $button_refresh; ?></a>
  <div id="search-container"><input id="search-keyword" type="text" /><input id="search-submit" type="image" src="view/image/filemanager/search-submit.png" /></div>
  <div id="swfupload-control"><input type="button"  id="button" /><div class="status-container"><ol id="upload-status"></ol></div></div>
  </div>
  <div id="column-left"></div>
  <div id="column-right"></div>
  <iframe id="cropwindow" frameborder="no" scrolling="auto" style="display:none; position:absolute; "></iframe>
</div>
<script type="text/javascript"><!--
$(document).ready(function() { 
	$('#column-left').tree({
		plugins : {
			cookie : {}
		},
		data: { 
			type: 'json',
			async: true, 
			opts: { 
				method: 'post', 
				url: 'index.php?route=common/filemanager/directory&token=<?php echo $token; ?>'
			} 
		},
		selected: 'top',
		ui: {		
			theme_name: 'classic',
			animation: 700
		},	
		types: { 
			'default': {
				clickable: true,
				creatable: false,
				renameable: false,
				deletable: false,
				draggable: false,
				max_children: -1,
				max_depth: -1,
				valid_children: 'all'
			}
		},
		callback: {
			beforedata: function(NODE, TREE_OBJ) { 
				if (NODE == false) {
					TREE_OBJ.settings.data.opts.static = [ 
						{
							data: 'image',
							attributes: { 
								'id': 'top',
								'directory': ''
							}, 
							state: 'closed'
						}
					];
					
					return { 'directory': '' } 
				} else {
					TREE_OBJ.settings.data.opts.static = false;  
					
					return { 'directory': $(NODE).attr('directory') } 
				}
			},
			onopen: function(TREE_OBJ) {
				var tr = $('#column-left li#top li[directory]');
				
				tr.each(function(index, domEle) {
				dd = $(domEle).attr('directory');
				dd = dd.replace(/\//g, ""); 
				dd = dd.replace(/\s/g, ""); 
				$(domEle).attr('id', dd);
				});
				
				var myTree = $.tree.reference('#column-left');
				var cc = $.cookie('selected');
				var bb = '#' + cc;
				myTree.select_branch(bb);
				
			},
			onselect: function (NODE, TREE_OBJ) {
				$.ajax({
					url: 'index.php?route=common/filemanager/files&token=<?php echo $token; ?>',
					type: 'post',
					data: 'directory=' + encodeURIComponent($(NODE).attr('directory')),
					dataType: 'json',
					success: function(json) {
						html = '<div>';
						
						if (json) {
							for (i = 0; i < json.length; i++) {
								name = '';
								
								filename = json[i]['filename'];
								
								for (j = 0; j < filename.length; j = j + 15) {
									name += filename.substr(j, 15) + '<br />';
								}
								
								name += json[i]['size'];
								
								//html += '<a>' + name + '<input type="hidden" name="image" value="' + json[i]['file'] + '" /></a>';
								html += '<a file="' + json[i]['file'] + '"><img src="' + json[i]['thumb'] + '" title="' + json[i]['filename'] + '" /><br />' + name + '</a>';
							}
						}
						
						html += '</div>';
						
						$('#column-right').html(html);
						/*
						$('#column-right a').each(function(index, element) {
							$.ajax({
								url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent('data/' + $(element).find('input[name=\'image\']').attr('value')),
								dataType: 'html',
								success: function(html) {
									$(element).prepend('<img src="' + html + '" title="" style="display: none;" /><br />');
									
									$(element).find('img').fadeIn();
								}
							});
						});*/
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		}
	});	
	
	$('#search-keyword').keyup(function(e){
		if (e.keyCode != 13){
			var key = $('#search-keyword').val().trim();
			if (key != ''){
				$('#column-right a').each(function(){
					if ($(this).attr("file").indexOf(key) >= 0){
						$(this).show();
					}else{
						$(this).hide();
					}
				});
			}else{
				$('#column-right a').each(function(){
					$(this).show();
				});
			}
		}else{
			$('#search-submit').click();
		}
	});
		
	$('#search-submit').live('click',function(){
		var tree = $.tree.focused();
		if (tree.selected){
			if ($('#search-keyword').val() != ''){
				$.ajax({
					url: 'index.php?route=common/filemanager/search&token=<?php echo $token; ?>',
					type: 'POST',
					data: 'directory=' + encodeURIComponent($(tree.selected).attr('directory')) + '&keyword=' + encodeURIComponent($('#search-keyword').val()),
					dataType: 'json',
					beforeSend: function(){$('#column-right').html('loading...');},
					success: function(json) {
						html = '<div>';
						
						if (json) {
							for (i = 0; i < json.length; i++) {
								
								name = '';
								
								filename = json[i]['filename'];
								
								for (j = 0; j < filename.length; j = j + 15) {
									name += filename.substr(j, 15) + '<br />';
								}
								
								name += json[i]['size'];
								
								html += '<a file="' + json[i]['file'] + '"><img src="' + json[i]['thumb'] + '" title="' + json[i]['filename'] + '" /><br />' + name + '</a>';
							}
						}
						
						html += '</div>';
												
						$('#column-right').html(html);
					}
				});
			}else{
				tree.select_branch(tree.selected);
			}
		}
	});
	
	$('#column-right a').live('click', function() {
		if ($(this).attr('class') == 'selected') {
			$(this).removeAttr('class');
			$(this).children('.crop').remove();
		} else {
			//$('#column-right a').removeAttr('class');
			$(this).attr('class', 'selected');
			$(this).prepend('<p title="edit image" class="crop"></p>');
		}
	});
	
	$('#column-right p.crop').live('click', function(){
		$('#cropwindow').attr('src', 'index.php?route=common/cropimage&token=<?php echo $token; ?>&name=' + encodeURIComponent($(this).parent().attr('file')));
		$('#cropwindow').show();
		return false;
	});
	
	$('#column-right a').live('dblclick', function() {
		<?php if ($fckeditor) { ?>
		window.opener.CKEDITOR.tools.callFunction(<?php echo $fckeditor; ?>, '<?php echo $directory; ?>' + $(this).attr('file'));//$(this).find('input[name=\'image\']').attr('value'));
		
		self.close();	
		<?php } else { ?>
		parent.$('#<?php echo $field; ?>').attr('value', 'data/' + $(this).attr('file'));//$(this).find('input[name=\'image\']').attr('value'));
		parent.$('#dialog').dialog('close');
		
		parent.$('#dialog').remove();	
		<?php } ?>
	});		
						
	$('#create').bind('click', function() {
		var tree = $.tree.focused();
		
		if (tree.selected) {
			$('#dialog').remove();
			
			html  = '<div id="dialog">';
			html += '<?php echo $entry_folder; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
			html += '</div>';
			
			$('#column-right').prepend(html);
			
			$('#dialog').dialog({
				title: '<?php echo $button_folder; ?>',
				resizable: false
			});	
			
			$('#dialog input[type=\'button\']').bind('click', function() {
				$.ajax({
					url: 'index.php?route=common/filemanager/create&token=<?php echo $token; ?>',
					type: 'post',
					data: 'directory=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.refresh(tree.selected);
							
							alert(json.success);
						} else {
							alert(json.error);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			});
		} else {
			alert('<?php echo $error_directory; ?>');	
		}
	});
	
	$('#delete').bind('click', function () {
		$('#dialog').remove();
			
		html  = '<div id="dialog">';
		html += '<p><?php echo $text_confirm_delete; ?></p><div style="margin:5px auto; width:150px;"><input type="button" class="confirm" value="Confirm" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="cancel" value="Cancel" /></div>';
		html += '</div>';
		
		$('#column-right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_delete; ?>',
			resizable: false
		});	
		
		$('#dialog .cancel').bind('click', function(){
			$('#dialog').remove();
		});
		
		$('#dialog .confirm').bind('click', function(){
			path = $('#column-right a.selected').attr('file');
			if (path) {
				$('#column-right>div>a.selected').each(function(data){
					path = $(this).attr('file');
					$.ajax({
						url: 'index.php?route=common/filemanager/delete&token=<?php echo $token; ?>',
						type: 'POST',
						data: 'path=' + path,
						dataType: 'json',
						success: function(json) {
							if (json.success) {
								var tree = $.tree.focused();
								tree.select_branch(tree.selected);
								//alert(json.success);
							}
							
							if (json.error) {
								alert(json.error);
							}
						}
					});	
				});		
			} else {
				var tree = $.tree.focused();
				
				if (tree.selected) {
					$.ajax({
						url: 'index.php?route=common/filemanager/delete&token=<?php echo $token; ?>',
						type: 'POST',
						data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')),
						dataType: 'json',
						success: function(json) {
							if (json.success) {
								tree.select_branch(tree.parent(tree.selected));
								tree.refresh(tree.selected);
								//alert(json.success);
							} 
							
							if (json.error) {
								alert(json.error);
							}
						}
					});			
				} else {
					alert('<?php echo $error_select; ?>');
				}			
			}
			$('#dialog').remove();
		});
	});
	
	$('#move').bind('click', function () {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_move; ?> <select name="to"></select> <input type="button" value="Submit" />';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_move; ?>',
			resizable: false
		});

		$('#dialog select[name=\'to\']').load('index.php?route=common/filemanager/folders&token=<?php echo $token; ?>');
		//fixed width under IE9 2012/05/04
		if ($('#dialog select[name=\'to\']').width() < 140)
			$('#dialog select[name=\'to\']').width(140);
		
		$('#dialog input[type=\'button\']').bind('click', function () {
			//path = $('#column-right a.selected').attr('file');
			$('#column-right>div>a.selected').each(function(data){
				path = $(this).attr('file');
				if (path) {					
					$.ajax({
						url: 'index.php?route=common/filemanager/move&token=<?php echo $token; ?>',
						type: 'POST',
						data: 'from=' + encodeURIComponent(path) + '&to=' + encodeURIComponent($('#dialog select[name=\'to\']').val()),
						dataType: 'json',
						success: function(json) {
							if (json.success) {
								$('#dialog').remove();
								
								var tree = $.tree.focused();
								
								tree.select_branch(tree.selected);
								
								alert(json.success);
							}
							
							if (json.error) {
								alert(json.error);
							}
						}
					});
				} else {
					var tree = $.tree.focused();
					
					$.ajax({
						url: 'index.php?route=common/filemanager/move&token=<?php echo $token; ?>',
						type: 'POST',
						data: 'from=' + encodeURIComponent($(tree.selected).attr('directory')) + '&to=' + encodeURIComponent($('#dialog select[name=\'to\']').val()),
						dataType: 'json',
						success: function(json) {
							if (json.success) {
								$('#dialog').remove();
								
								tree.select_branch('#top');
									
								tree.refresh(tree.selected);
								
								alert(json.success);
							}						
							
							if (json.error) {
								alert(json.error);
							}
						}
					});				
				}
			});
		});
	});

	$('#copy').bind('click', function() {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_copy; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_copy; ?>',
			resizable: false
		});
		
		$('#dialog select[name=\'to\']').load('index.php?route=common/filemanager/folders&token=<?php echo $token; ?>');
		
		$('#dialog input[type=\'button\']').bind('click', function() {
			//path = $('#column-right a.selected').find('input[name=\'image\']').attr('value');
			path = $('#column-right a.selected').attr('file');			 
			if (path) {																
				$.ajax({
					url: 'index.php?route=common/filemanager/copy&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
							
							tree.select_branch(tree.selected);
							
							alert(json.success);
						}						
						
						if (json.error) {
							alert(json.error);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			} else {
				var tree = $.tree.focused();
				
				$.ajax({
					url: 'index.php?route=common/filemanager/copy&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.select_branch(tree.parent(tree.selected));
							
							tree.refresh(tree.selected);
							
							alert(json.success);
						} 						
						
						if (json.error) {
							alert(json.error);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});				
			}
		});	
	});
	
	$('#rename').bind('click', function() {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_rename; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_rename; ?>',
			resizable: false
		});
		
		$('#dialog input[type=\'button\']').bind('click', function() {
			//path = $('#column-right a.selected').find('input[name=\'image\']').attr('value');
			path = $('#column-right a.selected').attr('file');			 
			if (path) {		
				$.ajax({
					url: 'index.php?route=common/filemanager/rename&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
					
							tree.select_branch(tree.selected);
							
							alert(json.success);
						} 
						
						if (json.error) {
							alert(json.error);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});			
			} else {
				var tree = $.tree.focused();
				
				$.ajax({ 
					url: 'index.php?route=common/filemanager/rename&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
								
							tree.select_branch(tree.parent(tree.selected));
							
							tree.refresh(tree.selected);
							
							alert(json.success);
						} 
						
						if (json.error) {
							alert(json.error);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		});		
	});
	
	new AjaxUpload('#upload', {
		action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
		name: 'image',
		autoSubmit: false,
		responseType: 'json',
		onChange: function(file, extension) {
			var tree = $.tree.focused();
			
			if (tree.selected) {
				this.setData({'directory': $(tree.selected).attr('directory')});
			} else {
				this.setData({'directory': ''});
			}
			
			this.submit();
		},
		onSubmit: function(file, extension) {
			$('#upload').append('<img src="view/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		},
		onComplete: function(file, json) {
			if (json.success) {
				var tree = $.tree.focused();
					
				tree.select_branch(tree.selected);
				
				alert(json.success);
			}
			
			if (json.error) {
				alert(json.error);
			}
			
			$('.loading').remove();	
		}
	});
	
	$('#refresh').bind('click', function() {
		var tree = $.tree.focused();
		
		tree.refresh(tree.selected);
	});	
});


function force_refresh(){
	var tree = $.tree.focused();
	tree.select_branch(tree.selected);
	tree.refresh(tree.selected);
};

	
$(function(){
	$('#swfupload-control').swfupload({
		upload_url: "view/javascript/jquery/imagemanager/swfupload/multiupload.php?token=<?php echo $token; ?>&PHPSESSID=<?php echo $PHPSESSID;?>",
		file_size_limit : "3000KB",
		file_types : "*.jpg;*.jpeg;*.png;*.gif",
		file_types_description : "Image Files",
		file_upload_limit : 50,
		file_queue_limit : 0,
		flash_url : "view/javascript/jquery/imagemanager/swfupload/swfupload.swf",
		flash9_url : "view/javascript/jquery/imagemanager/swfupload/swfupload_fp9.swf",
		button_image_url : 'view/javascript/jquery/imagemanager/swfupload/multiupload_69x29.png',
		button_width : 69,
		button_height : 29,
		button_placeholder : $('#button')[0],
		button_cursor: SWFUpload.CURSOR.HAND,
		debug: false,
		post_params : {
			token : "<?php echo $token;?>",
			PHPSESSID:"<?php echo $PHPSESSID;?>"
		}
	})
		.bind('swfuploadLoaded', function(event){
			//$('#upload-status').append('<li>Loaded</li>');
		})
		.bind('fileQueued', function(event, file){
			swfu = $.swfupload.getInstance('#swfupload-control');
			var tree = $.tree.focused();
			swfu.setPostParams({'directory':$(tree.selected).attr('directory'), 'token':'<?php echo $token;?>', 'PHPSESSID':'<?php echo $PHPSESSID;?>'});
			var item='<li id="'+file.id+'" >'+
						'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB)' + 
						'<span class="progress" ></span>'+
						'<span class="status" >Pending</span>'+
						'</li>';
			$('#upload-status').append(item);
			// start the upload since it's queued
			$(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			var item='<li id="'+file.id+'" >'+
						'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB)' + 
						'<span class="progress" ></span>'+
						'<span class="status error" >Error:' + message + '</span>' +
						'<span class="close" id="close' + file.id + '">&nbsp;</span>' +
						'</li>';
			$('#upload-status').append(item);
			$('#close' + file.id).bind('click', function(){$('#upload-status li#'+file.id).slideUp('slow');});
		})
		.bind('fileDialogStart', function(event){
			//$('#upload-status').append('<li>File dialog start</li>');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			//$('#upload-status').append('<li>File dialog complete</li>');
		})
		.bind('uploadStart', function(event, file){
			$('#upload-status li#'+file.id).find('span.progress').text('0%');
			$('#upload-status li#'+file.id).find('span.status').text('Uploading...');
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			var percentage=Math.round((bytesLoaded/file.size)*100);
			$('#upload-status li#'+file.id).find('span.progress').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			$('#upload-status li#'+file.id).find('span.progres').text('100%');
			$('#upload-status li#'+file.id).find('span.status').text('Success' + serverData);
		})
		.bind('uploadComplete', function(event, file){
			var tree = $.tree.focused();
			tree.select_branch(tree.selected);
			setTimeout(function(){$('#upload-status li#'+file.id).slideUp('slow')}, 3000);
			//upload has completed, lets try the next one in the queue
			$(this).swfupload('startUpload');
		})
		.bind('uploadError', function(event, file, errorCode, message){
			var item='File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB)' + 
						'<span class="progress" ></span>'+
						'<span class="status error" >Error:' + message + '</span>' +
						'<span class="close" id="close' + file.id + '">&nbsp;</span>';
			$('#upload-status li#'+file.id).html(item);
			$('#close' + file.id).bind('click', function(){$('#upload-status li#'+file.id).slideUp('slow');});
		});
		
});	
//--></script>
</body>
</html>