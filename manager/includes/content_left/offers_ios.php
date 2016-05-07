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
		$url = addslashes($_POST['url']);
		$name = htmlentities(addslashes($_POST['name']),ENT_QUOTES);
		$des = htmlentities(addslashes($_POST['des']),ENT_QUOTES);
		$url = addslashes($_POST['url']);
		$image_url = addslashes($_POST['image_url']);
		$cc = addslashes($_POST['country']);
		$network = addslashes($_POST['network']);
		$payout = addslashes($_POST['payout']);
		$end_tracking = addslashes($_POST['end_tracking']);
		$show_index =!isset($_POST['show_index'])?"":addslashes($_POST['show_index']);
		$min_os_version = addslashes($_POST['min_os_version']);
		$app_size = addslashes($_POST['app_size']);
		$view = addslashes($_POST['view']);
		$update_date = addslashes($_POST['update_date']);
		$category = addslashes($_POST['category']);
		$producer = addslashes($_POST['producer']);
		$hot =!isset($_POST['hot'])?"":addslashes($_POST['hot']);
/*if(isset($_POST['globalRate']) && $_POST['globalRate'] == 'Yes') {
			$ratio = Ratio;
		} else {
			$ratio = addslashes($_POST['ratio']);
		}*/
		$ratio = Ratio;
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
								$array_country=explode(",",strtoupper($cc));
								foreach($array_country as $k=>$v)
								{
									if($v=="")
									{
										continue;
									}
									
									mysqli_query($conn,"Insert into offers_country(`country_cc`,`offer_id`) value('$v',$offerId)");
								}
								$addOffer = mysqli_query($conn,"INSERT INTO `offers` (`id`,`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`, `network`, `status`,`OS`,`end_tracking`,`show_index`,`min_os_version`,`app_size`,`view`,`update_date`,`hot`,`category`,`producer`) VALUES('','$offerId','$name','$url','$payout','$ratio','$image_url', '$des', '$network', 'ON','ios','$end_tracking','$show_index','$min_os_version','$app_size','$view','$update_date','$hot','$category','$producer')") or die(mysqli_error());
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
	$end_tracking = addslashes($_POST['end_tracking']);
	$show_index =!isset($_POST['show_index'])?"":addslashes($_POST['show_index']);
	$producer = "";
	$min_os_version = "";
	$app_size = "";
	$view = "";
	$category = "";
	$update_date = "";
	$hot =!isset($_POST['hot'])?"":addslashes($_POST['hot']);
	/*if(isset($_POST['globalRate']) && $_POST['globalRate'] == 'Yes') {
		$ratio = Ratio;
	} else {
		$ratio = addslashes($_POST['ratio']);
	}*/
		$ratio = Ratio;
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
							$array_country=explode(",",strtoupper($cc));
							foreach($array_country as $k=>$v)
							{
								if($v=="")
								{
									continue;
								}
								
								mysqli_query($conn,"Insert into offers_country(`country_cc`,`offer_id`) value('$v',$offerId)");
							}
							$update_offer = mysqli_query($conn,"UPDATE offers SET offerId ='".$offerId."', name ='".$name."', des ='".$des."', payout ='".$payout."', ratio ='".$ratio."', url ='".$url."', imageUrl ='".$image_url."', network ='".$network."' , status ='".$status."', end_tracking ='".$end_tracking."', show_index ='".$show_index."', min_os_version ='".$min_os_version."', app_size ='".$app_size."', view ='".$view."', update_date ='".$update_date."', hot ='".$hot."', producer ='".$producer."', category ='".$category."' WHERE id ='".$id."'") or die(mysqli_error()); 				
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
		<form action="./index.php?offers=ios" method="GET">
			<input type="hidden" value="ios" name="offers"/>
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
			<!--<select name="country">
				<option value="">Country</option>
				<?php 						$country = mysqli_query($conn,"SELECT * FROM countries ORDER BY name") or die(mysqli_error());
				while($cc = mysqli_fetch_array($country)) {
				?>
				<option value="<?php echo $cc['cc'];?>"><?php echo $cc['name'];?></option>
				<?php }
				?>
			</select>-->
			<input type="submit" value="Filter" name="filter" class="manager btn btn-info"/>
			<span class="reset"><a href="index.php?offers=ios">Reset Filter</a></span>
		</form>
	</div>
	<div style="float:right;">
		<span name="check_ssh" class="btn btn-info" href="#" id="button_add_app"  onclick="show_add_offer()">ADD OFFERS</span>
	</div>
