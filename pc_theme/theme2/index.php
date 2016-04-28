<!DOCTYPE>
<html>
<head>
<?php include("head.php");?>
</head>
    <body>
		<div class="zmviewport hide_zml">
            <?php
				include("menu_top.php");
			?>
			  <div id="register" style="display: none"><script src="<?php echo $path;?>/js/jquery.min.js" type="text/javascript"></script>
<script>
$('#zme-registerwg').click(function(){
   $('#register').css('display','block');
});

$('.zmpuclose').click(function(){
       $('#register').css('display','none');
});

var width = $( window ).width();

$('.zme_login_boxy').css('left',width / 2 - 500 / 2);

$( ".regaccbtn" ).click(function() {
  $('#register').css('display','none');
  $( "#u" ).focus();
});
</script> 
<div class="zmpopup_overlay">
        <div class="zmpopup zme_login_boxy" style="top: 100px;">
            <div class="zmputitle" style="display: none;"></div>
            <div class="zmpucont">
                <div><span></span></div>
                <div>
                    <div id="bxcontainer">
                        <div id="zmefrmregister">
                            <div class="zmpopup pu_large puwg_zmreg" style="position: relative;">
                                <a title="Close" class="zmpuclose"><span style="color: #fff; cursor: pointer;">x</span></a>
                                <div class="zmputitle"><strong>Sign up Now!</strong></div>
                                <div class="zmpucont">                                   
                                    <form class="zmregform" id="frmRegister" name="frmRegister" action="/home/register" method="post">
                                        <label class="zmformlabel">User name<span class="formfieldnote">(6-24 item)</span></label>
                                        <div class="regusername">
                                            <div class="reg_input">
                                                <div class="errormsg">
                                                    <p id="reg_account_error" style="display: none">Account Not Valid.</p>
                                                </div>

                                                <p class="zmusercheck_result"><em id="chk_acc_ok" style="display: none" class="username_true"></em></p>
                                                <p class="input_text">
                                                    <input autocomplete="off" type="text" value="" id="reg_account" name="username" maxlength="24" tabindex="1" required></p>
                                            </div>                                           
                                        </div>
                                        <label class="zmformlabel">Password<span class="formfieldnote">(6-24 item)</span></label>
                                        <div class="reg_input">
                                            <div class="errormsg">
                                                <p id="reg_pwd_error" style="display: none">Confrim password not valid.</p>
                                            </div>
                                            <p class="input_text">
                                                <input autocomplete="off" type="password" value="" id="reg_pwd" name="password" maxlength="32" tabindex="2" required></p>
                                        </div>
                                        <label class="zmformlabel">Confrim password</label>
                                        <div class="reg_input">
                                            <div class="errormsg">
                                                <p id="reg_cpwd_error" style="display: none">Confrim password not valid.</p>
                                            </div>
                                            <p class="input_text">
                                                <input type="password" value="" id="reg_cpwd" maxlength="32" tabindex="3"></p>
                                        </div>


                                        <div class="zmregterm">
                                            <div class="errormsg">
                                                <p id="reg_agree_error" style="display: none">&nbsp;</p>
                                            </div>

                                            <input type="checkbox" value="1" id="ragree" checked="checked" />
                                            <label for="ragree">
                                                <span class="checkbox"></span>Agree 
                                                <a href="#" target="_blank">When join website</a></label>
                                        </div>


         <input type="submit" id="btn-register" value="Signup" class="zmregbtn"/>                           </form>                                                                      
                                </div>
                                <div class="zmpubot">
                                    <div class="zmpubtn">
                                        <div class="reg_an_acc">
                                            <label>Do you have account?</label>
                                            <a href="#" title="Have account" class="regaccbtn">Login</a>                  </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div> 
<script src="<?php echo $path;?>/js/jquery.min.js" type="text/javascript"></script>
<script>
$('#abc').click(function(){
console.log('ádfas');
   $('#register').css('display','block');
});

$('.zmpuclose').click(function(){
       $('#register').css('display','none');
});

var width = $( window ).width();

