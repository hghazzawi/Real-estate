<?php
$title="Search Results";
include("templates/header.php");
// If current page number, use it
// if not, set one!
if(!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Define the number of results per page
$max_results = 10;

// Figure out the limit for the query based
// on the current page number.
$from = (($page * $max_results) - $max_results);
//1*10 - 10 = 0
//2*10 - 10 = 10
$result_set=$_SESSION['search_result'];

echo "<div class='wrapper col4'>
	<br/>
	<h3>Search Results showing 9 of 20</h3>
  <div id='services' >";
  
 echo "<ul>";
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
			$listing_out.= " <p>Bed Rooms : ".$result_sets['bathrooms'] ."</p>";
			$listing_out.= " <p>Bath Rooms : ". $result_sets['bedrooms'] ."</p>";
			$listing_out.= " <p class='readmore'><a href='listing-view.php?listing_id=".$result_set[$i]['listing_id']."'>More Information</a></p>";
			$listing_out.= "</div>";
		
			$listing_out.="</li>";
			
			echo $listing_out;

	
	
}
echo "</ul>";

echo   "</div></div>";
 


// Figure out the total number of results in DB:
$total_results = count($result_set);

// Figure out the total number of pages. Always round up using ceil()
$total_pages = ceil($total_results / $max_results);

// Build Page Number Hyperlinks
echo "<center>Select a Page<br />";

// Build Previous Link
if($page > 1){
    $prev = ($page - 1);
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=".$prev."\">Previous</a> ";
}

for($i = 1; $i <= $total_pages; $i++){
    if(($page) == $i){
        echo "$i";
        } else {
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">$i</a> ";
    }
}

// Build Next Link
if($page < $total_pages){
    $next = ($page + 1);
    echo "<a href=\"".$_SERVER['PHP_SELF']." ? page=".$next."\">Next>></a>";
}
echo "</center>";
?>