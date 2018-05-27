<?php
$phones = array( '8801812597637', '8801921345016','8801711050808' );

// get your list of country codes
$ccodes = array(
    '88018' => 'Robi',
    '88017' => 'GP',
    '88019' => 'BL'
    
);

krsort( $ccodes );

/* foreach( $phones as $pn )
{
    foreach( $ccodes as $key=>$value )
    {
        if ( substr( $pn, 0, strlen( $key ) ) == $key )
        {
            // match
            $country[$pn] = $value;
            break;
        }
    }
} */
$number = explode(", " , $phones[0]);
for($i =0; $i< sizeof($number); $i++){
	
	$result = $number[$i];
	
	echo "<br>";
	$str =  substr("$result", 0,5);
	if($str == 88018){
		echo "ROBI";
		
	} 
	if($str == 88019){
		echo "BL";
		
	}
	if($str == 88017){
		echo "GP";
		
	}
	print_r($result);
	
	}

	//echo substr("8801921345016", 8);
	

echo "<br>";
//print_r($sub_str );


?>
