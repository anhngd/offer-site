<?php
	include("./managerMember/functions/config.php");
?>
<html lang="en" ><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Game, app android free</title>
    <link type="image/x-icon" href="<?php echo $domainsite;?>favicon.ico" rel="shortcut icon">
    <!--  Core CSS -->
    <link rel="stylesheet" href="./android/css_style/app.css">
    <link rel="stylesheet" href="./android/css_style/docs.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./android/css_style/style.css">

    <!-- GA transactionsack -->
    <!-- Place this tag in your head or just before your close body tag. -->
        <link rel="stylesheet" href="./android/css_style//android.css">
    <!-- Custom Fonts -->
    <link type="text/css" rel="stylesheet" href="./android/icons-material-design.css">
    <link type="text/css" rel="stylesheet" href="./android/ekko-lightbox.css">
    <link type="text/css" rel="stylesheet" href="./android/css">
    <link type="text/css" rel="stylesheet" href="./android/css(1)">
    <link type="text/css" rel="stylesheet" href="./android/css(1)">
 </head>
<body>
<div class="navbar navbar-collapse navbar-custom navbar-fixed-top">
<nav role="navigation" class="navbar-inverse">
    <div class="container-fluid">
        
        <div class="navbar-header">
            <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a title="Appvn" href="<?php echo $domainsite;?>" class="navbar-brand"><img src="./android/Appvn-icon.png"></a>
        </div>
        
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
            <div role="search" class="navbar-form navbar-left" id="search-form">
                <form class="input-group custom-search-form" method="post" action="<?php echo $domainsite;?>/index.php?search?keyword=">
                    <input type="text" placeholder="" class="form-control" id="keyword" value="" name="keyword" autocomplete="off">
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" name="search" value="Search"> 
                    </span>
                    </form>
                
            </div>
            <ul class="nav navbar-nav navbar-right" id="join_info">
                                <li></li>
                <li></li>
                            </ul>
        </div>
        
    </div>
    
</nav>
    <div class="navtabs navtabs-fixed-top">
        
    </div>
</div>
<div role="navigation" class="navbar-default sidebar">
    <div class="sidebar-header">
        <a title="Appvn" href="<?php echo $domainsite;?>" class="navbar-brand"><img src="./android/Appvn-logo.png"></a>
    </div>
    <div class="sidebar-nav navbar-collapse">
        <ul id="side-menu" class="nav">
                        <li>
                <a href="<?php echo $domainsite;?>ios" class=""><i class="store ios"></i> iOS</a>
            </li>
                        <li>
                <a href="<?php echo $domainsite;?>android" class="active"><i class="store android"></i> Android</a>
            </li>
                        <li>
                <a href="<?php echo $domainsite;?>windowsphone" class=""><i class="store windowsphone"></i> Windowsphone</a>
            </li>
       </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<div class="navbar-default-offset"></div>
<!-- POPUP -->
<div class="modal fade" id="loginApp" tabindex="-1" role="dialog" aria-labelledby="loginAppLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:450px!important;">
        <div class="modal-content">
            <div class="login-body">
                <div class="loginForm" id="loginForm">
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END POPUP -->
<!-- POPUP -->
<div class="modal fade" id="registerApp" tabindex="-1" role="dialog" aria-labelledby="registerAppLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:450px!important;">
        <div class="modal-content">
            <div class="login-body">
                <div class="loginRegister" id="registerForm">
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END POPUP -->


<div id="page-wrapper">
<div class="container-fluid">

<div class="box-app row" id="no-keysearch" style="display: none;">
    <div class="container-fluid">
        <div class="box-app row">
            <div class="block-search view-col">
                <div class="block-list row">
                    <div class="header">
                        <h3>Please input keyword search!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-app row" styple="display:none;" id="show_main_app">
