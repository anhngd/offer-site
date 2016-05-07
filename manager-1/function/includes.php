<?php 
if(isset($_SESSION['userName'])&&isset($_SESSION['groupName']))
{
$fetch_users_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `members` WHERE userName='".$_SESSION['userName']."' and groupName='".$_SESSION['groupName']."'"));

$ref_id=$fetch_users_data['id'];
$membername= $fetch_users_data['userName']; //don't change
$memberpoints=$fetch_users_data['points']; //don't change
$membersurveys=$fetch_users_data['leadedOffers']; //don't change
}
$template = mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM `template`"));
$tweetmsg="Get Amazon and ASOS gift vouchers for free at http://www.myvouchergeek.com"; //set text for tweet this button on homepage
$bonuspoints= 0;    //amount of bonus points to give to users
$refer_points=2; //amount of points a user receives if one of their referred users completes any survey
$filename = "App.apk"; // App name
$domainapp="download/download.php?file=$filename"; //link app google play or link file download "download/download.php?file=$filename"

if(isset($_GET['join'])){
	$referralId = $_GET['join'];
	$referral_string= "?join=".$referralId;
}

$title= $template ->title;
$logo= $template ->logo;
if(isset($memberpoints))
{
$earnedpoints = $memberpoints - $bonuspoints;//if you want to display how many points user has earned (as opposed to bonus points)
$mainpointsneeded = 500; //total points needed before user can request a voucher
$pointsneeded= $mainpointsneeded - $memberpoints; //points left before they can request voucher
}
$contactemail = "YOUR_EMAIL_ADDRESS"; //contact form messages will be sent here
$requestemail = "THE_SAME_OR_ANOTHER_EMAIL_ADDRESS"; //request a voucher messages will be sent here
?>