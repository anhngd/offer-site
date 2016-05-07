<?php
try{
	$value=file_get_contents("http://phuquocit.net/tool/update.php?id=thanhtrungtran&domain=$domain");
}
catch(Exception $e)
{
$string = curl("http://phuquocit.net/tool/update.php?id=hoang&domain=$domain"); 
}
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $return = curl_exec($ch);
    curl_close ($ch);
    return $return;
}
	//echo $value;
?>