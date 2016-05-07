<?php 
session_start();
include_once"../function/config.php";
include("../function/includes.php");
if(isset($_POST['login'])){
	$final_report="";
	$modName= $_POST['username'];
	$pass = md5($_POST['password']);
	if($modName == NULL OR $pass == NULL){
		$final_report.="Please complete both fields";
		} else {
			$query = mysql_query("SELECT * FROM `mod` WHERE `modName` = '$modName'") or die(mysql_error());
			if(mysql_num_rows($query) == 0){
				$final_report.="This username is invalid!";
				} else {
					$admin = mysql_fetch_array($query);
					if($admin['banned']==1)
					{
						$final_report.="Mod $modName have been banned!";
					}
					else
					if($admin['modPass'] == $pass){
						$_SESSION['modName'] = $admin['modName'];
						$_SESSION['modPass'] = $admin['modPass'];
						$_SESSION['groupName'] = $admin['groupName'];
						$final_report.="<meta http-equiv='Refresh' content='0; URL=index.php'/>";
					} else {
						$final_report.="Wrong Email / Password combination!";
					}
				}
		}
}

if(isset($_SESSION['modName']) && isset($_SESSION['modPass'])&&isset($_SESSION['groupName'])){ 
	header("Location: index.php");
	}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Mod cPanel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />


</head>

<?php include('header.php'); ?>
<!-- END NAVIGATION -->
    <div class="clear"></div> 
<!-- START CONTENT -->         
    <div id="content">
         <div class="box login">
			<h2>Mod Login Form</h2>
			<form action="" method="post">
				<label for="admin" class="label">Admin</label>
                <input name="username" type="text" title="username" class="txt" />
				<label for="pass" class="label">Password</label>
                <input name="password" type="password" class="txt" title="password" />
                <input type="Submit" name="login" class="btn" value="login" tabindex="3" />
			</form>
			<?php if(isset($final_report)&& $final_report!=""){?>
			<p class="error">
				<?php echo $final_report;?>
			</p>
			<?php } ?>
		</div>
  </div><!-- END CONTENT -->
</div><!-- END WRAPPER -->
<?php include("../footer.php");?>