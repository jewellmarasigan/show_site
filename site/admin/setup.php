<?php

include("includes/functions/config.php");

mysql_query("CREATE TABLE IF NOT EXISTS `administrators` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` text NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_permissions` int(11) NOT NULL,
  `admin_loginkey` text NOT NULL,
  PRIMARY KEY (`admin_id`)
)");

?>