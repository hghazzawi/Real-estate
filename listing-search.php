<?php 
$title="Listing Search";
include("templates/header.php"); 

	
	
	
	$bath=(isset($_COOKIE['bath']))?$_COOKIE['bath']:"";
	
	$bed=(isset($_COOKIE['bed']))?$_COOKIE['bed']:"";
	
	$material=(isset($_COOKIE['material']))?$_COOKIE['material']:"";
	
	$stories=(isset($_COOKIE['stories']))?$_COOKIE['stories']:"";
	
	$view=(isset($_COOKIE['view']))?$_COOKIE['view']:"";
	
	$type=(isset($_COOKIE['type']))?$_COOKIE['type']:"";
	
	$options=(isset($_COOKIE['options']))?$_COOKIE['options']:"";
	
	$status=(isset($_COOKIE['status']))?$_COOKIE['status']:"";
	
	$price=(isset($_COOKIE['price']))?$_COOKIE['price']:"";
	
	$max_price=(isset($_COOKIE['max_price']))?$_COOKIE['max_price']:"";
	
	


	
	$city = (isset($_COOKIE['city']))?$_COOKIE['city']:"";
	$city = (isset($_SESSION['city']))?$_SESSION['city']:$city;
	$city = (isset($_GET['city']))?$_GET['city']:$city;
	
	
	if(strlen($city) == 0)
	{
		$_SESSION['message'] = "You MUST select at least one city";
		ob_flush();
		header("Location: listing-city.php");
	}else{
	
		$_SESSION['city'] = $city;
		setcookie("city", $city, time() + COOKIE_DURATION);
		
	}
	

if ( $_SERVER["REQUEST_METHOD"] == "POST")
{

	$bath= isset( $_POST['listing_bathrooms']) ? sumCheckBox($_POST['listing_bathrooms']): "";
	$bed=isset($_POST['listing_bedrooms']) ? sumCheckBox($_POST['listing_bedrooms']): "";
	$material=isset( $_POST['listing_material']) ? sumCheckBox($_POST['listing_material']): "";
	$stories=isset($_POST['listing_stories']) ? sumCheckBox($_POST['listing_stories']): "";
	$status=isset($_POST['listing_sale_status']) ? sumCheckBox($_POST['listing_sale_status']): "";
	$view=isset($_POST['listing_view']) ? sumCheckBox($_POST['listing_view']): "";
	$type=isset($_POST['listing_type']) ? sumCheckBox($_POST['listing_type']): "";
	$options=isset($_POST['property_options']) ? sumCheckBox($_POST['property_options']): "";
	
	

	$listing_bathrooms = isset( $_POST['listing_bathrooms'])? join (',', $_POST['listing_bathrooms']): "";
    $listing_bedrooms  = isset($_POST['listing_bedrooms']) ?  join (',', $_POST['listing_bedrooms']) : "";
    $listing_material  = isset( $_POST['listing_material']) ? join (',', $_POST['listing_material']) : "";
    $listing_stories  = isset($_POST['listing_stories']) ? join (',', $_POST['listing_stories']) : "";
    $listing_sale_status  = isset($_POST['listing_sale_status']) ? join (',', $_POST['listing_sale_status']) : "";
    $listing_view  = isset($_POST['listing_view']) ? join (',', $_POST['listing_view']) : "" ;
	$listing_type  = isset($_POST['listing_type']) ? join (',', $_POST['listing_type']) : "";
	$property_options  = isset($_POST['property_options']) ? join (',', $_POST['property_options']) : "";
	$price=isset($_POST['prices']) ? ($_POST['prices']) :  "";
	$max_price=isset($_POST['max_prices']) ? ($_POST['max_prices']) : "";
	
	 
	$conn=db_connect();
	$sql="SELECT listings.listing_id FROM listings 
	WHERE 1 = 1 ";
	if (isset($_GET['city']))
	{
		$sql .= "AND (listings.city =".$_GET['city'].")"; 
	}
	else 
	{
		$sql .= "AND (listings.city in (". search_label("cities", $city )."))"; 
	}
	
	$sql.= ($listing_bathrooms !="") ? "AND (listings.bathrooms in ($listing_bathrooms))" : "";
	$sql.= ($listing_bedrooms !="")  ? "AND (listings.bedrooms in ($listing_bedrooms) ) " : "";
	$sql.= ($listing_stories != "")  ? "AND (listings.listing_stories in ($listing_stories))" : "";
	$sql.=($listing_type != "" ) ? "AND (listings.listing_type in ($listing_type) )" : ""; 
	$sql.=($listing_material != "") ? "AND (listings.listing_material in ($listing_material))" : "";
	$sql.=($listing_view != "") ? "AND (listings.listing_view in ($listing_view))" : "";
	$sql.=($listing_sale_status != "") ? "AND (listings.listing_sale_status in ($listing_sale_status))" : "";
	$sql .= ($property_options != "") ? "AND (listings.property_options in ($property_options))" : "";
	$sql.=($price != "" || $max_price != "") ? " AND (listings.price >= $price AND listings.price <= $max_price )" : "";
	$sql.="AND (listings.status = '".LISTING_OPEN."')";
	$sql.="ORDER BY listings.listing_id DESC LIMIT 200";
	
	
	$result=pg_query($conn,$sql);
	
	$result_set=pg_fetch_all($result);
	

	
	
	$_SESSION['search_result']=$result_set;
	
	
	

	if (pg_num_rows($result)==1)
	{
		header("Location:listing-view.php?listing_id=".$result_set[0]['listing_id']);
		ob_flush();
	}
	
	else if (pg_num_rows($result)>1)
	{
		if (isset($_SESSION['user']))
		{
			setcookie("bath", $bath, time() + COOKIE_DURATION);
			setcookie("bed", $bed, time() + COOKIE_DURATION);
			setcookie("material", $material, time() + COOKIE_DURATION);
			setcookie("stories", $stories, time() + COOKIE_DURATION);
			setcookie("status", $sale_status, time() + COOKIE_DURATION);
			setcookie("view", $view, time() + COOKIE_DURATION);
			setcookie("type", $type, time() + COOKIE_DURATION);
			setcookie("options", $options, time() + COOKIE_DURATION);
			setcookie("price", $price, time() + COOKIE_DURATION);
			setcookie("max_price", $max_price, time() + COOKIE_DURATION);
			
			header("Location:listing-matches.php?page=1");
			ob_flush();
		}
		else 
		{
			header("Location:listing-matches.php?page=1");
			ob_flush();
		}
		
	}
	else 
	{
		$message="No results have been returned.. Please Expand your search criteria";
	}
	
	
	
	
}

