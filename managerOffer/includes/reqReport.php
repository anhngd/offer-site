<?php
session_start();
include_once("../function/config.php");
include("../function/fnc.php");
include("../function/includes.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
	

	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel : Users Report</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
		<script type="text/javascript" src="../jquery/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript">
	// DatePicker
	$(function() {
    $( "#from" ).datepicker({
      defaultDate: "-1w",
	  dateFormat: "yy-mm-dd",
      changeMonth: true,
	  changeYear: true,
	  showOtherMonths: true,
      selectOtherMonths: true,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "",
	  dateFormat: "yy-mm-dd",
      changeMonth: true,
	  changeYear: true,
	  showOtherMonths: true,
      selectOtherMonths: true,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
	// DatePicker
	
</script>
</head>

<?php include("header.php") ?>
   
    <div id="content">
		<div class="reqReport">
			<h2>Requester Report</h2>
			<div class="filterdata">
				<form action="#" method="POST">
				<label class="label" for="from">Start Date</label>
				<input type="text" id="from" name="from" value="<?php if(isset($_POST['from'])) {echo $_POST['from'];}?>" /><br>
				<label class="label" for="to">End Date</label>
				<input type="text" id="to" name="to" value="<?php if(isset($_POST['to'])) {echo $_POST['to'];}?>" /><br>
				<label class="label" for="network">Network</label>
				<select name="network">
					<option value=""></option>
					<?php 
					$queryNwk = mysql_query("SELECT name FROM networks") or die(mysql_error());
					while($nwk = mysql_fetch_array($queryNwk)) {
					?>
					<option value="<?php echo $nwk['name'];?>" <?php if($nwk['name']==$_POST['network']) { echo 'selected="selected"'; }?>><?php echo $nwk['name'];?></option>
					<?php } ?>
					<?php 
					$queryWall = mysql_query("SELECT name FROM walls") or die(mysql_error());
					while($wall = mysql_fetch_array($queryWall)) {
					?>
					<option value="<?php echo $wall['name'];?>" <?php if($wall['name']==$_POST['network']) { echo 'selected="selected"'; }?>><?php echo $wall['name'];?></option>
					<?php } ?>
				</select><br>
				<textarea class="textarea" name="requestersList"><?php if(isset($_POST['requestersList'])) echo $_POST['requestersList'];?></textarea><br>
				<input type="submit" name="filterReq" value="Filter Data" />
				</form>
			</div>
			
			<div class="clear"></div>
			<table cellspacing="0" class="tablesorterreq">
				<thead>
					<tr>
						<th>Requester</th>
						<th>Network</th>
						<th>Points</th>
						<th>Accounts</th>
					</tr>
				</thead>
				<tbody>
						<?php
							if(isset($_POST['filterReq'])) {
								if($_POST['from']==NULL || $_POST['to']==NULL || $_POST['network']==NULL) {
									$message2 .= '<span style="color: #F00;">Please input all fields!</span>';
								} else {
									$network = $_POST['network'];
									$from = $_POST['from'];
									$to = $_POST['to'];
									$text = trim($_POST['requestersList']);
									//explode all separate lines into an array
									$textAr = explode("\r\n", $text);
									//trim all lines contained in the array.
									$textAr = array_filter($textAr, 'trim');		
									$uarray = array_unique($textAr);							
									//Tong point
									
									foreach ($uarray as $req){
										$totalpoints ='';
											$totalacc = '';
										$queryUsersbyReq = mysql_query("SELECT userName FROM members WHERE requester='".$req."'") or die(mysql_error());
										while($user = mysql_fetch_assoc($queryUsersbyReq)) {
											
											$username = $user['userName'];
											$query = mysql_query("SELECT SUM(points) AS userPoints FROM leads WHERE (userName='".$username."' AND offerNwk='".$network."' AND DATE(date) >= '".$from."' AND DATE(date) <='".$to."') GROUP BY userName") or die(mysql_error());
												while($result = mysql_fetch_array($query)) {
													$totalacc +=1;
													$totalpoints += $result['userPoints'];
												}
										}
										echo '<tr><td>'.$req.'</td><td>'.$network.'</td><td>'.$totalpoints.'</td><td>'.$totalacc.'</td></tr>';
									}
									$message2 .= 'From: <span style="color: #0093E0;">'.$from.'</span>  To: <span style="color: #0093E0;">'.$to.'</span>';
								}
								if($message2 !=""){
									echo '<tr><td colspan="4">';
									echo $message2;
									echo '</td></tr>';
								} 
							}
						?>
						
				</tbody>
			</table>

		 </div>		 
		 
		
    </div>
</div>
<div id="footer">
<div id="footerx">
	<div id="footertext"><a href="<?php echo $videof1 ?>" target="_blank"><img src="<?php $yourdomain?>/images/apple_icon.png" alt="Protected by ProxStop"/></a><br>
		&copy; 2013 Version 1.0.Design by F1scodes.
    </div>
    <div id="face"><a href="<?php echo $videof1 ?>" target="_blank"><img src="<?php $yourdomain?>/images/face1.png" alt="Protected by ProxStop"/></a></div>
</div>
</body>
</html>