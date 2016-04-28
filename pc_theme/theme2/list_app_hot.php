<h1><!--<a class="moregame" href="#">View More</a>--><span class="hoticn"></span><a href="#" title="Game Hot">APPS HOT</a></h1>
<?php
$query_list_apps_top=mysql_query("Select * from app_info where `hot`='1' order by view desc limit 0,10");
if(mysql_num_rows($query_list_apps_top))
{
	while($rows=mysql_fetch_array($query_list_apps_top))
	{
	?>
    <ul class="listgame">
		<li>
            <p class="rapp_thumb" style="background-image: url('<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>');">
                <a href="./index.php?detail=<?php echo $rows['id'];?>" title="UC Browser : Android : IN : AD2112" style="display: block">
                    <img width="110" height="110" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$rows['link_img']?>" alt="UC Browser : Android : IN : AD2112" />
                </a>
<span class="hotrib"></span>
                
            </p>
            <p class="rappname">
                <a href="./index.php?detail=<?php echo $rows['id'];?>" title="UC Browser : Android : IN : AD2112"><?php echo $rows['name'];?><strong></strong></a>
            </p>    
            <p><span class="app_tinystar appstar_5"></span></p>
            <p class="playcount"><?php echo $rows['view'];?> view</p>
        </li>
    </ul>
   <?php
	}
}
?>
   <div class="clr"></div>