$('.zme_login_boxy').css('left',width / 2 - 500 / 2);

$( ".regaccbtn" ).click(function() {
  $('#register').css('display','none');
  $( "#u" ).focus();
});
</script> 

<script>
$("input[type=submit]").attr('disabled','disabled');
$('#reg_cpwd').change(function(){
   if ($("#reg_pwd").val() != $("#reg_cpwd").val()) {
       $('#reg_cpwd_error').css('display', 'block');      
   }
   else {
      $('#reg_cpwd_error').css('display', 'none'); 
      $("input[type=submit]").removeAttr('disabled');
   }
});
</script>       
<div id="appstorebody" class="zmbody zmbodyhome">
               <div class="appst_wrapper">
                   <div class="appst_container appst_linecol">
                     <div class="leftads" style="width: 80px">
<a target="_blank" title="http://www.universitytasterdays.com/" href="http://www.universitytasterdays.com/"><img src="http://www.mb104.com/getimage.asp?a=165853&amp;m=3014&amp;o=6407&amp;i=78352.dat" style="clear: both"></a>
</div>
<div class="rightads" style="width: 80px">
<a target="_blank" title="http://www.universitytasterdays.com/" href="http://www.universitytasterdays.com/"><img src="http://www.mb103.com/getimage.asp?a=165853&amp;m=3193&amp;o=7227&amp;i=80393.dat"></a>
</div>
                     
                                
                       
                       <p class="fixedposlink" style="display: none">
                                <a class="backtotop_link" href="#">
                                        <span class="backtotop_icn zmico"></span>
                                        <span class="btntext">Top Page</span>
                                </a>
                        </p>
                        <script type="text/javascript" src="<?php echo $path;?>/js/jquery.min.js"></script> 
<?php
	include("list_app_left.php");
?>
<div class="appst_contcol">
	<?php
		if(isset($_GET['detail']))
		{
			include("detail.php");
		}
		else
		if(isset($_GET['os']))
		{
			include("os.php");
		}
		else
		{
			include("content_index.php");
		}
	?>
</div>

                        <div class="clr"></div>
                  
                   <div class="footer">
       <?php include("fotter.php");?>
      </div>
               </div>
               <div class="clr"></div>
            </div>
    </div>
    
    <script src="<?php echo $path;?>/file/v4/js/zmwg-1.00.min.js" type="text/javascript"></script>
    <script src="<?php echo $path;?>/file/v4/js/feed-1.56.min.js" type="text/javascript"></script>
    <script src="<?php echo $path;?>/file/v4/js/zm.xcall-1.05.min.js" type="text/javascript" ></script>
    <script src="<?php echo $path;?>/file/v4/js/zmgp-1.00.js" type="text/javascript"></script>
    <script src="<?php echo $path;?>/file/v3/js/zmfriend-matching-1.32.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $path;?>/file/v4/js/gamification-1.09.min.js" type="text/javascript"></script>
    <script src="<?php echo $path;?>/file/v4/js/lightbox-1.00.js" type="text/javascript"></script>
        

<script type="text/javascript" src="<?php echo $path;?>/js/jquery.min.js"></script>   
<script>
   $('#appsrch_keyword').keydown(function(event){ 
    var keyCode = (event.keyCode ? event.keyCode : event.which);   
    if (keyCode == 13) {
        var key1 = $("#appsrch_keyword").val();
        window.location.replace("/search/result/index/"+key1);
    }
});
</script> 
<script src="<?php echo $path;?>/file/v4/js/header-1.32.min.js" type="text/javascript"></script>
<script src="<?php echo $path;?>/file/v4/js/status-1.40.min.js" type="text/javascript"></script>
<script src="<?php echo $path;?>/file/v4/js/photo-1.49.min.js" type="text/javascript"></script>
<script src="<?php echo $path;?>/file/v4/js/zm.profile.widget-1.08.min.js" type="text/javascript"></script>
<script src="<?php echo $path;?>/file/v4/js/zm.vietkey-1.01.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $path;?>/file/v4/js/zmcover/zmcover-1.07.min.js"></script>  
    </body>
</html>
