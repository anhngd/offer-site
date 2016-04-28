<?php
 // Input database information
include("./function/config.php"); 
include("./function/fnc.php");
	// Get information from Network 
if(isset($_GET['subid']))
{
	$userName= addslashes($_GET['subid']);
}
else
if(isset($_GET['uid']))
{
	$userName= addslashes($_GET['uid']);
}
else
if(isset($_GET['sid']))
{
	$userName= addslashes($_GET['sid']);
}
else
if(isset($_GET['userId']))
{
	$userName= addslashes($_GET['userId']);
}
else
if(isset($_GET['user_id']))
{
	$userName= addslashes($_GET['user_id']);
}
else
if(isset($_POST['tracking_id']))
{
	$userName=addslashes($_POST['tracking_id']);
}
else
if(isset($_REQUEST['subid']))
{
	$userName = $_REQUEST['subid'];
}

if(isset($_GET['campid']))
{
	$offerId = addslashes($_GET['campid']);
}
else
if(isset($_GET['campaign']))
{
	$offerId = addslashes($_GET['campaign']);
}
else
if(isset($_GET['camp']))
{
	$offerId = addslashes($_GET['camp']);
}
else
if(isset($_GET['offerId']))
{
	$offerId = addslashes($_GET['offerId']);
}
else
if(isset($_GET['cid']))
{
	$offerId = addslashes($_GET['cid']);
}
$status=1;
if(isset($_GET['status']))
{
	$status=addslashes($_GET['status']);
}

$date = date("Y-m-d H:m:s");
$abc=file_get_contents("sv.txt");
$abc.=$_SERVER['QUERY_STRING']."|||".$date."\n";
file_put_contents("./sv.txt",$abc);
if(isset($userName))
{
	if(!isset($offerId)||$offerId="")
	{
		$lead_query = mysqli_query($conn,"SELECT * FROM clicks WHERE trackingID='$userName' ORDER BY id DESC LIMIT 0,1");
	}
	else
	{
		$lead_query = mysqli_query($conn,"SELECT * FROM clicks WHERE (trackingID='$userName' AND offerId='$offerId') ORDER BY id DESC LIMIT 0,1");
	}
	// Get Click Information
	if(mysqli_num_rows($lead_query) >= 1)
	{
		$info = mysqli_fetch_array($lead_query);
		$offerIdOffer = addslashes($info['offerIdOffer']);
		$offerName = addslashes($info['offerName']);
		$offerCC = addslashes($info['offerCC']);
		$offerNwk = addslashes($info['offerNwk']);
		$points = addslashes($info['points']);
		$groupName = addslashes($info['groupName']);
		$ip = addslashes($info['ip']);
		$port = addslashes($info['port']);
		$protocol = addslashes($info['protocol']);
		$hostName = addslashes($info['hostName']);
		$userAgent = addslashes($info['userAgent']);
		$date = date("Y-m-d H:i:s");
		$userId=$info['userName'];
		if(isset($_GET['new']))
		{
			$points=addslashes($_GET['new']);
		}
		else
		if(isset($_GET['currency']))
		{
			$points=addslashes($_GET['currency']);
		}
		else
		if(isset($_GET['amount']))
		{
			$points=addslashes($_GET['amount']);
		}
		
		$checkUser = mysqli_query($conn,"SELECT * FROM members WHERE userName='".$userId."'") or die (mysqli_error());	
		// If User exists
		if(!isset($offerId))
		{
			$checkLeads = mysqli_query($conn,"SELECT * FROM leads WHERE userName='".$userId."' and ip='$ip' and offerName='$offerName'") or die (mysqli_error());
		}
		else
		{
			$checkLeads = mysqli_query($conn,"SELECT * FROM leads WHERE userName='".$userId."' and ip='$ip'") or die (mysqli_error());
		}
		// If IP exists
		if(mysqli_num_rows($checkUser) !=0&&(mysqli_num_rows($checkLeads)==0)&&$status==1)
		{
				$array_ref=mysqli_fetch_array($checkUser);
				echo "1";
				//Update Leads Information
				$ref=$array_ref['ref'];
				$ratebonus=$row_admin['rateBonus'];
				$points_bonus=$points*$ratebonus/100;
				mysqli_query($conn,"UPDATE members SET points=points+".$points." WHERE userName ='".$userId."'") or die (mysqli_error());
				mysqli_query($conn,"UPDATE members SET points_bonus=points_bonus+".$points_bonus." WHERE userName ='".$ref."'") or die (mysqli_error());
				mysqli_query($conn,"UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'") or die (mysqli_error());
				mysqli_query($conn,"INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date,groupName) VALUES('','$offerId','$offerIdOffer','$offerName','$points','$offerCC','$offerNwk','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date','$groupName')") or die (mysqli_error());
				if(HIDE=="OFF"){
					mysqli_query($conn,"INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','$offerNwk','$points','$date','')") or die (mysqli_error());
				} else {
				mysqli_query($conn,"INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','Featured Offer','$points','$date','')") or die (mysqli_error());
				}
		} else {
				//If User does NOT exists
				echo "0";
		}
		mysqli_close();
		/*
		*/
	} else {
		exit(0);
	}
	//Check if User exists
}
?>