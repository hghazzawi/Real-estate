<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--
	Author : Group 17 ( Hasan Ghazzawi, Justin Estaris , Alex Yhap )
	Date   : <?php echo date("m/d/y");  ?>
	File Name : <?php echo basename($_SERVER['PHP_SELF']); ?>
-->
<?php session_start();

	$message="";
	
	if(isset($_SESSION['message']))
	{
		$message=$_SESSION['message'];
		unset($_SESSION['message']);
	}
	
	require("includes/constants.php");
	require("includes/db.php");
	require("includes/functions.php");
	ob_start();
	
	
	
?>		
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN">
<head>



<title><?php echo $title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/intn3201.css" type="text/css" />




<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

  
  <script type="text/javascript" >
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script>
  
  <script type="text/javascript">
		$(function() {
		
			$("#slideshow > div:gt(0)").hide();
	
			setInterval(function() { 
			  $('#slideshow > div:first')
			    .fadeOut(1000)
			    .next()
			    .fadeIn(1000)
			    .end()
			    .appendTo('#slideshow');
			},  3000);
			
		});
   </script>
   
   	
</head>
<body id="top">
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <a href="index.php"><img style="width:550px;height:100px" src="images/logo1.png"  alt="Listed Real Estate" /></a>
    </div>
    
    <br class="clear" />
  </div>
</div>
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="listing-city.php">Search</a></li>
		<?php 
			
			if (!isset($_SESSION['user']))
			{
				echo "<li><a href='register.php'>Sign Up</a></li>";
			}
			else if ($_SESSION['user']['user_type']==CLIENT)
			{
				echo "<li><a href='register.php'>Update Personal Info</a></li>";
				echo "<li><a href='welcome.php?page=1'>Profile</a></li>";
			}
			else if ($_SESSION['user']['user_type']==AGENT)
			{
				echo "<li><a href='listing-create.php'>Listing Create</a></li>";
				echo "<li><a href='dashboard.php?page=1'>Agent Dashboard</a></li>";
			}
			else if ($_SESSION['user']['user_type']==SUPER)
			{
				echo "<li><a href='admin-disabled.php?page=1'>Manage Users</a></li>";
				echo "<li><a href='admin.php?page=1'>Admin Dashboard</a></li>";
			}
			else 
			{
				echo "<li><a href='register.php'>Sign Up</a></li>";
			}
			if (isset($_SESSION['user']))
			{
				echo "<li><a href='logout.php'>Logout</a></li>";
			}
			else 
			{
				echo "<li><a href='login.php'>Login</a></li>";
			}
			
		?>
		
		
      </ul>
    </div>
    <!--<div id="search">
      <form action="#" method="post">
        <fieldset>
          <legend>Site Search</legend>
          <input type="text" value="Search By City&hellip;"  onfocus="this.value=(this.value=='Search By City&hellip;')? '' : this.value ;" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>-->
    <br class="clear" />
	
  </div>
</div>