<?php
	 
	// Input database information
	include("config.php");	
	//include("fnc.php");
	
		
		$offerId = mysql_real_escape_string($_GET['cid']);		// Campaign-ID
		$userId =  $_GET['uid'];		// Sub ID passed by the publisher
				
		$status = mysql_real_escape_string($_GET['status']);		// 1 = Credited, 2 = Revoked
		
	
	// Get Click Information
	$queryClick = mysql_query("SELECT * FROM clicks WHERE offerId='$offerId' ORDER BY id DESC LIMIT 0,1") or die(mysql_error());
	if(mysql_num_rows($queryClick) != 0) {
		$info = mysql_fetch_array($queryClick);
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
		$date = date("Y-m-d H:i:s");
		$userId=$info['userName'];
		$offerId = $info['offer_id'];
	} else {
		exit();
	}

	//Check if User exists
	$checkUser = mysql_query("SELECT * FROM members WHERE userName='".$userId."'");	
		// If User exists
		if(mysql_num_rows($checkUser) !=0 && $status == 1){	
				//Update Leads Information
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName ='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','$offerId','$offerIdOffer','$offerName','$points','$offerCC','$offerNwk','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date')");
				
		} else {
				//If User does NOT exists
				echo '0';
		}
mysql_close();
/*
*/
?>