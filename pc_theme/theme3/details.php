<?php
$id=addslashes($_GET['details']);
mysql_query("Update `app_info` set `view`=`view`+1 where `id`='$id'");
$list_app_query=mysql_query("Select * from app_info where id='$id' and status='0'");
$list_app=mysql_fetch_array($list_app_query);
?>
<div class="maincontent license-free">
<h1 class="detail-title">
        <img src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img']?>" class="software-icon">
         <?php echo $list_app['name']; ?>
    </h1>
    <div class="detail-content">
<img src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img']?>" class="detail-img">
        <ul class="detail-info">
                <li class="downloads-info">
                    <span class="item-label">Download</span>
                    <span class="item-info"><?php echo $list_app['view']; ?></span>
                </li>
                
            <li class="dateadded-info">
                <span class="item-label">Updated</span>
                <span class="item-info"><?php echo $list_app['date_update']; ?></span>
            </li>
			 <li class="dateadded-info">
                <span class="item-label">Version</span>
                <span class="item-info"><?php echo $list_app['version']; ?></span>
            </li>
			 <li class="dateadded-info">
                <span class="item-label">Size</span>
                <span class="item-info"><?php echo $list_app['size']; ?></span>
            </li>
			 <li class="dateadded-info">
                <span class="item-label">Producer</span>
                <span class="item-info"><?php echo $list_app['producer']; ?></span>
            </li>
			
        </ul>
        <div class="download-info">
            <a id="DownloadButtonTop" title=" Top Developer Despicable Me" href="<?php echo $list_app['link_offer']; ?>" rel="nofollow" target="_blank" class="download-button windows">
                <span>Download</span>
            </a>
            
</div>
<div class="description">
		<h2 class="overview-title">Information</h2>
		<?php echo $list_app['content']; ?>
</div>

        
        <div class="relatedlist">
            <h2 class="title">Related games</h2>
            <ul class="list-items">
			<?php
				$list_app_query=mysql_query("Select * from app_info where os='".$list_app['OS']."' and status='0'");
				if(mysql_num_rows($list_app_query))
				{
					while($list_app_relate=mysql_fetch_array($list_app_query))
					{
			?>
                <li class="list-item">
					<a class="imageslink windows" href="<?php echo $domainsite;?>/index.php?details=<?php echo $list_app_relate['id'];?>" title="Castle Clash">
						<img class="iconimg" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app_relate['link_img'];?>" alt="Castle Clash"><?php echo $list_app_relate['name'];?><em><?php echo $list_app_relate['view'];?></em>
					</a>
				</li>
			<?php
					}
				}
			?>
			</ul>
        </div>
    </div>
</div>