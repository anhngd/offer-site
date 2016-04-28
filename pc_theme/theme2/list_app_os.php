<?php
$query_list_apps_top=mysql_query("Select * from app_info where os='android' order by view desc");
if(mysql_num_rows($query_list_apps_top))
{
	?>
<h1><span class="categame"></span>ANDROID</h1>
<div id="box_normal_app" class="game_list_cate">
<ul class="gamecate_detail">
<?php while($rows=mysql_fetch_array($query_list_apps_top))
	{ ?>
<li>
<div class="gamedv">
	<a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="name">
		<img class="savt" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>" alt="" />
	</a>
	<a class="titlegame" href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="UC Browser : Android : IN : AD2112"><strong><?php echo $rows['name'];?></strong></a>
	<p><span class="app_tinystar appstar_4"></span></p>
	<span class="playnum"><?php echo $rows['view'];?> view</span>
	<div class="clr"></div>
</div>
</li>
	<?php } ?>
</ul>
<div class="clr"></div>
</div>
<?php
}
?>

<?php
$query_list_apps_top=mysql_query("Select * from app_info where os='ios' order by view desc");
if(mysql_num_rows($query_list_apps_top))
{
	
		
	?>
<h1><span class="categame"></span>IOS</h1>
<div id="box_normal_app" class="game_list_cate">
<ul class="gamecate_detail">
<?php while($rows=mysql_fetch_array($query_list_apps_top))
	{ ?>
<li>
<div class="gamedv">
	<a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="name">
		<img class="savt" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>" alt="" />
	</a>
	<a class="titlegame" href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="UC Browser : Android : IN : AD2112"><strong><?php echo $rows['name'];?></strong></a>
	<p><span class="app_tinystar appstar_4"></span></p>
	<span class="playnum"><?php echo $rows['view'];?> view</span>
	<div class="clr"></div>
</div>
</li>
	<?php } ?>
</ul>
<div class="clr"></div>
</div>
<?php
}
?>

<?php
$query_list_apps_top=mysql_query("Select * from app_info where os='pc' order by view desc");
if(mysql_num_rows($query_list_apps_top))
{
	
		
	?>
<h1><span class="categame"></span>PC</h1>
<div id="box_normal_app" class="game_list_cate">
<ul class="gamecate_detail">
<?php while($rows=mysql_fetch_array($query_list_apps_top))
	{ ?>
<li>
<div class="gamedv">
	<a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="name">
		<img class="savt" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>" alt="" />
	</a>
	<a class="titlegame" href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="UC Browser : Android : IN : AD2112"><strong><?php echo $rows['name'];?></strong></a>
	<p><span class="app_tinystar appstar_4"></span></p>
	<span class="playnum"><?php echo $rows['view'];?> view</span>
	<div class="clr"></div>
</div>
</li>
	<?php } ?>
</ul>
<div class="clr"></div>
</div>
<?php
}
?>

<?php
$query_list_apps_top=mysql_query("Select * from app_info where os='windowphone' order by view desc");
if(mysql_num_rows($query_list_apps_top))
{
	
		
	?>
<h1><span class="categame"></span>Window Phone</h1>
<div id="box_normal_app" class="game_list_cate">
<ul class="gamecate_detail">
<?php while($rows=mysql_fetch_array($query_list_apps_top))
	{ ?>
<li>
<div class="gamedv">
	<a href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="name">
		<img class="savt" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>" alt="" />
	</a>
	<a class="titlegame" href="<?php echo $domainsite;?>/index.php?detail=<?php echo $rows['id'];?>" title="UC Browser : Android : IN : AD2112"><strong><?php echo $rows['name'];?></strong></a>
	<p><span class="app_tinystar appstar_4"></span></p>
	<span class="playnum"><?php echo $rows['view'];?> view</span>
	<div class="clr"></div>
</div>
</li>
	<?php } ?>
</ul>
<div class="clr"></div>
</div>
<?php
}
?>