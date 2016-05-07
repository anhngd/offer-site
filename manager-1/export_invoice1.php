<?php
	include("./function/config.php");
// Connection 
	if(isset($_GET['month']))
	{
		$month_today=$date_today->format("m");
		$m_30day=addslashes($_GET['month']);
		$Y_m_30day = $date_today->format("Y-").$m_30day;
		
		
		$query_invoice=mysqli_query($conn,"Select invoice.userName,sum(invoice.leads) as sum_lead,sum(invoice.clicks) as sum_click,sum(invoice.amount_w) as sum_money from invoice where invoice.month=$m_30day and invoice.status='paid' group by userName");
		if(mysqli_num_rows($query_invoice))
		{
			$filename = "Month $m_30day.xls"; // File Name
				// Download file
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Type: application/vnd.ms-excel");
			$flag = false;
			$sumPoint=0;
			while($invoice = mysqli_fetch_array($query_invoice)) 
			{
				$query_user=mysqli_query($conn,"Select bank,name,phone,city,skype from members where userName='".$invoice['userName']."'");
				$row_user=mysqli_fetch_array($query_user);
				// Write data to file
			
					if (!$flag) {
						// display field/column names as first row
						echo "UserName\tClick\tLeads\tCVR\tRPC\tRPA\tMoney\t$money_support% Money\tBank\tPhone\tName\tCity\tSkype\r\n";
						$flag = true;
					}
					
					$sumPoint+=round($invoice['sum_money'],3)*$invoice['sum_lead'];
					$cvr=($invoice['sum_lead']!=0)?round(($invoice['sum_lead']/$invoice['sum_click']*100),2):0;
					$cpc=($invoice['sum_money']!=0&&$invoice['sum_lead']!=0)?round(($invoice['sum_money'])*$invoice['sum_lead']/$invoice['sum_click'],4):0;
					$cpa=($invoice['sum_money']!=0&&$invoice['sum_lead']!=0)?round($invoice['sum_money']*$invoice['sum_lead']/$invoice['sum_click'],2):0;
					echo $invoice['userName']."\t".$invoice['sum_click']."\t".$invoice['sum_lead']."\t".$cvr."\t".$cpc."\t".$cpa."\t$".round($invoice['sum_money'],3)*$invoice['sum_lead']."\t$".formatMoney(round($invoice['sum_money'],3)*$invoice['sum_lead']*$money_support/100)."\t".$row_user['bank']."\t".$row_user['phone']."\t".$row_user['name']."\t".$row_user['city']."\t".$row_user['bank']."\r\n";
			}
			echo "SUM\t\t\t\t\t\t$".formatMoney($sumPoint)."\t$".formatMoney($sumPoint*$money_support/100)."\r\n";

		}
	}
	
	if(isset($_GET['week']))
	{
		$month_today=$date_today->format("w");
		$m_30day=addslashes($_GET['week']);
		$Y_m_30day = $date_today->format("Y-").$m_30day;
		
		
		$query_invoice=mysqli_query($conn,"Select invoice.userName,sum(invoice.leads) as sum_lead,sum(invoice.clicks) as sum_click,sum(invoice.amount_w) as sum_money from invoice where invoice.week=$m_30day and invoice.status='paid' group by userName");
		if(mysqli_num_rows($query_invoice))
		{
			$filename = "Week $m_30day.xls"; // File Name
				// Download file
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Type: application/vnd.ms-excel");
			$flag = false;
			$sumPoint=0;
			while($invoice = mysqli_fetch_array($query_invoice)) 
			{
				$query_user=mysqli_query($conn,"Select bank,name,phone,city,skype from members where userName='".$invoice['userName']."'");
				$row_user=mysqli_fetch_array($query_user);
				// Write data to file
			
					if (!$flag) {
						// display field/column names as first row
						echo "UserName\tClick\tLeads\tCVR\tRPC\tRPA\tMoney\t$money_support% Money\tBank\tPhone\tName\tCity\tSkype\r\n";
						$flag = true;
					}
					
					$sumPoint+=round($invoice['sum_money'],3)*$invoice['sum_lead'];
					$cvr=($invoice['sum_lead']!=0)?round(($invoice['sum_lead']/$invoice['sum_click']*100),2):0;
					$cpc=($invoice['sum_money']!=0&&$invoice['sum_lead']!=0)?round(($invoice['sum_money'])*$invoice['sum_lead']/$invoice['sum_click'],4):0;
					$cpa=($invoice['sum_money']!=0&&$invoice['sum_lead']!=0)?round($invoice['sum_money']*$invoice['sum_lead']/$invoice['sum_click'],2):0;
					echo $invoice['userName']."\t".$invoice['sum_click']."\t".$invoice['sum_lead']."\t".$cvr."\t".$cpc."\t".$cpa."\t$".round($invoice['sum_money'],3)*$invoice['sum_lead']."\t$".formatMoney(round($invoice['sum_money'],3)*$invoice['sum_lead']*$money_support/100)."\t".$row_user['bank']."\t".$row_user['phone']."\t".$row_user['name']."\t".$row_user['city']."\t".$row_user['bank']."\r\n";
			}
			echo "SUM\t\t\t\t\t\t$".formatMoney($sumPoint)."\t$".formatMoney($sumPoint*$money_support/100)."\r\n";

		}
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