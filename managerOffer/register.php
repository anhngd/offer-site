<?php
include_once("function/config.php");
include('function/fnc.php');
$ip = $_SERVER['REMOTE_ADDR'];
$final_report="";
$mdpass = mysqli_fetch_array(mysqli_query($conn,"SELECT MDPass FROM admin"));
$passlock = mysqli_fetch_array(mysqli_query($conn,"SELECT Passlock FROM admin"));
if($passlock['Passlock'] == NULL OR $mdpass['MDPass'] != $passlock['Passlock']) {
		//header("Location: error.php");
}
	// Check IP Quality Score 
	if(IPQC == "ON") {
	$key = IPQCKey; // Account API Key
	$ip = $_SERVER['REMOTE_ADDR']; // IP to Lookup
	$result = file_get_contents('http://www.ipqualityscore.com/api/ip_lookup.php?KEY='.$key.'&IP='.$ip);
		if($result == 1) {
			header("Location: oops.php");
		}
	}
	// Check ProxStop status
	if(ProxStop == "ON") {
		callProxstop();
	}
include("function/includes.php");

if(isset($_POST['register'])&&isset($_POST['ref'])){
$groupName = addslashes($_POST['ref']);
$codeLogin = addslashes($_POST['codeLogin']);
$username = addslashes($_POST['username']);
$email = addslashes($_POST['email']);
$password = addslashes($_POST['password']);
$points = $bonuspoints;
$memip = $_SERVER['REMOTE_ADDR'];
$memport = $_SERVER['REMOTE_PORT'];
$leadedOffers=0;
$date = date("Y-m-d H:i:s");
	if($username == NULL OR $password == NULL OR $password == NULL)
	{
		$final_report.= "Please complete all fields";
	}
	else
	{
		$checkCodeLogin=mysqli_query($conn,"Select * from members where codelogin='$codeLogin'");
		$checkGroupName=mysqli_query($conn,"Select id from `mod` where groupName='$groupName'");
		if(mysqli_num_rows($checkCodeLogin)!=0)
		{
			$final_report.="<span style='color:red'>The Code Login is already in use!</span>";  
		}
		else
		if(mysqli_num_rows($checkGroupName)==0||$groupName!="index")
		{
			$final_report.="<span style='color:red'>Referrer does not exist!</span>";  
		}
		else
		{
			$check_members = mysqli_query($conn,"SELECT * FROM `members` WHERE `userName` = '$username' or  `email` = '$email'");   
			$check_mod = mysqli_query($conn,"SELECT * FROM `mod` WHERE `modName` = '$username'");   
			$check_admin = mysqli_query($conn,"SELECT * FROM `admin` WHERE `adminName` = '$username'");   
			if(mysqli_num_rows($check_members) != 0||mysqli_num_rows($check_mod) != 0||mysqli_num_rows($check_admin) != 0)
			{
				$final_report.="<span style='color:red'>The username or email is already in use!</span>";  
			}
			else
			{
				if(strlen($username) <= 5 || strlen($username) >= 33)
				{
					$final_report.="<span style='color:red'>Your username must be between 6 and 32 characters</span>";
				}
				else
				{
					if(strlen($password) <= 5 || strlen($password) >= 33)
					{
					$final_report.="<span style='color:red'>Your password must be between 6 and 32 characters</span>";
					}
					else
					{
						$create_member = mysqli_query($conn,"INSERT INTO `members` (`email`,`userName`, `userPassword`, `points`,`leadedOffers`, `ip`,`port`, `date`,`requester`,`status`,`codelogin`,`groupName`) 
						VALUES('$email','$username','$password','$points', '$leadedOffers', '$memip','$memport','$date','','','$codeLogin','$groupName')"); 
						$mysqli_sent_mail=mysqli_query($conn,"Select Confiremail from admin");
						$row_admin=mysqli_fetch_array($mysqli_sent_mail);
						if($row_admin['Confiremail']=='OFF')
						{
							$final_report.="Register success! Thank you! Login <a href='./login.php'>here</a><meta http-equiv='refresh' content=\"2;URL='./login.php'\" />";
						}
						else
						{
							$to = "$email";  //khai báo địa chỉ mail người nhận
					$subject = 'Welcome to '.$domainsite.''; // chủ đề của mail
					// Đây là nội dung mail cần gửi. Để xuống dòng , chèn \n vào cuối dòng
					$message = "Your application to Fowlads is currently being reviewed. An account manager will contact you shortly.\r\nIn the meantime, please save this e-mail so you may have your login credentials on-hand when your account is activated.\r\n$domainsite\r\nE-mail: admin@fowlads.com\r\nSincerely,\r\nFowlads";
					// Khai báo thông tin mail người gửi. Cách dòng bằng \r\n
					$headers = "From: admin@fowlads.com\r\nReply-To: $email";
					 //Gửi mail
					$mail_sent = @mail( $to, $subject, $message, $headers );
							$final_report.="Register success! Please check mail!<meta http-equiv='refresh' content=\"5;URL='../index.php'\" />";
						}
					}
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Registration Page</title>
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
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="assets/index2.html"><b>Admin</b>LTE</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form class="form-horizontal" action="register.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" id="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email" >
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
         
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input class="form-control" placeholder="Code Login"  name="codeLogin" id="codelogin" >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <?php
				if(isset($_GET['ref'])||isset($_POST['ref']))
				{
					$ref=$_REQUEST['ref'];
					echo "<div class='input-prepend' title='Password'>
								<span class='add-on'><i class='halflings-icon lock'></i></span>
								<input class='input-large span10' name='ref_dis' id='ref' type='text' value='$ref' disabled='disabled'/>
							</div>
							<div class='clearfix'></div>";
					echo "<input type='hidden' name='ref' class='txt' value='$ref' hidden=\"hidden\"/><br>";
				}
				?>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="register" >Register</button>
            </div><!-- /.col -->
          </div>
        </form>
        <!--
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>
		-->
        <a href="login.html" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

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