<?php
include("../function/includes.php");
include("../function/config.php");
$new_date = strtotime ( '+1 month' , strtotime ( $dateto ) ) ;
$new_date = date ( 'Y-m-j' , $new_date );
if($dateto != NULL && $new_date==$datefrom) {
		header("Location: buy.php");
}
$fp = fopen($filename, "rb");
 
//m? file d? d?c v?i ch? d? nh? phân (binary)
$fp = fopen($upload_dir.$filename, "rb");
 
//g?i header d?n cho browser
header('Content-type: application/octet-stream');
header('Content-disposition: attachment; filename="'.$filename.'"');
header('Content-length: ' . filesize($upload_dir.$filename));
 
//d?c file và tr? d? li?u v? cho browser
fpassthru($fp);
fclose($fp);
?>