<?php 
session_start();
include_once"../function/config.php";
include("../function/includes.php");
if(isset($_POST['login'])){
	$pass = md5($_POST['password']);
	if($pass == NULL){
		$final_report.="Please add key!";
		} else {
			$query = mysql_query("SELECT * FROM `admin` WHERE `MDPass` = '$pass'") or die(mysql_error());
			if(mysql_num_rows($query) == 0){
				$final_report.="This key is invalid!";
				} else {
					$editPassword = mysql_query("UPDATE admin SET Passlock='$pass'") or die(mysql_error());
					$final_report.= '<span style="color: green;">Insert key successfully!</span>';
				}
		}
}

if(isset($_SESSION['adminName']) && isset($_SESSION['adminPass'])){ 
	header("Location: index.php");
	}

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
</head>

<?php include('header.php'); ?>
<!-- END NAVIGATION -->
    <div class="clear"></div> 
<!-- START CONTENT -->         
    <div id="content">
         <div class="box login">
			<h2>Locker Panel</h2>
			<form action="" method="post">
				<label for="pass" class="label">Action Key</label>
                <input name="password" type="password" class="txt" title="password" />
                <input type="Submit" name="login" class="btn" value="Insert Key" tabindex="3" />
			</form>
			<?php if($final_report !=""){?>
			<p class="error">
				<?php echo $final_report;?>
			</p>
			<?php } ?>
		</div>
  </div><!-- END CONTENT -->
</div><!-- END WRAPPER -->
<?php include("../footer.php");?>