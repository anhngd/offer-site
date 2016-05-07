<?php
	if(isset($_GET['ssh_error'])){
		$filename = "ssh_error.txt"; // File Name
		// Download file
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		echo file_get_contents("ssh_error.txt");
	}
	else
	{
		$filename = "ssh_oke.txt"; // File Name
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		echo file_get_contents("ssh_oke.txt");
	}
	
?>