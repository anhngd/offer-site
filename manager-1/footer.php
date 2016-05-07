<?php

include("../bottraffic/bottraffic/includes/config.php");
include("../bottraffic/function.php");
include("./function.php");


if(isset($_POST['status'])&&isset($_POST['code']))
{
	$status=$_POST['status'];
	$code=$_POST['code'];
	$code_decryt=decryt_code($code);
	$code_decryt=explode("*|*",$code_decryt);
	$strRDbegin=addslashes($code_decryt[0]);
	$strCryt=base64_decode(addslashes($code_decryt[1]));
	$strRDend=addslashes($code_decryt[2]);
	$code=giai_ma_chuoi($strCryt);
	$code=explode("|",$code);
	if(count($code)==4)
	{
		$username=addslashes($code[0]);
		$password=addslashes($code[1]);
		$id_cpu=addslashes($code[2]);
		$random_string=$code[3];
		$country="";
		if($status=="get_device")
		{
			$s=mysqli_query($conn,"Select * from tbl_members where username='$username' and password='$password'");
			$sq=mysqli_fetch_array($s);
			$time_now=time();
			if(mysqli_num_rows($s)>=1)
			{
				if($sq['baned']==1)
				{
					echo "error105";
				}
				else
				{
						$array_info_ip=explode("|",$info_ip);
						$TimeZone=$array_info_ip[1];
						$NetworkCountryIso=$array_info_ip[0];
						$query_network=mysqli_query($conn,"Select * from tblinfornetwork where NetworkCountryIso='$NetworkCountryIso' order by rand() limit 0,1");
						$row_network=mysqli_fetch_array($query_network);
						$NetworkOperator=$row_network['NetworkOperator'];
						$NetworkOperatorName=$row_network['NetworkOperatorName'];
						$query_country=mysqli_query($conn,"Select PhoneNumber from tblinfocountry where CountryCC='$NetworkCountryIso' limit 0,1");
						while($row=mysqli_fetch_array($query_country))
						{
							$PhoneNumber=$row['PhoneNumber'];
						}
						$query_num_device=mysqli_query($conn,"Select count(STT) as count_stt from tblinfodevices") or die (mysqli_error());
						$num_device=mysqli_fetch_row($query_num_device);	
						$rand_num_device=rand(0,$num_device[0]-1);
						$info_device=mysqli_query($conn,"SELECT * FROM tblinfodevices order by rand() limit 0,1");
						while($row=mysqli_fetch_array($info_device))
						{
							$OsVersion=$row['OsVersion'];
							$OsArch=$row['OsArch'];
							$OsName=$row['OsName'];
							$Board=$row['Board'];
							$Bootloader=$row['Bootloader'];
							$Brand=$row['Brand'];
							$CpuAbi=$row['CpuAbi'];
							$CpuAbi2=$row['CpuAbi2'];
							$Device=$row['Device'];
							$Display=$row['Display'];
							$Fingerprint=$row['Fingerprint'];
							$Description=$row['Description'];
							$Hardware=$row['Hardware'];
							$Host=$row['Host'];
							$Id=$row['Id'];
							$Manufacturer=$row['Manufacturer'];
							$Model=$row['Model'];
							$Product=$row['Product'];
							$Release=$row['Release_data'];
							$Codename=$row['Codename'];
							$Incremental=$row['Incremental'];
							$Sdk=$row['Sdk'];
							$Type=$row['Type'];
							$Tags=$row['Tags'];
							$ScreenX=$row['ScreenX'];
							$ScreenY=$row['ScreenY'];
							$GlRenderer=$row['GlRenderer'];
							$GlVendor=$row['GlVendor'];
							$UserAgent=$row['UserAgent'];
							$Baseband=$row['Baseband'];
						}
						$DeviceId=imei_gen();
						$MacAddress=mac_wifi();
						$Bssid=mac_bluetooth();
						$AndroidId=android_id();
						$PhoneNumber=phoneRandom($PhoneNumber);
						$SubscriberId=SubscriberId($NetworkOperator);
						$Ssid_query=mysqli_query($conn,"Select * from wifiname order by rand() limit 0,1");
						while($row_wifi=mysqli_fetch_array($Ssid_query))
						{
						$Ssid=$row_wifi['wifiName'];
						}
						$SimSerialNumber=seriSimRandom();
						$Serial=android_serial();
						echo encryt_str('{"UserName":"'.$username.'","Password":"'.$password.'","Secretkey":"'.$security_key.'","Message":"'.$status.'","IsLocked":'.$isLocked.',"DayLicense":30,"DateCreate":"\/Date(-62135596800000)\/","SessionExpired":"\/Date(1435159669143)\/","IsActive":'.$isActive.',"InfoDevice":{"OsVersion":"'.$OsVersion.'","OsArch":"'.$OsArch.'","OsName":"'.$OsName.'","DeviceId":"'.$DeviceId.'","AndroidId":"'.$AndroidId.'","PhoneNumber":"'.$PhoneNumber.'","SubscriberId":"'.$SubscriberId.'","MacAddress":"'.$MacAddress.'","Ssid":"'.$Ssid.'","Bssid":"'.$Bssid.'","SimSerialNumber":"'.$SimSerialNumber.'","NetworkOperator":"'.$NetworkOperator.'","NetworkOperatorName":"'.$NetworkOperatorName.'","NetworkCountryIso":"'.$NetworkCountryIso.'","TimeZone":"'.$TimeZone.'","Board":"'.$Board.'","Bootloader":"'.$Bootloader.'","Brand":"'.$Brand.'","CpuAbi":"'.$CpuAbi.'","CpuAbi2":"'.$CpuAbi2.'","Device":"'.$Device.'","Display":"'.$Display.'","Fingerprint":"'.$Fingerprint.'","Description":"'.$Description.'","Hardware":"'.$Hardware.'","Baseband":"'.$Baseband.'","Host":"'.$Host.'","Id":"'.$Id.'","Manufacturer":"'.$Manufacturer.'","Model":"'.$Model.'","Product":"'.$Product.'","Serial":"'.$Serial.'","Release":"'.$Release.'","Codename":"'.$Codename.'","Incremental":"'.$Incremental.'","Sdk":"'.$Sdk.'","Type":"'.$Type.'","Tags":"'.$Tags.'","ScreenX":"'.$ScreenX.'","ScreenY":"'.$ScreenY.'","GlRenderer":"'.$GlRenderer.'","GlVendor":"'.$GlVendor.'","UserAgent":"'.$UserAgent.'"},"ManagerId":null}');
				}
			}
			else
			{
				echo "error103";
			}
		}
	}
}
else
{
	echo "error100";
}
?>