<?php
	$title="Forgot Password";
	include("templates/header.php");

	if (isset($_SESSION['user']))
	{
		if ($_SESSION['user']['user_type']==AGENT)
		{
			$_SESSION['message']="You are already logged in..Use change password";
			header("location:dashboard.php?page=1");
			ob_flush();
		}
		else if ($_SESSION['user']['user_type']==CLIENT)
		{
			$_SESSION['message']="You are already logged in..Use change password";
			header("location:welcome.php");
			ob_flush();
		}
		else if ($_SESSION['user']['user_type']==ADMIN)
		{
			$_SESSION['message']="You are already logged in..Use change password";
			header("location:admin.php");
			ob_flush();
		}
		
	}
	
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$user_id="";
		$email="";
		$error="";
		
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$user_id=$_POST['user_id'];
		$email=$_POST['email'];
		$error="";
		$error_code=0;
		
		if (empty($user_id))
		{
			$error="You must enter your user name<br/>";
			$error_code=1;
		}
		if (empty($email))
		{
			$error.="You must enter your email address<br/>";
			$error_code=1;
		}
		
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$error_message.="Not a valid email address<br/>";
			$email="";
		}
			
				
		$dbconn = db_connect();
			
		$q = pg_prepare($dbconn, "user_retrieve", 'SELECT * FROM users
					  WHERE users.user_id = $1 AND users.email_address = $2 ');
		$result = pg_execute($dbconn, "user_retrieve", array("$user_id", "$email"));
			
		if (pg_num_rows($result)!=1)
		{
			$error.="The information you entered does not match our records<br/>";
			$error_code=1;
		}
		
		
		if ($error_code!=1)
		{
			$random_pass=substr(hash('sha256', mt_rand()), 0, 8);
			
			$q=pg_prepare($dbconn,"password_update","UPDATE users SET password = $1  WHERE user_id = $2");
			$result=pg_execute($dbconn,"password_update",array("$random_pass","$user_id"));
			
			
			$sql="select*from people where user_id='$user_id'";	
			$result=pg_query($dbconn,$sql);
			$result_set=pg_fetch_assoc($result);
			
			$to      = $email;
			$subject = "Password Reset";
			$message = "Hello ".$result_set['first_name']." ".$result_set['last_name'];
			$message.= " You have requested your password from our site.Please use this temporary password to login to your account";
			$message.= "\nTemp Password : $random_pass ";
			$headers = 'From: webmaster@example.com' . "\r\n" .
				'Reply-To: webmaster@example.com' . "\r\n" ;
			echo $message;
			mail($to, $subject, $message, $headers);
			
			
			
			 // header("Location: login.php");
			 // $_SESSION['message']="Use the emailed  password to login";
		     // ob_flush();	
				
		}
			
		
		
		
			
	}
		
	
?>

<div id="login">
		<?php echo $error ?>
		<h2><span class="fontawesome-lock"></span>Forgot Password</h2>

		<form action="" method="post">

			<fieldset>
				
				<p style=""><label for="user_id">User Name</label></p>
				<p><input style="" type="text" id="user_id" name="user_id"  value=""/></p> 
				
				<p><label style="" for="email">Email</label></p>
				<p><input style="" type="text" name="email" id="email" value=""  /></p> 
					
				<p><input type="submit" value="Request" /></p>
				
			</fieldset>
		
		</form>
</div> <!-- end login -->




<?php include("templates/footer.php"); ?>