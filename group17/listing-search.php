<?php 
$title="Listing Search";
include("templates/header.php"); 
?>

<div style="width:60%" id="login">

		<h2>Search Our Listings</h2>

		<form id="listing_search" action="javascript:void(0);" method="post">

			<fieldset>

				<table>
				
				<tr>
				
				
				
				<td style="border-style:none;">
				
				
				
				<p><label for="city">Search by City</label></p>
				<p><input type="text" id="city" value=""/></p> 
				
				<p>Minimum Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maximum Price</p>
				<select style="width: 125px;" name="minimum_price"  >
					<option value="0">0</option>
					<option value="100">100</option>
				</select>
				
				<select style="width: 125px;" name="minimum_price"  >
					<option value="0">0</option>
					<option value="100">100</option>
				</select>
				
				
				<p><br/>Type</p>
				<table>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>Any<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>House<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>TownHouse<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>Condo<br/>
				</td>
				</tr>
				</table>
				
				
				</td>
				
				
				
				
				
				<td style="border-style:none;">
				<p>Bed Rooms</p>
				<table>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>1<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>2<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>3<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>4+<br/>
				</td>
				</tr>
				</table>	
				
			<table>
			<tr>
				<td style="border-style:none;" >
				<p><br/>Stories</p>
				<table>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>1<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>2<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>3<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>4+<br/>
				</td>
				</tr>
				</table>	
				</td>
				
				<td style="border-style:none;">
				<p><br/>Options</p>
				<table>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>Pool<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>A/C<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>Garage<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>Heating<br/>
				</td>
				</tr>
				</table>	
				</td>
				</tr>
				
				
				
				</table>
				</td>
				
				
				
				
				
				
				<td style="border-style:none;">
					
				
				
			
				<p>Bath Rooms</p>
				<table>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>1<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>2<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>3<br/>
				</td>
				</tr>
				<tr>
				<td style="border-style:none;">
				<input type="checkbox" name="vehicle" value="Bike"/>4+<br/>
				</td>
				</tr>
				
				<tr>
					<td style="border-style:none;" >
						<br/>
						<p>Listing Type</p>
						<input type="checkbox" name="vehicle" value="Bike"/>For Rent<br/>
						<input type="checkbox" name="vehicle" value="Bike"/>For Sale<br/>
					</td>
				</tr>
				
				</table>	
				</td> 
				
				<td  style="border-style:none;" ><p>Search By Date</p>
				<input  style="width: 200px;" type="text" id="datepicker"/></td>
				
				
				
				
				
				
				
				
				</tr>
				</table>
				
				

				<p style="float:right" ><input type="submit" value="Search" /></p>
				
			</fieldset>
			
			

		</form>
</div> <!-- end login -->


<?php include("templates/footer.php"); ?>