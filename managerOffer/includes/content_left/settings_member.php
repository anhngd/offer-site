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
$query_member=mysqli_query($conn,"select * from members where userName='".$_SESSION['userName'] ."'");
$row_member=mysqli_fetch_array($query_member);
$final_report2="";
$final_report3="";

if(isset($_SESSION['isMember']))
{ 
	if(isset($_POST['editPassword']))
	{
		$oldPassword = addslashes($_POST['oldPassword']);
		$newPassword = addslashes($_POST['newPassword']);
		$verPassword = addslashes($_POST['verPassword']);

		if($_POST['oldPassword'] == NULL OR $_POST['newPassword'] == NULL OR $_POST['verPassword'] == NULL)
		{
		$final_report2.= "Please complete all fields!";
		}
		else{
			$check_old_password = mysqli_query($conn,"SELECT userPassword FROM `members` WHERE `userPassword` = '$oldPassword' and userName='".$_SESSION['userName'] ."'") or die(mysqli_error());   
			if(mysqli_num_rows($check_old_password) != 0){
				if ($newPassword == $verPassword) {
					$editPassword = mysqli_query($conn,"UPDATE `members` SET userPassword='$newPassword' where userName='".$_SESSION['userName']."'") or die(mysqli_error());
					$final_report2.= '<span style="color: green;">User pasword has been changed!</span>';

				} else {
					$final_report2.= "Your new password does NOT match!";
				}
			} else {
				$final_report2.= "Wrong old password!";
			}
		}
	}
	
	if(isset($_POST['editBilling']))
	{
		$skype = addslashes($_POST['skype']);
		$phone = addslashes($_POST['phone']);
		$bank = addslashes($_POST['bank']);
		$name = addslashes($_POST['name']);
		$city = addslashes($_POST['city']);
		$password = addslashes($_POST['password']);

		if($_POST['password'] == NULL OR $_POST['bank'] == NULL OR $_POST['skype'] == NULL OR $_POST['name'] == NULL OR $_POST['city'] == NULL)
		{
			$final_report2.= "Please complete all fields!";
		}
		else
		{
			$check_old_password = mysqli_query($conn,"SELECT userPassword FROM `members` WHERE `userPassword` = '$password' and userName='".$_SESSION['userName'] ."'") or die(mysqli_error());   
			if(mysqli_num_rows($check_old_password) != 0){
					$editPassword = mysqli_query($conn,"UPDATE `members` SET `skype`='$skype',`phone`='$phone',`bank`='$bank',`name`='$name',`city`='$city' where userName='".$_SESSION['userName']."'") or die(mysqli_error());
					if($editPassword)
					{
						$final_report3.= '<span style="color: green;">Info billing has been changed!</span>';
					}
					else
					{
						$final_report3.= "Changing billing information failed";
					}

			} else {
				$final_report3.= "Wrong old password!";
			}
		}
	}
	
	
?>
	<div class="row-fluid">
		<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
			<form action="" method="POST">
			   <table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">EDIT PASSWORD</h2></center></td></tr>
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
					
					<tr><td colspan='2'><center><input type="submit" name="editPassword" class="btn btn-primary" value="Save Template" /></center></td></tr>
					<?php if($final_report2 !=""){?>
					
						<?php echo "<td colspan='2'>".$final_report2."</td>";?>
					</p>
					<?php } ?>
				</table>
			</form>
		</div>
	
		
		<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
			<form action="" method="POST">
			   <table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">BILLING INFORMATION</h2></center></td></tr>
					<tr>
						<td>
							Skype
						</td>
						<td>
							<center><input type="text" title="skype" name="skype" value='<?php echo $row_member['skype']?>' class="txt" /></center>
						</td>
					</tr>
					<tr>
						<td>
							Name
						</td>
						<td>
							<center><input type="text" title="name" name="name" value='<?php echo $row_member['name']?>' class="txt" /></center>
						</td>
					</tr>
					<tr>
						<td>
							City
						</td>
						<td>
							<center><input type="text" title="city" name="city" value='<?php echo $row_member['city']?>' class="txt"/></center>
						</td>
					</tr>
					<tr>
						<td>
							Phone
						</td>
						<td>
							<center><input type="text" title="phone" name="phone" value='<?php echo $row_member['phone']?>' class="txt"/></center>
						</td>
					</tr>
					<tr>
						<td>
							Bank
						</td>
						<td>
							<center><input type="text" title="bank" name="bank" value='<?php echo $row_member['bank']?>' class="txt"/></center>
						</td>
					</tr>
					<tr>
						<td>
							Password
						</td>
						<td>
							<center><input type="password" title="password" name="password" class="txt"/></center>
						</td>
					</tr>
					
					<tr><td colspan='2'><center><input type="submit" name="editBilling" class="btn btn-primary" value="Save Template" /></center></td></tr>
					<?php if($final_report3 !=""){?>
					
						<?php echo "<td colspan='2'>".$final_report3."</td>";?>
					</p>
					<?php } ?>
				</table>
			</form>
		</div>
	<?php
}
?>
	</div>
</div>
