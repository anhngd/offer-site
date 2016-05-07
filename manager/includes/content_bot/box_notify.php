<div class="row-fluid col-md-12">
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
		<div class="col-md-6">
			<div class="box box-success">
		    <div class="box-header">
		      <i class="fa fa-comments-o"></i>
		      <h3 class="box-title">NOTIFICATION</h3>
		      <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
		        <div class="btn-group" data-toggle="btn-toggle" >
		          <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
		          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
		        </div>
		      </div>
		    </div>
		    <div class="box-body chat" id="chat-box">
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
						<!-- chat item -->
					      <div class="item">
					        <img src="../manager/assets/dist/img/user4-128x128.jpg" alt="user image" class="online">
					        <p class="message">
					          <a href="#" class="name">
					            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo $notify['date'];?></small>
					            <?php echo $notify['userName'];?>
					          </a>
					          <?php echo $notify['content'];?>
					        </p>
					      </div><!-- /.item -->  
					<?php
					}
					?>
					</div>			         
		    </div><!-- /.chat -->
		    <?php
			if(isset($_SESSION['isAdmin'])||isset($_SESSION['isMod']))
			{
			?>
				<div class="box-footer">	      
			      	<form action="./index.php" method="POST" id="form_notify">
				      	<div class="input-group">
					        <input type="text" class="form-control" placeholder="Type message..." id="text_notify" name="content">
					        <div class="input-group-btn">
					          <button type="submit" class="btn btn-success"  name="sent_chat" ><i class="fa fa-plus"></i> SEND</button>
					        </div>
				         </div>
			        </form>	     
			    </div>
			<?php
			}
			?>
		  </div><!-- /.box (chat box) -->
		</div>

		<div class="col-md-6">
			<?php
				include("./chatbox/index.php"); 
			?>
		</div>
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