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
		public $payout_net;
		public $status;
		public $payout;
		public $ratio;
		public $final_report2;
		public $os;
		public $offer_name;
		public $min_os_version;
		public $max_os_version;
		public $exclude_traffic;
		public $preview_link;
		public $price_model;
		public $app_category;
		public $start_time;
		public $start_date;
		public $end_time;
		public $end_date;
		public $update_time;
		public $update_date;
		public $Effective_time;
		public $effective_date;
		public $exclude_device;
		public $carriers;
		public $daily_cap;
		public $creative_link;
		public $app_size;
		public $app_rate;
		public $appreviewnum;
		public $appinstalls;
		public $market;
		public function show_edit_offer()
		{
			$query_select_offer=mysql_query("Select * from `offers` where id='".$this->id."'") or die (mysql_error());
			if(mysql_num_rows($query_select_offer))
			{
				$array_select_offer=mysql_fetch_array($query_select_offer);
				$query_get_list_cc=mysql_query("select country_cc from offers_country where offer_id='".$array_select_offer['offerId']."'");
				$list_cc="";
				while($row=mysql_fetch_array($query_get_list_cc))
				{
					$queryCC = mysql_query("SELECT cc FROM countries WHERE cc='".$row['country_cc']."'") or die(mysql_error());
					if(mysql_num_rows($queryCC))
					{
						$cc = mysql_fetch_array($queryCC);
						$list_cc.=$cc['cc'].",,";
					}
				}
				$list_cc=preg_replace("/,,$/","",$list_cc);
				$array_info_offer=array('id'=>$array_select_offer['id'],'name'=>$array_select_offer['name'],'des'=>$array_select_offer['des'],'url'=>$array_select_offer['url'],'imageUrl'=>$array_select_offer['imageUrl'],'offerId'=>$array_select_offer['offerId'],'network'=>$array_select_offer['network'],'status'=>$array_select_offer['status'],'payout'=>$array_select_offer['payout'],'ratio'=>$array_select_offer['ratio'],'country'=>$list_cc,'end_tracking'=>$array_select_offer['end_tracking'],'show_index'=>$array_select_offer['show_index'],'producer'=>$array_select_offer['producer'],'min_os_version'=>$array_select_offer['min_os_version'],'app_size'=>$array_select_offer['app_size'],'update_date'=>$array_select_offer['update_date'],'view'=>$array_select_offer['view'],'category'=>$array_select_offer['category']);
				return $array_info_offer;
			}
		}
		
		public function delete_offer()
		{
			$query_select_offer=mysql_query("Select offerId from `offers` where id='".$this->id."'");
			if(mysql_num_rows($query_select_offer))
			{
				$array_select_offer=mysql_fetch_array($query_select_offer);
				mysql_query("Delete FROM offers_country where offer_id='".$array_select_offer['offerId']."'");
			}
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
		public function show_add_offer()
		{
			$queryNetwork = mysql_query("SELECT name FROM networks ORDER BY name") or die(mysql_error());
			if(!mysql_num_rows($queryNetwork))
			{
				exit("0");
			}
			?>
			<form action="" method="post">
			<table style="width:30%;margin:0px auto">
				<tr>
					<td>
						Offer ID *
					</td>
					<td>
						<input type="text" name="offerId" class="txt" value="" />
					</td>
				</tr>
				<tr>
					<td>
						Name *
					</td>
					<td>
						<input type="text" name="name" class="txt" value="" />
					</td>
				</tr>
				<tr>
					<td>
						Description
					</td>
					<td>
						<textarea rows="4" cols="50" name="des" ></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Payout *
					</td>
					<td>
						<input type="text" name="payout" class="txt" value="" />
					</td>
				</tr>
				<?php
				/*
				<tr>
					<td>
						Ratio *
					</td>
					<td>
						<input type="text" name="ratio" class="txt rate" id ="txtRate" value="" disabled />
					</td>
				</tr>
				<tr>
					<td>
						Global Rate?
					</td>
					<td>
						<input type="checkbox" name="globalRate" value="Yes" class="globalrate" onchange="document.getElementById('txtRate').disabled=this.checked;" checked="checked">
					</td>
				</tr>
				*/?>
				<input type="hidden" hidden="" name="ratio"  value="" />
				<input type="checkbox" name="globalRate" value="Yes" class="globalrate" hidden="" checked="checked">

				<tr>
					<td>
						Tracking URL *
					</td>
					<td>
						<input type="text" name="url" class="txt" value="" />
					</td>
				</tr>
				<tr>
					<td>
						Image URL
					</td>
					<td>
						<input type="text" name="image_url" class="txt" value="" />
					</td>
				</tr>
					<input type="hidden" name="show_index" class="txt" id ="" value="ON"  />
					<input type="hidden" name="hot" class="txt" id ="" value="ON"  />
					<input type="hidden" name="producer" class="txt" value="" />
					<input type="hidden" name="min_os_version" class="txt" value="" />
					<input type="hidden" name="app_size" class="txt" value="" />
					<input type="hidden" name="update_date" class="txt" value="" />
					<input type="hidden" name="view" class="txt" value="" />
					<input type="hidden" name="category" class="txt" value="" />
				<tr>
					<td>
					<label for="" class="label">Country list</label></td>
					<td>
					<select name="country_list" multiple="multiple" size="5" ondblclick="add_country(this.value,this.options[this.selectedIndex].text);">
					<?php
						$array_country=explode(",,",$array_offer['country']);
						$queryCountry = mysql_query("SELECT name, cc FROM countries ORDER BY name") or die(mysql_error());
						while($country = mysql_fetch_assoc($queryCountry)) 
						{
					?>
						<option value="<?php echo $country['cc'];?>"><?php echo $country['name'];?></option>
					<?php
						}
					?>
					</select>
					</td>
				</tr>
					<tr><td></td><td><center><img src="./img/down.png" style="width:50px;"/></center></td></tr>
					<tr>
					<td>
					<label for="" class="label">Country Selected</label></td>
					<td>
					<select name="country_selected" multiple="multiple" size="5" ondblclick="remove_country(this.value,this.options[this.selectedIndex].text);">
					</select>
					</td>
					</tr>
					<tr><td></td><td><input type="text" name="country" id="country" class="txt" value="" /></td></tr>
				<tr>
					<td>
						Network *
					</td>
					<td>
						<select name="network" class="" style="">
							<option value=""></option>
						<?php
							while($network = mysql_fetch_assoc($queryNetwork)) {
						?>	
							<option value="<?php echo $network['name'];?>"><?php echo $network['name'];?></option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						SUB TRACKING *
					</td>
					<td>
						<select name="end_tracking" >
						<?php
							echo sub_tracking();
						?>	
						</select>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'><center>
					<input type="submit" name="addOffer" value="ADD OFFER" class="btn btn-info"/>
					</center></td>
				</tr>
		</table>
		</form>
			<?php
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
		
		public function add_offer()
		{
		$ratio = Ratio;
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
								$addOffer = mysql_query("INSERT INTO `offers` (`id`,`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`,`country`, `network`, `status`,`OS`) VALUES('','$offerId','$name','$url','$payout','$ratio','$image_url', '$des','$cc', '$network', 'ON','android')") or die(mysql_error()); 				
								$final_report2.= 'Offer added successfully !';
							}
						}	
					}
				}
			}
		}
		}
		
		public function action_offer_mobvista()
		{
			$this->final_report2="";
			$query_check_action=mysql_query("Select id from offers where offerId='".$this->offerId."'");
			if(mysql_num_rows($query_check_action))
			{
				$this->final_report2="Offer already exist! Please try again!";
			}
			else
			if($this->offerId == NULL) {
				$this->final_report2.= "Please input Offer ID !";
			} else {
				if($this->name == NULL) {
					$this->final_report2.= "Please input Offer Name !";
				} else {
					if ($this->payout == NULL) {
						$this->final_report2.= "Please input Offer Payout !";
					} else {
						if($this->url == NULL) {	
							$this->final_report2.= "Please input Offer URL !";
						} else {
							if($this->cc == NULL) {
								$this->final_report2.= "Please input Offer Country !";
							} else {
								if($this->network == NULL) {
									$this->final_report2.= "Please input Offer Network !";
								} else {
									mysql_query("Delete FROM offers_country where offer_id='".$this->offerId."'");
									$array_country=explode(",",strtoupper($this->cc));
									foreach($array_country as $k=>$v)
									{
										if($v=="")
										{
											continue;
										}
										
										mysql_query("Insert into offers_country(`country_cc`,`offer_id`) value('$v',$this->offerId)");
									}
									mysql_query("INSERT INTO `offers` (`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`,`payout_net`, `network`, `status`,`OS`) VALUES('".$this->offerId."','".$this->name."','".$this->url."','".$this->payout."','".$this->ratio."','".$this->image_url."', '".$this->des."','".$this->payout_net."', '".$this->network."', 'ON','".$this->os."')") or die(mysql_error());
									
									$this->final_report2.= 'Offer action successfully !';
								}
							}
						}
					}
				}
			}
			return $this->final_report2;
		}
		
		public function action_offer_mobverify()
		{
			$this->final_report2="";
			$query_check_action=mysql_query("Select id from offers where offerId='".$this->offerId."'");
			if(mysql_num_rows($query_check_action))
			{
				$this->final_report2="Offer already exist! Please try again!";
			}
			else
			if($this->offerId == NULL) {
				$this->final_report2.= "Please input Offer ID !";
			} else {
				if($this->name == NULL) {
					$this->final_report2.= "Please input Offer Name !";
				} else {
					if ($this->payout == NULL) {
						$this->final_report2.= "Please input Offer Payout !";
					} else {
						if($this->url == NULL) {	
							$this->final_report2.= "Please input Offer URL !";
						} else {
							if($this->cc == NULL) {
								$this->final_report2.= "Please input Offer Country !";
							} else {
								if($this->network == NULL) {
									$this->final_report2.= "Please input Offer Network !";
								} else {
									mysql_query("Delete FROM offers_country where offer_id='".$this->offerId."'");
									$array_country=explode(", ",strtoupper($this->cc));
									foreach($array_country as $k=>$v)
									{
										if($v=="")
										{
											continue;
										}
										
										mysql_query("Insert into offers_country(`country_cc`,`offer_id`) value('$v',$this->offerId)");
									}
									$array_os=explode(",",$this->os);
									foreach($array_os as $k=>$v)
									{
										if($v=="iPad")
										{
											$v="table";
										}
										if($v=="iPhone")
										{
											$v="ios";
										}
										if($v=="Android")
										{
											$v="android";
										}
										mysql_query("INSERT INTO `offers` (`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`,`payout_net`, `network`, `status`,`OS`) VALUES('".$this->offerId."','".$this->name."','".$this->url."','".$this->payout."','".$this->ratio."','".$this->image_url."', '".$this->des."','".$this->payout_net."', '".$this->network."', 'ON','".$v."')") or die(mysql_error());
									}
									$this->final_report2.= 'Offer action successfully !';
								}
							}
						}
					}
				}
			}
			return $this->final_report2;
		}
		
		public function action_offer_avazu()
		{
			$this->final_report2="";
			$query_check_action=mysql_query("Select id from offers where offerId='".$this->offerId."'");
			if(mysql_num_rows($query_check_action))
			{
				$this->final_report2="Offer already exist! Please try again!";
			}
			else
			if($this->offerId == NULL) {
				$this->final_report2.= "Please input Offer ID !";
			} else {
				if($this->name == NULL) {
					$this->final_report2.= "Please input Offer Name !";
				} else {
					if ($this->payout == NULL) {
						$this->final_report2.= "Please input Offer Payout !";
					} else {
						if($this->url == NULL) {	
							$this->final_report2.= "Please input Offer URL !";
						} else {
							if($this->cc == NULL) {
								$this->final_report2.= "Please input Offer Country !";
							} else {
								if($this->network == NULL) {
									$this->final_report2.= "Please input Offer Network !";
								} else {
									mysql_query("Delete FROM offers_country where offer_id='".$this->offerId."'");
									$array_country=explode("|",strtoupper($this->cc));
									foreach($array_country as $k=>$v)
									{
										if($v=="")
										{
											continue;
										}
										
										mysql_query("Insert into offers_country(`country_cc`,`offer_id`) value('$v',$this->offerId)");
									}
									$array_os=explode("|",strtolower($this->os));
									foreach($array_os as $k=>$v)
									{
										mysql_query("INSERT INTO `offers` (`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`,`payout_net`, `network`, `status`,`OS`,`offer_name`,`app_category`,`app_rate`,`appreviewnum`,`appinstalls`,`app_size`,`min_os_version`,`market`) VALUES('".$this->offerId."','".$this->name."','".$this->url."','".$this->payout."','".$this->ratio."','".$this->image_url."', '".$this->des."','".$this->payout_net."', '".$this->network."', 'ON','".$v."', '".$this->offer_name."', '".$this->app_category."', '".$this->app_rate."', '".$this->appreviewnum."', '".$this->appinstalls."', '".$this->app_size."', '".$this->min_os_version."', '".$this->market."')") or die(mysql_error());
									}
									$this->final_report2.= 'Offer action successfully !';
								}
							}
						}
					}
				}
			}
			return $this->final_report2;
		}
		
		public function action_offer_bluetrackmedia()
		{
			$this->final_report2="";
			$query_check_action=mysql_query("Select id from offers where offerId='".$this->offerId."'");
			if(mysql_num_rows($query_check_action))
			{
				$this->final_report2="Offer already exist! Please try again!";
			}
			else
			if($this->offerId == NULL) {
				$this->final_report2.= "Please input Offer ID !";
			} else {
				if($this->name == NULL) {
					$this->final_report2.= "Please input Offer Name !";
				} else {
					if ($this->payout == NULL) {
						$this->final_report2.= "Please input Offer Payout !";
					} else {
						if($this->url == NULL) {	
							$this->final_report2.= "Please input Offer URL !";
						} else {
							if($this->cc == NULL) {
								$this->final_report2.= "Please input Offer Country !";
							} else {
								if($this->network == NULL) {
									$this->final_report2.= "Please input Offer Network !";
								} else {
									mysql_query("Delete FROM offers_country where offer_id='".$this->offerId."'");
									$array_country=explode(", ",strtoupper($this->cc));
									foreach($array_country as $k=>$v)
									{
										if($v=="")
										{
											continue;
										}
										
										mysql_query("Insert into offers_country(`country_cc`,`offer_id`) value('$v',$this->offerId)");
									}
									$array_os=explode("|",strtolower($this->os));
									foreach($array_os as $k=>$v)
									{
										if($v=="")
										{
											continue;
										}
										mysql_query("INSERT INTO `offers` (`offerId`,`name`, `url`, `payout`,`ratio`, `imageUrl`,`des`,`payout_net`, `network`,`status`,`OS`,`offer_name`) VALUES('".$this->offerId."','".$this->name."','".$this->url."','".$this->payout."','".$this->ratio."','".$this->image_url."', '".$this->des."','".$this->payout_net."', '".$this->network."', 'ON','".$v."', '".$this->offer_name."')") or die(mysql_error());
									}
									$this->final_report2.= 'Offer action successfully !';
								}
							}
						}
					}
				}
			}
			return $this->final_report2;
		}
		
	}
?>