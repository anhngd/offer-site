<?php
$error=0;
if(isset($_POST['email']))
{
	$mail_register=file_get_contents("./mail.txt");
	if(preg_match("/".addslashes($_POST['email'])."/",$mail_register))
	{
		$error=2;
	}
	else
	{
		$error=1;
	}
}
	
?>	
<!DOCTYPE html>
<!-- saved from url=(0036)http://www.AdsMoblead.com/login -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <link rel="stylesheet" type="text/css" href="<?php echo $path;?>/data/autorization.css">
<script type="text/javascript" src="<?php echo $path;?>/data/jquery.min.js"></script>
<title>AdsMoblead</title>
    <link rel="icon" href="http://www.AdsMoblead.com/images/index/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="layout-columns">
    <div class="main">
        <div class="wrapper-cols">
            <div class="col-sidebar">
                <a href="http://www.AdsMoblead.com/" class="logo" title="AdsMoblead">
                    AdsMoblead
                </a>
                <h2 class="slogan">
                    The RIGHT PEOPLE<br>
                    get the RIGHT MESSAGE<br>
                    at the RIGHT TIME!
                </h2>
            </div>
            <div class="col-main">
                <div class="wrapper-form">
    <div class="head">
        <h1 class="title">Log In To Your Account</h1>
        <div class="head-nav">
            <span class="label">or</span>
            <a href="./index.php?register" class="btn">Sign up</a>
        </div>
    </div>

    <form class="form form-autorization" id="yw0" action="./index.php?login" method="post">
    <div class="form-group">
        <label class="control-label" for="LoginForm_email">Email</label>        <div class="form-control-wrapper">
            <input class="form-control" name="email" id="LoginForm_email" type="text">                    </div>
    </div>
	<?php
	if($error==1)
	{
		?>
		<div class="form-group">
		<label class="control-label error" for="LoginForm_password">Password</label>        <div class="form-control-wrapper">
            <input class="form-control error" name="LoginForm[password]" id="LoginForm_password" type="password" value="sdfsdfsdf">            <div class="alert-message">Incorrect email or password.</div>        </div>
		</div>
		<?php
	}
	elseif($error==2)
	{
		?>
		<div class="form-group">
		<label class="control-label" for="LoginForm_password">Password</label>        <div class="form-control-wrapper">
            <input class="form-control error" name="LoginForm[password]" id="LoginForm_password" type="password" value="sdfsdfsdf">            <div class="alert-message">Account pending activation</div>        </div>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="form-group">
        <label class="control-label" for="LoginForm_password">Password</label>        <div class="form-control-wrapper">
            <input class="form-control" name="LoginForm[password]" id="LoginForm_password" type="password">                    </div>
		</div>
		<?php
	}?>
    

    <div class="form-group form-group-buttons">
        <input class="btn btn-large btn-primary" title="Log in" type="submit" name="yt0" value="Log in">
    </div>
    </form></div>            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="main">
        2015 © AdsMoblead. All rights reserved.
    </div>
</div>

<div></div></body></html>