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

				<?php require_once ('Database.php');?>
				<?php include 'function.php';   ?>
				
				<?php 
				if(isset($_GET['submit']))
				{

					$username = $_GET['user_name'];
					$number=$_GET['phone_no'];
					$numbers=explode( ',', $_GET['phone_no'][0] );
					
					$Message = $_REQUEST['msg'];
					$msge = implode(" ",$Message);
					//print_r($msg);
					
					$msg = preg_replace( "/\r|\n/", " ", $msge );
					
					//var_dump($msg);
					//die();
					
					$sql = "SELECT user .name, route_api.route_name, route_api.route AS routeNo, route_api.route_capacity, user_route_api.capacity, user_route_api.total_send FROM user INNER JOIN user_route_api ON user.id =user_route_api.user_id INNER JOIN route_api ON user_route_api.route_id = route_api.route WHERE user .id = ".$username;
                    $query = mysql_query($sql) or die (mysql_error());
                       if(mysql_num_rows($query) != 0):
					     $c =0;
						 $r =0;

						while ($row = mysql_fetch_array($query)) {
							$capacity[$row['routeNo']] = $row['capacity'];
							$routeNo[$r++] = $row['routeNo'];
							$route_id = $row['routeNo'];
							$total_send = $row['total_send'];
						}
								//var_dump($route_id);
								//die();
								 // print_r($capacity);
                                $opt = 0;
                                $no_api = sizeof($routeNo)-1;
                                $no_capacity = sizeof($capacity);

                                $capacity_tow = $capacity;
                                $loop =sizeof($number);
                                $fail =0;
                                $status = false;
                                
                                foreach ($numbers as $number){
				                    //var_dump($number);
                                    if($capacity[$routeNo[$opt]]==0){
                                        $capacity=$capacity_tow;
                                        if($opt==$no_api){
                                            $opt =0;
                                        }else{

                                            $opt++;
                                        }
                                        /////////////////echo $opt;
                                    }
                                    switch ($routeNo[$opt]){
                                       case 1: 
                                         $data = ["http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver=$number&message=API_ONE_$msg&service_type=sms'"];
										   $r= multiRequest($data);
										   $j=json_decode($r[0],true);
											if($j['error']==1){
											echo $total_send;
										   }else{
											 $sql = "SELECT route_id,total_send FROM user_route_api WHERE route_id =  $routeNo[$opt] AND user_id = $username";
											 $query = mysql_query($sql)or die (mysql_error());
											 While($row = mysql_fetch_assoc($query)){
												 $api_one_send = $row['total_send'];
												 $route_id_one = $row['route_id'];
											 }
											$api_one_send  = $api_one_send + 1;
										    $update = "UPDATE user_route_api SET total_send = $api_one_send WHERE route_id = $routeNo[$opt] AND user_id =$username";
											$query_one = mysql_query($update) or die (mysql_error());
											 }
											$status = true;
											$sql = "INSERT INTO message_report (msg,phone_no,user_id,route_id,date) VALUES ('$msg','$number','$username','1', NOW())";
											$query = mysql_query($sql) or die (mysql_error());
                                        break;
                                       case 2: 
											$userName = "40866238";
											$password = "757932";
											
											$messageBody = array();
											$messageBody[] = array('phone' => $number, 'msg' =>$msg);
											
											$msgInfo = json_encode($messageBody);
											$data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
											$status = true;

											$sql = "INSERT INTO message_report (msg,phone_no,user_id,route_id,date) VALUES ('$msg','$number','$username','2', NOW())";
											$query = mysql_query($sql) or die (mysql_error());
											$r = multiRequest($data);
											if(@$j['messageBody']==="Total Update 1 Out Of 1"){
											   $sql = "SELECT total_send FROM user_route_api WHERE route_id =  $routeNo[$opt] AND user_id = $username";
												$query = mysql_query($sql)or die (mysql_error());
											      While($row = mysql_fetch_assoc($query)){
												  $api_two_send = $row['total_send'];
											 }
												$api_two_send  = $api_two_send + 1;
												$update = "UPDATE user_route_api SET total_send = $api_two_send WHERE route_id = $routeNo[$opt] AND user_id =$username"; 
												$query_two = mysql_query($update) or die (mysql_error());
												 }else{
                                             	 echo $total_send;
                                             }
											print_r($data);
											echo "<br>";
											$j=json_decode($r[0],true);
												print_r($j);
											break;
										   
										   default:
											   $status = false;

                                    }
                                    
					                    
                                        if ($status){
                                            
                                             
											 
											 }else{
                                            $fail++;
                                        }

                                    //$data_array($sms_sender[$routeNo[$opt]]);
                                    $loop--;
                                    $capacity[$routeNo[$opt]]--;
                                }
								
								
                        endif;
					}
				?>
		
			</div>
    <div id="jsonData" class="col-sm-6 col-md-offset-3">
    <div class="col-md-10 col-md-offset-2">
			

			<div class="container">			

				<form id="sms_sender" action="index.php" method="GET" class="form-horizontal">
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