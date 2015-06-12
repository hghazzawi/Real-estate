
<!--

	/*if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_COOKIE['admin_name'])) 
		{	
			$admin_name=$_COOKIE['admin_name'];	
		}
		else 
		{
			$admin_name="";
		}
		
		$password="";
		$error_message="";
		
		$error="";
	
	}
	else if ( $_SERVER["REQUEST_METHOD"] == "POST")
	{
		$admin_name=trim($_POST['admin_name']);
		$password=trim($_POST['password']);
		$error="";
		$error_message="";
	
	
		if (empty($admin_name))
		{
			
			$error=1;
			$error_message.="You must enter a username<br/>";
		}
		if (empty($password))
		{
			$error=1;
			$error_message.="You Must enter a password<br/>";
		}
	
	
	
	
	
	if ($error!=1)
	{
		$dbconn = db_connect();
		
		$q = pg_prepare($dbconn, "user_retrieve", 'SELECT * FROM users, people
				  WHERE users.user_id = $1 AND users.password = $2 AND users.user_id = people.user_id');
		$result = pg_execute($dbconn, "user_retrieve", array("$admin_name", "$password"));
		
		if (pg_num_rows($result)!=1)
		{
			if(!is_user_id($admin_name))
			{
				$admin_name="";
				$password="";
				$error_message.="You were not fount in our records<br/>";
			}
			else 
			{
				$error_message.="Password is wrong<br/>";
				$passowrd="";
			}
			
		}
		else
		{
				$user = pg_fetch_assoc($result, 0);
				
				unset($user['password']);
				$cookie_name = "user";
				$cookie_value = $admin_name;
				$date=date("Y-m-d");
				$update = pg_prepare($dbconn,"user_update_last_access","UPDATE users SET last_access = $1  WHERE user_id = $2");
				pg_execute($dbconn,"user_update_last_access",array("$date","$admin_name"));
				setcookie("admin_name", $admin_name , time() + COOKIE_DURATION );
				$_SESSION['user'] = $user;
				
				if($user['user_type'] == SUPER)
				{
					header("Location: admin.php");
					$_SESSION['message']="Welcome ". $_SESSION['user']['user_id']." You last visited us on ". $_SESSION['user']['last_access'];
					ob_flush();
				}
				else 
				{
					header("Location: login.php");
					$_SESSION['message']="You are not authorized to access this page";
					ob_flush();
				}
		}
	}
}
?>*/ -->

<div class="wrapper col6">
  <div id="footer">
    
    <div class="footbox">
      <h2>About Us</h2>
      <ul>
        <li><a href="#">Our Team</a></li>
        <li><a href="aup.php">Terms Of Use</a></li>
        <li class="last"><a href="privacy-policy.php">Privacy</a></li>
      </ul>
    </div>
    
    <br class="clear" />
  </div>
</div>
<div class="wrapper col7">
  <div id="copyright">
    <p class="fl_left"><?php display_copyright() ?></p>
	<p style="float:right"><a href="http://jigsaw.w3.org/css-validator/check/referer">
			        	<img 	style="width:88px;
									height:31px;"
        			    		src="http://jigsaw.w3.org/css-validator/images/vcss"
								alt="Valid CSS!" />
    </a></p>
    <p class="fl_right">
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
	</p>
	
    <br class="clear" />
  </div>
</div>
</body>
</html>
