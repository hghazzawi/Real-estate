<?php 
$title="Login";
include("templates/header.php"); 




?>

<div id="login">

		<h2><span class="fontawesome-lock"></span>Sign In</h2>

		<form action="javascript:void(0);" method="post">

			<fieldset>

				<p><label for="user_name">User Name</label></p>
				<p><input type="text" id="user_name" name="user_name"  value=""/></p> 
				
				<p><label for="password">Password</label></p>
				<p><input type="password" id="password" value=""  /></p> 
					
				<p><input type="submit" value="Sign In" /></p>
				<p style="text-align:center"><a href="register.php" >Sign Up</a>
				|
				<a href="#">Forgot Password</a></p>
			</fieldset>

		</form>
</div> <!-- end login -->


<?php include("templates/footer.php"); ?>