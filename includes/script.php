<?php 





require_once 'constants.php';
require_once 'functions.php';
require_once 'db.php';
include 'names.php';
$number_of_iterations = 100;

$conn=db_connect();
$insert_user=pg_prepare($conn,"insert_user","insert into users values($1,$2,$3,$4,$5,$6)");
$insert_people=pg_prepare($conn,"insert_people","insert into people 
				(user_id,salutation,first_name,last_name,street_address_1,city,province,postal_code,primary_phone_number,fax_number,preffered_contact_method)  
					values($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11)");
					
					
$email_host=array("gmail","hotmail","yahoo","live");

for ($i = 1; $i <= $number_of_iterations; $i++)
{

//first random number to choose either male or female

$title = array('Mr','Ms','Mr','Miss','Mr','Mrs');

//return random value between 0 and 5
$max=sizeof($title);
$position = mt_rand (0,$max-1);

$current_title = $title[$position];

if($position%2 == 0)
{
	$position = mt_rand (0,sizeof($male_names)-1);
	$current_name = $male_names[$position];
	$current_lastname = $last_names[mt_rand(0,sizeof($last_names)-1)];
}
else
{
	$position = mt_rand (0,sizeof($female_names)-1);
	$current_name = $female_names[$position];
	$current_lastname = $last_names[mt_rand(0,sizeof($last_names)-1)];
}
	
// Make variable $current_userid by concatenating lastname + firstname
$current_userid = $current_lastname . $current_name;



//check if $current_userid is longer than the maximum field length of 20
$current_userid = substr($current_lastname, 0 ,19). $current_name[0];


//make array for the street name
$street_name = array('Alfred','Bay','Brock','Catherine','Dalhousie','Dufferin','Duke','Dundas','Elgin','Grey','King','Peel','Queen','Regent','Simcoe','Stanley','Victoria','Wellington','York');
$street_type = array('Acres','Bypass','Chase','Lane','Meadow','Parkway','Pass');
$town_suffixes = array('ville','burg','bridge','ton',' County' );
// 24 Alfred Chase AlferdVille, ONT L9P 1R1

$street_number = mt_rand (1,400);

$current_street_address = $street_number . ' ' . $street_name[mt_rand(0,sizeof($street_name)-1)] . ' ' . $street_type [mt_rand(0,sizeof($street_type)-1)];
$current_city = $current_lastname. $town_suffixes[mt_rand(0,sizeof($town_suffixes)-1)];

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

//General Statistics about Canada used for the province list
//http://geography.about.com/od/canadamaps/a/canadaprovincesterritories.htm


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


//current_primary_phone
$rand_area_code = mt_rand(200,999);
$rand_local_exchange = mt_rand(200,999);

$current_primary_phone = $rand_area_code . $rand_local_exchange . str_pad(mt_rand(0,9999),4,"0",STR_PAD_LEFT);

//area code, local exchange, dial sequence or subscription number

//preferred_contact_method
$contact_methods = array('p','p','p','p','p','p','p','p','p','p','e','e','e','e','e','e','e','e','e','e','l','l','l','l','l','l','l');
$current_prefered_contact_method = $contact_methods [mt_rand(0, sizeof($contact_methods)-1)];

//current fax number - only give them a fax number if they are an agent


//user type
$user_types = array('s','a','a','a','a','a','d','d','p','p','p','d','c','c','c','c','c','c','c','c','c','c','c','c','c','c','c');
$current_user_type = $user_types [mt_rand(0, sizeof($user_types)-1)];
/*
define("ADMIN_USERS", "s");
define("ACTIVE_AGENT_USERS", "a");
define("PENDING_AGENT_USERS", "p");
define("DISABLED_AGENT_USERS", "d");
define("INCOMPLETE_CLIENT_USERS", "i");
define("ACTIVE_CLIENT_USERS", "c");
*/

//make a random fax number if the user type is a (agent)
if ($current_user_type == 'a')
		$current_fax_number = $rand_area_code . $rand_local_exchange . str_pad(mt_rand(0,9999),4,"0",STR_PAD_LEFT);
else 
{
	$current_fax_number=NULL;
}
	
		
	
	
	
	
	
//Assign password variable to password for all users	
$current_password = 'password';


//Output for all information for the record

  $salutation=$current_title ;

  $first=ucfirst(strtolower($current_name)) ;

  $last=ucfirst(strtolower($current_lastname)) ;

  $user_id=strtolower($current_userid) ;

  $password=$current_password ;
  $street_address=$current_street_address ;
  $enrol_date=rand(1998,2013)."-".rand(1,12)."-".rand(1,30);
  $city=ucfirst(strtolower($current_city)) ;
  $province=$current_province ;
  $postal=$current_postal_code ;
  $phone_num=$current_primary_phone ;
//  $current_secondary_phone ;
if ($current_user_type == 'a')
		  $current_fax_number ;
		  
  $fax=$current_fax_number;	
  $user_type=$current_user_type ;
  $contact=$current_prefered_contact_method;
  $today=date('Y-m-d',time());
  $email=strtolower($first).".".strtolower($last)."@".$email_host[array_rand($email_host)].".com";



 pg_execute($conn,"insert_user",array($user_id,$password,$user_type,$email,$enrol_date,$today));
 pg_execute($conn,"insert_people",array($user_id,$salutation,$first,$last,$street_address,$city,$province,$postal,$phone_num,$fax,$contact));

}
?>
