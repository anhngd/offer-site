<?php
	$userName=addslashes($_SESSION['userName']);
	$point_day_query=mysqli_query($conn,"Select sum(points) as sumpoints from shoutbox where DATE(date)='$today' and userName='$userName'") or die (mysqli_error());
	$point_week_query=mysqli_query($conn,"Select sum(points) as sumpoints from shoutbox where DATE(date)>='$first_week' and DATE(date)<='$last_week' and userName='$userName'") or die (mysqli_error());
	$point_month_query=mysqli_query($conn,"Select sum(points) as sumpoints from shoutbox where DATE(date)>='$first_month' and DATE(date)<='$last_month' and userName='$userName'") or die (mysqli_error());
	$point_year_query=mysqli_query($conn,"Select sum(points) as sumpoints from shoutbox where DATE(date)>='$first_year' and DATE(date)<='$last_year' and userName='$userName'") or die (mysqli_error());
	$point_day=mysqli_fetch_array($point_day_query);
	$point_week=mysqli_fetch_array($point_week_query);
	$point_month=mysqli_fetch_array($point_month_query);
	$point_year=mysqli_fetch_array($point_year_query);
	$point_day=($point_day['sumpoints']==NULL)?0:$point_day['sumpoints'];
	$point_week=($point_week['sumpoints']==NULL)?0:$point_week['sumpoints'];
	$point_month=($point_month['sumpoints']==NULL)?0:$point_month['sumpoints'];
	$point_year=($point_year['sumpoints']==NULL)?0:$point_year['sumpoints'];

	
?>
<div class="row-fluid">
	<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
		<div class="number"><?php echo $point_day;?> point</div>
		<div class="title"></div>
		<div class="footer">
			<a href="#">TODAY</a>
		</div>	
	</div>
	<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
		<div class="number"><?php echo $point_week;?> point</div>
		<div class="title"></div>
		<div class="footer">
			<a href="#">WEEKLY</a>
		</div>
	</div>
	<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
		<div class="number"><?php echo $point_month;?> point</div>
		<div class="title"></div>
		<div class="footer">
			<a href="#">MONTHLY</a>
		</div>
	</div>
	<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
		<div class="number"><?php echo $point_year;?> point</div>
		<div class="title"></div>
		<div class="footer">
			<a href="#">YEARLY</a>
		</div>
	</div>	
</div>
<?php
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
	$from="";
	$to="";
	$nwk="";
	if(isset($_GET['from'])&&$_GET['from']!="")
	{
		$from=date('Y-m-d',strtotime(addslashes($_GET['from'])));
	}
	if(isset($_GET['to'])&&$_GET['to']!="")
	{
		$t=date('Y-m-d',strtotime(addslashes($_GET['to'])));
	}
	if(isset($_GET['network']))
	{
		$nwk = addslashes($_GET['network']);
	}
	if(isset($_GET['country']))
	{
		$ccode = addslashes($_GET['country']);
	}


	$query_nwk="";
	$query_username="";
	if($from=="")
	{
		$from=$first_year;
	}
	if($to=="")
	{
		$to=date('y-m-d',time());
	}
	if($nwk!="")
	{
		$query_nwk="AND offerNwk='".$nwk."'";
	}
	$query_username="AND username='".$userName."'";
	$query_where=$query_nwk." ".$query_username;
	$sumLeads = mysqli_query($conn,"SELECT id FROM leads WHERE (DATE(date)>='".$from."' AND DATE(date)<='".$to."' $query_where)") or die(mysqli_error());
	$lead_query = mysqli_query($conn,"SELECT * FROM leads WHERE (DATE(date)>='".$from."' AND DATE(date)<='".$to."' $query_where) ORDER BY id DESC limit $limit,$numSplitPage") or die(mysqli_error());
?>
<div class="box span12 form_member">
	<div class="box-header" data-original-title>
		<h2><i class="halflings-icon user"></i><span class="break"></span>STATISTIC MEMBERS</h2>
		<div class="box-icon">
			<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
			<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
		</div>
	</div>
