<?php
	$title="Reports";
	include("templates/header.php");
	
	if (!isset($_SESSION['user']))
	{
		$_SESSION['message']="Please login to access this page";
		header("Location:login.php");
		ob_flush();
	}
	else if ($_SESSION['user']['user_type']!=SUPER)
	{
		$_SESSION['message']="You are not authorized to access this page";
		header("Location:login.php");
		ob_flush();
	}
	
	
	$conn=db_connect();
	$q="select*from reports where status='".OPEN_REPORT."'";
	$result=pg_query($conn,$q);
	$result_set=pg_fetch_all($result);
	//dump($result_set);
	
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
	<h3 style="font-size: 14pt;"><?php echo $message ?></h3><br/>
	<div  class="wrapper col2">
  <div  id="dashtop">
    <div  id="dash">
      <ul>
        <li><a href="admin.php?page=1"><?php echo $_SESSION['user']['first_name'] ?></a></li>
        <li><a href="update.php">Edit Profile</a></li>
        <li><a href="user_password.php">Change Password</a></li>
        <li><a href="admin-disabled.php?page=1">Manage Users</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    
    <br class="clear" />
	
  </div>
</div>
<div class="wrapper col4">
<br/>
<h3 style="font-size:18pt">&nbsp;&nbsp;Manage Reports</h3>
<?php 
		echo "<div style='text-align:center' class='pagination'><ul>";
				if ($total_pages > 1) {
				  echo paginate($reload, $show_page, $total_pages);
				 }
		echo "</ul></div>";
		?>
 <div id="services" >
		<br class="clear" />
		
	<?php 
		
		
		
		
		echo "<ul>";
		for ($i=$start;$i<$end;$i++)
		{
			
			//dump($result);
			
			//dump($result_set);
			
			if($i==$total_results)
			{
				break;
			}
			
			$q="select*from people where user_id='".$result_set[$i]['user_id']."'";
			$result=pg_query($conn,$q);
			$result=pg_fetch_assoc($result);
			
			$user_display="";
			
			
			
			$user_display.="<li style='border:1px solid;height:135px' >";
			$user_display.="<div style='font-weight: bold;text-align:center'>";
			$user_display.="<p>Name: ".$result['first_name']." ".$result['last_name']."</p>";
			$user_display.= " <p>User Name : ".$result_set[$i]['user_id']."</p>";
			$user_display.= " <p>Reported On : ".$result_set[$i]['reported_on']."</p>";
			$user_display.="<table><tr><td> <p class='readmore'><a href='disable-client.php?user_id=".$result_set[$i]['user_id']."'>Disable Client</a></p></td>";
			$user_display.= "<td> <p class='readmore'><a href='listing-view.php?listing_id=".$result_set[$i]['listing_id']."'>View Listing</a></p></td></tr></table>";
			$user_display.= "</div>";
		
			$user_display.="</li>";
			echo $user_display;
			
			
			
		}
		echo "</ul>";
	?>	
</div>	
<br class="clear" />

<?php 
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