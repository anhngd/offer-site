<a class="newgame_label" href="#"></a>
    <ul class="numlist">
        <li><a class="leftslidearr" href="javascript:void(0);"></a></li>
        <li><a class="rightslidearr" href="javascript:void(0);"></a></li>
    </ul>
    <div class="boxslide_newgame">
 <ul class="listgame clearfix" style="width: 2000px">
 <?php
		$query_list_apps_top=mysql_query("Select * from app_info order by view desc limit 0,5");
		if(mysql_num_rows($query_list_apps_top))
		{
			while($rows=mysql_fetch_array($query_list_apps_top))
			{
			?>
<li>
<p class="rapp_thumb" style="background-image: url('<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>');">
<a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="Touch 2.0" style="display: block">
	<img width="110" height="110" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>" alt="UC Browser : Android : IN : AD2112" />
</a>
<span class="newrib"></span>
</p>
<p class="appname"><a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="<?php echo $rows['name'];?>"><strong><?php echo $rows['name'];?></strong></a></p>
<p><span class="app_tinystar appstar_4"></span></p>
<p class="playcount"><?php echo $rows['producer'];?></p>
<p class="playcount"><?php echo $rows['view'];?> view</p>
</li>
	<?php
			}
		}
	?>
</ul>
</div>
<div class="clr"></div>