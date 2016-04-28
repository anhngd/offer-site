<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php");?>
</head>

<body>
		<!-- start: Header -->
	<?php include("header.php");?>
		<!-- end: Header -->
		
		<div class="container-fluid-full">
		<div class="row-fluid">
			<!-- start: Main Menu -->
				<?php include("main_menu.php"); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
				<?php include("content.php");?>
			<!-- end: content -->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="clearfix"></div>
	
	<footer>
		<?php include("fotter.php");?>
	</footer>
	
	<!-- start: JavaScript-->

		<?php include("js.php");?>
	<!-- end: JavaScript-->
	
</body>
</html>
