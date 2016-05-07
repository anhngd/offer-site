<?php 
include './inc/config.php';
include './inc/functions.php';
$onlines="";
$content =  file('./data/content.txt');
$time_now = time();
#tính từ thời điểm hiện tại trở về trước 15 phút
$end_time = $time_now - 60*$config['onlstats']; //15 phut

$count = count($content);
for($i=$count-1;$i>0;$i--){
	$x = explode('*|*',$content[$i]);
	$time = $x[1];
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
	if($time >= $end_time){
		$arr_onl[$name] = $name;
	}
}
$template = '<li class="ticket">
				<img src="http://l.yimg.com/us.yimg.com/i/mesg/emoticons7/1.gif">
					<a href="#">
						<span class="header">
							<span class="title">{$name}</span>
						</span>	                                             
					</a>
				</li>';
if(isset($arr_onl)){
	foreach($arr_onl as $name)
		eval('$onlines .= "'.addslashes($template).'";');
}
else
	$onlines = 'Not found online user';
echo '<ul>'.$onlines.'</ul>';
?>