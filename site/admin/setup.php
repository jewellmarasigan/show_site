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

mysql_query("CREATE TABLE IF NOT EXISTS `courseInfo` (
  `version_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_user` int(11) NOT NULL,
  `version_date` datetime NOT NULL,
  `version_clean_content` text NOT NULL,
  `version_content` text NOT NULL,
  PRIMARY KEY (`version_id`)
)");

$getuser = mysql_query("SELECT * FROM administrators");

if(mysql_num_rows($getuser)==0)
{

	mysql_query("INSERT INTO administrators VALUES('','Test','test@test.com','fa820cc1ad39a4e99283e9fa555035ec','1','a:0:{}')");
	
	echo "Default user = test@test.com<br>Default password = test001";
	
}

?>