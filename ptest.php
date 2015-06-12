<?php 
$title="Search Results" ;
include("templates/header.php");

$per_page = 10; 
$result_set=$_SESSION['search_result'];
$result=$_SESSION['search_result'];
$total_results=count($result);
$total_pages=ceil($total_results / $per_page);

if (isset($_GET['page'])) {
    $show_page = $_GET['page'];             //it will telles the current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
	
}
// display pagination
$page = intval($_GET['page']);

$tpages=$total_pages;
if ($page <= 0)
    $page = 1;
$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;

?>


<div class="wrapper col4">
<br/>
	<?php 
	echo "<div style='text-align:center' class='pagination'><ul>";
            if ($total_pages > 1) {
              echo paginate($reload, $show_page, $total_pages);
             }
    echo "</ul></div>";
	?>
	<br/>
  <div id="services" >
  
	<?php 
	
	
	
	echo "<ul>";
	for ($i=$start;$i<$end;$i++)
	{
		if($i==$total_results)
		{
			break;
		}
		
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
	echo "</ul>";
	echo "<br class='clear' />";
	echo "<br class='clear'/>";
	echo "</div>";
	
	echo "<div style='text-align:center' class='pagination'><ul>";
            if ($total_pages > 1) {
              echo paginate($reload, $show_page, $total_pages);
             }
    echo "</ul></div>";
	
	?>
 
	 <br class="clear" />
  
</div>


<?php 
include("templates/footer.php"); ?>