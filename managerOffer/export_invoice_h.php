<?php
	include("./function/config.php");
	include("./function/fnc.php");

	if(isset($_GET['from']))
	{
		$from=addslashes($_GET['from']);
		if($from=="")
		{
			$from=$first_week;
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
			$to=$last_week;
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
	
	if(isset($_GET['page'])&&$_GET['page']>0)
	{
		$limit=addslashes($_GET['page'])*$numSplitPage;
		$page=addslashes($_GET['page']);
	}
	else
	{
		$limit='0';
		$page='0';
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
		$group_by_name=",network";
		$query_by_name=" and network='".addslashes($_GET['network'])."'";
		$request_by_name="&network=".addslashes($_GET['network']);
	}
	else
	{
		$offerId="";
		$request_by_name="";
		$group_by_name="";
		$query_by_name="";
	}
	$userName="";
	if(isset($_GET['userName'])&&$_GET['userName']!="")
	{
		$userName=addslashes($_GET['userName']);
		$query_by_name.=" and userName='".$userName."'";
	}

	if(isset($_SESSION['isMod']))
	{
		$groupName=addslashes($_SESSION['isMod']);
	}
	else
	if(isset($_SESSION['isMember']))
	{
		$userName=addslashes($_SESSION['isMember']);
		$query_by_name.=" and userName='".$userName."'";	
	}
	
	if(isset($_GET['option_paid'])&&($_GET['option_paid']=="paid"||$_GET['option_paid']=="unpaid"))
	{
		$option_paid=addslashes($_GET['option_paid']);
		$query_by_name.=" and status='".strtoupper($option_paid)."'";
	}
	if(isset($groupName))
	{
		$query_point=mysqli_query($conn,"Select invoice.points,invoice.userName,invoice.offerName,invoice.network,`invoice`.`from`,`invoice`.`to`,invoice.date_create,invoice.status from invoice inner join members ON invoice.userName=members.userName where DATE(invoice.date_create)>='$from' and DATE(invoice.date_create)<='$to' and groupName='$groupName' $query_by_name order by invoice.userName,invoice.points desc") or die (mysqli_error());

	}
	else
	{
		$query_point=mysqli_query($conn,"Select points,userName,offerName,network,`from`,`to`,date_create,status from invoice where DATE(date_create)>='$from' and DATE(date_create)<='$to' $query_by_name order by userName,points desc") or die (mysqli_error());

	}
	if(mysqli_num_rows($query_point))
	{
		$today=date("Y-m-d");
		$filename = "Export_Invoice_$today.xls"; // File Name
			// Download file
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		$row="UserName\tNetwork\tOffer Name\tPoint\tMoney\tFrom\tTo\tDate create\tStatus\tName\tGroup Name\tBank\tEmail\tPhone\tCity\r\n";
		echo $row;
		while($row_point=mysqli_fetch_array($query_point))
		{
			$query_info=mysqli_query($conn,"Select name, bank, email, phone, city,groupName from members where userName='".$row_point['userName']."'");
			$row_info=mysqli_fetch_array($query_info);
			$sumpoints=$row_point['points'];
			$row=$row_point['userName']."\t";
			$row.=$row_point['network']."\t";
			$row.=$row_point['offerName']."\t";
			$row.=$sumpoints."\t";
			$row.=formatMoney($sumpoints*$ratio_vnd)."\t\t";
			$row.=$row_point['from']."\t";
			$row.=$row_point['to']."\t";
			$row.=$row_point['date_create']."\t";
			$row.=$row_point['status']."\t";
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
