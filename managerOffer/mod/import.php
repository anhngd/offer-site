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
	ini_set('auto_detect_line_endings', true);
	if (isset($_POST['importOffer'])) {
		if (is_uploaded_file($_FILES['filename']['tmp_name']))  {   
			if($_POST['ratio']!=NULL && $_POST['network']!=NULL) {
				$i='';
				$nwk = $_POST['network'];
				$ratio = $_POST['ratio'];
				$handle = fopen($_FILES['filename']['tmp_name'], "r");
				while (($line = fgetcsv($handle,",")) !== FALSE) {				
					$offerId = $line[0];
					$name = htmlentities($line[1],ENT_QUOTES);
					$des = htmlentities($line[2],ENT_QUOTES);
					$payout = $line[3];
					$url = $line[4];
					$imageUrl = $line[5];
					if($_POST['country']!=NULL) {
						$ccode = $_POST['country'];
					} else {
						$ccode = $line[6];
					}					
					$querydup = mysql_query("SELECT * FROM offers WHERE (network='".$nwk."' AND offerId='".$offerId."')") or die(mysql_error());
					if(mysql_num_rows($querydup)!=0) {
						continue;
					}					
					$line_import_query="INSERT INTO offers(id, offerId, name, des, payout, ratio, url, imageUrl, country, network, status) VALUES(
						'',
						'".$offerId."',
						'".$name."',
						'".$des."',
						'".$payout."',
						'".$ratio."',
						'".$url."',
						'".$imageUrl."',
						'".$ccode."',
						'".$nwk."',
                        'ON'
						)";
						mysql_query($line_import_query) or die(mysql_error());
						$i +=1;
				}
				$message .='Import successfully file ' . $_FILES['filename']['name'] . ' with ' .$i. ' valid offers!';
			} else {
				$message .='Ratio, Network must be specified!';
			}
		} else {
			 $message .='No file selected!';
		};
	} else {
		 $message .='Please import .csv file.';
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
</head>

<?php include("header.php") ?>
   
    <div id="content">
		 <div class="box import"> 
		 <h2>Import Offers</h2>
		 <form action="" method="post" enctype="multipart/form-data">
			<label class="label">File </label><input type="file" name="filename" /><br>
			<label class="label">Ratio </label><input name="ratio" type="text" /><br>
			<label class="label">Network </label>
			<select name="network">
				<option value="">Select network</option>
				<?php 					$querynwk = mysql_query("SELECT * FROM networks") or die(mysql_error());
					while($nwk = mysql_fetch_array($querynwk)) {
				?>
				<option value="<?php echo $nwk['name'];?>"><?php echo $nwk['name'];?></option>
				<?php }?>
			</select></br>
			<label class="label">Country</label>
			<select name="country">
				<option value="">Select country</option>
				<?php 					$querycc = mysql_query("SELECT * FROM countries") or die(mysql_error());
					while($cc = mysql_fetch_array($querycc)) {
				?>
				<option value="<?php echo $cc['cc'];?>"><?php echo $cc['name'];?></option>
				<?php }?>
			</select>
			<input type="submit" name="importOffer" value="Import" />
		</form>
		<?php if($message !=""){?>
			<p class="error">
				<?php echo $message;?>
			</p>
			<?php } ?>
		</div>
    </div>

</div><!-- END WRAPPER -->
<?php include("../footer.php");?>