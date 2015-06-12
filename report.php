<?php 
	$title="Listing Display";
include("templates/header.php");

$conn=db_connect();
$today = date('m/d/Y',time());
$listing_id=$_GET['listing_id'];
$sql="insert into reports  values ('".$_SESSION['user']['user_id']."',".$listing_id.",'".date('Y-m-d',time())."','".OPEN_REPORT."')";
pg_query($conn,$sql);
header("location:listing-view.php?listing_id=$listing_id");
ob_flush();

include("templates/footer.php");
?>