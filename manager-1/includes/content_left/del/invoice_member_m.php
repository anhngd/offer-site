<?php

	if(isset($_GET['month']))
	{
		$month_today=$date_today->format("m");
		$m_30day=(addslashes($_GET['month'])>=10)?addslashes($_GET['month']):"0".addslashes($_GET['month']);
		$Y_m_30day = $date_today->format("Y-").$m_30day;
	}
	else
	{
		$month_today = $date_today->format("m");
		if($month_today==1)
		{
			$m_30day=12;
			$y_30day=$date_today->format("Y")-1;
			$Y_m_30day = $y_30day."-".$m_30day;
		}
		else
		{
			$m_30day = (($month_today-1)>=10)?($month_today-1):"0".($month_today-1);
			$Y_m_30day = $date_today->format("Y-").$m_30day;
		}
	}

	$from = date( "Y-m-01", strtotime($Y_m_30day)); // First day of week
	$to = date( "Y-m-t", strtotime($Y_m_30day) ); // Last day of week
?>
<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>MANAGER APPS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content">
<div class="col-md-12">
    <div class="alert alert-success">
		<form action="index.php?invoice=month" method="get" style="display:inline">
				<select name="month"  style="max-width:150px;display:inline;" class="form-control">
					<?php

						echo get_month($month_today,$m_30day);
					?>
				</select>
			<input type="hidden" name="invoice" value="month" />
			<input type="submit" class="btn btn-primary" value="VIEW" />
		</form>
	</div>
</div>
<div id="reponse_post"></div>
<div class="container_table">
<table id="list_affiliate" cellpadding="0" cellspacing="0" border="0" id="table" class="table table-bordered table-striped table-condensed">
	  <?php
			echo "<tr><td colspan='11'><center><h2>Statistics from the date $from to $to</h2></center></td></tr>"
	  ?>
			  <tr><th>USERNAME</th><th>MONTH</th><th>CLICKS</th><th>LEADS</th><th>AMOUNT</th><th>CVR</th><th>RPC</th><th>RPA</th><th>NETWORK</th><th><center>STATUS</center></th></tr>
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
		
		$query_check_invoice=mysqli_query($conn,"Select id from invoice where month='$m_30day' limit 0,1");
		if(mysqli_num_rows($query_check_invoice))
		{
			$suminvoices=mysqli_query($conn,"Select id from invoice where month='$m_30day'");
			$query_invoice=mysqli_query($conn,"Select invoice.status,invoice.userName,invoice.leads,invoice.clicks,invoice.amount_w,invoice.cvr,invoice.rpc,invoice.rpa,invoice.network from invoice inner join networks ON networks.name=invoice.network where month='$m_30day' and networks.payment='month' and invoice.userName='$userName'") or die (mysqli_error());
			while($invoice = mysqli_fetch_array($query_invoice)) 
			{
			if($invoice['status']=="unpaid")
			{
						$create_invoice="<span class=''><span style='color:red;'><center>UNPAID</center></span></span>";
			}
			else
			{
						$create_invoice="<span class=''><span style='color:blue;'><center>PAID</center></span></span>";
			}
				echo '<tr id="tr_'.$invoice['userName'].'">';
				echo '<td class="tb_break_word">'. $invoice['userName'] .'</td>';
				echo '<td class="tb_break_word">'. $m_30day .'</td>';
				echo '<td class="tb_break_word">'. $invoice['clicks'] .'</td>';
				echo '<td class="tb_break_word">'. $invoice['leads'] .'</td>';
				echo '<td class="tb_break_word">'. $invoice['amount_w']*$invoice['leads'] .'</td>';
				echo '<td class="tb_break_word">'. $invoice['cvr'] .'</td>';
				echo '<td class="tb_break_word">'. $invoice['rpc'] .'</td>';
				echo '<td class="tb_break_word">'. $invoice['rpa'] .'</td>';
				echo '<td class="tb_break_word">'. $invoice['network'] .'</td>';
				//echo "<td class='tb_break_word'> <a class='btn btn-danger button_tb manager mousepointer' target=\"_blank\" href=\"./index.php?detail_invoice=".addslashes($invoice['userName'])."&week=$m_30day\">DETAIL</a></td>";
				echo "<td class='tb_break_word'> $create_invoice </td>";
				echo '</tr>';
			}
		}
		else
		{
			$suminvoices=mysqli_query($conn,"select * from static_month where `type_time`='type_month' and `time`='$Y_m_30day' group by network,userName") or die (mysqli_error());
			$invoices_query=mysqli_query($conn,"select * from static_month where `type_time`='type_month' and `time`='$Y_m_30day' group by network,userName") or die (mysqli_error());
			if(mysqli_num_rows($invoices_query))
			{
				while($invoice = mysqli_fetch_array($invoices_query)) 
				{
					if($invoice['num_lead']>$invoice['num_click'])
					{
						$num_lead=$invoice['num_click'];
						$num_click=$invoice['num_click'];
					}
					else
					{
						$num_lead=$invoice['num_lead'];
						$num_click=$invoice['num_click'];
					}
					$cvr=($num_lead!=0)?round(($num_lead/$num_click*100),2):0;
					$cpc=($invoice['pay_out']!=0&&$num_lead!=0)?round(($invoice['pay_out'])*$num_lead/$num_click,4):0;
					$cpa=($invoice['pay_out']!=0&&$num_lead!=0)?round($invoice['pay_out']*$num_lead/$num_lead,2):0;
					mysqli_query($conn,"INSERT INTO `invoice`(`userName`, `month`, `clicks`, `leads`, `amount_w`, `cvr`, `rpc`, `rpa`, `status`,`network`) VALUES ('".$invoice['userName']."','".$m_30day."','".$num_click."','".$num_lead."','".$invoice['pay_out']."','".$cvr."','".$cpc."','".$cpa."','unpaid','".$invoice['network']."')");
				}
				$query_invoice=mysqli_query($conn,"Select invoice.status,invoice.userName,invoice.leads,invoice.clicks,invoice.amount_w,invoice.cvr,invoice.rpc,invoice.rpa,invoice.network from invoice inner join networks ON networks.name=invoice.network where month='$m_30day' and networks.payment='month' and invoice.usserName='$userName");

				while($invoice = mysqli_fetch_array($query_invoice)) 
				{
					if($invoice['status']=="unpaid")
					{
						$create_invoice="<span class=''><span style='color:blue;'><center>UNPAID</center></span></span>";
					}
					else
					{
						$create_invoice="<span class=''><span style='color:blue;'><center>PAID</center></span></span>";
					}
					echo '<tr id="tr_'.$invoice['userName'].'">';
					echo '<td class="tb_break_word">'. $invoice['userName'] .'</td>';
					echo '<td class="tb_break_word">'. $m_30day .'</td>';
					echo '<td class="tb_break_word">'. $invoice['clicks'] .'</td>';
					echo '<td class="tb_break_word">'. $invoice['leads'] .'</td>';
					echo '<td class="tb_break_word">'. $invoice['amount_w']*$invoice['leads'] .'</td>';
					echo '<td class="tb_break_word">'. $invoice['cvr'] .'</td>';
					echo '<td class="tb_break_word">'. $invoice['rpc'] .'</td>';
					echo '<td class="tb_break_word">'. $invoice['rpa'] .'</td>';
					echo '<td class="tb_break_word">'. $invoice['network'] .'</td>';
					//echo "<td class='tb_break_word'> <a class='btn btn-danger button_tb manager mousepointer' target=\"_blank\" href=\"./index.php?detail_invoice=".addslashes($invoice['userName'])."&week=$m_30day\">DETAIL</a></td>";
					echo "<td class='tb_break_word'> $create_invoice </td>";
					echo '</tr>';
				}
			}
		}
				?>
