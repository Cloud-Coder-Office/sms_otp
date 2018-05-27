<?php
	require_once('config.php'); // This is mysql connection
	
	function valid_route_by_user($user_id){
		$sql = "SELECT * FROM  user_route_api WHERE user_id = $user_id AND route_id = '1' AND route_id = '2'";
			$query = mysql_query($sql) or die(mysql_error()) ;
			
			$row = mysql_num_rows($query) ;
			if($row > 0){
				return false;
			}else{
				return true;
			}
		}
	function valid_agent_by_id($user_name){
		
		if(empty($user_name)){
			return false;
		}
		else{
		return true;
		}
	}
	
	function valid_ot_message ($incomming_string) {
		
		if(empty($incomming_string)){
			return false;
		}
		else{
		$sql = "SELECT * FROM  otp_string WHERE incomming_string = '$incomming_string'";
		$query = mysql_query($sql);
		$row = mysql_num_rows($query);
		if($row<=0){
			return true;
		}else{
			return false;
		}
		}
	}
	
	function valid_route_by_id($route_name,$route_capacity){
		
	if(empty($route_name) || empty($route_capacity)){
			return false;
		}
		else{
		return true;
		}
	}
	
	function valid_capacity_by_user_id($route_id,$capacity){
		
	if(empty($route_id) || empty($capacity)){
			return false;
		}
		else{
		return true;
		}
	}
	
	function valid_contract($number){
		if(empty($number)){
			return false;
		}
		else{
		$sql = "SELECT * FROM  add_contract WHERE phone = '$number'";
		$query = mysql_query($sql);
		$row = mysql_num_rows($query);
		if($row<=0){
			return true;
		}else{
			return false;
		}
		}
	}
        
        
        function valid_agent($agent_name){
		if(empty($agent_name)){
			return false;
		}
		else{
		$sql = "SELECT * FROM  user WHERE name = '$agent_name'";
		$query = mysql_query($sql);
		$row = mysql_num_rows($query);
		if($row<=0){
			return true;
		}else{
			return false;
		}
		}
	}
	
	 function valid_route($route_name){
		if(empty($route_name)){
			return false;
		}
		else{
		$sql = "SELECT * FROM  route_api WHERE route_name = '$route_name'";
		$query = mysql_query($sql);
		$row = mysql_num_rows($query);
		if($row<=0){
			return true;
		}else{
			return false;
		}
		}
	}
	/*function valid_contract($agent_id, $name, $phone, $website, $description){
		if(empty($agent_id)||empty($name)||empty($phone)||empty($website)||empty($description)==0){
			return false;
		}else{
			return true;
		}
	}
      
	/*--------------------------------------*/
        
        function valid_branch($name,$upz_id){
		$sql = "SELECT * FROM  branch WHERE name = '$name' AND upzela_id = '$upz_id'";
		$query = mysql_query($sql);
		$row = mysql_num_rows($query);
		if($row<=0){
			return true;
		}else{
			return false;
		}
	}
?>