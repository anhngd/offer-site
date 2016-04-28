<?php
	$keyword=addslashes($_POST['keyword']);
	$list_app_query=mysql_query("Select * from app_info where (name like '%$keyword%' or content like '%$keyword%') and status='0'");
	if(mysql_num_rows($list_app_query))
	{
?>
<div class="block-list" id="main-center">
	<div class="header">
		<h3 id="topName">Result search: <?php echo $keyword." (".mysql_num_rows($list_app_query);?> result) </h3>
	</div>
	<div class="col-list" id="auto-scroll">
		
		<?php
				while($list_app=mysql_fetch_array($list_app_query))
				{
				?>
				<div class="col-sm-6 col-lg-2 col-md-3 col-xlg-2">
					<div class="thumbnail">
						<div class="picCard">
							<a href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app['id'];?>"><img class="lazy" alt="" style="background :url('<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img'];?>') no-repeat center;" src="./theme/default-app.png"></a>
						</div>
						<div class="caption">
							<h5 class="titleCard"><a href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app['id'];?>"><?php echo $list_app['name'];?></a>
							</h5>

							<p class="subCard"><a href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app['id'];?>"><?php echo $list_app['producer'];?></a></p>
							<p class="btnCard" id="no-download-19008">
								<a class="btn btn-default" href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app['id'];?>">Download</a>
							</p>
						</div>
					</div>
				</div>
				<?php
				}
		?>
	</div>
</div>
<?php
	}
	else
	{
		?>
			<div class="block-list" id="main-center">
			<div class="header">
				<h3 id="topName">Result search: <?php echo $keyword." (".mysql_num_rows($list_app_query);?> result) </h3>
			</div>
			</div>
		<?php
	}
?>