<div class="row-fluid">
<?php
	if(isset($_POST['sent_chat'])&&(isset($_SESSION['isAdmin'])||isset($_SESSION['isMod'])))
	{
		$content=addslashes($_POST['content']);
		$userName=$_SESSION['userName'];
		$date=date('Y-m-d h:m:s',time());
		if(isset($_SESSION['isAdmin']))
		{
			$manager=1;
			$groupName="";
		}
		else
		{
			$manager=0;
			$groupName=$_SESSION['groupName'];
		}
		mysqli_query($conn,"Insert into notify(`userName`,`groupName`,`manager`,`content`,`date`) value('$userName','$groupName','$manager','$content','$date')") or die(mysqli_error());
	}
?>
<div class="box blue span3" ontablet="span6" ondesktop="span3">
	<div class="box-header">
		<h2><i class="halflings-icon comment"></i><span class="break"></span>NOTIFY ADMIN</h2>
		<div class="box-icon">
			<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
		</div>
	</div>
	<div class="box-content ">
	<?php
	$groupName=(isset($_SESSION['groupName']))?$_SESSION['groupName']:"";
	if(isset($_SESSION['isAdmin']))
	{
		$notify_query=mysqli_query($conn,"Select * from notify order by id DESC limit 0,5") or die (mysqli_error());
	}
	else
	if(isset($_SESSION['isMod']))
	{
		$notify_query=mysqli_query($conn,"Select * from notify where groupName='$groupName' or manager=1 order by id DESC limit 0,5") or die (mysqli_error());
	}
	else
	{
		$notify_query=mysqli_query($conn,"Select * from notify where groupName='$groupName' or manager=1 order by id DESC limit 0,5") or die (mysqli_error());
	}
	?><div class="box_notify_admin">
	<?php
	while($notify=mysqli_fetch_array($notify_query))
	{
		$label_manager=($notify['manager']==1)?"label-important":"label-success";
	?>
		<ul class="chat">
			<li class="left">
				<span class="message notify_admin"><span class="arrow"></span>
					<span class="from label <?php echo $label_manager;?>"><?php echo $notify['userName'];?></span>
					<span class="time" style="color:black !important;"><?php echo $notify['date'];?></span>
					<span class="text" style="color:black !important;">
						<?php echo $notify['content'];?>
					</span>
				</span>	                                  
			</li>
		</ul>
	<?php
	}
	?>
	</div>
	<?php
	if(isset($_SESSION['isAdmin'])||isset($_SESSION['isMod']))
	{
	?>
		<div class="chat-form">
		<form action="./index.php" method="POST" id="form_notify">
			<input type="text" id="text_notify" name="content">
			<input type="submit" class="btn btn-info" value="Send message" name="sent_chat" />
		</form>
		</div>	
	<?php
	}
	?>
	</div>
</div>

	
	<?php
		include("./chatbox/index.php"); 
	?>

<?php
if(isset($_SESSION['isMember']))
{
?>
	<div class="box blue span3" ontablet="span6" ondesktop="span3">
	<div class="box-header">
		<h2><i class="halflings-icon comment"></i><span class="break">LEADS POINTS</span></h2>
		<div class="box-icon">
			<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
		</div>
	</div>
	<div class="box-content box_form_bottom" >
		<div id="">
			<?php
			include("./includes/content_bot/notify_leads.php");
			?>
		</div>
	</div>
</div>
<?php
}
?>

<div class="clearfix"></div>
</div>