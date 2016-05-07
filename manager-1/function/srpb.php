<?php

include("config.php");
include("includes.php");

	$queryKey = mysql_query("SELECT secretKey FROM walls WHERE id='3'") or die(mysql_error());
	$result = mysql_fetch_array($queryKey);
	$SECRET = $result['secretKey'];   ///this is you apps secret key get this from app info

	$transactionID = $_REQUEST['id'];//this grabs the taransaction id from super rewards
	$total= $_REQUEST['total'];     // this grabs total points super rewards has ever sent user
	$points = $_REQUEST['new'];   // this grabs amount of points to award user
    $userId = $_REQUEST['uid'];      // this grabs the snuid from the url        
    $offerId = $_REQUEST['oid'];// this grabs the offer walls offer ID    
    $sidverify = $_REQUEST['sig'];  // this grabs the hashed info for you to authenticate with
	$date = date("Y-m-d");
	
	// make  a hash of our own to verify authenicc transaction
	$sig = md5($_REQUEST['id'] . ':' . $_REQUEST['new'] . ':' . $_REQUEST['uid'] . ':' . $SECRET);	
		if($sidverify == $sig){			
			//$query_getuserid = mysql_query("SELECT id from members WHERE username= '".$userId."'") or die(mysql_error());
			//foreach(mysql_fetch_array($query_getuserid) as $userid);			
			$query_checkRef = mysql_query("SELECT referralId from members WHERE userName= '".$userId."'") or die(mysql_error());
			//if(is_array($query_checkRef)) {
				foreach((array)mysql_fetch_array($query_checkRef) as $ref_id_user);
				if ($ref_id_user>=1)
				{			
					mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
					mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
					mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','#','$points','#','SuperRewards','#','#','#','#','#','$userId','$date')");
					mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','SuperRewards','$points','$date','')");
					mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
					mysql_close();			
				}else {			
					mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
					mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
					mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','#','$points','#','SuperRewards','#','#','#','#','#','$userId','$date')");
					mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','SuperRewards','$points','$date','')");
					mysql_close();			
				}echo "1"; 
			//}
		} else {
			echo "0";
			exit;
		}
	
?>