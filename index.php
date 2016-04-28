<?php

	include("./managerOffer/function/config.php");
	include("Mobile_Detect.php");
	include("class/class.theme.php");
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
	else
	{
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		$template=new template;
		if($deviceType=='computer')
		{	
			$array_template_pc=$template->pick_theme("pc");
			if($array_template_pc['path']!="")
			{	
				$path="$domainsite/pc_theme/".$array_template_pc['path'];
				include("./pc_theme/".$array_template_pc['path']."/index.php");
			}
		}
		else
		{
			$array_template_pc=$template->pick_theme("m");
			if($array_template_pc['path']!="")
			{	
				$path="$domainsite/m_theme/".$array_template_pc['path'];
				include("./m_theme/".$array_template_pc['path']."/index.php");
			}
		}
	}
	
?>
