<?php 
session_start();
include_once"function/config.php";
include('function/fnc.php');
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
	// Check ProxStop status
/* 	if(ProxStop == "ON") {
		callProxstop();
	}
 */
	
	// Check IP Quality Score 
	if(IPQC == "ON") {
	$key = IPQCKey; // Account API Key
	$ip = $_SERVER['REMOTE_ADDR']; // IP to Lookup
	$result = file_get_contents('http://www.ipqualityscore.com/api/ip_lookup.php?KEY='.$key.'&IP='.$ip);
		if($result == 1) {
			header("Location: oops.php");
		}
	}

	
	// Check Session status
	if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){
		header("Location: login.php");
	} else {
		$fetch_users_data = mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM `members` WHERE userName='".$_SESSION['userName']."'"));	
	}
	$ref_id=$fetch_users_data->id;
	$query_refs = "SELECT COUNT(referralId) FROM members where referralId=".$ref_id."";  
	$result_refs = mysqli_query($conn,$query_refs) or die(mysqli_error()); 
	foreach(mysqli_fetch_array($result_refs) as $total_referrals);
	
	// Check Stop2IP status
	$queryIP = mysqli_query($conn,"SELECT ip FROM members WHERE userName='".$_SESSION['userName']."'") or die(mysqli_error());
	$ip = mysqli_fetch_array($queryIP);
	if(Stop2ip == "ON" && $ip['ip'] != $_SERVER['REMOTE_ADDR']) {
		header("Location: fairplay.php");
	}
	
	// Request Payout
	$final_report="";
	if(isset($_POST['requestPayout'])) {
		$requester = $_POST['requester'];
		$userId = $_SESSION['userName'];
		if($requester == NULL) {
			$final_report.="Please input Member Name !";
		} else {
			$checkRequester = mysqli_query($conn,"SELECT name FROM requesters WHERE name='".$requester."'") or die(mysqli_error());
			if(mysqli_num_rows($checkRequester) == 0) {
				$final_report.="This requester name is invalid!";
			} else {
				$checkRequest = mysqli_query($conn,"SELECT requester FROM members WHERE userName='".$userId."'") or die(mysqli_error());
				$result = mysqli_fetch_array($checkRequest);
				if($result['requester'] != NULL || $result['requester'] == $requester) {
					$final_report.="This username has been requested before!";
				} else {
					$updateRequest = mysqli_query($conn,"UPDATE members SET requester='".$requester."' WHERE userName='".$userId."'") or die(mysqli_error());
					$final_report.='<span style="color: green">Request successfully!</span>';
				} 
			}
		}
	}
?>
<?php include("function/includes.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="single, slider, free templates, website templates, CSS, HTML" />
<meta name="description" content="Single Slider is a free CSS template provided by templatemo.com" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/style2.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="offers.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.5.2.js" ></script>
<script type="text/javascript" src="js/kwicks-1.5.1.pack.js"></script>
<script type="text/javascript" src="js/script.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script>
  $(document).ready(function() {
    $("#tabs").tabs();
  });
  </script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="xlogo">
		</div>
		<div id="memStats">
				<p class="hello">Hello:</p>
				<p class="value"><?php echo $membername;?></p>
				<p class="name"><?php echo vcName;?>:</p>
				<p class="value"><?php echo $memberpoints; ?></p>
		</div>
	</div>
	<div id="content">
		<div class="req">
			<ul id="reqx">
				<?php if ($memberpoints >= 0){?>
				<li><a  class="reqRewards" href="">Request Now</a></li>
				<?php } ?>
				<li><a href="#" class="reqPayout"></a></li>
				<li>
					<form action="" method="POST">
					<input type="text" name="requester" value="members id" onclick="if ( value == 'requester id' ) { value = ''; }" class="boxName"/>
					<input type="submit" name="requestPayout" value="OK" class="btnReq" />
					</form>
					<?php if($final_report !=""){?>
					<p class="error">
						<?php echo $final_report;?>
					</p>
					<?php } ?>
				</li>
			</ul>
		</div>
	</div>
	<div id="footer">
		<div id="navv">
			<h2><ul class="nav">
				<li><a href="home.php">Home</a></li>
				<li><a href="">Help</a></li>
				<li><a href="">Contact Us</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul></h2>
		</div>
	</div>
</div> <!-- END of templatemo_wrapper -->
</body>
</html>