<div class="box-content-static">
	<div class="row-fluid">
		<div class="span2">
			<a href='./index.php?statistic=yes&from=<?php echo $first_week;?>&to=<?php echo $last_week;?>&report=leads'><span class="label label-success">Week</span></a>
			<a href='./index.php?statistic=yes&from=<?php echo $first_month;?>&to=<?php echo $last_month;?>&report=leads'><span class="label label-warning">Month</span></a>
			<a href='./index.php?statistic=yes&from=<?php echo $first_year;?>&to=<?php echo $last_year;?>&report=leads'><span class="label label-important">Year</span></a>
		</div>
		<form action="index.php?report=leads" method="get">
			<input name="report" value="leads" hidden="">
			From
			<input type="text" style="width:100px !important" id="date01" name="from" class="datepicker" value="<?php echo $from;?>"/>
			to
			<input type="text" style="width:100px !important" id="date02" name="to" class="datepicker" value="<?php echo $to;?>"/>
			<select style="width:150px !important" name="network">
				<option value="">Network</option>
				<?php 						
				$network = mysqli_query($conn,"SELECT * FROM networks") or die(mysqli_error());
				while($row_nwk = mysqli_fetch_array($network)) 
				{
				?>
				<option value="<?php echo $row_nwk['name'];?>" <?php if(isset($_GET['network'])&&$row_nwk['name']==$_GET['network']) { echo 'selected="selected"';}?>><?php echo $row_nwk['name'];?></option>
				<?php 
				}
				$wall = mysqli_query($conn,"SELECT * FROM walls") or die(mysqli_error());
					while($w = mysqli_fetch_array($wall)) {
				?>
				<option value="<?php echo $w['name'];?>" <?php if(isset($_GET['network'])&&$w['name']==$_GET['network']) { echo 'selected="selected"';}?>><?php echo $w['name'];?></option>
				<?php } ?>
			</select>
			<input type="submit" value="Filter" class="btn btn-primary" name="filter" />
			<span class="reset"><a href="index.php?report=leads">Reset Filter</a></span>		
		</form>
	</div>
	<?php
			
	?>
		<div class="container_table">
			<table class="table table-striped table-bordered bootstrap-datatable">
				  <thead>
				  		<tr><td colspan="11"><center><h2>Statistics from the date <?php echo $from;?> to <?php echo $to;?></h2></center></td></tr>
					  <tr>
						  <th colspan='3'><center>OFFER</center></th>
						  <th rowspan='3'><center>IP</center></th>
						  <th rowspan='3'><center>POINTS</center></th>
						  <th rowspan='3'><center>DATE</center></th>
					  </tr>
					  <tr>
						  <th><center>ID</center></th>
						  <th><center>NAME</center></th>
						  <th><center>NETWORK</center></th>
					  </tr>
				  </thead>   
				  <tbody>
				  <?php
				  $stt=1;
				  if(mysqli_num_rows($lead_query)!=0)
				  {
						while($array_leads=mysqli_fetch_array($lead_query))
						{
							if($stt%2==0)
							{
								$class="odd";
							}
							else
							{
								$class="even";
							}
						  ?>
							<tr class="<?php echo $class?>">
								<td class="center"><?php echo $array_leads['offerId']; ?></td>
								<td class="center"><?php echo $array_leads['offerName']; ?></td>
								<td class="center"><?php echo $array_leads['offerNwk'];  ?></td>
								<td class="center"><?php echo $array_leads['ip'];  ?></td>
								<td class="center"><?php echo $array_leads['points']; ?></td>
								<td class="center"><?php echo $array_leads['date'];  ?></td>
							</tr>
							<?php
						$stt++;
						}
					}
					?>
				  </tbody>
			  </table>    
		  </div>
		<?php
		$num_row_leads=mysqli_num_rows($sumLeads);
		$numRows=round($num_row_leads/$numSplitPage);
		if(($numRows*$numSplitPage)<$num_row_leads)
		{
			$numRows++;
		}
		if($numRows>0)
		{
		?>
		<div class="row-fluid">
		<div class="span12 center">
			<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>
				<?php
					if($page!='0')
					{
						echo "<li class='prev'>";
						echo "<a href='./index.php?statistic=yes&page=0&network=$nwk&from=$from&to=$to&report=leads&report=leads'>← Previous</a>";
						echo "</li>";
					}
					else
					{
						echo "<li class='prev disabled'>";
						echo "<a>← Previous</a>";
						echo "</li>";
					}
					for($i=1;$i<$numRows;$i++)
					{
						if($i==($page+1))
						{
						echo "<li class='active'><a>$i</a></li>";
						}
						else
						{
						echo "<li><a href='./index.php?statistic=yes&page=".($i-1)."&network=$nwk&from=$from&to=$to&report=leads'>$i</a></li>";
						}
					}
					if($page>=$numRows-2)
					{
						echo "<li class='next disabled'><a>Next → </a></li>";
					}
					else
					{
						echo "<li class='next'><a href='./index.php?statistic=yes&page=".($numRows-2)."&network=$nwk&from=$from&to=$to&report=leads'>Next → </a></li>";
					}
				?>
				
			</ul>
			</div>
		</div>
		</div>
		<?php
		}
		?>
	</div>
</div><!--/span-->