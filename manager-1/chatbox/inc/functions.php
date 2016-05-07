<?php 
function getStr($source,$start,$end){
	$str = explode($start,$source);
	if($end != NULL){		
		$str = explode($end,$str[1]);
		return $str[0];
	}else
		return $str[1];
}

function pre($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function print_cp_mess($url = '',$mess = '',$time = 1,$exit = false){
	if($mess)	echo '<center>'.$mess.'</center>';
	if($url)	echo '<script>setTimeout("window.location=\''.$url.'\';",'.$time.'000);</script>';
	if($exit)	exit;	
}
function emo_array() {
	return array(
	':)' =>1,':(' =>2,';)' =>3,':D' =>4,';;)' =>5,'>:D<' =>6,':-/' =>7,':x' =>8,':">' =>9,':P' =>10,':-*' =>11,'=((' =>12,':-O' =>13,'X(' =>14,':>' =>15,':->' =>15,'B-)' =>16,':-S' =>17,'#:-S' =>18,'>:)' =>19,':((' =>20,':))' =>21,':|' =>22,'/:)' =>23,'=))' =>24,'O:-)' =>25,':-B' =>26,'=;' =>27,':-c' =>101,':)]' =>100,'~X(' =>102,':-h' =>103,':-t' =>104,'8->' =>105,'I-)' =>28,'8-|' =>29,'L-)' =>30,':-&' =>31,':-$' =>32,'[-(' =>33,':O)' =>34,'8-}' =>35,'<:-P' =>36,'(:|' =>37,'=P~' =>38,':-?' =>39,'#-o' =>40,'=D>' =>41,':-SS' =>42,'@-)' =>43,':^o' =>44,':-w' =>45,':-<' =>46,'>:P' =>47,'>):)' =>48,'X_X' =>109,':!!' =>110,'\m/' =>111,':-q' =>112,':-bd' =>113,'^#(^' =>114,':bz' =>115,':o3' =>108,':-??' =>106,'%-(' =>107,':@)' =>49,':(|)' =>51,'~:>' =>52,'@};-' =>53,'8-X' =>59,':-L' =>62,'[-O<' =>63,'$-)' =>64,':-"' =>65,'b-(' =>66,':)>-' =>67,'[-X' =>68,'\:D/' =>69,'>:/' =>70,';))' =>71,':-@' =>76,'^:)^' =>77,':-j' =>78,'(*)' =>79, 'x_x' => 109, '\m/' => 111
		);
}
function alter_smiley(&$item1) {
	$item1 = '<img src="http://l.yimg.com/us.yimg.com/i/mesg/emoticons7/'.$item1.'.gif" border="0" />';
}
function fetch_emoticon($str){
	$str = htmlspecialchars_decode($str);
	foreach(emo_array() as $key => $value){
		$smileys[htmlspecialchars($key)] = $value;
	}
	array_walk ($smileys, 'alter_smiley');		
	$str =  strtr(htmlspecialchars($str), $smileys);
	return htmlspecialchars_decode($str);
}
?>