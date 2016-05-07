<?php		
/**
*** W3Offers.biz Postback System
*** Work stably with all CPA platform
*** Developed by W3Offers.biz Admin
 */
 
	// Input database information
	include("config.php");	
	//include("fnc.php");
	
	$ipFrom = $_SERVER['REMOTE_ADDR'];
	// Get information from Network 
	$offerId = $_GET['offerId'];
	$userId = $_GET['userId']; 
	// Check ip while list
	$whileip = array();	
	$queryIp = mysql_query("SELECT ip from networks WHERE ip <>''") or die(mysql_error());	
	while($ip = mysql_fetch_array($queryIp)) {		
		array_push($whileip, $ip['ip']);	
	}	
	
	if(in_array($ipFrom, $whileip)) {
		$queryDup = mysql_query("SELECT * FROM leads WHERE (userName='".$userId."' AND offerId='".$offerId."')") or die(mysql_error());
		if(mysql_num_rows($queryDup) == 0) {
			// Get Click Information
			$queryClick = mysql_query("SELECT * FROM clicks WHERE (userName='".$userId."' AND offerId='".$offerId."') ORDER BY id DESC LIMIT 0,1") or die(mysql_error());
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
				//Update Leads Information
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName ='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','$offerId','$offerIdOffer','$offerName','$points','$offerCC','$offerNwk','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date')");
				if(HIDE=="OFF") {
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','$offerNwk','$points','$date','')");
				} else {
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','Featured Offer','$points','$date','')");
				}
				exit();
			} else { echo 0;}
		} else { echo 0;}
	} else { echo 0;}
	mysql_close();
?>