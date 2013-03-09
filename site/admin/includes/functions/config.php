<?php
$config_server = "localhost";
$config_username = "makeout1_gdnm";
$config_password = "test001";
$config_database = "makeout1_gdnmsite";

$connect = mysql_connect($config_server,$config_username,$config_password) or die(mysql_error());
mysql_select_db($config_database) or die(mysql_error());
?>