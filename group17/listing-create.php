<?php 
$title="Listing Create";
include("templates/header.php"); 
?>

<div style="width:60%" id="login">
	<h2>Create Listing </h2>
	<form action="javascript:void(0);" method="post">
		
		<fieldset>
		
		<div style="float:left">
			 
			
			<p>Select Your City<br/></p>
			<select style="width: 125px;" name="minimum_price">
					<option value="rent">Barrie </option>
					<option value="sale">Hamilton</option>
					<option value="sale">Ajax</option>
					<option value="sale">Toronto </option>
			</select> 
			
			<p><br/>Bed<br/></p>
			<select style="width: 125px;" name="minimum_price">
					<option value="rent">1</option>
					<option value="sale">2</option>
					<option value="sale">3</option>
					<option value="sale">4+</option>
			</select> 
			
			<p><br/>Bath</p>
			<select style="width: 125px;" name="minimum_price">
					<option value="rent">1</option>
					<option value="sale">2</option>
					<option value="sale">3</option>
					<option value="sale">4+</option>
			</select>
			
			
			
			<p><br/><br/><label for="price">Price</label></p>
			<p><input type="text" id="price" value=""/></p> 
			
		</div>

		<div style="float:right">
		
			<p>Type</p>
			<select style="width: 125px;" name="minimum_price"  >
					<option value="rent">Any</option>
					<option value="sale">House</option>
					<option value="rent">TownHouse</option>
					<option value="sale">Apartment</option>
					
					
			</select>
			
			
			<p><br/>Stories</p>
			<select style="width: 125px;" name="minimum_price">
					<option value="rent">1</option>
					<option value="sale">2</option>
					<option value="sale">3</option>
					<option value="sale">4+</option>
			</select>
			
			<p><br/>Listing Type</p>
			<select style="width: 125px;" name="minimum_price">
					<option value="rent">For Sale</option>
					<option value="sale">For Rent</option>
					<option value="sale">Both</option>
			</select>
			
			
			
			
			
			
			<p><br/><br/><label for="bath">Picture Of the House</label></p>
			<p><input style="border:none;" type="file" value="" name="thumbnail" accept=".jpg,.png" /></p>	
			
			<p><br/></p>
			<table>
			<tr>
			<td style="border-style:none;" >
			<p>Options</p>
			</td>
			</tr>
			<tr>
				
				<td style="border-style:none;"><input type="checkbox" name="vehicle" value="Bike"/>Pool<br/></td>
				<td style="border-style:none;"><input type="checkbox" name="vehicle" value="Bike"/>A/C<br/></td>
				<td style="border-style:none;"><input type="checkbox" name="vehicle" value="Bike"/>Garage<br/></td>
				<td style="border-style:none;"><input type="checkbox" name="vehicle" value="Bike"/>Gate<br/></td>
				<td style="border-style:none;"><input type="checkbox" name="vehicle" value="Fire Place"/>Fire Place<br/></td>
			</tr>
			</table>
			<p><br/></p>
			<p style="float:right" ><input type="submit" value="Create" /></p>
			
			
			
			
		</div>
		
		
	
		</fieldset>
		
	</form>
	
	
</div>

<?php include("templates/footer.php"); ?>