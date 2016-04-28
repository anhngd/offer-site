<?php
	include("./function/config.php");
// Connection 
	if(isset($_GET['from'])&&isset($_GET['to']))
	{
		$query_admin=mysqli_query($conn,"Select money_support from admin");
		$row_admin=mysqli_fetch_array($query_admin);
		if($_GET['from']=="")
		{
			$from=$first_week;
		}
		else
		{
			$from=addslashes($_GET['from']);
		}
		if($_GET['to']=="")
		{
			$to=$last_week;
		}
		else
		{
			$to=addslashes($_GET['to']);
		}
		if(isset($_GET['timezone']))
		{
			$timezone=addslashes($_GET['timezone']);
			$from=convert_timezone($timezone,$from);
			$to=convert_timezone($timezone,$to);
		}
		if(isset($_GET['network'])&&$_GET['network']!="")
		{
			$query_network="and offerNwk='".$_GET['network']."'";
		}
		else
		{
			$query_network="";
		}
		$filename = "$from-to-$to.xls"; // File Name
		// Download file
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		$user_query = mysqli_query($conn,'select userName,points from members order by points desc');
		// Write data to file
		$flag = false;
		$sumPoint=0;
		while ($row = mysqli_fetch_assoc($user_query)) {
			$query_point=mysqli_query($conn,"Select sum(points) as sumpoints from leads where DATE(date)>='$from' and DATE(date)<='$to' and userName='".addslashes($row['userName'])."' $query_network") or die (mysqli_error());
			$row_point=mysqli_fetch_array($query_point);
			if (!$flag) {
				// display field/column names as first row
				echo "UserName\tPoint\tMoney\t$money_support% Money\r\n";
				$flag = true;
			}
			if($row_point['sumpoints']==0)
			{
				continue;
			}
			
			$sumPoint+=$row_point['sumpoints'];
			echo $row['userName']."\t".$row_point['sumpoints']."\t".formatMoney($row_point['sumpoints']*200)." VND\t".formatMoney($row_point['sumpoints']*200*$row_admin['money_support']/100)." VND\r\n";
		}
		echo "SUM\t".$sumPoint."\t".formatMoney($sumPoint*200)." VND\t".formatMoney($sumPoint*200*$row_admin['money_support']/100)." VND\r\n";
	}
	function formatMoney($number, $fractional=false)
	{
		if ($fractional) {
			$number = sprintf('%.2f', $number); 
		} 
		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
			if ($replaced != $number) { 
				$number = $replaced; 
			} else {
				break; 
			}
		}
		return $number; 
	}
?>