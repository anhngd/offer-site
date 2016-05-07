<?php
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
	$query_by_name.=" and userName='".$userName."'";
	if(isset($_GET['option_paid'])&&($_GET['option_paid']=="paid"||$_GET['option_paid']=="unpaid"))
	{
		$option_paid=addslashes($_GET['option_paid']);
		$query_by_name.=" and status='".strtoupper($option_paid)."'";
	}
?>
<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>HISTORY INVOICE</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">

<div class="alert alert-success" style="padding: 14px 5px 14px 10px !important;">
		<form action="index.php?invoice" method="get" style="padding-bottom:10px;">
		<div class="input_form_filter">
				FROM: <input type="text" style="width:100px !important" name="from" class="input-xlarge datepicker" id="date01" value="<?php echo preg_replace("/ (.+)/","",$from);?>">
		</div>
		<div class="input_form_filter">
				TO: <input type="text" style="width:100px !important" name="to" class="input-xlarge datepicker" id="date02" value="<?php echo preg_replace("/ (.+)/","",$to);?>"> 
				<input hidden="hidden" name="invoice" value="history" />
		</div>
		
		
		<div class="input_form_filter">
			<select name="network"  style="max-width:150px">
				<option value="">Network</option>
				<?php 						
				$network = mysqli_query($conn,"SELECT offerNwk FROM shoutbox where status='NONE' group by offerNwk") or die(mysqli_error());
				while($nwk = mysqli_fetch_array($network)) {
				?>
				<option value="<?php echo $nwk['offerNwk'];?>" <?php if(isset($_GET['network'])&&$_GET['network']==$nwk['offerNwk']) { echo 'selected="selected"';}?>><?php echo $nwk['offerNwk'];?></option>
				<?php }
				?>
			</select>
			OFFER ID <input type="text" style="width:100px !important" name="offerId" class="input-xlarge " value="">
			<select name="option_paid"  style="max-width:80px">
				<option value="all">ALL</option>
				<option value="paid" <?php if(isset($option_paid)&&$option_paid=='paid'){echo "selected=''";}?>>PAID</option>
				<option value="unpaid" <?php if(isset($option_paid)&&$option_paid=='unpaid'){echo "selected=''";}?>>UNPAID</option>
			</select>
		</div>
		<div class="input_form_filter">
			<input type="submit" class="btn btn-primary" value="VIEW" />
			<a type="submit" class="btn btn-warning" target="_blank" href="./export_invoice_h.php?<?php echo $_SERVER['QUERY_STRING'];?>">EXPORT</a>
		</div>
		</form>
</div>
		
	<div style="clear:right;"></div>
<div id="reponse_post"></div>
<div class="container_table">
<table id="list_members" cellpadding="0" cellspacing="0" border="0" id="table" class="table table-bordered table-striped table-condensed">
	  <?php
			echo "<tr><td colspan='8'><center><h2>Statistics from the date $from to day $to</h2></center></td></tr>"
	  ?>
			  <tr><th>UserName</th><th>Network</th><th>Offer Name</th><th>Point</th><th>Money</th><th>From</th><th>To</th><th>Date create</th><th>Status</th></tr>
	<?php 		
	$sumUsers=mysqli_query($conn,"Select points,userName,offerName,network,`from`,`to`,date_create,status from invoice where DATE(date_create)>='$from' and DATE(date_create)<='$to' $query_by_name order by userName,points desc");
	$sumPoint=0;
	$query_point=mysqli_query($conn,"Select points,userName,offerName,network,`from`,`to`,date_create,status from invoice where DATE(date_create)>='$from' and DATE(date_create)<='$to' $query_by_name order by userName,points desc  limit $limit,$numSplitPage") or die (mysqli_error());
	while($row_point=mysqli_fetch_array($query_point))
	{
		echo '<tr id="tr_'.$row_point['userName'].'">';
		echo '<td class="tb_break_word">'. $row_point['userName'] .'</td>';
		echo '<td class="tb_break_word">'. $row_point['network'] .'</td>';
		echo '<td class="tb_break_word">'. $row_point['offerName'] .'</td>';
		echo '<td class="tb_break_word">'. $row_point['points'].'</td>';
		echo '<td class="tb_break_word">'. formatMoney($row_point['points']*$ratio_vnd) .'</td>';
		echo "<td class='tb_break_word'><center>".$row_point['from']."</center></td>";
		echo "<td class='tb_break_word'><center>".$row_point['to']."</center></td>";
		echo "<td class='tb_break_word'><center>".$row_point['date_create']."</center></td>";
		if($row_point['status']=="PAID")
		{
			echo "<td class='tb_break_word'><center><span style='color:green'>".$row_point['status']."</span></center></td>";
		}
		else
		{
			echo "<td class='tb_break_word'><center><span style='color:red'>".$row_point['status']."<span></center></td>";
		}
		echo '</tr>';
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
</table>
</div>
<?php
/*
	$num_row_users=mysqli_num_rows($sumUsers);
	$numRows=round($num_row_users/$numSplitPage);
	if(($numRows*$numSplitPage)<$num_row_users)
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
					echo "<a href='./index.php?users=yes&page=0&from=$from&to=$to'>← Previous</a>";
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
					echo "<li><a href='./index.php?users=yes&page=".($i-1)."&from=$from&to=$to'>$i</a></li>";
					}
				}
				if($page>=$numRows-2)
				{
					echo "<li class='next disabled'><a>Next → </a></li>";
				}
				else
				{
					echo "<li class='next'><a href='./index.php?users=yes&page=".($numRows-2)."&from=$from&to=$to'>Next → </a></li>";
				}
			?>
			
		</ul>
		</div>
	</div>
	</div>
	<?php
	}*/
?>
</div>
</div>
