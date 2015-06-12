<?php 
$title="Listing Display";
include("templates/header.php");

if ( $_SERVER["REQUEST_METHOD"] == "GET")
{
	if (empty($_GET['listing_id']))
	{
		header("location:index.php");
		ob_flush();
	}
	
	else if (isset($_GET['listing_id']))
	{
		$listing_id=$_GET['listing_id'];
		
		$conn=db_connect();
		$q=pg_prepare($conn,"listings","select*from listings where listing_id=$listing_id");
		$result=pg_execute($conn,"listings",array());
		
		$result_set=pg_fetch_assoc($result,0);
	}
	
}



?>



<div style="text-align: center;">
<div style="width: 60%; margin: 0 auto;">
	<br/>
	<table style="border-radius: 25px;background-color:#99FFCC">
		<tr>
			<td colspan="2" style="text-align: center;font-size:28pt"><br/><?php echo $result_set['headline'] ?><hr/></td>
		</tr>
		<tr>
			<td style="border-style: none;">
				<br/><h4 style="font-size: 18pt;"><?php echo get_property("cities","city",$result_set['city']) ?><br/><?php echo $result_set['province'] ?><br/><?php echo $result_set['postal_code'] ?></h4>
			</td>
			
			<td >
				<br/><p style="font-size: 14pt;">Added to our website on <?php echo $result_set['listing_date'] ?></p>
			</td>
		</tr>
		
		<tr>
			<td >
				<br/><br/><h2 style="font-size: 35pt;">&#36;<?php echo $result_set['price'] ?></h2>
			</td>
			
			<td style="border-style: none;" >
				
				<div id="slideshow">
					<?php
						if ($result_set['images']==0)
						{
							echo '<div>
									<img src="images/default.jpg" style="width:250px;height:150px" alt="Default Image"/>
								</div>';
						}
						else 
						{
							for ($i=1;$i<=$result_set['images'];$i++)
							{
								echo '<div>
								 <img src="uploads/'.$listing_id.'/'.$listing_id.'_'.$i.'.jpg" style="width:250px;height:150px" alt='.$listing_id.'_'.$i.' />
							   </div>'; 
							}
						}
					?>
				   
				   
				</div>
				
				
			</td>
		</tr>
		
		<tr>
			<td >
				<table >
					<tr>
						<td style="border: 5px ridge #009999;padding:3px;"><p style="font-size: 18pt;"><?php echo get_property("listing_bathrooms","bath",$result_set['bathrooms']) ?> Bath</p></td>
						<td/>
						<td style="border: 5px ridge #009999;padding:3px;"><p style="font-size: 18pt;"><?php echo get_property("listing_bedrooms","bed",$result_set['bedrooms']) ?>  Bed</p></td>
					</tr>
				</table>
			</td>
			
		</tr>
		
		<tr>
			<td >
				<table style="text-align:left">
					<tr>
						<td style="font-size: 14pt;border-style: none;"><br/><b style="font-weight: bold;">Building Type</b>:<?php echo get_property("listing_type","type",$result_set['listing_type']) ?> </td>
						
					</tr>
					<tr>
						<td style="font-size: 14pt;border-style: none;"><b style="font-weight: bold;">Options:</b><?php echo property("property_options",$result_set['property_options']) ?></td>
					</tr>
					<tr>
						<td style="font-size: 14pt;border-style: none;"><b style="font-weight: bold;">Stories:</b><?php echo get_property("listing_stories","stories",$result_set['listing_stories']) ?>  Stories</td>
					</tr>
					<tr>
						<td style="font-size: 14pt;border-style: none;"><b style="font-weight: bold;">Material:</b><?php echo get_property("listing_material","material",$result_set['listing_material']) ?></td>
					</tr>
					<tr>
						<td style="font-size: 14pt;border-style: none;"><b style="font-weight: bold;">Status:</b><?php echo get_property("listing_sale_status","sale",$result_set['listing_sale_status']) ?></td>
					</tr>
				</table>
			</td>
			
			<td style="width:600px;border-style: none;">
			<p style="font-size: 14pt;"><b style="font-weight: bold;"><br/>Listing Description</b><br/>
			<?php echo $result_set['description'] ?></p>
			<br/>
			<br/>
			<?php 
				$q="select status from listings where listing_id=$listing_id";
				$result=pg_query($conn,$q);
				if (pg_fetch_result($result,0)==LISTING_SOLD)
				{
					echo "<h2 style='font-size:18pt;color:red;'>This Listing is Sold</h2>";
				}
				
				
				if (isset($_SESSION['user']) && $_SESSION['user']['user_type']==AGENT && $result_set['user_id']==$_SESSION['user']['user_id']&&pg_fetch_result($result,0)!=LISTING_DISABLED)
				{
					echo "<a href='listing-update.php?listing_id=".$listing_id."'><img style='margin: 0 auto;width:300px' src='images/edit.png' alt='Edit this listing' /></a>";
				}
				else if (isset($_SESSION['user']) && $_SESSION['user']['user_type']==CLIENT)
				{	
					$q="select status from listings where listing_id=$listing_id";
					$result=pg_query($conn,$q);
					if (pg_fetch_result($result,0)==LISTING_DISABLED)
					{
						header("Location:index.php");
						ob_flush();
					}
					echo '<table><tr>';
					$conn=db_connect();
					$q="select user_id from reports where listing_id=$listing_id"; 
					$sql="select listing_id  from favourites where user_id='".$_SESSION['user']['user_id']."' and listing_id=$listing_id";
					$result=pg_query($conn,$sql);
					$report=pg_query($conn,$q);
					if (pg_num_rows($result)!=1)
					{
						echo '<td><a href="add_to_favs.php?listing_id='.$listing_id.'" ><img style="height:75px" src="images/add-fav.png" alt="Add to Favourites" /></a></td>';
					}
					else 
					{
						echo '<td><a href="remove-favs.php?listing_id='.$listing_id.'" ><img style="height:75px" src="images/remove-fav.png" alt="Remove from Favourites" /></a></td>';
					}
					
					if (pg_num_rows($report)!=1)
					{
						echo '<td><a href="report.php?listing_id='.$listing_id.'" ><img style="height:75px" src="images/flag.png" alt="Flag" /></a></td>';
					}
					else 
					{
						echo 'You Have Already Reported This';
					}
					echo '</tr></table>';
					
				}
				else if (isset($_SESSION['user']) && $_SESSION['user']['user_type']==SUPER)
				{
					$q="select status from listings where listing_id=$listing_id";
					$result=pg_query($conn,$q);
					
					if (pg_fetch_result($result,0)==LISTING_OPEN)
					{
						echo "<a href='listing-disable.php?listing_id=".$listing_id."'><img style='margin: 0 auto;width:300px' src='images/disable.png' alt='Edit this listing' /></a>";
					}
					else if (pg_fetch_result($result,0)==LISTING_DISABLED)
					{
						echo "<a href='listing-enable.php?listing_id=".$listing_id."'><img style='margin: 0 auto;width:300px' src='images/enable.png' alt='Edit this listing' /></a>";
					}
				}
			?>
			
			</td>
		</tr>
	</table>
	<br/>

</div>
</div>



<?php include("templates/footer.php"); ?>