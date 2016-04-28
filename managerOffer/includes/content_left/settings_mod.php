<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>SETTINGS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">
<?php

$final_report2="";

if(isset($_SESSION['isMod']))
{ 
	
	// Edit Password
	if(isset($_POST['editPassword'])){
	$oldPassword = md5($_POST['oldPassword']);
	$newPassword = md5($_POST['newPassword']);
	$verPassword = md5($_POST['verPassword']);

	if($_POST['oldPassword'] == NULL OR $_POST['newPassword'] == NULL OR $_POST['verPassword'] == NULL){
		$final_report2.= "Please complete all fields!";
		}else{
			$check_old_password = mysqli_query($conn,"SELECT modPass FROM `mod` WHERE `modPass` = '$oldPassword'  and modName='".$_SESSION['modName'] ."'") or die(mysqli_error());   
			if(mysqli_num_rows($check_old_password) != 0){
				if ($newPassword == $verPassword) {
					$editPassword = mysqli_query($conn,"UPDATE `mod` SET modPass='$newPassword' where modName='".$_SESSION['modName'] ."'") or die(mysqli_error());
					$final_report2.= '<span style="color: green;">Mod pasword has been changed!</span>';

				} else {
					$final_report2.= "Your new password does NOT match!";
				}
			} else {
				$final_report2.= "Wrong old password!";
			}
		}
	}
	

?>
	<div class="container_table">
	<form action="" method="post">
	<table style="width:50%;margin:10px auto" class="table table-bordered table-striped table-condensed">
		<tr><td colspan='2'><center><h2>Edit Password</h2></center></td></tr>
		<tr>
			<td>
				Old password
			</td>
			<td>
				<center><input type="password" title="old_password" name="oldPassword" class="txt" /></center>
			</td>
		</tr>
		<tr>
			<td>
				New password
			</td>
			<td>
				<center><input type="password" title="new_password" name="newPassword" class="txt" /></center>
			</td>
		</tr>
		<tr>
			<td>
				Confirm password
			</td>
			<td>
				<center><input type="password" title="ver_new_password" name="verPassword" class="txt"/></center>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<center><input type="submit" name="editPassword" class="btn btn-primary" value="Change Password" tabindex="3" /></center>
			</td>
		</tr>
	</table>
	</form>
	</div>
	<?php if($final_report2 !=""){?>
	
		<?php echo $final_report2;?>
	</p>
	<?php 
	} 
}
?>
	</div>
</div>
