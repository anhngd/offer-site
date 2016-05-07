<div class="box span12  form_member">
<div class="box-header">
	<h2><i class="halflings-icon white list"></i><span class="break"></span>MANAGER CATEGORY</h2>
	<div class="box-icon">
		<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
		<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
	</div>
</div>
<div class="box-content-static">
<?php
	if(isset($_POST['addCategory']))
	{
		$final_report2="";
		$category_name = addslashes($_POST['category_name']);
		if(!isset($isGame))
		{
			$isGame="NO";
		}
		else
		{
			$isGame="YES";
		}
		$os = addslashes($_POST['os']);
		$link_icon = addslashes($_POST['link_icon']);
		if($category_name== NULL) {
		$final_report2.= "Please input Category Name !";
		} else {
		if($os == NULL) {
			$final_report2.= "Please input OS !";
		} else 
			{
				$addOffer = mysqli_query($conn,"INSERT INTO `listcategory` (`category_name`,`os`, `isGame`, `link_icon`) VALUES('$category_name','$os','$isGame','$link_icon')") or die(mysqli_error()); 				
				$final_report2.= 'Category added successfully !';
			}
		}
	}
?>
<div id="reponse_post"><?php if(isset($final_report2)) echo "<span style=color:red>$final_report2</span>"; ?></div>

	<div style="clear:both;"></div>
<?php

	if(isset($_POST['delCategories']) && isset($_POST['id'])){
		$total = count($_POST['id']);
        for($i=0; $i<$total; $i++) {
            $delCategories = mysqli_query($conn,"DELETE FROM listcategory WHERE id ='".addslashes($_POST['id'][$i])."'") or die(mysqli_error());
        }
        header("Location: index.php?categorys=android");
	}

?>

			<div style="float:right;">
				<span name="check_ssh" class="btn btn-info" href="#" id="button_add_app"  onclick="show_add_category()">ADD OFFERS</span>
			</div>
			<div class="container_table">
			<form action="./index.php?categorys=android" method="POST">
			<table  id="list_members" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed">
				<thead>
				<tr>
					<th>ID</th>
					<th>Category Name</th>
					<th>OS</th>
					<th>Is Game</th>
					<th>Link icon</th>
					<th>DELETE</th>
				</tr>
				</thead>
				<tbody>
				<?php 
						$querycategorys = mysqli_query($conn,"SELECT * FROM listcategory") or die(mysqli_error());
						while($category = mysqli_fetch_array($querycategorys)) {
							echo '<tr id="tr_'.$category['id'].'">';
							echo '<td>' . $category['id'] .'</td>'; 
							echo '<td>' . $category['category_name'] .'</td>'; 
							echo '</td><td>' . $category['os'] .'</td>';
							echo '</td><td>' . $category['isGame'] .'</td>';
							echo '</td><td>' . $category['link_icon'] .'</td>';
							echo '<td><center><a class="btn btn-danger button_tb manager mousepointer" onclick="delete_category(\''.$category['id'].'\')">Delete</a></center></td>';
							echo '</tr>';
						}
					
				?>
				</tbody>
				
			</table>
			</form>
			</div>
</div>
</div>
