<?php
if(isset($_POST['keyword']))
{
	$keyword=addslashes($_POST['keyword']);
}
else
{
	$keyword="";
}
	$list_app_query=mysql_query("Select * from app_info where (name like '%$keyword%' or content like '%$keyword%') and status='0'");
	if(mysql_num_rows($list_app_query))
	{
?>
<div class="block-list" id="main-center">
	<div class="header">
	</div>
	<div class="header">
		<h3 id="topName">Result search: <?php echo $keyword." (".mysql_num_rows($list_app_query);?> result) </h3>
	</div>
	
	<div class="col-list" id="auto-scroll">
		
		<?php
				while($list_app=mysql_fetch_array($list_app_query))
				{
				?>
				<div id="content">  
					<div id="appdetail"></div>
					<ul class="pageitem">
						<script type="text/javascript" src="./Appvn.com __ Các ứng dụng được tải nhiều nhất_files/jquery.raty(1).js"></script>
					<li class="store">
						<a href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app['id'];?>">
							<span class="ribbon_free"></span>                <span class="shadown"><img alt="list" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img'];?>"></span>
							<span class="comment"><?php echo $list_app['name'];?></span>
							<span class="name"><?php echo $list_app['producer'];?></span>
							<span class="download">
								<b class="iView"><?php echo $list_app['view'];?></b>
							</span>
						</a>
							<div class="showQuick">
							<a href="javascript:;" onclick="return;listshow_fastdown(17);" id="aid-17">show</a>
						</div>
					</li>
				</ul>    
				</div>
				
				<?php
				}
			}
		?>
		
	</div>
</div>