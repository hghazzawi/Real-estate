<?php 
$title="Welcome";
include("templates/header.php");
 ?>

<div style="text-align: center;">
<div style="width: 600px; margin: 0 auto;">
	<br/>
	
	<div  class="wrapper col2">
  <div  id="dashtop">
    <div  id="dash">
      <ul>
        <li><a href="#">Welcome User</a></li>
        <li><a href="#">Edit Profile</a></li>
        <li><a href="#">Change Password</a></li>
        <li><a href="listing-create.php">Add Listing</a></li>
        <li class="last"><a href="#">Logout</a></li>
      </ul>
    </div>
    
    <br class="clear" />
	
  </div>
</div>
<br class="clear" />
<h3 style="font-size: 30pt;">You currently have no listings</h3><br/>
<a href="listing-create.php"><img style="margin: 0 auto;height:125px" src="images/get_started.png" alt="Get started now" /></a>
	

</div>
</div>



<?php include("templates/footer.php"); ?>