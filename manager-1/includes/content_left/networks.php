<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>MANAGER NETWORKS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content">
<?php
	$final_report='';
	if(isset($_POST['addNetwork']))
	{
		$name = addslashes($_POST['name']);
		$ip = addslashes($_POST['ip']);
		$api_key = addslashes($_POST['api_key']);
		$status = addslashes($_POST['status']);
		$payment = (addslashes($_POST['payment'])=="month")?"month":"week";
		if($name == NULL){
			$final_report.= "Please input network name!";
		}else{
			if(strlen($name) <= 2 || strlen($name) >= 255){
					$final_report.="Network name must be more than 2 characters!";
			} else {
				$insertNetwork = mysqli_query($conn,"INSERT INTO `networks`(`id`, `name`, `ip`,`status`, `api_key`,`payment`) VALUES ('','$name','$ip','$status','$api_key','$payment')") or die(mysqli_error()); 	
				$final_report.="Add network success!";
			}
		}
	}
	if(isset($_POST['editNwk'])){
	$id = addslashes($_POST['id']);
	$name = addslashes($_POST['name']);
	$ip = addslashes($_POST['ip']);
	$status = addslashes($_POST['status']);
	$api_key = addslashes($_POST['api_key']);
	$payment = (addslashes($_POST['payment'])=="month")?"month":"week";
	$editWalls = mysqli_query($conn,"UPDATE `networks` SET `name`='$name', `ip`='$ip',`api_key`='$api_key',`payment`='$payment',`status`='$status' WHERE id='".$id."'") or die(mysqli_error());
				$final_report.="Edit network success!";
	}
?>
<?php
if(isset($final_report)){
	echo "<span color='red'>$final_report</span>";
}
?>
</div>
<div style="height:40px;margin:5px;">
	<div style="float:right;">
		<span name="check_ssh" class="btn btn-info" href="#" id="button_add_app" onclick="show_add_network()">ADD NETWORKS</span>
	</div>
	<div style="clear:right;"></div>
</div>
<div id="reponse_post"></div>

		<?php if(isset($$final_report1)&&$final_report1 !=""){?>
		<p class="error">
			<?php echo $final_report1;?>
		</p>
		<?php } ?>
	 
		<div class="container_table">
		<table  id="list_networks" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th><center>Name</center></th>
					<th><center>IP</center></th>
					<th><center>Status</center></th>
					<th><center>Payment</center></th>
					<th colspan='2'><center>Manager</center></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$querynetwork = mysqli_query($conn,"SELECT * FROM networks") or die(mysqli_error());
				while($nwk = mysqli_fetch_assoc($querynetwork)) {
					echo '<tr id="tr_'.$nwk['id'].'"><td><span style="font-weight: bold;">' .$nwk['name'] .'</span></td><td>' . $nwk['ip'] .'</td><td>';
					if($nwk['status']=='ON') {
				?>
						<span style="color: #00EE00; font-weight: bold;"><center><?php echo $nwk['status']; ?></center></span>
				<?php 					} else {
				?>
						<span style="color: #EE0000; font-weight: bold;"><center><?php echo $nwk['status']; ?></center></span>
				<?php 						}
						echo '</td><td><center>'.strtoupper($nwk['payment']).'</center></td><td><center><a class="btn btn-warning button_tb manager mousepointer" onclick="show_edit_network(\''.$nwk['id'].'\')">EDIT</a></center></td>';
						echo '<td><center><a class="btn btn-danger button_tb manager mousepointer" onclick="delete_network(\''.$nwk['id'].'\')">DELETE</center></a>';
						echo '</td></tr>';
					
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="container_table">
	<table style="width:50%;margin:10px auto" class="table table-bordered table-striped table-condensed">
	<tr>
		<td colspan='2'><center><h2>GLOBAL POSTBACK URL</h2></center></td>
	</tr>
	<tr>
	<td>
	Hasoffers
	</td>
	<td>
	<input type="text" class="input-xlarge txt" style="margin:0px" value="<?php echo $yourdomain."/".$dir_member;?>/postbacks.php?userId={aff_sub}&offerId={offer_id}" />
	</td>
	</tr>
	</table>
	</div>
</div>