<div id="loading_tab" style="display: none;" class="header"><img src="./android/loading2.gif"></div>
<div class="block-main view-col" id="apps-center">
<div class="block-list" id="main-center">
	<div class="header">
		<h3 id="topName">New Application</h3>
	</div>
	<div class="col-list" id="auto-scroll">
		
		<?php
			$list_app_query=mysqli_query($conn,"Select * from app_info");
			if(mysqli_num_rows($list_app_query))
			{
				while($list_app=mysqli_fetch_array($list_app_query))
				{
				?>
				<div class="col-sm-6 col-lg-2 col-md-3 col-xlg-2">
					<div class="thumbnail">
						<div class="picCard">
							<a href="<?php echo $domainsite;?>index.php?details?id=<?php echo $list_app['id'];?>"><img class="lazy" alt="" style="background :url('<?php echo $domainsite."".$dir_member."/".$dir_img."/".$list_app['link_img'];?>') no-repeat center;" src="./android/default-app.png"></a>
						</div>
						<div class="caption">
							<h5 class="titleCard"><a href="<?php echo $domainsite;?>details.php?id=<?php echo $list_app['id'];?>"><?php echo $list_app['name'];?></a>
							</h5>

							<p class="subCard"><a href="<?php echo $domainsite;?>details.php?id=<?php echo $list_app['id'];?>"><?php echo $list_app['producer'];?></a></p>
							<p class="btnCard" id="no-download-19008">
								<a class="btn btn-default" href="<?php echo $domainsite;?>details.php?id=<?php echo $list_app['id'];?>">Download</a>
							</p>
						</div>
					</div>
				</div>
				<?php
				}
			}
		?>
		
	</div>
</div>

</div>
<div class="box-app row" id="collections-center"></div>
<div class="block-slidebar" id="topLeftStatus">
    <div class="block-list">
        <div class="header"><h3>Top Application</h3></div>
        <ul class="top-app list-group">
            
                                <li>
                <div class="thumbnail">
                    <div class="badge-app app-1"><span>1</span></div>
                    <div class="picCard">
                        <a href="http://appvn.com/android/details?id=com.mojang.minecraftpe"><img alt="" style="background :url('http://static.appvn.com/a/uploads/thumbnails/072014/minecraft-pocket-edition_icon.png') no-repeat center;" src="./android/default-app.png"></a>
                    </div>
                    <div class="caption">
                        <h5 class="titleCard"><a href="http://appvn.com/android/details?id=com.mojang.minecraftpe">Minecraft - Pocket Edition </a>
                        </h5>

                        <p class="subCard"><a href="http://appvn.com/android/details?id=com.mojang.minecraftpe">Mojang</a></p>
                                                <p class="btnCard" id="no-download-1577">
                            <a class="btn btn-default" href="javascript: void(0);" onclick="pc_download(1577, 'android'); _gaq.push(['_trackEvent', 'android - Top Games Download', '2015-07-13', '1577-Minecraft - Pocket Edition ']);  return false;">T?i v?</a>
                        </p>
                                                <p class="btnCard" id="downloading-1577" style="display: none;">
                            <a class="btn btn-default" href="javascript: void(0);"> Ðang t?i ... </a>
                        </p>
                    </div>
                </div>
                </li>
                                <li>
                <div class="thumbnail">
                    <div class="badge-app app-2"><span>2</span></div>
                    <div class="picCard">
                        <a href="http://appvn.com/android/details?id=com.konami.pes2012"><img alt="" style="background :url('http://static.appstore.vn/a/uploads/app/fdgfgfhhghghghg.jpg') no-repeat center;" src="./android/default-app.png"></a>
                    </div>
                    <div class="caption">
                        <h5 class="titleCard"><a href="http://appvn.com/android/details?id=com.konami.pes2012">PES 2012 (Mod PES 2015)</a>
                        </h5>

                        <p class="subCard"><a href="http://appvn.com/android/details?id=com.konami.pes2012">Konami Digital Entertainment GmbH</a></p>
                                                <p class="btnCard" id="no-download-3215">
                            <a class="btn btn-default" href="javascript: void(0);" onclick="pc_download(3215, 'android'); _gaq.push(['_trackEvent', 'android - Top Games Download', '2015-07-13', '3215-PES 2012 (Mod PES 2015)']);  return false;">T?i v?</a>
                        </p>
                                                <p class="btnCard" id="downloading-3215" style="display: none;">
                            <a class="btn btn-default" href="javascript: void(0);"> Ðang t?i ... </a>
                        </p>
                    </div>
                </div>
                </li>
                                <li>
                <div class="thumbnail">
                    <div class="badge-app app-3"><span>3</span></div>
                    <div class="picCard">
                        <a href="http://appvn.com/android/details?id=com.outfit7.mytalkingtomfree"><img alt="" style="background :url('http://static.appvn.com/a/uploads/thumbnails/022014/my-talking-tom-icon.png') no-repeat center;" src="./android/default-app.png"></a>
                    </div>
                    <div class="caption">
                        <h5 class="titleCard"><a href="http://appvn.com/android/details?id=com.outfit7.mytalkingtomfree">My Talking Tom - Virtual Pet (Unlimited Coins)</a>
                        </h5>

                        <p class="subCard"><a href="http://appvn.com/android/details?id=com.outfit7.mytalkingtomfree"> Outfit7 </a></p>
                                                <p class="btnCard" id="no-download-20172">
                            <a class="btn btn-default" href="javascript: void(0);" onclick="pc_download(20172, 'android'); _gaq.push(['_trackEvent', 'android - Top Games Download', '2015-07-13', '20172-My Talking Tom - Virtual Pet (Unlimited Coins)']);  return false;">T?i v?</a>
                        </p>
                                                <p class="btnCard" id="downloading-20172" style="display: none;">
                            <a class="btn btn-default" href="javascript: void(0);"> Ðang t?i ... </a>
                        </p>
                    </div>
                </div>
                </li>
                                
                                
                                
                                
                                
                                
                                <li>
                <div class="thumbnail">
                    <div class="badge-app app-10"><span>10</span></div>
                    <div class="picCard">
                        <a href="http://appvn.com/android/details?id=com.konami.ygodgtest"><img alt="" style="background :url('http://static.appvn.com/a/uploads/thumbnails/122014/yu-gi-oh-duel-generation_icon.png') no-repeat center;" src="./android/default-app.png"></a>
                    </div>
                    <div class="caption">
                        <h5 class="titleCard"><a href="http://appvn.com/android/details?id=com.konami.ygodgtest">Yu-Gi-Oh! Duel Generation (Infinite YGO Points)</a>
                        </h5>

                        <p class="subCard"><a href="http://appvn.com/android/details?id=com.konami.ygodgtest">Konami Digital Entertainment, Inc.</a></p>
                                                <p class="btnCard" id="no-download-29785">
                            <a class="btn btn-default" href="javascript: void(0);" onclick="pc_download(29785, 'android'); _gaq.push(['_trackEvent', 'android - Top Games Download', '2015-07-13', '29785-Yu-Gi-Oh! Duel Generation (Infinite YGO Points)']);  return false;">T?i v?</a>
                        </p>
                                                <p class="btnCard" id="downloading-29785" style="display: none;">
                            <a class="btn btn-default" href="javascript: void(0);"> Ðang t?i ... </a>
                        </p>
                    </div>
                </div>
                </li>
                            
        </ul>
    </div>
