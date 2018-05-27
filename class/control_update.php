<?php
	require_once('config.php'); // This is mysql connection
	
	function update_agent($up_id,$user_name,$pass,$one_way,$sms_capacity,$alert){
		
		$sql = "UPDATE user SET name='$user_name',password='$pass', one_way='$one_way', user_capacity = '$sms_capacity', alert = '$alert' WHERE id = '$up_id'";
		$query = mysql_query($sql) or die (mysql_error());
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	
	function update_route($up_id,$route_name,$route_capacity,$alert){
		
		$sql = "UPDATE route_api SET route_name='$route_name', route_capacity ='$route_capacity', alert = '$alert' WHERE route = '$up_id'";
		$query = mysql_query($sql) or die (mysql_error());
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	function update_route_capacity($up_id,$route_name,$route_capacity,$count){
		
		$sql = "UPDATE user_route_api SET route_id='$route_name', capacity ='$route_capacity', count='$count' WHERE id = '$up_id'";
		$query = mysql_query($sql) or die (mysql_error());
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	function update_contract($up_id,$name,$phone){
		
		
		$fileName = $_FILES['picture']['name'];
		$size = $_FILES['picture']['size'];
		$type = $_FILES['picture']['type'];
		$tmp = $_FILES['picture']['tmp_name'];
		
		if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/png" || $type == "image/gif" and $size <= 50480){
		//$image_type=explode("/",$type);
		
		//$image_name=$name .'_' . $phone .'.'. $image_type[1];
		$sql = "UPDATE user_control SET picture = '$fileName' WHERE id = '$up_id' and name='$name' and phone='$phone'";
		$query = mysql_query($sql) or die(mysql_error());
		$destination = "../profile_picture/";
		move_uploaded_file($tmp, $destination . $fileName);
	    }
		if($query){
			return true;
		}else{
			return false;
		}
	}

?>