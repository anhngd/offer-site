<?php
	$user_session=$_SESSION['userName'];
	$pass_session=$_SESSION['userPassword'];
	$notify_leads_query=mysql_query("Select * from leads where userName='$userName' order by date desc limit 0,5");
	if(mysql_num_rows($notify_leads_query)!=0)
	{
		$i=0;
		while($notify_leads=mysql_fetch_array($notify_leads_query))
		{
			?>
				<ul class="chat">
					<li class="left">
						<span class="message notify_admin"><span class="arrow">
							<?php echo $notify['lead'];?></span>
							<span class="text" style="color:black !important;">
								<?php
								if($i==0)
								{
								echo "<span style=\"color:green\">".$notify_leads['offerName']."</span> are returned at <span style=\"color:red\">".$notify_leads['date']."</span>! Ip: ".$notify_leads['ip']."! ".$notify_leads['points']." points!";
								$idLeads=$notify_leads['id'];
								}
								else
								{
								echo "".$notify_leads['offerName']." are returned at ".$notify_leads['date']."! Ip: ".$notify_leads['ip']."! ".$notify_leads['points']." points!";
								}
								$i++;
								?>
							</span>
						</span>	                                  
					</li>
				</ul>
			<?php
		}
	}
?>
<script type="text/javascript">
idLeads=<?php echo $idLeads;?>;
userName='<?php echo $user_session;?>';
function ajax_load_leads(url,id){
	var ajax = new AJAX_Handler();
	ajax.onreadystatechange(change_);
	post='idLeads='+idLeads+'&userName='+userName;
	ajax.send(url,post);		
	function change_(){
		if(ajax.handler.readyState == 4 && ajax.handler.status == 200)
		{
			if(ajax.handler.responseText!="")
			{
				
				soundPlay();
				reponseSplit=ajax.handler.responseText.split("|||");
				idLeads=reponseSplit[0];
				document.getElementById(id).innerHTML = reponseSplit[1];
			}
		}
	}
}
function _load_leads(value){
		ajax_load_leads('./includes/content_right/notify_leads_ajax.php','box_notify_leads');
		var objDiv = document.getElementById("mainchat");
		objDiv.scrollTop = objDiv.scrollHeight;
}
function soundPlay()
{
	chip=new Audio("./sound/notify_lead.mp3");
	chip.volume=1;
	chip.play();
}
function _refresh_leads(value){

		setTimeout("_load_leads('box_notify_leads');_refresh_leads('box_notify_leads');", <?php echo $num_refresh_notify_leads?>);
	
}
_refresh_leads('box_notify_leads');
var objDiv = document.getElementById("box_notify_leads");
objDiv.scrollTop = objDiv.scrollHeight;
</script>