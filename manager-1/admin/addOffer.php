<?php
session_start();
include_once("../function/config.php");
include("../function/fnc.php");
include("../function/includes.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
$mdpass = mysql_fetch_array(mysql_query("SELECT MDPass FROM admin"));
$passlock = mysql_fetch_array(mysql_query("SELECT Passlock FROM admin"));
if($passlock['Passlock'] == NULL OR $mdpass['MDPass'] != $passlock['Passlock']) {
		header("Location: error.php");
}
if(isset($_POST['addOffer'])){
$offerId = $_POST['offerId'];
$name = $_POST['name'];
$des = $_POST['des'];
$payout = $_POST['payout'];
$url = $_POST['url'];
$imageUrl = $_POST['image_url'];
	$offerId = $_POST['offerId'];
	$name = htmlentities($_POST['name'],ENT_QUOTES);
	$des = htmlentities($_POST['des'],ENT_QUOTES);
	$url = $_POST['url'];
	$image_url = $_POST['image_url'];
	$cc = $_POST['country'];
	$network = $_POST['network'];
	$payout = $_POST['payout'];
	if(isset($_POST['globalRate']) && $_POST['globalRate'] == 'Yes') {
		$ratio = Ratio;
	} else {
		$ratio = $_POST['ratio'];
	}
	if($offerId == NULL) {
		$final_report2.= "Please input Offer ID !";
	} else {
		if($name == NULL) {
			$final_report2.= "Please input Offer Name !";
		} else {
			if ($payout == NULL) {
				$final_report2.= "Please input Offer Payout !";
			} else {
				if($url == NULL) {	
					$final_report2.= "Please input Offer URL !";
				} else {
					if($cc == NULL) {
						$final_report2.= "Please input Offer Country !";
					} else {
						if($network == NULL) {
							$final_report2.= "Please input Offer Network !";
						} else {
							$addOffer = mysql_query("INSERT INTO `offers` (`id`,`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`,`country`, `network`, `status`) VALUES('','$offerId','$name','$url','$payout','$ratio','$image_url', '$des','$cc', '$network', 'ON')") or die(mysql_error()); 				
							$final_report2.= 'Offer added successfully !<br><a href="offers.php">Come back</a> to offers list or<br><a href="addOffer.php">Add more offers!</a>';
							//$final_report2.="<meta http-equiv='Refresh' content='0; URL=offers.php'/>"; 						
						}
					}	
				}
			}
		}
	}
}
else
{
	$offerId ="";
	$name = "";
	$des = "";
	$payout = "";
	$url = "";
	$imageUrl = "";
}

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
		 
		 <div class="box offeradding">
			<h2>Add Offer</h2>
			<form action="" method="post">
				<label for="id" class="label">Offer ID *</label> <input type="text" name="offerId" class="txt" value="<?php echo $offerId; ?>" />
				<label for="name" class="label">Name *</label> <input type="text" name="name" class="txt" value="<?php echo $name; ?>" />
				<label for="des" class="label">Description</label><textarea rows="4" cols="50" name="des" ><?php echo $des; ?></textarea>
				<label for="payout" class="label">Payout *</label> <input type="text" name="payout" class="txt" value="<?php echo $payout; ?>" />
				<label for="ratio" class="label">Ratio *</label> <input type="text" name="ratio" class="txt rate" id ="txtRate" value="" />
				<label for="globalrate" class="label globalrate">Global Rate?</label><input type="checkbox" name="globalRate" value="Yes" class="globalrate" onchange="document.getElementById('txtRate').disabled=this.checked;" checked="checked">
				<div style="clear: both;"></div>
				<label for="url" class="label">Tracking URL *</label> <input type="text" name="url" class="txt" value="<?php echo $url; ?>" />
				<label for="imageurl" class="label">Image URL</label> <input type="text" name="image_url" class="txt" value="<?php echo $yourdomain ?>/images/offban.jpg" />
				<label for="country" class="label">Country *</label> 
				<select name="country">
					<option value=""></option>
				<?php
					$queryCountry = mysql_query("SELECT name, cc FROM countries ORDER BY name") or die(mysql_error());
					while($country = mysql_fetch_assoc($queryCountry)) {
				?>	
					<option value="<?php echo $country['cc'];?>"><?php echo $country['name'];?></option>
				<?php } ?>
				</select><br>
				<label for="network" class="label">Network *</label>
				<select name="network">
					<option value=""></option>
				<?php
					$queryNetwork = mysql_query("SELECT name FROM networks ORDER BY name") or die(mysql_error());
					while($network = mysql_fetch_assoc($queryNetwork)) {
				?>	
					<option value="<?php echo $network['name'];?>"><?php echo $network['name'];?></option>
				<?php } ?>
				</select><br>
				<input type="submit" name="addOffer" value="Add" class="btn"/>
			</form>
			<?php if(isset($final_report2)&&$final_report2 !=""){?>
			<p class="error">
				<?php echo $final_report2;?>
			</p>
			<?php } ?>
		 </div>
		
		
    </div>
</div><!-- END WRAPPER -->
<?php include("../footer.php");?>