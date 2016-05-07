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
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">OVERVIEW</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table class="table no-margin">
          <tbody>
            <tr>
                <td>Today Clicks</td>
			    <td><?php echo $todayclick;?></td>              
            </tr>
            <tr>
				<td>Today Leads</td>
				<td><?php echo $todaylead;?></td>
			</tr>
			<tr>
				<td>Today Earnings</td>
				<td><?php echo $dollar.$todayrev;?></td>
			</tr>
			<tr>
				<td>Yesterday Clicks</td>
				<td><?php echo $yesclick;?></td>
			</tr>
			<tr>
				<td>Yesterday Leads</td>
				<td><?php echo $yeslead;?></td>
			</tr>
			<tr>
				<td>Yesterday Earnings</td>
				<td><?php echo $dollar,"".$yesrev;?></td>
			</tr>
			<tr>
				<td>MTD Clicks</td>
				<td><?php echo $monthclick;?></td>
			</tr>
			<tr>
				<td>MTD Leads</td>
				<td><?php echo $monthlead;?></td>
			</tr>
			<tr>
				<td>MTD Earnings</td>
				<td><?php echo $dollar.$monthrev;?></td>
			</tr>
			<tr>
				<td>All Time Clicks</td>
				<td><?php echo $alltimeclick;?></td>
			</tr>
			<tr>
				<td>All Time Earnings</td>
				<td><?php echo $dollar.$allrev;?></td>
			</tr>
			<tr>
				<td>Requesters</td>
				<td><?php echo $totalreq;?></td>
			</tr>
			<tr>
				<td>Requested Earnings</td>
				<td><?php echo $dollar.$reqrev;?></td>
			</tr>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- /.box -->	