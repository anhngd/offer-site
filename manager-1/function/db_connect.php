<?php
$hostname = "localhost"; //your hostname (normally localhost)
$data_username = "root"; //database username
$data_password = ""; //database password
$data_basename = "offer-db"; //database name
$logo="chipmobi.net";
$conn = mysqli_connect("".$hostname."","".$data_username."","".$data_password."","".$data_basename."") or die (mysqli_error());  
//mysqli_select_db("".$data_basename."") or die(mysqli_error());  
$domainsite="http://m.exbounty.com";
$yourdomain="http://m.exbounty.com";
?>