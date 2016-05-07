<?php
	
	include("config.php");
	include("includes.php");
	
	$queryKey = mysql_query("SELECT secretKey,pass FROM walls WHERE id='5'") or die(mysql_error());
	$result = mysql_fetch_array($queryKey);
	//Setting initial variables
	$secret_key = $result['secretKey']; //Secret key goes here.
	$camp_id = $result['pass']; //Campaign ID goes here.CAMPAIGN ID HERE, SHOULD BE 4-5 DIGITS!
	$userId = $_REQUEST['userId'];
	$points = $_REQUEST['amount'];
	$external_hash = $_REQUEST['hash'];
	$transaction_id = $_REQUEST['trackId']; //For this network, we pass this to them over the iFrame call.
	$date = date("Y-m-d H:i:s");
	
	// http://www.nguyentuyen.info/function/radiumpb.php?amount=1&appId=6410&hash=3a76ec842af664ebb321212f5f621b37&pid=789&trackId=154&userId=w3admin
	
	$local_hash_calc = md5($userId.":".$camp_id.':'.$secret_key);
	
	if($local_hash_calc == $external_hash) {	
			
			//$query_getuserid = mysql_query("SELECT id from members WHERE userName= '".$userId."'") or die(mysql_error());
			//foreach(mysql_fetch_array($query_getuserid) as $userid);

			$query_checkRef = mysql_query("SELECT referralId from members WHERE userName= '".$userId."'") or die(mysql_error());
			foreach((array)mysql_fetch_array($query_checkRef) as $ref_id_user);
			if ($ref_id_user>=1)
			{			
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','RadiumOne','#','#','#','#','#','$userId','$date')");
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','RadiumOne','$points','$date','')");
				mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
				mysql_close();		
				echo 1;
			}else {			
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','RadiumOne','#','#','#','#','#','$userId','$date')");
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','RadiumOne','$points','$date','')");
				mysql_close();	
				echo 1;
			}
	} else {
		echo 0;
		exit;
	}
?>