?>

<div style="width:60%" id="login">

		<?php echo $message ?>
			<?php	
			if (isset($_GET['city']))
			{
				echo '<p style="font-size:18pt">Your Search Will be on the city of <b style="font-weight: bold;">'.property("cities",$_GET['city']).'</b> </p>';
			}
			else 
			{
			echo '<p style="font-size:18pt">Your Search Will be on the city of <b style="font-weight: bold;">'.build_label("cities", $city ).'</b> </p>';
			}
		?>
			<h2>Search Our Listings</h2>
		
		<form id="listing_search" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

			<fieldset>
				<table>
					<tr>
						<td>
							<p>Bathrooms</p>
							<?php echo build_checkbox("listing_bathrooms","search_bathrooms",$bath); ?>
						</td>
						<td>
							
							<p>Bedrooms</p>
							<?php echo build_checkbox("listing_bedrooms","search_bedrooms",$bed); ?>
						
						</td>
						<td>
							<p>Material</p>
							<?php echo build_checkbox("listing_material","search_material",$material); ?>
						</td>
						<td>
							<p>Stories</p>
							<?php echo build_checkbox("listing_stories","search_stories",$stories); ?>
						</td>
						<td>
							<p>Minimum Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maximum Price</p>
							<?php 
								echo build_simple_dropdown("prices","min",$price),build_simple_dropdown("max_prices","max",$max_price);
							?>
						</td>
					</tr>
					<tr>
						<td>
							<p>Status</p>
							<?php echo build_checkbox("listing_sale_status","status_search",$status); ?>
						</td>
						<td>
							<p>View</p>
							<?php echo build_checkbox("listing_view","search_view",$view); ?>
						</td>
						<td>
							<p>Type</p>
							<?php echo build_checkbox("listing_type","search_type",$type); ?>
						</td>
						<td>
							<p>Options</p>
							<?php echo build_checkbox("property_options","search_options",$options); ?>
						</td>
						
					</tr>
					<tr  >
						<td colspan="5">
						<input type="submit" value="Search" />
						</td>
					</tr>
				</table>
				
			
			</fieldset>
			
			

		</form>
</div> <!-- end login -->


<?php include("templates/footer.php"); ?>