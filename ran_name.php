<?php

require("includes/constants.php");
require("includes/db.php");
require("includes/functions.php");

class NameGenerator {

  private $_glue;

  public function __construct($glue = ' ') {

    $this->_first = array("Sarah", "Aaliyah", "Anna", "Arianna", "Ellie", "Steven", "Mary",
    "Merlin", "Martha", "Stewart", "Claire", "Shannon", "Michelle", "Chad", "Betty", "Heather",
    "Leona", "Mallory,", "David", "Larry", "Richard", "Damion", "Brandon", "Carl", "Amanda");
    
    $this->_last = array("Moore", "Martin", "Jackson", "Thompson", "White", "Young", "Hall",
    "Gallagher", "Way", "Fortini", "Giovani", "Fay", "Morgan", "Simpson", "Rutledge", "Stark",
    "Herring", "Fields", "Tyson", "Wagner", "Rivera", "Chambers", "Cash", "Hogan", "Weeks");
    
    $this->_glue = $glue;
  }
  
  function __destruct() {
  }

  public function first() {
    
    $first = $this->_first[array_rand($this->_first)];

    return $first;
  }
  public function last() {
    
    $last = $this->_last[array_rand($this->_last)];

    return $last;
  }
  

}


define("RECORDS",2);

$email_host=array("gmail","hotmail","yahoo","live");

$street=array("Alfred","Bay","Brock","Catherine","Dalhousie","Dufferin","Duke","Dundas"
		,"Elgin","Grey","King","Peel","Queen","Regent","Simcoe","Stanley","Victoria","Wellington","York");
		
$directions=array("w","w","w","w","w","w","w","w","e","e","e","e","e","e","e","e");

$city=array("Oshawa","Ajax","Brooklin","Bowmanville","Pickering","Port Perry","Whitby");

$salutation=Array("Mr","Mr","Mr","Mr","Mr","Mr","Mrs","Mrs","Mrs","Mrs","Mrs","Mrs","Miss","Ms","Dr","Prof","Rev");

$user_type=array("p","a","c","s","p","p","p","p","p","p","a","a","a","a","a","a","a","s","s");

$postal_letters=array("A","B","C","E","F","G","H","J","K","L","M","N","P","R","S","T","V","X","Y");

$province=array('AB','BC',"MB",'NB','NF','NS','NT','NU','ON','PE','PQ','SK','YT');

$prefered_contact=array("P","P","P","P","E","E","E","E","E","E","M");

function make_postal($array)
{
	$postal_code=$array[array_rand($array)].rand(1,9).$array[array_rand($array)].rand(1,9).$array[array_rand($array)].rand(1,9);
	return $postal_code;
}
$conn=db_connect();
$insert_user=pg_prepare($conn,"insert_user","insert into users values($1,$2,$3,$4,$5,$6)");
$insert_people=pg_prepare($conn,"insert_people","insert into people 
				(user_id,salutation,first_name,last_name,street_address_1,city,province,postal_code,primary_phone_number,preffered_contact_method)  
					values($1,$2,$3,$4,$5,$6,$7,$8,$9,$10)");

function get_random($array)
{
	return $array[array_rand($array)];
}

for ($i=1;$i<RECORDS;$i++)
{
	 
	 $password="password";
	 
	 $today=date('Y-m-d',time());
	 
	 $salutations=get_random($salutation);
	 
	 $enrol_date=rand(1998,2014)."-".rand(1,12)."-".rand(1,31);
	 
	 $obj=new NameGenerator();
	 
	 $first=$obj->first();
	 
	 $last=$obj->last();
	 
	 $user_id=strtolower($first[0]).strtolower($last);
	 
	 $street_name=get_random($street);;
	 
	 $direction=get_random($directions);
	 
	 $street_address=$street_name." Street ".$direction;
	 
	 $contact=get_random($prefered_contact);
	 
	 $phone_num=(mt_rand()%800+200).(mt_rand()%800+200).str_pad(mt_rand()%10000,4,"0",STR_PAD_LEFT);
	 
	 $user_city=get_random($city);
	 
	 $provinces=get_random($province);
	 
	 $users_type=get_random($user_type);
	 
	 $postal=make_postal($postal_letters);
	 
	 $email=strtolower($first).".".strtolower($last)."@".$email_host[array_rand($email_host)].".com";
	 
	 pg_execute($conn,"insert_user",array($user_id,$password,$users_type,$email,$enrol_date,$today));
	 
	 pg_execute($conn,"insert_people",array($user_id,$salutations,$first,$last,$street_address,$user_city,$provinces,$postal,$phone_num,$contact));
	 
}




?>