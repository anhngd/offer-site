<?php
 // Input database information
include("./function/config.php"); 
include("./function/fnc.php");
	// Get information from Network 
if(isset($_GET['subid']))
{
	$trackingID= addslashes($_GET['subid']);
}
else
if(isset($_GET['uid']))
{
	$trackingID= addslashes($_GET['uid']);
}
else
if(isset($_GET['sid']))
{
	$trackingID= addslashes($_GET['sid']);
}
else
if(isset($_GET['userId']))
{
	$trackingID= addslashes($_GET['userId']);
}
else
if(isset($_GET['user_id']))
{
	$trackingID= addslashes($_GET['user_id']);
}
else
if(isset($_POST['tracking_id']))
{
	$trackingID=addslashes($_POST['tracking_id']);
}
else
if(isset($_REQUEST['subid']))
{
	$trackingID = $_REQUEST['subid'];
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

$date = date("Y-m-d H:i:s");
$abc=file_get_contents("sv.txt");
$abc.=$_SERVER['QUERY_STRING']."|||".$date."\n";
file_put_contents("./sv.txt",$abc);
if(isset($trackingID))
{
	if(!isset($offerId)||$offerId=="")
	{
		$lead_query = mysqli_query($conn,"SELECT * FROM clicks WHERE trackingID='$trackingID' ORDER BY id DESC LIMIT 0,1");
	}
	else
	{
		$lead_query = mysqli_query($conn,"SELECT * FROM clicks WHERE (trackingID='$trackingID' AND offerId='$offerId') ORDER BY id DESC LIMIT 0,1");
	}
	// Get Click Information
	if(mysqli_num_rows($lead_query) >= 1)
	{
		$info = mysqli_fetch_array($lead_query);
		$offerId = addslashes($info['offerId']);
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
		$userName=$info['userName'];
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
		else
		if(isset($_GET['payout']))
		{
			$points=addslashes($_GET['payout'])*$row_admin['ratio'];
		}
		$checkUser = mysqli_query($conn,"SELECT id FROM members WHERE userName='".$userName."'") or die (mysqli_error());	
		// If User exists
		$checkLeads = mysqli_query($conn,"SELECT id FROM leads WHERE userName='".$userName."' and ip='$ip' and offerId='$offerId'") or die (mysqli_error());
		// If IP exists
		if(mysqli_num_rows($checkUser) !=0&&(mysqli_num_rows($checkLeads)==0)&&$status==1)
		{
				echo "1";
				//Update Leads Information
				mysqli_query($conn,"UPDATE members SET points=points+".$points." WHERE userName ='".$userName."'") or die (mysqli_error());
				mysqli_query($conn,"UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userName."'") or die (mysqli_error());
				mysqli_query($conn,"INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date,groupName,trackingID) VALUES('','$offerId','$offerIdOffer','$offerName','$points','$offerCC','$offerNwk','$ip','$port','$protocol','$hostName','$userAgent','$userName','$date','$groupName','$trackingID')") or die (mysqli_error());
				/*$query_static_h=mysqli_query($conn,"select `time` from `static_month` where `type_time`='type_hour' and userName='$userName' order by id desc limit 0,1") or die (mysqli_error());
				if(mysqli_num_rows($query_static_h))
				{
					$row_static=mysqli_fetch_row($query_static_h);
					$date_check = new DateTime(date("Y-m-d h:i:s",strtotime($row_static[0])));
					$date_h = $date_check->format("Y-m-d h");
					$date_d = $date_check->format("Y-m-d");
					$date_w = $date_check->format("Y-W");
					$date_m = $date_check->format("Y-m");
					mysqli_query($conn,"Update static_month set num_lead=num_lead+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_hour'");
					mysqli_query($conn,"Update static_month set num_lead=num_lead+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_day' and time='$date_d'");
					mysqli_query($conn,"Update static_month set num_lead=num_lead+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_week' and time='$date_w'");
					mysqli_query($conn,"Update static_month set num_lead=num_lead+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_month' and time='$date_m'");
				}*/
				/*
				$query_static_h=mysqli_query($conn,"select `time` from `static_invoice` where userName='$userName' and offerId='$offerId' and network='$offerNwk' limit 0,1") or die (mysqli_error());
				if(mysqli_num_rows($query_static_h))
				{
					mysqli_query($conn,"Update static_month set num_lead=num_lead+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_hour'");
				}*/
				
				if(HIDE=="OFF"){
					mysqli_query($conn,"INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userName','$offerName','$offerNwk','$points','$date','')") or die (mysqli_error());
				} else {
				mysqli_query($conn,"INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userName','','Featured Offer','$points','$date','')") or die (mysqli_error());
				}
		}
		else 
		{
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