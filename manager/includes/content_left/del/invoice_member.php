<?php

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
<div id="reponse_post"></div>
<div class="container_table">
<table id="list_affiliate" cellpadding="0" cellspacing="0" border="0" id="table" class="table table-bordered table-striped table-condensed">
	  <?php
			echo "<tr><td colspan='11'><center><h2>INVOICE</h2></center></td></tr>"
	  ?>
			  <tr><th>USERNAME</th><th>TYPE TIME</th><th>CLICKS</th><th>LEADS</th><th>AMOUNT</th><th>CVR</th><th>RPC</th><th>RPA</th><th>NETWORK</th><th><center>STATUS</center></th></tr>
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
		
		$query_invoice=mysqli_query($conn,"Select invoice.status,invoice.week,invoice.userName,invoice.leads,invoice.clicks,invoice.amount_w,invoice.cvr,invoice.rpc,invoice.rpa,invoice.network from invoice inner join networks ON networks.name=invoice.network where networks.payment='week' and week<>'NULL' and invoice.userName='$userName'") or die (mysqli_error());
		if(mysqli_num_rows($query_invoice))
		{
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
				echo '<td class="tb_break_word">MONTH '. $invoice['week'] .'</td>';
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
		$query_invoice=mysqli_query($conn,"Select invoice.status,invoice.month,invoice.userName,invoice.leads,invoice.clicks,invoice.amount_w,invoice.cvr,invoice.rpc,invoice.rpa,invoice.network from invoice inner join networks ON networks.name=invoice.network where networks.payment='month' and month<>'NULL' and invoice.userName='$userName'") or die (mysqli_error());
		if(mysqli_num_rows($query_invoice))
		{
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
				echo '<td class="tb_break_word">MONTH '. $invoice['month'] .'</td>';
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