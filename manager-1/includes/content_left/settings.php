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

$message1="";
$final_report1="";
$final_report2="";
$final_report3="";
$final_report4="";
$final_report5="";
$final_report6="";
$final_report8="";
$final_report9="";
$final_report10="";
$final_report11="";
$final_report12="";
$final_report13="";
$final_report14="";
$final_report15="";
$final_report16="";
$final_report17="";
$final_report18="";
$final_report19="";
$final_report20="";
$final_report21="";
$final_report22="";
$final_report23="";

if(isset($_SESSION['isAdmin']))
{
	
	// Template
	if(isset($_POST['editTemplate'])){
		$template= addslashes($_POST['template']);
		$updateTemp = mysqli_query($conn,"UPDATE template SET template='".$template."'") or die(mysqli_error());   
		$final_report0.= '<span style="color: green;">Update successfully!</span>';

	}
	
	// Design
	if(isset($_POST['design'])){
		$title= addslashes($_POST['title']); 
		$des= addslashes($_POST['des']); 
		$logo= addslashes($_POST['logo']); 
		$embed_code= addslashes($_POST['embed_code']); 
		$password= addslashes($_POST['password']); 
		$temp_theme= addslashes($_POST['temp_theme']); 
		$device= addslashes($_POST['device']); 
		$path= addslashes($_POST['path']);
		$query_temp_theme=mysqli_query($conn,"Select * from temp_theme where id='$temp_theme' and path='$path'");
		if(mysqli_num_rows($query_temp_theme))
		{
			$updateTemp = mysqli_query($conn,"UPDATE template SET title='".$title."',des='".$des."',logo='".$logo."',embed_code='".$embed_code."' where device='$device'") or die(mysqli_error());
			if($device=="m")
			{
				$final_report1.= '<span style="color: green;">Update successfully!</span>';
			}
			else
			{
				$final_report1.= '<span style="color: green;">Update successfully!</span>';
			}
		}
		else
		{
			$query_temp_theme=mysqli_query($conn,"Select * from temp_theme where id='$temp_theme' and password='$password'");
			if(mysqli_num_rows($query_temp_theme))
			{
				$row_temp_theme=mysqli_fetch_array($query_temp_theme);
				$updateTemp = mysqli_query($conn,"UPDATE template SET title='".$title."',des='".$des."',logo='".$logo."',embed_code='".$embed_code."',path='".$row_temp_theme['path']."' where device='$device'") or die(mysqli_error());
				if($device=="m")
				{
				$final_report21.= '<span style="color: green;">Update successfully!</span>';
				}
				else
				{
					$final_report21.= '<span style="color: green;">Update successfully!</span>';
				}
				
			}
			else
			{
				$updateTemp = mysqli_query($conn,"UPDATE template SET title='".$title."',des='".$des."',logo='".$logo."',embed_code='".$embed_code."' where device='$device'") or die(mysqli_error());
				if($device=="m")
				{
					$final_report21.= '<span style="color: red;">Password wrong, please try again!</span>';
				}
				else
				{
					$final_report21.= '<span style="color: red;">Password wrong, please try again!</span>';
				}
			}
		}
	}

	// Edit Ratio
	if(isset($_POST['editRatio'])){
	$ratio = addslashes($_POST['ratio']);
	$ratio_vnd = addslashes($_POST['ratio_vnd']);
	$money_support = addslashes($_POST['money_support']);
		if($ratio == NULL){
			$final_report2.= "Please input ratio!";
			}else{
				
				if(strlen($ratio) <= 1 || strlen($ratio) >= 4 || $ratio < 10){
					$final_report2.="Ratio must be between 2 and 3 characters and minimum is 10!";
				} else {
				$updateRatio = mysqli_query($conn,"UPDATE admin SET ratio='".$ratio."',ratio_vnd='".$ratio_vnd."',money_support='".$money_support."'") or die(mysqli_error());   
				$final_report2.= '<span style="color: green;">Edit ratio successfully!</span>';

				}
			}
	}

	// Edit VC Name
	if(isset($_POST['editVCName'])){
	$vcName = addslashes($_POST['vcName']);
		if($vcName == NULL){
			$final_report3.= "Please input VC Name!";
			}else{
				if(strlen($vcName) <= 1 || strlen($vcName) >= 11){
					$final_report3.='<span style="color: green;">VC Name must be between 2 and 10 characters!</span>';
				} else {
				$updateVCName = mysqli_query($conn,"UPDATE admin SET vcName='".$vcName."'") or die(mysqli_error());   
				$final_report3.= '<span style="color: green;">Edit VC Name successfully!</span>';

				}
			}
	}
	if(isset($_POST['editCheckSshEarn'])){
	$check_ssh = addslashes($_POST['check_ssh']);
		if($check_ssh == "clicks"){
			$updateVCName = mysqli_query($conn,"UPDATE admin SET check_ssh='".$check_ssh."'") or die(mysqli_error());   
			$final_report4.= "Please input VC Name!";
			}else{
			$updateVCName = mysqli_query($conn,"UPDATE admin SET check_ssh='leads'") or die(mysqli_error());   
				$final_report4.= '<span style="color: green;">Edit check ssh earn successfully!</span>';

		}
	}
	
	if(isset($_POST['editNotifyLead'])){
	$notify_lead = addslashes($_POST['notify_lead']);
		if($notify_lead == "only"){
			$updateVCName = mysqli_query($conn,"UPDATE admin SET notify_lead='".$notify_lead."'") or die(mysqli_error());   
			$final_report17.= "Please notify leads successfully!";
			}
			else{
			$updateVCName = mysqli_query($conn,"UPDATE admin SET notify_lead='all'") or die(mysqli_error());   
				$final_report17.= '<span style="color: green;">Edit notify leads successfully!</span>';

		}
	}
	
	// ProxStop
	if(isset($_POST['editProxstop'])){
		$api = addslashes($_POST['api']);
		$score = addslashes($_POST['score']);
		$proxstop = addslashes($_POST['proxstop']);
		$proxWall = addslashes($_POST['proxWall']);
		$updateProxstop = mysqli_query($conn,"UPDATE admin SET proxstopAPI='".$api."', score='".$score."', proxstop='".$proxstop."', proxWall='".$proxWall."'") or die(mysqli_error());   
		$final_report5.= '<span style="color: green;">Edit ProxStop successfully!</span>';

	}
	
	// IP Quality Score
	if(isset($_POST['editIPQC'])){
		$IPQCKey = addslashes($_POST['IPQCKey']);
		$IPQC = addslashes($_POST['IPQC']);
		$updateProxstop = mysqli_query($conn,"UPDATE admin SET IPQC='".$IPQC."', IPQCKey='".$IPQCKey."'") or die(mysqli_error());   
		$final_report6.= '<span style="color: green;">Edit ProxStop successfully!</span>';

	}
	
	if(isset($_POST['editTimezone'])){
		$timezone_default = addslashes($_POST['timezone_default']);
		$updateProxstop = mysqli_query($conn,"UPDATE admin SET timezone_default='".$timezone_default."'") or die(mysqli_error());   
		$final_report7.= '<span style="color: green;">Edit Time Zone successfully!</span>';

	}
	
	if(isset($_POST['editReferer'])){
		$referer = addslashes($_POST['referer']);
		$updateReferer = mysqli_query($conn,"UPDATE admin SET newtab='".$referer."'") or die(mysqli_error());   
		$final_report8.= '<span style="color: green;">Edit Referer successfully!</span>';

	}
	
	// Lock Offers Page
	if(isset($_POST['editLockOffers'])){
		if($_POST['passOffers'] == NULL) {
			$lockOffers = addslashes($_POST['lockOffers']);
			$lockWalls = addslashes($_POST['lockWalls']);
			$updateLockOffers = mysqli_query($conn,"UPDATE admin SET lockOffers='".$lockOffers."', lockWalls='".$lockWalls."'") or die(mysqli_error());   
			$final_report9.= '<span style="color: green;">Edit successfully!</span>';

		} else {
			$pass = md5(addslashes($_POST['passOffers']));
			$lockOffers = addslashes($_POST['lockOffers']);
			$lockWalls = addslashes($_POST['lockWalls']);
			$updateLockOffers = mysqli_query($conn,"UPDATE admin SET passOffers='".$pass."', lockOffers='".$lockOffers."', lockWalls='".$lockWalls."'") or die(mysqli_error());   
			$final_report9.= '<span style="color: green;">Edit successfully!</span>';

		}
	}
	
	// Stop 2 Ips
	if(isset($_POST['editStop2ip'])){
		$stop2ip = addslashes($_POST['stop2ip']);
		$updateStop2ip = mysqli_query($conn,"UPDATE admin SET stop2ip='".$stop2ip."'") or die(mysqli_error());   
		$final_report11.= '<span style="color: green;">Edit Stop 2 Ips successfully!</span>';

	}
    // Confirm email
	if(isset($_POST['subemail'])){
		$Confiremail = addslashes($_POST['Confiremail']);
		$updateConfiremail = mysqli_query($conn,"UPDATE admin SET Confiremail='".$Confiremail."'") or die(mysqli_error());   
		$final_report12.= '<span style="color: green;">Edit Confirm email successfully!</span>';

	}
	
	// Update Board
	if(isset($_POST['updateBoard'])){
		$board = addslashes($_POST['board']);
		$updateBoard = mysqli_query($conn,"UPDATE admin SET board='$board'") or die(mysqli_error());   
		$final_report13.= '<span style="color: green;">Update rules successfully!</span>';

	}	

	// Edit Password
	if(isset($_POST['editPassword'])){
	$oldPassword = md5(addslashes($_POST['oldPassword']));
	$newPassword = md5(addslashes($_POST['newPassword']));
	$verPassword = md5(addslashes($_POST['verPassword']));

	if($_POST['oldPassword'] == NULL OR $_POST['newPassword'] == NULL OR $_POST['verPassword'] == NULL){
		$final_report14.= "Please complete all fields!";
		}else{
			$check_old_password = mysqli_query($conn,"SELECT adminPass FROM `admin` WHERE `adminPass` = '$oldPassword'") or die(mysqli_error());   
			if(mysqli_num_rows($check_old_password) != 0){
				if ($newPassword == $verPassword) {
					$editPassword = mysqli_query($conn,"UPDATE admin SET adminPass='$newPassword'") or die(mysqli_error());
					$final_report14.= '<span style="color: green;">Admin pasword has been changed!</span>';

				} else {
					$final_report14.= "Your new password does NOT match!";
				}
			} else {
				$final_report14.= "Wrong old password!";
			}
		}
	}
	
	// Show Stats in Members Page
	if(isset($_POST['editShowStats'])){
		$showStats= addslashes($_POST['showStats']);
		$updateStats = mysqli_query($conn,"UPDATE admin SET showStats='".$showStats."'") or die(mysqli_error());   
		$final_report15.= '<span style="color: green;">Update successfully!</span>';

	}
    // RESET IP TIME
    if(!isset($_POST['resettimeIP']) && isset($_POST['from'])&&$_POST['from']==NULL && $_POST['to']==NULL) {
		$message1 .= '<span style="color: #ec6b76;">Please select the time.</span>';
	} else {
		if(isset($_POST['resettimeIP']) && isset($_POST['from']) && isset($_POST['to']) && $_POST['from'] != NULL && $_POST['to'] != NULL) {
			if(isset($_POST['offerId'])&&$offerId!="")
			{
				$offerId=$_POST['offerId'];
				$query_rs="and offerId='$offerId'";
			}
			else
			{
				$query_rs="";
			}
			$from = date("Y-m-d",strtotime(addslashes($_POST['from'])));
			$to = date("Y-m-d",strtotime(addslashes($_POST['to'])));
			$query = mysqli_query($conn,"UPDATE clicks SET  ip='' WHERE (DATE(date) >= '".$from."' AND DATE(date) <='".$to."') $query_rs") or die(mysqli_error());
			$query = mysqli_query($conn,"UPDATE members SET  ip='' WHERE (DATE(date) >= '".$from."' AND DATE(date) <='".$to."')") or die(mysqli_error());
			$query = mysqli_query($conn,"UPDATE leads SET  ip='' WHERE (DATE(date) >= '".$from."' AND DATE(date) <='".$to."') $query_rs") or die(mysqli_error());
			$message1 .= 'Reset IP successfully from: <span style="color: #0093E0;">'.$from.'</span>  to: <span style="color: #0093E0;">'.$to.'</span>';
		} else 
		{
			if(isset($_POST['resettimeIP']) && $_POST['from'] == NULL || isset($_POST['to'])&&$_POST['to'] == NULL) 
			{
				$message1 .= '<span style="color: #ec6b76;">Please select the time.</span>';
			}
		}
	}
    
    
	// RESET IP
	if(isset($_POST['resetIP'])){
		$mysqli_check_pass=mysqli_query($conn,"Select * from admin where adminPass='".addslashes(md5($_POST['adminPassword']))."'");
		if(mysqli_num_rows($mysqli_check_pass))
		{
			if(isset($_POST['offerId'])&&$offerId!="")
			{
				$offerId=$_POST['offerId'];
				$query_rs="where offerId='$offerId'";
			}
			else
			{
				$query_rs="";
			}
				
			$resetIP = mysqli_query($conn,"UPDATE members SET  ip=''") or die(mysqli_error());   
			$resetIP = mysqli_query($conn,"UPDATE clicks SET  ip='' $query_rs") or die(mysqli_error());   
			$resetIP = mysqli_query($conn,"UPDATE leads SET  ip='' $query_rs") or die(mysqli_error());   
			$final_report16.= '<span style="color: green;">Reset IP successfully!</span>';
		}
		else
		{
			$final_report16.= '<span style="color: red;">Wrong Password!</span>';
		}
	}
	
	if(isset($_POST['resetChat'])){
		$mysqli_check_pass=mysqli_query($conn,"Select * from admin where adminPass='".addslashes(md5($_POST['adminPassword']))."'");
		if(mysqli_num_rows($mysqli_check_pass))
		{
			file_put_contents("./chatbox/data/content.txt","");
			$final_report20.= '<span style="color: green;">Reset chat successfully!</span>';
		}
		else
		{
			$final_report20.= '<span style="color: red;">Wrong Password!</span>';
		}
	}
	
	$query = mysqli_query($conn,"SELECT * FROM template where device='pc'") or die(mysqli_error());
	$temp_pc = mysqli_fetch_array($query);
	$query = mysqli_query($conn,"SELECT * FROM template where device='m'") or die(mysqli_error());
	$temp_m = mysqli_fetch_array($query);
	$query = mysqli_query($conn,"SELECT * FROM admin") or die(mysqli_error());
	$admin = mysqli_fetch_array($query);
?>
<div class="row-fluid">
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
		<form action="" method="POST">
			<input type="hidden" name="device" value="pc"/>
			<input type="hidden" name="path" value="<?php echo $temp_pc['path'];?>"/>
		   <table  class="table table-striped table-condensed">
				<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">TEMPLATE PC</h2></center></td></tr>
				<tr><td>Title</td><td><center><input type="text" name="title" value="<?php echo $temp_pc['title'];?>"/></center></td></tr>
				<tr><td>Description</td><td><center><input type="text" name="des" value="<?php echo $temp_pc['des'];?>"/></center></td>
				<tr><td>Logo Url</td><td><center><input type="text" name="logo" value="<?php echo $temp_pc['logo'];?>"/></center></td></tr>
				<tr><td>EMBED CODE</td><td><center><textarea name="embed_code" ><?php echo $temp_pc['embed_code'];?></textarea></center></td></tr>
				<tr><td>TEMPLATE</td><td><center>
				<select name="temp_theme">
				<?php
					$query_temp_theme=mysqli_query($conn,"Select * from temp_theme where device='pc'");
					if($query_temp_theme)
					{
						while($row_temp_theme=mysqli_fetch_array($query_temp_theme))
						{
							if($temp_pc['path']==$row_temp_theme['path'])
							{
								echo "<option selected value='".$row_temp_theme['id']."'>".$row_temp_theme['name']."</option>";
							}
							else
							{
								echo "<option value='".$row_temp_theme['id']."'>".$row_temp_theme['name']."</option>";
							}
						}
					}
				?>
				</select>
				</center></td></tr>
				<tr><td>Password theme</td><td><center><input type="password" name="password" value=""/></center></td></tr>
				<tr><td colspan='2'><center><input type="submit" name="design" class="btn btn-primary" value="Save Template" /></center></td></tr>
				<?php if($final_report1 !=""){?>
				
					<?php echo "<td colspan='2'>".$final_report1."</td>";?>
				</p>
				<?php } ?>
			</table>
		</form>
	</div>
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
		<form action="" method="POST">
			<input type="hidden" name="device" value="m"/>
			<input type="hidden" name="path" value="<?php echo $temp_m['path'];?>"/>
		   <table  class="table table-striped table-condensed">
				<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">TEMPLATE MOBILE</h2></center></td></tr>
				<tr><td>Title</td><td><center><input type="text" name="title" value="<?php echo $temp_m['title'];?>"/></center></td></tr>
				<tr><td>Description</td><td><center><input type="text" name="des" value="<?php echo $temp_m['des'];?>"/></center></td>
				<tr><td>Logo URL</td><td><center><input type="text" name="logo" value="<?php echo $temp_m['logo'];?>"/></center></td></tr>
				<tr><td>EMBED CODE</td><td><center><textarea name="embed_code" ><?php echo $temp_m['embed_code'];?></textarea></center></td></tr>
				<tr><td>TEMPLATE</td><td><center>
				<select name="temp_theme">
				<?php
					$query_temp_theme=mysqli_query($conn,"Select * from temp_theme where device='m'");
					if($query_temp_theme)
					{
						while($row_temp_theme=mysqli_fetch_array($query_temp_theme))
						{
							if($temp_m['path']==$row_temp_theme['path'])
							{
								echo "<option selected value='".$row_temp_theme['id']."'>".$row_temp_theme['name']."</option>";
							}
							else
							{
								echo "<option value='".$row_temp_theme['id']."'>".$row_temp_theme['name']."</option>";
							}
						}
					}
				?>
				</select>
				</center></td></tr>
				<tr><td>Password theme</td><td><center><input type="password" name="password" value=""/></center></td></tr>
				<tr><td colspan='2'><center><input type="submit" name="design" class="btn btn-primary" value="Save Template" /></center></td></tr>
				<?php if($final_report21 !=""){?>
				
					<?php echo "<td colspan='2'>".$final_report21."</td>";?>
				</p>
				<?php } ?>
			</table>
		</form>
	</div>
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
			<form action="" method="post">
			<table  class="table table-striped table-condensed">
				<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">CHANGE PASSWORD</h2></center></td></tr>
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
				<?php if($final_report14 !=""){?>
				
					<?php echo "<td colspan='2'>".$final_report14."</td>";?>
				</p>
				<?php } ?>
			</table>
			</form>
			<form action="" method="post">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">CONFIRM EMAIL</h2></center></td></tr>
					<tr><td>On/off?</td>
					<td><center><select name="Confiremail">
					<option value="ON" <?php if ($admin['Confiremail'] == "ON") { echo 'selected="selected"';}?>>ON</option>
					<option value="OFF" <?php if ($admin['Confiremail'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select></center>
					</td>
					</tr>
					<tr>
					<td colspan='2'>
					<center><input type="submit" name="subemail" class="btn btn-primary" value="Save" tabindex="3" /></center>
					</td>
					</tr>
					<?php if($final_report12 !=""){?>
					
						<?php echo "<td colspan='2'>".$final_report12."</td>";?>
					</p>
					<?php } ?>
				</table>
			</form>
	</div>
</div>
<div class="row-fluid">
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">				
			<form action="" method="post">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">EDIT RATIO</h2></center></td></tr>
					<tr><td>1$/points</td>
					<td><center><input type="text" title="ratio" name="ratio" class="txt" value="<?php echo $admin['ratio'];?>"/></center>
					</td>
					</tr>
					<tr><td>1 points/VND</td>
					<td><center><input type="text" title="ratio" name="ratio_vnd" class="txt" value="<?php echo $admin['ratio_vnd'];?>"/></center>
					</td>
					</tr>
					<tr><td>% Money Support</td>
					<td><center><input type="text" title="ratio" name="money_support" class="txt" value="<?php echo $admin['money_support'];?>"/></center>
					</td>
					</tr>
					<tr>
					<td colspan='2'>
					<center><input type="submit" name="editRatio" class="btn btn-primary" value="EDIT" tabindex="3" /></center>
					</td>
					</tr>
					<?php if($final_report2 !=""){?>
					
						<?php echo "<td colspan='2'>".$final_report2."</td>";?>
					</p>
					<?php } ?>
				</table>
			</form>
			<form action="" method="post">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">EDIT VIRTUAL CURRENCY NAME</h2></center></td></tr>
					<tr><td>VC Name</td>
					<td>					
						<center><input type="text" title="vcName" name="vcName" class="txt" value="<?php echo $admin['vcName'];?>"/></center>
					</td>
					</tr>
					<tr>
					<td colspan='2'>
						<center><input type="submit" name="editVCName" class="btn btn-primary" value="EDIT" tabindex="3" /></center>
					</td>
					</tr>
					<?php if($final_report3 !=""){?>
					
						<?php echo "<td colspan='2'>".$final_report3."</td>";?>
					</p>
					<?php } ?>
				</table>
			</form>	
	</div>
	
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
			<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">SET TIMEZONE</h2></center></td></tr>
					<tr><td>Time zone</td><td><center>
					<select name="timezone_default">
					<?php
						$timezones = array (
							'(GMT-11:00) Midway Island' => 'Pacific/Midway',
							'(GMT-11:00) Samoa' => 'Pacific/Samoa',
							'(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
							'(GMT-09:00) Alaska' => 'US/Alaska',
							'(GMT-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
							'(GMT-08:00) Tijuana' => 'America/Tijuana',
							'(GMT-07:00) Arizona' => 'US/Arizona',
							'(GMT-07:00) Chihuahua' => 'America/Chihuahua',
							'(GMT-07:00) La Paz' => 'America/Chihuahua',
							'(GMT-07:00) Mazatlan' => 'America/Mazatlan',
							'(GMT-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
							'(GMT-06:00) Central America' => 'America/Managua',
							'(GMT-06:00) Central Time (US &amp; Canada)' => 'US/Central',
							'(GMT-06:00) Guadalajara' => 'America/Mexico_City',
							'(GMT-06:00) Mexico City' => 'America/Mexico_City',
							'(GMT-06:00) Monterrey' => 'America/Monterrey',
							'(GMT-06:00) Saskatchewan' => 'Canada/Saskatchewan',
							'(GMT-05:00) Bogota' => 'America/Bogota',
							'(GMT-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
							'(GMT-05:00) Indiana (East)' => 'US/East-Indiana',
							'(GMT-05:00) Lima' => 'America/Lima',
							'(GMT-05:00) Quito' => 'America/Bogota',
							'(GMT-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
							'(GMT-04:30) Caracas' => 'America/Caracas',
							'(GMT-04:00) La Paz' => 'America/La_Paz',
							'(GMT-04:00) Santiago' => 'America/Santiago',
							'(GMT-03:30) Newfoundland' => 'Canada/Newfoundland',
							'(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
							'(GMT-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
							'(GMT-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
							'(GMT-03:00) Greenland' => 'America/Godthab',
							'(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
							'(GMT-01:00) Azores' => 'Atlantic/Azores',
							'(GMT-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
							'(GMT+00:00) Casablanca' => 'Africa/Casablanca',
							'(GMT+00:00) Edinburgh' => 'Europe/London',
							'(GMT+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
							'(GMT+00:00) Lisbon' => 'Europe/Lisbon',
							'(GMT+00:00) London' => 'Europe/London',
							'(GMT+00:00) Monrovia' => 'Africa/Monrovia',
							'(GMT+00:00) UTC' => 'UTC',
							'(GMT+01:00) Amsterdam' => 'Europe/Amsterdam',
							'(GMT+01:00) Belgrade' => 'Europe/Belgrade',
							'(GMT+01:00) Berlin' => 'Europe/Berlin',
							'(GMT+01:00) Bern' => 'Europe/Berlin',
							'(GMT+01:00) Bratislava' => 'Europe/Bratislava',
							'(GMT+01:00) Brussels' => 'Europe/Brussels',
							'(GMT+01:00) Budapest' => 'Europe/Budapest',
							'(GMT+01:00) Copenhagen' => 'Europe/Copenhagen',
							'(GMT+01:00) Ljubljana' => 'Europe/Ljubljana',
							'(GMT+01:00) Madrid' => 'Europe/Madrid',
							'(GMT+01:00) Paris' => 'Europe/Paris',
							'(GMT+01:00) Prague' => 'Europe/Prague',
							'(GMT+01:00) Rome' => 'Europe/Rome',
							'(GMT+01:00) Sarajevo' => 'Europe/Sarajevo',
							'(GMT+01:00) Skopje' => 'Europe/Skopje',
							'(GMT+01:00) Stockholm' => 'Europe/Stockholm',
							'(GMT+01:00) Vienna' => 'Europe/Vienna',
							'(GMT+01:00) Warsaw' => 'Europe/Warsaw',
							'(GMT+01:00) West Central Africa' => 'Africa/Lagos',
							'(GMT+01:00) Zagreb' => 'Europe/Zagreb',
							'(GMT+02:00) Athens' => 'Europe/Athens',
							'(GMT+02:00) Bucharest' => 'Europe/Bucharest',
							'(GMT+02:00) Cairo' => 'Africa/Cairo',
							'(GMT+02:00) Harare' => 'Africa/Harare',
							'(GMT+02:00) Helsinki' => 'Europe/Helsinki',
							'(GMT+02:00) Istanbul' => 'Europe/Istanbul',
							'(GMT+02:00) Jerusalem' => 'Asia/Jerusalem',
							'(GMT+02:00) Kyiv' => 'Europe/Helsinki',
							'(GMT+02:00) Pretoria' => 'Africa/Johannesburg',
							'(GMT+02:00) Riga' => 'Europe/Riga',
							'(GMT+02:00) Sofia' => 'Europe/Sofia',
							'(GMT+02:00) Tallinn' => 'Europe/Tallinn',
							'(GMT+02:00) Vilnius' => 'Europe/Vilnius',
							'(GMT+03:00) Baghdad' => 'Asia/Baghdad',
							'(GMT+03:00) Kuwait' => 'Asia/Kuwait',
							'(GMT+03:00) Minsk' => 'Europe/Minsk',
							'(GMT+03:00) Nairobi' => 'Africa/Nairobi',
							'(GMT+03:00) Riyadh' => 'Asia/Riyadh',
							'(GMT+03:00) Volgograd' => 'Europe/Volgograd',
							'(GMT+03:30) Tehran' => 'Asia/Tehran',
							'(GMT+04:00) Abu Dhabi' => 'Asia/Muscat',
							'(GMT+04:00) Baku' => 'Asia/Baku',
							'(GMT+04:00) Moscow' => 'Europe/Moscow',
							'(GMT+04:00) Muscat' => 'Asia/Muscat',
							'(GMT+04:00) St. Petersburg' => 'Europe/Moscow',
							'(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
							'(GMT+04:00) Yerevan' => 'Asia/Yerevan',
							'(GMT+04:30) Kabul' => 'Asia/Kabul',
							'(GMT+05:00) Islamabad' => 'Asia/Karachi',
							'(GMT+05:00) Karachi' => 'Asia/Karachi',
							'(GMT+05:00) Tashkent' => 'Asia/Tashkent',
							'(GMT+05:30) Chennai' => 'Asia/Calcutta',
							'(GMT+05:30) Kolkata' => 'Asia/Kolkata',
							'(GMT+05:30) Mumbai' => 'Asia/Calcutta',
							'(GMT+05:30) New Delhi' => 'Asia/Calcutta',
							'(GMT+05:30) Sri Jayawardenepura' => 'Asia/Calcutta',
							'(GMT+05:45) Kathmandu' => 'Asia/Katmandu',
							'(GMT+06:00) Almaty' => 'Asia/Almaty',
							'(GMT+06:00) Astana' => 'Asia/Dhaka',
							'(GMT+06:00) Dhaka' => 'Asia/Dhaka',
							'(GMT+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
							'(GMT+06:30) Rangoon' => 'Asia/Rangoon',
							'(GMT+07:00) Bangkok' => 'Asia/Bangkok',
							'(GMT+07:00) Hanoi' => 'Asia/Bangkok',
							'(GMT+07:00) Jakarta' => 'Asia/Jakarta',
							'(GMT+07:00) Novosibirsk' => 'Asia/Novosibirsk',
							'(GMT+08:00) Beijing' => 'Asia/Hong_Kong',
							'(GMT+08:00) Chongqing' => 'Asia/Chongqing',
							'(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
							'(GMT+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
							'(GMT+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
							'(GMT+08:00) Perth' => 'Australia/Perth',
							'(GMT+08:00) Singapore' => 'Asia/Singapore',
							'(GMT+08:00) Taipei' => 'Asia/Taipei',
							'(GMT+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
							'(GMT+08:00) Urumqi' => 'Asia/Urumqi',
							'(GMT+09:00) Irkutsk' => 'Asia/Irkutsk',
							'(GMT+09:00) Osaka' => 'Asia/Tokyo',
							'(GMT+09:00) Sapporo' => 'Asia/Tokyo',
							'(GMT+09:00) Seoul' => 'Asia/Seoul',
							'(GMT+09:00) Tokyo' => 'Asia/Tokyo',
							'(GMT+09:30) Adelaide' => 'Australia/Adelaide',
							'(GMT+09:30) Darwin' => 'Australia/Darwin',
							'(GMT+10:00) Brisbane' => 'Australia/Brisbane',
							'(GMT+10:00) Canberra' => 'Australia/Canberra',
							'(GMT+10:00) Guam' => 'Pacific/Guam',
							'(GMT+10:00) Hobart' => 'Australia/Hobart',
							'(GMT+10:00) Melbourne' => 'Australia/Melbourne',
							'(GMT+10:00) Port Moresby' => 'Pacific/Port_Moresby',
							'(GMT+10:00) Sydney' => 'Australia/Sydney',
							'(GMT+10:00) Yakutsk' => 'Asia/Yakutsk',
							'(GMT+11:00) Vladivostok' => 'Asia/Vladivostok',
							'(GMT+12:00) Auckland' => 'Pacific/Auckland',
							'(GMT+12:00) Fiji' => 'Pacific/Fiji',
							'(GMT+12:00) International Date Line West' => 'Pacific/Kwajalein',
							'(GMT+12:00) Kamchatka' => 'Asia/Kamchatka',
							'(GMT+12:00) Magadan' => 'Asia/Magadan',
							'(GMT+12:00) Marshall Is.' => 'Pacific/Fiji',
							'(GMT+12:00) New Caledonia' => 'Asia/Magadan',
							'(GMT+12:00) Solomon Is.' => 'Asia/Magadan',
							'(GMT+12:00) Wellington' => 'Pacific/Auckland',
							'(GMT+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
							);
							foreach($timezones as $k=>$v)
							{
								$selected="";
								if($admin['timezone_default']==$v)
								{
									$selected="selected='yes'";
								}
								echo "<option value='$v' $selected>$k</option>";
							}
					?>
						
					</select>
					</td></tr>
					<tr><td colspan='2'><center><input type="submit" name="editTimezone" class="btn btn-primary" value="SAVE" tabindex="3" /></center></td></tr>
					<?php if($final_report5 !=""){?>
						<?php echo "<tr><td colspan='2'>".$final_report7."</td></tr>";?>
					</p>
					<?php } ?>
				</table>
			</form>
			<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">HIDDEN REFERER</h2></center></td></tr>
					<tr><td>Referer</td><td><center><select name="referer"><option value="ON" <?php if ($admin['newtab'] == "ON") { echo 'selected="selected"';}?>>ON</option><option value="OFF" <?php if ($admin['newtab'] == "OFF") { echo 'selected="selected"';}?>>OFF</option></select></center></td>
					<tr><td colspan='2'><center><input type="submit" name="editReferer" class="btn btn-primary" value="SAVE" tabindex="3" /></center></td></tr>
					<?php if($final_report8 !=""){?>
						<?php echo "<tr><td colspan='2'>".$final_report8."</td></tr>";?>
					</p>
					<?php } ?>
				</table>
			</form>
	</div>
	
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
			<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">RESET IP IN THE PERIOD</h2></center></td></tr>
					<tr><td>OFFER ID</td><td><center><input type="text" name="offerid" value="<?php if(isset($_POST['offerId'])){echo addslashes($_POST['offerId']);}?>" /></center></td></tr>
					<tr><td>From</td><td><center><input type="text" id="date01" class="datepicker" name="from" value="<?php if(isset($_POST['from'])){echo addslashes($_POST['from']);}?>" /></center></td></tr>
					<tr><td>to</td><td><center><input type="text" id="date02" class="datepicker" name="to" value="<?php if(isset($_POST['to'])){echo addslashes($_POST['to']);} ?>"/></center></td></tr>
					<tr><td colspan='2'><center><input type="submit" name="resettimeIP" class="btn btn-primary" value="RESET" /></center></td></tr>
					<?php if($message1 !=""){?>
					
						<?php echo "<tr><td colspan='2'>".$message1."</td></tr>";?>
					<?php } ?>
				</table>
			</form>
			<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">RESET ALL IP</h2></center></td></tr>
					<tr><td>OFFER ID</td><td><center><input type="text" name="offerid" value="<?php if(isset($_POST['offerId'])){echo addslashes($_POST['offerId']);}?>" /></center></td></tr>
					<tr><td>Password</td><td><center><input type="password" id="to" name="adminPassword" value=""/></center></td></tr>
					<tr><td colspan='2'><center><input type="submit" name="resetIP" class="btn btn-primary" value="RESET ALL" tabindex="3" /></center></td></tr>
				<?php if($final_report16 !=""){ ?>
						<?php echo "<tr><td colspan='2'>".$final_report16."</td></tr>";?>
					<?php } ?>
				</table>
			</form>
			
	</div>
</div>
<div class="row-fluid">
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
		
		<form action="" method="POST">
			<table  class="table table-striped table-condensed">
				<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">CHECK SSH EARN</h2></center></td></tr>
				<tr><td>Check ssh with</td><td><center><select name="check_ssh"><option value="clicks" <?php if ($admin['check_ssh'] == "clicks") { echo 'selected="selected"';}?>>Clicks</option><option value="leads" <?php if ($admin['check_ssh'] == "leads") { echo 'selected="selected"';}?>>Leads</option></select></center></td>
				<tr><td colspan='2'><center><input type="submit" name="editCheckSshEarn" class="btn btn-primary" value="SAVE" tabindex="3" /></center></td></tr>
				<?php if($final_report4 !=""){?>
					<?php echo "<tr><td colspan='2'>".$final_report4."</td></tr>";?>
				</p>
				<?php } ?>
			</table>
		</form>
		<form action="" method="POST">
			<table  class="table table-striped table-condensed">
				<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">NOTIFY LEAD</h2></center></td></tr>
				<tr><td>Notify lead</td><td><center><select name="notify_lead"><option value="only" <?php if ($admin['notify_lead'] == "only") { echo 'selected="selected"';}?>>Only user</option><option value="all" <?php if($admin['notify_lead'] == "all") { echo 'selected="selected"';}?>>All user</option></select></center></td>
				<tr><td colspan='2'><center><input type="submit" name="editNotifyLead" class="btn btn-primary" value="SAVE" tabindex="3" /></center></td></tr>
				<?php if($final_report17 !=""){?>
					<?php echo "<tr><td colspan='2'>".$final_report17."</td></tr>";?>
				</p>
				<?php } ?>
			</table>
		</form>
		<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2' style="background:rgba(0, 149, 255, 0.59)"><center><h2 style="color:#ffffff">RESET CHAT</h2></center></td></tr>
					<tr><td>Password</td><td><center><input type="password" id="to" name="adminPassword" value=""/></center></td></tr>
					<tr><td colspan='2'><center><input type="submit" name="resetChat" class="btn btn-primary" value="RESET CHAT" tabindex="3" /></center></td></tr>
				<?php if($final_report20 !=""){ ?>
						<?php echo "<tr><td colspan='2'>".$final_report20."</td></tr>";?>
					<?php } ?>
				</table>
			</form>
	</div>
</div>
<?php
	}
?>
	</div>
</div>
<?php
	/*
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
			<form action="" method="post">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2'><center><h2>Stop 2 Ips</h2></center></td></tr>
					<tr>
					<td colspan='2'>					
						<center><select name="stop2ip">
						<option value="ON" <?php if ($admin['stop2ip'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['stop2ip'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select></center>					</td>
					</tr>
					<tr>
					<td colspan='2'>
						<center><input type="submit" name="editStop2ip" class="btn btn-primary" value="SAVE" tabindex="3" /></center>
					</td>
					</tr>
					<?php if($final_report5 !=""){?>
					
						<?php echo "<td colspan='2'>".$final_report5."</td>";?>
					</p>
					<?php } ?>
				</table>
			</form>
	</div>
	
</div>
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">
			<form action="" method="post">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2'><center><h2 style="color:#ffffff">ProxStop</h2></center></td></tr>
					<tr>
					<td>API Key</td>
					<td>					
						<center><input type="text" name="api" class="txt" value="<?php echo $admin['proxstopAPI'];?>"/></center>
					</td>
					</tr>
					<tr>
					<td>Lock Score</td>
					<td>					
						<center><select name="score">
							<?php 
								$i = 0;
								while ($i<5) {							
							?>
							<option value="<?php echo $i;?>" <?php if ($admin['score'] == $i) { echo 'selected="selected"';}?>><?php echo $i;?></option>
							<?php 
								$i++;
								}
							?>
						</select></center>
					</td>
					</tr>
					<tr>
					<td>Banner</td>
					<td>					
						<center><select name="proxstop">
						<option value="ON" <?php if ($admin['proxstop'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['proxstop'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
						</select></center>
					</td>
					</tr>
					<tr>
					<td>Wall</td>
					<td>
						<center><select name="proxWall">
						<option value="ON" <?php if ($admin['proxWall'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['proxWall'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
						</select></center>
					</td>
					</tr>
					<tr>
					<td colspan='2'>
						<center><input type="submit" name="editProxstop" class="btn btn-primary" value="SAVE" tabindex="3" /></center>
					</td>
					</tr>
					<?php if($final_report4 !=""){?>
					
						<?php echo "<td colspan='2'>".$final_report4."</td>";?>
					</p>
					<?php } ?>
				</table>
			</form>
	</div>
	<div class="box span4" style="min-height:400px" ontablet="span6" ondesktop="span4">	
			<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2'><center><h2>IP Quality Score</h2></center></td></tr>
					<tr><td>API Key</td><td><center><input type="text" name="IPQCKey" class="txt" value="<?php echo $admin['IPQCKey'];?>"/></center></td></tr>
					<tr><td>Lock</td><td><center><select name="IPQC"><option value="ON" <?php if ($admin['IPQC'] == "ON") { echo 'selected="selected"';}?>>ON</option><option value="OFF" <?php if ($admin['IPQC'] == "OFF") { echo 'selected="selected"';}?>>OFF</option></select></center></td>
					<tr><td colspan='2'><center><input type="submit" name="editIPQC" class="btn btn-primary" value="SAVE" tabindex="3" /></center></td></tr>
					<?php if($final_report11 !=""){?>
						<?php echo "<tr><td colspan='2'>".$final_report11."</td></tr>";?>
					</p>
					<?php } ?>
				</table>
			</form>
	</div><form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2'><center><h2>Rules Site</h2></center></td></tr>
					<tr><td>API Key</td><td><textarea name="board"><?php echo $admin['board'];?></textarea></td></tr>
					<tr><td colspan='2'><center><input type="submit" name="updateBoard" value="UPDATE" class="btn btn-primary" /></center></td></tr>
					<?php if($final_report6 !=""){?>
					
						<?php echo "<tr><td colspan='2'>".$final_report6."</td></tr>";?>
					</p>
					<?php } ?>
				</table>
			</form>
			<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2'><center><h2>Lock Offers Page</h2></center></td></tr>
					<tr><td>Password</td><td><input type="password" name="passOffers" class="txt" value="<?php echo $admin['passOffers'];?>"/></td></tr>
					<tr><td>Banner</td><td><select name="lockOffers"><option value="ON" <?php if ($admin['lockOffers'] == "ON") { echo 'selected="selected"';}?>>ON</option><option value="OFF" <?php if ($admin['lockOffers'] == "OFF") { echo 'selected="selected"';}?>>OFF</option></select></td></tr>
					<tr><td>Wall</td><td><select name="lockWalls"><option value="ON" <?php if ($admin['lockWalls'] == "ON") { echo 'selected="selected"';}?>>ON</option><option value="OFF" <?php if ($admin['lockWalls'] == "OFF") { echo 'selected="selected"';}?>>OFF</option></select></td></tr>
					<tr><td colspan='2'><center><input type="submit" name="editLockOffers" class="btn btn-primary" value="SAVE" tabindex="3" /></center></td></tr>
					<?php if($final_report8 !=""){?>
					
						<?php echo "<tr><td colspan='2'>".$final_report8."</td></tr>";?>
					</p>
					 } 
				</table>
			</form> 
			
			<form action="" method="POST">
				<table  class="table table-striped table-condensed">
					<tr><td colspan='2'><center><h2>Show Website Stats</h2></center></td></tr>
					<tr><td>Show</td><td><select name="showStats"><option value="ON" <?php if ($admin['showStats'] == "ON") { echo 'selected="selected"';}?>>ON</option><option value="OFF" <?php if ($admin['showStats'] == "OFF") { echo 'selected="selected"';}?>>OFF</option></select></td></tr>
					<tr><td colspan='2'><center><input type="submit" name="editShowStats" class="btn btn-primary" value="OK" tabindex="3" /></center></td></tr>
					<?php if($final_report15 !=""){?>
					
						<?php echo "<tr><td colspan='2'>".$final_report15."</td></tr>";?>
					</p>
					<?php } ?>
				</table>
			</form>*/
			?>