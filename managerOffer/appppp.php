<?php
include_once("function/config.php");
include('function/fnc.php');
$ip = $_SERVER['REMOTE_ADDR'];
$check_ip_clicks=mysqli_query($conn,"Select * from clicks where ip='$ip'");

$new_date = strtotime ( '+1 month' , strtotime ( $dateto ) ) ;
$new_date = date ( 'Y-m-j' , $new_date );
if($dateto != NULL && $new_date==$datefrom) {
		header("Location: buy.php");
}
$mdpass = mysqli_fetch_array(mysqli_query($conn,"SELECT MDPass FROM admin"));
$passlock = mysqli_fetch_array(mysqli_query($conn,"SELECT Passlock FROM admin"));
if($passlock['Passlock'] == NULL OR $mdpass['MDPass'] != $passlock['Passlock']) {
		header("Location: error.php");
}

if(isset($_GET['codelogin']))
{
	$codelogin=base64_decode(base64_decode($_GET['codelogin']));
	$check_login = mysqli_query($conn,"SELECT * FROM `members` WHERE `codeLogin` = '".$codelogin."'") or die(mysqli_error());
	if(mysqli_num_rows($check_login)!=0)
	{
		$sq=mysqli_fetch_array($check_login);
		if($sq['banned']==1)
		{
			$final_report.= "User ".$sq['userName']." have been banned!";
		}
		else
		if($sq['active']!=1)
		{
			$final_report.= "User ".$sq['userName']." is not active!";
		}
		else
		{
			$start_idsess = $_SESSION['userName'] = "".$sq['userName']."";
			$start_passsess = $_SESSION['userPassword'] = "".$sq['userPassword']."";
			$_SESSION['groupName'] = $sq['groupName'];
			$final_report.="<meta http-equiv='Refresh' content='0; URL=home.php'/>";
		}
	}
	else
	{
		$final_report="Login error!";
	}
}
else
if(isset($_POST['login']))
{
	$userCodeLogin=addslashes(trim($_POST['codeLogin']));
	$userName= trim($_POST['userName']);
	$userPassword = trim($_POST['userPassword']);
	$final_report="";
	if(($userName == NULL||$userPassword == NULL)&&$userCodeLogin==NULL){
	$final_report.="Please complete both fields";
	}
	else
	{
		$check_login = mysqli_query($conn,"SELECT * FROM `members` WHERE `codeLogin` = '".$userCodeLogin."'") or die(mysqli_error());
		if(mysqli_num_rows($check_login)!=0)
		{
			$sq=mysqli_fetch_array($check_login);
			$start_idsess = $_SESSION['userName'] = "".$sq['userName']."";
			$start_passsess = $_SESSION['userPassword'] = "".$sq['userPassword']."";
			$_SESSION['groupName'] = $sq['groupName'];
			$final_report.="<meta http-equiv='Refresh' content='0; URL=home.php'/>";
		}
		else
		{
			$check_user_data = mysqli_query($conn,"SELECT * FROM `members` WHERE `userName` = '".$userName."'") or die(mysqli_error());
			if(mysqli_num_rows($check_user_data) == 0){
			$final_report.="This username does not exist";
			}
			else
			{
				$get_user_data = mysqli_fetch_array($check_user_data);
				if($get_user_data['userPassword'] == $userPassword)
				{
					$start_idsess = $_SESSION['userName'] = "".$get_user_data['userName']."";
					$start_passsess = $_SESSION['userPassword'] = "".$get_user_data['userPassword']."";
					$_SESSION['groupName'] = "".$get_user_data['groupName']."";
					$final_report.="<meta http-equiv='Refresh' content='0; URL=home.php'/>";
				}
			}
		}
	}
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
if(isset($_POST['register'])){
$oldusername = $_POST['username'];
$groupName = $_POST['ref'];
$codeLogin = $_POST['codeLogin'];
$username = mysqli_real_escape_string($oldusername);
$safeusername = addslashes($username);
$oldpassword = $_POST['password'];
$password = mysqli_real_escape_string($oldpassword);
$email = $_POST['email'];
$points = $bonuspoints;
$memip = $_SERVER['REMOTE_ADDR'];
$memport = $_SERVER['REMOTE_PORT'];
$leadedOffers=0;

if(isset($_GET['join'])){
	$referral_ID = $_GET['join'];}
else{$referral_ID="";}
$date = date("Y-m-d H:i:s");
$final_report2="";
	if($username == NULL OR $password == NULL OR $email == NULL)
	{
		$final_report2.= "Please complete all fields";
	}
	else
	{
		$check_ip = mysqli_query($conn,"SELECT * FROM `members` WHERE `ip` = '$memip'");   
		if(mysqli_num_rows($check_ip) != 0){
		$final_report2.="The Ip address is already in use!";  
		}
		else
		{
			$checkCodeLogin=mysqli_query($conn,"Select * from members where codelogin='$codeLogin'");
			if(mysqli_num_rows($checkCodeLogin)!=0)
			{
				$final_report2.="The Code Login is already in use!";  
			}
			else
			{
				$check_members = mysqli_query($conn,"SELECT * FROM `members` WHERE `userName` = '$username'");   
				if(mysqli_num_rows($check_members) != 0)
				{
					$final_report2.="The username is already in use!";  
				}
				else
				{ 
					if(strlen($username) <= 5 || strlen($username) >= 33)
					{
						$final_report2.="Your username must be between 6 and 32 characters";
					}
					else
					{
						if(strlen($password) <= 5 || strlen($password) >= 33)
						{
						$final_report2.="Your password must be between 6 and 32 characters";
						}
						else
						{
						$create_member = mysqli_query($conn,"INSERT INTO `members` (`id`,`userName`, `userPassword`, `email`, `points`,`leadedOffers`,`referralId`, `ip`,`port`, `date`,`requester`,`status`,`codelogin`,`groupName`) 
						VALUES('','$username','$password','$email','$points', '$leadedOffers','$referral_ID', '$memip','$memport','$date','','','$codeLogin','$groupName')"); 
						$final_report2.="Thank you!";
						}
					}
				}
			}
		}	
	}
}

?>

<?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){
	header("Location: home.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="single, slider, free templates, website templates, CSS, HTML" />
<meta name="description" content="Single Slider is a free CSS template provided by templatemo.com" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.5.2.js" ></script>
<script type="text/javascript" src="js/kwicks-1.5.1.pack.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="xlogo">
		</div>
	</div>
	<div id="content">
	<?
	if(mysqli_num_rows($check_ip_clicks))
	{
		echo "<p class='error'>";
		echo "IP exits! Please change ip and try again!";
		echo "</p>";
	}
	else
	{
	?>
		<div class="register">	
			<h3>Register Form</h3>
			<form action="" method="post">
				<label for="username" class="label">Username</label> <input type="text" name="username" class="txt" value="" /><br>
				<label for="password" class="label">Password</label> <input type="password" name="password" class="txt" value="" /><br>
				<label for="password" class="label">Code Login</label> <input type="text" name="codeLogin" class="txt" value="" /><br>
				<label for="email" class="label">Email</label> <input type="text" name="email" class="txt" value="" /><br>
				
				<?php
				if(isset($_GET['ref']))
				{
					$ref=$_GET['ref'];
					echo "<label for='ref' class='label'>ID REF</label> <input type='text' name='ref' class='txt' value='$ref' disabled='disabled'/><br>";
					echo "<input type='text' name='ref' class='txt' value='$ref' hidden='hidden'/><br>";
				}
				?>
				<input type="submit" name="register" value="" class="btn"/>
			</form>
			<?php if(isset($final_report2)&&$final_report2 !=""){?>
			<p class="error">
				<?php echo $final_report2;?>
			</p>
			<?php } ?>
		</div>
		<div class="line"></div>
		<div class="register">
			<h3>Login Form</h3>
			<form action="" method="post">
                <label for="username" class="label">Username</label> <input name="userName" type="text" title="username" class="txt" value="" onclick="if ( value == 'Username' ) { value = ''; }"/>
                <label for="password" class="label">Password</label> <input name="userPassword" type="password" class="txt" title="password" value="" onclick="if ( value == 'Password' ) { value = ''; }"/>
                <label for="password" class="label">CODE LOGIN</label> <input name="codeLogin" type="password" class="txt" title="password" value="" onclick="if ( value == 'Password' ) { value = ''; }"/>
                <input type="Submit" name="login" class="btn" value="" tabindex="3" />
			</form>
			<?php if(isset($final_report)&&$final_report !=""){?>
			<p class="error">
				<?php echo $final_report;?>
			</p>
			<?php } ?>
		</div>
	<?php
	}
	?>
	</div>
	<div id="footer">
		<div id="navv">
			<h2><ul class="nav">
				<li><a href="">Help</a></li>
				<li><a href="">Contact Us</a></li>
			</ul></h2>
		</div>
	</div>
</div> <!-- END of templatemo_wrapper -->
</body>
</html>