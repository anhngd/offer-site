<?php
$id=addslashes($_GET['detail']);
$add_view=mysql_query("Update app_info set view=view+1 where id='$id'");
$list_app_query=mysql_query("Select * from app_info where id='$id' and status='0'");
$list_app=mysql_fetch_array($list_app_query);
?>
<div class="appst_contcol">
<div class="app_detailbody">
	<div class="app_shortdesc">
		<p style="background-image: url('<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img']?>');" class="rapp_thumb"> 
			<a href="#" target="" title="<?php echo $list_app['name']; ?>">
				<img width="110" height="110" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img']?>" alt="<?php echo $list_app['name']; ?>" /> 
			</a>
			<span class="app_tinystar appstar_5"></span>
		</p>
		<ul class="app_desctext">
			<li><strong class="gametits"><?php echo $list_app['name']; ?></strong></li>
			
			<li>
				<p class="numplay"><?php echo $list_app['view']; ?> Download</p>
			</li>
			<li><a href="<?php echo $list_app['link_offer']; ?>" target="" class="btn_play" title="Download"><strong>Download</strong></a></li>
		 </ul>
		<div class="clr"></div>     
		<br />       
		<div class="intro_game_detail">
			<div class="headact">
				<h1><span class="introicn"></span> Description</h1>
			</div>
			<div style="height:auto" class="gamecontent" id="bcontent">
			<?php echo $list_app['content']; ?>
			</div>

			<div class="appdesc_section last">
				<!--<h1><span class="poll_icn"></span> Rate</h1>
				<ul class="starvote_list">
					<li>5 <span class="app_tinystar appstar_1"></span></li>
					<li>4 <span class="app_tinystar appstar_1"></span></li>
					<li>3 <span class="app_tinystar appstar_1"></span></li>
					<li>2 <span class="app_tinystar appstar_1"></span></li>
					<li>1 <span class="app_tinystar appstar_1"></span></li>
				</ul>
				<ul class="app_rankingbar">
					<li class="vote_1star"> <span class="app_votebar" style="width:169px;"></span> <span class="app_votenumber">2.374</span> </li>
					<li class="vote_2star"> <span class="app_votebar" style="width:8px;"></span> <span class="app_votenumber">123</span> </li>
					<li class="vote_3star"> <span class="app_votebar" style="width:4px;"></span> <span class="app_votenumber">60</span> </li>
					<li class="vote_4star"> <span class="app_votebar" style="width:3px;"></span> <span class="app_votenumber">49</span> </li>
					<li class="vote_5star"> <span class="app_votebar" style="width:13px;"></span> <span class="app_votenumber">196</span> </li>
				</ul>
				<div class="app_gpa">
					<p class="gpa_texttitle">GPA</p>
					<p class="gpa_mark">4.58</p>
					<div class="app_tinystar appstar_5"></div>
					<p class="gpa_number">(2.802)</p>
				</div>
				<div class="clr"></div>
						-->
				<br />
				<?php 
				$list_app_query=mysql_query("Select * from app_info where status='0'");
				if(mysql_num_rows($list_app_query))
				{
				?>
				<div class="related_app">
					<p class="relapp_header"><strong>Related Applications:</strong></p>
					<ul class="listgame">
					<?php
						while($list_app=mysql_fetch_array($list_app_query))
						{
					?>
						<li>
							<p class="rapp_thumb" style="background-image:url('<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img'];?>');"><a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $list_app['id'];?>" title="Quickr (Android) IN S4020"><img src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img'];?>" alt="Quickr (Android) IN S4020"></a><span class=""></span> </p>
							<p class="rappname"><a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $list_app['id'];?>" title="Quickr (Android) IN S4020"><strong><?php echo $list_app['name'];?></strong></a></p>
							<p><span class="app_tinystar appstar_4"></span></p>
							<p class="playcount"><?php echo $list_app['view'];?> view</p>
						</li>
					<?php
						}
					?>
					</ul>
					<div class="clr"></div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>