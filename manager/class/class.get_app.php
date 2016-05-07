<?php
	class offer
	{
		public $id;
		public $offerId;
		public $name;
		public $des;
		public $url;
		public $image_url;
		public $cc;
		public $network;
		public $status;
		public $payout;
		public $ratio;

		public function delete_offer()
		{
			$query_delete_offer = mysql_query("DELETE FROM offers WHERE id = '".$this->id."'");
			if($query_delete_offer)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		function post_edit_offer()
		{
			$final_report2="";
			if($offerId == NULL) {
				$final_report2.= "Please input Offer ID !";
			} else {
				if($name == NULL) {
					$final_report2.= "Please input Offer Name !";
				} else {
					if ($payout == NULL) {
						$final_report2.= "Please input Offer Payout !";
					} else {
						if($url == NULL) {	
							$final_report2.= "Please input Offer URL !";
						} else {
							if($cc == NULL) {
								$final_report2.= "Please input Offer Country !";
							} else {
								if($network == NULL) {
									$final_report2.= "Please input Offer Network !";
								} else {
									$update_offer = mysql_query("UPDATE offers SET offerId ='".$this->offerId."', name ='".$this->name."', des ='".$this->des."', payout ='".$this->payout."', ratio ='".$this->ratio."', url ='".$this->url."', imageUrl ='".$this->image_url."', country ='".$this->cc."', network ='".$this->network."' , status ='".$this->status."' WHERE id ='".$this->id."'") or die(mysql_error());
									$final_report2.= 'Offer edited successfully !<br><a href="offers.php">Come back</a> to offers list.';						
								}
							}
						}
					}
				}
			}
			return $final_report2;
		}
		
		
	}
?>