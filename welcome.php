<?php 
$title="Welcome";
include("templates/header.php");

if (!isset($_SESSION['user']))
{
	$_SESSION['message']="Please login to access this page";
	header("Location:login.php");
	ob_flush();
}
else if ($_SESSION['user']['user_type']!=CLIENT)
{
	$_SESSION['message']="You are not authorized to access this page";
	header("Location:login.php");
	ob_flush();
}

$user_id= $_SESSION['user']['user_id'];

$conn=db_connect();
$q="select listing_id from favourites where user_id='".$user_id."' order by listing_id DESC ";
$result=pg_query($conn,$q);
$result_set=pg_fetch_all($result);


//dump($result_set);
$array=array();
for ($i=0;$i<count($result_set);$i++)
{
	array_push($array,$result_set[$i]['listing_id']);
}
//dump($array);





$per_page = 9;
$total_results=count($result_set);
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

<div style="text-align: center;">
<div style="width: 1024px; margin: 0 auto;">
	<br/>
	<h3 style="font-size: 16pt;"><?php echo $message ?></h3><br/>
	<div  class="wrapper col2">
  <div  id="dashtop">
    <div  id="dash">
      <ul>
        <li><a href="#">Welcome <?php echo $_SESSION['user']['user_id'] ?></a></li>
        <li><a href="#">Edit Profile</a></li>
        <li><a href="user_password.php">Change Password</a></li>
        <li><a href="#">Favorites</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    
    <br class="clear" />
	
  </div>
</div><!--nav-->



<br class="clear" />



	<div class="wrapper col4">
	<br/>
		<h3 style="font-size:18pt">&nbsp;&nbsp;Edit Your Favourites</h3>
		<?php 
		echo "<div style='text-align:center' class='pagination'><ul>";
				if ($total_pages > 1) {
				  echo paginate($reload, $show_page, $total_pages);
				 }
		echo "</ul></div>";
		?>
		<br/>
	  <div id="services" >
		<br class="clear" />
		
	<?php 
		
		echo "<ul>";
		for ($i=$start;$i<$end;$i++)
		{
			
			
			
			
			
			if($i==$total_results)
			{
				break;
			}
			
			if($result_set=="")
			{
				$listing_out= "no favourites";
			}
			
			   
				
				//dump($result_set);
			
			
			else
			{
			
			 $q="select * from listings where listing_id=".$array[$i];
				
				$result=pg_query($conn,$q);
				$result_set=pg_fetch_assoc($result);
			
			$listing_out = "";

			$listing_out.="<li style='border:1px solid'>";
			$listing_out.="<div><img style='padding:1px;border:1px solid #032a40; margin: 0 auto;' src='images/default.jpg' alt='No Image Available' /></div>";
			$listing_out.="<div style='font-weight: bold;text-align:center'>";
			$listing_out.= " <p>Price: &#36;".$result_set['price']."</p>";
			$listing_out.= " <p>Bed Rooms : ".property("listing_bedrooms",$result_set['bedrooms']) ."</p>";
			$listing_out.= " <p>Bath Rooms : ". property("listing_bathrooms",$result_set['bathrooms'] )."</p>";
			$listing_out.= " <p class='readmore'><a href='listing-view.php?listing_id=".$result_set['listing_id']."'>Preview Listing</a></p>";
			$listing_out.= "</div>";
		
			$listing_out.="</li>";
			}
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
	
	



	<br/>

</div>
	
<br/>
</div>
</div>



<?php include("templates/footer.php"); ?>