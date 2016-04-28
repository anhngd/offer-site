<?php 
include("../managerOffer/function/config.php");
include("../managerOffer/function/fnc.php");
if($_GET['codelogin'])
{
	$codelogin=base64_decode(addslashes($_GET['codelogin']));
	$os=preg_replace("/_(.+)/","",$codelogin);
	if($os=="p")
	{
		$os="pc";
	}
	else
	if($os=="i")
	{
		$os="ios";
	}
	else
	{
		$os="android";
	}
	$codelogin=preg_replace("/^(.+)_/","",$codelogin);
	$userName_query=mysql_query("Select userName,groupName from members where codelogin='$codelogin'") or die (mysql_error()) ;
	if(!mysql_num_rows($userName_query))
	{
		exit("Login error!");
	}
	
}
else
{
	exit();
}
$path="./";
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
$ip_client= $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip_client= preg_replace("/,(.+)/","",$_SERVER['HTTP_X_FORWARDED_FOR']);
} else {
	$ip_client= $_SERVER['REMOTE_ADDR'];
}

$offerCC = checkcc($ip_client);

?>
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link href="<?php echo $path;?>/style-a.css" media="screen" rel="stylesheet" type="text/css">
	<title>EARN</title>
    <link type="image/x-icon" href="<?php echo $path;?>favicon.ico" rel="shortcut icon">
	<script type="text/javascript" src="<?php echo $path;?>/jquery.js"></script>
     <script type="text/javascript" src="<?php echo $path;?>/appstorevn.js"></script>
	<!--slide top-->
	</head>



<body class="is_landscape appview"><div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" style="padding-bottom: 0px; padding-right: 0px; display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxLoadedContent" style="width: 0px; height: 0px; overflow: hidden; float: left;"></div><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><div id="cboxNext" style="float: left;"></div><div id="cboxPrevious" style="float: left;"></div><div id="cboxSlideshow" style="float: left;"></div><div id="cboxClose" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div><div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" style="padding-bottom: 0px; padding-right: 0px; display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxLoadedContent" style="width: 0px; height: 0px; overflow: hidden; float: left;"></div><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><div id="cboxNext" style="float: left;"></div><div id="cboxPrevious" style="float: left;"></div><div id="cboxSlideshow" style="float: left;"></div><div id="cboxClose" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div><div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" style="padding-bottom: 0px; padding-right: 0px; display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxLoadedContent" style="width: 0px; height: 0px; overflow: hidden; float: left;"></div><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><div id="cboxNext" style="float: left;"></div><div id="cboxPrevious" style="float: left;"></div><div id="cboxSlideshow" style="float: left;"></div><div id="cboxClose" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div>
<div id="main">
<div id="topholder">
    <div id="topbar">
      <div class="slidernav">
        <div id="logo"></div>
        <div class="float_right button"> <a href="javascript:;" class="navigation t-search is_search"><span>search</span></a> </div>
        <div class="float_left button"> <a href="javascript:;" class="navigation second t-user" id="button_navigation"><span>menu</span></a> </div>
      </div>
    </div>
  </div>
 
    <div class="searchbox search" style="display: none;">
	<div class="searchbox-in">
        <form action="<?php echo $domainsite;?>/index.php?search" method="post" id="formsearch">
			<fieldset><input name="keyword" id="search" placeholder="Input keyword" type="text" class="placeholder_text">
			<input id="submit" type="submit" value="Search"></fieldset>
		</form>
	</div>
</div>
<div id="tabmenu" style="display: block;">
	<ul class="individual">
        <li class="<?php if(isset($os)&&$os=='android'){echo "selected";} ?>"><a href="<?php echo $link_earn=$domainsite."/earnall/index.php?codelogin=".base64_encode("a_".$codelogin);?>" class=""><span>Adroid</span></a></li>
        <li class="<?php if(isset($os)&&$os=='ios'){echo "selected";} ?>"><a href="<?php echo $link_earn=$domainsite."/earnall/index.php?codelogin=".base64_encode("i_".$codelogin);?>" class=""><span>iOS</span></a></li>
        <li class="<?php if(isset($os)&&$os=='pc'){echo "selected";} ?>"><a href="<?php echo $link_earn=$domainsite."/earnall/index.php?codelogin=".base64_encode("p_".$codelogin);?>" class=""><span>PC</span></a></li>
	</ul>
</div>

    
<style>#tymxanh{color:green;}</style>   
<div id="content">
	<?php
		if(isset($_GET['details']))
		{
			include("m.details.php");
		}
		else
		if(isset($_GET['os']))
		{
			include("m.os.php");
		}
		else
		if(isset($_GET['search']))
		{
			include("m.search.php");
		}
		else
		{
			include("m.os.php");
		}
	?>
</div>
<!-- related app -->


<!-- end related app -->

<!-- vendor app-->
         

<!-- end vendor app-->


<style>
#helper_send, #helper_share {text-align:center;margin:0 auto;width:100%;color:silver;}
#helper_report {color:red;text-align:justify;padding:5px;}
#helper_report a {text-decoration:none;color:silver;}
#send-email {width:300px;background:silver;color:white;}
</style>


<!-- FlexSlider -->
  
   <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 200,
        itemMargin: 0,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
<script>
var logged = "0";
</script>

<div id="mypanel2" class="ddpanel" style="display:none;">
  <div id="mypanelcontent2" class="ddpanelcontent">
    <div class="elements login">
      <div class="title-bx">
        <h1><a href="javascript:LoginAppotaID();">Login</a></h1>
      
      </div>
      </div>
    </div>
  </div>
