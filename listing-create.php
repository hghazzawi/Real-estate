<?php 
$title="Listing Create";
include("templates/header.php"); 

if (!isset($_SESSION['user']))
{
	$_SESSION['message']="Please login to access this page";
	header("Location:login.php");
	ob_flush();
}
else if ($_SESSION['user']['user_type']!=AGENT)
{
	$_SESSION['message']="You are not authorized to access this page";
	header("Location:login.php");
	ob_flush();
}


if ( $_SERVER["REQUEST_METHOD"] == "GET")
{
	$province=DEFAULT_PROVINCE;
	$city=DEFAULT_CITY;
	
	$street="";
	$price="";
	$headline="";
	$description="";
	$postal="";
	
	$error_message="";
	$error_title="";
}
else if ( $_SERVER["REQUEST_METHOD"] == "POST")
{
	
	$city=$_POST['cities'];
	$province=$_POST['provinces'];
	$price=$_POST['price'];
	$description=$_POST['description'];
	$bathrooms=$_POST['listing_bathrooms'];
	$bedrooms=$_POST['listing_bedrooms'];
	$headline=$_POST['headline'];
	$material=$_POST['listing_material'];
	$listing_status=$_POST['listing_sale_status'];
	$listing_type=$_POST['listing_type'];
	$listing_stories=$_POST['listing_stories'];
	$listing_view=$_POST['listing_view'];
	$options=$_POST['property_options'];
	$error_message="";
	
	$postal=$_POST['postal'];
	//dump($_POST);
	
	if (empty($postal))
	{
		$error_message.="Enter a Postal Code<br/>";
	}
	else if(!is_valid_postal_code($postal))
	{
		$error_message.="Invalid Postal Code<br/>";
		$postal="";
	}
	
	
	
	if (empty($price))
	{
		$error_message.="You must enter a price<br/>";
	}
	else if (!is_numeric($price))
	{
		$error_message.="Price must be numeric<br/>";
		$price="";
	}
	
	if(empty($description))
	{
		$error_message.="Enter a description<br/>";
	}
	
	if(empty($headline))
	{
		$error_message.="Enter a headline<br/>";
	}
	
	
	if (isset($error_message))
	{
		$error_title="<br/>Error Log<hr/>";
	}
	
	if ($error_message=="")
	{
		$conn=db_connect();
		
		pg_prepare($conn,"listing_insert","insert into listings(user_id,status,price,headline,description,postal_code,city,province,property_options,bedrooms,
		bathrooms,listing_type,listing_stories,listing_date,listing_view,listing_material,listing_sale_status)
		values ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17)");
		pg_execute("listing_insert",array($_SESSION['user']['user_id'],LISTING_OPEN,$price,$headline,$description,$postal,$city,$province,$options,$bedrooms
		,$bathrooms,$listing_type,$listing_stories,date('m/d/Y',time()),$listing_view,$material,$listing_status));
		
		
		$q="select listing_id from listings order by listing_id DESC limit 1";
		$result=pg_query($conn,$q);
		$result_set=pg_fetch_result($result,0);
		
		
		$_SESSION['message']="Listing Has Been Successfully created";
		header("Location:listing-view.php?listing_id=".($result_set)."");
		
	}
}

	



?>
<table>
<tr>
<td>
<div style="width:68%" id="login">

		<h2>Listing Create</h2>

		<form action="" method="post">

			<fieldset>

			<table cellpadding="0" cellspacing="0">
			
				
				<tr>
					<td>
						<table>
							<tr>
							<td>
							<p>City<br/></p>
							<?php echo build_dropdown("cities","city",$city); ?>
							</td>
							
							<td>
								<p>Province<br/></p>
								<?php echo build_simple_dropdown("provinces","province",$province); ?>
							</td>
							</tr>
						</table>
						
					</td>
					
					
					
				</tr>
				<tr>
					<td>
						<table>
						<tr>
							<td>
							<table>
							<tr>
								<td>
								<p><label for="postal">Postal Code</label></p>
								<p><input style="border: 1px solid;width: 125px;" name="postal" type="text" id="postal" value="<?php echo $postal ?>"/></p> 
								</td>
								<td>
								<p><label for="price">Price</label></p>
								<p><input style="border: 1px solid;width: 200px;" name="price" type="text" id="price" value="<?php echo $price ?>"/></p> 
								</td>
							</tr>
							</table>
							</td>
						</tr>
						
						<tr>
							<td>
								<p>Bathrooms<br/></p>
								<?php echo build_dropdown("listing_bathrooms","bathrooms"); ?>
								<p>Bedrooms<br/></p>
								<?php echo build_dropdown("listing_bedrooms","bedrooms"); ?>
								
							</td>		
						</tr>
						<tr>
							<td>
								
								
							</td>
							
							
						</tr>
					</table>
						
					</td>
					
					<td >
						<table>
						<tr>
							<td>
							<table>
							<tr><td>
							<p><label for="headline">Headline</label></p>
							<p><input type="text" name="headline" id="headline" value="<?php echo $headline ?>"/></p> </td></tr></table>
							</td>
						</tr>
						<tr>
							<td>
								<p>Listing Description</p>
								<textarea  cols="0" rows="0" name="description" style="font-size:14pt;font-weight:inherit;border:1px solid;color: #777;background-color: #eee;border-radius: 6px;width:100%;height:100px;"   id="message"><?php echo $description?></textarea>
							</td>
						</tr>
						
						</table>
						
					</td>
				</tr>
				
				<tr>
				
					<td>
						<table>
						<tr>
							<td>
								<p>&nbsp;Material</p>
								<?php echo build_dropdown("listing_material","material"); ?>
							
								
								
								
							</td>
							
							
						</tr>
						</table>
						
					</td>
					<td >
						
						<p>&nbsp;Status</p>
						<?php echo build_dropdown("listing_sale_status","status"); ?>
						
						
								<p><br/>&nbsp;View</p>
								<?php echo build_dropdown("listing_view","view"); ?>
						
					</td>	
				</tr>
				
				
				
				
				
				<tr>
					<td>
					<table>
						<tr>
						<td>
							<p>Type</p>
							<?php echo build_dropdown("listing_type","type"); ?>
							
						</td>
							
						<td>
							<p>Stories</p>
							<?php echo build_dropdown("listing_stories","stories"); ?>
							
						</td>
						
						
						
						</tr>
					</table>
					</td>
					
					<td>
						<p>Options</p>
						<?php echo build_dropdown("property_options","options"); ?>
					</td>
					
				</tr>
				
				
				
				
				
	
				
				<tr>
				<td colspan="2">
					<p ><br/><input type="submit" value="Create" /></p>					
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

<?php include("templates/footer.php"); ?>