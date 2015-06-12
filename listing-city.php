<?php
$title="Search City";
 include("templates/header.php"); 
 $city = (isset($_COOKIE['city']))?$_COOKIE['city']:"";

 
if ( $_SERVER["REQUEST_METHOD"] == "POST")
{
	
	$_SESSION['city']=sumCheckBox($_POST['cities']);
	if($_SESSION['city'] > 0)
	{
		header("Location: listing-search.php");
		ob_flush();
	}else{
		$message = "You must select at least one city to be searched.";
	}
	
	
}
?>
<div style="width:60%" id="login">
<table>
<tr>
<td>
	<img  src="images/map.png" style="border:0;width:700px;height:567px;orgWidth:700px;orgHeight:567px" usemap="#image-maps-2014-11-02-163352" alt="" />
	<map name="image-maps-2014-11-02-163352" id="ImageMapsCom-image-maps-2014-11-02-163352">
	<area  alt="Pickering" title="" href="./listing-search.php?city=16" shape="rect" coords="92,350,185,407" style="outline:none;"      />
	<area  alt="Oshawa" title="" href="./listing-search.php?city=8" shape="rect" coords="246,360,298,471" style="outline:none;"      />
	<area  alt="Whitby" title="" href="./listing-search.php?city=64" shape="rect" coords="186,355,243,398" style="outline:none;"      />
	<area  alt="Brooklin" title="" href="./listing-search.php?city=2" shape="rect" coords="189,391,246,440" style="outline:none;"      />
	<area  alt="Bowmanville" title="" href="./listing-search.php?city=4" shape="rect" coords="347,460,429,478" style="outline:none;"      />
	<area  alt="Port Perry" title="" href="./listing-search.php?city=32" shape="rect" coords="211,291,293,309" style="outline:none;"     />
	<area  alt="Ajax" title="" href="./listing-search.php?city=1" shape="rect" coords="145,411,190,473" style="outline:none;"     />
	<area shape="rect" coords="698,565,700,567" alt="Image Map" style="outline:none;" title="Image Map" href="" />
	</map>
</td>

<td>
	<script type="text/javascript">
	
	<!--
				function toggle(source)
				{
					checkboxes = document.getElementsByName('cities[]');
					for(i = 0; i < checkboxes.length; i++)
					{
						checkboxes[i].checked = source.checked;
					}
				}
			
		
	//-->
	</script>
	<p>Select City to Search</p>
	<h3><?php echo $message; ?></h3>
	<form action="" method="post">
	
		<p><input style="height:20px;width:20px;border-style:none;" type="checkbox"  onclick="toggle(this);" name="cities[]" value="0" />Select All</p>
		<?php echo build_checkbox("cities", "city_check_box", $city); ?>
		<p><br/></p>
		<p><input type="submit" value="Submit" /></p>
	</form>
	
	
</td>
</tr>
</table>
</div>
 
<?php include("templates/footer.php"); ?>