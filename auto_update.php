<?php
session_start();
require_once("class/config.php");
//$db_handle = new DBController();
$result = mysql_query("UPDATE user_route_api set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id=".$_POST["id"]);

print_r($result);
?>
		