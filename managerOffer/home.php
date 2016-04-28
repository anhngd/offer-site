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
	if(ProxStop == "ON") {
		callProxstop();
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
	// Check Session status
	if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){
		header("Location: index.php");
	} else {
		$fetch_users_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `members` WHERE userName='".$_SESSION['userName']."'"));
		$ref_id=$fetch_users_data['id'];
		$query_refs = "SELECT COUNT(referralId) FROM members where referralId=".$ref_id."";  
		$result_refs = mysqli_query($conn,$query_refs) or die(mysqli_error()); 
		foreach(mysqli_fetch_array($result_refs) as $total_referrals);
	}

	// Check Stop2IP status
	$queryIP = mysqli_query($conn,"SELECT ip FROM members WHERE userName='".$_SESSION['userName']."'") or die(mysqli_error());
	$ip = mysqli_fetch_array($queryIP);
	if(Stop2ip == "ON" && $ip['ip'] != $_SERVER['REMOTE_ADDR']) {
		header("Location: fairplay.php");
	}
	if(LockOffers == "ON") {
		if(!isset($_SESSION['passOffers'])){
			header("Location: gateOffers.php");
		}
	}
	if(isset($_SESSION['passOffers'])&&$_SESSION['passOffers'] != PassOffers && LockOffers == "ON") {
		header("Location: gateOffers.php");
	}

	// Request Payout
	if(isset($_POST['requestPayout'])) {
		$requester = $_POST['requester'];
		$userId = $_SESSION['userName'];
		$groupName = $_SESSION['groupName'];
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
	if(isset($_GET['name'])){$name = $_GET['name'];}else{$name = "";}
	$goWall = 'gateWalls.php?name='.$name;
	if(LockWalls == "ON") {
		if(!isset($_SESSION['passOffers'])){
			header("Location: $goWall");
		}
	}
	if(isset($_SESSION['passOffers'])&&$_SESSION['passOffers'] != PassOffers && LockWalls == "ON") {
		header("Location: $goWall");
	}
	
	// Save IP information
	if(isset($_GET['name'])){$offerNwk = $_GET['name'];}else{$offerNwk ="";}
	$userId = $_SESSION['userName'];
	$groupName=$_SESSION['groupName'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$port = $_SERVER['REMOTE_PORT'];
	$protocol =$_SERVER['SERVER_PROTOCOL'];
	$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$date = date("Y-m-d");
	$offerCC = checkcc($ip);
	$queryCollect = mysqli_query($conn,"INSERT INTO clicks(id,offerId,offerIdOffer,offerName,offerCC,offerNwk,points,ip,port,protocol,hostName,userAgent,userName,date,groupName) VALUES('','#','#','#','$offerCC','$offerNwk','#','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date','$groupName')") or die(mysqli_error());
	// Choose right offer wall
	$queryWalls = mysqli_query($conn,"SELECT name, iframe, secretKey, status FROM walls WHERE name='".$offerNwk."'") or die(mysqli_error());
	$rightWall = mysqli_fetch_array($queryWalls);
?>

<?php include("function/includes.php"); ?>
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
		<div id="tabs">
			<ul>
				<li><a href="#fragment-1"><span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Walls App &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span></a></li>
				<li><a href="#fragment-2"><span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Banners App &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span></a></li>
			</ul>
			<div id="fragment-1"><!-- walls -->
				<ul>
				<?php
				$queryWalls = mysqli_query($conn,"SELECT name FROM walls WHERE status='ON'") or die(mysqli_error());
				while($wall = mysqli_fetch_array($queryWalls)) {
				?>
						<li id="wallsonet"><a href="walls.php?name=<?php echo $wall['name'];?>"><?php echo $wall['name'];?></a></li>
				<?php }?>
			</ul>
			</div>
			<div id="fragment-2"><!-- banners -->
				<div id="offerslist">
		<div class="searchbox">
			<form action="" method="POST">
				<input class="text" type="text" name="name" value="<?php if(isset($_POST['name']))echo $_POST['name'];?>"/>
				<input type="submit" name="searchOffer" value="Search" />
			</form>
		</div>
		 <?php 
		 $showitemsperlist = 10;
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
		$start_from = ($page-1) * $showitemsperlist; 
		$ip = $_SERVER['REMOTE_ADDR'];
		$cc = checkcc($ip);
		if(isset($_POST['searchOffer']) && $_POST['name']!=NULL) {
			$name = htmlentities($_POST['name'],ENT_QUOTES);
			$queryoffers = mysqli_query($conn,"SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.name LIKE '%".$name."%' AND offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON'  AND offers.status='ON') ORDER BY offers.name LIMIT $start_from,$showitemsperlist") or die(mysqli_error());
		} else {
			$queryoffers = mysqli_query($conn,"SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.country<>'".$cc."' AND offers.network=networks.name AND networks.status = 'ON' AND offers.status='ON') ORDER BY offers.name LIMIT $start_from,$showitemsperlist") or die(mysqli_error());
		}
		if(mysqli_num_rows($queryoffers) == 0)
		{
			echo '<h3>Sorry! There are no offers in your country at the moment, please check again later!</h3>';
		}
		else 
		{
			while($offer = mysqli_fetch_assoc($queryoffers)) {
				$rewards = $offer['payout']*$offer['ratio'];
		?>
		
				<div class="offers"><p class="img"><img src="<?php echo $offer['imageUrl']; ?>" width="40" height="40" /></p>
				<span class="right"><table border="0" width="100%">
				<tr><td class="points"> <?php echo $rewards; ?></td></tr>
				<tr><td><?php echo vcName; ?></td></tr>
				</table></span>
				<h5><a href="goOffer.php?id=<?php echo $offer['offerId'];?>&userId=<?php echo $_SESSION['userName']; ?>&groupName=<?php echo $groupName;?>"target="_blank"><?php echo $offer['offerName'];?></a></h5>
				<p class="des"><?php echo $offer['des'];?></p></div><!-- offer ending -->
		<?php
			}
		} 
		if(isset($_POST['searchOffer']) && $_POST['name']!=NULL) {
			$sql = mysqli_query($conn,"SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.name LIKE '%".$name."%' AND offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON' AND offers.status='ON')") or die(mysqli_error());
		} else {
			$sql = mysqli_query($conn,"SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON' AND offers.status='ON')") or die(mysqli_error()); 
		}
		$row = mysqli_fetch_row($sql); 
		$total_records = $row[0]; 
		$total_pages = ceil($total_records / $showitemsperlist); 
		?>
		<div><p class="page txt"></p>
		<?php
		for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a class='page' href='home.php?page=".$i."'>".$i."</a> "; 
		}; 
		?>	 
		</div>
	</div>	 
			</div>
		</div>
	</div>
	
	<div id="footer">
		<div id="navv">
			<h2><ul class="nav">
				<li><a href="payment.php">Payment</a></li>
				<li><a href="">Help</a></li>
				<li><a href="">Contact Us</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul></h2>
		</div>
	</div>
</div> <!-- END of templatemo_wrapper -->
</body>
</html>