<?php 
$title="Image Upload";
include("templates/header.php");

if ( $_SERVER["REQUEST_METHOD"] == "GET")
{
	$error="";
	
	if (empty($_GET['listing_id']))
	{
		header("location:dashboard.php?page=1");
		ob_flush();
	}
	else if (!isset($_SESSION['user']) && $_SESSION['user']['user_type']==AGENT && $result_set['user_id']==$_SESSION['user']['user_id'])
	{
		header("location:dashboard.php?page=1");
		ob_flush();
		$_SESSION['message']="You don't own this listing";
	}
	
	else if (isset($_GET['listing_id']))
	{
		$listing_id=$_GET['listing_id'];
		$conn=db_connect();
		$q=pg_prepare($conn,"listings","select images from listings where listing_id=$listing_id");
		$result=pg_execute($conn,"listings",array());
		
		$result_set=pg_fetch_result($result,"images");
		
		if (is_dir("uploads/$listing_id") && $result_set==0)
		{
			rmdir("uploads/$listing_id");
		}
		
		
	
	}
	
}
if ( $_SERVER["REQUEST_METHOD"] == "POST")
{
		$error="";
		$listing_id=$_GET['listing_id'];
		$conn=db_connect();
		$q=pg_prepare($conn,"listings","select images from listings where listing_id=$listing_id");
		$result=pg_execute($conn,"listings",array());	
		$result_set=pg_fetch_result($result,"images");
		
	if(isset($_FILES["picture"]))
	{
		
		
		
		if ($_FILES['picture']['error'] > 0)
		{
			 $error= "Return Code: " . $_FILES["picture"]["error"] . "<br />";
		}
		else if ($_FILES["picture"]["type"] != "image/jpeg" &&  $_FILES["picture"]["type"] != "image/pjpeg")
		{
			$error.= "Image must be a JPEG";
		}
		else if ($_FILES['picture']['size'] > MAX_FILE_SIZE )
		{
			$error.= "Image must be less than " . MAX_FILE_SIZE/1024 . " KB ";
		}	
		else 
			{
				if ($result_set==0)
				{
					if(!is_dir("uploads/$listing_id"))mkdir("uploads/$listing_id");
					move_uploaded_file($_FILES["picture"]["tmp_name"], "./uploads/$listing_id/" . $_FILES["picture"]["name"]);
					rename("./uploads/$listing_id/".$_FILES["picture"]["name"],"./uploads/$listing_id/".$listing_id."_1.jpg");
					$number= $result_set + 1 ;
					$sql="update listings set images=$number where listing_id=$listing_id";
					pg_query($conn,$sql);
				}
				else 
				{
					$number= $result_set + 1 ;
					move_uploaded_file($_FILES["picture"]["tmp_name"], "./uploads/$listing_id/" . $_FILES["picture"]["name"]);
					rename("./uploads/$listing_id/".$_FILES["picture"]["name"],"./uploads/$listing_id/".$listing_id."_".$number.".jpg");
					
					$sql="update listings set images=$number where listing_id=$listing_id";
					pg_query($conn,$sql);
					
					header("location:listing-images.php?listing_id=$listing_id");
					ob_flush();
				}
				
				
				
			}
	}
	
	
	else if (isset($_POST['delete_id']))
	{
		
		for ($i=$result_set;$i>0;$i--)
		{
			
			if (in_array ($i,$_POST['delete_id']))
			{
				unlink("./uploads/$listing_id/".$listing_id."_".$i.".jpg");
				$result_set--;
				for ($j=$i;$j<=$result_set;$j++)
				{
					
					rename("./uploads/$listing_id/".$listing_id."_".($j+1).".jpg","./uploads/$listing_id/".$listing_id."_".$j.".jpg");
				}
				
				
				
				$sql="update listings set images=". $result_set."where listing_id=$listing_id";
				
				pg_query($conn,$sql);
				
				if($result_set == 0)
				{
					rmdir("uploads/$listing_id");
				}
			}
			
		}
		
		
		$result=pg_execute($conn,"listings",array());	
		$result_set=pg_fetch_result($result,"images");
		
		
		
	}
	if (isset($_POST['make_main']))
	{
		$variable=$_POST['make_main'];
		rename("./uploads/$listing_id/".$listing_id."_1.jpg","./uploads/$listing_id/temp.jpg");
		rename ("./uploads/$listing_id/".$listing_id."_".$_POST['make_main'].".jpg","./uploads/$listing_id/".$listing_id."_1.jpg");
		rename ("./uploads/$listing_id/temp.jpg","./uploads/$listing_id/".$listing_id."_".$variable.".jpg");
	}
		
	
	
	
		
			
			
			
			
	
			
		
}





?>
<?php echo $error ?>
<div style="width:60%" id="login">

	<?php 
			if ($result_set==0)
			{
				echo '<h2>You Have No Images</h2>';
			}
			else if ($result_set==MAX_IMAGES)
			{
				echo '<h2>Remove Images in order to upload</h2>';
			}
			else 
			{
				echo '<h2>Edit Images for this Listing</h2>';
			}
	?>
	<fieldset>
	
	
	<?php 
		
		if ($result_set > 0 )
		{
			
			
			
			
			echo '<form action="listing-images.php?listing_id='.$listing_id.'" method="post" >';
				echo '<table style="width:450px">';
					
			 for ($i=1 ; $i <= $result_set ;$i++)
			 {
				
				echo'<tr style="padding: 0;margin: 0;list-style-type:none;">';
						echo '<td style="width:150px;height:100px;background-color:white;">';
							echo '<p><img  style="width:250px;height:150px" src="uploads/'.$listing_id.'/'.$listing_id.'_'.$i.'.jpg" alt="'.$listing_id.'_'.$i.'" /></p>';
							echo '<p><input type="checkbox" name="delete_id[]" value="'.$i.'" />Delete</p>';
							if ($i!=1)
							{
								echo '<p><input type="radio" name="make_main" value="'.$i.'" />Make Main </p>';
							}
				echo'		</td>';
					
				
				echo '</tr>';
			 }
			 echo 
			 '</table>';
			
				
			 
			 
			 
			 echo'<p><input type="submit" value ="Apply" /></p>';
			   
			 echo '</form>';
		
			 
			 
			
			
			 
			 
			 
			
		}
		
	?>
	<hr/>
	<?php 
	
	if ($result_set < MAX_IMAGES)
	{
	echo '<form action="listing-images.php?listing_id='.$listing_id.'" method="post" enctype="multipart/form-data" >

	<table>
		<tr>
			<td ><input type="file" id="picture" name="picture" />
			<br/><input type="submit" value ="Upload" /></td>	
		</tr>
		
		
	</table>
	</form>';
	
	}
	
	?>
	</fieldset>

</div>

<?php 
include("templates/footer.php");
?>