<?php
$id=addslashes($_GET['details']);
$add_view=mysql_query("Update app_info set view=view+1 where id='$id'");
$list_app_query=mysql_query("Select * from app_info where id='$id' and status='0'");
$list_app=mysql_fetch_array($list_app_query);
?>
<div class="col-detail">
	<div class="app-cover">
		<div class="thumbnail-detail">
			<div class="picCard">
				<img class="lazy" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img']?>">
			</div>
			<div class="caption">
				<h1 class="titleCard"><?php echo $list_app['name']; ?></h1>

				<p class="subCard"><a href="#"><?php echo $list_app['producer']; ?></a></p>

				
				<div class="selectDownload">
					<div class="btnVersion" id="ajax_version_show"></div>
					<div class="btnDownload">
																<a id="no-download-35461" class="btn btn-primary" href="<?php echo $list_app['link_offer']; ?>"><i class=""></i>Download</a>
						
						<style type="text/css">
							.proccesing-download {
								-moz-user-select: none;
								background-image: none;
								display: inline-block;
								font-size: 14px;
								font-weight: bold;
							}
						</style>
					</div>
				</div>
				<div class="qrcode">
					<div class="picCode" style="margin-bottom:5px"> 
						<a data-target="#install-QRCode" data-toggle="modal" href="#">
																		
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	
	<hr class="line-block">
	<div class="header"><h2 style="font-size: 24px;"><?php echo $list_app['name']; ?></h2></div>
	<div class="app-desc">
	<div class="desc-inner">
		<?php echo $list_app['content']; ?>
	</div>
	</div>
	<hr class="line-block">
	<div class="header"><h3>Info application</h3></div>
	<div class="info-app">
		<div class="col-sm-2 col-md-2">
			<h5>Update</h5><?php echo $list_app['date_update']; ?></div>
		<div class="col-sm-2 col-md-2">
			<h5>Version:</h5><?php echo $list_app['version']; ?></div>
		<div class="col-sm-2 col-md-2">
			<h5>Size:</h5><?php echo $list_app['size']; ?></div>

		<div class="col-sm-2 col-md-2">
			<h5>View</h5><?php echo $list_app['view']; ?></div>
	</div>
	<hr class="line-block">	
</div>