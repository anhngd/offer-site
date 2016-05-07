<?php
// This simple PHP / Mysql membership script was created by www.funkyvision.co.uk
// You are free to use this script at your own risk
// Please visit our website for more updates..
session_start();
include_once"../function/config.php";
$query = mysql_query("DROP TABLE admin") or die(mysql_error());
$query1 = mysql_query("DROP TABLE clicks") or die(mysql_error());
$query2 = mysql_query("DROP TABLE countries") or die(mysql_error());
$query3 = mysql_query("DROP TABLE leads") or die(mysql_error());
$query4 = mysql_query("DROP TABLE members") or die(mysql_error());
$query5 = mysql_query("DROP TABLE networks") or die(mysql_error());
$query6 = mysql_query("DROP TABLE offers") or die(mysql_error());
$query7 = mysql_query("DROP TABLE requesters") or die(mysql_error());
$query8 = mysql_query("DROP TABLE rewards") or die(mysql_error());
$query9 = mysql_query("DROP TABLE walls") or die(mysql_error());
$query10 = mysql_query("DROP TABLE temp_members_db") or die(mysql_error());
$query11 = mysql_query("DROP TABLE template") or die(mysql_error());

?> 
