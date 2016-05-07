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
	$final_report2="";
	if(isset($_POST['editWall']))
	{
		$id = addslashes($_POST['id']);
		$name = addslashes($_POST['name']);
		$iframe = htmlentities($_POST['iframe'],ENT_QUOTES);
		$key = addslashes($_POST['key']);
		$status = addslashes($_POST['status']);
		$os = addslashes($_POST['OS']);
		$editWalls = mysqli_query($conn,"UPDATE `walls` SET `iframe`='$iframe', `name`='$name', `secretKey`='$key', `status`='$status', `os`='$os' WHERE id='".$id."'") or die(mysqli_error());
		$final_report2.= 'Edited successfully !';	
	}
	if(isset($_POST['addWall']))
	{
		$name = addslashes($_POST['name']);
		$iframe = htmlentities($_POST['iframe'],ENT_QUOTES);
		$key = addslashes($_POST['key']);
		$os = addslashes($_POST['OS']);
		$editWalls = mysqli_query($conn,"INSERT INTO `walls`(`name`,`iframe`,`secretKey`,`status`,os) value ('$name','$iframe','$key','ON','$os')") or die (mysqli_error());		
		$final_report2.= 'Add successfully !';	
	}
	
?>
<div style="height:40px;margin:5px;">
	<div style="float:right;">
		<span name="check_ssh" class="btn btn-info" href="#" id="button_add_app"  onclick="show_add_wall()">ADD OFFERS</span>
	</div>
</div>
<div id="reponse_post"><?php if(isset($final_report2)) echo "<span style=color:red>$final_report2</span>"; ?></div>

	<div style="clear:both;"></div>
<?php

	if(isset($_POST['delOffers']) && isset($_POST['id'])){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $delOffers = mysqli_query($conn,"DELETE FROM walls WHERE id ='".addslashes($_POST['id'][$i])."'") or die(mysqli_error());
        }
        header("Location: index.php?offers=wall");
	}
    if(isset($_POST['offOffers']) && isset($_POST['id'])){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $offOffers = mysqli_query($conn,"UPDATE walls SET status='OFF'  WHERE id ='".addslashes($_POST['id'][$i])."'") or die(mysqli_error());
        }
        header("Location: index.php?offers=wall");
	}
	if(isset($_POST['onOffers']) && isset($_POST['id'])){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $offOffers = mysqli_query($conn,"UPDATE walls SET status='ON'  WHERE id ='".addslashes($_POST['id'][$i])."'") or die(mysqli_error());
        }
        header("Location: index.php?offers=wall");
	}

?>
			<div class="container_table">
			<form action="./index.php?offers=wall" method="POST">
			<table  id="list_members" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed">
				<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Iframe</th>
					<th>KEY</th>
					<th>Status</th>
					<th>OS</th>
					<th colspan='2'>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					
						$queryoffers = mysqli_query($conn,"SELECT * FROM `walls`") or die(mysqli_error());
						while($offerWall = mysqli_fetch_array($queryoffers)) {
							echo '<tr id="tr_'.$offerWall['id'].'">';
							echo '<td>' .$offerWall['id'] .'<span class="idcheckbox"><input name="id[]" type="checkbox" value="'.$offerWall['id'].'"/></span></td>';
							echo '<td>' . $offerWall['name'] .'</td>'; 
							echo '<td><textarea>' . $offerWall['iframe'] .'</textarea></td>';
							echo '<td>'. $offerWall['secretKey'] .'</td>';
							echo '<td>'. $offerWall['status'] .'</td>';
							echo '<td>'.  strtoupper($offerWall['OS']) .'</td>';
							echo '<td><a class="btn btn-warning button_tb manager mousepointer" onclick="show_edit_wall(\''.$offerWall['id'].'\')">Edit</a></td>';
							echo '&nbsp;';
							//echo '<td><a class="btn btn-danger button_tb manager mousepointer" onclick="delete_wall(\''.$offerWall['id'].'\')">Delete</a></td>';
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
