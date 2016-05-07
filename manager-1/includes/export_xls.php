<?php
// Connection 
include("../function/config.php");
$filename = "Webinfopen.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$user_query = mysql_query('select userName,points from members order by points desc');
// Write data to file
$flag = false;
$sumPoint=0;
while ($row = mysql_fetch_assoc($user_query)) {
    if (!$flag) {
        // display field/column names as first row
        echo "UserName\tPoint\tMoney\t30% Money\r\n";
        $flag = true;
    }
	if($row['points']==0)
	{
		continue;
	}
	$sumPoint+=$row['points'];
    echo $row['userName']."\t".$row['points']."\t".formatMoney($row['points']*200)." VND\t".formatMoney($row['points']*200*30/100)." VND\r\n";
}
echo "SUM\t".$sumPoint."\t".formatMoney($sumPoint*200)." VND\t".formatMoney($sumPoint*200*30/100)." VND\r\n";
function formatMoney($number, $fractional=false) { 
    if ($fractional) { 
        $number = sprintf('%.2f', $number); 
    } 
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    return $number; 
}
?>