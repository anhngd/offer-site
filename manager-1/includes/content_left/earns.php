<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>EARN</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">

	<!--<div class="searchbox">
		<form action="" method="POST">
			<input class="text" type="text" name="name" value="<?php if(isset($_POST['name']))echo $_POST['name'];?>"/>
			<input type="submit" name="searchOffer" value="Search" />
		</form>
	</div>-->
<?php
$ip = $_SERVER['REMOTE_ADDR'];
//$cc = checkcc($ip);
$os_earn=addslashes($_GET['earns']);
$codelogin_query=mysqli_query($conn,"Select codelogin from members where userName='".addslashes($_SESSION['userName'])."' and userPassword='".addslashes($_SESSION['userPassword'])."'");
$codelogin=mysqli_fetch_array($codelogin_query);
$codeloginBase64=base64_encode(base64_encode($codelogin['codelogin']));
$groupName = $_SESSION['groupName'];
$queryWalls = mysqli_query($conn,"SELECT * FROM walls WHERE status='ON' and OS='$os_earn'") or die(mysqli_error());
?>
<div class="container_table">
<?php
if(mysqli_num_rows($queryWalls))
{
	echo "<table id=\"list_members\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered table-striped table-condensed\">";
	echo "<tr><td colspan='6'><center><h2>OFFER WALLS</h2></center></td></tr>";
	echo "<tr><td>ID</td><td>NAME</td><td><center>LINK EARN</center></td><td><center>EARN</center></td></tr>";
	while($wall = mysqli_fetch_array($queryWalls)) 
	{
		echo "<tr><td>".$wall['id']."</td><td>".$wall['name']."</td><td><input style='width:97% !important;' type='text' value=\"".$domainsite."/earnwall/".base64_encode($wall['id']."_".$codelogin['codelogin'])."\"></td><td><center><a style='color:#2D89EF' href='".$domainsite."/earnwall/".base64_encode($wall['id']."_".$codelogin['codelogin'])."' target='_blank'>OPEN APP</a></center></td></tr>";
	}
	echo "</table>";
}
?>	
</div>
<div class="container_table">
<?php
$queryoffers = mysqli_query($conn,"SELECT offers.id as id,offers.offerId as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.OS='$os_earn' and offers.network=networks.name AND networks.status = 'ON' AND offers.status='ON') ORDER BY offers.name");
if(mysqli_num_rows($queryoffers))
{
	echo "<form action=\"./export_list_earn.php\" method='post'>";
	echo "<table id=\"list_members\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered table-striped table-condensed\">";
	echo "<input name='os' value='$os_earn' type='hidden'>";
	echo "<input name='codelogin' value='$codeloginBase64' type='hidden'>";
	echo "<input name='groupId' value='$groupName' type='hidden'>";
	echo "<tr><td colspan='7'><center><h2>OFFER BANNER</h2></center></td></tr>";
	echo "<tr><td>ID</td><td>IMAGE</td><td>Points</td><td><center>Offer Name</center></td><td><center>Description</center></td><td><center>Link Earn</center></td><td><center>Country</center></td></tr>";
	while($offer = mysqli_fetch_assoc($queryoffers)) 
	{
		$query_get_list_cc=mysqli_query($conn,"select country_cc from offers_country where offer_id='".$offer['offerId']."'");
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
		$rewards = $offer['payout']*$offer['ratio'];
?>
			<tr>
				<td>
					<input type='checkbox' name='id_export[]' value='<?php echo $offer['id'];?>'/><?php echo $offer['id'];?>
				</td>
				<td>
					<img src="<?php echo $offer['imageUrl']; ?>" width="40" height="40" />
				</td>
				<td>
					<?php echo $rewards." ".vcName;?>
				</td>
				<td>
					<?php echo $offer['offerName'];?>
				</td>
				<td>
					<?php echo $offer['des'];?>
				</td>
				<td>
					<input type="text" value="<?php echo $domainsite."/earn/".base64_encode($offer['id']."_".$codelogin['codelogin']); ?>">
				</td>
				<td>
					<?php echo $list_cc;?>
				</td>
				
			</tr>
<?php
	}
	$link_earn=$domainsite."/earnall/index.php?codelogin=".base64_encode($os_earn[0]."_".$codelogin['codelogin']);
	echo "<tr><td colspan='7'>Earn with country: <a href='$link_earn'>$link_earn</a></td></tr>";

	?>
	</table>
	<input name="export_offer" class="btn btn-info button_tb manager mousepointer" type="submit" value="EXPORT LIST" title="ON selected offer(s)">
	</form>
	<?php
}/*
if(isset($_POST['searchOffer']) && $_POST['name']!=NULL)
{
	$sql = mysqli_query($conn,"SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.name LIKE '%".$name."%' AND offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON' AND offers.status='ON')") or die(mysqli_error());
}
else
{
	$sql = mysqli_query($conn,"SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON' AND offers.status='ON')") or die(mysqli_error()); 
}
$row = mysqli_fetch_row($sql); 
$total_records = $row[0]; */
?>

</div>
</div>
</div>