</table>
</div>
<?php
/*
	$num_row_invoices=mysqli_num_rows($suminvoices);
	$numRows=round($num_row_invoices/$numSplitPage);
	if(($numRows*$numSplitPage)<$num_row_invoices)
	{
		$numRows++;
	}
	if($numRows>0)
	{
	?>
	<div class="row-fluid">
	<div class="span12 center">
		<div class="dataTables_paginate paging_bootstrap pagination">
			<?php
				if($page!='0')
				{
					echo "<a  style='margin:1px' class='btn btn-info'  href='./index.php?users=yes&page=0&from=$from&to=$to'>? Previous</a>";
				}
				else
				{
					echo "<a  style='margin:1px' class='btn btn-default' >? Previous</a>";
				}
				for($i=1;$i<$numRows;$i++)
				{
					if($i==($page+1))
					{
					echo "<a  style='margin:1px' class='btn btn-default' >$i</a>";
					}
					else
					{
					echo "<a  style='margin:1px' class='btn btn-info' href='./index.php?users=yes&page=".($i-1)."&from=$from&to=$to'>$i</a>";
					}
				}
				if($page>=$numRows-2)
				{
					echo "<a  style='margin:1px' class='btn btn-default' >Next ? </a>";
				}
				else
				{
					echo "<a  style='margin:1px' class='btn btn-info' href='./index.php?users=yes&page=".($numRows-2)."&from=$from&to=$to'>Next ? </a>";
				}
			?>
		</div>
	</div>
	</div>
	<?php
	}
	*/
?>
</div>
</div>