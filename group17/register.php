<?php 
$title="Register";
include("templates/header.php") 
?>

<div id="login">

		<h2><span class="fontawesome-lock"></span>Sign Up</h2>

		<form action="" method="post">

			<fieldset>

				<p><label for="user_name">User Name</label></p>
				<p><input type="text" id="user_name" value=""/></p> 
				
				<p><label for="password">Password</label></p>
				<p><input type="password" id="password" value="" /></p> 
				
				<p><label for="password2">Confirm Password</label></p>
				<p><input type="password" id="password2" value="" /></p>

				<p><label for="first_name">First Name</label></p>
				<p><input type="text" id="first_name" value="" /></p> 
				
				<p><label for="last_name">Last Name</label></p>
				<p><input type="text" id="last_name" value="" /></p> 
				
				<p><label for="email">Email Address</label></p>
				<p><input type="text" id="email" value="" /></p> 
				
				

				<p><input type="submit" value="Register" /></p>
				
			</fieldset>

		</form>
</div> <!-- end login -->


<?php include("templates/footer.php") ?>