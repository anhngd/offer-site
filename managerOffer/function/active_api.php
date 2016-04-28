<?php
	include("./config.php");
	if(isset($_GET['net_name'])&&isset($_GET['action']))
	{
		$net_name=addslashes($_GET['net_name']);
		$action=addslashes($_GET['action']);
		mysql_query("Update get_api set `action`='$action' where net_name='$net_name'");
	}
?>