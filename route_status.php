<?php
	session_start();
	if($_SESSION['ACCESS'] == false){
		header('location: home.php');
		exit();
	}
?>
<?php
	 
	include 'class/config.php';
	$get_id = $_GET['status'];
	$row = view_route_by_id($get_id);
	$status = $row['status'];
	if($status==1){
		$sql = "UPDATE user_route_api SET status = '0' WHERE id = '$get_id'";
		$query = mysql_query($sql);
		if($query){ ?>
			<span class='label label-danger'>Disable</span>
				<a style='float:right' class='label label-success' onclick="agent_status(<?php echo $get_id ?>)">Active</a>
		<?php }
	}
	else{
		$sql = "UPDATE user_route_api SET status = '1' WHERE id = '$get_id'";
		$query = mysql_query($sql);
		if($query){ ?>
			<span class="label label-success">Active</span>                                    	
			<a style="float:right" class="label label-danger" onclick="agent_status(<?php echo $get_id ?>)">Disable</a>
	<?php	}
	}
	
?>