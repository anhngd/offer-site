<?php
/*if(isset($_GET["PHPSESSID"])) {
	session_id($_GET["PHPSESSID"]);
}elseif(isset($_POST["PHPSESSID"])) {
	session_id($_POST["PHPSESSID"]);
}
session_start();*/
//Only for swfupload
require_once('../../../../../../admin/config.php');
$token = '';
if (isset($_SET['token'])){
	$token = $_SET['token'];
}
if (isset($_POST['token'])) {
	$token = $_POST['token'];
}

if (strlen($token) > 0){
	if (!empty($_FILES)) {
		$directory = '';
		if (isset($_SET['directory'])){
			$directory = $_SET['directory'];
		}
		if (isset($_POST['directory'])){
			$directory = $_POST['directory'];
		}
		
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$targetPath =  DIR_IMAGE . '/data/' . $directory . '/'; 
		$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
		
		$file_size = @filesize($tempFile);
		if (!$file_size || $file_size > 3000000) {
			//header("HTTP/1.1 500 File Upload Error");
			echo "Error: File exceeds the maximum allowed size";
			exit(0);
		}
		
		// Uncomment the following line if you want to make the directory if it doesn't exist
		//mkdir(str_replace('//','/',$targetPath), 0755, true);
		move_uploaded_file($tempFile, $targetFile);
		
		switch ($_FILES['Filedata']['error'])
		{
			case 0:
			$msg = "No Error"; // comment this out if you don't want a message to appear on success.
			exit(0);			
			break;
			case 1:
			$msg = "The file is bigger than this PHP installation allows";
			break;
			case 2:
			$msg = "The file is bigger than this form allows";
			break;
			case 3:
			$msg = "Only part of the file was uploaded";
			break;
			case 4:
			$msg = "No file was uploaded";
			break;
			case 6:
			$msg = "Missing a temporary directory";
			break;
			case 7:
			$msg = "Failed to write file to disk";
			break;
			case 8:
			$msg = "File upload stopped by extension";
			break;
			default:
			$msg = "unknown error ".$_FILES['Filedata']['error'];
			break;
		}

		If ($msg)
			$stringData = "Error: " . $_FILES['Filedata']['error']." Error Info: " . $msg;
		else
			$stringData = "1"; //This is required for onComplete to fire on Mac OSX
		echo $stringData;
	}
	else
	{
		echo "Error: there is no image upload.";
		exit(0);
	}
}else{
	echo "Error: token is not correct.";
	exit(0);
}
?>