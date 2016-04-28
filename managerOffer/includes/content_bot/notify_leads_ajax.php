<?php
include("../../function/config.php");
if(isset($_POST['userName'])&&isset($_POST['idLeads']))
{
	$idLeads=addslashes($_POST['idLeads']);
	$userName=addslashes($_POST['userName']);
	if($row_admin['notify_lead']=="all")
	{
		$notify_leads_query=mysqli_query($conn,"Select * from leads where id>'$idLeads' order by id desc");
	}
	else
	{
		$notify_leads_query=mysqli_query($conn,"Select * from leads where userName='$userName' and id>'$idLeads' order by id desc");
	}
	if(mysqli_num_rows($notify_leads_query)!=0)
	{
		$i=0;
		while($notify_leads=mysqli_fetch_array($notify_leads_query))
		{
			if($i==0)
			{
				echo $notify_leads['id']."|||";
			}
			?>
					<li class="left">
						<span class="message notify_admin">
							<span class="text" style="color:black !important;">
								<?php
									echo "<span style=\"color:green\">".$notify_leads['offerName']."</span> are returned at <span style=\"color:red\">".$notify_leads['date']."</span>! Ip: ".$notify_leads['ip']."! ".$notify_leads['points']." points to user <span style=\"color:green\">".$notify_leads['userName']."</span>!";
									$i++;
								?>
							</span>
						</span>	                                  
					</li>
			<?php
		}
	}
}
?>
