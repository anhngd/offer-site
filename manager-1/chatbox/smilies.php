<?	
if(!defined('CHIP_ROOT')) die ('Hello pro!');
$data = file('./chatbox/data/smilies.txt');
echo '<table width="100%" border="0"><tr>';
$i=0;
foreach($data as $value){
	$i++;
	$ex = explode(' => ',$value);
	$kytu = str_replace('"','\\"',$ex[0]);
	echo '<td class="fr_2"><a href=\'javascript:addsmile("'.$kytu.'");\'><img src="'.trim($ex[1]).'" border=0></a></td>';
	if($i%5==0)echo '</tr>';
}
if($i%5!==0){echo '</tr>';}
echo '</table>';
?>


