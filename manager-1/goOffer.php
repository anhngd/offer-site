<?php
include_once("function/config.php");
include("function/fnc.php");

	// Get Offer ID and User ID
	$getID = $_GET['id'];
	$userId = $_GET['userId'];
	$groupName = $_GET['groupName'];
	// Get Offer Url
	$queryOffer = mysqli_query($conn,"SELECT * FROM offers WHERE id='".$getID."'") or die(mysqli_error());
	$offer = mysqli_fetch_array($queryOffer);
	// Process tracking
	$trackingID = randString();
	$queryNwk = mysqli_query($conn,"SELECT ip FROM networks WHERE name='".$offer['network']."'") or die(mysqli_error());
	$nwk = mysqli_fetch_array($queryNwk);
	$goUrl = $offer['url'].$trackingID;
	
	// Collect click information
	$offerIdOffer = $offer['id'];
	$offerId = $offer['offerId'];
	$offerName = $offer['name'];
	$groupName = $_SESSION['groupName'];
	$offerCC = $offer['country'];
	$offerNwk = $offer['network'];
	$points = $offer['payout']*$offer['ratio'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$port = $_SERVER['REMOTE_PORT'];
	$protocol =$_SERVER['SERVER_PROTOCOL'];
	$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$date = date("Y-m-d");

	$queryCollect = mysqli_query($conn,"INSERT INTO clicks(id,offerId,offerIdOffer,offerName,offerCC,offerNwk,points,ip,port,protocol,hostName,userAgent,userName,date,trackingID,groupName) VALUES('','$offerId','$offerIdOffer','$offerName','$offerCC','$offerNwk','$points','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date','$trackingID','$groupName')") or die(mysqli_error());

	// Go to Offer
	header("Location: $goUrl");

?>