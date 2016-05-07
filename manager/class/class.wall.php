<?php
	class wall
	{
		public $id;
		public $name;
		public $iframe;
		public $key;
		public $status;
		
		public function show_edit_wall()
		{
			$query_select_wall=mysql_query("Select * from `walls` where id='".$this->id."'") or die (mysql_error());
			if(mysql_num_rows($query_select_wall))
			{
				$array_select_user=mysql_fetch_array($query_select_wall);
				$array_info_user=array('id'=>$array_select_user['id'],'name'=>$array_select_user['name'],'iframe'=>$array_select_user['iframe'],'key'=>$array_select_user['secretKey'],'status'=>$array_select_user['status']);
				return $array_info_user;
			}
		}
		public function delete_wall()
		{
			$query_delete_wall = mysql_query("DELETE FROM walls WHERE id = '".$this->id."'");
			if($query_delete_wall)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		public function show_add_wall()
		{
			?>
			<form action="index.php?offers=wall" method="post">
			<table style="width:30%;margin:0px auto">
				<tr>
					<td>
						Name
					</td>
					<td>
						<input type="text" name="name" value="" />
					</td>
				</tr>
				<tr>
					<td>
						Iframe
					</td>
					<td>
						<textarea rows="4" cols="50" name="iframe"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Key
					</td>
					<td>
						<input type="text" name="key" value="" />
					</td>
				</tr>
				<tr>
					<td>
						OS
					</td>
					<td>
						<select name="OS" >
							<option value="android" selected="selected">Android</option>
							<option value="ios" selected="selected">iOS</option>
							<option value="pc" selected="selected">Pc</option>
							<option value="table" selected="selected">Table</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan='2'><center>
					<input type="submit" name="addWall" value="ADD Wall" class="btn btn-info"/>
					</center></td>
				</tr>
		</table>
		</form>
			<?php
		}
	}
?>