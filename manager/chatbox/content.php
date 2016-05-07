<?php
session_start();
include ("../function/config.php");
include './inc/functions.php';
$scontent="";
if(isset($_POST['text'])&&trim($_POST['text'])){
	if(isset($_SESSION['isAdmin']))
	{
		$manager="isAdmin";
	}
	else
	if(isset($_SESSION['isMod']))
	{
		$manager="isMod";
	}
	else
	{
		$manager="isMember";

	}
	
	extract($_POST);
	$name = trim($name);
	if(!isset($name)||!isset($_SESSION['userName']) || $name != $_SESSION['userName']) die('Access denied! Please login to chat room');
	$text = htmlspecialchars($text);
	if(in_array($name,$config['admin']) && $text == '/prune'){
		$fp = fopen('./data/content.txt','w');
		$text = 'has been prune';
	}
	else 
		$fp = fopen('./data/content.txt','a');
	$content = '*|*'.time().'*|*'.$name.'*|* '.$text.' *|*'.$upb.'*|*'.$upi.'*|*'.$upu.'*|*'.$upcolor.'*|*'.$upfont.'*|*'.$ip.'*|*'.$manager;
	fwrite($fp,$content."\n");
	fclose($fp);
}
$content =  file('./data/content.txt');
$count = count($content);
$config['chatline'] = $config['chatline']>$count ? $count : $config['chatline'];
$tempalte = '<div><span class="time">[{$time}]</span> <b>{$name}</b>: {$bcolor}{$bfont}{$bb}{$bu}{$bi}{$text}{$ei}{$eu}{$eb}{$efont}{$ecolor}</div>';
for($i=$count-$config['chatline'];$i<=$count-1;$i++){
	$value = $content[$i];
	if(strlen($value)>5){
		$x = explode('*|*',$value);
		$time= date('d/m/Y',$x[1])==date('d/m/Y',time())?'Hôm nay '.date('h:i A',$x[1]):date('d/m/Y h:i A',$x[1]);
		
		$text 		= htmlspecialchars($x[3]);
		$bb   		= $x[4] ? '<b>' : '';
		$eb   		= $x[4] ? '</b>' : '';
		$bi   		= $x[5] ? '<i>' : '';
		$ei   		= $x[5] ? '</i>' : '';
		$bu   		= $x[6] ? '<u>' : '';
		$eu   		= $x[6] ? '</u>' : '';
		$bcolor 	= $x[7] ? '<span style=\'color:'.$x[7].'\'>' : '';
		$ecolor 	= $x[7] ? '</span>' : '';
		$bfont 		= $x[8] ? '<span style=\'font-family:'.$x[8].'\'>' : '';
		$efont 		= $x[8] ? '</span>' : '';
		$ip 		= $x[9];
		if(trim($x[10])=='isAdmin')
		{
			$name='<b style="color:red">'.$x[2].'</b>';
		}
		else
		if(trim($x[10])=="isMod")
		{
			$name='<b style="color:blue">'.$x[2].'</b>';
		}
		else
		{
			$name='<b style="color:black">'.$x[2].'</b>';
		}
		eval('$scontent .= "'.addslashes($tempalte).'";');
	}
}
$scontent = stripslashes($scontent);
$scontent = $scontent ? fetch_emoticon($scontent) : 'Welcome to chat room';
echo $scontent."<div id='scroll_end' name='iWantToScrollHere'></div>";
?>
<br /><br />
