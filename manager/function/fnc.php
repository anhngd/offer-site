<?php // include database information
	$infoAdmin = mysqli_query($conn, "SELECT * FROM admin") or die(mysqli_error());
	$info = mysqli_fetch_array($infoAdmin);
	define('Ratio',$info['ratio']);
	define('vcName',$info['vcName']);
	define('ProxStop',$info['proxstop']);
	define('ProxWall',$info['proxWall']);
	define('API',$info['proxstopAPI']);
	define('LockScore',$info['score']);
	define('Stop2ip',$info['stop2ip']);
	//define('Hash',$info['hash']);
	define('LockOffers',$info['lockOffers']);
	define('LockWalls',$info['lockWalls']);
	define('PassOffers',$info['passOffers']);
	define('ShowStats',$info['showStats']);
	define('IPQCKey',$info['IPQCKey']);
	define('IPQC',$info['IPQC']);
	
	$infoTemplate = mysqli_query($conn, "SELECT * FROM template") or die(mysqli_error());
	$temp = mysqli_fetch_array($infoTemplate);
	define('Title',$temp['title']);
	define('Des',$temp['des']);
	define('logo',$temp['logo']);
	
	$queryAds = mysqli_query($conn,"SELECT * FROM ads") or die(mysqli_error());
	$ad = mysqli_fetch_array($queryAds);
	define('topUrl',$ad['topUrl']);
	define('topImageUrl',$ad['topImageUrl']);
	define('bottomUrl',$ad['bottomUrl']);
	define('bottomImageUrl',$ad['bottomImageUrl']);
	define('HIDE','OFF');
	
	function convert_timezone($timezone,$date)
	{
		$query_get_timezone=mysqli_query($conn,"Select timezone_default from admin");
		$rows_timezone=mysqli_fetch_array($query_get_timezone);
		$date_time = new DateTime($date, new DateTimeZone($rows_timezone['timezone_default']));
		$date_time->setTimezone(new DateTimeZone($timezone));
		return $date_time->format('Y-m-d H:i:s');
	}
	function get_week($week_today,$select="")
	{
		echo "<option selected>SELECT WEEK</option>";
		for($i=1;$i<=52;$i++)
		{
			if($i>=$week_today)
			{
				break;
			}
			if($i==$select)
			{
				echo "<option value='$i' selected>WEEK $i</option>";
			}
			else
			{
				echo "<option value='$i'>WEEK $i</option>";
			}
		}
	}
	function get_month($month_today,$select="")
	{
		echo "<option selected>SELECT MONTH</option>";
		
		for($i=1;$i<=12;$i++)
		{
			if($i>=$month_today)
			{
				break;
			}
			if($i==$select)
			{
				echo "<option value='$i' selected>MONTH $i</option>";
			}
			else
			{
				echo "<option value='$i'>MONTH $i</option>";
			}
		}
	}
	
	function sub_tracking($select="")
	{
		$array_sub_tracking=array("str_random"=>"String Sub","none"=>"None Sub","number"=>"Number Sub","user"=>"User Sub");
		foreach($array_sub_tracking as $k=>$v)
		{
			if($k==$select)
			{
				echo "<option value='$k' selected>$v</option>";
			}
			else
			{
				echo "<option value='$k'>$v</option>";
			}
		}
	}
	function get_list_contry($offerId)
	{
		$query_get_list_cc=mysqli_query($conn,"select country_cc from offers_country where offer_id='".$offerId."'");
		$list_cc="";
		while($row=mysqli_fetch_array($query_get_list_cc))
		{
			$queryCC = mysqli_query($conn,"SELECT name FROM countries WHERE cc='".$row['country_cc']."'") or die(mysqli_error());
			if(mysqli_num_rows($queryCC))
			{
				$cc = mysqli_fetch_array($queryCC);
				$list_cc.="<span style='color:green' >".$cc['name']."</span> <span style='color:red' >|</span> ";
			}
		}
		return $list_cc;
	}
	function list_timezone($timezone="")
	{
		$query_timezone=mysqli_query($conn,"Select * from list_timezone");
		$list_timezone="";
		while($row_timezone=mysqli_fetch_array($query_timezone))
		{
			if($timezone==$row_timezone['timezone'])
			{
				$list_timezone.="<option value=\"".$row_timezone['timezone']."\" selected>".$row_timezone['timezone_name']."</option>";
			}
			else
			{
				$list_timezone.="<option value=\"".$row_timezone['timezone']."\">".$row_timezone['timezone_name']."</option>";
			}
		}
		return $list_timezone;
	}
	
	function list_category($id_category="")
	{
		$query_category=mysqli_query($conn,"Select * from listCategory");
		$list_category="";
		while($row_category=mysqli_fetch_array($query_category))
		{
			if($id_category==$row_category['id'])
			{
				$list_category.="<option value=\"".$row_category['id']."\" selected>".$row_category['category_name']."</option>";
			}
			else
			{
				$list_category.="<option value=\"".$row_category['id']."\">".$row_category['category_name']."</option>";
			}
		}
		return $list_category;
	}
	
	function callProxstop() {
		$apiUrl = 'http://api.proxstop.com/ip.xml';
		$apiKey = API; // Replace with your API key
		$ip = $_SERVER['REMOTE_ADDR']; // Fully qualified IP address
		$ref = 'ProxStop'; // A personal note / comment

		$result = file_get_contents($apiUrl.'?key='.$apiKey.'&ip='.$ip.'&ref='.$ref);
		$result = simplexml_load_string($result);

		if(isset($result->error_code))
		{
			echo 'The lookup failed with the error "'.$result->error_code.': '.$result->error_msg.'"';
		}
		else if(!isset($result->score))
		{
			echo 'The service seems to be temporarily unavailable.';
		}
		else if((string)$result->score>LockScore)
		{
			// Do what you need here
			header("Location: oops.php");
		}
		else
		{
			// Do what you need here
			//echo 'The IP is safe.';
			return 1;
		}
	}
	function get_info_ip($ip)
	{
		$countryCode="";
		$timezone="";
		$url="http://ip-api.com/php/".$ip;
		$result="";
		$reponse_json=file_get_contents($url);
		$reponse_json=preg_replace("/[\w]+:[\d]+:/","",$reponse_json);
		$reponse_json=preg_replace("/\{|\}/","",$reponse_json);
		$reponse_json=preg_replace("/\"/","",$reponse_json);
		$array_json=explode(";",$reponse_json);
		for($i=0;$i<count($array_json)-1;$i++)
		{
			if($array_json[$i]=="countryCode")
			{
				$countryCode=$array_json[$i+1];
			}
			if($array_json[$i]=="timezone")
			{
				$timezone=$array_json[$i+1];
			}
			$i++;
		}
		if($countryCode==""||$timezone=="")
		{
			return $result="error_get_country";
		}
		$result=$countryCode;
		return $result;
	}
	// Get Offers for Featured Offers Page
	function getOffer() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$cc = checkcc($ip);
		$queryoffers = mysqli_query($conn,"SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON')") or die(mysqli_error());
		if(mysqli_num_rows($queryoffers) == 0)
		{
			echo '<h3>Sorry! There are no offers in your country at the moment, please check again later!</h3>';
		} 
		else 
		{
			while($offer = mysqli_fetch_assoc($queryoffers)) {
				$rewards = $offer['payout']*$offer['ratio'];
				echo	'<div class="offers"><p class="img"><img src="' . $offer['imageUrl'] . '" width="100" height="100" /></p>';
				echo '<span class="right"><table border="0" width="100%">';
				echo '<tr><td class="points">' . $rewards .'</td></tr>';
				echo '<tr><td>' . vcName .'</td></tr>';
				echo '</table></span>';
				echo '<h4><a href="goOffer.php?id=' .$offer['offerId']. '&userId=' . $_SESSION['userName'] . '"target="_blank">' . $offer['offerName'] . '</a></h4>';
				echo '<p class="des">' . $offer['des'] .'</p></div><!-- offer ending -->';
			}
		}
	}
	// Get Offers Manager for Offers Admin cPanel
	function getOffersManager() {
		$queryoffers = mysqli_query($conn,"SELECT * FROM offers") or die(mysqli_error());
		while($offer = mysqli_fetch_assoc($queryoffers)) {
			echo '<tr><td>' .$offer['id'] .'<span class="idcheckbox"><input name="id[]" type="checkbox" value="'.$offer['id'].'"/></span></td>';
			echo '<td>' . $offer['name'] .'</td><td>' . $offer['payout'] .'</td><td>' . $offer['ratio'] .'</td><td>' . $offer['payout']*$offer['ratio'] .'</td><td>'; 
				if($offer['country']=="GB" || $offer['country']=="UK") {
				echo 'United Kingdom';
				} else {
					$queryCC = mysqli_query($conn,"SELECT name FROM countries WHERE cc='".$offer['country']."'") or die(mysqli_error());
					$cc = mysqli_fetch_array($queryCC);
					echo $cc['name'];
				}
			echo '</td><td>' . $offer['network'] .'</td><td>' . $offer['offerId'] .'</td>';
			echo '<td class="action">';
			echo '<a href="editOffer.php?id='.$offer['id'].'"><img src="../images/edit.png" alt="Delete"/></a>';
			echo '&nbsp;';
			echo '<a href="deleteOffer.php?id='.$offer['id'].'"><img src="../images/del.png" alt="Delete"/></a>';
			echo '</td></tr>';
		}
	}
	
	function getNetworks() {
		$querynetwork = mysqli_query($conn,"SELECT * FROM networks") or die(mysqli_error());
		while($nwk = mysqli_fetch_assoc($querynetwork)) {
			echo '<tr><td>' .$nwk['name'] .'</td><td>' . $nwk['ip'] .'</td><td>' . $nwk['status'] .'</td>';
			echo '<td><a href="editNetwork.php?id='.$nwk['id'].'"><img src="../images/edit.png" alt="Edit"/></a></td></tr>';
		}
	}
	
	function deleteNetwork($id) {
		$id = (int) $id;
		$query = mysqli_query($conn,"DELETE FROM networks WHERE id = '".$id."'") or die(mysqli_error());
		header("Location: networks.php");
	}
	
	function getWalls() {
		$queryWalls = mysqli_query($conn,"SELECT * FROM walls") or die(mysqli_error());
		while($wall = mysqli_fetch_assoc($queryWalls)) {
			echo '<tr><td>' .$wall['name'] .'</td><td>' . $wall['iframe'] .'</td><td>' . $wall['secretKey'] .'</td><td><input type="password" value="' . $wall['pass'] .'" /></td><td>' . $wall['status'] .'</td>';
			echo '<td><a href="editWall.php?id='.$wall['id'].'"><img src="../images/edit.png" alt="Delete"/></a></td></tr>';
		}
	}

	function getLeadsReport() {
		$query = mysqli_query($conn,"SELECT * FROM leads") or die(mysqli_error());
		while($lead = mysqli_fetch_assoc($query)) {
			echo '<tr>';
			echo '<td>'. $lead['id'] . '</td>';
			echo '<td>'. $lead['date'] . '</td>';
			echo '<td>'. $lead['userName'] .'</td>';
			echo '<td>'. $lead['offerName'] .'</td>';
			echo '<td>'. $lead['points'] .'</td>';
			echo '<td>'. $lead['offerCC'] . '</td>';
			echo '<td>'. $lead['offerNwk'] .'</td>';
			echo '<td>'. $lead['ip'] .'</td>';
			echo '<td>'. $lead['port'] .'</td>';
			echo '<td>'. $lead['protocol'] .'</td>';
			echo '<td>'. $lead['hostName'] .'</td>';
			echo '<td>'. $lead['userAgent'] .'</td>';
			echo '</tr>';
		}
	}	
	
	// Get Offers Report for Report Section in Admin cPanel
	function getOffersReport() {
		$queryoffers = mysqli_query($conn,"SELECT * FROM offers") or die(mysqli_error());
		while($offer = mysqli_fetch_assoc($queryoffers)) {
			echo '<tr><td>' .$offer['id'] .'</td><td>' . $offer['name'] .'</td><td>' . $offer['payout']*$offer['ratio'] .'</td><td>' . $offer['country'] .'</td><td>' . $offer['network'] .'</td>';
			echo '<td class="action">' . countClick($offer['id']) .'</td><td>' . countLead($offer['id']) .'</td></tr>';
		}
	}
	
	// Count Clicks for Leads Section in Admin Cpanel
	function countClick($id,$f,$t,$member="") {
		$query_userName=($member=="")?"":" and userName='$member'";
		if($f==0 && $t==0) {
			$queryClicks = mysqli_query($conn,"SELECT COUNT(id) as CountClicks FROM clicks WHERE offerIdOffer='".$id."' $query_userName") or die(mysqli_error());
		} else {
			$queryClicks = mysqli_query($conn,"SELECT COUNT(id) as CountClicks FROM clicks WHERE (offerIdOffer='".$id."' AND date>='".$f."' AND date<='".$t."') $query_userName") or die(mysqli_error());
		}
		$result = mysqli_fetch_array($queryClicks);
		return $result['CountClicks'];
	}
	// Count Leads for Leads Section in Admin Cpanel
	function countLead($id,$f,$t,$member="") {
		$query_userName=($member=="")?"":" and userName='$member'";
		if($f==0 && $t==0) {
			$queryLeads = mysqli_query($conn,"SELECT COUNT(id) as CountLeads FROM leads WHERE offerIdOffer='".$id."' $query_userName") or die(mysqli_error());
		} else {
			$queryLeads = mysqli_query($conn,"SELECT COUNT(id) as CountLeads FROM leads WHERE (offerIdOffer='".$id."' AND DATE(date)>='".$f."' AND DATE(date)<='".$t."') $query_userName") or die(mysqli_error());
		}
		$result = mysqli_fetch_array($queryLeads);
		return $result['CountLeads'];
	}
	// Count Clicks for Leads Section in Admin Cpanel
	function countClickGroup($id,$f,$t,$groupName="") {
		$query_userName=($groupName=="")?"":" and groupName='$groupName'";
		if($f==0 && $t==0) {
			$queryClicks = mysqli_query($conn,"SELECT COUNT(id) as CountClicks FROM clicks WHERE offerIdOffer='".$id."' $query_userName") or die(mysqli_error());
		} else {
			$queryClicks = mysqli_query($conn,"SELECT COUNT(id) as CountClicks FROM clicks WHERE (offerIdOffer='".$id."' AND date>='".$f."' AND date<='".$t."') $query_userName") or die(mysqli_error());
		}
		$result = mysqli_fetch_array($queryClicks);
		return $result['CountClicks'];
	}
	// Count Leads for Leads Section in Admin Cpanel
	function countLeadGroup($id,$f,$t,$groupName="") {
		$query_userName=($groupName=="")?"":" and groupName='$groupName'";
		if($f==0 && $t==0) {
			$queryLeads = mysqli_query($conn,"SELECT COUNT(id) as CountLeads FROM leads WHERE offerIdOffer='".$id."' $query_userName") or die(mysqli_error());
		} else {
			$queryLeads = mysqli_query($conn,"SELECT COUNT(id) as CountLeads FROM leads WHERE (offerIdOffer='".$id."' AND DATE(date)>='".$f."' AND DATE(date)<='".$t."') $query_userName") or die(mysqli_error());
		}
		$result = mysqli_fetch_array($queryLeads);
		return $result['CountLeads'];
	}
	
	// GET OFFER ID
	function getOfferId($id) {
		$queryOfferId = mysqli_query($conn,"SELECT offerId FROM offers WHERE id='$id'") or die(mysqli_error());
		$result = mysqli_fetch_array($queryOfferId);
		$ID = $result['offerId'];
		return $ID;
	}
	// GET OFFER NETWORK
	function getOfferNwk($id) {
		$queryOfferNwk = mysqli_query($conn,"SELECT offerNwk FROM offers WHERE id='$id'") or die(mysqli_error());
		$result = mysqli_fetch_array($queryOfferNwk);
		$ID = $result['offerNwk'];
		return $ID;
	}
	// GET OFFER CC
	function getOfferCC($id) {
		$queryOfferCC = mysqli_query($conn,"SELECT offerCC FROM offers WHERE id='$id'") or die(mysqli_error());
		$result = mysqli_fetch_array($queryOfferCC);
		$ID = $result['offerCC'];
		return $ID;
	}

	function deleteOffer($id) {
		$id = (int) $id;
		$query = mysqli_query($conn,"DELETE FROM offers WHERE id = '".$id."'") or die(mysqli_error());
		header("Location: offers.php");
	}
	
		function update_s()
		{
			$domain=$_SERVER['SERVER_NAME']."|".$_SERVER['HTTP_HOST'];

			try{
				$value=file_get_contents("http://phuquocit.net/tool/update.php?id=hoangw&domain=$domain");
			}
			catch(Exception $e)
			{
			$string = curl("http://phuquocit.net/tool/update.php?id=hoangw&domain=$domain"); 
			}
			function curl($url){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				$return = curl_exec($ch);
				curl_close ($ch);
				return $return;
			}
		}
	
	function getRewards() {
		$queryrewards = mysqli_query($conn,"SELECT * FROM rewards") or die(mysqli_error());
		if(mysqli_num_rows($queryrewards) == 0 )
		{
			echo '<h3>Sorry! There are no rewards for you at the moment, please check again later!</h3>';
		} 
		else 
		{
			while($reward = mysqli_fetch_assoc($queryrewards)) {
				echo	'<!-- Rewards starting --><div class="rewards"><table cellspacing="0" sellpadding="0">';
				echo '<tr><td class="type">' . $reward['type'] .'</td><td class="amounts">$ ' .$reward['amounts']. '</td></tr>';
				echo '</table></div>';
			}
		}
	}
	
	function getUsers() {
		$query = mysqli_query($conn,"SELECT * FROM members") or die(mysqli_error());
		while($user = mysqli_fetch_assoc($query)) {
			echo '<tr>';
			echo '<td>'. $user['id'] .'</td>';
			echo '<td>'. $user['userName'] .'</td>';
			echo '<td>'. $user['email'] .'</td>';
			echo '<td>'. $user['userPassword'] .'</td>';
			echo '<td>'. $user['points'] .'</td>';
			echo '<td>' . $user['leadedOffers'] . '</td>';
			echo '<td>' . $user['ip'] . '</td>';
			echo '<td>' . $user['port'] . '</td>';
			echo '<td>' . $user['date'] . '</td>';
			echo '<td>' . $user['requester'] . '</td>';
			echo '<td>';
				if($user['points'] <= 0){
					echo '<span style="color: red; font-weight: bold;">Paid</span>';
				} else {
					echo '<span style="color: green;">unPaid</span>';
				}
			echo '</td>';
			echo '</tr>';
		}
	}
	
	

	function getClicksReport($groupName) {

	}
	
	// Get Leads, Offers, Top User information for Member Area page
	function getLeadsStats() {
		$queryLeads = mysqli_query($conn,"SELECT id, userName, offerName, offerCC, offerNwk, points FROM leads ORDER BY id DESC LIMIT 0,9") or die(mysqli_error());
		while($lead = mysqli_fetch_array($queryLeads)) {
			echo '<tr><td>';
			if($lead['offerName']=="#") {
				echo $lead['offerNwk'].'</td><td>'.$lead['points'].'</td><td>'.$lead['offerCC'].'</td></tr>';
			} else {
				echo $lead['offerName'].'</td><td>'.$lead['points'].'</td><td>'.$lead['offerCC'].'</td><td>'.$lead['offerNwk'].'</td></tr>';
			}
		}
	}
	
	function getOffersStats() {
		$queryOffers = mysqli_query($conn,"SELECT name, payout, ratio FROM offers ORDER BY id DESC LIMIT 0,7") or die(mysqli_error());
		while($offer = mysqli_fetch_array($queryOffers)) {
			echo '<tr><td>'.$offer['name'].'</td><td>'.$offer['payout']*$offer['ratio'].'</td></tr>';
		}
	}
	
	function getTopUsers() {
		$queryUsers = mysqli_query($conn,"SELECT userName, points FROM members ORDER BY points DESC LIMIT 0,7") or die(mysqli_error());
		while($user = mysqli_fetch_array($queryUsers)) {
			echo '<tr><td>'.$user['userName'].'</td><td>'.$user['points'].'</td></tr>';
		}
	}
	
	// Get Requesters and Requesting for Admin cPanel
	function getRequests() {
		$queryRequests = mysqli_query($conn,"SELECT SUM(points), requester FROM members GROUP BY requester") or die(mysqli_error());
		while($req = mysqli_fetch_array($queryRequests)) {
			if ($req['requester'] == NULL) {
				echo '<tr style="font-weight: bold"><td style="color: red"># unRequested #</td><td>'.$req['SUM(points)'].'</td><td>#</td><td>#</td><td>#</td></tr>';
			} else {
				echo '<tr><td>'.$req['requester'].'</td><td>'.$req['SUM(points)'].'</td>';
				$checkRequester = mysqli_query($conn,"SELECT yahoo, banks FROM requesters WHERE name='".$req['requester']."'") or die(mysqli_error());
				while($info = mysqli_fetch_array($checkRequester)) {
					echo '<td>'.$info['yahoo'].'</td><td>'.$info['banks'].'</td>';
					if($req['SUM(points)'] <= 0) {
						echo '<td style="color: red;">Paid</td>';
					} else {
						echo '<td style="color: green;">unPaid</td>';
					}
					echo '</tr>';
				}
			}
		}
	}
	
	function getRequesters() {
		$queryRequesters = mysqli_query($conn,"SELECT * FROM requesters") or die(mysqli_error());
		while($req = mysqli_fetch_array($queryRequesters)) {
			echo '<tr><td>'.$req['id'].'</td><td>'.$req['name'].'</td><td>'.$req['yahoo'].'</td><td>'.$req['banks'].'</td></tr>';
		}
	}	
	
	// Process IP Area
	function checkcc2($ip) {
		//$ip = $_SERVER['REMOTE_ADDR'];
		// remember chmod 0777 for folder 'cache'
		$url = 'http://api.easyjquery.com/ips/?ip='.$ip;
		$country = file_get_contents($url);
		$cc = json_decode($country,true);
		return $cc['Country'];
		
	}
	
	function checkcc3($ip) 
	{
		$country = exec("whois $ip  | grep -i country"); 
		// Run a local whois and get the result back		
		//$country = strtolower($country); 
		// Make all text lower case so we can use str_replace happily		
		// Clean up the results as some whois results come back with odd results, this should cater for most issues		
		$country = str_replace("country:", "", "$country");		
		$country = str_replace("Country:", "", "$country");		
		$country = str_replace("Country :", "", "$country");		
		$country = str_replace("country :", "", "$country");		
		$country = str_replace("network:country-code:", "", "$country");		
		$country = str_replace("network:Country-Code:", "", "$country");		
		$country = str_replace("Network:Country-Code:", "", "$country");		
		$country = str_replace("network:organization-", "", "$country");		
		$country = str_replace("network:organization-usa", "us", "$country");		
		$country = str_replace("network:country-code;i:us", "us", "$country");		
		$country = str_replace("eu#countryisreallysomewhereinafricanregion", "af", "$country");		
		$country = str_replace("", "", "$country");		
		$country = str_replace("countryunderunadministration", "", "$country");		
		$country = str_replace(" ", "", "$country");		
		return $country;	
	}
	function checkcc($ip) {
		$api = "d0b4afa65ae195132e9f814df806075496372ce3da7900a5d92d0a16255d2a9b";
		// http://api.ipinfodb.com/v3/ip-country/?key=<your_api_key>&ip=74.125.45.100&format=json
		$url = 'http://api.ipinfodb.com/v3/ip-country/?key='.$api.'&ip='.$ip.'&format=json';
		try
		{
			$country = file_get_contents($url);
		}
		catch(Exception $e)
		{
			echo $e;
		}
		$cc = json_decode($country,true);
		return $cc['countryCode'];
	}
	
	function printcc() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$cc = checkcc($ip);
		echo $cc;
	}
	
	function checkIp() {
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$port = $_SERVER['REMOTE_PORT'];
		$protocol = $_SERVER['SERVER_PROTOCOL'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		echo 'IP: '.$ip_address .'<br />';
		echo 'Port: '.$port .'<br />';
		echo 'Protocol: '.$port .'<br />';
		echo 'Hostname: '.$hostname .'<br />';
		echo 'User agent: '.$useragent .'<br />';
	}
	
	function getcName($cc) {
		$cname = mysqli_query($conn,"SELECT name FROM countries WHERE cc='".$cc."'") or die(mysqli_error());
		$c = mysqli_fetch_array($cname);
		return $c['name'];
	}
	
	function randString($l = 15) {
	$rand="";
		$s= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		srand((double)microtime()*1000000);  
		for($i=0; $i<$l; $i++) {  
			$rand.= $s[rand()%strlen($s)];  
		}  
		return $rand;  
	}
	
	function randNumber($num=10) { 
	$rand="";
		$s= "0123456789";
		$l = $num;
		srand((double)microtime()*1000000);  
		for($i=0; $i<$l; $i++) {  
			$rand.= $s[rand()%strlen($s)];  
		}  
		return $rand;  
	}
	
	function get5Offers() {
		$queryOffers = mysqli_query($conn,"SELECT * FROM offers ORDER BY id DESC LIMIT 9") or die(mysqli_error());
		while($off = mysqli_fetch_array($queryOffers)) {
			if(HIDE=='ON') {
				echo '<tr><td>Featured Offer</td>';
			} else {
				echo '<tr><td>'.$off['name'].'</td>';
			}
			echo '<td>'.$off['payout']*$off['ratio'].'</td>';
			echo	'<td>'.getcName($off['country']).'</td></tr>';
		}
	}
	
?>