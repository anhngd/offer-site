<?php
	
	include("config.php");
	include("includes.php");
	$queryKey = mysql_query("SELECT secretKey FROM walls WHERE id='4'") or die(mysql_error());
	$result = mysql_fetch_array($queryKey);
	
	$request_ip = $_SERVER['REMOTE_ADDR'];					// Retrieves the IP location of the request
	$sonicads_ip 	= array("79.125.5.179","79.125.26.193","79.125.117.130","176.34.224.39","176.34.224.41","176.34.224.49"); 	// Sets the IP whitelist
	
    $userId = isset($_GET['applicationUserId']) ? $_GET['applicationUserId'] : null;      // a holder for us to place the identification of the user to be credited.	
    $points = isset($_GET['rewards']) ? $_GET['rewards'] : null;   // a holder for us to place the amount of points to be credited.
    $eventId= isset($_GET['eventId']) ? $_GET['eventId'] : null;     // a holder for us to place the unique completion id.
    $timestamp = isset($_GET['timestamp']) ? $_GET['timestamp'] : null;
    $signature = $_GET['signature'];  // this grabs the hashed info for you to authenticate with
	$offerName = isset($_GET['itemName']) ? $_GET['itemName'] : null;
	$publisherSubId = isset($_GET['publisherSubId']) ? $_GET['publisherSubId'] : null;
	$country = isset($_GET['country']) ? $_GET['country'] : null;	
	$privateKey = $result['secretKey'];  //Insert Private Key.
	$date = date("Y-m-d");
	
	$sig = md5 ($timestamp .$eventId .$userId .$points .$privateKey );
	if (($request_ip == $sonicads_ip['0'] ) || ($request_ip == $sonicads_ip['1'] ) || ($request_ip == $sonicads_ip['2'] ) || ($request_ip == $sonicads_ip['3'] ) || ($request_ip == $sonicads_ip['4'] ) || ($request_ip == $sonicads_ip['5'])) {
		if($signature != $sig){		
			echo "Signature doesn't match parameters";
		}else{
			//$query_getuserid = mysql_query("SELECT id from members WHERE username= '".$userId."'") or die(mysql_error());
			//foreach(mysql_fetch_array($query_getuserid) as $userid);

			$query_checkRef = mysql_query("SELECT referralId from members WHERE userName= '".$userId."'") or die(mysql_error());
			//if(is_array($query_checkRef)) {
				foreach((array)mysql_fetch_array($query_checkRef) as $ref_id_user);
				if ($ref_id_user>=1)
				{						
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','#','$points','#','SuperSonicAds','#','#','#','#','#','$userId','$date')");
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','SuperSonicAds','$points','$date','')");
				mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
				mysql_close();
				}else {			
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','#','$points','#','SuperSonicAds','#','#','#','#','#','$userId','$date')");
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','SuperSonicAds','$points','$date','')");
				mysql_close();
				
				}echo "$eventId:OK" ; 
			//}
		}
	}else {
		echo "0";
		exit;
	}
	
?>