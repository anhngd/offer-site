<div class="menuleft">
	<div id="categorynav" class="navigation">
		<div class="title">APPS HOT</div>
			<ul class="list-nav">
				<?php
				$list_app_query=mysql_query("Select * from app_info where status='0' and hot='ON' order by rand() desc limit 0,10");
				$i=1;
				while($list_app=mysql_fetch_array($list_app_query))
				{
				?>
				<li>
					<a title="<?php echo $list_app['name']; ?>"
					   href="<?php echo $domainsite."/index.php?details=".$list_app['id'];?>">
						<img class="icon-nav" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img'];?>" align="left" />
						<?php echo $list_app['name']; ?>
					</a>
				</li>
				<?php
				}
				?>
			</ul>
	</div>
</div>
<div class="menuleft">
	<div id="categorynav" class="navigation">
		<div class="title">TOP APPS</div>
		<ul class="list-nav">
			<?php
			$list_app_query=mysql_query("Select * from app_info where status='0' order by view desc limit 0,10");
			$i=1;
			while($list_app=mysql_fetch_array($list_app_query))
			{
			?>
			<li>
				<a title="<?php echo $list_app['name']; ?>"
				   href="<?php echo $domainsite."/index.php?details=".$list_app['id'];?>">
					<img class="icon-nav" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img'];?>" align="left" />
					<?php echo $list_app['name']; ?>
				</a>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
</div>