<?php
	$text = "";
	if(isset($_GET['mods']))
	{
		$text = "Manager Mods";
	}
	else
	if(isset($_GET['category']))
	{
		$text =  "Category";
	}
	else
	if(isset($_GET['users']))
	{
		$text =  "Manager Users";
	}
	else
	if(isset($_GET['networks']))
	{
		$text =  "Manager Networks";
	}
	else
	if(isset($_GET['offers']))
	{
		$text =  "Manager Offers";
	}
	else
	if(isset($_GET['report']))
	{
		if($_GET['report']=="clicks")
		{
			$text =  "Report Clicks";
		}
		else
		if($_GET['report']=="leads")
		{
			$text =  "Report Leads";
		}
		else
		if($_GET['report']=="offers")
		{
			$text =  "Report Offers";
		}
	}
?>

<section class="content-header">
  <h1>  		
    <?php echo $text; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>
    	<a href="#">
			<?php echo $text; ?>
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

