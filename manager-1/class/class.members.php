<?php
	class members
	{
		public $username;
		public $password;
		public $time_register;
		public $time_expires;
		public $used;
		public $max_use;
		public $banned;
		public $memip;
		public $memport;
		public $date_now;
		public function add_user()
		{
			   
			$check_mod = mysql_query("SELECT * FROM `mod` WHERE `modName` = '".$this->username."'");   
			$check_admin = mysql_query("SELECT * FROM `admin` WHERE `adminName` = '".$this->username."'");   
			$query_check_user=mysql_query("Select * from members where username='".$this->username."'");
			$query_check_codelogin=mysql_query("Select * from members where codelogin='".$this->codelogin."'");
			if(mysql_num_rows($query_check_user)!=0||mysql_num_rows($check_mod)!=0||mysql_num_rows($check_admin)!=0)
			{
				return 2;
			}
			else
			if(mysql_num_rows($query_check_codelogin))
			{
				return 4;
			}
			if($this->username==""||$this->password==""||$this->codelogin=="")
			{
				return 3;
			}
			else
			{
				$query_add_user=mysql_query("Insert into members(`userName`,`userPassword`,`email`,`active`,`codelogin`,`groupname`,`ip`,`port`, `date`) value('".$this->username."','".$this->password."','".$this->email."','".$this->verify."','".$this->codelogin."','".$this->groupname."','".$this->memip."','".$this->memport."','".$this->date_now."')") or die (mysql_error());
				if($query_add_user)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		
		public function paid_user_w()
		{
			$query_paid_user=mysql_query("Update invoice set status='paid' where username='".$this->username."' and week='".$this->week."'");
			if($query_paid_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function unpaid_user_w()
		{
			$query_paid_user=mysql_query("Update invoice set status='unpaid' where username='".$this->username."' and week='".$this->week."'");
			if($query_paid_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function paid_user_m()
		{
			$query_paid_user=mysql_query("Update invoice set status='paid' where username='".$this->username."' and month='".$this->week."'");
			if($query_paid_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function unpaid_user_m()
		{
			$query_paid_user=mysql_query("Update invoice set status='unpaid' where username='".$this->username."' and month='".$this->week."'");
			if($query_paid_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function post_edit_user()
		{
			$query_check_codelogin=mysql_query("Select * from members where codelogin='".$this->codelogin."' and username!='".$this->username."'");
			if(mysql_num_rows($query_check_codelogin)!=0)
			{
				return 2;
			}
			else
			{
				$query_add_user=mysql_query("Update members set `userPassword`='".$this->password."',`email`='".$this->email."',`banned`='".$this->banned."',`groupname`='".$this->groupname."',`codelogin`='".$this->codelogin."' where username='".$this->username."'") or die (mysql_error());
				if($query_add_user)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		
		public function show_edit_user()
		{
			$query_select_user=mysql_query("Select * from members where username='".$this->username."'");
			if(mysql_num_rows($query_select_user))
			{
				$array_select_user=mysql_fetch_array($query_select_user);
				$array_info_user=array('username'=>$array_select_user['userName'],'password'=>$array_select_user['userPassword'],'email'=>$array_select_user['email'],'banned'=>$array_select_user['banned'],'codelogin'=>$array_select_user['codelogin']);
				return $array_info_user;
			}
		}
		
		public function get_list_group()
		{
			$query_check_mod=mysql_query("Select groupName from `mod` where banned='0'") or die(mysql_error());
			if(!mysql_num_rows($query_check_mod))
			{
				return 0;
			}
			else
			{
				$list_group="";
				while($rows=mysql_fetch_array($query_check_mod))
				{
					$list_group.=$rows['groupName']."|";
				}
				return $list_group;
			}
		}
		
		public function delete_user()
		{
			$query_del_user=mysql_query("Delete from members where username='".$this->username."'");
			if($query_del_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function verify_user()
		{
			$query_ban_user=mysql_query("Update members set active=1 where username='".$this->username."'") or die (mysql_error());
			if($query_ban_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function ban_user()
		{
			$query_ban_user=mysql_query("Update members set banned=1 where username='".$this->username."'");
			if($query_ban_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function unban_user()
		{
			$query_unban_user=mysql_query("Update members set banned=0 where username='".$this->username."'");
			if($query_unban_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}
?>