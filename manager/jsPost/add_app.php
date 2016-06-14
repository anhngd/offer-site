<?php
include("../function/config.php");
if(isset($_POST['name_app']))
{
	$name_app=addslashes($_POST['name_app']);
	$version=addslashes($_POST['version']);
	$status=addslashes($_POST['status']);
	$size=addslashes($_POST['size']);
	$link_offer=addslashes($_POST['link_offer']);
	$producer=addslashes($_POST['producer']);
	$os=addslashes($_POST['os']);
	$view=addslashes($_POST['view']);
	$date_update=addslashes($_POST['date_update']);
	$content_app=addslashes($_POST['content_app']);
	$file_name = addslashes($_POST['image']); 
	$hot = addslashes($_POST['hot']); 
	$query_add_app=mysqli_query($conn,"Insert into app_info(`name`,`version`,`size`,`link_offer`,`producer`,`link_img`,`OS`,`date_update`,`content`,`status`,`view`,`hot`) value('$name_app','$version','$size','$link_offer','$producer','$file_name','$os','$date_update','$content_app','$status','$view','$hot')");
	if($query_add_app)
	{
		echo "oke";
	}
	else
	{
		echo "Add app error! Please try again!";
	}
}
?>