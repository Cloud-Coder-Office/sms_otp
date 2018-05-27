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
	<div  class="row col-md-offset-0">

		<?php require_once ('Database.php');   ?>
		<?php require_once ('function.php');   ?>
		
		<?php 
		if(isset($_GET['submit']))
		{

			$username     = $_GET['user_name'];
			$pass  	      = $_GET['password'];
			$number       = $_GET['phone_no'];
			$number       = explode(',', $_GET['phone_no'][0]);
			$yourString   = strtoupper($_GET['msg']); 
			
			//$msg = preg_replace("/(\r?\n){2,}/", "\n\n", $yourString);
	        //$msg = preg_replace( "/\s+/", "+", $yourString );
                        
                        
			$number         = preg_replace( "/\s+/", "", $number);
			$numbers        = array_unique($number);
			//print_r ($numbers);
			//die();
			 
			 $flag = false;
			 $sql = "SELECT incomming_string, outgoing_string, status FROM otp_string WHERE status ='1'";
 
			$query = mysql_query($sql) or die (mysql_error());
 
			if($query === FALSE) { 
					die(mysql_error()); // TODO: better error handling
				}
	 
			 While(@$row = mysql_fetch_array($query)){
				 
				 $incomming_string = $row['incomming_string'];
				 $outgoing_string  = $row['outgoing_string'];
				 
				 
				

		if( strpos( $yourString, $incomming_string ) !== false ) {
					
					//$flag = true;
					$message = explode(',', $outgoing_string);
					shuffle($message);
					$outgoing_string = $message['0'];
					$yourString =  str_replace("G-"," ",$yourString);
					$newMsg =  str_replace($incomming_string,$outgoing_string,$yourString);
					
					$msg = preg_replace("/(\r?\n){2,}/", "\n\n", $newMsg);
	                                $msg = preg_replace( "/\s+/", "+", $msg );
					
					
				
			$sql = "SELECT * FROM user";
			$query  = mysql_query($sql) or die (mysql_error());
			
			if (!$query)
			    {
                 die(mysql_error());
		        }
			while($row = @mysql_fetch_assoc($query)){
			
			$id  = $row['id'];
			$pas = $row['password'];
			
			
			if($id == $username && $pas == $pass){
			for ($i=0; $i < sizeof($numbers); $i++) {
				if(sizeof($numbers)==0||$numbers[0]==="")
						{
							break;
						}
			$str =  substr("$numbers[$i]", 0,5);
			   $sql = "SELECT * FROM user_route_api WHERE user_id = $username AND route_id = 1 AND status = 1";
					$query  = mysql_query($sql) or die (mysql_error());
					While ($row = mysql_fetch_assoc($query)){
							$api_one_capacity = $row['capacity'];
							$api_one_count = $row['count'];
							$api_one_sent = $row['total_send'];
							$api_one_status = $row['status'];
							
					}
					
					$sql = "SELECT * FROM user_route_api WHERE user_id = $username AND route_id = 2 AND status = 1";
						$query  = mysql_query($sql) or die (mysql_error());
						While ($row = mysql_fetch_assoc($query)){
						$api_two_capacity = $row['capacity'];
						$api_two_count = $row['count'];
						$api_two_sent = $row['total_send'];
						$api_two_status = $row['status'];
					}
					$sql_for_pc_one = "SELECT route_api.route,route_api.route_capacity,user_route_api.id,user_route_api.user_id,user_route_api.route_id,user_route_api.capacity,user_route_api.total_send, SUM(user_route_api.total_send) as route_one_total_send FROM route_api INNER JOIN user_route_api ON route_api.route = user_route_api.route_id WHERE user_route_api.route_id = 1";
					$query = mysql_query($sql_for_pc_one) or die(mysql_error());
						While ($row = mysql_fetch_assoc($query))
							{
								$route_one_total_send = $row['route_one_total_send'];
								$route_one_capacity = $row['route_capacity'];
								
							}
		
				$sql_for_pc_two = "SELECT route_api.route,route_api.route_capacity,user_route_api.id,user_route_api.user_id,user_route_api.route_id,user_route_api.capacity,user_route_api.total_send, SUM(user_route_api.total_send) as route_two_total_send FROM route_api INNER JOIN user_route_api ON route_api.route = user_route_api.route_id WHERE user_route_api.route_id = 2";
				$query = mysql_query($sql_for_pc_two) or die(mysql_error());
					While ($row = mysql_fetch_assoc($query))
						{
							$route_two_total_send = $row['route_two_total_send'];
							$route_two_capacity = $row['route_capacity'];
						}
				$sql_for_uc ="SELECT user.id,user.user_capacity, user_route_api.id,user_route_api.user_id,user_route_api.total_send, SUM(user_route_api.total_send) as user_total_send FROM user INNER JOIN user_route_api ON user.id = user_route_api.user_id WHERE user_route_api.user_id =$username";
				$query = mysql_query($sql_for_uc);
				While($row = mysql_fetch_assoc($query))
					{
						$user_total_send = $row['user_total_send'];
						$user_total_capacity = $row['user_capacity'];
						
						//var_dump($user_total_send);
						//var_dump($user_total_capacity);
						//die();
						
					}
							
			if(@$api_one_status == 1 || @$api_two_status == 1){ 
			
				if(@$user_total_send < @$user_total_capacity) {
					
				    if(@$route_one_total_send < @$route_one_capacity){
						
				       if(@$api_one_count < @$api_one_capacity){
					
						$userName = "40978194";               //$userName = "40912438\40645673";
						$password = "842941";  		     //$password = "679911\793933";
						
						$messageBody = array();
						$messageBody[] = array('phone' => $numbers[$i], 'msg' =>$msg);
						
						$msgInfo = json_encode($messageBody);
						$data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];

					   $r = multiRequest($data);
					   //echo $r[0]." and number".$number[$i]."<br/>";
					
					     $j=json_decode($r[0],true);
						 print_r($j);
						 
						//if($j['error']==1){
					if(@$j['messageBody']==="Total Update 1 Out Of 1"){
						
						$api_one_count  = $api_one_count + 1;
						$api_one_sent   = $api_one_sent+1;
						$sql = "UPDATE user_route_api SET count = $api_one_count WHERE route_id=1 AND user_id = $username AND status = 1";
						$query = mysql_query($sql)  or die (mysql_error());
						
						$update = "UPDATE user_route_api SET total_send = $api_one_sent WHERE route_id = 1 AND user_id =$username AND status =1";
						$query_one = mysql_query($update) or die (mysql_error());
						
						  $sql = "INSERT INTO otp_message_report (incomming_string 	,outgoing_string,phone_no,user_id,route_id,date ) VALUES ('$incomming_string','$msg','$numbers[$i]','$username','1', NOW())";
						 $query = mysql_query($sql) or die (mysql_error());
						 
					} else{
						 echo $api_one_sent;
					   }
					   continue;
					}
				}
				  if(@$route_two_total_send < @$route_two_capacity){
					if(@$api_two_count < @$api_two_capacity){
						  
							$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$numbers[$i].'&message='.$msg.'&service_type=sms');

										$r = multiRequest($data);
										//echo $r[0]." and number".$number[$i]."<br/>";
										
										 $j=json_decode($r[0],true);
											 print_r($j);
											 
											if($j['error']==1){
											echo $api_two_sent;
										   }else{
											$api_two_count  = $api_two_count+1;
							                $api_two_sent = $api_two_sent+1;
											$sql = "UPDATE user_route_api SET count = $api_two_count WHERE route_id='2' AND user_id = $username AND status = 1";
											$query = mysql_query($sql)  or die (mysql_error());
											
										    $update = "UPDATE user_route_api SET total_send = $api_two_sent WHERE route_id = '2' AND user_id =$username AND status =1";
											$query_one = mysql_query($update) or die (mysql_error());
											
											 $sql = "INSERT INTO otp_message_report (incomming_string 	,outgoing_string,phone_no,user_id,route_id,date ) VALUES ('$incomming_string','$msg','$numbers[$i]','$username','2', NOW())";
										 	 $query = mysql_query($sql) or die (mysql_error());
											 
											 }
									
									 
									 continue;
						}
					 }
						if($api_two_count == $api_two_capacity){
							   $sql = "UPDATE user_route_api SET count = '0' WHERE route_id='1' AND user_id = $username AND status ='1'";
							    $query = mysql_query($sql) or die(mysql_error());
							    $sql = "UPDATE user_route_api SET count = '0' WHERE route_id='2' AND user_id = $username AND status ='1'";
							    $query = mysql_query($sql) or die(mysql_error());
								$i = $i-1;
								continue;
						}
						
						
				}else{
					echo "Limit User capacity";
				}

			}else{
				echo "Please Activate API";
			}
						 }
						 }
  }
  
			}    //   else code here
			
				}
				
					
				}
				
	?>
		
			</div>
    <div id="jsonData" class="col-sm-5 col-md-offset-0">
    <div class="col-md-10 col-md-offset-2">
			<div class="container">			

				<form id="sms_sender" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="form-horizontal">
					<legend>Send SMS</legend>
					<div id="row">
					<div class="form-group">
						<label for="user" class="col-sm-2 control-label">User Name</label>
						<div class="col-sm-6">
						<select class="form-control" name="user_name">
							<option value="1">Tanvir</option>
							<option value="2">Arif</option>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-6">
							<input type="text" name="password" class="form-control" id="password" >
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-6">
							<input type="text" name="phone_no[]" class="form-control" id="phone" placeholder="Phone">
						</div>
					</div>
					<div class="form-group">
						<label for="msg" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-6">
							<input name="msg" type="text" class="form-control" id="msg" placeholder="Message">
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