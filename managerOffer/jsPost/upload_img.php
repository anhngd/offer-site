<?php
include("../function/config.php");
if(isset($_FILES['image']))
{
	$file_image = @$_FILES['image']; 
	$file_name = $file_image["name"];
	if($file_name!="")
	{
		$end_file_array=explode(".",$file_name);
		$num_end_file_array=count($end_file_array)-1;
		$end_file=$end_file_array[$num_end_file_array];
		if(!preg_match('/png|jpg|gif|jpeg|PNG|JPG|GIF|JPEG/',$end_file))
		{
			?>
			<script>
				alert('File format is not valid! Accept file format gif, jpeg, jpg, png');
			</script>
			
			<?php
		}
		else
		{
			if(@copy($_FILES['image']['tmp_name'],"../".$dir_img."/".$file_name))
			{
				?>
					<script>
						window.top.change_img("<?php echo $file_name; ?>");
					</script>
				<?php
			}
			else
			{
				?>
					window.top.change_img("error");
				<?php
			}
			?>
			<?php
		}
	}
}
?>