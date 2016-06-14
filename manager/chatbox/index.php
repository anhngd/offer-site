
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
		try{
			if(ajax.handler.readyState == 4 && ajax.handler.status == 200)
			document.getElementById(id).innerHTML = ajax.handler.responseText;
		}catch(e){}		
	}
}
function _load(value){
	if(value == 'content_chat'){
		ajax_load('./chatbox/content.php','content_chat');
		var objDiv = document.getElementById("mainchat");
		//objDiv.scrollTop = objDiv.scrollHeight;
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
//var objDiv = document.getElementById("mainchat");
//objDiv.scrollTop = objDiv.scrollHeight;

$('#content_chat').each(function () {
    $(this).scrollTop($(this)[0].scrollHeight);
});
//alert('@@');
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

<!-- DIRECT CHAT -->
  <div class="box box-warning direct-chat direct-chat-warning">
    <div class="box-header with-border">
      <h3 class="box-title">DIRECT CHAT</h3>
      <div class="box-tools pull-right">
        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <!-- Conversations are loaded here -->
      <div class="direct-chat-messages" id="content_chat">        

      </div><!--/.direct-chat-messages-->

      <!-- Contacts are loaded here -->
      <div class="direct-chat-contacts">
        <ul class="contacts-list">
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../manager/assets/dist/img/user4-128x128.jpg">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                  Count Dracula
                  <small class="contacts-list-date pull-right">2/28/2015</small>
                </span>
                <span class="contacts-list-msg">How have you been? I was...</span>
              </div><!-- /.contacts-list-info -->
            </a>
          </li><!-- End Contact Item -->
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../manager/assets/dist/img/user4-128x128.jpg">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                  Sarah Doe
                  <small class="contacts-list-date pull-right">2/23/2015</small>
                </span>
                <span class="contacts-list-msg">I will be waiting for...</span>
              </div><!-- /.contacts-list-info -->
            </a>
          </li><!-- End Contact Item -->
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../manager/assets/dist/img/user4-128x128.jpg">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                  Nadia Jolie
                  <small class="contacts-list-date pull-right">2/20/2015</small>
                </span>
                <span class="contacts-list-msg">I'll call you back at...</span>
              </div><!-- /.contacts-list-info -->
            </a>
          </li><!-- End Contact Item -->
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../manager/assets/dist/img/user4-128x128.jpg">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                  Nora S. Vans
                  <small class="contacts-list-date pull-right">2/10/2015</small>
                </span>
                <span class="contacts-list-msg">Where is your new...</span>
              </div><!-- /.contacts-list-info -->
            </a>
          </li><!-- End Contact Item -->
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../manager/assets/dist/img/user4-128x128.jpg">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                  John K.
                  <small class="contacts-list-date pull-right">1/27/2015</small>
                </span>
                <span class="contacts-list-msg">Can I take a look at...</span>
              </div><!-- /.contacts-list-info -->
            </a>
          </li><!-- End Contact Item -->
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../manager/assets/dist/img/user4-128x128.jpg">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                  Kenneth M.
                  <small class="contacts-list-date pull-right">1/4/2015</small>
                </span>
                <span class="contacts-list-msg">Never mind I found...</span>
              </div><!-- /.contacts-list-info -->
            </a>
          </li><!-- End Contact Item -->
        </ul><!-- /.contatcts-list -->
      </div><!-- /.direct-chat-pane -->
    </div><!-- /.box-body -->
    <div class="box-footer">
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
        <div class="input-group">
          <input type="text" name="message" id="uptext" placeholder="Type Message ..." class="form-control">
          <span class="input-group-btn">
            <input type="submit" id="submitform" class="btn btn-warning btn-flat" value="Send"/>
            <input type="hidden" id="name" value="<?php echo $_SESSION['userName']?>" />
			<input type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']?>" />
          </span>						
        </div>
      </form>
    </div><!-- /.box-footer-->
  </div><!--/.direct-chat -->

<script>
_load('content_chat');
//_load('online');
_refresh('content_chat');
//_refresh('online');
</script>
<?php  endswitch;
?>