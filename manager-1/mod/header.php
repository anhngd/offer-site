<body>
<div id="wrapper">
    <!-- START HEADER -->
    <div id="header">
    <a class="logo" href="index.php"></a>
    <?php include("guidebtn.php");?>
		<?php if(isset($_SESSION['modName']) && isset($_SESSION['modPass'])){ ?>
   	</div><!-- END HEADER -->
    	<!-- START NAVIGATION -->
    <div id="nav">
	<ul id="navigation">
		<li><a href="index.php">Overview</a></li>
		<li><a href="clicksReport.php">Clicks</a></li>
		<li><a href="leadsReport.php">Leads</a></li>
        <li><a class="featuredOffers" href="users.php">Users</a></li>
	</ul>
    <?php if(isset($_SESSION['modName']) && isset($_SESSION['modPass'])){ ?>
    <div id="setset">
    <div id="set0">
    <ul id="set1">
			<li><a href="setting.php"><img src="../images/settings.png" alt="Setting"/></a></li>
    </ul>
    </div>
            
        <div id="logout0">
        <ul id="logout0">
			<li><a href="logout.php"><img src="../images/logout.png" alt="Exit"/></a></li>
        </ul>
        </div></div>
			<?php } ?>
             <?php } ?>
    </div>       	
    <!-- END NAVIGATION -->