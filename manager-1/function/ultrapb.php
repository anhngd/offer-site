<?php
/**
*** W3Offers.biz Postback System
*** Work stably with all CPA platform
*** Developed by W3Offers.biz Admin
 */
 
 // Input database information
include("config.php"); 
	
	//$ipFrom = $_SERVER['REMOTE_ADDR'];
	// Get information from Network 
	//$offerId = $_GET['offer_id'];
	$trackingID = $_REQUEST['subid']; 
	
	//$test1 = $trackingID.'_1';
	//mysql_query("INSERT INTO test(id,m) VALUES('','$test1')");
	
	// Get Click Information
	$queryClick = mysql_query("SELECT * FROM clicks WHERE trackingID='".$trackingID."' ORDER BY id DESC LIMIT 0,1") or die(mysql_error());
	if(mysql_num_rows($queryClick) != 0) {
	//$test2 = $trackingID.'_2';
	//mysql_query("INSERT INTO test(id,m) VALUES('','$test2')");
		$info = mysql_fetch_array($queryClick);
		$offerId = $info['offerId'];
		$offerIdOffer = $info['offerIdOffer'];
		$offerName = $info['offerName'];
		$offerCC = $info['offerCC'];
		$offerNwk = $info['offerNwk'];
		$points = $info['points'];
		$ip = $info['ip'];
		$port = $info['port'];
		$protocol = $info['protocol'];
		$hostName = $info['hostName'];
		$userAgent = $info['userAgent'];
		$userId=$info['userName'];
		$date = date("Y-m-d H:i:s");
	} else {
		exit();
	}
	
	//Check if User exists
	$checkUser = mysql_query("SELECT * FROM members WHERE userName='".$userId."'");	
	// If User exists
	if(mysql_num_rows($checkUser) !=0){	
			//Update Leads Information
			mysql_query("UPDATE members SET points=points+".$points." WHERE userName ='".$userId."'");
			mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
			mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','$offerId','$offerIdOffer','$offerName','$points','$offerCC','$offerNwk','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date')");
			mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','$offerNwk','$points','$date','')");
			echo 1;
			//$test3 = $trackingID.'_3';
			//mysql_query("INSERT INTO test(id,m) VALUES('','$test3')");
	} else {
			//If User does NOT exists
			echo 0;
	}
	mysql_close();
?>