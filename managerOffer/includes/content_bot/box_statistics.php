<?php
	$userName=addslashes($_SESSION['userName']);
	$today=date('Y-m-d', time());
	$first_week=date('Y-m-d', strtotime('Last Monday', time()));
	$last_week=date('Y-m-d', strtotime('Next Sunday', time()));
	$last_month=date('Y-m-t', time());
	$first_month=date('Y-m-01');
	$first_year=date('Y-01-01', time());
	$last_year=date('Y-12-31', time());
	$top_point_day_query_mem=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)='$today' group by userName order by sumpoints desc  limit 0,3") or die (mysqli_error());
	$top_point_day_query_group=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)='$today' group by groupName order by sumpoints desc  limit 0,3") or die (mysqli_error());
	$top_point_month_query_mem=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)>='$first_month' and DATE(date)<='$last_month' group by userName order by sumpoints desc limit 0,3") or die (mysqli_error());
	$top_point_month_query_group=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)>='$first_month' and DATE(date)<='$last_month'  group by groupName order by sumpoints  desc limit 0,3") or die (mysqli_error());
?>
<div class="row-fluid">
	<div class="box black span3" ontablet="span6" ondesktop="span3">
	<div class="box-header">
		<h2><i class="halflings-icon white user"></i><span class="break"></span>TOP MEM TODAY</h2>
		<div class="box-icon">
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<ul class="dashboard-list metro">
		<?php
		$s=0;
		while($top_point_day_mem=mysqli_fetch_array($top_point_day_query_mem))
		{
			if(isset($top_point_day_mem['userName']))
			{
			if($s==0)
			{
				$color="red";$icon="./img/top1.png";
			}
			else
			if($s==1)
			{
				$color="purple";$icon="./img/top2.png";
			}
			else
			{
				$color="green";$icon="./img/top3.png";
			};
		?>
			<li class="<?php echo $color;?>">
				<a href="#">
					<img class="avatar" alt="Dennis Ji" src="<?php echo $icon;?>">
				</a>
				<strong>Name:</strong><?php echo $top_point_day_mem['userName'];?><br>
				<strong>POINT:</strong><?php echo $top_point_day_mem['sumpoints'];?><br>
				<strong>GROUP:</strong> <?php echo $top_point_day_mem['groupName'];?>             
			</li>
			
		<?php
			}
		$s++;
		}
		?>
		</ul>
	</div>
</div><!--/span-->
<div class="box black span3" ontablet="span6" ondesktop="span3">
	<div class="box-header">
		<h2><i class="halflings-icon white user"></i><span class="break"></span>TOP GROUP TODAY</h2>
		<div class="box-icon">
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<ul class="dashboard-list metro">
		<?php
		$s=0;
		while($top_point_day_group=mysqli_fetch_array($top_point_day_query_group))
		{
			if($s==0)
			{
				$color="red";$icon="./img/top1.png";
			}
			else
			if($s==1)
			{
				$color="purple";$icon="./img/top2.png";
			}
			else
			{
				$color="green";$icon="./img/top3.png";
			};
		?>
			<li class="<?php echo $color;?>">
				<a href="#">
					<img class="avatar" alt="Dennis Ji" src="<?php echo $icon;?>">
				</a>
				<strong>MOD NAME:</strong><?php echo $top_point_day_group['userName'];?><br>
				<strong>POINT:</strong><?php echo $top_point_day_group['sumpoints'];?><br>
				<strong>GROUP:</strong> <?php echo $top_point_day_group['groupName'];?>             
			</li>
			
		<?php
		$s++;
		}
		?>
		</ul>
	</div>
</div><!--/span-->
<div class="box black span3" ontablet="span6" ondesktop="span3">
	<div class="box-header">
		<h2><i class="halflings-icon white user"></i><span class="break"></span>TOP MEMBER MONTH</h2>
		<div class="box-icon">
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<ul class="dashboard-list metro">
		<?php
		$s=0;
		while($top_point_month_mem=mysqli_fetch_array($top_point_month_query_mem))
		{
			if($s==0)
			{
				$color="red";$icon="./img/top1.png";
			}
			else
			if($s==1)
			{
				$color="purple";$icon="./img/top2.png";
			}
			else
			{
				$color="green";$icon="./img/top3.png";
			};
		?>
			<li class="<?php echo $color;?>">
				<a href="#">
					<img class="avatar" alt="Dennis Ji" src="<?php echo $icon;?>">
				</a>
				<strong>Name:</strong><?php echo $top_point_month_mem['userName'];?><br>
				<strong>POINT:</strong><?php echo $top_point_month_mem['sumpoints'];?><br>
				<strong>GROUP:</strong> <?php echo $top_point_month_mem['groupName'];?>             
			</li>
			
		<?php
		$s++;
		}
		?>
		</ul>
	</div>
</div><!--/span-->
<div class="box black span3" ontablet="span6" ondesktop="span3">
	<div class="box-header">
		<h2><i class="halflings-icon white user"></i><span class="break"></span>TOP GROUP MONTH</h2>
		<div class="box-icon">
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<ul class="dashboard-list metro">
		<?php
		$s=0;
		while($top_point_month_group=mysqli_fetch_array($top_point_month_query_group))
		{
			$mod_name_query=mysqli_query($conn,"Select modName from `mod` where groupName='".$top_point_month_group['groupName']."'");
			if(mysqli_num_rows($mod_name_query))
			{
			$mod_name=mysqli_fetch_array($mod_name_query);
			if($s==0)
			{
				$color="red";$icon="./img/top1.png";
			}
			else
			if($s==1)
			{
				$color="purple";$icon="./img/top2.png";
			}
			else
			{
				$color="green";$icon="./img/top3.png";
			};
		?>
			<li class="<?php echo $color;?>">
				<a href="#">
					<img class="avatar" alt="Dennis Ji" src="<?php echo $icon;?>">
				</a>
				<strong>MOD NAME:</strong><?php echo $mod_name['modName'];?><br>
				<strong>POINT:</strong><?php echo $top_point_month_group['sumpoints'];?><br>
				<strong>GROUP:</strong> <?php  echo $top_point_month_group['groupName'];?>             
			</li>
		<?php 
			$s++;
			}
		}
		?>
		</ul>
	</div>
</div><!--/span-->
</div>