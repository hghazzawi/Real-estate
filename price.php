<?php
$title="";
include("templates/header.php");

$lines = file("file.txt");
$conn=db_connect();
foreach($lines as $line)
{
	
    $q="insert into prices values($line)";
	pg_query($conn,$q);
}

foreach($lines as $line)
{
	
    $q="insert into max_prices values($line)";
	pg_query($conn,$q);
}

include("templates/footer.php");

?>