</div>
<div id="info-system">
  <script type="text/javascript">
        var href_login = '#';
    if(href_login != '#') {
        $('#loginroi').show();
        $('#chualogin').hide();
    } else {
        $('#loginroi').hide();
        $('#chualogin').show();
    }
    $(document).ready(function(){
        //Examples of how to assign the ColorBox event to elements

        $("#forgot-btt").colorbox({inline:true, width:"100%",href:"#forgotbox",transition:"fade"});

    });


    var countLogin = 0;
    function footerLogin() {
        if(countLogin%2 == 0) {
            $('#mypanel2').show();
            windowHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
            setTimeout('window.scrollTo(0, windowHeight);', 100);
        } else {
            $('#mypanel2').hide();
        }
        countLogin++;
        var href_login = $('.buttonSystem a').eq(1).attr('href');
        if(href_login != '#') {
            $('#mypanel2').hide();
        }
    }
    
    var countLogin1 = 0;
    function headerLogin() {
        if(countLogin1%2 == 0) {
            $('#mypanel').show();
            setTimeout('window.scrollTo(0, 0);', 100);
        } else {
            $('#mypanel').hide();
        }
        countLogin1++;
        var href_login = $('.buttonSystem a').eq(1).attr('href');
        if(href_login != '#') {
            $('#mypanel').hide();
        }
    }
    
    var countLogin2 = 0;
    function middleLogin() {
        if(countLogin2%2 == 0) {
            $('#download-login').show();
            //setTimeout('window.scrollTo(0, 0);', 100);
        } else {
            $('#download-login').hide();
        }
        countLogin2++;
        var href_login = $('.buttonSystem a').eq(1).attr('href');
        if(href_login != '#') {
            $('#download-login').hide();
        }
    }
    
    var countLogin3 = 0;
    function middleLogin1() {
        if(countLogin3%2 == 0) {
            $('#comment-login').show();
            //setTimeout('window.scrollTo(0, 0);', 100);
        } else {
            $('#comment-login').hide();
        }
        countLogin3++;
        var href_login = $('.buttonSystem a').eq(1).attr('href');
        if(href_login != '#') {
            $('#comment-login').hide();
        }
    }
    
    var countLogin4 = 0;
    function eventLogin() {
        if(countLogin4%2 == 0) {
            $('#event-login').show();
            //setTimeout('window.scrollTo(0, 0);', 100);
        } else {
            $('#event-login').hide();
        }
        countLogin4++;
        var href_login = $('.buttonSystem a').eq(1).attr('href');
        if(href_login != '#') {
            $('#event-login').hide();
        }
    }
</script>
<div id="acc-system">



</div>
<script>
function readPopup() {
    $.ajax({
        url: "http://appvn.com/a/home/readPopup/" + 1,
        success: function(data) {
            $.fn.colorbox.close();
            window.location.href = 'http://appvn.com/a/home/help/notice_new';
        }
    });
}
</script>

<div class="copyright" style="font-size:10px;color:#fff;text-align:center;line-height:12px;padding-top:3px;">
Copyright by <?php echo str_replace("http://","",$domainsite);?> 2015 CA, USA
</div>

</div>
<!--End Popup-->

<!--javascript hungsama start-->
<script type="text/javascript">
    function first_use() {
        if(logged == 0) {
            alert('Please login to use!');
            return false;
        }
    }
</script>
<!--javascript hungsama end-->
<div id="sidebar" class="screen_bar" style="display: none;">
		<div id="sidebar_inner">
		    <span id="nav_arrow"></span>
		    <div id="sidebar_content" class="abs">
			<div id="sidebar_content_inner">
			    <div class="userLeft" id="user-left">
                                <nav class="loginLeft">
			    <ul>
				<li><a href="<?php echo $domainsite;?>/managerOffer/login.php" class="signUser sign-in"><span>Login</span></a>
				    
				</li>
                <li><a href="<?php echo $domainsite;?>/managerOffer/register.php" class="signUser sign-up"><span>Register</span></a>
				    
				</li>
			    </ul>
				<ul>
				    
				</li>
			    </ul>

			</nav>
                                                                                
			    </div>
			    <div class="menuLeft">
					<div class="subListmenu">
				    <ul>
                           <li class="m-mail selected"><a href="http://appvn.com/a/home/messages" onclick="return first_use();">Inbox</a></li>
		            <li class="m-account"><a href="http://appvn.com/a/home/account" onclick="return first_use();">User</a></li>
                            <li class="m-boxgift"><a href="http://appvn.com/a/home/messages" onclick="return first_use();">Gift</a></li>
				    </ul>
                    <div class="title-sub"><h3 class="">History</h3></div>
                    <ul>
					<li class="m-gift selected"><a href="http://appvn.com/a/home/eventlog" onclick="return first_use();">Gift history</a></li>
                    <li class="m-download"><a href="http://appvn.com/a/home/downslog" onclick="return first_use();">Download History</a></li>
				    </ul>
                    <div class="title-sub"><h3 class="">Help</h3></div>
				    <ul>
                    <li class="m-help"><a href="http://appvn.com/a/home/downslog" onclick="return first_use();">Help</a></li>
                    <li class="m-contact"><a href="http://appvn.com/a/home/downslog" onclick="return first_use();">Contact</a></li>
                    				    </ul>
				</div>
			    </div>

			</div>
		    </div>
		    <div id="mUser" class="abs">
			<div class="mUser mBack"><a href="javascript:;" id="button_back"><span>Com back</span></a></div>
			
		    </div>
             
		</div>
	    </div>
<script src="/master.js"></script>


</body></html>