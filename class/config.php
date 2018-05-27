
<?php
	$host = "localhost";
	$user = "root";                                 
	$password = "";                              
	$database = "sms_otp";
    $con = mysqli_connect("localhost",$user,$password,$database);

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>