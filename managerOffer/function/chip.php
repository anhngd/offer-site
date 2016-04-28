<?php

 // Input database information
include("config.php"); 
include("fnc.php");
	// Get information from Network 
if(isset($_GET['offerId'])&&isset($_GET['userId']))
{	
	$offerId = $_GET['offerId'];
	$userName= $_GET['userId'];
	$file_ct=file_get_contents("wtf.txt");
	$file_ct.=$offerId."|".$userName."\n";
	file_put_contents("wtf.txt",$file_ct);
	// Get Click Information
	$queryClick = mysql_query("SELECT * FROM clicks WHERE (userName='$userName' AND offerId='$offerId') ORDER BY id DESC LIMIT 0,1");
	if(mysql_num_rows($queryClick) >= 1) {
		$info = mysql_fetch_array($queryClick);
		$offerIdOffer = $info['offerIdOffer'];
		$offerName = $info['offerName'];
		$offerCC = $info['offerCC'];
		$offerNwk = $info['offerNwk'];
		$points = $info['points'];
		$groupName = $info['groupName'];
		$ip = $info['ip'];
		$port = $info['port'];
		$protocol = $info['protocol'];
		$hostName = $info['hostName'];
		$userAgent = $info['userAgent'];
		$date = date("Y-m-d H:i:s");
		$userId=$info['userName'];
		$checkUser = mysql_query("SELECT * FROM members WHERE userName='".$userId."'") or die (mysql_error());	
		// If User exists
		if(mysql_num_rows($checkUser) !=0){
				//Update Leads Information
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName ='".$userId."'") or die (mysql_error());
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'") or die (mysql_error());
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date,groupName) VALUES('','$offerId','$offerIdOffer','$offerName','$points','$offerCC','$offerNwk','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date','$groupName')") or die (mysql_error());
				if(HIDE=="OFF"){
					mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','$offerNwk','$points','$date','')") or die (mysql_error());
				} else {
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','Featured Offer','$points','$date','')") or die (mysql_error());
				}
		} else {
				//If User does NOT exists
				echo '0';
		}
		mysql_close();
		/*
		*/
	} 
	else 
	{
	$netAvazu_Query = mysql_query("SELECT * FROM clicks WHERE (trackingID='$userName' AND offerId='$offerId') ORDER BY id DESC LIMIT 0,1");
	if(mysql_num_rows($queryClick) >= 1) 
	{
		$info = mysql_fetch_array($queryClick);
		$offerIdOffer = $info['offerIdOffer'];
		$offerName = $info['offerName'];
		$offerCC = $info['offerCC'];
		$offerNwk = $info['offerNwk'];
		$points = $info['points'];
		$groupName = $info['groupName'];
		$ip = $info['ip'];
		$port = $info['port'];
		$protocol = $info['protocol'];
		$hostName = $info['hostName'];
		$userAgent = $info['userAgent'];
		$date = date("Y-m-d H:i:s");
		$userId=$info['userName'];
		$checkUser = mysql_query("SELECT * FROM members WHERE userName='".$userId."'") or die (mysql_error());	
		// If User exists
		if(mysql_num_rows($checkUser) !=0){
				//Update Leads Information
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName ='".$userId."'") or die (mysql_error());
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'") or die (mysql_error());
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date,groupName) VALUES('','$offerId','$offerIdOffer','$offerName','$points','$offerCC','$offerNwk','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date','$groupName')") or die (mysql_error());
				if(HIDE=="OFF"){
					mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','$offerNwk','$points','$date','')") or die (mysql_error());
				} else {
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','Featured Offer','$points','$date','')") or die (mysql_error());
				}
		} else {
				//If User does NOT exists
				echo '0';
		}
		mysql_close();
		/*
		*/
	} else {
		exit();
	}
	}
	
	//Check if User exists
	
}
?>