<div class="maincontent license-free">
<?php 
$os=addslashes($_GET['os']);
$list_app_query=mysql_query("Select * from app_info where os='$os' and status='0'");
if(mysql_num_rows($list_app_query))
{
?>
<div class="new-list">
            <div class="new-list-title">iOS Apps</div>
                <ul class="list-view">
					<?php
					while($list_app=mysql_fetch_array($list_app_query))
					{
					?>
					<li class="list-item">
						<a class="imageslink"
						   href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app['id'];?>"
						   title="Castle Clash">
							<img class="imgproduct" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img'];?>" alt="Castle Clash" />
						</a>
						<ul class="list-item-info">
							<li>
								<a href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app['id'];?>"
								   title="Castle Clash" class="title" style="display: block;width:100%;    overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"><?php echo $list_app['name'];?></a>
							</li>
							<li class="rating-stars"><span class="star star-5"></span></li>
							
								<li class="download-number"><span class="number"><?php echo $list_app['view'];?></span> views</li>
						</ul>
					</li>
					<?php
					}
					?>
				</ul>
        </div>
<?php
}
?>
</div>