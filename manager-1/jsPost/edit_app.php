<?php
include("../function/config.php");
if(isset($_POST['name_app']))
{
	$id=addslashes($_POST['id']);
	$name_app=addslashes($_POST['name_app']);
	$version=addslashes($_POST['version']);
	$status=addslashes($_POST['status']);
	$size=addslashes($_POST['size']);
	$link_offer=addslashes($_POST['link_offer']);
	$producer=addslashes($_POST['producer']);
	$os=addslashes($_POST['os']);
	$date_update=addslashes($_POST['date_update']);
	$content_app=addslashes($_POST['content_app']);
	$file_name = addslashes($_POST['image']); 
	$view = addslashes($_POST['view']);
	$hot = addslashes($_POST['hot']);
	$query_add_app=mysql_query("Update app_info set `name`='$name_app',`version`='$version',`size`='$size',`link_offer`='$link_offer',`producer`='$producer',`view`='$view',`link_img`='$file_name',`OS`='$os',`date_update`='$date_update',`content`='$content_app',`hot`='$hot',status='$status' where id='$id'");
	if($query_add_app)
	{
		echo "oke";
	}
	else
	{
		echo "Edit error! Please try again!";
	}
}
?>