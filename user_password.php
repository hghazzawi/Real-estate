<?php
	$title="Change Password";
	include("templates/header.php");

	if (!isset($_SESSION['user']))
	{
		$_SESSION['message']="Please login to access this page";
		header("Location:login.php");
		ob_flush();
	}
	
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$old_pass="";
		$new_pass="";
		$confirm_new="";
		$error="";
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$user_name= $_SESSION['user']['user_id'];
		$old_pass=$_POST['old'];
		$new_pass=$_POST['password'];
		$confirm_new=$_POST['confirm_password'];
		$error="";
		$error_code=0;
		
		if (empty($old_pass))
		{
			$error="You must enter your old password<br/>";
			$error_code=1;
		}
		if (empty($new_pass))
		{
			$error.="You must enter your old password<br/>";
			$error_code=1;
		}
		
		if (empty($confirm_new))
		{
			$error.="You must confirm your new password<br/>";
			$error_code=1;
		}
		else if (!validate_length($new_pass,MINIMUM_PASSWORD_LENGTH,MAXIMUM_PASSWORD_LENGTH))
		{
			$error.="Password must be between ".MINIMUM_PASSWORD_LENGTH." and ".MAXIMUM_PASSWORD_LENGTH." characters<br/>";
			$error_code=1;
			
		}
			
		$dbconn = db_connect();
			
		$q = pg_prepare($dbconn, "user_retrieve", 'SELECT * FROM users, people
					  WHERE users.user_id = $1 AND users.password = $2 AND users.user_id = people.user_id');
		$result = pg_execute($dbconn, "user_retrieve", array("$user_name", "$old_pass"));
			
		if (pg_num_rows($result)!=1)
		{
			$error.="The password you entered does not match our records<br/>";
			$error_code=1;
		}
		else if (strcmp($new_pass,$confirm_new)!=0)
		{
			$error.="The passwords dont match<br/>";
			$error_code=1;
		}
		
		if ($error_code!=1)
		{
			$q=pg_prepare($dbconn,"password_update","UPDATE users SET password = $1  WHERE user_id = $2");
			$result=pg_execute($dbconn,"password_update",array("$new_pass","$user_name"));
			
				if($_SESSION['user']['user_type'] == AGENT)
				{
					header("Location: dashboard.php");
					$_SESSION['message']="Password Successfully Updated";
					ob_flush();
				}
				
				else if($_SESSION['user']['user_type'] == SUPER)
				{
					header("Location: admin.php");
					$_SESSION['message']="Password Successfully Updated";
					ob_flush();
				}
				else if($_SESSION['user']['user_type'] == CLIENT)
				{
					header("Location: welcome.php");
					$_SESSION['message']="Password Successfully Updated";
					ob_flush();
				}
				
		}
			
		
		
		
			
	}
		
	
?>

<div id="login">
		<?php echo $error ?>
		<?php echo $message ?>
		<h2><span class="fontawesome-lock"></span>Change Your Password</h2>

		<form action="" method="post">

			<fieldset>
				<p>User Name : <?php echo $_SESSION['user']['user_id'] ?> </p>
				<p style=""><label for="old">Old Password</label></p>
				<p><input style="" type="password" id="old" name="old"  value=""/></p> 
				
				<p><label style="" for="password">New Password</label></p>
				<p><input style="" type="password" name="password" id="password" value=""  /></p> 
				
				<p><label style="" for="confirm_password">Confirm New Password</label></p>
				<p><input style="" type="password" name="confirm_password" id="confirm_password" value=""  /></p> 
					
				<p><input type="submit" value="Change" /></p>
				
			</fieldset>
		
		</form>
</div> <!-- end login -->




<?php include("templates/footer.php"); ?>