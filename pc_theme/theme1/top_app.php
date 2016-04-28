<?php
$list_app_query=mysql_query("Select * from app_info where status='0' order by view desc limit 0,10");
$i=1;
while($list_app=mysql_fetch_array($list_app_query))
{
	?>
	<ul class="top-app list-group">
		<li>
			<div class="thumbnail">
				<div class="badge-app app-<?php echo $i;?>"><span><?php echo $i;?></span></div>
				<div class="picCard">
					<a href="<?php echo $domainsite."/index.php?details=".$list_app['id'];?>"><img alt="" style="background :url('<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img']?>') no-repeat center;" src="<?php echo $path;?>/default-app.png"></a>
				</div>
				<div class="caption">
					<h5 class="titleCard"><a href="<?php echo $domainsite."/index.php?details=".$list_app['id'];?>"><?php echo $list_app['name']; ?></a>
					</h5>

					<p class="subCard"><a href="<?php echo $domainsite."/index.php?details=".$list_app['id'];?>"><?php echo $list_app['producer']; ?></a></p>
											<p class="btnCard" id="no-download-1577">
					</p>
											<p class="btnCard" id="downloading-1577" style="display: none;">
					</p>
				</div>
			</div>
		</li>
				
	</ul>
	<?php
	$i++;
}
?>