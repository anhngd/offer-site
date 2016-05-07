<div id="content" class="span11">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a> 
			<i class="icon-angle-right"></i>
		</li>
		<li><a href="#">
		<?php 
			if(isset($_GET['mods']))
			{
				echo "Manager Mods";
			}
			else
			if(isset($_GET['category']))
			{
				echo "Category";
			}
			else
			if(isset($_GET['users']))
			{
				echo "Manager Users";
			}
			else
			if(isset($_GET['networks']))
			{
				echo "Manager Networks";
			}
			else
			if(isset($_GET['offers']))
			{
				echo "Manager Offers";
			}
			else
			if(isset($_GET['report']))
			{
				if($_GET['report']=="clicks")
				{
					echo "Report Clicks";
				}
				else
				if($_GET['report']=="leads")
				{
					echo "Report Leads";
				}
				else
				if($_GET['report']=="offers")
				{
					echo "Report Offers";
				}
			}
		?>
		</a></li>
	</ul>

	<div class="row-fluid">
	<!-- start:contentLeft -->
	<?php include("./includes/content_left/index.php");?>
	<!-- end:contentLeft -->
	
	<!-- start:contentRight -->
	<?php include("./includes/content_bot/index.php");?>
	<!-- end:contentRight -->
	
	
	</div><!--/row-->
</div><!--/.fluid-container-->

