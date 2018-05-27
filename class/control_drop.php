<?php
	require_once('config.php'); // This is mysql connection
	
	function drop_agent_by_id($id){
		$sql = "DELETE FROM add_agent WHERE id = $id";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}		
	}	
	function drop_allocate_by_id($id){
		$sql = "DELETE FROM  add_allocate WHERE id = $id";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	}
	function drop_item_by_id($id){
		$sql = "DELETE FROM  add_item WHERE id = $id";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	}
	function drop_land_mark_by_id($id){
		$sql = "DELETE FROM  add_contract WHERE id = $id";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	}
	function drop_division_by_id($id){
		$sql = "DELETE FROM  division_list WHERE id = $id";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	}
	function drop_district_by_id($id){
		$sql = "DELETE FROM  district_list WHERE id = $id";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	}
	function drop_sub_district_by_id($id){
		$sql = "DELETE FROM  sub_district WHERE id = $id";
		$query = mysql_query($sql);
		if($query){
			return true;
		}else{
			return false;
		}	
	}
?>