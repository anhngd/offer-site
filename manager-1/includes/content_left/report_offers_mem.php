<?php

	$username=addslashes($userName);
	if(isset($_GET['from'])&&$_GET['from']!="")
	{
		$from=date('Y-m-d',strtotime(addslashes($_GET['from'])));
	}
	else
	{
		$from=$first_year;
	}
	if(isset($_GET['to'])&&$_GET['to']!="")
	{
		$to=date('Y-m-d',strtotime(addslashes($_GET['to'])));
	}
	else
	{
		$to=date('y-m-d',time());
	}
	if(isset($_GET['network'])&&$_GET['network']!="")
	{
		$nwk=addslashes($_GET['network']);
		$query_network="WHERE (network='".$nwk."')";
	}
	else
	{
		$query_network="";
	}
?>
<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>REPORT OFFERS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">
<form action="index.php?report=offers" method="GET">
	<input type="hidden" name="report" value="offers">
	<div class="input_form_filter">
	From
	<input type="text" id="from" name="from" value="<?php echo $from;?>" style="width:100px !important" class="datepicker"/>
	</div>
	<div class="input_form_filter">
	To
	<input type="text" id="to" name="to" style="width:100px !important" value="<?php echo $from;?>" class="datepicker"/>
	</div>
	<div class="input_form_filter">
	<select name="network" style="width:150px !important">
		<option value="">Network</option>
		<?php 						$network = mysqli_query($conn,"SELECT * FROM networks") or die(mysqli_error());
		while($nwk = mysqli_fetch_array($network)) {
		?>
		<option value="<?php echo $nwk['name'];?>"><?php echo $nwk['name'];?></option>
		<?php }
		?>
	</select>	
	</div>
	<div class="input_form_filter">
	<input type="submit" value="Filter" name="filter" class="btn btn-primary" />
	</div>
	<span class="reset"><a href="index.php?report=leads">Reset Filter</a></span>
</form>
<div class="container_table">
<table width="100%"  cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed">
	<thead>
		<tr><td colspan="11"><center><h2>Statistics from the date <?php echo $from;?> to <?php echo $to;?></h2></center></td></tr>
	</thead>
	<tbody>
<?php 
	$queryoffers = mysqli_query($conn,"SELECT * FROM offers $query_network") or die(mysqli_error());
	if(mysqli_num_rows($queryoffers))
	{
		?>
		<thead>
			<tr>
				<th>Offer ID</th>
				<th>Name</th>
				<th>Points</th>
				<th>Country</th>
				<th>Network</th>
				<th>Clicks</th>
				<th>Leads</th>
				<th>CR</th>
			</tr>
		</thead>
		<?php
		while($offer = mysqli_fetch_assoc($queryoffers)) 
		{
			$count_click=countClick($offer['id'],$from,$to,$userName);
			$count_lead=countLead($offer['id'],$from,$to,$userName);
			$cr=($count_click)=="0"?0:round(($count_lead/$count_click)*100,4);
						

			echo '<tr>';
			echo '<td>' .$offer['id'] .'</td><td>' . $offer['name'] .'</td><td>' . $offer['payout']*$offer['ratio']*$count_lead .'</td><td>' . get_list_contry($offer['offerId']) .'</td><td>' . $offer['network'] .'</td>';
			echo '<td class="action">' .$count_click.'</td><td>' .$count_lead.'</td><td>' .$cr.'</td></tr>';
		}
	}
	
	?>
	</tbody>
</table>
</div>
</div>
</div>