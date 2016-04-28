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
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Login</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
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
						<a href="<?php echo $domainsite;?>/index.php"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Login to your account</h2>
					<form class="form-horizontal" action="login.php" method="post">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="userName" id="username" type="text" placeholder="Username"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="userPassword" id="password" type="password" placeholder="Password"/>
							</div>
							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
							<label class="remember" for="remember"><a href='./register.php?ref=index' style='color:red'>Register</a></label>
							<div class="button-login">	
								<button type="submit" name="login" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
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
<?php
}
?>