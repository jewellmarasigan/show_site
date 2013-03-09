<?php
/* ESSENTIAL BLOCK START */

/*
	Login requirement is boolean true or false
	Permissions are:
		1 = Top level administrator
		2 = Average backend user
		3 = Average joe
*/

$loginReq = 0;
include("includes/head.php");

/* ESSENTIAL BLOCK END */


if($_POST['login_submit'])
{
	$email = mysql_real_escape_string($_POST['email']);
	$password = md5($_POST['password']);
	$error = '';
	
	$emailCheck = mysql_query("SELECT * FROM administrators WHERE admin_email = '$email'"); # Check if there is an email like the submitted one
	
	if(mysql_num_rows($emailCheck)!=0)
	{
		$passwordCheck = mysql_query("SELECT * FROM administrators WHERE admin_password = '$password'"); # Check if there is password that matches the email
		
		if(mysql_num_rows($passwordCheck)!=0)
		{
			$getid = mysql_query("SELECT * FROM administrators WHERE admin_email = '$email'"); # If the email and password match get the id, because id is so much more versatile
			
			while($row = mysql_fetch_assoc($getid))
			{
				$admin_id = $row['admin_id'];
				$admin_loginkey = unserialize($row['admin_loginkey']);
			}
			$loginkey = md5(substr(md5(uniqid()),rand(0,10),rand(11,28))); # Generate a very longwinded key hash
			
			setcookie("gdnmsite_id",$admin_id,time()+96000000,"/"); # Set the cookie for a really long time, because why not?
			setcookie("gdnmsite_key",$loginkey,time()+96000000,"/"); 
			
			$admin_loginkey[] = $loginkey; # Add the generated login key into the the administration keys for security
			$admin_loginkey = serialize($admin_loginkey);
			
			mysql_query("UPDATE administrators SET admin_loginkey = '$admin_loginkey' WHERE admin_id = $admin_id");
			
			header("location:index");
		}
		else
		{
			$error = "Your password does not match this email";
		}
	}
	else
	{
		$error = "Your email isn't recognised";
	}
}

?>
<body>

<?php
if($error)
{
	?>
    <div id="message">
    <?php echo $error;?>
    </div>
    <?php
}
?>

<form action="" method="post">
	<label for="email_input">Email</label><br>
    <input type="text" name="email" id="email_input"/><br>
	<label for="password_input">Password</label><br>
    <input type="password" name="password" id="password_input"/><br>
    <input type="submit" value="Log in" name="login_submit"/>
</form>

</body>
</html>