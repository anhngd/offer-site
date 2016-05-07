<script type="text/javascript">
	$(document).ready(function(){
	$("#moretab").hover(function(){
		$("#sidebar-left").slideDown("fast");
		clearTimeout(debounce);
	});

	$("#moretab").mouseleave (function() {
		debounce = setTimeout(closeMenu,400);
	});

	var debounce;
	var closeMenu = function(){
		$("#sidebar-left").slideUp("fast");
		clearTimeout(debounce);
	}

	});

</script>
<div id="sidebar-left" class="span2">
	<div class="nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<li><a href="./index.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
			<li><a href="./index.php?check_ssh"><i class="icon-eye-open"></i><span class="hidden-tablet"> Check SSH</span></a></li>
			<?php
			if(isset($_SESSION['isAdmin']))
			{
				?>
					<li><a href="./index.php?managerapp"><i class="icon-edit"></i><span class="hidden-tablet"> Content App</span></a></li>
					<!--<li><a href="./index.php?category"><i class="icon-sitemap"></i><span class="hidden-tablet"> Category</span></a></li>-->
					<li><a class="dropmenu"  href="index.php?report="><i class="icon-tasks"></i><span class="hidden-tablet"> Report</span><span class="label label-important"> 3 </span></a>
						<ul>
							<li><a class="submenu" href="./index.php?report=clicks"><i class="icon-certificate"></i><span class="hidden-tablet">Clicks</span></a></li>
							<li><a class="submenu" href="./index.php?report=leads"><i class="icon-file-alt"></i><span class="hidden-tablet">Leads</span></a></li>
							<li><a class="submenu" href="./index.php?report=offers"><i class="icon-globe"></i><span class="hidden-tablet">Offers</span></a></li>
						</ul>
					</li>
					<li><a class="dropmenu"  href="index.php?offers="><i class="icon-briefcase"></i><span class="hidden-tablet"> Offers</span><span class="label label-important"> 5 </span></a>
						<ul>
							<li><a class="submenu" href="./index.php?offers=android"><i class="demo-icon">&#xe800;</i><span class="hidden-tablet">Android</span></a></li>
							<li><a class="submenu" href="./index.php?offers=ios"><i class="demo-icon">&#xe803;</i><span class="hidden-tablet">iOS</span></a></li>
							<li><a class="submenu" href="./index.php?offers=pc"><i class="demo-icon">&#xe801;</i><span class="hidden-tablet">PC</span></a></li>							
							<li><a class="submenu" href="./index.php?offers=table"><i class="demo-icon">&#xe802;</i><span class="hidden-tablet">Table</span></a></li>
							<li><a class="submenu" href="./index.php?offers=wall"><i class="icon-barcode"></i><span class="hidden-tablet">Wall</span></a></li>
						</ul>
					</li>
					
					<li><a class="dropmenu"  href="#"><i class="icon-info-sign"></i><span class="hidden-tablet"> Invoice</span><span class="label label-important"> 2 </span></a>
						<ul>
							<li><a class="submenu" href="./index.php?invoice"><i class="icon-legal"></i><span class="hidden-tablet"> Create invoice</span></a></li>
							<li><a class="submenu" href="./index.php?invoice=history"><i class=" icon-ok-circle
"></i><span class="hidden-tablet"> History invoice</span></a></li>
						</ul>
					</li>
					
					
					
					<?php
					$query_get_api=mysqli_query($conn,"Select * from get_api where action='ON' ");
					if(mysqli_num_rows($query_get_api))
					{
					?>
					<li><a class="dropmenu"  href="index.php?api_get_app="><i class="icon-key"></i><span class="hidden-tablet"> API Get App</span><span class="label label-important"> <?php echo mysqli_num_rows($query_get_api);?> </span></a>
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
					<li><a href="./index.php?users"><i class="icon-user"></i><span class="hidden-tablet"> Users</span></a></li>
					<li><a href="./index.php?mods"><i class="icon-user-md"></i><span class="hidden-tablet"> Mods</span></a></li>
					<li><a href="./index.php?networks"><i class="icon-globe"></i><span class="hidden-tablet"> Networks</span></a></li>
				<?php
			}
			if(isset($_SESSION['isMod']))
			{
				?>
					<li><a class="dropmenu"  href="#"><i class="icon-tasks"></i><span class="hidden-tablet"> Report</span><span class="label label-important"> 3 </span></a>
						<ul>
							<li><a class="submenu" href="./index.php?report=clicks"><i class="icon-certificate"></i><span class="hidden-tablet">Clicks</span></a></li>
							<li><a class="submenu" href="./index.php?report=leads"><i class="icon-file-alt"></i><span class="hidden-tablet">Leads</span></a></li>
							<li><a class="submenu" href="./index.php?report=offers"><i class="icon-globe"></i><span class="hidden-tablet">Offers</span></a></li>
						</ul>
					</li>
					<li><a href="./index.php?invoice"><i class="icon-info-sign"></i><span class="hidden-tablet"> Invoice</span></a></li>
					<li><a href="./index.php?users"><i class="icon-user"></i><span class="hidden-tablet"> Users</span></a></li>
				<?php
			}
			if(isset($_SESSION['isMember']))
			{
				?>
				<li>
				<a class="dropmenu"  href="./index.php?earns"><i class="icon-briefcase"></i><span class="hidden-tablet"> Earns</span><span class="label label-important"> 4 </span></a>
					<ul>
						<li><a class="submenu" href="./index.php?earns=android"><i class="demo-icon">&#xe800;</i><span class="hidden-tablet">Android</span></a></li>
						<li><a class="submenu" href="./index.php?earns=ios"><i class="demo-icon">&#xe803;</i><span class="hidden-tablet">iOS</span></a></li>
						<li><a class="submenu" href="./index.php?earns=pc"><i class="demo-icon">&#xe801;</i><span class="hidden-tablet">PC</span></a></li>							
						<li><a class="submenu" href="./index.php?earns=table"><i class="demo-icon">&#xe802;</i><span class="hidden-tablet">Table</span></a></li>
					</ul>
				</li>
				<li><a href="./index.php?invoice"><i class="icon-info-sign"></i><span class="hidden-tablet"> Invoice</span></a></li>
					<li><a class="dropmenu"  href="#"><i class="icon-tasks"></i><span class="hidden-tablet"> Report</span><span class="label label-important"> 3 </span></a>
						<ul>
							<li><a class="submenu" href="./index.php?report=clicks"><i class="icon-certificate"></i><span class="hidden-tablet">Clicks</span></a></li>
							<li><a class="submenu" href="./index.php?report=leads"><i class="icon-file-alt"></i><span class="hidden-tablet">Leads</span></a></li>
							<li><a class="submenu" href="./index.php?report=offers"><i class="icon-globe"></i><span class="hidden-tablet">Offers</span></a></li>
						</ul>
					</li>
			<?php
			}
			?>
			<li><a href="./index.php?settings"><i class="icon-cogs"></i><span class="hidden-tablet"> Settings</span></a></li>
			
		</ul>
	</div>
</div>