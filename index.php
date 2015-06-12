<?php 
$title="Home";
include ("templates/header.php"); 
?>

<div class="wrapper col3">
  <div id="intro">
    <div class="fl_left">
      <h3 style="">Group 17 : The Best  Real estate website out there !</h3>
      <p>We provide a wide variety of services including listings and search and also being able to signup and post your own listings
	  At Listed.com you can easily sell your house using an agent or by yourself.You only need 3 simple steps : Sign up/Create/Sell</p>
      <p class="readmore"><a href="about.php">Read More About Us</a></p>
    </div>
    <div class="fl_right"><img src="images/house.jpg" alt="" /></div>
    <br class="clear" />
	<br class="clear" />
  </div>
</div>

<div class="wrapper col4">
	
  <div id="services" >
	<h3>Our Recent Listings</h3>
    <ul>
	  <?php 
	  
		$conn=db_connect();
		$sql="select listing_id from listings  order by listing_date DESC limit 6";
		$result=pg_query($conn,$sql);
		$result_set=pg_fetch_all($result);
		
		for ($i=0;$i<count($result_set);$i++)
		{
			$sql="select*from listings where listing_id=".$result_set[$i]['listing_id']."";
	
			$result=pg_query($conn,$sql);
		
			$result_sets=pg_fetch_assoc($result);
			
			$listing_out = "";

			$listing_out.="<li>";
			$listing_out.="<div><img style='padding:1px;border:1px solid #032a40; margin: 0 auto;' src='images/default.jpg' alt='No Image Available' /></div>";
			$listing_out.="<div style='font-weight: bold;text-align:center'>";
			$listing_out.= " <p>Price: &#36;".$result_sets['price']."</p>";
			$listing_out.= " <p>Bed Rooms : ".property("listing_bedrooms",$result_sets['bedrooms']) ."</p>";
			$listing_out.= " <p>Bath Rooms : ". property("listing_bathrooms",$result_sets['bathrooms'] )."</p>";
			$listing_out.= " <p class='readmore'><a href='listing-view.php?listing_id=".$result_set[$i]['listing_id']."'>More Information</a></p>";
			$listing_out.= "</div>";
		
			$listing_out.="</li>";
			
			echo $listing_out; 
		}
	  
	  ?>
      
    </ul>
    <br class="clear" />
	 <br class="clear" />
  </div>
</div>



<?php include("templates/footer.php"); ?>