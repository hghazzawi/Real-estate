<?php 
$title="Register";
include("templates/header.php");

if ( $_SERVER["REQUEST_METHOD"] == "GET")
{
	$province=DEFAULT_PROVINCE;
	$contact_method=CONTACT_BY_EMAIL;
	$city="";
	
	$user_type=CLIENT;
	
	$first_name="";
	$last_name="";
	$user_id="";
	$password="";
	$confirm_pass="";
	$email="";
	$street1="";
	$street2="";
	$phone1="";
	$phone2="";
	$postal="";
	$fax="";
	
	$error_message="";
	$error_title="";
	
	
	
	
}
else if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$salutation=$_POST['salutations'];
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$user_id=$_POST['user_id'];
	$password=$_POST['password'];
	$confirm_pass=$_POST['confirm_pass'];
	$email=$_POST['email'];
	$street1=$_POST['street1'];
	$street2=$_POST['street2'];
	$phone1=$_POST['phone1'];
	$phone2=$_POST['phone2'];
	$postal=$_POST['postal'];
	$fax=$_POST['fax'];
	$user_type=$_POST['user_type'];
	
	$province=$_POST['provinces'];
	$contact_method=$_POST['preferred_contact_method'];
	$city=$_POST['cities'];
	
	$error_message="";
	
	
	
	
	if (empty($user_id))
	{
		$error_message="User Name cannot be empty<br/>";
	}
	else if (!validate_length($user_id,MINIMUM_ID_LENGTH,MAXIMUM_ID_LENGTH))
	{
		$error_message.="user name must be between ".MINIMUM_ID_LENGTH." and ".MAXIMUM_ID_LENGTH." characters<br/>";
		$user_id="";
	}
	else if (is_user_id($user_id))
	{
		$error_message.="User ".$user_id." already exists<br/>";
		$user_id="";
	}
	
	if (empty($password))
	{
		$error_message.="You must enter a password<br/>";
		
	}
	else if (!validate_length($password,MINIMUM_PASSWORD_LENGTH,MAXIMUM_PASSWORD_LENGTH))
	{
		$error_message.="Password must be between ".MINIMUM_PASSWORD_LENGTH." and ".MAXIMUM_PASSWORD_LENGTH." characters<br/>";
		$password="";
	}
	
	if (empty($confirm_pass))
	{
		$error_message.="You must confirm your password<br/>";
		$confirm_pass="";
	}
	else if (strcmp($password,$confirm_pass)!=0)
	{
		$error_message.="The passwords dont match<br/>";
	}
	
	if (empty($email))
	{
		$error_message.="You must enter an email<br/>";
		$email="";
	}
	else if (!validate_length($email,MINIMUM_EMAIL_LENGTH,MAXIMUM_EMAIL_LENGTH)) 
	{
		
		$error_message.="Must be between ".MINIMUM_EMAIL_LENGTH." and ".MAXIMUM_EMAIL_LENGTH." characters<br/>";
		$email="";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		$error_message.="Not a valid email address<br/>";
		$email="";
	}
	
	if (empty($first_name))
	{
		$error_message.="You must enter a first name<br/>";
		
	}
	else if (!validate_length($first_name,MIN_FIRST_NAME_LENGTH,MAX_FIRST_NAME_LENGTH)) 
	{
		
		$error_message.="Must be between ".MIN_FIRST_NAME_LENGTH." and ".MAX_FIRST_NAME_LENGTH." characters<br/>";
		$first_name="";
	}
	
	if (empty($last_name))
	{
		$error_message.="Last Name cannot be empty<br/>";
	}
	else if (!validate_length($last_name,MIN_LAST_NAME_LENGTH,MAX_LAST_NAME_LENGTH)) 
	{
		$error_message.="Must be between ".MIN_LAST_NAME_LENGTH." and ".MAX_LAST_NAME_LENGTH." characters<br/>";
		$last_name="";
	}
	
	if (empty($phone1))
	{
		$error_message.="You must enter a phone number<br/>";
	}
	else if (!isPhone($phone1,true))
	{
		$error_message.="Not a valid phone number<br/>";
		$phone1="";
	}
	
	if (isset($postal))
	{
		if (!is_valid_postal_code($postal))
		{	
			$error_message.="Not Valid Postal code<br/>";
			$postal="";
		}
	}
	
	if (empty($phone2))
	{
	}
	else 
	{
		if (!isPhone($phone2))
		{
			$error_message.="Not a valid secondary phone number<br/>";
			$phone2="";
		}	
	}
	
	
	if (empty($fax))
	{
	}
	else 
	{
		if (!isPhone($fax))
		{
			$error_message.="Not a valid Fax number<br/>";
			$fax="";
		}	
	}
		
	
	
	if (isset($error_message))
	{
		$error_title="<br/>Error Log<hr/>";
	}
	
	
	if ($error_message=="")
	{
		$conn=db_connect();
		$today=date('Y-m-d',time());
		$error_title="";
		$insert_user=pg_prepare($conn,"insert_user","insert into users values($1,$2,$3,$4,$5,$6)");
		$insert_people=pg_prepare($conn,"insert_people","insert into people values($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13)");
		
		//$password=md5($password);
		
		pg_execute($conn,"insert_user",array($user_id,$password,$user_type,$email,$today,$today));
		pg_execute($conn,"insert_people",array($user_id,$salutation,$first_name,$last_name,$street1,$street2,$city,$province,$postal,$phone1,$phone2,$fax,$contact_method));
		
		$_SESSION['message']="You Have Been Successfully Registered Please Wait For Confirmation";
		
		header("location:login.php");
	}
	
	
	
	
	//dump($_POST);
	
	

	
	
	
	
	
	
}






