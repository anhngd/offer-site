<?php
	$userName=addslashes($_SESSION['userName']);
	//$today=date('Y-m-d', time());
	$today='2016-04-22';
	$first_week=date('Y-m-d', strtotime('Last Monday', time()));
	$last_week=date('Y-m-d', strtotime('Next Sunday', time()));
	$last_month=date('Y-m-t', time());
	//$first_month=date('Y-m-01');
	$first_month='2016-04-01';
	$first_year=date('Y-01-01', time());
	$last_year=date('Y-12-31', time());
	$top_point_day_query_mem=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)='$today' group by userName order by sumpoints desc  limit 0,3") or die (mysqli_error());
	$top_point_day_query_group=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)='$today' group by groupName order by sumpoints desc  limit 0,3") or die (mysqli_error());
	$top_point_month_query_mem=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)>='$first_month' and DATE(date)<='$last_month' group by userName order by sumpoints desc limit 0,3") or die (mysqli_error());
	$top_point_month_query_group=mysqli_query($conn,"Select *,sum(points) as sumpoints from leads where DATE(date)>='$first_month' and DATE(date)<='$last_month'  group by groupName order by sumpoints  desc limit 0,3") or die (mysqli_error());
?>
<div class="row-fluid col-md-12">
	<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Top members today</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
            	<ul class="products-list product-list-in-box">
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
						<li class="item">
		                  <div class="product-img">
		                    <img src="<?php echo $icon;?>" alt="Avatar">
		                  </div>
		                  <div class="product-info">
		                    <a href="javascript::;" class="product-title"><?php echo $top_point_day_mem['userName'];?> <span class="label label-warning pull-right"><?php echo $top_point_day_mem['sumpoints'];?></span></a>
		                    <span class="product-description">
		                     	<b>Group: </b><?php echo $top_point_day_mem['groupName'];?>
		                    </span>
		                  </div>
		                </li><!-- /.item -->
						
					<?php
						}
					$s++;
					}
					?>
				</ul>              
            </div><!-- /.box-body -->
        </div>
	</div>
	<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Top groups today</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
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
						<li class="item">
		                  <div class="product-img">
		                    <img src="<?php echo $icon;?>" alt="Avatar">
		                  </div>
		                  <div class="product-info">
		                    <a href="javascript::;" class="product-title"><?php echo $top_point_day_group['userName'];?> <span class="label label-warning pull-right"><?php echo $top_point_day_group['sumpoints'];?></span></a>
		                    <span class="product-description">
		                     	<b>Group: </b><?php echo $top_point_day_group['groupName'];?>
		                    </span>
		                  </div>
		                </li><!-- /.item -->
						
					<?php
					$s++;
					}
					?>
              </ul>
            </div><!-- /.box-body -->
        </div>
	</div>
	<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Top Members this Month</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
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
						<li class="item">
		                  <div class="product-img">
		                    <img src="<?php echo $icon;?>" alt="Avatar">
		                  </div>
		                  <div class="product-info">
		                    <a href="javascript::;" class="product-title"><?php echo $top_point_month_mem['userName'];?> <span class="label label-warning pull-right"><?php echo $top_point_month_mem['sumpoints'];?></span></a>
		                    <span class="product-description">
		                     	<b>Group: </b><?php echo $top_point_month_mem['groupName'];?>
		                    </span>
		                  </div>
		                </li><!-- /.item -->
						
					<?php
					$s++;
					}
					?>
              </ul>
            </div><!-- /.box-body -->
        </div>
	</div>
	<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Top Groups this Month</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
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
						<li class="item">
		                  <div class="product-img">
		                    <img src="<?php echo $icon;?>" alt="Avatar">
		                  </div>
		                  <div class="product-info">
		                    <a href="javascript::;" class="product-title"><b>Mod name: </b><?php echo $mod_name['modName'];?> <span class="label label-warning pull-right"><?php echo $top_point_month_group['sumpoints'];?></span></a>
		                    <span class="product-description">
		                     	<b>Group: </b><?php echo $top_point_month_group['groupName'];?>
		                    </span>
		                  </div>
		                </li><!-- /.item -->
					<?php 
						$s++;
						}
					}
					?>
              </ul>
            </div><!-- /.box-body -->
        </div>
    </div>
    </div>