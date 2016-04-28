<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title><?php echo $array_template_pc['title'];?></title>
	<?php echo $array_template_pc['embed_code'];?>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="<?php echo $path;?>/css/themes/default/reset.min.css" />
    <link rel="stylesheet" href="<?php echo $path;?>/css/themes/default/style.min5e1f.css?v=2" />
</head>
<body class="windows-theme bg-2" data-platform="windows">
    <div id="pages" class="indexpage">
        <?php include("header.php");?>
        <div id="content" class="clearfix">
<div class="leftads" style="  width: 160px;
  position: absolute;
  left: 0px;
  top: 0px;">
</div>

<div class="rightads" style="  width: 160px;
  position: absolute;
  right: 0px;
  top: 0px;">
</div>       

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
	if(isset($_GET['keyword']))
	{
		include("search.php");
	}
	else
	{
		include("list_app.php");
	}
?>
<?php include("top_app.php");?>


        <div class="clear"></div>
<div class="footer" id="footer">
<?php include("fotter.php");?>
    
</div>


    </div>

</body>
</html>

