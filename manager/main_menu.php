<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $_SESSION['userName'];?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active"><a href="./index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class=""><a href="./index.php?check_ssh"><i class="fa fa-dashboard"></i> <span>Check SSH</span></a></li>
    <?php
		if(isset($_SESSION['isAdmin']))
		{
			?>
				<li><a href="./index.php?managerapp"><i class="fa fa-edit"></i><span class="hidden-tablet"> Content App</span></a></li>
				<li class="treeview"><a href="index.php?report="><i class="fa fa-edit"></i><span> Report</span><span class="label label-important"> 3 </span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">			        	
				        <li><a href="./index.php?report=clicks"><i class="fa fa-certificate"></i>Clicks</a></li>
						<li><a href="./index.php?report=leads"><i class="fa fa-file-alt"></i> Leads</a></li>
						<li><a href="./index.php?report=offers"><i class="fa fa-globe"></i> Offers</a></li>
				      </ul>
				</li>
				<li class="treeview"><a href="index.php?offers="><i class="fa fa-briefcase"></i><span> Offers</span><span class="label label-important"> 5 </span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">			        	
				        <li><a href="./index.php?offers=android"><i class="fa fa-android"></i> Android</a></li>
						<li><a href="./index.php?offers=ios"><i class="fa fa-apple"></i> iOS</a></li>
						<li><a href="./index.php?offers=pc"><i class="fa fa-desktop"></i> PC</a></li>							
						<li><a href="./index.php?offers=table"><i class="fa fa-tablet"></i> Table</a></li>
						<li><a href="./index.php?offers=wall"><i class="fa fa-tablet"></i> Wall</a></li>
				      </ul>
				</li>

				<li class="treeview"><a href="index.php?offers="><i class="fa fa-file-archive-o"></i><span> Invoice</span><span class="label label-important"> 2 </span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">			        	
				        <li><a href="./index.php?invoice"><i class="fa fa-plus"></i> Create invoice</a></li>
				        <li><a href="./index.php?invoice=history"><i class="fa fa-history"></i> History invoice</a></li>
				      </ul>
				</li>				
				
				
				<?php
				$query_get_api=mysqli_query($conn,"Select * from get_api where action='ON' ");
				if(mysqli_num_rows($query_get_api))
				{
				?>
				<li><a class="dropmenu"  href="index.php?api_get_app="><i class="fa fa-key"></i><span class="hidden-tablet"> API Get App</span><span class="label label-important"> <?php echo mysqli_num_rows($query_get_api);?> </span></a>
					<ul>
					<?php
					while($rows=mysqli_fetch_array($query_get_api))
					{
						echo "<li><a class='submenu' href='./index.php?api_get_app=".$rows['net_name']."'><i class='icon-tag'></i><span class='hidden-tablet'>".strtoupper($rows['net_name'])."</span></a></li>";
					}
					?>
					</ul>
				</li>
				<?php
					}
					?>
				<li><a href="./index.php?users"><i class="fa fa-user"></i><span class="hidden-tablet"> Users</span></a></li>
				<li><a href="./index.php?mods"><i class="fa fa-user-md"></i><span class="hidden-tablet"> Mods</span></a></li>
				<li><a href="./index.php?networks"><i class="fa fa-globe"></i><span class="hidden-tablet"> Networks</span></a></li>
			<?php
		}
		if(isset($_SESSION['isMod']))
		{
			?>
				<li><a class="dropmenu"  href="#"><i class="fa fa-tasks"></i><span class="hidden-tablet"> Report</span><span class="label label-important"> 3 </span></a>
					<ul>
						<li><a class="submenu" href="./index.php?report=clicks"><i class="fa fa-certificate"></i><span class="hidden-tablet">Clicks</span></a></li>
						<li><a class="submenu" href="./index.php?report=leads"><i class="fa fa-file-alt"></i><span class="hidden-tablet">Leads</span></a></li>
						<li><a class="submenu" href="./index.php?report=offers"><i class="fa fa-globe"></i><span class="hidden-tablet">Offers</span></a></li>
					</ul>
				</li>
				<li><a href="./index.php?invoice"><i class="fa fa-info-sign"></i><span class="hidden-tablet"> Invoice</span></a></li>
				<li><a href="./index.php?users"><i class="fa fa-user"></i><span class="hidden-tablet"> Users</span></a></li>
			<?php
		}
		if(isset($_SESSION['isMember']))
		{
			?>
			<li>
			<a class="dropmenu"  href="./index.php?earns"><i class="fa fa-briefcase"></i><span class="hidden-tablet"> Earns</span><span class="label label-important"> 4 </span></a>
				<ul>
					<li><a class="submenu" href="./index.php?earns=android"><i class="demo-icon">&#xe800;</i><span class="hidden-tablet">Android</span></a></li>
					<li><a class="submenu" href="./index.php?earns=ios"><i class="demo-icon">&#xe803;</i><span class="hidden-tablet">iOS</span></a></li>
					<li><a class="submenu" href="./index.php?earns=pc"><i class="demo-icon">&#xe801;</i><span class="hidden-tablet">PC</span></a></li>							
					<li><a class="submenu" href="./index.php?earns=table"><i class="demo-icon">&#xe802;</i><span class="hidden-tablet">Table</span></a></li>
				</ul>
			</li>
			<li><a href="./index.php?invoice"><i class="fa fa-info-sign"></i><span class="hidden-tablet"> Invoice</span></a></li>
				<li><a class="dropmenu"  href="#"><i class="fa fa-tasks"></i><span class="hidden-tablet"> Report</span><span class="label label-important"> 3 </span></a>
					<ul>
						<li><a class="submenu" href="./index.php?report=clicks"><i class="fa fa-certificate"></i><span class="hidden-tablet">Clicks</span></a></li>
						<li><a class="submenu" href="./index.php?report=leads"><i class="fa fa-file-alt"></i><span class="hidden-tablet">Leads</span></a></li>
						<li><a class="submenu" href="./index.php?report=offers"><i class="fa fa-globe"></i><span class="hidden-tablet">Offers</span></a></li>
					</ul>
				</li>
		<?php
		}
		?>    
   <li><a href="./index.php?settings"><i class="fa fa-cogs"></i><span class="hidden-tablet"> Settings</span></a></li>
    
  </ul>
</section>