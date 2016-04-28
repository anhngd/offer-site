<?php
include("banner.php");
$os=addslashes($_GET['os']);
$query_list_apps_top=mysql_query("Select * from app_info where os='$os' order by view desc");
if(mysql_num_rows($query_list_apps_top))
{
	
		
	?>
<div class="game_content">
<div class="gamebox">

<h1 style="text-transform: uppercase;"><span class="categame"></span><?php echo $os;?></h1>
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
</div>
<?php
}
else
{
	?>
		<div class="description_box" id="box_short_desc_cate">
		<h2 class="desc_icn zapp_sprt">
		Description
		</h2>
		<p>
		</p><p style="text-align: justify;">Appstore - All people can free download app from website. Let's <a href="./register.php">register</a> to upload apps to Appstore and share it for your friend!
		</p>
		<p></p>
		</div>
	<?php
}
?>
<div class="gamebox">
<?php include("list_app_hot.php");?>   
</div>
</div>
