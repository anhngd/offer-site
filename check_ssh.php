<?php
	$conn = mysql_connect("localhost","root","") or die (mysql_error());  
	mysql_select_db("offer_long") or die(mysql_error());  
	if(isset($_FILES['file_ssh']))
	{	$ssh_error="";
		$ssh_oke="";
		$num_ssh_oke=0;
		$num_ssh_error=0;
		$offerId=addslashes($_POST['offerId']);
		$check_box=addslashes($_POST['check_box']);
		$ssh_input=addslashes(file_get_contents($_FILES['file_ssh']['tmp_name'])); 
		$ssh_input=explode("\r\n",$ssh_input);
		if($check_box=="check_clicks")
		{
			if($offerId=="")
			{
				$array_ip_query=mysql_query("Select ip from tracking") or die (mysql_error());
			}
			else
			{
				$array_ip_query=mysql_query("Select ip from tracking where offer_id='$offerId'") or die (mysql_error());
			}
		}
		else
		{
			if($offerId=="")
			{
				$array_ip_query=mysql_query("Select ip from conversion") or die (mysql_error());
			}
			else
			{
				$array_ip_query=mysql_query("Select ip from conversion where offer_id='$offerId'") or die (mysql_error());
			}
		}
		while($result=mysql_fetch_array($array_ip_query))
		{
				$array_ip[]=$result['ip'];
		}
		foreach($ssh_input as $k=>$v)
		{
			$ip=trim(preg_replace("/\|(.+)/","",$v));
			if(in_array($ip,$array_ip))
			{
				$ssh_error.=$v."\r\n";
				$num_ssh_error++;
			}
			else
			{
				$num_ssh_oke++;
				$ssh_oke.=$v."\r\n";
			}
		}
		file_put_contents("ssh_error.txt",$ssh_error);
		file_put_contents("ssh_oke.txt",$ssh_oke);
	}
?>
<html><head></head>

<body><div style="width:1100px;margin:0px auto;overflow: hidden; position: relative; height: 623px; color: #333333; font-family: 'Open Sans', sans-serif; font-size: 14px; line-height: 20px;" class="container-fluid-full">
	<div class="row-fluid" style="width: 1100px;">
	<a style="color: #646464; font-family: Tahoma; font-size: 12px;"><span class="label label-success" style="display: inline-block; padding: 3px 6px; font-weight: 600; line-height: 14px; color: #ffffff; text-shadow: none; white-space: nowrap; vertical-align: baseline; border-radius: 0px; font-family: 'Open Sans', sans-serif; margin: 5px 0px; border-color: #ffc40d !important; background: #ffc40d !important;">SSH INPUT</span></a>&nbsp;<span id="num_ssh_input">0</span>
	<form action="" method="post">
		<div>
			<div>
				<center><input style="margin: 0px; font-size: 14px; vertical-align: middle; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; width: 206px;" type="text" name="offerId"></center>
			</div>
			<br>
			<center>
				<input style="" type="radio" name="check_box" value="check_clicks" checked="checked">
				CHECK CLICKS&nbsp;
				<input style="" type="radio" name="check_box" value="check_leads">
				CHECKS LEADS
			</center>
			<center style="margin: 15px;">
				<input style="" type="file" name="file_ssh" size="50">
				&nbsp;<input id="_upl" class="btn btn-info manager" style="margin: 0px 2px; font-size: 14px; vertical-align: middle; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; width: auto; padding: 6px 12px; color: #ffffff; cursor: pointer; border: 1px solid #5bc0de; box-shadow: rgba(255, 255, 255, 0.2) 0px 1px 0px inset, rgba(0, 0, 0, 0.0470588) 0px 1px 2px; white-space: nowrap; filter: none; -webkit-appearance: button; border-radius: 0px !important; background-image: none; background-color: #5bc0de; background-repeat: repeat-x;" type="submit" name="check_ssh" value="IMPORT FILE SSH">
			</center>
			<div style="width: 1001.67px; margin: 8px 0px;">
				<div style="width: 400px; float: left;"><a style="color: #646464; font-family: Tahoma; font-size: 12px;"><span class="label label-warning" style="display: inline-block; padding: 3px 6px; font-weight: 600; line-height: 14px; color: #ffffff; text-shadow: none; white-space: nowrap; vertical-align: baseline; border-radius: 0px; font-family: 'Open Sans', sans-serif; margin: 5px 0px; border-color: #00a300 !important; background: #00a300 !important;">SSH OKE</span></a>&nbsp;<span id="num_ssh_oke">0</span><textarea id="ssh_oke" style="margin: 0px; font-size: 14px; vertical-align: middle; overflow: auto; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; height: 300px; padding: 4px 6px; color: #00cc00; border-radius: 0px; width: 360px; border-color: #00cc00; box-shadow: none; transition: border 0.2s linear, box-shadow 0.2s linear;" name=""><?php isset($ssh_oke)?"$ssh_oke":"";?></textarea>&nbsp;</div>
				<div style="width: 295px; float: right;"><a style="color: #646464; font-family: Tahoma; font-size: 12px;"><span class="label label-important" style="display: inline-block; padding: 3px 6px; font-weight: 600; line-height: 14px; color: #ffffff; text-shadow: none; white-space: nowrap; vertical-align: baseline; border-radius: 0px; font-family: 'Open Sans', sans-serif; margin: 5px 0px; border-color: #ca0101 !important; background: #ca0101 !important;">SSH ERROR</span></a>&nbsp;<span id="num_ssh_error">0</span><textarea id="ssh_error" style="margin: 0px; font-size: 14px; vertical-align: middle; overflow: auto; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; height: 300px; padding: 4px 6px; color: red; border-radius: 0px; width: 360px; border-color: red; box-shadow: none; transition: border 0.2s linear, box-shadow 0.2s linear;" name=""><?php isset($ssh_error)?"$ssh_error":"";?></textarea>&nbsp;</div>
			</div>
		</div>
	</form>
	</div>
</div>
</body></html>