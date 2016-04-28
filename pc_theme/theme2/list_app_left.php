<div class="appst_sidepanel">
    <div class="userprofile">
 
</div>

<div id='boxgiftcode' class='boxctn'>
    </div>
    <div class="boxctn topgame" id="box_top_game">
    <h1><div class="crighttxt">          
        </div>
        <a target="" href="#" title="name" style="margin-left: 10px;">Top Apps</a>
        </h1>
    <ul class="ranktable">
	<?php
		$query_list_apps_top=mysql_query("Select * from app_info order by view desc limit 0,10");
		if(mysql_num_rows($query_list_apps_top))
		{
			while($rows=mysql_fetch_array($query_list_apps_top))
			{
			?>
				<li>
					<div class="rankgame"> 
						<a target="" href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>">
							<img class="savt_game" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>" title="Paytm-IOS-IN-Incentive LM140">
						</a>
						<p class="gamename"><a target="" href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>"><?php echo $rows['name'];?></a></p>
						<p><span class="app_tinystar appstar_4"></span></p>
						<p class="cateinfo"><?php echo $rows['producer'];?></p>
						<a href="#"></a>
					</div>
				</li>
			<?php
			}
		}
	?>
 
    </ul>
</div>
</div> 