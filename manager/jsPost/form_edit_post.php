<?php
include("../function/config.php");
if(isset($_POST['id_app']))
{
	$id_app=addslashes($_POST['id_app']);
	$query_app=mysql_query("select * from app_info where id='$id_app'");
	if(mysql_num_rows($query_app))
	{
		$rows=mysql_fetch_array($query_app);
		echo $id_app."||||".$rows['name']."||||".$rows['OS']."||||".$rows['size']."||||".$rows['version']."||||".$rows['link_offer']."||||".$rows['link_img']."||||".$rows['producer']."||||".$rows['content']."||||".$rows['date_update']."||||".$rows['status']."||||".$rows['view']."||||".$rows['hot'];
	}
	else
	{
		echo "error";
	}
}
?>