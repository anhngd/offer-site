<?php
include_once("function/config.php");
include("function/fnc.php");
	// Get Offer ID and User ID
	if(isset($_GET['id'])&&isset($_GET['loginId'])&&$_GET['loginId']!=""&&$_GET['id']!="")
	{
		$getID = addslashes($_GET['id']);
		$loginId = addslashes(base64_decode(base64_decode($_GET['loginId'])));
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip_client= $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip_client= preg_replace("/,(.+)/","",$_SERVER['HTTP_X_FORWARDED_FOR']);
		} else {
			$ip_client= $_SERVER['REMOTE_ADDR'];
		}
		$port = $_SERVER['REMOTE_PORT'];
		$protocol =$_SERVER['SERVER_PROTOCOL'];
		$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$date = date("Y-m-d");
		$offerCC = checkcc($ip_client);
		$query_admin=mysqli_query($conn,"Select * from admin");
		$rows_admin=mysqli_fetch_array($query_admin);
		$userName_query=mysqli_query($conn,"Select userName,groupName from members where codelogin='$loginId'");
		if(mysqli_num_rows($userName_query))
		{
			$userName_row=mysqli_fetch_array($userName_query);
			$groupName=$userName_row['groupName'];
			$userName=$userName_row['userName'];
			if(isset($_GET['offerWall']))
			{
				$queryWalls = mysqli_query($conn,"SELECT name, iframe, secretKey, status FROM walls WHERE id='".$getID."'") or die(mysqli_error());
				if(!mysqli_num_rows($queryWalls))
				{
					exit("");
				}
				$rightWall = mysqli_fetch_array($queryWalls);
				$offerNwk = addslashes($rightWall['name']);
				$goWall = 'gateWalls.php?name='.$offerNwk;
				if(LockWalls == "ON") {
					if(!isset($_SESSION['passOffers'])){
						header("Location: $goWall");
					}
				}
				if(isset($_SESSION['passOffers'])&&$_SESSION['passOffers'] != PassOffers && LockWalls == "ON") {
					header("Location: $goWall");
				}
				$trackingID = randNumber(10);
				// Save IP information
				$queryCollect = mysqli_query($conn,"INSERT INTO clicks(id,offerId,offerIdOffer,offerName,offerCC,offerNwk,points,ip,port,protocol,hostName,userAgent,userName,date,trackingID,groupName) VALUES('','$getID','#','#','$offerCC','$offerNwk','#','$ip_client','$port','$protocol','$hostName','$userAgent','$userName','$date','$trackingID','$groupName')") or die(mysqli_error());
				// Choose right offer wall
				
				if($rightWall['status']=='ON') 
				{
					
					$convert = html_entity_decode($rightWall['iframe'],ENT_QUOTES);
					if(preg_match("/XXX/",$convert))
					{
						$iframe = explode('XXX',$convert);
						echo $iframe[0].$trackingID.$iframe[1];			
					}
					else
					{
						echo "Get Iframe error!";
					}
				}
			}
			else
			{
				// Get Offer Url
				$queryOffer = mysqli_query($conn,"SELECT offers.id,offers.offerId,offers.name,offers.country,offers.network,offers.payout,offers.ratio,offers.end_tracking,offers.url FROM offers inner join networks ON offers.network=networks.name where offers.id='".$getID."' and offers.status='ON' and networks.status='ON'") or die(mysqli_error());
				

						
				if(!mysqli_num_rows($queryOffer))
				{
					exit("Application has been stopped");
				}
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
									$checkRequest = mysqli_query($conn,"SELECT requester FROM members WHERE userName='".$userName."'") or die(mysqli_error());
									$result = mysqli_fetch_array($checkRequest);
									if($result['requester'] != NULL || $result['requester'] == $requester) {
										$final_report.="This username has been requested before!";
									} else {
										$updateRequest = mysqli_query($conn,"UPDATE members SET requester='".$requester."' WHERE userName='".$userName."'") or die(mysqli_error());
										$final_report.='<span style="color: green">Request successfully!</span>';
									}
								}
							}
						}
						// Process tracking
						$goUrl=$offer['url'];
						if(preg_match("/=$/",$offer['url']))
						{
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
								$trackingID = $userName;
							}
							else
							{
								$trackingID = "";
							}
							$goUrl.=$trackingID;
						}
						else
						{
							if(strpos($offer['url'],"{your_clickid_here}"))
							{
								$trackingID=randString();
								$goUrl=str_replace("{your_clickid_here}",$trackingID,$offer['url']);
								$goUrl=str_replace("{your_subid_here}",$userName,$goUrl);
							}
							else
							if(strpos($offer['url'],"{sub_str}"))
							{
								$trackingID=randString();
								$goUrl=str_replace("{sub_str}",$trackingID,$goUrl);
							}
							else
							if(strpos($offer['url'],"{sub_user}"))
							{
								$trackingID=$userName;
								$goUrl=str_replace("{sub_user}",$trackingID,$goUrl);
							}
							else
							if(strpos($offer['url'],"{sub_num}"))
							{
								$trackingID=randNumber();
								$goUrl=str_replace("{sub_num}",$trackingID,$goUrl);
							}
						}
						$goUrl=str_replace("{sub_str}",randString(),$goUrl);
						$goUrl=str_replace("{sub_num}",randNumber(),$goUrl);
						$goUrl=str_replace("{sub_user}",$userName,$goUrl);
						// Collect click information
						$offerIdOffer = $offer['id'];
						$offerId = $offer['offerId'];
						$offerName = $offer['name'];
						//$offerCC = $offer['country'];
						$offerNwk = $offer['network'];
						$payout = $offer['payout'];
						$points = $payout*$offer['ratio'];
						$ip = $_SERVER['REMOTE_ADDR'];
						$port = $_SERVER['REMOTE_PORT'];
						$protocol =$_SERVER['SERVER_PROTOCOL'];
						$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
						$userAgent = $_SERVER['HTTP_USER_AGENT'];
						$date = date("Y-m-d h:i:s");
						$queryCollect = mysqli_query($conn,"INSERT INTO clicks(id,offerId,offerIdOffer,offerName,offerCC,offerNwk,points,ip,port,protocol,hostName,userAgent,userName,date,trackingID,groupName) VALUES('','$offerId','$offerIdOffer','$offerName','$offerCC','$offerNwk','$points','$ip_client','$port','$protocol','$hostName','$userAgent','$userName','$date','$trackingID','$groupName')") or die(mysqli_error());
						/*
						$query_static_h=mysqli_query($conn,"select `time` from `static_month` where `type_time`='type_hour' and userName='$userName' order by id desc limit 0,1") or die (mysqli_error());
						$date_h = date("Y-m-d h");
						$date_d = $date_today->format("Y-m-d");
						$date_w = date("Y-").$week_today;
						$date_m = date("Y-m");
						if(mysqli_num_rows($query_static_h))
						{
							$row_static=mysqli_fetch_row($query_static_h);
							$date_check = new DateTime(date("Y-m-d",strtotime($row_static[0])));
							$week_check = $date_check->format("W");
							$time_check=strtotime($row_static[0]);
							if(date("Y-m-d h",$time_check)==$date_h)
							{
								mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_hour'");
								mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_day' and time='$date_d'");
								mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_week' and time='$date_w'");
								mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_month' and time='$date_m'");
							}
							else
							{
								mysqli_query($conn,"delete from static_month where `type_time`='type_hour'");
								mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_hour','$time_now')");
								if(date("Y-m-d",$time_check)==$date_d)
								{
									mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_day' and time='$date_d'");
									mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_week' and time='$date_w'");
									mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_month' and time='$date_m'");
								}
								else
								{
									mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_day','$date_d')");
									if((date("Y-",$time_check).$week_check)==$date_w)
									{
										mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_week' and time='$date_w'");
									}
									else
									{
										mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_week','$date_w')");
									}
									
									if(date("Y-m",$time_check)==$date_m)
									{
										mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and `type_time`='type_month' and time='$date_m'");
									}
									else
									{
										mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_month','$date_m')");
									}
								}
							}
						}
						else
						{
							mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_hour','$time_now')");
							mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_day','$date_d')");
							mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_week','$date_w')");
							mysqli_query($conn,"Insert into static_month(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`,`type_time`,`time`) value('$userName','$offerId','$offerNwk','$payout','1','0','type_month','$date_m')");
						}
						*/
						
						
						
						
						/*
						$query_static_h=mysqli_query($conn,"select `time` from `static_invoice` where userName='$userName' and offerId='$offerId' and network='$offerNwk' limit 0,1") or die (mysqli_error());
						if(mysqli_num_rows($query_static_h))
						{
							$row_static=mysqli_fetch_row($query_static_h);
							$date_check = new DateTime(date("Y-m-d",strtotime($row_static[0])));
							$week_check = $date_check->format("W");
							$time_check=strtotime($row_static[0]);
							if(date("Y-m-d h",$time_check)==$date_h)
							{
								mysqli_query($conn,"Update static_month set num_click=num_click+1 where userName='$userName' and offerID='$offerId' and network='$offerNwk'");
							}
						}
						else
						{
							mysqli_query($conn,"Insert into static_invoice(`userName`,`offerID`,`network`,`pay_out`,`num_click`,`num_lead`) value('$userName','$offerId','$offerNwk','$payout','1','0')");
						}*/
						
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