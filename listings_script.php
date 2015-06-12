<?php 
$title="Listing Script";
include("templates/header.php");

$conn=db_connect();
$sql="select user_id from  users where user_type='a'";
$result=pg_query($conn,$sql);
$result_set=pg_fetch_all($result);


function random($array)
{
	return $array[array_rand($array)];
}

$price=rand(25000,1000000);
$bathrooms=array(1,2,4,8);
$bedrooms=array(1,2,4,8);
$sale_status=array(1,2,4);
$listing_view=array(1,2,4,8,16,32);
$listing_material=array(1,2,4);	
$listing_type=array(1,2,4,8,16,32,64);
$stories=array(1,2,4,8);
$city=array(1,2,4,8,16,32,64);
$property_options=array(1,2,4,8,16);

$province_list = array('ON','ON','ON','ON','ON','ON','ON','ON','ON','ON','ON','ON',
'ON','QB','QB','QB','QB','QB','QB','QB','QB','BC','BC','BC','BC','AB','AB','AB','AB',
'MB','SK','NB','NL');

$current_province = $province_list [rand (0,sizeof($province_list)-1)];

$nl_code = 'A';
$nb_code = 'E';
$qb_code = array('G','H','J');
$on_code = array('K','L','M','N','P');
$mb_code = 'R';
$sk_code = 'S';
$ab_code = 'T';
$bc_code = 'V';

$postal_valid_letters = array('A','B','C','E','G','H','J','K','L',
		'M','N','P','R','S','T','V','W','X','Y','Z');


//To return back the proper first character in the postal code, dependent on the province
if($current_province[0] == 'O')
 $current_postal_code = $on_code[mt_rand(0,sizeof($on_code)-1)] ;

if($current_province[0] == 'Q')
 $current_postal_code = $qb_code[mt_rand(0,sizeof($qb_code)-1)];

if($current_province[0] == 'B')
 $current_postal_code = $bc_code; 

if($current_province[0] == 'A')
 $current_postal_code = $ab_code; 

if($current_province[0] == 'M')
 $current_postal_code = $mb_code; 

if($current_province[0] == 'S')
 $current_postal_code = $sk_code; 

if($current_province == 'NB')
 $current_postal_code = $nb_code; 

if($current_province == 'NL')
 $current_postal_code = $nl_code;

//final construction of the postal code
$current_postal_code = $current_postal_code . $random_number = mt_rand(0,9) . $postal_valid_letters [mt_rand(0,sizeof($postal_valid_letters)-1)]. $random_number = mt_rand(0,9) . $postal_valid_letters [mt_rand(0,sizeof($postal_valid_letters)-1)]. $random_number = mt_rand(0,9);


$conn=db_connect();
pg_prepare($conn,"listing_insert","insert into listings(user_id,status,price,headline,description,postal_code,city,province,property_options,bedrooms,
		bathrooms,listing_type,listing_stories,listing_date,listing_view,listing_material,listing_sale_status)
		values ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17)");
		

$letters=array("1","2","24","w","r","d","e","yy","kk","dw","yjg","wed","wd","qs");
 
 function props($table,$value)
{
	global $conn;
	
	$sql="select property,value from $table where value=$value";
	
	$result=pg_query($conn,$sql);
	
	
	
	
	return pg_fetch_result($result,'property');
}

 for ($i=0;$i<400;$i++)
 {
	 //$current_postal_code = $current_postal_code . $random_number = mt_rand(0,9) . $postal_valid_letters [mt_rand(0,sizeof($postal_valid_letters)-1)]. $random_number = mt_rand(0,9) . $postal_valid_letters [mt_rand(0,sizeof($postal_valid_letters)-1)]. $random_number = mt_rand(0,9);
$province_list = array('ON','ON','ON','ON','ON','ON','ON','ON','ON','ON','ON','ON',
'ON','QB','QB','QB','QB','QB','QB','QB','QB','BC','BC','BC','BC','AB','AB','AB','AB',
'MB','SK','NB','NL');

$current_province = $province_list [rand (0,sizeof($province_list)-1)];

$nl_code = 'A';
$nb_code = 'E';
$qb_code = array('G','H','J');
$on_code = array('K','L','M','N','P');
$mb_code = 'R';
$sk_code = 'S';
$ab_code = 'T';
$bc_code = 'V';

$postal_valid_letters = array('A','B','C','E','G','H','J','K','L',
		'M','N','P','R','S','T','V','W','X','Y','Z');


//To return back the proper first character in the postal code, dependent on the province
if($current_province[0] == 'O')
 $current_postal_code = $on_code[mt_rand(0,sizeof($on_code)-1)] ;

if($current_province[0] == 'Q')
 $current_postal_code = $qb_code[mt_rand(0,sizeof($qb_code)-1)];

if($current_province[0] == 'B')
 $current_postal_code = $bc_code; 

if($current_province[0] == 'A')
 $current_postal_code = $ab_code; 

if($current_province[0] == 'M')
 $current_postal_code = $mb_code; 

if($current_province[0] == 'S')
 $current_postal_code = $sk_code; 

if($current_province == 'NB')
 $current_postal_code = $nb_code; 

if($current_province == 'NL')
 $current_postal_code = $nl_code;

//final construction of the postal code
     $current_postal_code = $current_postal_code . $random_number = mt_rand(0,9) . $postal_valid_letters [mt_rand(0,sizeof($postal_valid_letters)-1)]. $random_number = mt_rand(0,9) . $postal_valid_letters [mt_rand(0,sizeof($postal_valid_letters)-1)]. $random_number = mt_rand(0,9);
	 $bath=random($bathrooms);
	 $bed=random($bedrooms);
	 $sale=random($sale_status);
	 $view=random($listing_view);
	 $material=random($listing_material);
	 $type=random($listing_type);
	 $story=random($stories);
	 $citi=random($city);
	 $option=random($property_options);
	 $province=random($province_list);
     $price=rand(25000,1000000);
	
	 
	 $headline="Listing In ".props("cities",$citi)." On ".$current_postal_code;
	 $agent = random($result_set);
	 $description="This is a ".props("listing_type",$type)." located in the city of ".props("cities",$citi)."
					in the province of ".$province." .This listing is for ".props("listing_sale_status",$sale)." at the price of $".number_format($price)." the listing has ".props("listing_bathrooms",$bath)." Bathrooms and ".props("listing_bedrooms",$bed)." Bedrooms";
	 $user_id=$agent['user_id'];
	 pg_execute("listing_insert",array($user_id,LISTING_SOLD,$price,$headline,$description,$current_postal_code,$citi,$province,$option,$bed
		,$bath,$type,$story,"2014-11-25",$view,$material,$sale));
 }

include("templates/footer.php");	
?>