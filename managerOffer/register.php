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
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Register</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	
	<link rel="shortcut icon" href="img/favicon.ico">
	
			<style type="text/css">
			body { background: url(img/bg-login.jpg) !important; }
		</style>
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2><?php if(isset($final_report)){ echo $final_report;}else{echo "Create account";}?></h2>
					<form class="form-horizontal" action="register.php" method="post">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="username" id="username" type="text" placeholder="Username"/>
							</div>
							<div class="clearfix"></div>
								
							<div class="input-prepend" title="Email">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="email" id="email" type="text" placeholder="Email"/>
							</div>
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="Password"/>
							</div>
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="codeLogin">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="codeLogin" id="codelogin" type="text" placeholder="Code Login"/>
							</div>
							<div class="clearfix"></div>
							
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
														
							<div class="button-login">	
								<input type="submit" name="register" class="btn btn-primary" value="Register">
							</div>
							<div class="clearfix"></div>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.pie.js"></script>
		<script src="js/jquery.flot.stack.js"></script>
		<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
