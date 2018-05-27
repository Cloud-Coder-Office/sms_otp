<?php
	$number = $_GET['number'];
	$action = $_GET['action'];
	if($action == "phone_valid"){
		if (!is_numeric($number)){ ?>
			<p style="color: rgb(255, 0, 0);">Invalid Number</p>
		<?php }else{
			if(strlen($number)<10||strlen($number)>15){ ?>
				<p style="color: rgb(255, 0, 0);">Invalid Phone Number</p>
			<?php }else{
				require_once('class/config.php'); // This is mysql connection
				$sql = "SELECT id, agent_name, phone, status FROM add_agent WHERE phone = $number";
				$query = mysql_query($sql);
				$info = mysql_num_rows($query);
				if($info>=1){ ?>
					<p style="color: rgb(255, 0, 0);"><u></b><?php echo $number; ?></u> Already Inserted</p>
			<?php	}else{ ?>
				<p style="color: rgb(14, 155, 41);"><u></b><?php echo $number; ?></u> is Available</p>
		<?php	}
			}
		}
	}
	if($action == "uid_valid"){
		if (!is_numeric($number)){ ?>
			<p style="color: rgb(255, 0, 0);">Invalid Integer</p>
		<?php }else{
			if(strlen($number)<8||strlen($number)>20){ ?>
				<p style="color: rgb(255, 0, 0);">Invalid UID</p>
			<?php }else{
				require 'class/control_view.php';
				$get_valid = view_item_by_id($number);
				if($get_valid){ ?>
						<p style="color: rgb(255, 0, 0);"><u></b><?php echo $number; ?></u> Already Inserted</p>
					<?php
				}else{ ?>
						<p style="color: rgb(14, 155, 41);"><u></b><?php echo $number; ?></u> is Available</p>
			<?php	}
			}
	}
}
?>