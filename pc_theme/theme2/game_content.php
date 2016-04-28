<div class="gamebox">
<?php include("list_app_hot.php");?>   
</div>
<div class="gamebox newgame">
	<?php
	include("slideshow.php");
	?>
</div>
 

<div class="gamebox">
<?php
	include("list_app_os.php");
?>
</div>
		
		
<script type="text/javascript" src="<?php echo $path;?>/file/v4/appstore/js/eventhot-1.05.min.js" ></script>   
<script type="text/javascript">
zm.ready(function() {
    zasSlideHorizonal.slide(5, 3, ".boxslide_newgame .listgame", 235, ".leftslidearr", ".rightslidearr", 1);
});
</script>       
 <script type="text/javascript">
        var othertab = "";
        function selectTab(){
            if(othertab !== "active"){
                zm('#tabother').removeClass('active');
            }
        }
    </script>