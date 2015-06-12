<?php 
$title="Update";
include("templates/header.php");


if (!isset($_SESSION['user']))
{
	$_SESSION['message']="Please login to access this page";
	header("Location:login.php");
	ob_flush();
}



if ( $_SERVER["REQUEST_METHOD"] == "GET")
{
	$province=$_SESSION['user']['province'];
	$contact_method=$_SESSION['user']['preffered_contact_method'];
	$city=$_SESSION['user']['city'];
	
	
	
	$first_name=$_SESSION['user']['first_name'];
	$last_name=$_SESSION['user']['last_name'];
	$email=$_SESSION['user']['email_address'];
	$street1=$_SESSION['user']['street_address_1'];
	$street2=$_SESSION['user']['street_address_2'];
	$phone1=$_SESSION['user']['primary_phone_number'];
	$phone2=$_SESSION['user']['secondary_phone_number'];
	$postal=$_SESSION['user']['postal_code'];
	$fax=$_SESSION['user']['fax_number'];
	
	$error_message="";
	$error_title="";
	
	
	
	
}
else if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$salutation=$_POST['salutations'];
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	
	
	$email=$_POST['email'];
	$street1=$_POST['street1'];
	$street2=$_POST['street2'];
	$phone1=$_POST['phone1'];
	$phone2=$_POST['phone2'];
	$postal=$_POST['postal'];
	$fax=$_POST['fax'];
	
	
	$province=$_POST['provinces'];
	$contact_method=$_POST['preferred_contact_method'];
	$city=$_POST['cities'];
	
	$error_message="";
	
	
	
	
	
	
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
		
		
		$q=pg_prepare($conn,"user_update","update users set email_address=$1 where user_id=$2");
		
		
		$ppl=pg_prepare($conn,"people","update people  set  salutation=$1, first_name=$2,
		last_name=$3, street_address_1=$4, street_address_2=$5, city=$6, province=$7, postal_code=$8, primary_phone_number=$9,
		secondary_phone_number=$10, fax_number=$11, preffered_contact_method=$12 where  user_id=$13");
		pg_execute($conn,"user_update",array($email,$_SESSION['user']['user_id']));
		pg_execute($conn,"people",array($salutation,$first_name,$last_name,$street1,$street2,$city,$province,$postal,$phone1,$phone2,$fax,$contact_method,$_SESSION['user']['user_id']));
		
		
		
		if($_SESSION['user']['user_type'] == AGENT)
		{
			header("Location: dashboard.php?page=1");
			$_SESSION['message']="Your account has been successfully updated";
			ob_flush();
		}
		else if($_SESSION['user']['user_type'] == SUPER)
		{
			header("Location: admin.php");
			$_SESSION['message']="Your account has been successfully updated";
			ob_flush();
		}
		else if($_SESSION['user']['user_type'] == CLIENT)
		{
			header("Location: welcome.php");
			$_SESSION['message']="Your account has been successfully updated";
			ob_flush();
		}
	}
	
	
	
	
	
	
	

	
	
	
	
	
	
}






?>
<table>
	<tr>
		<td>
			<div style="width:60%" id="login">
		
		<h2><span class="fontawesome-lock"></span>Update Your Information</h2>

		<form action="" method="post">

			<fieldset>

			<table cellpadding="0" cellspacing="0">
			
				<tr><td colspan="2" ><p style="font-size:18pt">Login Information<br/><br/></p></td></tr>
				
				<tr>
					<td>
						<p>User Name : <b style="font-weight: bold;" ><?php echo $_SESSION['user']['user_id'] ?></b></p> 
						<?php 
							if ($_SESSION['user']['user_type']=='a')
							{
								echo "<p>User Type : <b style='font-weight: bold;' >Agent</b></p>";
							}
							else if ($_SESSION['user']['user_type']=='c')
							{
								echo "<p>User Type : <b style='font-weight: bold;' >Client</b></p>";
							}
							
						?>
						
					</td>
					
					<td>
						
						<p><label for="email">Email Address*</label></p>
						<p><input  type="text" name="email" id="email" value="<?php echo $email ?>" /></p> 
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
							<p><input type="text" id="cities" name="cities" value="<?php echo $city?>" /></p>  
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
					<p style="float:right"><br/><input type="submit" value="Update" /></p>
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