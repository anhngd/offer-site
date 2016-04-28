<?php
$id=addslashes($_GET['details']);
$add_view=mysql_query("Update app_info set view=view+1 where id='$id'");
$list_app_query=mysql_query("Select * from app_info where id='$id' and status='0'");
$list_app=mysql_fetch_array($list_app_query);
?>

<div class="pathbar path">
    <div class="leftpath"> 
        <a href="<?php echo $domainsite?>"><img alt="home" src="./Bullet Boy (Mod Money)_files/home.png"></a>
        <a href="<?php echo $domainsite?>"><?php echo $list_app['name']; ?></a>
    </div>
</div>
<div class="title_app">
  <ul>
    <li class="appdetail">
        <span class="ribbon_free"></span>
		<span class="shadown">
			<img alt="list" src="<?php echo $domainsite."/".$dir_member."/".$dir_img."/".$list_app['link_img']?>">
        </span>
        <span class="comment"><?php echo $list_app['name']; ?></span>
        <span class="name"><?php echo $list_app['producer']; ?></span>
        <span class="download">
            <b class="iVers"><?php echo $list_app['version']; ?></b>
            <b class="iSize"><?php echo $list_app['size']; ?></b>
            <b class="iView"><?php echo $list_app['view']; ?></b>
        </span>

                        <div class="priceItem">
        <a href="<?php echo $list_app['link_offer']; ?>" id="country2-link" class="normalDown">Download</a> 
		</div>
    </li>
  </ul>
</div>
   
<div class="tabContent">
    <div class="shadetabs">
    <ul class="links">
          <li><a  class="selected"><span><?php echo $list_app['name']; ?></span></a></li>
          <li></li>
        </ul>
    </div>
    <div class="sContent">
    <div id="country1" class="tabselected">
          <div class="dContent">
              <!-- screenshot -->
           
            <!-- end screenshot -->
        <div class="desc_app">
            <ul class="data">
            <li>
              <?php echo $list_app['content']; ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>