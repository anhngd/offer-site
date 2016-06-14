<?php
	include("../function/config.php");
	include("../function/fnc.php");
	include("../function/function.php");
	include("../class/class.members.php");
	include("../class/class.offers.php");
	include("../class/class.mod.php");
	include("../class/class.network.php");
	include("../class/class.wall.php");
	include("../class/class.category.php");
	include("../class/class.invoice.php");
	if(isset($_POST['ip']))
	{
		$ip=addslashes($_POST['ip']);
		$check_box=addslashes($_POST['check_box']);
		$offerId=addslashes($_POST['offerId']);
		$ip=trim(preg_replace("/\|(.+)/","",$ip));
		if($check_box=="check_clicks")
		{
			$array_ip_query=mysqli_query($conn,"Select ip from clicks where ip='$ip' and offerId='$offerId'");
		}
		else
		{
			$array_ip_query=mysqli_query($conn,"Select ip from leads where ip='$ip' and offerId='$offerId'");

		}
		if(mysqli_num_rows($array_ip_query))
		{
			echo "error";
		}
		else
		{
			echo "oke";
		}
	}
	
	$member=new members;
	if(isset($_POST['delete_user']))
	{
		$member->username=addslashes($_POST['delete_user']);
		if($member->delete_user())
		{
			echo 1;
		}
	}
	if(isset($_POST['paid_user_w']))
	{
		$member->username=addslashes($_POST['paid_user_w']);
		$member->week=addslashes($_POST['week']);
		if($member->paid_user_w())
		{
			echo 1;
		}
	}
	
	if(isset($_POST['unpaid_user_w']))
	{
		$member->username=addslashes($_POST['unpaid_user_w']);
		$member->week=addslashes($_POST['week']);
		if($member->unpaid_user_w())
		{
			echo 1;
		}
	}
	if(isset($_POST['paid_user_m']))
	{
		$member->username=addslashes($_POST['paid_user_m']);
		$member->week=addslashes($_POST['week']);
		if($member->paid_user_m())
		{
			echo 1;
		}
	}
	
	if(isset($_POST['unpaid_user_m']))
	{
		$member->username=addslashes($_POST['unpaid_user_m']);
		$member->week=addslashes($_POST['week']);
		if($member->unpaid_user_m())
		{
			echo 1;
		}
	}
	
	if(isset($_POST['ban_user']))
	{
		$member->username=addslashes($_POST['ban_user']);
		if($member->ban_user())
		{
			echo 1;
		}
	}
	
	if(isset($_POST['verify_user']))
	{
		$member->username=addslashes($_POST['verify_user']);
		if($member->verify_user())
		{
			echo 1;
		}
	}
	
	if(isset($_POST['unban_user']))
	{
		$member->username=addslashes($_POST['unban_user']);
		if($member->unban_user())
		{
			echo 1;
		}
	}
	
	if(isset($_POST['text_search']))
	{
		$member->username=addslashes($_POST['text_search']);			
		$info_members=$member->show_edit_user();
		if(is_array($info_members))
		{
			$list_group="<select name='groupname' class='form-control edit_member'>";
			$array_list_group=explode("|",$member->get_list_group());
			for($i=0;$i<count($array_list_group)-1;$i++)
			{
				$list_group.="<option value='".$array_list_group[$i]."'>".$array_list_group[$i]."</option>";
			}
			$list_group.="</select>";
		?>
		<table style='width:40%;margin:0px auto'>
		<form class='form' method='post' action='home.php'>
			<input type="hidden" name="username" value="<?php echo $info_members['username'];?>" />
			<tr><td>User name:</td><td><input class='form-control edit_member' type='text' disabled="" name='' value="<?php echo $info_members['username'];?>"></td></tr>
			<tr><td>Password:</td><td><input class='form-control edit_member' type='text' name='password' value="<?php echo $info_members['password'];?>"></td></tr>
			<tr><td>Email:</td><td><input type='text' class='form-control edit_member' name='email' value="<?php echo $info_members['email'];?>"></td></tr>
			<tr><td>Banned:</td>
				<td>
					<select name='banned' class='form-control edit_member'>
					<?php 
					if($info_members['banned']==1)
					{
						echo "<option value='1' selected='yes'>Yes</option><option value='0'>No</option>";
					}
					else
					{
						echo "<option value='1' >Yes</option><option value='0' selected=''>No</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr><td>Group</td><td><?php echo $list_group;?></td></tr>
			<tr><td>Code Login</td><td><input type='text' name='codelogin' class='form-control edit_member' value="<?php echo $info_members['codelogin'];?>"></td></tr>
			<tr>
				<td colspan='2'>
					<center><input type='submit' class='btn btn-primary' name='edit_user' value='EDIT USER' onclick='post_edit_user()'></center>
				</td>
			</tr>
		</form>
		</table>
		<?php
		}
		else
		{
			echo "Username does not exits!";
		}
	}
	
	
	if(isset($_POST['show_edit_user']))
	{
		$member->username=addslashes($_POST['username']);			
		$info_members=$member->show_edit_user();
		if(is_array($info_members))
		{
			$list_group="<select name='groupname' class='form-control edit_member'>";
			$array_list_group=explode("|",$member->get_list_group());
			for($i=0;$i<count($array_list_group)-1;$i++)
			{
				$list_group.="<option value='".$array_list_group[$i]."'>".$array_list_group[$i]."</option>";
			}
			$list_group.="</select>";
		?>
		<table style='width:40%;margin:0px auto'>
		<form class='form' method='post' action='home.php'>
			<input type="hidden" name="username" value="<?php echo $info_members['username'];?>" />
			<tr><td>User name:</td><td><input class='form-control edit_member' type='text' disabled="" name='' value="<?php echo $info_members['username'];?>"></td></tr>
			<tr><td>Password:</td><td><input class='form-control edit_member' type='text' name='password' value="<?php echo $info_members['password'];?>"></td></tr>
			<tr><td>Email:</td><td><input type='text' class='form-control edit_member' name='email' value="<?php echo $info_members['email'];?>"></td></tr>
			<tr><td>Banned:</td>
				<td>
					<select name='banned' class='form-control edit_member'>
					<?php 
					if($info_members['banned']==1)
					{
						echo "<option value='1' selected='yes'>Yes</option><option value='0'>No</option>";
					}
					else
					{
						echo "<option value='1' >Yes</option><option value='0' selected=''>No</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr><td>Group</td><td><?php echo $list_group;?></td></tr>
			<tr><td>Code Login</td><td><input type='text' name='codelogin' class='form-control edit_member' value="<?php echo $info_members['codelogin'];?>"></td></tr>
			<tr>
				<td colspan='2'>
					<center><input type='submit' class='btn btn-primary' name='edit_user' value='EDIT USER' onclick='post_edit_user()'></center>
				</td>
			</tr>
		</form>
		</table>
		<?php
		}
		else
		{
			echo "Username does not exits!";
		}
	}
	if(isset($_POST['mod_show_edit_user']))
	{
		$member->username=addslashes($_POST['username']);			
		$info_members=$member->show_edit_user();
		if(is_array($info_members))
		{
			$list_group="<select name='groupname' class='form-control edit_member'>";
			$array_list_group=explode("|",$member->get_list_group());
			for($i=0;$i<count($array_list_group)-1;$i++)
			{
				$list_group.="<option value='".$array_list_group[$i]."'>".$array_list_group[$i]."</option>";
			}
			$list_group.="</select>";
		?>
		<table style='width:40%;margin:0px auto'>
		<form class='form' method='post' action='home.php'>
			<input type="hidden" name="username" value="<?php echo $info_members['username'];?>" />
			<tr><td>User name:</td><td><input class='form-control edit_member' type='text' disabled="" name='' value="<?php echo $info_members['username'];?>"></td></tr>
			<tr><td>Password:</td><td><input class='form-control edit_member' type='text' name='password' value="<?php echo $info_members['password'];?>"></td></tr>
			<tr><td>Email:</td><td><input type='text' class='form-control edit_member' name='email' value="<?php echo $info_members['email'];?>"></td></tr>
			<tr><td>Banned:</td>
				<td>
					<select name='banned' class='form-control edit_member'>
					<?php 
					if($info_members['banned']==1)
					{
						echo "<option value='1' selected='yes'>Yes</option><option value='0'>No</option>";
					}
					else
					{
						echo "<option value='1' >Yes</option><option value='0' selected=''>No</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr><td>Group</td><td><?php echo $list_group;?></td></tr>
			<tr><td>Code Login</td><td><input type='text' name='codelogin' class='form-control edit_member' value="<?php echo $info_members['codelogin'];?>"></td></tr>
			<tr>
				<td colspan='2'>
					<center><input type='submit' class='btn btn-primary' name='edit_user' value='EDIT USER' onclick='mod_post_edit_user()'></center>
				</td>
			</tr>
		</form>
		</table>
		<?php
		}
		else
		{
			echo "Username does not exits!";
		}
	}
	if(isset($_POST['post_edit_user']))
	{
		$member->username=addslashes($_POST['username']);
		$member->password=addslashes($_POST['password']);
		$member->email=addslashes($_POST['email']);
		$member->banned=addslashes($_POST['banned']);
		$member->groupname=addslashes($_POST['groupname']);
		$member->codelogin=addslashes($_POST['codelogin']);
		if($member->post_edit_user()==2)
		{
			echo "error_codelogin";
		}
		else
		if($member->post_edit_user()==1)
		{
			$query_member=mysqli_query($conn,"Select * from members where username='".$member->username."'");
			$array_member=mysqli_fetch_array($query_member);
			if($array_member['banned']==1)
			{
				$banned="<div class='ban_".$array_member['userName']."'><center><a  style='color:red' class='mousepointer' onclick=\"unban_user('".$array_member['userName']."')\">UNBAN</a></center></div>";
			}
			else
			{
				$banned="<div class='ban_".$array_member['userName']."'><center><a style='color:green' class='mousepointer' onclick=\"ban_user('".$array_member['userName']."')\">BAN</a></center></div>";
			}
			
			if($array_member['active']==0)
			{
				$verify="<div class='verify_".$array_member['userName']."'><center><a style='color:red' class='mousepointer' onclick=\"verify('".$array_member['userName']."')\">Verify</a></center></div>";
			}
			else
			{
				$verify="<span style='color:green'>Verified</span>";
			}
			echo '<td class="tb_break_word">'. $array_member['userName'] .'</td>';
			echo '<td class="tb_break_word">'. $array_member['email'] .'</td>';
			echo '<td class="tb_break_word">'. $array_member['points'] .'</td>';
			echo '<td class="tb_break_word">'. formatMoney($array_member['points']*200) .'</td>';
			//echo '<td class="tb_break_word">' . substr($array_member['date'],0,10) . '</td>';
			echo '<td class="tb_break_word">' . $array_member['groupName'] . '</td>';
			echo '<td class="tb_break_word">' . $verify . '</td>';
			echo "<td class='tb_break_word'><div class='ban_".$array_member['userName']."'>$banned</td>";
			echo "<td class='tb_break_word'><center><a class='btn btn-warning button_tb manager mousepointer' onclick='edit_user(\"". $array_member['userName'] ."\")'>EDIT</a><a class='btn btn-danger button_tb manager mousepointer'onclick='delete_user(\"". $array_member['userName'] ."\")'>DELETE</a></center></td>";
		}
		else
		{
			echo "error";
		}
	}
	if(isset($_POST['mod_post_edit_user']))
	{
		$member->username=addslashes($_POST['username']);
		$member->password=addslashes($_POST['password']);
		$member->email=addslashes($_POST['email']);
		$member->banned=addslashes($_POST['banned']);
		$member->groupname=addslashes($_POST['groupname']);
		$member->codelogin=addslashes($_POST['codelogin']);
		if($member->post_edit_user()==2)
		{
			echo "error_codelogin";
		}
		else
		if($member->post_edit_user()==1)
		{
			$query_member=mysqli_query($conn,"Select * from members where username='".$member->username."'");
			$array_member=mysqli_fetch_array($query_member);
			if($array_member['banned']==1)
			{
				$banned="<div class='ban_".$array_member['userName']."'><center><a  style='color:red' class='mousepointer' onclick=\"unban_user('".$array_member['userName']."')\">UNBAN</a></center></div>";
			}
			else
			{
				$banned="<div class='ban_".$array_member['userName']."'><center><a style='color:green' class='mousepointer' onclick=\"ban_user('".$array_member['userName']."')\">BAN</a></center></div>";
			}
			
			if($array_member['active']==0)
			{
				$verify="<div class='verify_".$array_member['userName']."'><center><a style='color:red' class='mousepointer' onclick=\"verify('".$array_member['userName']."')\">Verify</a></center></div>";
			}
			else
			{
				$verify="<span style='color:green'>Verified</span>";
			}
			echo '<td class="tb_break_word">'. $array_member['userName'] .'</td>';
			echo '<td class="tb_break_word">'. $array_member['email'] .'</td>';
			echo '<td class="tb_break_word">'. $array_member['points'] .'</td>';
			echo '<td class="tb_break_word">'. formatMoney($array_member['points']*200) .'</td>';
			//echo '<td class="tb_break_word">' . substr($array_member['date'],0,10) . '</td>';
			echo '<td class="tb_break_word">' . $array_member['groupName'] . '</td>';
			echo '<td class="tb_break_word">' . $verify . '</td>';
			echo "<td class='tb_break_word'><div class='ban_".$array_member['userName']."'>$banned</td>";
			echo "<td class='tb_break_word'><center><a class='btn btn-warning button_tb manager mousepointer' onclick=\"mod_edit_user('". addslashes($array_member['userName']) ."')\">EDIT</a></center></td>";
		}
		else
		{
			echo "error";
		}
	}
	
	
	
	if(isset($_POST['add_user']))
	{
		$time_now=time();
		$member->username=addslashes($_POST['username']);
		$member->password=addslashes($_POST['password']);
		$member->email=addslashes($_POST['email']);
		$member->verify=addslashes($_POST['verify']);
		$member->codelogin=addslashes($_POST['codelogin']);
		$member->groupname=addslashes($_POST['groupname']);
		$member->memip= $_SERVER["REMOTE_ADDR"];;
		$member->memport= $_SERVER['REMOTE_PORT'];;
		$member->date_now=date("Y-m-d H:i:s");
		echo $member->add_user();
	}
	if(isset($_POST['get_group_name']))
	{
		$list_group=$member->get_list_group();
		if($list_group=="0")
		{
			echo "error";
		}
		else
		{
			echo $member->get_list_group();
		}
		
	}
	
	
	//////////////////////////************************************////////////////////////
	//////////////////////////************************************////////////////////////
	//////////////////////////************************************////////////////////////
	//////////////////////////************************************////////////////////////
	//////////////////////////************************************////////////////////////
	$mod=new mod;
	if(isset($_POST['show_edit_mod']))
	{
		$mod->modname=addslashes($_POST['modname']);			
		$info_mods=$mod->show_edit_mod();
		if(is_array($info_mods))
		{
		?>
		<table style="width:40%;margin:0px auto">
		<form class="form" method="post" action="home.php">
		<input type="hidden" name="modname" value="<?php echo $info_mods['modname'];?>" />
			<tr><td >Mod name:</td><td><input class="form-control edit_member" type="text" name="" disabled="" value="<?php echo $info_mods['modname'];?>" /></td></tr>
			<tr><td >Password:</td><td><input  class="form-control edit_member" type="text" name="password" value="**********" onclick="this.value=''" /></td></tr>
			<tr><td >Email:</td><td><input  class="form-control edit_member" type="text" name="email" value="<?php echo $info_mods['email'];?>" /></td></tr>

			<tr><td colspan="2"><center><input type="submit" class="btn btn-primary" name="edit_mod" value="EDIT MOD" onclick='post_edit_mod()'/></center></td></tr>
		</form>
		</center>
		</table>
		<?php
		}
		else
		{
			echo "Modname does not exits!";
		}
	}
	if(isset($_POST['post_edit_mod']))
	{
		$mod->modname=addslashes($_POST['modname']);
		$mod->password=md5(addslashes($_POST['password']));
		$mod->email=addslashes($_POST['email']);
		$query_mod=mysqli_query($conn,"Select * from `mod` where modName='".$mod->modname."'");
		$rows_mod=mysqli_fetch_array($query_mod);
		$getMember=mysqli_query($conn,"Select sum(points) as sum_point,count(userName) as count_user from `members` where groupName='".$mod->modname."'");
		if(mysqli_num_rows($getMember))
		{
			$array_getMember=mysqli_fetch_array($getMember);
			$sum_point=$array_getMember['sum_point'];
		}
		else
		{
			$sum_point=0;
		}
		$cMember=mysqli_query($conn,"Select count(userName) as count_user from members where groupName='".$mod->modname."'");
		if($cMember==true)
		{
			$countMember=mysqli_fetch_array($cMember);
			$countName=$countMember['count_user'];
		}
		else
		{
			$countName=0;
		}
		if($rows_mod['banned']==1)
		{
			$banned="<a class='btn btn-warning button_tb manager mousepointer' onclick=\"unban_mod('".$mod->modname."')\">UNBAN</a>";
		}
		else
		{
			$banned="<a class='btn btn-danger button_tb manager mousepointer' onclick=\"ban_mod('".$mod->modname."')\">BAN</a>";
		}
		if($mod->post_edit_mod())
		{
			echo "<td>".$mod->modname."</td>";
			echo "<td>".$mod->email."</td>";
			echo "<td><center>".$sum_point."</center></td>";
			echo "<td><center>".$countName."</center></td>";
			
			echo "<td><center><a class='btn btn-warning button_tb manager' onclick='edit_mod(\"".$mod->modname."\")'>EDIT</a></center></td>";
			echo "<td><center>$banned</center></td>";
		}
		else
		{
			echo "error";
		}
	}
	if(isset($_POST['add_mod']))
	{
		$mod->modname=addslashes($_POST['modname']);
		$mod->password=md5(addslashes($_POST['password']));
		$mod->email=addslashes($_POST['email']);
		echo $mod->add_mod();
	}
	
	if(isset($_POST['ban_mod']))
	{
		$mod->modname=addslashes($_POST['ban_mod']);
		if($mod->ban_mod())
		{
			echo 1;
		}
	}
	
	if(isset($_POST['unban_mod']))
	{
		$mod->modname=addslashes($_POST['unban_mod']);
		if($mod->unban_mod())
		{
			echo 1;
		}
	}
		
		//////////////////////////************************************////////////////////////
		//////////////////////////************************************////////////////////////
	$offer=new offer;
	if(isset($_POST['editOffer'])){
		$offer->id = (int) addslashes($_POST['id']);		
		$offer->offerId = addslashes($_POST['offerId']);
		$offer->name = addslashes(htmlentities($_POST['name'],ENT_QUOTES));
		$offer->des = addslashes(htmlentities($_POST['des'],ENT_QUOTES));
		$offer->url = addslashes($_POST['url']);
		$offer->image_url = addslashes($_POST['image_url']);
		$offer->cc = addslashes($_POST['country']);
		$offer->network = addslashes($_POST['network']);
		$offer->status = addslashes($_POST['edffer']);	
		$offer->payout = addslashes($_POST['payout']);
		if(isset($_POST['globalRate']) && $_POST['globalRate'] == 'Yes')
		{
			$offer->ratio = Ratio;
		} else 
		{
			$offer->ratio = addslashes($_POST['ratio']);
		}
		echo $offer->post_edit_offer();
	}
	
	if(isset($_POST['action_offer_mobvista'])){
		$offer->offerId = addslashes($_POST['offerId']);
		$offer->payout_net = addslashes($_POST['payout_net']);
		$offer->name = addslashes(htmlentities($_POST['name'],ENT_QUOTES));
		$offer->des = addslashes(htmlentities($_POST['des'],ENT_QUOTES));
		$offer->url = addslashes($_POST['url']);
		$offer->image_url = addslashes($_POST['image_url']);
		$offer->cc = addslashes($_POST['country']);
		$query_network=mysqli_query($conn,"Select * from networks where id='".addslashes($_POST['network'])."'");
		$row_network=mysqli_fetch_array($query_network);
		$offer->network = $row_network['name'];		
		$offer->payout = addslashes($_POST['payout']);
		$offer->os = addslashes($_POST['os']);
		$offer->ratio = Ratio;
		$offer->offer_name = addslashes($_POST['offer_name']);
		$offer->min_os_version = addslashes($_POST['min_os_version']);
		$offer->max_os_version = addslashes($_POST['max_os_version']);
		$offer->exclude_traffic = addslashes($_POST['exclude_traffic']);
		$offer->preview_link = addslashes($_POST['preview_link']);
		$offer->price_model = addslashes($_POST['price_model']);
		$offer->app_category = addslashes($_POST['app_category']);
		$offer->start_time = addslashes($_POST['start_time']);
		$offer->start_date = addslashes($_POST['start_date']);
		$offer->end_time = addslashes($_POST['end_time']);
		$offer->end_date = addslashes($_POST['end_date']);
		$offer->update_time = addslashes($_POST['update_time']);
		$offer->update_date = addslashes($_POST['update_date']);
		$offer->Effective_time = addslashes($_POST['Effective_time']);
		$offer->effective_date = addslashes($_POST['effective_date']);
		$offer->exclude_device = addslashes($_POST['exclude_device']);
		$offer->carriers = addslashes($_POST['carriers']);
		$offer->daily_cap = addslashes($_POST['daily_cap']);
		$offer->creative_link = addslashes($_POST['creative_link']);
		$offer->app_size = addslashes($_POST['app_size']);
		$offer->app_rate = addslashes($_POST['app_rate']);
		$offer->appreviewnum = addslashes($_POST['appreviewnum']);
		$offer->appinstalls = addslashes($_POST['appinstalls']);
		$offer->market = addslashes($_POST['market']);
		echo $offer->action_offer_mobvista();
	}
	
	if(isset($_POST['action_offer_mobverify'])){
		$offer->offerId = addslashes($_POST['offerId']);
		$offer->payout_net = addslashes($_POST['payout_net']);
		$offer->name = addslashes(htmlentities($_POST['name'],ENT_QUOTES));
		$offer->des = addslashes(htmlentities($_POST['des'],ENT_QUOTES));
		$offer->url = addslashes($_POST['url']);
		$offer->image_url = addslashes($_POST['image_url']);
		$offer->cc = addslashes($_POST['country']);
		$query_network=mysqli_query($conn,"Select * from networks where id='".addslashes($_POST['network'])."'");
		$row_network=mysqli_fetch_array($query_network);
		$offer->network = $row_network['name'];		
		$offer->payout = addslashes($_POST['payout']);
		$offer->os = addslashes($_POST['os']);
		$offer->ratio = Ratio;
		echo $offer->action_offer_mobverify();
	}
	
	if(isset($_POST['action_offer_avazu'])){
		$offer->offerId = addslashes($_POST['offerId']);
		$offer->payout_net = addslashes($_POST['payout_net']);
		$offer->name = addslashes(htmlentities($_POST['name'],ENT_QUOTES));
		$offer->des = addslashes(htmlentities($_POST['des'],ENT_QUOTES));
		$offer->url = addslashes($_POST['url']);
		$offer->image_url = addslashes($_POST['image_url']);
		$offer->cc = addslashes($_POST['country']);
		$query_network=mysqli_query($conn,"Select * from networks where id='".addslashes($_POST['network'])."'");
		$row_network=mysqli_fetch_array($query_network);
		$offer->network = $row_network['name'];		
		$offer->payout = addslashes($_POST['payout']);
		$offer->os = addslashes($_POST['os']);
		$offer->ratio = Ratio;
		$offer->offer_name = addslashes($_POST['offer_name']);
		$offer->app_category = addslashes($_POST['app_category']);
		$offer->app_rate = addslashes($_POST['app_rate']);
		$offer->appreviewnum = addslashes($_POST['appreviewnum']);
		$offer->appinstalls = addslashes($_POST['appinstalls']);
		$offer->app_size = addslashes($_POST['app_size']);
		$offer->min_os_version = addslashes($_POST['min_os_version']);
		$offer->market = addslashes($_POST['market']);
		echo $offer->action_offer_avazu();
	}
	
	if(isset($_POST['action_offer_bluetrackmedia'])){
		
		$offer->offerId = addslashes($_POST['offerId']);
		$offer->payout_net = addslashes($_POST['payout_net']);
		$offer->name = addslashes($_POST['name']);
		$offer->des = addslashes($_POST['des']);
		$offer->url = addslashes($_POST['url']);
		$offer->image_url = addslashes($_POST['image_url']);
		$offer->cc = addslashes($_POST['country']);
		$query_network=mysqli_query($conn,"Select * from networks where id='".addslashes($_POST['network'])."'");
		$row_network=mysqli_fetch_array($query_network);
		$offer->network = $row_network['name'];		
		$offer->payout = addslashes($_POST['payout']);
		$offer->os = addslashes($_POST['os']);
		$offer->ratio = Ratio;
		$offer->offer_name = addslashes($_POST['offer_name']);
		echo $offer->action_offer_bluetrackmedia();
	}
	
	if(isset($_POST['show_add_offer'])){
		echo $offer->show_add_offer();
	}
	if(isset($_POST['delete_offer'])){
		$offer->id = addslashes($_POST['delete_offer']);
		echo $offer->delete_offer();
	}
	
	if(isset($_POST['show_edit_offer'])){
		$offer->id = addslashes($_POST['id']);
		$array_offer=$offer->show_edit_offer();
		if(is_array($array_offer))
		{
			?>
		<form action="" method="post">
		<table style="width:30%;margin:0px auto">
		<input type="hidden" name="id" value="<?php echo $_POST['id'];?>" />
		<tr>
		<td>
		Offer ID *</label></td><td><input type="text" name="offerId" class="txt" value="<?php echo $array_offer['offerId'];?>" /></td><tr><td></td><tr><td>
		Name *</label></td><td><input type="text" name="name" class="txt" value="<?php echo $array_offer['name'];?>" /></td><tr><td>
		Description</label></td><td><textarea rows="4" cols="50" name="des"><?php echo $array_offer['des'];?></textarea></td><tr><td>
		Payout *</label></td><td><input type="text" name="payout" class="txt" value="<?php echo $array_offer['payout'];?>" /></td>
		
				
		<?php
		/*
		<tr>
			<td>
				Show index *
			</td>
			<td>
				<input type="checkbox" <?php echo $array_offer['show_index']=="ON"?"checked":"";?> name="show_index" class="txt " id ="" value="ON"  />
			</td>
		</tr>
		<tr>
			<td>
				Hot
			</td>
			<td>
				<input type="checkbox" name="hot" class="txt" id ="" value="ON"  />
			</td>
		</tr>
		<tr><td>
		Ratio *</label></td><td><input type="text" name="ratio" class="txt rate" id ="txtRate" value="" disabled /></td><tr><td>
		Global Rate?</td><td><input type="checkbox" name="globalRate" value="Yes" class="globalrate" onchange="document.getElementById('txtRate').disabled=this.checked;" checked="checked"></td></tr>
		*/?>
		<input type="checkbox" hidden name="show_index" class="txt " id ="" value="ON"  />
		<input type="checkbox" name="hot" class="txt" hidden value="ON"  />
		<input type="text" name="ratio" class="txt rate" id ="txtRate" value="" hidden />
		<input type="checkbox" name="globalRate" value="Yes" class="globalrate" hidden checked="checked">
		<tr><td>Tracking URL *</label></td><td><input type="text" name="url" class="txt" value="<?php echo $array_offer['url'];?>" />				</td><tr><td></td><tr><td>
		Image URL</label></td><td><input type="text" name="image_url" class="txt" value="<?php echo $array_offer['imageUrl'];?>" />				</td><tr>
		<?php /*<tr>
			<td>
				Producer
			</td>
			<td>
				<input type="text" name="producer" class="txt" value="<?php echo $array_offer['producer'];?>" />
			</td>
		</tr>
		<tr>
			<td>
				Version
			</td>
			<td>
				<input type="text" name="min_os_version" class="txt" value="<?php echo $array_offer['min_os_version'];?>" />
			</td>
		</tr>
		<tr>
			<td>
				Size
			</td>
			<td>
				<input type="text" name="app_size" class="txt" value="<?php echo $array_offer['app_size'];?>" />
			</td>
		</tr>
		<tr>
			<td>
				Update
			</td>
			<td>
				<input type="text" name="update_date" class="txt" value="<?php echo $array_offer['update_date'];?>" />
			</td>
		</tr>
		<tr>
			<td>
				View
			</td>
			<td>
				<input type="text" name="view" class="txt" value="<?php echo $array_offer['view'];?>" />
			</td>
		</tr>
		<tr>
			<td>
				Category
			</td>
			<td>
				<select name="category">
					<?php echo list_category($array_offer['category']); ?>
				</select>
			</td>
		</tr>
		*/?>
		<tr>
		<td>
		Country list</label></td>
		<td>
		<select name="country_list" multiple="multiple" size="5" ondblclick="add_country(this.value,this.options[this.selectedIndex].text);">
		<?php
			$array_country=explode(",,",$array_offer['country']);
			$queryCountry = mysqli_query($conn,"SELECT name, cc FROM countries ORDER BY name") or die(mysqli_error());
			while($country = mysqli_fetch_assoc($queryCountry)) 
			{
				if (!in_array($country['cc'],$array_country)) 
				{
		?>	
			<option value="<?php echo $country['cc'];?>"><?php echo $country['name'];?></option>
		<?php 
				}
			}
		?>
		</select>
		</td>
		</tr>
		
		<tr><td></td><td><center><img src="./img/down.png" style="width:50px;"/></center></td></tr>
		<tr>
		<td>
		Country Selected</label></td>
		<td>
		<select name="country_selected" multiple="multiple" size="5" ondblclick="remove_country(this.value,this.options[this.selectedIndex].text);">
		<?php
			$queryCountry = mysqli_query($conn,"SELECT name, cc FROM countries ORDER BY name") or die(mysqli_error());
			$list_country="";
			while($country = mysqli_fetch_assoc($queryCountry)) {
			if (in_array($country['cc'],$array_country)) 
			{
				$list_country.=$country['cc'].",";
		?>	
			<option value="<?php echo $country['cc'];?>" ><?php echo $country['name'];?></option>
		<?php
			}
		} ?>
		</select>
		</td>
		</tr>
		<tr><td></td><td><input type="hidden" name="country" id="country" class="txt" value="<?php echo $list_country;?>" /></td></tr>

		<tr><td>
		Network *</label></td><td>
		<select name="network">
		<?php
			$queryNetwork = mysqli_query($conn,"SELECT name FROM networks ORDER BY name") or die(mysqli_error());
			while($network = mysqli_fetch_assoc($queryNetwork)) {
			if($network['name'] == $array_offer['network']) {
		?>	
			<option value="<?php echo $network['name'];?>" selected="selected"><?php echo $network['name'];?></option>
			<?php } else { ?>
			<option value="<?php echo $network['name'];?>"><?php echo $network['name'];?></option>
		<?php }} ?>
		</select></td>
		<tr><td>
        On/off?</label></td><td>
					<select name="edffer">
						<option value="ON" <?php if ($array_offer['status'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($array_offer['status'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select></td>
		</tr>
		<tr>
			<td>
				SUB TRACKING *</label>
			</td>
			<td>
				<select name="end_tracking" class="" style="">
				<?php
					echo sub_tracking($array_offer['end_tracking']);
				?>	
				</select>
			</td>
		</tr>
		<tr>
		<td></td>
		<td><center>
		<input type="submit" name="editOffer" value="EDIT OFFER" class="btn btn-info"/></center>
		</td></tr>
		</table>
		</form>
		<?php
		}
	}
		//////////////////////////************************************////////////////////////
		//////////////////////////************************************////////////////////////
	$wall=new wall;
	if(isset($_POST['show_add_wall'])){
		echo $wall->show_add_wall();
	}
	if(isset($_POST['delete_wall'])){
		$wall->id = addslashes($_POST['delete_wall']);
		echo $wall->delete_wall();
	}
	
	if(isset($_POST['show_edit_wall'])){
		$wall->id = addslashes($_POST['id']);
		$array_wall=$wall->show_edit_wall();
		if(is_array($array_wall))
		{
			?>
		<form action="index.php?offers=wall" method="post">
		<table style="width:30%;margin:0px auto">
		<input type="hidden" name="id" value="<?php echo $wall->id;?>" />
		<tr>
		<td>
		ID</label></td>
		<td><input type="text" name="wallId" class="txt" disabled value="<?php echo $array_wall['id'];?>" />
		</td>
		</tr>
		<tr>
		<td>
		Name</label>
		</td>
		<td><input type="text" name="name" class="txt" value="<?php echo $array_wall['name'];?>" /></td>
		</tr>
		<tr>
		<td>
		Iframe</label>
		</td>
		<td><textarea rows="4" cols="50" name="iframe"><?php echo $array_wall['iframe'];?></textarea></td>
		</tr>
		<tr>
		<td>
		Key</label></td>
		<td><input type="text" name="key" class="txt" value="<?php echo $array_wall['key'];?>" /></td>
		</td>
		</tr>
		<tr>
		<td>
        On/off?</label>
		</td>
		<td>
			<select name="status">
				<option value="ON" <?php if ($array_wall['status'] == "ON") { echo 'selected="selected"';}?>>ON</option>
				<option value="OFF" <?php if ($array_wall['status'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
			</select>
		</td>
		</tr>
		<tr>
			<td>
				OS</label>
			</td>
			<td>
				<select name="OS" class="txt">
					<option value="android" selected="selected">Android</option>
					<option value="ios">iOS</option>
					<option value="pc">Pc</option>
					<option value="table">Table</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<center>
					<input type="submit" name="editWall" value="EDIT WALL" class="btn btn-info"/>
				</center>
			</td>
		</tr>
		</table>
		</form>
		<?php
		}
	}
	
		//////////////////////////************************************////////////////////////
		//////////////////////////************************************////////////////////////
		
	$network=new network;
	
	if(isset($_POST['delete_network'])){
		$network->id = addslashes($_POST['delete_network']);
		echo $network->delete_network();
	}
	
	if(isset($_POST['show_edit_network'])){
		$network->id = addslashes($_POST['id']);
		$array_network=$network->show_edit_network();
		if(is_array($array_network))
		{
			if($array_network['status']=="ON")
			{
				$status="<option selected='' value='ON'>ON</option><option value='OFF'>OFF</option>";
			}
			else
			{
				$status="<option value='ON'>ON</option><option selected='' value='OFF'>OFF</option>";
			}
			if($array_network['payment']=="week")
			{
				$payment="<select type='text' name='payment' class='txt'><option value='week' selected>Week</option><option value='month'>Month</option></select>";
			}
			else
			{
				$payment="<select type='text' name='payment' class='txt'><option value='week'>Week</option><option value='month' selected>Month</option></select>";
			}
			
			echo "<form action='' method='post'><table style='width:30%;margin:0px auto'><tbody><tr><td>Name</td><td><input type='text' name='name' class='txt' value=\"".$array_network['name']."\"><input type='hidden' name='id' class='txt' value=\"".$array_network['id']."\"></td></tr><tr><td>	IPAddress</td><td><input type='text' name='ip' class='txt' value=\"".$array_network['ip']."\"></td></tr><tr><td>API KEY</td><td><input type='text' name='api_key' class='txt' value=\"".$array_network['api_key']."\"></td></tr><tr><td>Status</td><td><select name='status'>$status</select></td></tr><tr><td>Invoice</td><td>$payment</td></tr><tr>	<td colspan='2'><center><input type='submit' name='editNwk' value='EDIT NETWORK' class='btn btn-info'></center>	</td><td></td></tr></tbody></table></form>";
		}
	}
	////CATEGORY
	$category=new category;

	
	if(isset($_POST['show_add_category'])){
		echo $category->show_add_category();
	}
	if(isset($_POST['delete_category'])){
		$category->id = addslashes($_POST['delete_category']);
		echo $category->delete_category();
	}
	////INVOICE
	$invoice=new invoice;
	if(isset($_POST['status_paid'])){
		$invoice->userName = addslashes($_POST['paid_user']);
		$invoice->from_day = addslashes($_POST['from_day']);
		$invoice->to_day = addslashes($_POST['to_day']);
		$invoice->status_paid = addslashes($_POST['status_paid']);
		$invoice->netname = addslashes($_POST['netname']);
		$invoice->offerId = addslashes($_POST['offerId']);
		echo $invoice->paid();
	}
	
?>