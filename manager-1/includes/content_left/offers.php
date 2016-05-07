<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>MANAGER OFFERS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">
<?php
	if(isset($_POST['addOffer']))
	{
		$offerId = addslashes($_POST['offerId']);
		$name = addslashes($_POST['name']);
		$payout = addslashes($_POST['payout']);
		$url = addslashes($_POST['url']);
		$imageUrl = addslashes($_POST['image_url']);
		$offerId = addslashes($_POST['offerId']);
		$name = htmlentities(addslashes($_POST['name']),ENT_QUOTES);
		$des = htmlentities(addslashes($_POST['des']),ENT_QUOTES);
		$url = addslashes($_POST['url']);
		$image_url = addslashes($_POST['image_url']);
		$cc = addslashes($_POST['country']);
		$network = addslashes($_POST['network']);
		$payout = addslashes($_POST['payout']);
		if(isset($_POST['globalRate']) && $_POST['globalRate'] == 'Yes') {
			$ratio = Ratio;
		} else {
			$ratio = addslashes($_POST['ratio']);
		}
		$final_report2="";
		if($offerId == NULL) {
			$final_report2.= "Please input Offer ID !";
		} else {
			if($name == NULL) {
				$final_report2.= "Please input Offer Name !";
			} else {
				if ($payout == NULL) {
					$final_report2.= "Please input Offer Payout !";
				} else {
					if($url == NULL) {	
						$final_report2.= "Please input Offer URL !";
					} else {
						if($cc == NULL) {
							$final_report2.= "Please input Offer Country !";
						} else {
							if($network == NULL) {
								$final_report2.= "Please input Offer Network !";
							} else {
								mysqli_query($conn,"Delete FROM offers_country where offer_id='$offerId'");
								$array_country=strtoupper(explode(",",$cc));
								foreach($array_country as $k=>$v)
								{
									if($v=="")
									{
										continue;
									}
									
									mysqli_query($conn,"Insert into offers_country(`country_cc`,`offer_id`) value('$v',$this->offerId)");
								}
								$addOffer = mysqli_query($conn,"INSERT INTO `offers` (`id`,`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`,`country`, `network`, `status`) VALUES('','$offerId','$name','$url','$payout','$ratio','$image_url', '$des','$cc', '$network', 'ON')") or die(mysqli_error()); 				
								$final_report2.= 'Offer added successfully !';
							}
						}	
					}
				}
			}
		}
	}
	if(isset($_POST['editOffer'])){
	$id = (int) addslashes($_POST['id']);
	$offerId = addslashes($_POST['offerId']);
	$name = htmlentities(addslashes($_POST['name']),ENT_QUOTES);
	$des = htmlentities(addslashes($_POST['des']),ENT_QUOTES);
	$url = addslashes($_POST['url']);
	$image_url = addslashes($_POST['image_url']);
	$cc = addslashes($_POST['country']);
	$network = addslashes($_POST['network']);
    $status = addslashes($_POST['edffer']);	
	$payout = addslashes($_POST['payout']);
	if(isset($_POST['globalRate']) && $_POST['globalRate'] == 'Yes') {
		$ratio = Ratio;
	} else {
		$ratio = addslashes($_POST['ratio']);
	}
	$final_report2="";
	if($offerId == NULL) {
		$final_report2.= "Please input Offer ID !";
	} else {
		if($name == NULL) {
			$final_report2.= "Please input Offer Name !";
		} else {
			if ($payout == NULL) {
				$final_report2.= "Please input Offer Payout !";
			} else {
				if($url == NULL) {	
					$final_report2.= "Please input Offer URL !";
				} else {
					if($cc == NULL) {
						$final_report2.= "Please input Offer Country !";
					} else {
						if($network == NULL) {
							$final_report2.= "Please input Offer Network !";
						} else {
							mysqli_query($conn,"Delete FROM offers_country where offer_id='$offerId'");
							$array_country=strtoupper(explode(",",$cc));
							foreach($array_country as $k=>$v)
							{
								if($v=="")
								{
									continue;
								}
								
								mysqli_query($conn,"Insert into offers_country(`country_cc`,`offer_id`) value('$v',$offerId)");
							}
							$update_offer = mysqli_query($conn,"UPDATE offers SET offerId ='".$offerId."', name ='".$name."', des ='".$des."', payout ='".$payout."', ratio ='".$ratio."', url ='".$url."', imageUrl ='".$image_url."', country ='".$cc."', network ='".$network."' , status ='".$status."' WHERE id ='".$id."'") or die(mysqli_error()); 				
							$final_report2.= 'Offer edited successfully !';						
						}
					}	
				}
			}
		}
	}												
}
?>
<div style="height:40px;margin:5px;">
	<div style="float:left;">
		<form action="./index.php?offers#" method="GET">
			<input type="hidden" value="" name="offers"/>
			<select name="network">
				<option value="">Network</option>
				<?php 						
				$network = mysqli_query($conn,"SELECT * FROM networks ORDER BY name") or die(mysqli_error());
				while($nwk = mysqli_fetch_array($network)) {
				?>
				<option value="<?php echo $nwk['name'];?>" <?php if(isset($_GET['network'])&&$_GET['network']==$nwk['name']) { echo 'selected="selected"';}?>><?php echo $nwk['name'];?></option>
				<?php }
				?>
			</select>
			<select name="country">
				<option value="">Country</option>
				<?php 						$country = mysqli_query($conn,"SELECT * FROM countries ORDER BY name") or die(mysqli_error());
				while($cc = mysqli_fetch_array($country)) {
				?>
				<option value="<?php echo $cc['cc'];?>"><?php echo $cc['name'];?></option>
				<?php }
				?>
			</select>					
			<input type="submit" value="Filter" name="filter" class="manager btn btn-info"/>
			<span class="reset"><a href="index.php?offers">Reset Filter</a></span>
		</form>
	</div>
	<div style="float:right;">
		<span name="check_ssh" class="btn btn-info" href="#" id="button_add_app"  onclick="show_add_offer()">ADD OFFERS</span>
	</div>
