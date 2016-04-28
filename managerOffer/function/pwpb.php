<?php

include("config.php");
include("includes.php");
	
	$queryKey = mysql_query("SELECT secretKey FROM walls WHERE id='7'") or die(mysql_error());
	$result = mysql_fetch_array($queryKey);
	$SECRET = $result['secretKey'];
	define('SECRET', 'YOUR SECRET KEY'); // YOUR SECRET KEY
	define('CREDIT_TYPE_CHARGEBACK', 2);
	$ipsWhitelist = array(
	'174.36.92.186',
	'174.36.96.66',
	'174.36.92.187',
	'174.36.92.192',
	'174.37.14.28'
	);
	$userId = isset($_GET['uid']) ? $_GET['uid'] : null;
	$points = isset($_GET['currency']) ? $_GET['currency'] : null;
	$type = isset($_GET['type']) ? $_GET['type'] : null;
	$refId = isset($_GET['ref']) ? $_GET['ref'] : null;
	$reason = isset($_GET['reason']) ? $_GET['reason'] : null;
	$signature = isset($_GET['sig']) ? $_GET['sig'] : null;	
	$date = date("Y-m-d H:i:s");
	$result = false;
	if (!empty($userId) && !empty($points) && isset($type) && !empty($refId) && !empty($signature)) {
		$signatureParams = array(
		'uid' => $userId,
		'currency' => $points,
		'type' => $type,
		'ref' => $refId
		);
		$signatureCalculated = calculatePingbackSignature($signatureParams,$SECRET);
		// check if IP is in whitelist and if signature matches
		if (in_array($_SERVER['REMOTE_ADDR'], $ipsWhitelist) && ($signature == $signatureCalculated)) {
			
			if ($type == CREDIT_TYPE_CHARGEBACK) {
			// Deduct points from user
			// This is optional, but we recommend this type of crediting to be implemented as well
			// Note that currency amount sent for chargeback is negative, e.g. -5, so be caferul about the sign
			// Don't deduct negative number, otherwise user will get points instead of losing them
				switch ($reason) {
					case 1:
						$reason = 'Chargeback';
						break;
					case 2:
						$reason = 'CC Fraud';
						break;
					case 3:
						$reason = 'Order Fraud';
						break;
					case 4:
						$reason = 'Bad Data Entry';
						break;
					case 5:
						$reason = 'Fake / Proxy User';
						break;
					case 6:
						$reason = 'Rejected by Advertiser';
						break;
					case 7:
						$reason = 'Duplicate Conversions';
						break;
					case 8:
						$reason = 'Goodwill credit taken back';
						break;
					case 9:
						$reason = 'Cancelled Order';
						break;
					case 10:
						$reason = 'Partially Reversed Transaction';
						break;
					case 11:
						$reason = 'Paypal echeck fail';
						break;
				}
				$reasonmsg = 'Reason: '.$reason;
				mysql_query("UPDATE members SET points=points+".$points." WHERE username='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers-1 WHERE username ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','PaymentWall','#','#','#','#','$reasonmsg','$userId','$date')");
			}
			else {
			// Give points to user
						
						$query_checkRef = mysql_query("SELECT referralId from members WHERE username= '".$userId."'") or die(mysql_error());
						foreach((array)mysql_fetch_array($query_checkRef) as $ref_id_user);
						if ($ref_id_user>=1)
						{										
							mysql_query("UPDATE members SET points=points+".$points." WHERE username='".$userId."'");
							mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE username ='".$userId."'");
							mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','PaymentWall','#','#','#','#','#','$userId','$date')");
							mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','PaymentWalls','$points','$date','')");
							mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
							mysql_close();							
						}else {
							
							mysql_query("UPDATE members SET points=points+".$points." WHERE username='".$userId."'");
							mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE username ='".$userId."'");
							mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','PaymentWall','#','#','#','#','#','$userId','$date')");
							mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','PaymentWalls,'$points','$date','')");
							mysql_close();							
						}
			}
			$result = true;
		}
	}
	if ($result) {
	echo 'OK';
	}
	function calculatePingbackSignature($params, $secret) {
	$str = '';
	foreach ($params as $k=>$v) {
	$str .= "$k=$v";
	}
	$str .= $secret;
	return md5($str);
	}
?>