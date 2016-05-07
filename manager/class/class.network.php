<?php
	class network
	{
		public $id;
		public $name;
		public $ip;
		public $status;
		
		public function show_edit_network()
		{
			$query_select_network=mysql_query("Select * from `networks` where id='".$this->id."'") or die (mysql_error());
			if(mysql_num_rows($query_select_network))
			{
				$array_select_network=mysql_fetch_array($query_select_network);
				$array_info_network=array('id'=>$array_select_network['id'],'name'=>$array_select_network['name'],'ip'=>$array_select_network['ip'],'status'=>$array_select_network['status'],'api_key'=>$array_select_network['api_key'],'url_api'=>$array_select_network['url_api'],'payment'=>$array_select_network['payment']);
				return $array_info_network;
			}
		}
		public function delete_network()
		{
			$query_delete_network = mysql_query("DELETE FROM networks WHERE id = '".$this->id."'");
			if($query_delete_network)
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