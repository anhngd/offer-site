<?php
	class admin
	{
		public $username;
		public $password;
		public function add_admin()
		{
			$query_check_admin=mysql_query("Select * from tbl_admin where username='".$this->username."'");
			if(mysql_num_rows($query_check_admin)!=0)
			{
				return 2;
			}
			if($this->username==""||$this->password=="")
			{
				return 3;
			}
			else
			{
				$query_add_admin=mysql_query("Insert into tbl_admin(`username`,`password`) value('".$this->username."','".$this->password."')");
				if($query_add_admin)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		
		public function post_edit_admin()
		{
			$query_add_user=mysql_query("Update tbl_admin set `password`='".$this->password."' where username='".$this->username."'") or die (mysql_error());
			if($query_add_user)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function show_edit_admin()
		{
			$query_select_user=mysql_query("Select * from tbl_admin where username='".$this->username."'");
			if(mysql_num_rows($query_select_user))
			{
				$array_select_user=mysql_fetch_array($query_select_user);

				$array_info_user=array('username'=>$array_select_user['username'],'password'=>$array_select_user['password']);
				return $array_info_user;
			}
		}
	}
?>