<?php
	if(isset($_GET['submit'])){
		require_once('Database.php'); // This is mysql connection
		
		//$user_name = $_GET['adminid'];
		$user         = $_GET['user_name'];
		$user_name    = mysql_real_escape_string($user);
		$pass         = $_GET['password'];
		$password     = mysql_real_escape_string($pass);
		$token        = $_GET['access_token'];
		$access_token = mysql_real_escape_string($token);
		
		 $sql   = "UPDATE create_account SET status = '0' WHERE user_name = '$user_name' AND password ='$password' AND access_token = '$access_token'";
		 $query = mysql_query($sql) or die (mysql_error());
		 if($query = true){
			 
			 $success = array();
			 $status  =  'Success';
			 $success[] = array('Inactive'=>$status);
			 echo json_encode($success);
			// echo $return;
		 }
		}
		else
		{ 
	
	    }
	
	
?>
