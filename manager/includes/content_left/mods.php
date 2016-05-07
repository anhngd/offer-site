<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>MANAGER MODS</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content">
<div style="height:40px;margin:5px;">
	<div style="float:right;">
		<span name="check_ssh" class="btn btn-info" href="#" id="button_add_app" onclick="add_mod()">ADD MEMBERS</span>
	</div>
	<div style="clear:right;"></div>
</div>
<div id="reponse_post"></div>
<div class="container_table">
<table width="100%"  cellpadding="0" cellspacing="0" border="0" id="list_mods" class="table table-bordered table-striped table-condensed">
	  <thead>
			  <tr role="row"><th>Mod Names</th><th >Email</th><th >Points Group</th><th>Members</th><th colspan='2'><center>Managers</center></th>
			  </tr>
		  </thead>
	<tbody>
		<?php
		$getMod = mysqli_query($conn,"select * from `mod`");
		if(mysqli_num_rows($getMod))
		{
			while($array_getMod = mysqli_fetch_assoc($getMod)) 
			{
				$groupName=addslashes($array_getMod['groupName']);
				$modName=$array_getMod['modName'];
				if($array_getMod['banned']==1)
				{
					$banned="<a class='btn btn-info button_tb manager mousepointer' onclick=\"unban_mod('".addslashes($modName)."')\">UNBAN</a>";
				}
				else
				{
					$banned="<a class='btn btn-danger button_tb manager mousepointer' onclick=\"ban_mod('".addslashes($modName)."')\">BAN</a>";
				}
				if(!isset($_GET['filter']))
				{
					$getMember=mysqli_query($conn,"Select sum(points) as sum_point,count(userName) as count_user from `members` where groupName='$groupName'");
				}
				else
				{/*
					if(isset($_GET['from'])&&$_GET['from']!="")
					{
						$from=addslashes($_GET['from']);
					}
					else
					{
						$from="2015-01-01";
					}
					if(isset($_GET['to'])&&$_GET['to']!="")
					{
						$to=addslashes($_GET['to']);
					}
					else
					{
						$to=$today;
					}*/
					$getMember=mysqli_query($conn,"Select sum(points) as sum_point from `leads` where groupName='$groupName'") or die (mysqli_error());
				}
					$cMember=mysqli_query($conn,"Select count(userName) as count_user from members where groupName='$groupName'");
					
					if($cMember==true)
					{
						$countMember=mysqli_fetch_array($cMember);
						$countName=$countMember['count_user'];
					}
					if(mysqli_num_rows($getMember))
					{
						$array_getMember=mysqli_fetch_array($getMember);
						$sum_point=$array_getMember['sum_point'];
					}
					if(!isset($countName)||$countName=="")
					{
						$countName=0;
					}
					if(!isset($sum_point)||$sum_point=="")
					{
						$sum_point=0;
					}
					
					
						echo '<tr id="tr_'.$array_getMod['modName'].'">';
						echo '<td>'. $array_getMod['modName'] .'</td>';
						echo '<td>'. $array_getMod['email'] .'</td>';
						echo '<td><center>'. $sum_point .'</center></td>';
						echo '<td><center>' . $countName . '</center></td>';
						echo "<td><center><a class='btn btn-warning button_tb manager mousepointer' onclick=\"edit_mod('".addslashes($array_getMod['modName'])."')\">EDIT</a></center></td>";
						echo '<td class="ban_'.$array_getMod['modName'].'"><center>'.$banned.'</center></td>';
						echo '</tr>';
			}
		}
		?>
	</tbody>
</table>
</div>
</div>
</div>