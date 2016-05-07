<?php 
session_start();
include_once"function/config.php";
include('function/fnc.php');
	// Check ProxStop status
	/*if(ProxWall == "ON") {
		callProxstop();
	}*/

	// Check Session status
	if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){
		header("Location: login.php");
	} else {
		$fetch_users_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `members` WHERE userName='".$_SESSION['userName']."'"));
	}
	$ref_id=$fetch_users_data['id'];
	$query_refs = "SELECT COUNT(referralId) FROM members where referralId=".$ref_id."";  
	$result_refs = mysqli_query($conn,$query_refs) or die(mysqli_error()); 
	foreach(mysqli_fetch_array($result_refs) as $total_referrals);
	// Check Stop2IP status
	$queryIP = mysqli_query($conn,"SELECT ip FROM members WHERE userName='".$_SESSION['userName']."'") or die(mysqli_error());
	$ip = mysqli_fetch_array($queryIP);
	if(Stop2ip == "ON" && $ip['ip'] != $_SERVER['REMOTE_ADDR']) {
		header("Location: fairplay.php");
	}
	
	$name = $_GET['name'];
	$goWall = 'gateWalls.php?name='.$name;
	if(LockWalls == "ON") {
		if(!isset($_SESSION['passOffers'])){
			header("Location: $goWall");
		}
	}
	
	/*if($_SESSION['passOffers'] != PassOffers && LockWalls == "ON") {
		header("Location: $goWall");
	}*/
	// Save IP information
	$offerNwk = $_GET['name'];
	$userId = $_SESSION['userName'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$port = $_SERVER['REMOTE_PORT'];
	$protocol =$_SERVER['SERVER_PROTOCOL'];
	$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$date = date("Y-m-d");
	$offerCC = "VN";

	$queryCollect = mysqli_query($conn,"INSERT INTO clicks(id,offerId,offerIdOffer,offerName,offerCC,offerNwk,points,ip,port,protocol,hostName,userAgent,userName,date) VALUES('','#','#','#','$offerCC','$offerNwk','#','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date')") or die(mysqli_error());

	// Choose right offer wall
	$queryWalls = mysqli_query($conn,"SELECT name, iframe, secretKey, status FROM walls WHERE name='".$offerNwk."'") or die(mysqli_error());
	$rightWall = mysqli_fetch_array($queryWalls);
?>
<?php //include("function/includes.php"); ?>

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
				<div id="walls">
			<h2><?php echo $rightWall['name'];?></h2>
			<?php 
					if($rightWall['status']=='ON') {
						$convert = html_entity_decode($rightWall['iframe'],ENT_QUOTES);
						$iframe = explode('XXX',$convert);
						echo $iframe[0].$_SESSION['userName'].$iframe[1];			
					}
			?>
			<a href="home.php"><<&nbsp;Back to Walls App</a>&nbsp;
		</div>
			</div>
					<div id="fragment-2"><!-- banners -->
				<div id="offerslist">
		<div class="searchbox">
			<form action="" method="POST">
				<input class="text" type="text" name="name" value="<?php echo $_POST['name'];?>"/>
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
			$queryoffers = mysqli_query($conn,"SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.name LIKE '%".$name."%' AND offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON') ORDER BY offers.name LIMIT $start_from,$showitemsperlist") or die(mysqli_error());
		} else {
			$queryoffers = mysqli_query($conn,"SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON') ORDER BY offers.name LIMIT $start_from,$showitemsperlist") or die(mysqli_error());
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
				<h5><a href="goOffer.php?id=<?php echo $offer['offerId'];?>&userId=<?php echo $_SESSION['userName']; ?>"target="_blank"><?php echo $offer['offerName'];?></a></h5>
				<p class="des"><?php echo $offer['des'];?></p></div><!-- offer ending -->
		<?php
			}
		} 
		if(isset($_POST['searchOffer']) && $_POST['name']!=NULL) {
			$sql = mysqli_query($conn,"SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.name LIKE '%".$name."%' AND offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON')") or die(mysqli_error());
		} else {
			$sql = mysqli_query($conn,"SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON')") or die(mysqli_error()); 
		}
		$row = mysqli_fetch_row($sql); 
		$total_records = $row[0]; 
		$total_pages = ceil($total_records / $showitemsperlist); 
		?>
		<div><p class="page txt"></p>
		<?php
		for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a class='page' href='offers.php?page=".$i."'>".$i."</a> "; 
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