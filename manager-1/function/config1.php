<?php
ob_start();
if(!isset($_SESSION)){
    session_start();
}
/*$hostname = "localhost"; //your hostname (normally localhost)
$data_username = "likesys1_offer_d"; //database username
$data_password = "kLZkm4T8f@,h"; //database password
$data_basename = "likesys1_offer_duy";*/ //database name

$hostname = "localhost"; //your hostname (normally localhost)
$data_username = "root"; //database username
$data_password = ""; //database password
$data_basename = "xuan_hue"; //database name
$logo="chipmobi.net";

$dir_img="images";
$dir_member="managerOffer";

$today = date("Y-m-d");
$first_week=date('Y-m-d', strtotime('Last Monday', time()));
$last_week=date('Y-m-d', strtotime('Next Sunday', time()));
$last_month=date('Y-m-t', time());
$first_month=date('Y-m-01');
$first_year=date('Y-01-01', time());
$last_year=date('Y-12-31', time());

$conn = mysql_connect("".$hostname."","".$data_username."","".$data_password."") or die (mysql_error());  
mysql_select_db("".$data_basename."") or die(mysql_error());  
$bonuspoints=0; //bonus points awarded for new users
$mainpointsneeded=200; //max number of points needed before user can request voucher
$dateto="";
$datefrom= date("Y-m-j");
$numSplitPage=40;
$num_refresh_notify_leads=5000;
$query_admin=mysql_query("select * from admin");
$row_admin=mysql_fetch_array($query_admin);
$ratio=$row_admin['ratio'];
$ratio_vnd=$row_admin['ratio_vnd'];
$money_support=$row_admin['money_support'];
date_default_timezone_set($row_admin['timezone_default']);
$domainsite="http://localhost/xuan_ha";
$yourdomain="http://localhost/xuan_ha";
/*

$domainsite="http://gamemobiles.net";
$yourdomain="http://gamemobiles.net"; *///your domain name where script is installed - do not use trailing slash

?>