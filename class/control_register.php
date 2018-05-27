<?php
	require_once('class/config.php'); // This is mysql connection
	
	function register_agent($name,$pass,$one_way,$sms_capacity,$alert){
		$sql = "INSERT INTO user (name,password,one_way,user_capacity,alert) 
		VALUES ('$name','$pass','$one_way','$sms_capacity','$alert')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	function register_otp_message($incomming_string,$outgoing_string){
		
		$sql = "INSERT INTO otp_string (incomming_string,outgoing_string,status) VALUES ('$incomming_string','$outgoing_string','1')";
		$query = mysql_query($sql);
		
		if($query) {
			
			return true;
		}else {
			return false ;
		}
		
		
	}
	
	function register_route($route_name,$route_capacity,$alert){
		$sql = "INSERT INTO route_api (route_name,route_capacity,alert) 
		VALUES ('$route_name','$route_capacity','$alert')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	
	function assign_route($user_id,$route_id){
		

		for ($i = 0; $i < count($route_id); $i++) {

			//$route_ids = $route_id[$i];

			$sql = "INSERT INTO user_route_api (user_id, route_id) VALUES ('$user_id','$route_id[$i]')";
			$query = mysql_query($sql) or die (mysql_error());
			if($query){
				return true;
			}else{
				return false;
			}
			
		}
	
	}
	
	function register_contract($agent_id,$name,$phone,$website,$description,$progress,$date,$status=1){
		$sql = "INSERT INTO add_contract(agent_id, name, phone, website, description, progress, date, status) 
		VALUES ('$agent_id', '$name', '$phone', '$website', '$description', '$progress', '$date', '$status')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function register_allocate($name,$agent_id,$u_id,$status=0){
		$sql = "INSERT INTO add_allocate(agent_name, agent_id, u_id, status) 
		VALUES ('$name', '$agent_id', '$u_id', '$status')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function register_item($u_id,$division,$district,$sub_district,$area,$status=0){
		$sql = "INSERT INTO add_item(u_id, division, district, sub_district, area, status) 
		VALUES ('$u_id', '$division', '$district', '$sub_district', '$area', '$status')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function register_district($dv_id,$name,$status=1){
		$sql = "INSERT INTO `district_list`(dv_id, district_name, status) 
		VALUES ('$dv_id', '$name', '$status')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	
	}
	function register_division($name){
		$sql = "INSERT INTO division_list(dv_name, status) VALUES ('$name', '1')";
		$query = mysql_query($sql) or die(mysql_error());
		if($query){
			return true;
		}else{
			return false;
		}	
	}
	function register_sub_district($dv_id,$district_id,$name,$status=1){
		$sql = "INSERT INTO sub_district(dv_id, district_id, sub_district_name, status) 
		VALUES ('$dv_id', '$district_id', '$name', '$status')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	}	
	function register_branch($name,$upz_id,$status=0){
		$sql = "INSERT INTO branch(name, upzela_id, status)
		VALUES ('$name', '$upz_id', '$status')";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
?>