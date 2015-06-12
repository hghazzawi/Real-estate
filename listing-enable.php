<?php
	$title="";
	include("templates/header.php");
	
	$conn=db_connect();
	$q="update listings set status='".LISTING_OPEN."' where listing_id=".$_GET['listing_id'];
	pg_query($conn,$q);
	
	header("location:listing-view.php?listing_id=".$_GET['listing_id']."");
	ob_flush();
?>

<?php 
	include("templates/footer.php");
?>