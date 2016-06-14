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
	if($username!="")
	{
		$query_username="AND username='".$username."'";
	}
?>
<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>REPORT LEADS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">
<form action="" method="GET">
	<input type="hidden" name="report" value="leads"/>
	Username
	<input type="text" style="width:100px !important" name="username" value="<?php echo $username;?>"/>
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
<div class="container_table">
	<table id="AppTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ID</th>
			<th>Date</th>
			<th>Username</th>
			<th>Offer</th>
			<th>Points</th>
			<th>Country</th>
			<th>Network</th>
			<th  class="nosort">IP</th>
			<th>User Agent</th>
          </tr>
        </thead>
        <tbody>
        	<?php 
					
				$query_where=$query_nwk." ".$query_username;
				$query_num_rows = mysqli_query($conn,"SELECT id FROM leads WHERE (DATE(date)>='".$from."' AND DATE(date)<='".$to."' $query_where)") or die(mysqli_error());
				$query = mysqli_query($conn,"SELECT * FROM leads WHERE (DATE(date)>='".$from."' AND DATE(date)<='".$to."' $query_where) ORDER BY id DESC limit $limit,$numSplitPage") or die(mysqli_error());
				while($lead = mysqli_fetch_assoc($query)){
					echo '<tr '. $lead['id'] .'><td><span class="idcheckbox"><input name="id[]" type="checkbox" value="'.$lead['id'].'"/></span></td><td>'. $lead['date'] . '</td><td>'. $lead['userName'] .'</td><td>'. $lead['offerName'] .'</td><td>'. $lead['points'] .'</td><td>'. $lead['offerCC']. '</td><td>'. $lead['offerNwk'] .'</td><td>'. $lead['ip'] .'</td><td>'. $lead['userAgent'] .'</td></tr>';
					}
			?>          	         
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
			<th>Date</th>
			<th>Username</th>
			<th>Offer</th>
			<th>Points</th>
			<th>Country</th>
			<th>Network</th>
			<th  class="nosort">IP</th>
			<th>User Agent</th>
          </tr>
        </tfoot>
      </table>		
	</div>
		<!--<input name="delLeads" class="deletebtn" type="submit" value="Delete selected lead(s)" title="Delete selected lead(s)"/>-->
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#AppTable').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });		
	});
</script>