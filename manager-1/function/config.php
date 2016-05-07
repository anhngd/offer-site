<?php
ob_start();
if(!isset($_SESSION)){
    session_start();
}
include("db_connect.php");
$dir_img="images";
$dir_member="managerOffer";
$bonuspoints=0; //bonus points awarded for new users
$mainpointsneeded=200; //max number of points needed before user can request voucher
$dateto="";
$datefrom= date("Y-m-j");
$numSplitPage=200;
$num_refresh_notify_leads=60000;
$query_admin=mysqli_query($conn, "select * from admin");
$row_admin=mysqli_fetch_array($query_admin);
$ratio=$row_admin['ratio'];
$ratio_vnd=$row_admin['ratio_vnd'];
$money_support=$row_admin['money_support'];
date_default_timezone_set($row_admin['timezone_default']);
$today = date("Y-m-d");
$first_week=date('Y-m-d', strtotime('Last Monday', time()));
$last_week=date('Y-m-d', strtotime('Next Sunday', time()));
$last_month=date('Y-m-t', time());
$first_month=date('Y-m-01');
$first_year=date('Y-01-01', time());
$last_year=date('Y-12-31', time());
$time_now=date('Y-m-d h:i:s', time());
$date_7day = new DateTime(date("Y-m-d",strtotime("-7 day",strtotime($today))));
$date_today = new DateTime(date("Y-m-d",strtotime($today)));
$month_today = $date_today->format("m");
$week_today = $date_today->format("W");
$year = $date_7day->format("Y");

$config['refresh_online'] = 600; //15s
#thời gian load lại nội dung chat
$config['refresh_content'] = 600; //15s
$config['chatline'] = 30;  // số dòng hiển thị trong khung chat
$config['onlstats'] = 15;// thống kê online trong vòng 15 phút
$config['admin'] = array('Admin','Chip');
?>