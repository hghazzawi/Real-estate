<?php 
$title="Manage Users";
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



 ?>

<div style="text-align: center;">
<div style="width: 600px; margin: 0 auto;">
	<br/>
	
	<div  class="wrapper col2">
  <div  id="dashtop">
    <div  id="dash">
      <ul>
        <li><a href="admin.php"><?php echo $_SESSION['user']['first_name'] ?></a></li>
        <li><a href="update">Edit Profile</a></li>
        <li><a href="user_password.php">Change Password</a></li>
        <li><a href="#">Manage Users</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    
    <br class="clear" />
	
  </div>
</div>
<br class="clear" />
<h3 style="font-size: 14pt;"><?php echo $message ?></h3><br/>

<?php 
	
	$conn=db_connect();
	$q=pg_prepare($conn,"users","select user_id,user_type from users where user_type=$1 or user_type=$2 or user_type=$3 ");
	$result=pg_execute($conn,"users",array(AGENT,PENDING_AGENT,CLIENT));
	
	$result_set=pg_fetch_all($result);
	
	
	
		echo "<table style='border:1px solid'>";
		echo "<th style='height:35px;font-size:16pt;background-color:#33CCCC;border:1px solid'>User ID</th>";
		echo "<th style='height:35px;font-size:16pt;background-color:#33CCCC;border:1px solid'>Status</th>";
		echo "<th style='height:35px;font-size:16pt;background-color:#33CCCC;border:1px solid'>Disable/Activate</th>";
		for ($i=0;$i<count($result_set);$i++)
		{
			echo "<tr style='border:1px solid'>";
			echo "<td style='border:1px solid'>".$result_set[$i]['user_id']."</td>";
			
			if ($result_set[$i]['user_type']==PENDING_AGENT)
			{
				echo "<td style='border:1px solid'>Disabled User</td>"; 
			}
			else if ($result_set[$i]['user_type']==AGENT || $result_set[$i]['user_type']==CLIENT)
			{
				echo "<td style='border:1px solid'>Active User</td>"; 
			}
			
			if ($result_set[$i]['user_type']==PENDING_AGENT)
			{
				echo "<td style='border:1px solid'><a href='enable-user.php'>Enable</a></td>"; 
			}
			else if ($result_set[$i]['user_type']==AGENT || $result_set[$i]['user_type']==CLIENT)
			{
				echo "<td style='border:1px solid'><a href='disable-user.php'>Disable</a></td>"; 
			}
			
			echo "</tr>";
		}
		echo "</table>";


?>

<br/>

</div>
</div>



<?php include("templates/footer.php"); ?>