?>
<table>
	<tr>
		<td>
			<div style="width:60%" id="login">
		
		<h2><span class="fontawesome-lock"></span>Registration Form</h2>

		<form action="" method="post">

			<fieldset>

			<table cellpadding="0" cellspacing="0">
			
				<tr><td colspan="2" ><p style="font-size:18pt">Login Information<br/><br/></p></td></tr>
				<tr>
					<td>
						<p><label for="user_name">User Name*</label></p>
						<p><input  type="text" name="user_id" id="user_name" value="<?php echo $user_id ?>"/></p> 
					</td>
					
					<td>
						<p><label for="password">Password*</label></p>
						<p><input  type="password" name="password" id="password" value="<?php echo $password ?>" /></p> 
					</td>
				</tr>
				
				<tr>
				
					<td>
						<p><label for="email">Email Address*</label></p>
						<p><input  type="text" name="email" id="email" value="<?php echo $email ?>" /></p> 
					</td>
				
					<td>
						<p><label for="password2">Confirm Password*</label></p>
						<p><input  type="password" name="confirm_pass" id="password2" value="<?php echo $confirm_pass ?>" /></p>
						
					</td>	
				</tr>
				
				<tr>
					<td colspan="2" style="text-align:center">
						<p>Register As</p>
						<?php echo build_radio("user_type","type", $user_type); ?>
					</td>
				</tr>
				
				
				<tr>
					<td colspan="2"><br/><hr/></td>
				</tr>
				
				<tr><td><p style="font-size:18pt">Billing Information<br/><br/></p></td></tr>
				
				<tr>
					<td>
					<table>
						<tr>
						<td>
							<p>Salutation<br/></p>
							<?php echo build_simple_dropdown("salutations","salutation"); ?>
						</td>
							
						
						<td>
							<p><label for="first_name">First Name*</label></p>
							<p><input  style="width:235px;" name="first_name" type="text" id="first_name" value="<?php echo $first_name?>" /></p>
						</td>
						</tr>
					</table>
					</td>
					<td>	
						<table>
						<tr>
						<td>
						<p><label for="last_name">Last Name*</label></p>
						<p><input style="" type="text" id="last_name" name="last_name" value="<?php echo $last_name ?>" /></p> 
						</td>
						</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><label for="street1">Street Address 1</label></p>
						<p><input type="text" id="street1" name="street1" value="<?php echo $street1 ?>" /></p> 
					</td>
					<td>
						<p><label for="street2">Street Address 2</label></p>
						<p><input type="text" id="street2" name="street2" value="<?php echo $street2?>" /></p> 
					</td>
				</tr>
				
				<tr>
					<td>
						<table>
							<tr>
							<td>
							<p>City<br/></p>
							<p><input type="text" id="cities" name="cities" value="<?php echo $city ?>" /></p>  
							 
							</td>
							
							<td>
								<p>Province<br/></p>
								<?php echo build_simple_dropdown("provinces","province",$province); ?>
								
							</td>
							</tr>
						</table>
						
					</td>
					
					<td>
						<p><label for="postal">Postal Code*</label></p>
						<p><input type="text" id="postal" name="postal" value="<?php echo $postal ?>" /></p> 
					</td>
					
				</tr>
				
				<tr>
					
					<td>
						<p><label for="phone1">Primary Phone Number*</label></p>
						<p><input type="text" id="phone1" name="phone1" value="<?php echo $phone1 ?>" /></p> 
					</td>
					<td>
						<p><label for="phone2">Secondary Phone Number</label></p>
						<p><input type="text" id="phone2" name="phone2" value="<?php echo $phone2 ?>" /></p> 
					</td>
					
				</tr>
				
				<tr>
					
					<td>
						<p><label for="fax">Fax Number</label></p>
						<p><input type="text" id="fax" name="fax" value="<?php echo $fax ?>" /></p> 
					</td>
					
					<td>
						<p>Preferred Contact Method*<br/></p>
						<table>
						<tr>
						<td>
						<?php echo build_radio("preferred_contact_method","contact", $contact_method); ?>
						
						</td>
						</tr>
						</table>
					</td>
				</tr>
				
				<tr>
				
				<td>
					<p style="float:right"><br/><input type="submit" value="Register" /></p>
				</td>
				<td>
					<p style="float:left"><br/><input type="reset" value="Clear" /></p>					
				</td>
				</tr>		
			</table>
					
			</fieldset>

		</form>
		

		</div> <!-- end login -->
		</td>
		<td>
			
			<p style="text-align:center;font-size:18pt;"><br/><br/><br/><?php echo $error_title ?></p>
			<p style="text-align:center;"><?php echo $error_message ?></p>
		</td>
	</tr>
</table>




<?php include("templates/footer.php") ?>