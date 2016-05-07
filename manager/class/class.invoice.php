<?php
	class invoice
	{
		public $userName;
		public $from_day;
		public $to_day;
		public $request_by_name;
		public $status_paid;
		public $offerId;
		public $netname;
			
		public function paid()
		{
			if(isset($this->offerId)&&$this->offerId!="")
			{
				$offerId=addslashes($this->offerId);
				$group_by_name=",offerName";
				$query_offer=mysql_query("Select name from offers where offerId='".$this->offerId."'");
				$row_offer_name=mysql_fetch_array($query_offer);
				$query_by_name=" and offerName='".$row_offer_name['name']."'";
				$value_by_offer=addslashes($row_offer_name['name']);
				$value_by_network="";
			}
			else
			if(isset($this->netname)&&$this->netname!="")
			{
				$group_by_name=",offerNwk";
				$query_by_name=" and offerNwk='".addslashes($this->netname)."'";
				$value_by_offer="";
				$value_by_network=addslashes($this->netname);
			}
			else
			{
				$group_by_name="";
				$query_by_name="";
				$value_by_offer="";
				$value_by_network="";
			}
				$query_point=mysql_query("Select sum(points) as sumpoints,userName,offerName,offerNwk from shoutbox where DATE(date)>='".$this->from_day."' and DATE(date)<='".$this->to_day."' and status='NONE' and userName='".$this->userName."' $query_by_name group by userName$group_by_name order by userName,sumpoints,offerNwk desc") or die (mysql_error());
				if(mysql_num_rows($query_point))
				{
					$date_create=date("Y-m-d H:i:s");
					$row=mysql_fetch_array($query_point);
					$query_insert_invoice="Insert into invoice(`userName`,`points`,`from`,`to`,`offerName`,`network`,`date_create`,`status`) value ('".$row['userName']."','".$row['sumpoints']."','".$this->from_day."','".$this->to_day."','".$value_by_offer."','".$value_by_network."','$date_create','".$this->status_paid."')";
					mysql_query($query_insert_invoice) or die (mysql_error());
					$sumUsers=mysql_query("Update shoutbox set `status`='".$this->status_paid."' where DATE(date)>='".$this->from_day."' and DATE(date)<='".$this->to_day."' and userName='".$this->userName."' and `status`='NONE'$query_by_name order by points desc") or die (mysql_error());
					return 1;
				}
				else
				{
					return 0;
				}
				
		}
		
	}
?>