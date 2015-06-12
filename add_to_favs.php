<?php 
	$title="Listing Display";
include("templates/header.php");

$conn=db_connect();

$listing_id=$_GET['listing_id'];
$sql="insert into favourites (user_id,listing_id) values ('".$_SESSION['user']['user_id']."',".$listing_id.")";
pg_query($conn,$sql);
header("location:listing-view.php?listing_id=$listing_id");
ob_flush();


include("templates/footer.php");
?>