</div>
<div id="reponse_post"><?php if(isset($final_report2)) echo "<span style=color:red>$final_report2</span>"; ?></div>

	<div style="clear:both;"></div>
<?php

	if(isset($_POST['delOffers']) && $_POST['id']){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $delOffers = mysqli_query($conn,"DELETE FROM offers WHERE id ='".$_POST['id'][$i]."'") or die(mysqli_error());
        }
        header("Location: index.php?offers");
	}
    if(isset($_POST['offOffers']) && $_POST['id']){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $offOffers = mysqli_query($conn,"UPDATE offers SET status='OFF'  WHERE id ='".$_POST['id'][$i]."'") or die(mysqli_error());
        }
        header("Location: index.php?offers");
	}
	if(isset($_POST['onOffers']) && $_POST['id']){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $offOffers = mysqli_query($conn,"UPDATE offers SET status='ON'  WHERE id ='".$_POST['id'][$i]."'") or die(mysqli_error());
        }
        header("Location: index.php?offers");
	}

?>
			<div class="container_table">
			<form action="" method="POST">
			<table style="max-width:808px;" id="list_members" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed">
				<thead>
				<tr>
					<th>ID</th>
					<th>OfferID</th>
					<th>Name</th>
					<th>Payout</th>
					<th>Ratio</th>
					<th><?php echo vcName;?></th>
					<th>Country</th>
					<th>Network</th>
					<th>Status</th>
					<th colspan='2'>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php 
						if(!isset($_GET['filter'])) {
							$queryoffers = mysqli_query($conn,"SELECT * FROM offers") or die(mysqli_error());
						} else {
							if($_GET['country']!=NULL && $_GET['network']==NULL) {
								$ccode = $_GET['country'];
								$queryoffers = mysqli_query($conn,"SELECT * FROM offers WHERE country='".$ccode."'") or die(mysqli_error());
							} else {
								if($_GET['country']==NULL && $_GET['network']!=NULL) {
									$nwk = $_GET['network'];
									$queryoffers = mysqli_query($conn,"SELECT * FROM offers WHERE network='".$nwk."'") or die(mysqli_error());
								} else {
									$ccode = $_GET['country'];
									$nwk = $_GET['network'];
									$queryoffers = mysqli_query($conn,"SELECT * FROM `offers` WHERE (`country`='$ccode' AND `network`='$nwk')") or die(mysqli_error());
								}
							}
						}
						
						while($offer = mysqli_fetch_array($queryoffers)) {
							echo '<tr id="tr_'.$offer['id'].'"><td>' .$offer['id'] .'<span class="idcheckbox"><input name="id[]" type="checkbox" value="'.$offer['id'].'"/></span></td>';
							echo '<td>' . $offer['offerId'] .'</td><td>' . $offer['name'] .'</td><td>' . $offer['payout'] .'</td><td>' . $offer['ratio'] .'</td><td>' . $offer['payout']*$offer['ratio'] .'</td><td>'; 
								if($offer['country']=="GB" || $offer['country']=="UK") {
								echo 'United Kingdom';
								} else {
									$queryCC = mysqli_query($conn,"SELECT name FROM countries WHERE cc='".$offer['country']."'") or die(mysqli_error());
									$cc = mysqli_fetch_array($queryCC);
									echo $cc['name'];
								}
							echo '</td><td>' . $offer['network'] .'</td><td>' . $offer['status'] .'</td>';
							echo '<td><a class="btn btn-warning button_tb manager mousepointer" onclick="show_edit_offer(\''.$offer['id'].'\')">Edit</a></td>';
							echo '&nbsp;';
							echo '<td><a class="btn btn-danger button_tb manager mousepointer" onclick="delete_offer(\''.$offer['id'].'\')">Delete</a></td>';
							echo '</tr>';
						}
					
				?>
				</tbody>
				
			</table>
            <input name="onOffers" class="btn btn-info button_tb manager mousepointer" type="submit" value="ON selected offer(s)" title="ON selected offer(s)"/>
            <input name="offOffers" class="btn btn-warning button_tb manager mousepointer" type="submit" value="OFF selected offer(s)" title="OFF selected offer(s)"/>
			<input name="delOffers" class="btn btn-danger button_tb manager mousepointer" type="submit" value="DELETE selected offer(s)" title="DELETE selected offer(s)"/>
			</form>
			</div>
</div>
</div>
