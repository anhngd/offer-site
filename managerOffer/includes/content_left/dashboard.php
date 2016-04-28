<?php
	$ratio = 100;
	$dollar = "$";
	$multi = 
	$today = date("Y-m-d");
	$thismonth = date("m");
	$thisyear = date("Y");
	$numdays = cal_days_in_month(CAL_GREGORIAN, $thismonth, $thisyear);
	$startday = date("Y-m-d", mktime(0,0,0,$thismonth,1,$thisyear)) ;
	$endday = date("Y-m-d", mktime(0,0,0,$thismonth,$numdays,$thisyear)) ;
	$yesterday = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-1,date("Y"))) ;
	// All Time Clicks
	$queryAllTimeClicks = mysqli_query($conn,"SELECT COUNT(id) as alltimeclick FROM clicks") or die(mysqli_error());
	$result = mysqli_fetch_array($queryAllTimeClicks);
	$alltimeclick = $result['alltimeclick'];
	// All Time NET Revenues
	$queryallrev = mysqli_query($conn,"SELECT SUM(points) as allrev FROM leads") or die(mysqli_error());
	$result = mysqli_fetch_array($queryallrev);
	$allrev = round($result['allrev']/$ratio,2);
	// Today Clicks
	$querytodayClicks = mysqli_query($conn,"SELECT COUNT(id) as todayclick FROM clicks WHERE date(date)='$today'") or die(mysqli_error());
	$result = mysqli_fetch_array($querytodayClicks);
	$todayclick = $result['todayclick'];
	// Today leads
	$querytodayLeads = mysqli_query($conn,"SELECT COUNT(id) as todaylead FROM leads WHERE DATE(`date`)='$today'") or die(mysqli_error());
	$result = mysqli_fetch_array($querytodayLeads);
	$todaylead = $result['todaylead'];
	// Today Net Revenues
	$querytodayrev = mysqli_query($conn,"SELECT SUM(points) as todayrev FROM leads WHERE DATE(`date`)='$today'") or die(mysqli_error());
	$result = mysqli_fetch_array($querytodayrev);
	$todayrev = round($result['todayrev']/$ratio,2);
	
	// Yesterday Clicks
	$queryyesClicks = mysqli_query($conn,"SELECT COUNT(id) as yesclick FROM clicks WHERE DATE(date)='$yesterday'") or die(mysqli_error());
	$result = mysqli_fetch_array($queryyesClicks);
	$yesclick = $result['yesclick'];
	// Yesterday leads
	$queryyesLeads = mysqli_query($conn,"SELECT COUNT(id) as yeslead FROM leads WHERE DATE(`date`)='$yesterday'") or die(mysqli_error());
	$result = mysqli_fetch_array($queryyesLeads);
	$yeslead = $result['yeslead'];
	// Yesterday Net Revenues
	$queryyesrev = mysqli_query($conn,"SELECT SUM(points) as yesrev FROM leads WHERE DATE(`date`)='$yesterday'") or die(mysqli_error());
	$result = mysqli_fetch_array($queryyesrev);
	$yesrev = round($result['yesrev']/$ratio,2);
	
	// This Month Clicks
	$querymonthClicks = mysqli_query($conn,"SELECT COUNT(id) as monthclick FROM clicks WHERE (DATE(date)>='$startday' AND DATE(date)<='$endday')") or die(mysqli_error());
	$result = mysqli_fetch_array($querymonthClicks);
	$monthclick = $result['monthclick'];
	// Today leads
	$querymonthLeads = mysqli_query($conn,"SELECT COUNT(id) as monthlead FROM leads WHERE (DATE(`date`)>='$startday' AND DATE(`date`)<='$endday')") or die(mysqli_error());
	$result = mysqli_fetch_array($querymonthLeads);
	$monthlead = $result['monthlead'];
	// This Month NET Revenues
	$querymonthRev = mysqli_query($conn,"SELECT SUM(points) as monthrev FROM leads WHERE (DATE(`date`)>='$startday' AND DATE(`date`)<='$endday')") or die(mysqli_error());
	$result = mysqli_fetch_array($querymonthRev);
	$monthrev = round($result['monthrev']/$ratio,2);
	// Total Requesters
	$queryRequester = mysqli_query($conn,"SELECT COUNT(id) as totalreq FROM requesters") or die(mysqli_error());
	$result = mysqli_fetch_array($queryRequester);
	$totalreq = $result['totalreq'];
	// Requested Revenues
	$queryreqrev = mysqli_query($conn,"SELECT SUM(points) as reqrev FROM members WHERE requester<>''") or die(mysqli_error());
	$result = mysqli_fetch_array($queryreqrev);
	$reqrev = round($result['reqrev']/$ratio,2);
	
?>
	<div class="container_table">
		<table style="width:400px;margin:0px auto" id="list_members" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed">
			<tr>
				<td colspan='2'><h2 class="dashboard_blue"><center>Website Overview</center></h2></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				Today Clicks
				</span></td>
				<td><span>
				<?php echo $todayclick;?>
				</span></td>
			</tr>
				<tr>
				<td><span class="dashboard_blue">
				Today Leads
				</span></td>
				<td><span>
				<?php echo $todaylead;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				Today Earnings
				</span></td>
				<td><span>
				<?php echo $dollar.$todayrev;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				Yesterday Clicks
				</span></td>
				<td><span>
				<?php echo $yesclick;?>			
				</span></td>
			</tr>
			<tr>
			<td><span class="dashboard_blue">
				Yesterday Leads
				</span></td>
				<td><span>
				<?php echo $yeslead;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				Yesterday Earnings
				</span></td>
				<td><span>
				<?php echo $dollar,"".$yesrev;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				MTD Clicks
				</span></td>
				<td><span>
				<?php echo $monthclick;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				MTD Leads
				</span></td>
				<td><span>
				<?php echo $monthlead;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				MTD Earnings
				</span></td>
				<td><span>
				<?php echo $dollar.$monthrev;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				All Time Clicks
				</span></td>
				<td><span>
				<?php echo $alltimeclick;?>			
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				All Time Earnings
				</span></td>
				<td><span>
				<?php echo $dollar.$allrev;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				Requesters
				</span></td>
				<td><span>
				<?php echo $totalreq;?>
				</span></td>
			</tr>
			<tr>
				<td><span class="dashboard_blue">
				Requested Earnings
				</span></td>
				<td><span>
				<?php echo $dollar.$reqrev;?>
				</span></td>
			</tr>
</table>
</div>