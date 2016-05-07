<?php
	include("./function/config.php");
	include("./function/fnc.php");

	if(isset($_GET['from']))
	{
		$from=addslashes($_GET['from']);
		if($from=="")
		{
			$from=$first_month;
		}
		else
		{
			$from=date('Y-m-d',strtotime(addslashes($_GET['from'])));
		}
	}
	else
	{
		$from=$first_month;
	}
	if(isset($_GET['to']))
	{
		$to=addslashes($_GET['to']);
		if($to=="")
		{
			$to=$last_month;
		}
		else
		{
			$to=date('Y-m-d',strtotime(addslashes($_GET['to'])));
		}
	}
	else
	{
		$to=$last_month;
	}
	if(isset($_GET['timezone']))
	{
		$timezone=addslashes($_GET['timezone']);
		$from=convert_timezone($timezone,$from);
		$to=convert_timezone($timezone,$to);
	}
	
	
	if(isset($_GET['offerId'])&&$_GET['offerId']!="")
	{
		$offerId=addslashes($_GET['offerId']);
		$group_by_name=",offerName";
		$query_offer=mysqli_query($conn,"Select name from offers where offerId='$offerId'");
		$row_offer_name=mysqli_fetch_array($query_offer);
		$request_by_name="&offerId=".addslashes($_GET['offerId']);
		$query_by_name=" and offerName='".$row_offer_name['name']."'";
	}
	else
	if(isset($_GET['network'])&&$_GET['network']!="")
	{
		$offerId="";
		$group_by_name=",offerNwk";
		$query_by_name=" and offerNwk='".addslashes($_GET['network'])."'";
		$request_by_name="&network=".addslashes($_GET['network']);
	}
	else
	{
		$offerId="";
		$request_by_name="";
		$group_by_name="";
		$query_by_name="";
	}	
		
	$query_point=mysqli_query($conn,"Select sum(points) as sumpoints,userName,offerName,offerNwk from shoutbox where DATE(date)>='$from' and DATE(date)<='$to' and status='NONE' $query_by_name group by userName$group_by_name order by userName,sumpoints,offerNwk desc") or die (mysqli_error());
	if(mysqli_num_rows($query_point))
	{
		$today=date("Y-m-d");
		$filename = "Export_Invoice_$today.xls"; // File Name
			// Download file
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		$row="UserName\t";
		$row.=($group_by_name==",offerNwk")?"Network\t":"";
		$row.=($group_by_name==",offerName")?"Offer Name\t":"";
		$row.="Point\tMoney\t\tName\tGroup Name\tBank\tEmail\tPhone\tCity\r\n";
		echo $row;
		while($row_point=mysqli_fetch_array($query_point))
		{
			$query_info=mysqli_query($conn,"Select name, bank, email, phone, city,groupName from members where userName='".$row_point['userName']."'");
			$row_info=mysqli_fetch_array($query_info);
			$sumpoints=$row_point['sumpoints'];
			$row=$row_point['userName']."\t";
			if($group_by_name==",offerNwk")
			{
				$row.=$row_point['offerNwk']."\t";
			}
			if($group_by_name==",offerName")
			{
				$row.=$row_point['offerName']."\t";
			}
			$row.=$sumpoints."\t";
			$row.=formatMoney($sumpoints*$ratio_vnd)."\t\t";
			$row.=$row_info['name']."\t";
			$row.=$row_info['groupName']."\t";
			$row.=$row_info['bank']."\t";
			$row.=$row_info['email']."\t";
			$row.=$row_info['phone']."\t";
			$row.=$row_info['phone']."\t";
			$row.=$row_info['city']."\r\n";
			echo $row;
		}
	}
	else
	{
		echo "DATA DOES NOT EXIT";
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
