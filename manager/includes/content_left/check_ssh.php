<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>CHECK SSH</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">
<?php
/*
if(isset($_POST['check_ssh']))
{
	$ssh_input=$_POST['ssh_input'];
	$ssh_oke="";
	$ssh_error="";
	$ssh_input=explode("\r\n",$ssh_input);
	$ip_query=mysqli_query($conn,"Select ip from clicks");
	$array_ip_query=mysqli_query($conn,"Select ip from clicks");
	while($result=mysqli_fetch_array($array_ip_query))
	{
		$array_ip[]=$result['ip'];
	}
	foreach($ssh_input as $k=>$v)
	{
		$ip=trim(preg_replace("/\|(.+)/","",$v));
		if(in_array($ip,$array_ip))
		{
			$ssh_error.=$v."\r\n";
		}
		else
		{
			$ssh_oke.=$v."\r\n";
		}
	}
}
?>
<form action="./index.php?check_ssh" method="post">
<label>INPUT SSH</label>
<textarea name="ssh_input" style="width:98%;height:150px;color:#3399FF;border:1px solid #3399FF !important;" onclick="value=''"></textarea><br><br>
<center><input type="submit" name="check_ssh" class="btn btn-info" value="CHECK SSH EXITS"/></center>
<label>SSH OKE</label>

<textarea name="" style="width:98%;height:150px;color:#00CC00;border:1px solid #00CC00 !important;"><?php if(isset($ssh_oke))echo $ssh_oke;?></textarea>
<br>
<label>SSH ERROR</label>

<textarea name="" style="width:98%;height:150px;color:red;border:1px solid red !important;"><?php if(isset($ssh_error))echo $ssh_error;?></textarea>
</form>
*/
	if(isset($_FILES['file_ssh']))
	{	$ssh_error="";
		$ssh_oke="";
		$num_ssh_oke=0;
		$num_ssh_error=0;
		$offerId_textbox=addslashes($_POST['offerId_textbox']);
		if($offerId_textbox=="INPUT OFFER ID"||$offerId_textbox=="")
		{
			$offerId=addslashes($_POST['offerId']);
		}
		$check_box=addslashes($_POST['check_box']);
		$ssh_input=addslashes(file_get_contents($_FILES['file_ssh']['tmp_name'])); 
		$ssh_input=explode("\r\n",$ssh_input);
		if($check_box=="check_clicks")
		{
			$array_ip_query=mysqli_query($conn,"Select ip from clicks where offerId='$offerId'") or die (mysqli_error());
		}
		else
		{
			$array_ip_query=mysqli_query($conn,"Select ip from leads where offerId='$offerId'") or die (mysqli_error());
		}
		while($result=mysqli_fetch_array($array_ip_query))
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
<div style="width:100%">
				<form action="" name="frm" method="POST" enctype="multipart/form-data" >
				<?php echo "<a style=\"color: #646464; text-decoration: none; font-family: Tahoma; font-size: 12px;\" ><span class=\"label label-success\" style=\"display: inline-block; padding: 3px 6px; font-weight: 600; line-height: 14px; color: #ffffff; text-shadow: none; white-space: nowrap; vertical-align: baseline; border-radius: 0px; font-family: 'Open Sans', sans-serif; border-color: #ffc40d !important; background: #ffc40d !important;margin:5px 0px;\">SSH INPUT</span></a> <span id='num_ssh_input'>"; if(isset($ssh_input)){echo "".count($ssh_input)."";}else{echo "0";}?></span>
				<div ></label><textarea  style="width:98%;height:150px;color:#3399FF;border:1px solid #3399FF !important;" name="ssh_input"></textarea><br /><br />
					<center>
						<input type="text" name="offerId_textbox" value="INPUT OFFER ID" onclick="this.value=''">
						<span><b>OR</b></span>
						<select name="offerId">
						<?php
						$query_offer=mysqli_query($conn,"Select * from offers");
						while($row_offer=mysqli_fetch_array($query_offer))
						{
							echo "<option value='".$row_offer['offerId']."'>[".strtoupper($row_offer['OS'])."] ".$row_offer['name']."</option>";
						}
						?>
						</select>
						<br>
						<input type="radio" name="check_box" checked="" value="check_clicks">CHECK CLICKS
						<input type="radio" name="check_box" value="check_leads">CHECKS LEADS
					</center></br>
				<center>
					<input type="button" name="check_ssh" class="btn btn-info" value="CHECK SSH EXITS" onclick="checkfrm();" />
				</center>
				<center>
					<h2>OR</h2>
				</center>
				<center style="margin:15px;">
						<input type="file" name="file_ssh" size="50" >
						<input name="check_ssh" type="submit" id="_upl" class="btn btn-info manager"  value="IMPORT FILE SSH">
				</center>
				<div style="width:90%;margin:8px 0px">
					<div style="width:400px;float:left">
					<?php echo "<a style=\"color: #646464; text-decoration: none; font-family: Tahoma; font-size: 12px;\" ><span class=\"label label-warning\" style=\"display: inline-block; padding: 3px 6px; font-weight: 600; line-height: 14px; color: #ffffff; text-shadow: none; white-space: nowrap; vertical-align: baseline; border-radius: 0px; font-family: 'Open Sans', sans-serif; border-color: #00a300 !important; background: #00a300 !important;margin:5px 0px;\">SSH OKE</span></a> <span id='num_ssh_oke'>";?> <?php if(isset($num_ssh_oke)){echo "".$num_ssh_oke."";}else{echo "0";}?></span></label><textarea style="margin: 0px; font-size: 14px; vertical-align: middle; overflow: auto; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; height: 300px; padding: 4px 6px; color: #00cc00; border-radius: 0px; width: 360px; box-shadow: none; transition: border 0.2s linear, box-shadow 0.2s linear; border-color: #00cc00 !important;" name="" id="ssh_oke"><?php if(isset($ssh_oke)){echo $ssh_oke;}?></textarea>&nbsp;<br />
					<?php if(isset($ssh_oke))
							{
								echo "<center><div style='margin:5px 0px'>";
								echo "<a style=\"margin: 0px; font-size: 14px; vertical-align: middle; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; width: auto; padding: 2px 8px; color: #ffffff; cursor: pointer; border: 1px solid #5bc0de; box-shadow: rgba(255, 255, 255, 0.2) 0px 1px 0px inset, rgba(0, 0, 0, 0.0470588) 0px 1px 2px; white-space: nowrap; filter: none; -webkit-appearance: button; border-radius: 0px !important; background-image: none; background-color: #5bc0de; background-repeat: repeat-x;\" href='./export_ssh.php?ssh_oke'>EXPORT SSH OKE</a>";
								echo "</div></center>";
							} 
						?>
					</div>
					<div style="width:295px;float:right">
					<?php echo "<a style=\"color: #646464; text-decoration: none; font-family: Tahoma; font-size: 12px;\" ><span class=\"label label-important\" style=\"display: inline-block; padding: 3px 6px; font-weight: 600; line-height: 14px; color: #ffffff; text-shadow: none; white-space: nowrap; vertical-align: baseline; border-radius: 0px; font-family: 'Open Sans', sans-serif; border-color: #ca0101 !important; background: #ca0101 !important;margin:5px 0px;\">SSH ERROR</span></a> <span id='num_ssh_error'>";?> <?php if(isset($num_ssh_error)){echo "".$num_ssh_error."";}else{echo "0";}?></span><textarea style="margin: 0px; font-size: 14px; vertical-align: middle; overflow: auto; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; height: 300px; padding: 4px 6px; color: red; border-radius: 0px; width: 360px; box-shadow: none; transition: border 0.2s linear, box-shadow 0.2s linear; border-color: red !important;" name="" id="ssh_error"><?php if(isset($ssh_error)){echo $ssh_error;}?></textarea>&nbsp;<br />
						<?php if(isset($ssh_oke))
								{
									echo "<center><div style='margin:5px 0px'>";
									echo "<a style=\"margin: 0px; font-size: 14px; vertical-align: middle; line-height: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; width: auto; padding: 2px 8px; color: #ffffff; cursor: pointer; border: 1px solid #5bc0de; box-shadow: rgba(255, 255, 255, 0.2) 0px 1px 0px inset, rgba(0, 0, 0, 0.0470588) 0px 1px 2px; white-space: nowrap; filter: none; -webkit-appearance: button; border-radius: 0px !important; background-image: none; background-color: #5bc0de; background-repeat: repeat-x;\" href='./export_ssh.php?ssh_error'>EXPORT SSH ERROR</a>";
									echo "</div></center>";
								}
						?>
					</div>
				
				</div>
				<div style="clear:both"></div>
				</div>
				</form>
		</div>
</div>
</div>