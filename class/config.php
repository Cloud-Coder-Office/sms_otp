
<?php
	$host = "localhost";
	$user = "root";                                 
	$password = "";                              
	$database = "sms_otp";                       
	$conn = mysql_connect($host,$user,$password);
	if($conn){
		$db_select = mysql_select_db($database,$conn);
		if(!$db_select){
			 die("Connection failed: " .mysql_error());
		}
	}
	else{
		 die("Database connection failed");
	} 
?>