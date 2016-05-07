<?php 
// This simple PHP / Mysql membership script was created by www.funkyvision.co.uk
// You are free to use this script at your own risk
// Please visit our website for more updates..
session_start();
include_once"function/config.php";;
session_unset();
session_destroy();
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Oops!</title>
<style type="text/css">
	html { }
	body {
		background: url("images/bg_2.png") repeat scroll 0 0 transparent;
		margin: 0;
		padding: 0;
	}
	#oops {
		background: url("images/oops.jpg") no-repeat scroll 0 0 transparent;
		width: 144px;
		height: 150px;
		margin: 100px auto 0;
	}
	h3 {
		color: #333333;
		font-family: Calibri,sans-serif;
		font-size: 20px;
		margin: 0 auto;
		text-align: center;
		text-shadow: 1px 1px 0 #EEEEEE;
		text-transform: uppercase;
		width: 300px;
	}
</style>
</head>

<body>
<div id="oops">
</div>
<h3>Website blocked by piracy!</h3>
</body>
</html>