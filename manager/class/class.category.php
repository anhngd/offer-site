<?php
	class category
	{
		public $id;
		public $category_name;
		public $isGame;
		public $os;
		
		public function delete_category()
		{
			$query_delete_category=mysql_query("Delete FROM listcategory where id='".$this->id."'");
			if($query_delete_category)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		public function show_add_category()
		{
			?>
			<form action="" method="post">
			<table style="width:30%;margin:0px auto">
				<tr>
					<td>
						Category Name:
					</td>
					<td>
						<input type="text" name="category_name" class="txt" value="" />
					</td>
				</tr>
				<tr>
					<td>
						Link icon:
					</td>
					<td>
						<input type="text" name="link_icon" class="txt" value="" />
					</td>
				</tr>
				<tr>
					<td>
						OS
					</td>
					<td>
						<select name="os">
							<option value='android'>Android</option>
							<option value='ios'>iOs</option>
							<option value='pc'>PC</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Is Game
					</td>
					<td>
						<input type="checkbox" name="isGame" class="txt" value="" />
					</td>
				</tr>
				<tr>
					<td colspan='2'><center>
					<input type="submit" name="addCategory" value="ADD OFFER" class="btn btn-info"/>
					</center></td>
				</tr>
		</table>
		</form>
			<?php
		}
	}
?>