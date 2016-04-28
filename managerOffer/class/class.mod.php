<?php
	class mod
	{
		public $modname;
		public $password;
		public $email;
		public function ban_mod()
		{
			$query_ban_mod=mysql_query("Update `mod` set banned=1 where modName='".$this->modname."'");
			if($query_ban_mod)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function unban_mod()
		{
			$query_unban_mod=mysql_query("Update `mod` set banned=0 where modname='".$this->modname."'");
			if($query_unban_mod)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		public function add_mod()
		{
			$check_admin = mysql_query("SELECT * FROM `admin` WHERE `adminName` = '".$this->modname."'");   
			$query_check_mod=mysql_query("Select * from `mod` where modName='".$this->modname."'");
			if(mysql_num_rows($query_check_mod)!=0||mysql_num_rows($check_admin)!=0)
			{
				return 2;
			}
			if($this->modname==""||$this->password=="")
			{
				return 3;
			}
			else
			{
				$query_add_mod=mysql_query("Insert into `mod`(`modName`,`email`,`modPass`,`groupName`) value('".$this->modname."','".$this->email."','".$this->password."','".$this->modname."')");
				if($query_add_mod)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		
		public function post_edit_mod()
		{
			if($this->password=="d41d8cd98f00b204e9800998ecf8427e"||$this->password=="3fc26dc90ab296e41bc5fc8f9a2a7d40")
			{
				
				$query_add_user=mysql_query("Update `mod` set `email`='".$this->email."' where modname='".$this->modname."'") or die (mysql_error());
			}
			else
			{
				$query_add_user=mysql_query("Update `mod` set `modPass`='".$this->password."',`email`='".$this->email."' where modname='".$this->modname."'") or die (mysql_error());

			}
			if($query_add_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function show_edit_mod()
		{
			$query_select_user=mysql_query("Select * from `mod` where modname='".$this->modname."'") or die (mysql_error());
			if(mysql_num_rows($query_select_user))
			{
				$array_select_user=mysql_fetch_array($query_select_user);

				$array_info_user=array('modname'=>$array_select_user['modName'],'email'=>$array_select_user['email'],'password'=>$array_select_user['modPass']);
				return $array_info_user;
			}
		}
	}
?>