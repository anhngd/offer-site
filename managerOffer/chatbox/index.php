<?php 
define('CHIP_ROOT',true);
include './chatbox/inc/config.php';
include './chatbox/inc/functions.php';

?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="./chatbox/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="./chatbox/js/function.js"></script>
<script type="text/javascript">

function ajax_load(url,id){

	var ajax = new AJAX_Handler();
	ajax.onreadystatechange(change_);
	ajax.send(url);		
	function change_(){
		if(ajax.handler.readyState == 4 && ajax.handler.status == 200)
			document.getElementById(id).innerHTML = ajax.handler.responseText;
	}
}
function _load(value){
	if(value == 'content_chat'){
		ajax_load('./chatbox/content.php','content_chat');
		var objDiv = document.getElementById("mainchat");
		objDiv.scrollTop = objDiv.scrollHeight;
	}
	else if(value == 'online')
		ajax_load('./chatbox/online.php','userlist');	
}

function _refresh(value){
	if(value == 'content_chat')
		setTimeout("_load('content_chat');_refresh('content_chat');", <?php echo $config['refresh_content']?>000);	
	else if(value == 'online')	
		setTimeout("_load('online');_refresh('online');", <?php echo $config['refresh_online']?>000);
	
}
var objDiv = document.getElementById("mainchat");
objDiv.scrollTop = objDiv.scrollHeight;

$('#content_chat').each(function () {
    $(this).scrollTop($(this)[0].scrollHeight);
});
alert('@@');
</script>
</head>

<body>
<?php 
if(isset($_GET['param']))
{
	$param=$_GET['param'];
}
else
{
	$param="";
}
switch($param):
	case 'smilies': include 'smilies.php'; break;
	case 'sign': include 'sign.php'; break;
	case 'logout': session_destroy(); print_cp_mess('./','',0);break;
	default:
?>
<div class="box blue span3" ontablet="span6" ondesktop="span3">
	<div class="box-header">
		<h2><i class="halflings-icon list"></i><span class="break"></span>MAIN CHAT</h2>
		<div class="box-icon">
			<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
		</div>
	</div>
	<div class="box-content">
	<div id="mainchat" class="box span12 noMargin" ontablet="span6">
		<div id="content_chat">
				Loading...
		</div><!--/#main-->
	</div>
			<div class="row-fluid" id="shoutform" >
			<div id="upwrite">
				<form name="chatform" method="post" id="chatbox_form" action="javascript:check_form();">
					<div id="upstyle_chat" style="visibility:hidden;width:0px;height:0px">
						<input id="upb" onclick="upstyle_chat('b')" type="button" class="btn btnChat" style="font-weight:bold" value="B" />
						<input id="upi" onclick="upstyle_chat('i')" type="button" class="btn btnChat" style="font-style:italic" value="I" />
						<input id="upu" onclick="upstyle_chat('u')" type="button" class="btn btnChat" style="text-transform:uppercase" value="U" />
						<select id="upfont" class="select_chat">
							<option value="">Default</option>
							<option value="Arial" style="font-family:Arial">Arial</option>
							<option value="Arial Black" style="font-family:Arial Black">Arial Black</option>
							<option value="Book Antiqua" style="font-family:Book Antiqua">Book Antiqua</option>
							<option value="Century Gothic" style="font-family:Century Gothic">Century Gothic</option>
							<option value="Comic Sans MS" style="font-family:Comic Sans MS">Comic Sans MS</option>
							<option value="Courier New" style="font-family:Courier New">Courier New</option>
							<option value="Impact" style="font-family:Impact">Impact</option>
							<option value="Tahoma" style="font-family:Tahoma">Tahoma</option>
							<option value="Times New Roman" style="font-family:Times New Roman">Times New Roman</option>
							<option value="Trebuchet MS" style="font-family:Trebuchet MS">Trebuchet MS</option>
							<option value="Verdana" style="font-family:Verdana">Verdana</option>
						</select>
						<select id="upcolor" class="select_chat">
							<option value="">Default</option>
							<option style="background: Gold;" value="Gold">Gold</option>
							<option style="background: Khaki;" value="Khaki">Khaki</option>
							<option style="background: Orange;" value="Orange">Orange</option>
							<option style="background: LightPink;" value="LightPink">LightPink</option>
							<option style="background: Salmon;" value="Salmon">Salmon</option>
							<option style="background: Tomato;" value="Tomato">Tomato</option>
							<option style="background: Red;" value="Red">Red</option>
							<option style="background: Brown;" value="Brown">Brown</option>
							<option style="background: Maroon;" value="Maroon">Maroon</option>
							<option style="background: DarkGreen;" value="DarkGreen">DarkGreen</option>
							<option style="background: DarkCyan;" value="DarkCyan">DarkCyan</option>
							<option style="background: LightSeaGreen;" value="LightSeaGreen">LightSeaGreen</option>
							<option style="background: LawnGreen;" value="LawnGreen">LawnGreen</option>
							<option style="background: MediumSeaGreen;" value="MediumSeaGreen">MediumSeaGreen</option>
							<option style="background: BlueViolet;" value="BlueViolet">BlueViolet</option>
							<option style="background: Cyan;" value="Cyan">Cyan</option>
							<option style="background: Blue;" value="Blue">Blue</option>
							<option style="background: DodgerBlue;" value="DodgerBlue">DodgerBlue</option>
							<option style="background: LightSkyBlue;" value="LightSkyBlue">LightSkyBlue</option>
							<option style="background: White;" value="White">White</option>
							<option style="background: DimGray;" value="DimGray">DimGray</option>
							<option style="background: DarkGray;" value="DarkGray">DarkGray</option>
							<option style="background: Black;" value="Black" selected="">Black</option>
						</select>
						<input type="button" class="btn btnChat" value="Smilies" onclick="smiliepopup();" />
					</div>
						<input type="text" id="uptext" />
						<input type="submit" id="submitform" class="btn btn-primary" value="Send" />
						<input type="hidden" id="name" value="<?php echo $_SESSION['userName']?>" />
						<input type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']?>" />
				</form>
			</div>
		</div>
	</div>
</div>

<script>
_load('content_chat');
//_load('online');
_refresh('content_chat');
//_refresh('online');
</script>
<?php  endswitch;
?>