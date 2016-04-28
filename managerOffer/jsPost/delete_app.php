<?php
include("../function/config.php");
if(isset($_POST['id_app']))
{
	$id_app=addslashes($_POST['id_app']);
	$query_app=mysql_query("delete from app_info where id='$id_app'");
	if($query_app)
	{
		echo "oke";
	}
	else
	{
		echo "error";
	}
}
?>