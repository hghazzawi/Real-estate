<?php 

$conn = db_connect();

function db_connect() 
{
$conn=pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD."" ); 
return $conn; 
}

function is_user_id($user_name)
{
	global $conn;
	
	$user_exist=pg_prepare($conn,"query","select*from users where user_id=$1");
    $result=pg_execute($conn,"query",array("$user_name"));
	
	if (pg_num_rows($result)==1)
	{
		return true;
	}
	else 
	{
		return false;
	}
}
function build_label($table, $included, $delimit = ",")
{
	global $conn;
	$label = "";
	$sql = "SELECT value, property FROM $table";
	$result = pg_query($conn, $sql);
	$i = 0;
	while($i < pg_num_rows($result))
	{
		$label .= (pg_fetch_result($result, $i, "value") & $included)?pg_fetch_result($result, $i, "property").$delimit:"";
		$i++;
	}
	$label = (strlen($label) > 0)? substr($label, 0, strlen($label) - strlen($delimit)):"";
	return $label;
}

function search_label($table, $included, $delimit = ",")
{
	global $conn;
	$label = "";
	$sql = "SELECT value, property FROM $table";
	$result = pg_query($conn, $sql);
	$i = 0;
	while($i < pg_num_rows($result))
	{
		$label .= (pg_fetch_result($result, $i, "value") & $included)?pg_fetch_result($result, $i, "value").$delimit:"";
		$i++;
	}
	$label = (strlen($label) > 0)? substr($label, 0, strlen($label) - strlen($delimit)):"";
	return $label;
}

function build_simple_dropdown($table,$query_name,$preselected="")
{
	global $conn;
	
	$q=pg_prepare($conn,$query_name,"select* from $table");
	$dropdown="\n <select style='height:30px;border: 1px solid;width: 125px;' name='".$table."' id='".$table."' >";
	$result=pg_execute($conn,$query_name,array());
	
	for ($i=0;$i < pg_num_rows($result);$i++)
	{
		$value=pg_fetch_result($result,$i,'value');
		$selected = ($preselected == $value)?
					"selected='selected'":
					"";
		$dropdown.="\n\t <option value='".$value."' ".$selected.">".$value."</option>";
		
	}
	
	$dropdown.="\n</select>";
	
	return $dropdown;
}

function build_dropdown($table,$query_name,$preselected="")
{
	global $conn;
	
	$q=pg_prepare($conn,$query_name,"select property,value from $table");
	$dropdown="\n <select style='height:30px;border: 1px solid;width: 200px;' name='".$table."' id='".$table."' >";
	$result=pg_execute($conn,$query_name,array());
	
	for ($i=0;$i < pg_num_rows($result);$i++)
	{
		$value=pg_fetch_result($result,$i,'value');
		$selected = ($preselected == $value)?
					"selected='selected'":
					"";
		$property =pg_fetch_result($result, $i, 'property');
		$dropdown.="\n\t <option value='".$value."' ".$selected.">".$property."</option>";
		
	}
	
	$dropdown.="\n</select>";
	
	return $dropdown;
}

function build_radio($table,$query_name,$prechecked="")
{
	global $conn;
	$q=pg_prepare($conn,$query_name,"select property,value from $table");
	$radio="";
	$result=pg_execute($conn,$query_name,array());
	
	for ($i=0;$i < pg_num_rows($result);$i++)
	{
		$value=pg_fetch_result($result,$i,'value');
		$checked = ($prechecked == $value)?
					"checked='checked'":
					"";
		$property =pg_fetch_result($result, $i, 'property');
		
		$radio.="\n <input style='height:20px;width:20px;' type='radio' name='".$table."'  value='".$value."' ".$checked." />".$property;
		
	}
	
	return $radio;
}

function build_checkbox($table,$query_name,$prechecked="")
{
	global $conn;
	$q=pg_prepare($conn,$query_name,"select property,value from $table");
	$checkbox="";
	$result=pg_execute($conn,$query_name,array());
	
	for ($i=0;$i<pg_num_rows($result);$i++)
	{
		$value=pg_fetch_result($result,$i,'value');
		$checked = (isBitSet($i,$prechecked))?
					" checked='checked'":
					"";
		$property=pg_fetch_result($result,$i,'property');
		$checkbox.="\n<p><input style='height:20px;width:20px;border-style:none;' type='checkbox' name='".$table."[]' value='".$value."' ".$checked." />".$property."</p>";
	}
	return $checkbox;
}


function get_property($table,$query,$value)
{
	global $conn;
	
	$q=pg_prepare($conn,"$query","select property,value from $table where value=$value");
	
	$result=pg_execute($conn,"$query",array());
	
	
	return pg_fetch_result($result,'property');
}

function get_simple_property($table,$query,$value)
{
	global $conn;
	
	$q=pg_prepare($conn,"$query","select * from $table where value=$value");
	
	$result=pg_execute($conn,"$query",array());
	
	
	return pg_fetch_result($result,'property');
}

function property($table,$value)
{
	global $conn;
	
	$q="select property,value from $table where value=$value";
	$result=pg_query($conn,$q);
	return pg_fetch_result($result,'property');
}





?>