</div>
</div>
<div id="loading-data-top" style="display: none;">Downloading ... <center><img src="./android/processing2.gif"></center></div>
<div class="box-app row" styple="display:none;" id="show_main_search" style="display: none;">
    <div id="loading_tab_search" style="display: none;" class="header"><center><img src="./android/loading2.gif"></center></div>
    <!-- Hi?n th? d? li?u t?m ki?m-->
</div>
<div id="loading-data-bottom" style="display: none;">Downloading ... <center><img src="./android/processing2.gif"></center></div>
</div>

</div>
<div id="fb-root" class=" fb_reset fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://static.ak.facebook.com/connect/xd_arbiter/xRlIuTsSMoE.js?version=41#channel=f9a22a5c4&amp;origin=file%3A%2F%2F" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://s-static.ak.facebook.com/connect/xd_arbiter/xRlIuTsSMoE.js?version=41#channel=f9a22a5c4&amp;origin=file%3A%2F%2F" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://static.ak.facebook.com/connect/xd_arbiter/xRlIuTsSMoE.js?version=41#channel=f28d64c51&amp;origin=file%3A%2F%2F" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://s-static.ak.facebook.com/connect/xd_arbiter/xRlIuTsSMoE.js?version=41#channel=f28d64c51&amp;origin=file%3A%2F%2F" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div>


<div id="fb-root" class=" fb_reset fb_reset fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div></body></html>