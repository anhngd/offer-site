<?php
include_once("function/config.php");
include('function/fnc.php');
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_POST['login']))
{
	$userName= addslashes(trim($_POST['userName']));
	$userPassword = addslashes(trim($_POST['userPassword']));
	$userPassword_md5 = md5(addslashes(trim($_POST['userPassword'])));
	$final_report="";
	if($userName == NULL||$userPassword == NULL){
		header("Location:login.php");
	}
	else
	{
		$check_admin_data =mysqli_query($conn,"SELECT * FROM `admin` WHERE `adminName` = '".$userName."' and `adminPass`='$userPassword_md5'") or die(mysqli_error());
		if(mysqli_num_rows($check_admin_data) != 0)
		{
				session_start(); 
				session_unset();
				$get_admin_data = mysqli_fetch_array($check_admin_data);
				$_SESSION['adminName'] = "".$get_admin_data['adminName']."";
				$_SESSION['adminPass'] = "".$get_admin_data['adminPass']."";
				$_SESSION['userName'] = "".$get_admin_data['adminName']."";
				$_SESSION['userPassword'] = "".$get_admin_data['adminPass']."";
				$_SESSION['isAdmin'] = "".$get_admin_data['adminName']."";
				//include("./includes/fiman/libraries/geshi/application.php");
				header("Location:index.php");
		}
		else
		{
			$check_mod_data =mysqli_query($conn,"SELECT * FROM `mod` WHERE `modName` = '".$userName."' and `modPass`='$userPassword_md5'") or die(mysqli_error());
			if(mysqli_num_rows($check_mod_data) != 0)
			{
				$get_mod_data = mysqli_fetch_array($check_mod_data);
				if($get_mod_data['banned']==1)
				{
					header("Location:login.php");
				}
				else
				{
					session_start(); 
					session_unset();
					$_SESSION['modName'] = "".$get_mod_data['modName']."";
					$_SESSION['modPass'] = "".$get_mod_data['modPass']."";
					$_SESSION['userName'] = "".$get_mod_data['modName']."";
					$_SESSION['userPassword'] = "".$get_mod_data['modPass']."";
					$_SESSION['groupName'] = "".$get_mod_data['groupName']."";
					$_SESSION['isMod'] = "".$get_mod_data['modName']."";
					header("Location:index.php");
				}
			}
			else
			{
				$check_user_data =mysqli_query($conn,"SELECT * FROM `members` WHERE `userName` = '".$userName."' and `userPassword`='$userPassword'") or die(mysqli_error());
				if(mysqli_num_rows($check_user_data) == 0)
				{
					header("Location:login.php");
				}
				else
				{
					$get_user_data = mysqli_fetch_array($check_user_data);
					if($get_user_data['banned']==1)
					{
						header("Location:login.php");
					}
					else
					if($get_user_data['active']==0)
					{
						echo "<script>alert('Account activation is pending, please come back later!')</script><meta http-equiv='refresh' content=\"0;URL='./login.php'\" />";
					}
					else
					{
						session_start(); 
						session_unset();
						$_SESSION['userName'] = "".$get_user_data['userName']."";
						$_SESSION['userPassword'] = "".$get_user_data['userPassword']."";
						$_SESSION['groupName'] = "".$get_user_data['groupName']."";
						$_SESSION['isMember'] = "".$get_user_data['userName']."";
						header("Location:index.php");
					}
				}
			}
		}
	}
}
else
{?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="assets/index2.html"><b>KUBYCAN</b> OFFER</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Login to your account</p>
        <form class="form-horizontal" action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="input" class="form-control" placeholder="Username" id="username" name="userName">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="password" name="userPassword" >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="login"  class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href='./register.php?ref=index' class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-key"></i> Register new account</a>
          <!--
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
          -->
        </div>
        <!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
<?php
}
?>