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
	$username="";
	$nwk="";
	$offerId="";
	if(isset($_GET['from'])&&$_GET['from']!="")
	{
		$from=date('Y-m-d',strtotime(addslashes($_GET['from'])));
	}
	if(isset($_GET['to'])&&$_GET['to']!="")
	{
		$to=date('Y-m-d',strtotime(addslashes($_GET['to'])));
	}
	if(isset($_GET['network']))
	{
		$nwk = addslashes($_GET['network']);
	}
	if(isset($_GET['offerId']))
	{
		$offerId = addslashes($_GET['offerId']);
	}
	if(isset($_GET['country']))
	{
		$ccode = addslashes($_GET['country']);
	}
	if(isset($_GET['username']))
	{
		$username = addslashes($_GET['username']);
	}
	
	$query_nwk="";
	$query_username="";
	if($from=="")
	{
		$from=$first_week;
	}
	if($to=="")
	{
		$to=date('y-m-d',time());
	}
	if($offerId!="")
	{
		$query_nwk="AND offerId='".$offerId."'";
	}
	else
	if($nwk!="")
	{
		$query_nwk="AND offerNwk='".$nwk."'";
	}
	
	if($username!="")
	{
		$query_username="AND username='".$username."'";
	}
	
	$sumClicks=mysqli_query($conn,"Select id from clicks where DATE(date)>='$from' and DATE(date)<='$to' $query_username $query_nwk");
	$clicks_query=mysqli_query($conn,"Select * from clicks where DATE(date)>='$from' and DATE(date)<='$to' $query_username $query_nwk ORDER BY id DESC limit $limit,$numSplitPage") or die (mysqli_error());
?>
<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>REPORT CLICKS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">
<div class="row-fluid">
	<div class="input_form_filter">
		<a href='./index.php?report=clicks&from=<?php echo $first_week;?>&to=<?php echo $last_week;?>'><span class="label label-success">Tuần</span></a>
		<a href='./index.php?report=clicks&from=<?php echo $first_month;?>&to=<?php echo $last_month;?>'><span class="label label-warning">Tháng</span></a>
		<a href='./index.php?report=clicks&from=<?php echo $first_year;?>&to=<?php echo $last_year;?>'><span class="label label-important">Năm</span></a>
	</div>
	<form action="index.php?report=clicks" method="get">
	<div class="input_form_filter">
	Username
	<input type="text" style="width:100px !important" name="username" value="<?php echo $username;?>"/>
	</div>
	<div class="input_form_filter">
			FROM: <input type="text" style="width:100px !important" name="from" class="input-xlarge datepicker" id="date01" value="<?php echo $from;?>">
	</div>
	<div class="input_form_filter">
			TO: <input type="text" style="width:100px !important" name="to" class="input-xlarge datepicker" id="date02" value="<?php echo $to;?>"> 
			<input hidden="hidden" name="report" value="clicks" />
	</div>
	<div class="input_form_filter">
				<select name="network"  style="max-width:150px">
					<option value="">Network</option>
					<?php 						
					$network = mysqli_query($conn,"SELECT offerNwk FROM shoutbox where status='NONE' group by offerNwk") or die(mysqli_error());
					while($row_nwk = mysqli_fetch_array($network)) {
					?>
					<option value="<?php echo $row_nwk['offerNwk'];?>" <?php if(isset($_GET['network'])&&$_GET['network']==$row_nwk['offerNwk']) { echo 'selected="selected"';}?>><?php echo $row_nwk['offerNwk'];?></option>
					<?php }
					?>
				</select>
				OFFER ID <input type="text" style="width:100px !important" name="offerId" class="input-xlarge " value="">
		</div>
	<div class="input_form_filter">
		<input type="submit" class="btn btn-primary" value="Filter" />
		<a href="./index.php?report=clicks">Reset</a>
	</div>
	</form>
</div>

<div class="container_table">
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>ID</th>
			<th>Date</th>
			<th>Username</th>
			<th>Offer</th>
			<th>Points</th>
			<th>Country</th>
			<th>Network</th>
			<th>IP</th>
			<th>User Agent</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		while($click = mysqli_fetch_assoc($clicks_query)) {
			echo '<tr>';
			echo '<td>' . $click['id'] . '</td>';
			echo '<td>' . $click['date'] . '</td>';
			echo '<td>'. $click['userName'] .'</td>';
			echo '<td>'. $click['offerName'] .'</td>';
			echo '<td>'. $click['points'] .'</td>';
			echo '<td>'. $click['offerCC'] .'</td>';
			echo '<td>'. $click['offerNwk'] .'</td>';
			echo '<td>'. $click['ip'] .'</td>';
			//echo '<td>'. $click['port'] .'</td>';
			//echo '<td>'. $click['protocol'] .'</td>';
			//echo '<td>'. $click['hostName'] .'</td>';
			echo '<td>'. $click['userAgent'] .'</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>
</div>
<?php
	$num_row_clicks=mysqli_num_rows($sumClicks);
	$numRows=round($num_row_clicks/$numSplitPage);
	if(($numRows*$numSplitPage)<$num_row_clicks)
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
					echo "<a href='./index.php?report=clicks&page=0&from=$from&to=$to&username=$username&network=$nwk&offerId=$offerId'>← Previous</a>";
					echo "</li>";
				}
				else
				{
					echo "<li class='prev disabled'>";
					echo "<a>← Previous</a>";
					echo "</li>";
				}
				for($i=1;$i<=$numRows;$i++)
				{
					if($i==($page+1))
					{
					echo "<li class='active'><a>$i</a></li>";
					}
					else
					{
					echo "<li><a href='./index.php?report=clicks&page=".($i-1)."&username=$username&from=$from&to=$to&network=$nwk&offerId=$offerId'>$i</a></li>";
					}
				}
				if($page>=$numRows-1)
				{
					echo "<li class='next disabled'><a>Next → </a></li>";
				}
				else
				{
					echo "<li class='next'><a href='./index.php?report=clicks&page=".($numRows-1)."&username=$username&from=$from&to=$to&network=$nwk&offerId=$offerId'>Next → </a></li>";
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
</div>