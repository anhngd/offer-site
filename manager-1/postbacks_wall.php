<?php
include("./function/config.php"); 
include("./function/fnc.php");
$date = date("Y-m-d H:m:s");
$abc=file_get_contents("sv.txt");
$abc.=$_SERVER['QUERY_STRING']."|||".$date."\n";
file_put_contents("./sv.txt",$abc);
if(isset($_GET['uid'])&&isset($_GET['id'])&&isset($_GET['oid'])&&isset($_GET['new'])&&isset($_GET['total'])&&isset($_GET['sig']))
{
	$id = $_REQUEST['id'];
	$oid = $_REQUEST['oid'];
	$new = $_REQUEST['new'];
	$total = $_REQUEST['total'];
	$sig = $_REQUEST['sig'];
	$userId = $_REQUEST['uid'];
	sig = md5(id:new:uid:SECRET_KEY)
	$info_click_query = mysqli_query($conn,"SELECT * FROM clicks WHERE trackingID='$userId' LIMIT 0,1");
	$info_click = mysqli_fetch_array($info_click_query);
	$queryKey = mysqli_query($conn,"SELECT secretKey FROM walls where id='".$info_click['offerId']."'") or die(mysqli_error());
	$result = mysqli_fetch_array($queryKey);
	$secret_key = $result['secretKey'];
	$str = $transaction_id.':'.$secret_key;
}
if(isset($_REQUEST['user_id']))
{
	$userId = $_REQUEST['user_id'];
	$ms = $_REQUEST['ms'];
	$points = $_REQUEST['currency'];
	$transaction_id = $_REQUEST['transaction_id'];
	$date = date("Y-m-d H:i:s");
	$info_click_query = mysqli_query($conn,"SELECT * FROM clicks WHERE trackingID='$userId' LIMIT 0,1");
	$info_click = mysqli_fetch_array($info_click_query);
	$userName=$info_click['userName'];
	$queryKey = mysqli_query($conn,"SELECT secretKey FROM walls where id='".$info_click['offerId']."'") or die(mysqli_error());
	$result = mysqli_fetch_array($queryKey);
	$secret_key = $result['secretKey'];
	$str = $transaction_id.':'.$secret_key;
	$hash = md5($str);
	if($hash == $ms) 
	{
		mysqli_query($conn,"UPDATE members SET points=points+".$points." WHERE username='".$userName."'");
		mysqli_query($conn,"UPDATE members SET leadedOffers=leadedOffers+1 WHERE username ='".$userName."'");
		mysqli_query($conn,"INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','Matomy','#','#','#','#','#','$userName','$date')");
		mysqli_query($conn,"INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userName','$offerName','Matomy','$points','$date','')");
		echo 1;// if user is credited successfully else echo 0
		mysqli_close();
	}
	else
	{
	echo 0;
	exit;
	}
}
?>
