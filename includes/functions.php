<?php 

function paginate($reload, $page, $tpages) {
    $adjacents = 2;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<li><span>" . $prevlabel . "</span></li>\n";
    } elseif ($page == 2) {
        $out.= "<li><a  href=\"" . $reload . "\">" . $prevlabel . "</a>\n</li>";
    } else {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page - 1) . "\">" . $prevlabel . "</a>\n</li>";
    }
  
    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li  class=\"active\"><a href=''>" . $i . "</a></li>\n";
        //} elseif ($i == 1) {
        //    $out.= "<li><a  href=\"" . $reload . "\">" . $i . "</a>\n</li>";
        } else {
            $out.= "<li><a  href=\"" . $reload . "&amp;page=" . $i . "\">" . $i . "</a>\n</li>";
        }
    }
    
    if ($page < ($tpages - $adjacents)) {
        $out.= "<li><a style='font-size:11px' href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $tpages . "</a></li>\n";
    }
    // next
    if ($page < $tpages) {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page + 1) . "\">" . $nextlabel . "</a>\n</li>";
    } else {
        $out.= "<li><span style='font-size:11px'>" . $nextlabel . "</span></li>\n";
    }
    $out.= "";
    return $out;
}


function validate_length($string, $min, $max ) {

    $l = strlen($string);
    return ($l >= $min && $l <= $max);
}


/**
  * Checks if there are 7 or 10 numbers, if so returns cleaned parameter(no formating just numbers)
  * other wise it will return false 
  * $phone is the phone number
  * $ext if set to true return an array with extension separated
  **/
  function isPhone($phone, $ext = false) {
 
    //remove everything but numbers
    $numbers = preg_replace("%[^0-9]%", "", $phone );
 
    //how many numbers are supplied
    $length = strlen($numbers);
 
    if ( $length == 10 || $length == 7 ) { 
 
      $cleanPhone = $numbers;
 
      if ( $ext ) {
        $clean['phone'] = $cleanPhone;
        return $clean;
      } else {
        return $cleanPhone;
      }
 
    } elseif ( $length > 10 ) { //must be extension
 
      //checks if first number is 1 
      if ( substr($numbers,0,1 ) == 1 ) {
        $clean['phone'] = substr($numbers,0,11);
        $clean['extension'] = substr($numbers,11);
      } else {
        $clean['phone'] = substr($numbers,0,10);
        $clean['extension'] = substr($numbers,10);
      }
 
      if (!$ext) { //return string
 
        if (!empty($clean['extension'])) {
          $clean = implode("x",$clean);
        } else {
          $clean = $clean['phone'];
        } 
 
        return $clean;
 
 
      } else { //return array
 
        return $clean;
      }
    } 
 
    return false;
 
  }

function display_copyright()
{
echo "Copyright &copy; ".date('Y')." Listed.com";
}


function display_phone_number($num)
{
	if(!is_numeric($num))
	{
		return "Invalid Phone Number";
	}

	$num = preg_replace('/[^0-9]/', '', $num);
	 
	$len = strlen($num);

	if($len == 14)
	{
		$num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3 ext. $4', $num);
	}
	else if($len == 10)
	{
		$num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $num);
	}
	else 
	{
		return "invalid";
	}
	
	return $num;
}

function dump($arg)
{
	 echo "<pre>";
	 print_r($arg);
	 echo "</pre>";
}
 
 
 

 /**
  * Canadian Postal code
  * thanks to: http://roshanbh.com.np/2008/03/canda-postal-code-validation-php.html
  **/
function is_valid_postal_code($postal) 
{

    $pattern = "/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i";
 
    //remove spaces
    $postal = str_replace(' ', '', $postal);
 
    if ( preg_match( $pattern , $postal ) ) 
	{
      return $postal;
    } 
	else 
	{
      return false;
    }
 
  }
  
/*
	this function should be passed a integer power of 2, and any decimal number,
	it will return true (1) if the power of 2 is contain as part of the decimal argument
*/
function isBitSet($power, $decimal) {
	if((pow(2,$power)) & ($decimal)) 
		return 1;
	else
		return 0;
} 

/*
	this function can be passed an array of numbers (like those submitted as 
	part of a named[] check box array in the $_POST array).
*/
function sumCheckBox($array)
{
	$num_checks = count($array); 
	$sum = 0;
	for ($i = 0; $i < $num_checks; $i++)
	{
	  $sum += $array[$i]; 
	}
	return $sum;
}
  


?>