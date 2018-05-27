<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Send SMS</title>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<div  class="row">
		<div id="jsonData" class="col-sm-6 col-md-offset-3">				
				<?php
				//Step1
				 $db = mysqli_connect('localhost','root','','api') or die('Error connecting to MySQL server.');
				?>
				<?php include 'function.php';   ?>
				
				<?php 
				if(isset($_GET['submit']))
				{
					$number=$_GET['phone'];
					$number=explode( ',', $_GET['phone'][0] );
					//var_dump($_GET['phone']);
					
					$msg=$_GET['msg']; 
					var_dump($_GET['msg']);
					
					
					for ($i=0; $i < sizeof($number); $i++) 
					{ 
						if(sizeof($number)==0||$number[0]==="")
						{
							break;
						}
						//echo "<br>i: ".$i."<br>".sizeof($number)." :total no<br>";
						
					    
						$sql = "SELECT * FROM route_table WHERE route = 'route1'";
					    $query = mysqli_query($db,$sql) or die('Error querying database.');
						while ($row = mysqli_fetch_array($query)){
						
						 //echo $row['route'] . ' ' . $row['capacity'] . ': ' . $row['count'] .'<br />';
						  $api_one_capacity = $row['capacity'];
						  $api_one_count = $row['count'];
						  
						  
					    }
						 $query = "SELECT * FROM route_table WHERE route = 'route2'";
					     $query = mysqli_query($db,$query) or die('Error querying database.');
						while( $row = mysqli_fetch_array($query)){
							 //echo $row['route'] . ' ' . $row['capacity'] . ': ' . $row['count'] .'<br />';
							 $api_two_capacity = $row['capacity'];
							 $api_two_count = $row['count'];						
						}
						
						//echo $api_one_count.": API 1:".$api_one_capacity."<br>";
						//echo $api_two_count.": API 2:".$api_two_capacity."<br>";
						if($api_one_count < $api_one_capacity){
								//$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$number[$i].'&message=hello'.$msg[0].'&service_type=sms');
								echo "Api 1: ".$api_one_count."<br>";
								$api_one_count  = $api_one_count + 1;
								$sql = "UPDATE route_table SET count = $api_one_count WHERE route='route1'";
								$query = mysqli_query($db,$sql) or die('Error querying database.');
								//$r = multiRequest($data);
							//echo $r[0]." and number".$number[$i]."<br/>";
							
							 // print_r($r);
								continue;
								
								
						}							
						if($api_one_count == $api_one_capacity)
						{
							
							if($api_two_count < $api_two_capacity){
							  $api_two_count  = $api_two_count+1;
									//echo "Api 2".$api_two_count."<br>";
							  //$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$number[$i].'&message=hi'.$msg[0].'&service_type=sms');
						
							  
							  $sql = "UPDATE route_table SET count = $api_two_count WHERE route='route2'";
							  $query = mysqli_query($db,$sql) or die('Error querying database.');
							  //$r = multiRequest($data);
							//echo $r[0]." and number".$number[$i]."<br/>";
							
							 // print_r($r);
  							  continue;
							}
							
							if($api_two_count == $api_two_capacity){
								$sql = "UPDATE route_table SET count = 0 WHERE route='route1'";
							    $query = mysqli_query($db,$sql) or die('Error querying database.');
							    $sql = "UPDATE route_table SET count = 0 WHERE route='route2'";
							    $query = mysqli_query($db,$sql) or die('Error querying database.');
								$i = $i-1;
								continue;
							}
						}
						
										
						
					}
					
					
				}
				?>
		
			</div>
		<div class="col-md-10 col-md-offset-2">
			

			<div class="container">			

				<form id="sms_sender" action="index.php" method="GET" class="form-horizontal">
					<legend>Send SMS</legend>
					<div id="row">
					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-6">
							<input type="text" name="phone[]" class="form-control" id="phone" placeholder="Phone">
						</div>
					</div>
					<div class="form-group">
						<label for="msg" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-6">
							<input name="msg[]" type="text" class="form-control" id="msg" placeholder="Message">
						</div>
					</div>
					
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-6">
							<input type="submit" name="submit" class="btn btn-success btn-block" value="Submit">
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
    
    	<!-- <button onclick="sendSMS()" class="btn btn-success">Send SMS</button> -->
    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<!-- Latest compiled and minified JavaScript -->
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	
    </body>
    </html>