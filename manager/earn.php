<?php
include_once("function/config.php");
include("function/fnc.php");
	// Get Offer ID and User ID
	if(isset($_GET['id'])&&isset($_GET['groupName'])&&isset($_GET['loginId'])&&isset($_GET['trackingID'])&&$_GET['loginId']!=""&&$_GET['id']!=""&&$_GET['groupName']!=""&&$_GET['trackingID']!="")
	{
		$getID = addslashes($_GET['id']);
		$trackingID = addslashes($_GET['trackingID']);
		$loginId = addslashes(base64_decode(base64_decode($_GET['loginId'])));
		$groupName = addslashes($_GET['groupName']);
		$ip_client = $_SERVER['REMOTE_ADDR'];
		$port = $_SERVER['REMOTE_PORT'];
		$protocol =$_SERVER['SERVER_PROTOCOL'];
		$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$date = date("Y-m-d");
		$offerCC = checkcc($ip_client);
		if($offerCC=="")
		{
			$offerCC = get_info_ip($ip_client);
		}
		$query_admin=mysqli_query($conn,"Select * from admin");
		$rows_admin=mysqli_fetch_array($query_admin);
		$userName_query=mysqli_query($conn,"Select userName from members where codelogin='$loginId'");
		if(mysqli_num_rows($userName_query))
		{
			$userName_row=mysqli_fetch_array($userName_query);
			$userId=$userName_row['userName'];
			// Get Offer Url
			$queryOffer = mysqli_query($conn,"SELECT * FROM offers WHERE id='".$getID."'") or die(mysqli_error());
			$offer = mysqli_fetch_array($queryOffer);
			$array_cc=array();
			
			// Request Payout
			if(isset($_POST['requestPayout'])) {
				$requester = $_POST['requester'];
				if($requester == NULL) {
					$final_report.="Please input Member Name !";
				} else {
					$checkRequester = mysqli_query($conn,"SELECT name FROM requesters WHERE name='".$requester."'") or die(mysqli_error());
					if(mysqli_num_rows($checkRequester) == 0) {
						$final_report.="This requester name is invalid!";
					} else {
						$checkRequest = mysqli_query($conn,"SELECT requester FROM members WHERE userName='".$userId."'") or die(mysqli_error());
						$result = mysqli_fetch_array($checkRequest);
						if($result['requester'] != NULL || $result['requester'] == $requester) {
							$final_report.="This username has been requested before!";
						} else {
							$updateRequest = mysqli_query($conn,"UPDATE members SET requester='".$requester."' WHERE userName='".$userId."'") or die(mysqli_error());
							$final_report.='<span style="color: green">Request successfully!</span>';
						}
					}
				}
			}
			// Process tracking 
			
			$queryNwk = mysqli_query($conn,"SELECT ip FROM networks WHERE name='".$offer['network']."'") or die(mysqli_error());
			$nwk = mysqli_fetch_array($queryNwk);
			$goUrl = $offer['url'].$trackingID;
			
			// Collect click information
			$offerIdOffer = $offer['id'];
			$offerId = $offer['offerId'];
			$offerName = $offer['name'];
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
			header("Location: $goUrl");
		}
		else
		{
			echo "Login error!";
		}
	}
	else
	{
		echo "Earn money error!";
	}
?>