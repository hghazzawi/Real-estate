<?php 
$title="Admin Dashboard";
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
$q=pg_prepare($conn,"users","select user_id,user_type from users where user_type=$1");
$result=pg_execute($conn,"users",array(PENDING_AGENT));
$result_set=pg_fetch_all($result);


$per_page = 8;
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
		<li><a href="reports.php?page=1">Reports</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    
    <br class="clear" />
	
  </div>
</div>
<div class="wrapper col4">
<br/>
<h3 style="font-size:18pt">&nbsp;&nbsp;Pending Agents</h3>
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
			
			if ($result_set[$i]['user_type']==PENDING_AGENT)
			{
			$label= "Pending Agent";
			} 
			
			
			$user_display.="<li style='border:1px solid;height:135px;width:445px' >";
			$user_display.="<div style='height:100px;font-weight: bold;text-align:center'>";
			$user_display.="<p>Name: ".$result['first_name']." ".$result['last_name']."</p>";
			$user_display.= " <p>User Name : ".$result_set[$i]['user_id']."</p>";
			$user_display.= " <p>Status : ".$label."</p>";
			$user_display.="<table><tr><td> <p class='readmore'><a href='agent-enable.php?user_id=".$result_set[$i]['user_id']."'>Enable</a></p></td>";
			$user_display.= "<td> <p class='readmore'><a href='make-disabled.php?user_id=".$result_set[$i]['user_id']."'>Delete</a></p></td>";
			$user_display.= "<td> <p class='readmore'><a href='make-client.php?user_id=".$result_set[$i]['user_id']."'>Make Client</a></p></td></tr></table>";
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