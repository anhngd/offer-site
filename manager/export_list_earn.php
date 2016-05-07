<?php
	include("./function/config.php");
// Connection 
	if(isset($_POST['os'])&&isset($_POST['codelogin'])&&isset($_POST['groupId'])&&isset($_POST['export_offer'])&&isset($_POST['id_export']))
	{
		$export=$_POST['id_export'];
		$os_earn=addslashes($_POST['os']);
		$codelogin=addslashes($_POST['codelogin']);
		$groupId=addslashes($_POST['groupId']);
		$filename = "list_earn.txt"; // File Name
		// Download file
		foreach($export as $k=>$v)
		{
			$query_android=mysqli_query($conn,"SELECT * from offers where id='".addslashes($v)."'");
			if(mysqli_num_rows($query_android))
			{
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/txt");
				$row_android=mysqli_fetch_array($query_android);
					echo $domainsite."/earn/".base64_encode($row_android['id']."_".$codelogin)."|".$row_android['network']."-".$row_android['name']."\r\n";
			}
			else
			{
				continue;
			}
		}
		
		
	}
?>