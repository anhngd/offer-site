<section class="content-header">
  <h1>
    Dashboard
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>
    	<a href="#">
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
		</a>
	</li>
  </ol>
</section>

<div class="row-fluid">
	<!-- start:contentLeft -->
	<?php include("./includes/content_left/index.php");?>
	<!-- end:contentLeft -->

	<!-- start:contentRight -->
	<?php include("./includes/content_bot/index.php");?>
	<!-- end:contentRight -->
</div><!--/row-->

