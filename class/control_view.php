<?php
	require_once('config.php'); // This is mysql connection

	
	function view_agent($con){
	   $sql = "SELECT * FROM user  ORDER BY id ASC";
						  
		$query = mysqli_query($con,$sql);
		return $query;
	}

	function view_otp_message($con){
	   $sql = "SELECT * FROM otp_string  ORDER BY id ASC";

		$query = mysqli_query($con,$sql);
		return $query;
	}

	function view_agent_details($con){
	   $sql = "SELECT user.id,user.name,user.one_way,user.user_capacity,user_route_api.user_id,SUM(user_route_api.total_send) as user_total_send FROM user INNER JOIN user_route_api ON user.id = user_route_api.user_id";

		$query = mysqli_query($con,$sql);
		return $query;
	}

	function view_route_details($con){
	   $sql = "SELECT route_api.route, route_api.route_name,route_api.route_capacity,route_api.alert,user_route_api.route_id, user_route_api.total_send,SUM(user_route_api.total_send) AS total_send FROM `route_api` INNER JOIN user_route_api ON route_api.route = user_route_api.route_id";

		$query = mysqli_query($con,$sql) or die (mysqli_error());
		return $query;
	}

	function view_agent_by_id($con,$id){

		$sql = "SELECT * FROM user WHERE id = $id";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($query);
		return $row;
	}

	function view_route_by_id($con,$id){

		$sql = "SELECT * FROM route_api WHERE route = $id";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($query);
		return $row;
	}

	function view_route($con){
	   $sql = "SELECT route,route_name,route_capacity,alert FROM route_api  ORDER BY route ASC";

		$query = mysqli_query($con,$sql) or die (mysqli_error());
		return $query;
	}

	function assign_route_capacity($con){
		$sql = "SELECT  user_route_api.user_id,user_route_api.status, user.name, route_api.route, route_api.route_name , route_api.route_capacity, user_route_api.id,user_route_api.capacity, user_route_api.total_send,user_route_api.user_id FROM user INNER JOIN user_route_api ON user.id =user_route_api.user_id INNER JOIN route_api ON user_route_api.route_id = route_api.route";
		$query = mysqli_query($con,$sql) or die (mysqli_error());
		return $query;
	}

/* 	function view_route_capacity_by_Id(){
		$sql = "SELECT  user_route_api.user_id,user_route_api.status, user.name, route_api.route, route_api.route_name , route_api.route_capacity, user_route_api.id,user_route_api.capacity, user_route_api.total_send,user_route_api.user_id FROM user INNER JOIN user_route_api ON user.id =user_route_api.user_id INNER JOIN route_api ON user_route_api.route_id = route_api.route WHERE user_route_api.user_id = $search";
		$query = mysqli_query($con,$sql) or die (mysqli_error());
		return $query;
	} */

	function view_route_capacity($con,$up_id){
		$sql = "SELECT  user_route_api.user_id,user_route_api.status, user.name, route_api.route, route_api.route_name , route_api.route_capacity, user_route_api.id,user_route_api.capacity, user_route_api.total_send,user_route_api.user_id FROM user INNER JOIN user_route_api ON user.id =user_route_api.user_id INNER JOIN route_api ON user_route_api.route_id = route_api.route WHERE user_route_api.id = $up_id";
		$query = mysqli_query($con,$sql) or die (mysqli_error());
		return $query;
	}

	function view_contract_by_id($con,$id){
		$sql = "SELECT name, ssc, picture FROM  user_control WHERE id = '$id'";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($query);
		return $row;
	}
	
	function total_report($con){
		$sql = "SELECT COUNT(phone_no) AS total FROM message_report";
		$query = mysqli_query($con,$sql)or die (mysqli_error());
		
		return $query;
	}
	
	function daily_report($con){
		$sql = "SELECT COUNT(message_report.phone_no) AS yestarday FROM message_report WHERE date > DATE_SUB(NOW(), INTERVAL 1 DAY)";
		$query = mysqli_query($con,$sql)or die (mysqli_error());
		
		return $query;
	}
	function view_last_week($con){
		$sql = "SELECT COUNT(message_report.phone_no) AS week FROM message_report WHERE date > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
		$query = mysqli_query($con,$sql)or die (mysqli_error());
		
		return $query;
	}
	function view_last_month($con){
		$sql = "SELECT COUNT(message_report.phone_no) AS month FROM message_report WHERE date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
		$query = mysqli_query($con,$sql)or die (mysqli_error());
		
		return $query;
	}
	
	
	
?>