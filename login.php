<?php 
$title="Login";
include("templates/header.php"); 


if ($_SERVER["REQUEST_METHOD"] == "GET")
{

	
	
	if(isset($_COOKIE['user_name'])) 
	{	
		$user_name=$_COOKIE['user_name'];	
	}
	else 
	{
		$user_name="";
	}
	
	$password="";
	$user_error="";
	$password_error="";
	$error="";
	$error_style="";
	$error_css="";
	
}
else if ( $_SERVER["REQUEST_METHOD"] == "POST")
{
	$user_name=trim($_POST['user_name']);
	$password=trim($_POST['password']);
	$user_error="";
	$password_error="";
	$error="";
	$error_style="";
	$error_css="";
	
	if (empty($user_name))
	{
		$error_style="border-color:red";
		$user_error=" Error : You Must Enter A User Name";
		$error_css="color:red";
		$error=1;
	}
	if (empty($password))
	{
		$error_style="border-color:red";
		$password_error=" Error : You Must Enter A Password";
		$error_css="color:red";
		$error=1;
	}
	
	
	
	
	
	if ($error!=1)
	{
		$dbconn = db_connect();
		
		
		
		
		$q = pg_prepare($dbconn, "user_retrieve", 'SELECT * FROM users, people
				  WHERE users.user_id = $1 AND users.password = $2 AND users.user_id = people.user_id');
		$result = pg_execute($dbconn, "user_retrieve", array("$user_name", "$password"));
		
		if (pg_num_rows($result)!=1)
		{
			if(!is_user_id($user_name))
			{
				$user_error="Or Password is Incorrect";
				$error_css="color:red";
				$user_name="";
				$password="";
			}
			else 
			{
				$password_error="Is Incorrect";
				$passowrd="";
			}
			
		}
		else
		{
				$user = pg_fetch_assoc($result, 0);
				
				unset($user['password']);
				$cookie_name = "user";
				$cookie_value = $user_name;
				$date=date("Y-m-d");
				$update = pg_prepare($dbconn,"user_update_last_access","UPDATE users SET last_access = $1  WHERE user_id = $2");
				pg_execute($dbconn,"user_update_last_access",array("$date","$user_name"));
				setcookie("user_name", $user_name , time() + COOKIE_DURATION );
				$_SESSION['user'] = $user;
				
				if($user['user_type'] == AGENT)
				{
					header("Location: dashboard.php?page=1");
					$_SESSION['message']="Welcome ". $_SESSION['user']['user_id']." You last visited us on ". $_SESSION['user']['last_access'];
					ob_flush();
				}
				else if($user['user_type'] == PENDING_AGENT)
				{
					header("Location: login.php");
					$_SESSION['message']="This account is pending for approval please wait for further notice";
					ob_flush();
				}
				else if($user['user_type'] == SUPER)
				{
					header("Location: admin.php?page=1");
					$_SESSION['message']="Welcome ". $_SESSION['user']['user_id']." You last visited us on ". $_SESSION['user']['last_access'];
					ob_flush();
				}
				else if($user['user_type'] == CLIENT)
				{
					header("Location: welcome.php?page=1");
					$_SESSION['message']="Welcome ". $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']." You last visited us on ". $_SESSION['user']['last_access'];
					ob_flush();
				}
				else if($user['user_type'] == DISABLED)
				{
					header("Location: aup.php");
					$_SESSION['message']="You no longer have access to this account";;
					ob_flush();
				}
				
						
				
				
			
		}
		
	}
	

	
	
}




  

?>

<div id="login">
		<?php echo $message ?>
		<h2><span class="fontawesome-lock"></span>Sign In</h2>

		<form action="" method="post">

			<fieldset>

				<p style="<?php echo $error_css ?>"><label for="user_name">User Name </label><?php echo $user_error ?></p>
				<p><input style="<?php echo $error_style ?>" type="text" id="user_name" name="user_name"  value="<?php echo $user_name ?>"/></p> 
				
				<p><label style="<?php echo $error_css ?>" for="password">Password <?php echo $password_error ?></label></p>
				<p><input style="<?php echo $error_style ?>" type="password" name="password" id="password" value=""  /></p> 
					
				<p><input type="submit" value="Sign In" /></p>
				<p style="text-align:center"><a href="register.php" >Sign Up</a>
				|
				<a href="password-request.php">Forgot Password</a></p>
			</fieldset>

		</form>
</div> <!-- end login -->


<?php include("templates/footer.php"); ?>