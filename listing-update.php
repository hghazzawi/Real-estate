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

if (isset($_GET['listing_id']))
{
	$listing_id=$_GET['listing_id'];
	$conn=db_connect();
	$q = pg_prepare($conn, "listing_retrieve", 'SELECT * FROM listings
				  WHERE listings.listing_id=$1');
	$result = pg_execute($conn, "listing_retrieve", array("$listing_id"));
	
	$result_set=pg_fetch_assoc($result);
	
	
}
if ($_SESSION['user']['user_id'] != $result_set['user_id'])
{
	$_SESSION['message']="You are not authorized to access this listing";
	header("Location:dashboard.php?page=1");
	ob_flush();
}


if ( $_SERVER["REQUEST_METHOD"] == "GET")
{
	$province=$result_set['province'];
	$city=$result_set['city'];
	
	//$street=$result_set['price'];
	$price=$result_set['price'];
	$headline=$result_set['headline'];
	$description=$result_set['description'];
	$postal=$result_set['postal_code'];
	$bathrooms=$result_set['bathrooms'];
	$bedrooms=$result_set['bedrooms'];
	$material=$result_set['listing_material'];
	$listing_status=$result_set['listing_sale_status'];
	$listing_type=$result_set['listing_type'];
	$listing_stories=$result_set['listing_stories'];
	$listing_view=$result_set['listing_view'];
	$options=$result_set['property_options'];
	
	$error_message="";
	$error_title="";
}
else if ( $_SERVER["REQUEST_METHOD"] == "POST")
{
	$error_title="";
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
	
	
	if ($error_message!="")
	{
		$error_title="<br/>Error Log<hr/>";
	}
	else
	{
		$update=pg_prepare($conn,"listing_update","update listings set price=$1,headline=$2,description=$3,postal_code=$4,city=$5,province=$6,property_options=$7,bedrooms=$8,
		bathrooms=$9,listing_type=$10,listing_stories=$11,listing_view=$12,listing_material=$13,listing_sale_status=$14 where listing_id=$15");
		
		$result=pg_execute($conn,"listing_update",array($price,$headline,$description,$postal,$city,$province,$options,$bedrooms
		,$bathrooms,$listing_type,$listing_stories,$listing_view,$material,$listing_status,$listing_id));
		
		$_SESSION['message']="Listing with ID $listing_id has been Successfully updated";
		header("location:dashboard.php?page=1");
		ob_flush();
		
	}
	
	
	
	
}

	



?>
<table>
<tr>
<td>
<div style="width:60%" id="login">

		<h2>Edit This Listing</h2>

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
					
					<td>
						<p>&nbsp;&nbsp;Agent ID&nbsp;&nbsp;: <b style='font-weight:bold'><?php echo $result_set['user_id'] ?></b></p>
						<p>&nbsp;&nbsp;Listing ID : <b style='font-weight:bold'><?php echo $result_set['listing_id'] ?></b></p> 
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
								<?php echo build_dropdown("listing_bathrooms","bathrooms",$bathrooms); ?>
								<p>Bedrooms<br/></p>
								<?php echo build_dropdown("listing_bedrooms","bedrooms",$bedrooms); ?>
								
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
								<?php echo build_dropdown("listing_material","material",$material); ?>
							
								<p><label for="pic"><br/>House Picture</label></p>
								<p><a href="listing-images.php?listing_id=<?php echo $listing_id ?>">Add Images to this listing</a></p>	
								
								
							</td>
							
							
						</tr>
						</table>
						
					</td>
					<td >
						
						<p>&nbsp;Status</p>
						<?php echo build_dropdown("listing_sale_status","status",$listing_status); ?>
						
						
								<p><br/>&nbsp;View</p>
								<?php echo build_dropdown("listing_view","view",$listing_view); ?>
						
					</td>	
				</tr>
				
				
				
				
				
				<tr>
					<td>
					<table>
						<tr>
						<td>
							<p>Type</p>
							<?php echo build_dropdown("listing_type","type",$listing_type); ?>
							
						</td>
							
						<td>
							<p>Stories</p>
							<?php echo build_dropdown("listing_stories","stories",$listing_stories); ?>
							
						</td>
						
						
						
						</tr>
					</table>
					</td>
					
					<td>
						<p>Options</p>
						<?php echo build_dropdown("property_options","options",$options); ?>
					</td>
					
				</tr>
				
				
				
				
				
	
				
				<tr>
				
				<td>
					<p style="float:right"><br/><input name="submit" type="submit" value="Update" /></p>
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

<?php include("templates/footer.php"); ?>