</div>
<div id="reponse_post"><?php if(isset($final_report2)) echo "<span style=color:red>$final_report2</span>"; ?></div>

	<div style="clear:both;"></div>
<?php

	if(isset($_POST['delOffers']) && isset($_POST['id'])){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $delOffers = mysqli_query($conn,"DELETE FROM offers WHERE id ='".addslashes($_POST['id'][$i])."'") or die(mysqli_error());
        }
        header("Location: index.php?offers=ios");
	}
    if(isset($_POST['offOffers']) && isset($_POST['id'])){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $offOffers = mysqli_query($conn,"UPDATE offers SET status='OFF'  WHERE id ='".addslashes($_POST['id'][$i])."'") or die(mysqli_error());
        }
        header("Location: index.php?offers=ios");
	}
	if(isset($_POST['onOffers']) && isset($_POST['id'])){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $offOffers = mysqli_query($conn,"UPDATE offers SET status='ON'  WHERE id ='".addslashes($_POST['id'][$i])."'") or die(mysqli_error());
        }
        header("Location: index.php?offers=ios");
	}

?>
			<div class="container_table">
			<form action="./index.php?offers=ios" method="POST">
			<table  id="list_members" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed">
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
							$queryoffers = mysqli_query($conn,"SELECT * FROM offers WHERE `OS`='ios'") or die(mysqli_error());
						} else {
							$_GET['country']="";
							if($_GET['country']!=NULL && $_GET['network']==NULL) {
								//$ccode = addslashes($_GET['country']);
								$queryoffers = mysqli_query($conn,"SELECT * FROM offers WHERE `OS`='ios'") or die(mysqli_error());
								//$queryoffers = mysqli_query($conn,"SELECT * FROM offers WHERE `OS`='ios' and country='".$ccode."'") or die(mysqli_error());
							} else {
								if($_GET['country']==NULL && $_GET['network']!=NULL) {
									$nwk = addslashes($_GET['network']);
									$queryoffers = mysqli_query($conn,"SELECT * FROM offers WHERE `OS`='ios' and network='".$nwk."'") or die(mysqli_error());
								} else {
									//$ccode = addslashes($_GET['country']);
									$nwk = addslashes($_GET['network']);
									//$queryoffers = mysqli_query($conn,"SELECT * FROM `offers` WHERE (`OS`='ios' and `country`='$ccode' AND `network`='$nwk')") or die(mysqli_error());
									$queryoffers = mysqli_query($conn,"SELECT * FROM `offers` WHERE (`OS`='ios' and `network`='$nwk')") or die(mysqli_error());
								}
							}
						}
						
						while($offer = mysqli_fetch_array($queryoffers)) {
							echo '<tr id="tr_'.$offer['id'].'"><td>' .$offer['id'] .'<span class="idcheckbox"><input name="id[]" type="checkbox" value="'.$offer['id'].'"/></span></td>';
							echo '<td>' . $offer['offerId'] .'</td><td>' . $offer['name'] .'</td><td>' . $offer['payout'] .'</td><td>' . $offer['ratio'] .'</td><td>' . $offer['payout']*$offer['ratio'] .'</td><td>'; 
							$query_get_list_cc=mysqli_query($conn,"select country_cc from offers_country where offer_id='".$offer['offerId']."'");
							$list_cc="";
							while($row=mysqli_fetch_array($query_get_list_cc))
							{
								$queryCC = mysqli_query($conn,"SELECT name FROM countries WHERE cc='".$row['country_cc']."'") or die(mysqli_error());
								if(mysqli_num_rows($queryCC))
								{
									$cc = mysqli_fetch_array($queryCC);
										$list_cc.="<span style='color:green' >".$cc['name']."</span> <span style='color:red' >|</span> ";
								}
								
							}
							echo preg_replace("/<span style='color:red' >\|<\/span> $/","",$list_cc);
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
