<?php
include_once("./function/config.php");
include('./function/fnc.php');
include('./function/includes.php');
if(!isset($_SESSION['userName'])||!isset($_SESSION['userPassword']))
{
	header("Location:login.php");
}
else
{
	$userPassword=addslashes($_SESSION['userPassword']);
	$userName=addslashes($_SESSION['userName']);
	$check_admin_data = mysqli_query($conn,"SELECT * FROM `admin` WHERE `adminName` = '".$userName."' and `adminPass`='$userPassword'") or die(mysqli_error());
		if(mysqli_num_rows($check_admin_data) == 0)
		{
			$check_mod_data = mysqli_query($conn,"SELECT * FROM `mod` WHERE `modName` = '".$userName."' and `modPass`='$userPassword'") or die(mysqli_error());
			if(mysqli_num_rows($check_mod_data) != 0)
			{
				$get_mod_data = mysqli_fetch_array($check_mod_data);
				if($get_mod_data['banned']==1)
				{
					header("Location:login.php");
				}
			}
			else
			{
				$check_user_data = mysqli_query($conn,"SELECT * FROM `members` WHERE `userName` = '".$userName."' and `userPassword`='$userPassword'") or die(mysqli_error());
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
				}
			}
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php");?>
	
</head>

<body>
		<!-- start: Header -->
	<?php include("header.php");?>
		<!-- end: Header -->
		
		<div class="container-fluid-full">
		<div class="row-fluid">
			<!-- start: Main Menu -->
				<?php include("main_menu.php"); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
				<?php include("content.php");?>
			<!-- end: content -->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="clearfix"></div>
	
	<footer>
		<?php include("fotter.php");?>
	</footer>
	
	<!-- start: JavaScript-->

		<?php include("js.php");?>
	<!-- end: JavaScript-->
	
</body>
</html>
