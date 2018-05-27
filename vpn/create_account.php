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
		
		 $sql   = "INSERT INTO create_account(user_name,password,access_token,status) VALUES ('$user_name','$password','$access_token','1')";
		 $query = mysql_query($sql) or die (mysql_error());
		 if($query = true){
			 
			 $success = array();
			 
			 $success[] = array('user_name'=>$user_name,'password'=>$password,'access_token'=>$access_token);
			 echo json_encode($success);
			// echo $return;
		 }
		}
		else
		{ 
	
	    }
	
	
?>
