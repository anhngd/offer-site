<?php
	/* 	
	* 	Blvd-Media Group Postback Script	
	* 	Support Contact: install@blvd-media.com		
	* 	Widget: RewardTool
	* 	Script: MyVoucherGeek
	* 	Postback Version: 1.0.2b 	
	*/

	// Include Configuration & DB Connection
	include("config.php");
	include("includes.php");

        $querypass = mysql_query("SELECT pass FROM walls WHERE id='1'") or die(mysql_error());
	$result = mysql_fetch_array($querypass);
	$bmgpass = $result['pass'];
	
	
	// Authenticate Session via Blvd-Media Password
	if (($bmgpass == $_GET['Validate'])) {
	$subid 	= mysql_real_escape_string($_GET['SubId']); 	// Username of the user that earned the reward(s).
	$earn 	= mysql_real_escape_string($_GET['Earn']); 		// Amount that the user has earned.
        $offerName = mysql_real_escape_string($_GET['CampaignName']); 		
	$date = date("Y-m-d H:i:s");
 
	$query_checkRef = mysql_query("SELECT referralId from members WHERE username= '".$subid."'") or die(mysql_error());
	foreach(mysql_fetch_array($query_checkRef) as $ref_id_user);
	if ($ref_id_user>=1)
	{
		mysql_query("UPDATE members SET points=points+".$earn." WHERE userName='".$subid."'");
		mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$subid."'");
		mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
		mysql_close();
		echo "RewardTool&reg; Crediting Success: ".$subid." earned ".$earn." points\n and is referred by".$ref_id_user;
	}
	else 
	{       mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$offerName','$earn','#','BlvdMedia','#','#','#','#','#','$subid','$date')");
		mysql_query("UPDATE members SET points=points+".$earn." WHERE userName='".$subid."'");
		mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$subid."'");
		mysql_close();
		echo "RewardTool&reg; Crediting Success: ".$subid." earned ".$earn." points.";
	}
}
else {
	echo "RewardTool&reg; Error: Validation Not Accepted";
	exit;
}
?>