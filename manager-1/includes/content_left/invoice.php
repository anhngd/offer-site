<?php
	if(($_GET['invoice']=="PAID"||$_GET['invoice']=="UNPAID")&&isset($_GET['from'])&&isset($_GET['to']))
	{
		$status_paid=addslashes($_GET['invoice']);
		$from=addslashes($_GET['from']);
		$to=addslashes($_GET['to']);
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
			$query_by_name=" and offerName='".$row_offer_name['name']."'";
			$value_by_offer=addslashes($row_offer_name['name']);
			$value_by_network="";
		}
		else
		if(isset($_GET['network'])&&$_GET['network']!="")
		{
			$group_by_name=",offerNwk";
			$query_by_name=" and offerNwk='".addslashes($_GET['network'])."'";
			$value_by_offer="";
			$value_by_network=addslashes($_GET['network']);
		}
		else
		{
			$group_by_name="";
			$query_by_name="";
			$value_by_offer="";
			$value_by_network="";
		}
		$query_point=mysqli_query($conn,"Select sum(points) as sumpoints,userName,offerName,offerNwk from shoutbox where DATE(date)>='$from' and DATE(date)<='$to' and status='NONE' $query_by_name group by userName$group_by_name order by userName,sumpoints,offerNwk desc") or die (mysqli_error());
		$query_insert_invoice="Insert into invoice(`userName`,`points`,`from`,`to`,`offerName`,`network`,`date_create`,`status`) value";
		$i=0;
		$date_create=date("Y-m-d H:i:s");
		while($row=mysqli_fetch_array($query_point))
		{	
			$i++;
			if($i==300)
			{
				$i=0;
			$query_insert_invoice.="('".$row['userName']."','".$row['sumpoints']."','$from','$to','".$value_by_offer."','".$value_by_network."','$date_create','$status_paid');Insert into invoice(`userName`,`points`,`from`,`to`,`offerName`,`network`,`date_create`,`status`) value";
				continue;
			}
			$query_insert_invoice.="('".$row['userName']."','".$row['sumpoints']."','$from','$to','".$value_by_offer."','".$value_by_network."','$date_create','$status_paid'),";
		}
		$query_insert_invoice=preg_replace("/,$/",";",$query_insert_invoice);
		mysqli_query($conn,$query_insert_invoice) or die (mysqli_error());
		$sumUsers=mysqli_query($conn,"Update shoutbox set `status`='$status_paid' where DATE(date)>='$from' and DATE(date)<='$to' and `status`='NONE'$query_by_name order by points desc") or die (mysqli_error());
	}
	else
	{
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
		$group_by_name=",offerNwk";
		$query_by_name=" and offerNwk='".addslashes($_GET['network'])."'";
		$request_by_name="&network=".addslashes($_GET['network']);
	}
	else
	{
		update_s();
		$offerId="";
		$request_by_name="";
		$group_by_name="";
		$query_by_name="";
	}
?>
<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>CREATE INVOICE</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">

<div class="alert alert-success">
		<form action="index.php?invoice" method="get" style="padding-bottom:10px;">
		<div class="input_form_filter">
				FROM: <input type="text" style="width:100px !important" name="from" class="input-xlarge datepicker" id="date01" value="<?php echo preg_replace("/ (.+)/","",$from);?>">
		</div>
		<div class="input_form_filter">
				TO: <input type="text" style="width:100px !important" name="to" class="input-xlarge datepicker" id="date02" value="<?php echo preg_replace("/ (.+)/","",$to);?>"> 
				<input hidden="hidden" name="invoice" value="" />
		</div>
		<div class="input_form_filter">
				TIMEZONE: 
				<select name="timezone" style="max-width:150px">
					<?php echo list_timezone($row_admin['timezone_default']);?>				
				</select>
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
		</div>
		<div class="input_form_filter">
			<input type="submit" class="btn btn-primary" value="VIEW" />
		</div>
		<div class="input_form_filter">
		<a type="submit" class="btn btn-warning" target="_blank" href="./export_invoice.php?<?php echo $_SERVER['QUERY_STRING'];?>">EXPORT</a>
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
			  <tr><th>UserName</th><?php if($group_by_name==",offerNwk"){echo "<th>Network</th>";}if($group_by_name==",offerName"){echo "<th>Offer Name</th>";}?><th>Point</th><th>Money</th><th><?php echo "<center><a href='./index.php?from=$from&to=$to&invoice=PAID$request_by_name' class='btn btn-info button_tb manager mousepointer' >PAID ALL</a></center>";?></th><th><?php echo "<center><a class='btn btn-danger button_tb manager mousepointer'  href='./index.php?from=$from&to=$to&invoice=UNPAID$request_by_name'>UNPAID ALL</a></center>";?></th></tr>
		<?php 		
		
		$sumUsers=mysqli_query($conn,"Select sum(points) as sumpoints,userName,offerName,offerNwk from shoutbox where DATE(date)>='$from' and DATE(date)<='$to' and status='NONE' $query_by_name group by userName$group_by_name order by userName,sumpoints,offerNwk desc");
		$sumPoint=0;
		$query_point=mysqli_query($conn,"Select sum(points) as sumpoints,userName,offerName,offerNwk from shoutbox where DATE(date)>='$from' and DATE(date)<='$to' and status='NONE' $query_by_name group by userName$group_by_name order by userName,sumpoints,offerNwk desc") or die (mysqli_error());
			while($row_point=mysqli_fetch_array($query_point))
			{
				
				$sumpoints=$row_point['sumpoints'];
				if($sumpoints=="")
				{
					$sumpoints=0;
				}
				echo '<tr id="tr_'.$row_point['userName'].'">';
				echo '<td class="tb_break_word">'. $row_point['userName'] .'</td>';
				if($group_by_name==",offerNwk")
				{
					echo '<td class="tb_break_word">'. $row_point['offerNwk'] .'</td>';
				}
				if($group_by_name==",offerName")
				{
					echo '<td class="tb_break_word">'. $row_point['offerName'] .'</td>';
				}
				echo '<td class="tb_break_word">'. $sumpoints.'</td>';
				echo '<td class="tb_break_word">'. formatMoney($sumpoints*$ratio_vnd) .'</td>';
				echo "<td class='tb_break_word'><center><a class='btn btn-info button_tb manager mousepointer' onclick=\"status_paid_all('".$row_point['userName']."','$from','$to','PAID','".addslashes($row_point['offerNwk'])."','".addslashes($offerId)."')\">PAID</a></center></td>";
				echo "<td class='tb_break_word'><center><a class='btn btn-danger button_tb manager mousepointer' onclick=\"status_paid_all('".$row_point['userName']."','$from','$to','UNPAID','".addslashes($row_point['offerNwk'])."','".addslashes($offerId)."')\">UNPAID</a></center></td>";
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
	}
	*/
?>
</div>
</div>
