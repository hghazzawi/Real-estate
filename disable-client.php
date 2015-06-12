<?php $title="";
include("templates/header.php"); 
$user_id=$_GET['user_id'];
$conn=db_connect();
$q="update  users set user_type='".DISABLED."' where user_id='$user_id'";
pg_query($conn,$q);

$q="delete from favourites where user_id='$user_id'";
pg_query($conn,$q);

$q="update reports set status='".CLOSED_REPORT."' where user_id='$user_id'";
pg_query($conn,$q);

// header("location:admin.php?page=1");
// ob_flush();
?>