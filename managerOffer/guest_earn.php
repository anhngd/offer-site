<?php
include_once("function/config.php");
include("function/fnc.php");
	// Get Offer ID and User ID
	if(isset($_GET['id'])||isset($_GET['groupName'])||isset($_GET['loginId'])||$_GET['loginId']!=""||$_GET['id']!=""||$_GET['groupName']!="")
	{
		$getID = addslashes($_GET['id']);
		$loginId = addslashes(base64_decode(base64_decode($_GET['loginId'])));
		$groupName = addslashes($_GET['groupName']);
		$ip_client = $_SERVER['REMOTE_ADDR'];
		$port = $_SERVER['REMOTE_PORT'];
		$protocol =$_SERVER['SERVER_PROTOCOL'];
		$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$date = date("Y-m-d");
		$offerCC = checkcc($ip_client);

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
			$query_get_list_cc=mysqli_query($conn,"select country_cc from offers_country where offer_id='".$offer['offerId']."'");
			while($row=mysqli_fetch_array($query_get_list_cc))
			{
				array_push($array_cc,$row['country_cc']);
			}
			if($rows_admin['check_ssh']=="leads")
			{
				$check_ip=mysqli_query($conn,"Select * from leads where ip='$ip_client' and offerIdOffer='$getID'");
			}
			else
			{
				$check_ip=mysqli_query($conn,"Select * from clicks where ip='$ip_client' and offerIdOffer='$getID'");
			}
			if(!mysqli_num_rows($check_ip))
			{
				if(in_array($offerCC,$array_cc)||in_array("WW",$array_cc))
				{
					// Check ProxStop status
					if(ProxStop == "ON") {
						callProxstop();
					}
					// Check IP Quality Score 
					if(IPQC == "ON") {
					$key = IPQCKey; // Account API Key
					$result = file_get_contents('http://www.ipqualityscore.com/api/ip_lookup.php?KEY='.$key.'&IP='.$ip_client);
						if($result == 1) {
							header("Location: oops.php");
						}
					}
					// Check Stop2IP status
					$queryIP = mysqli_query($conn,"SELECT ip FROM members WHERE userName='".$_SESSION['userName']."'") or die(mysqli_error());
					$ip = mysqli_fetch_array($queryIP);
					if(Stop2ip == "ON" && $ip['ip'] != $_SERVER['REMOTE_ADDR']) {
						header("Location: fairplay.php");
					}
					if(LockOffers == "ON") {
						if(!isset($_SESSION['passOffers'])){
							header("Location: gateOffers.php");
						}
					}
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
					if($offer['end_tracking']=="str_random"||$offer['end_tracking']=="str")
					{
						$trackingID = randString();
					}
					else
					if($offer['end_tracking']=="number")
					{
						$trackingID = randNumber();
					}
					else
					if($offer['end_tracking']=="user")
					{
						$trackingID = $userId;
					}
					else
					{
						$trackingID = "";
					}
					
					$queryNwk = mysqli_query($conn,"SELECT ip FROM networks WHERE name='".$offer['network']."'") or die(mysqli_error());
					$nwk = mysqli_fetch_array($queryNwk);
					if(strpos($offer['url'],"{your_clickid_here}"))
					{
						$trackingID=randString();
						$goUrl=str_replace("{your_clickid_here}",$trackingID,$offer['url']);
						$goUrl=str_replace("{your_subid_here}",$userId,$goUrl);
					}
					else
					{
						$goUrl = $offer['url'].$trackingID;
					}
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
					// Go to Offer
					if($rows_admin['newtab']=="ON")
					{
						?>
						<html>
							<head>
								<script type="text/javascript">
									function openWithoutReferrer(url) {
									  window.open("data:text/html,<meta http-equiv='refresh' content=\"0;url='<?php echo $goUrl;?>'>");
									  close();
									}
								</script>
							</head>
							<body>
								<a onclick="openWithoutReferrer('<?php echo $goUrl;?>');window.close();">Click here open apps</a>
							</body>
						</html>
						<?php
					}
					else
					{
						header("Location: $goUrl");
					}
				}
				else
				{
					echo "Your ip not get this app! Please change country ip!";
				}
			}
			else
			{
				echo "IP already used, please change ip!";
			}
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