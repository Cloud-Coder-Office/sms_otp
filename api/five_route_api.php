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

				<?php require_once ('Database.php');   ?>
				<?php require_once ('function.php');   ?>
				
				<?php 
				if(isset($_GET['submit']))
				{

					$username = $_GET['user_name'];
					$number=$_GET['phone_no'];
					$numbers=explode(',', $_GET['phone_no'][0]);
					$msge = $_GET['msg']; 
					
					$msg = preg_replace( "/\r|\n/", " ", $msge );
					
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
									
									$sql = "SELECT * FROM user_route_api WHERE user_id = $username AND route_id = 3 AND status = 1";
										$query  = mysql_query($sql) or die (mysql_error());
										While ($row = mysql_fetch_assoc($query)){
											$api_three_capacity = $row['capacity'];
											$api_three_count = $row['count'];
											$api_three_sent = $row['total_send'];
											$api_three_status = $row['status'];
									}
									$sql = "SELECT * FROM user_route_api WHERE user_id = $username AND route_id = 4 AND status = 1";
										$query  = mysql_query($sql) or die (mysql_error());
										While ($row = mysql_fetch_assoc($query)){
											$api_four_capacity = $row['capacity'];
											$api_four_count = $row['count'];
											$api_four_sent = $row['total_send'];
											$api_four_status = $row['status'];
									}
									
									$sql = "SELECT * FROM user_route_api WHERE user_id = $username AND route_id = 5 AND status = 1";
										$query  = mysql_query($sql) or die (mysql_error());
										While ($row = mysql_fetch_assoc($query)){
											$api_five_capacity = $row['capacity'];
											$api_five_count = $row['count'];
											$api_five_sent = $row['total_send'];
											$api_five_status = $row['status'];
									}
									
									if(@$api_one_status == 1 || @$api_two_status == 1 || @$api_three_status == 1 || @$api_four_status == 1 || @$api_five_status == 1 ){
								   
									if($str == 88019 && @$api_one_count < @$api_one_capacity){
										
										$userName = "40866238";
										$password = "757932";
											
											$messageBody = array();
											$messageBody[] = array('phone' => $numbers[$i], 'msg' =>$msg[0]);
											
											$msgInfo = json_encode($messageBody);
											
												$data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
										
										//$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$numbers[$i].'&message=api_one'.$msg.'&service_type=sms');

										$r = multiRequest($data);
										//echo $r[0]." and number".$number[$i]."<br/>";
										
										 $j=json_decode($r[0],true);
											 print_r($j);
											 
											//if($j['error']==1){
										if(@$j['messageBody']==="Total Update 1 Out Of 1"){
											
											$api_one_count  = $api_one_count + 1;
											$api_one_sent   = $api_one_sent+1;
											$sql = "UPDATE user_route_api SET count = '$api_one_count', total_send = '$api_one_sent' WHERE route_id=1 AND user_id = $username AND status = 1";
											$query = mysql_query($sql)  or die (mysql_error());
											
										     $sql = "INSERT INTO message_report (msg,phone_no,user_id,route_id,date) VALUES ('$msg','$numbers[$i]','$username','1', NOW())";
										 	 $query = mysql_query($sql) or die (mysql_error());
											 
										} else{
											 echo $api_one_sent;
										   }
									 
									     continue;
										}
										
										if($str == 88017 && @$api_two_count < @$api_two_capacity){
											  
											$userName = "40866238";
											$password = "757932";
											
											$messageBody = array();
											$messageBody[] = array('phone' => $numbers[$i], 'msg' =>$msg[0]);
											
											$msgInfo = json_encode($messageBody);
											
												$data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
											    //$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$numbers[$i].'&message=API_TWO'.$msg.'&service_type=sms');
												$r = multiRequest($data);
											    $j=json_decode($r[0],true);
											    print_r($j);
											 
											if(@$j['messageBody']==="Total Update 1 Out Of 1"){
											   
												 $api_two_count  = $api_two_count+1;
												 $api_two_sent = $api_two_sent+1;
												 $sql = "UPDATE user_route_api SET count = '$api_two_count', total_send = '$api_two_sent' WHERE route_id=2 AND user_id = $username AND status =1";
												 $sql = "INSERT INTO message_report (msg,phone_no,user_id,route_id,date) VALUES ('$msg','$numbers[$i]','$username','2', NOW())";
												$query = mysql_query($sql) or die (mysql_error());
												
												 }else{
                                             	 echo $api_two_sent;
                                             }
											 
											  continue;
										    	}
												
										if($str == 88018 && @$api_three_count < @$api_three_capacity){
											  
											$userName = "40866238";
											$password = "757932";
											
											$messageBody = array();
											$messageBody[] = array('phone' => $numbers[$i], 'msg' =>$msg[0]);
											
											$msgInfo = json_encode($messageBody);
											
												$data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
											    //$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$numbers[$i].'&message=API_TWO'.$msg.'&service_type=sms');
												$r = multiRequest($data);
											    $j=json_decode($r[0],true);
											    print_r($j);
											 
											if(@$j['messageBody']==="Total Update 1 Out Of 1"){
											   
												 $api_three_count  = $api_three_count+1;
												 $api_three_sent = $api_three_sent+1;
												 $sql = "UPDATE user_route_api SET count = '$api_three_count', total_send = '$api_three_sent' WHERE route_id=3 AND user_id = $username AND status =1";
												 $sql = "INSERT INTO message_report (msg,phone_no,user_id,route_id,date) VALUES ('$msg','$numbers[$i]','$username','3', NOW())";
												$query = mysql_query($sql) or die (mysql_error());
												
												 }else{
                                             	 echo $api_three_sent;
                                             }
											 
											  continue;
										    	}	
												
										if($str == 88016 && @$api_four_count < @$api_four_capacity){
											  
											$userName = "40866238";
											$password = "757932";
											
											$messageBody = array();
											$messageBody[] = array('phone' => $numbers[$i], 'msg' =>$msg[0]);
											
											$msgInfo = json_encode($messageBody);
											
												$data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
											    //$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$numbers[$i].'&message=API_TWO'.$msg.'&service_type=sms');
												$r = multiRequest($data);
											    $j=json_decode($r[0],true);
											    print_r($j);
											 
											if(@$j['messageBody']==="Total Update 1 Out Of 1"){
											   
												 $api_four_count  = $api_four_count+1;
												 $api_four_sent = $api_four_sent+1;
												 $sql = "UPDATE user_route_api SET count = '$api_four_count', total_send = '$api_four_sent' WHERE route_id=4 AND user_id = $username AND status =1";
												  
												
												 $sql = "INSERT INTO message_report (msg,phone_no,user_id,route_id,date) VALUES ('$msg','$numbers[$i]','$username','4', NOW())";
												$query = mysql_query($sql) or die (mysql_error());
												
												 }else{
                                             	 echo $api_four_sent;
                                             }
											 
											  continue;
										    }
												
										if($str == 88015 && @$api_five_count < @$api_five_capacity){
											  
											$userName = "40866238";
											$password = "757932";
											
											$messageBody = array();
											$messageBody[] = array('phone' => $numbers[$i], 'msg' =>$msg[0]);
											
											$msgInfo = json_encode($messageBody);
											
												$data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
											    //$data = array('http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver='.$numbers[$i].'&message=API_TWO'.$msg.'&service_type=sms');
												$r = multiRequest($data);
											    $j=json_decode($r[0],true);
											    print_r($j);
											 
											if(@$j['messageBody']==="Total Update 1 Out Of 1"){
											   
												 $api_five_count  = $api_five_count+1;
												 $api_five_sent = $api_five_sent+1;
												 $sql = "UPDATE user_route_api SET count = '$api_five_count', total_send = '$api_five_sent' WHERE route_id=5 AND user_id = $username AND status =1";
												  
												
												 $sql = "INSERT INTO message_report (msg,phone_no,user_id,route_id,date) VALUES ('$msg','$numbers[$i]','$username','5', NOW())";
												$query = mysql_query($sql) or die (mysql_error());
												
												 }else{
                                             	 echo $api_five_sent;
                                             }
											 
											  continue;
										    }
												
										   if(@$api_one_count == @$api_one_capacity){
											   $sql = "UPDATE user_route_api SET count = 0 WHERE route_id='1' AND user_id = $username AND status =1";
											   $query = mysql_query($sql) or die (mysql_error());
											   $i = $i-1;
											   continue;
											}
												if(@$api_two_count == @$api_two_capacity){
												$query = mysql_query($sql) or die (mysql_error());
												$sql = "UPDATE user_route_api SET count = 0 WHERE route_id='2' AND user_id = $username AND status =1";
												
												$query = mysql_query($sql) or die (mysql_error());
												$i = $i-1;
												continue;
											}
											
											
											if(@$api_three_count == @$api_three_capacity){
												$query = mysql_query($sql) or die (mysql_error());
												$sql = "UPDATE user_route_api SET count = 0 WHERE route_id='3' AND user_id = $username AND status =1";
												
												$query = mysql_query($sql) or die (mysql_error());
												$i = $i-1;
												continue;
											}
											if(@$api_four_count == @$api_four_capacity){
												$query = mysql_query($sql) or die (mysql_error());
												$sql = "UPDATE user_route_api SET count = 0 WHERE route_id='4' AND user_id = $username AND status =1";
												
												$query = mysql_query($sql) or die (mysql_error());
												$i = $i-1;
												continue;
											}
											if(@$api_five_count == @$api_five_capacity){
												$query = mysql_query($sql) or die (mysql_error());
												$sql = "UPDATE user_route_api SET count = 0 WHERE route_id='5' AND user_id = $username AND status =1";
												
												$query = mysql_query($sql) or die (mysql_error());
												$i = $i-1;
												continue;
											}
									
									
					}else{
						echo "Please Activate API";
					}
				 }
			   }
			?>
		
			</div>
    <div id="jsonData" class="col-sm-6 col-md-offset-3">
    <div class="col-md-10 col-md-offset-2">
			<div class="container">			

				<form id="sms_sender" action="five_route_api.php" method="GET" class="form-horizontal">
					<legend>Send SMS</legend>
					<div id="row">
					<div class="form-group">
						<label for="user" class="col-sm-2 control-label">User Name</label>
						<select class="form-control" name="user_name">
							<option value="1">Tanvir</option>
							<option value="3">Arif</option>
						</select>
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