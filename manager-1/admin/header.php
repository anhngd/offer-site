<body>
<div id="wrapper">
    <!-- START HEADER -->
    <div id="header">
    <a class="logo" href="index.php"></a>
    <?php include("guidebtn.php");?>
		<?php if(isset($_SESSION['adminName']) && isset($_SESSION['adminPass'])){ ?>
   	</div><!-- END HEADER -->
    	<!-- START NAVIGATION -->
    <div id="nav">
	<ul id="navigation">
		<li><a href="index.php">Overview</a></li>
		<li>
			<a class="featuredOffers" href="requests.php">Requests</a>
			<ul>
				<li><a href="requesters.php">Requesters</a></li>
			</ul>
		</li>
		<li>
			<a class="featuredOffers" href="#">Reports</a>
			<ul>
			     	<li><a href="clicksReport.php">Clicks</a></li>
					<li><a href="leadsReport.php">Leads</a></li>
					<li><a href="offersReport.php">Offers</a></li>
					<li><a href="completedOffers.php">Completed Offers</a></li>
					<li><a href="networksReport.php">Networks</a></li>
					<li><a href="usersReport.php">Usernames</a></li>
					<li><a href="reqReport.php">Requesters</a></li>
					
			</ul>
		</li>
        <li>
			<a class="featuredOffers" href="offers.php">Offers</a>
			<ul>
			     	<li><a href="addOffer.php">Add Offer</a></li>
					<li><a href="import.php">Import Offer</a></li>
			</ul>
		</li>
        <li>
			<a class="featuredOffers" href="users.php">Users</a>
			<ul>
			     	<li><a href="checkUsers.php">Check Users</a></li>
					<li><a href="updateUsers.php">Update Users</a></li>
			</ul>
		</li>
        <li>
			<a class="featuredOffers" href="networks.php">Networks</a>
			<ul>
				<li><a href="walls.php">Offer Walls</a></li>
			</ul>
		</li>
		<li>
			<a class="featuredOffers" href="managerMod.php">MOD</a>
		</li>
        
	</ul>
    
   	
    <?php if(isset($_SESSION['adminName']) && isset($_SESSION['adminPass'])){ ?>
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