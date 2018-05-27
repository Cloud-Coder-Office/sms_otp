#!/home/helloxyz/public_html/api/admin
<?php
        if (isset($_SERVER['REMOTE_ADDR'])) die('Permission denied.');
	include "class/config.php";
	
	$sql = "SELECT route,route_name,route_capacity,alert FROM route_api  ORDER BY route ASC";
	$query = mysql_query($sql) or die (mysql_error());
	while ($view = mysql_fetch_assoc($query)) 
	{
	   $id    = $view['route'];
	   $route = $view['route_name'];
	   $route_capacity = $view['route_capacity'];
	   $alert = $view['alert'];
	   $sql = "SELECT SUM(total_send) as total_send FROM `user_route_api` WHERE `route_id`= $id";
	   $result = mysql_query($sql) or die (mysql_error());
	     while ($row = mysql_fetch_assoc($result))
	     {
		   $total_send = $row['total_send'];
		   $alert = $view['alert'];
		   if($alert <= $total_send)
		   {
			$subject="Route Information"; 
			$header="From: tanvirulislam469@gmail.com"; 
			
			$header = "From: tanvirulislam469@gmail.com" . "\r\n" .
			"CC: smron@cloud-coder.com";
			
			$content="Route Name : " .$route. ' '. "and  capacity : " .$route_capacity . ' '. "and total send :" .$total_send; 
			mail('tanvir@voicelync.com', $subject, $content, $header);
		   }
	     }
	}
?>


