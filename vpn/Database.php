
<?php
	$host = "localhost";
	$user = "helloxyz_SMSAPI";                                
	$password = "(GOTT)ut@rIw";                               
	$database = "helloxyz_2gatewayAPI";                      
	$conn = mysql_connect($host,$user,$password);
	if($conn){
		$db_select = mysql_select_db($database,$conn);
		if(!$db_select){
			 die("Connection failed: " .mysql_error());
		}
	}
	else{
		 die("Database connection failed: " .mysql_error());
	} 
?>