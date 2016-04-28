<html lang="en" ><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title><?php echo $array_template_pc['title'];?></title>
    <link type="image/x-icon" href="<?php echo $path;?>favicon.ico" rel="shortcut icon">
    <!--  Core CSS -->
    <link rel="stylesheet" href="<?php echo $path;?>/css_style/app.css">
    <link rel="stylesheet" href="<?php echo $path;?>/css_style/docs.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $path;?>/css_style/style.css">
	<?php echo $array_template_pc['embed_code'];?>
    <!-- GA transactionsack -->
    <!-- Place this tag in your head or just before your close body tag. -->
        <link rel="stylesheet" href="<?php echo $path;?>/css_style/android.css">
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
            <a title="Appvn" href="<?php echo $domainsite;?>" class="navbar-brand"><img src="<?php echo $path;?>/Appvn-icon.png"></a>
        </div>
        
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
            <div role="search" class="navbar-form navbar-left" id="search-form">
                <form class="input-group custom-search-form" method="post" action="<?php echo $domainsite;?>/index.php?search">
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
        <a title="Appvn" href="<?php echo $domainsite;?>" class="navbar-brand"><img src="<?php echo $array_template_pc['logo'];?>"></a>
    </div>
    <div class="sidebar-nav navbar-collapse">
        <ul id="side-menu" class="nav">
                        <li>
                <a href="<?php echo $domainsite;?>/index.php?os=ios" class="<?php if(isset($_GET['os'])&&$_GET['os']=='ios'){echo "active";} ?>"><i class="store ios"></i> iOS</a>
            </li>
                        <li>
                <a href="<?php echo $domainsite;?>/index.php?os=android" class="<?php if(isset($_GET['os'])&&$_GET['os']=='android'){echo "active";} ?>"><i class="store android"></i> Android</a>
            </li>
                        <li>
                <a href="<?php echo $domainsite;?>/index.php?os=windowsphone" class="<?php if(isset($_GET['os'])&&$_GET['os']=='windowsphone'){echo "active";} ?>"><i class="store windowsphone"></i> Windowsphone</a>
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


<div class="box-app row" styple="display:none;" id="show_main_app">
<div id="loading_tab" style="display: none;" class="header"><img src="<?php echo $path;?>/loading2.gif"></div>
<div class="block-main view-col" id="apps-center">
	<?php
		if(isset($_GET['details']))
		{
			include("details.php");
		}
		else
		if(isset($_GET['os']))
		{
			include("os.php");
		}
		else
		if(isset($_GET['search']))
		{
			include("search.php");
		}
		else
		{
			include("list_app.php");
		}
	?>
</div>
<div class="box-app row" id="collections-center"></div>
<div class="block-slidebar" id="topLeftStatus">
    <div class="block-list">
        <div class="header"><h3>Top Application</h3></div>
		<?php include("top_app.php"); ?>
    </div>
</div>
</div>
<div id="loading-data-top" style="display: none;">Downloading ... <center><img src="<?php echo $path;?>/processing2.gif"></center></div>
<div class="box-app row" styple="display:none;" id="show_main_search" style="display: none;">
    <div id="loading_tab_search" style="display: none;" class="header"><center><img src="<?php echo $path;?>/loading2.gif"></center></div>
    <!-- Hi?n th? d? li?u t?m ki?m-->
</div>
<div id="loading-data-bottom" style="display: none;">Downloading ... <center><img src="<?php echo $path;?>/processing2.gif"></center></div>
</div>

</div>
<div id="fb-root" class=" fb_reset fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div>


<div id="fb-root" class=" fb_reset fb_reset fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div></body></html>