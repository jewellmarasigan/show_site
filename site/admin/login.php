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

/*
	EXTRA BLOCK
	Dont want to allow users to see this page if theyre logged in so here here here here here it goes
*/

include("includes/functions/config.php");

$godid = $_COOKIE['gdnmsite_id'];
$godkey = $_COOKIE['gdnmsite_key'];
$success = 0;

if($godid)
{
	$checkLogin = mysql_query("SELECT * FROM administrators WHERE admin_id = $godid");
	
	while($row = mysql_fetch_assoc($checkLogin))
	{
		$admin_loginkey = unserialize($row['admin_loginkey']);
		$admin_permissions = $row['admin_permissions'];
	}
	if(in_array($godkey,$admin_loginkey))
	{
		header("location:../admin");
	}
}

/*
	EXTRA BLOCK END
*/

include("includes/head.php");

/* ESSENTIAL BLOCK END */


if($_POST['login_submit'])
{
	$email = mysql_real_escape_string($_POST['email']);
	$password = md5($_POST['password']);
	$error = '';
	$errorCode = 0; # This variable will determine whether or not to put wrong class on which input
	
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
			$errorCode = 2;
		}
	}
	else
	{
		$error = "Your email isn't recognised";
		$errorCode = 1;
	}
}

?>
<body>



<div class="container">
    <?php
	if($error)
	{
		?>
		<div class="message error">
		<?php echo $error;?>
		</div>
		<?php
	}
	?>
    
    <div class="modal" id="login">    
        <form action="" method="post">
            <input type="text" name="email" placeholder="Email" <?php if($errorCode==1){ echo 'class="wrong"';}?>>
            <input type="password" name="password" placeholder="Password" <?php if($errorCode==2){ echo 'class="wrong"';}?>>
            <input type="submit" name="login_submit" value="Log in" class="button confirm">
        </form>
        <!--
        <p> Don't have an account? <a href="#">Sign up</a> </p>
        <p> <a href="#">Forgot password?</a> </p>
        -->
    </div>
</div>

</body>
</html>