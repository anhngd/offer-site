<?php
	class template
	{
		public $id;
		public $title;
		public $des;
		public $logo;
		public $embed_code;
		public $device;
		public function pick_theme($device)
		{
				$query_theme=mysql_query("Select * from template where device='$device'");
				$row_theme=mysql_fetch_array($query_theme);
				$array_theme=array('id'=>$row_theme['id'],'title'=>$row_theme['title'],'des'=>$row_theme['des'],'logo'=>$row_theme['logo'],'embed_code'=>$row_theme['embed_code'],'path'=>$row_theme['path']);
				return $array_theme;
		}
	}
?>