<div id="header">
    <div class=""><a href="./index.php" title=""><span class="slogan">Always</span><img style="width:360;height:60;" src="<?php echo $array_template_pc['logo'];?>"></a></div>
<div class="searchbox">
        <input data-type="search" type="text" name="keyword" class="query" id="search" placeholder="Search..." />
</div>
<script type="text/javascript" src="<?php echo $path;?>/js/jquery.min.js"></script>   
<script>
   $('#search').keydown(function(event){ 
   //alert('abc');
    var keyCode = (event.keyCode ? event.keyCode : event.which);   
    if (keyCode == 13) {
        var key1 = $("#search").val();
        window.location.replace("./index.php?keyword="+key1);
    }
});
</script>
	
</div>


        <div class="mainNav clearfix">
    <ul>
        <li class="ios">
            <a class="nav-item" href="<?php echo $domainsite;?>/index.php?os=ios">
                iOS Apps
            </a>

        </li>
        <li class="android">
            <a class="nav-item" href="<?php echo $domainsite;?>/index.php?os=android">
                Android Apps
            </a>

        </li>
        <li class="windowsphone">
            <a class="nav-item" href="<?php echo $domainsite;?>/index.php?os=winphone">
                Winphone Apps
            </a>

        </li>
        <li class="windows">
            <a class="nav-item" href="<?php echo $domainsite;?>/index.php?os=pc">
                PC Apps
            </a>
        </li>
    
    </ul>
    
    <p style="height: 200px;   clear: both;font-size: 40px;color: #ccc;text-align: center;border-top: 1px solid #ccc;">
    <a target="" title="<?php echo $domainsite;?>" href="<?php echo $domainsite;?>"><img src="<?php echo $path;?>/upload/files/12(1).jpeg" style="clear: both" height="200" width="980"></a>
    </p>
</div>