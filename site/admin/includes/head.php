<?php
include("includes/functions/config.php"); # Database connection
if($loginReq==1)
{
	include("includes/functions/logincheck.php"); # Checking whether the user is logged in
}
include("includes/functions/admin_values.php"); # Getting the relevant information about the user
include("includes/functions/meta.php"); # Standard html head
?>