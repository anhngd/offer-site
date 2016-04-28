<?php
include("./managerOffer/function/config.php");
mysql_query("ALTER TABLE  `admin` ADD  `rateBonus` INT( 20 ) NOT NULL ,
ADD  `notify_lead` VARCHAR( 100 )  NOT NULL DEFAULT  'only' ;");
mysql_query("ALTER TABLE  `clicks` CHANGE  `date`  `date` DATETIME NOT NULL ;");
mysql_query("ALTER TABLE  `members` ADD  `ref` VARCHAR( 254 ) NOT NULL ,
ADD  `points_bonus` VARCHAR( 200 ) NOT NULL DEFAULT  '0',
ADD  `bank` TEXT NOT NULL ;");
mysql_query("ALTER TABLE  `networks` ADD  `payment` VARCHAR( 20 ) NOT NULL DEFAULT  'week';");
mysql_query("ALTER TABLE  `leads` ADD  `trackingID` VARCHAR( 32 ) NOT NULL;");
mysql_query("ALTER TABLE  `offers` ADD  `view` INT( 254 ) NOT NULL DEFAULT  '0',
ADD  `hot` VARCHAR( 10 ) NOT NULL ,
ADD  `producer` VARCHAR( 254 ) NOT NULL ,
ADD  `category` VARCHAR( 254 ) NOT NULL ;");
mysql_query("ALTER TABLE  `shoutbox` ADD  `status` VARCHAR( 100 ) NOT NULL DEFAULT  'NONE';");
mysql_query("CREATE TABLE IF NOT EXISTS `listcategory` (
  `id` int(11) NOT NULL,
  `category_name` varchar(254) NOT NULL,
  `isGame` varchar(10) NOT NULL,
  `os` varchar(100) NOT NULL,
  `link_icon` varchar(200) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
mysql_query("CREATE TABLE IF NOT EXISTS `static_invoice` (
  `id` int(11) NOT NULL,
  `userName` varchar(240) NOT NULL,
  `offerId` int(100) NOT NULL,
  `num_click` int(100) NOT NULL,
  `payout` float NOT NULL,
  `network` varchar(100) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
mysql_query("CREATE TABLE IF NOT EXISTS `static_month` (
  `id` int(40) NOT NULL,
  `userName` varchar(250) NOT NULL,
  `offerID` varchar(250) NOT NULL,
  `network` varchar(250) NOT NULL,
  `pay_out` double NOT NULL,
  `num_click` int(250) NOT NULL,
  `num_lead` int(250) NOT NULL,
  `type_time` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50580 DEFAULT CHARSET=latin1;");
mysql_query("CREATE TABLE IF NOT EXISTS `invoice` (
  `userName` varchar(254) NOT NULL,
  `week` int(55) DEFAULT NULL,
  `clicks` int(254) NOT NULL,
  `leads` int(254) NOT NULL,
  `amount_w` float NOT NULL,
  `cvr` float NOT NULL,
  `rpc` float NOT NULL,
  `rpa` float NOT NULL,
  `status` varchar(254) NOT NULL,
  `id` int(11) NOT NULL,
  `network` varchar(200) NOT NULL,
  `month` int(30) DEFAULT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `points` float NOT NULL,
  `date_create` datetime NOT NULL,
  `offerName` varchar(220) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1323 DEFAULT CHARSET=latin1;");

?>