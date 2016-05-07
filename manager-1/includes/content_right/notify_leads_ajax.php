<?php
include("../../function/config.php");
if(isset($_POST['userName'])&&isset($_POST['idLeads']))
{
	$idLeads=addslashes($_POST['idLeads']);
	$userName=addslashes($_POST['userName']);
	$notify_leads_query=mysql_query("Select * from leads where userName='$userName' order by date desc limit 0,5");
	if(mysql_num_rows($notify_leads_query)!=0)
	{
		$i=0;
		while($notify_leads=mysql_fetch_array($notify_leads_query))
		{
			if($i==0)
			{
				if($notify_leads['id']==$idLeads)
				{
					exit("");
				}
				else
				{
					echo $notify_leads['id']."|||";
				}
			}
			?>
				<ul class="chat">
					<li class="left">
						<span class="message notify_admin">
							<span class="text" style="color:black !important;">
								<?php
								if($i==0)
								{
								echo "<span style=\"color:green\">".$notify_leads['offerName']."</span> are returned at <span style=\"color:red\">".$notify_leads['date']."</span>! Ip: ".$notify_leads['ip']."! ".$notify_leads['points']." points!";
								}
								else
								{
								echo "".$notify_leads['offerName']." are returned at ".$notify_leads['date']."! Ip: ".$notify_leads['ip']."! ".$notify_leads['points']." points!";
								}
								$i++;
								$idLeads=$notify_leads['id'];
								?>
							</span>
						</span>	                                  
					</li>
				</ul>
			<?php
		}
	}
}
?>
