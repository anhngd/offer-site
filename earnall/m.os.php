<?php 

$list_app_query=mysql_query("Select offers.id as id,offers.name as name,offers.producer,offers.imageUrl as link_img,offers.url as url,offers.payout as payout,offers.ratio as ratio from offers inner join networks ON networks.name=offers.network inner join offers_country ON offers_country.offer_id=offers.offerId where offers.status='ON' and networks.status='ON' and offers.os='$os' and offers_country.country_cc='$offerCC'") or die (mysql_error());
if(mysql_num_rows($list_app_query))
			{
				?>

<div class="block-list" id="main-center">
	<div class="header">
		<h3 id="topName">New Application</h3>
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
			
				<a target="_blank" href="<?php echo $domainsite."/earn/".base64_encode($list_app['id']."_".$codelogin);
				$list_app['url'];?>">
					<span class="ribbon_free"></span>                <span class="shadown"><img alt="list" src="<?php echo $list_app['link_img'];?>"></span>
					<span class="comment"><?php echo $list_app['name'];?></span>
					<span class="name">Country: <?php echo $offerCC;?></span>
					<span class="download">Point: <?php echo $list_app['payout']*$list_app['ratio'];?>
					</span>
				</a>
			</li>
		</ul>    
		</div>
		
		<?php
		}
		?>
		
	</div>
</div>
<?php }
else
{
 ?>
	<div class="block-list" id="main-center">
		<div class="header">
			<h3 id="topName">No Application</h3>
		</div>
	</div>
	<div class="block-list" id="main-center">
		<div class="header">
			<h3 id="topName">No Application</h3>
		</div>
	</div>
	
 <?php
}
 ?>