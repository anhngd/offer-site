<?php
	include("./function/config.php");
	if(isset($_GET['subId'])&&isset($_GET['offerId']))
	{
		$offerId=$_GET['offerId'];
		$query_offer=mysqli_query($conn,"Select * from offers where offerId='$offerId'") or die (mysqli_error());
		if(mysqli_num_rows($query_offer))
		{
			$offer=mysqli_fetch_array($query_offer);
			$goUrl=$offer['url'].$_GET['subId'];
			echo "<meta http-equiv='refresh' content=\"0;url='$goUrl'\">";
			//header("Location:$goUrl");
		}
		else
		{
			echo "Error offer ID";
		}
	}
?>