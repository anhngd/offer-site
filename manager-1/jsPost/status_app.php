<?php
include("../function/config.php");
if(isset($_POST['id']))
{
	$id=addslashes($_POST['id']);
	$status=addslashes($_POST['status']);
	$query_app=mysql_query("update app_info set status='$status' where id='$id'");
	if($query_app)
	{
		echo "oke";
	}
}
?>