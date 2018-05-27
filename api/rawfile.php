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

				<?php
				//Step1
				 $db = mysqli_connect('localhost','root','','api') or die('Error connecting to MySQL server.');
				?>
				<?php include 'function.php';   ?>
				
				<?php 
				if(isset($_GET['submit']))
				{

					$username = $_GET['user_name'];
					$number=$_GET['phone'];
					$numbers=explode( ',', $_GET['phone'] );
					//var_dump($_GET['phone']);
					
					$msg=$_GET['msg']; 
					
                        $cout_one = 0;
                        $cout_two = 0;
                        $sql = "SELECT USER .name, route_api.route AS routeNo, route_api.total_count, user_route_api.capacity, user_route_api.total_send FROM USER INNER JOIN user_route_api ON user.id =user_route_api.user_id INNER JOIN route_api ON user_route_api.route_id = route_api.route WHERE USER .id = ".$username;
                        $query = mysql_query($sql) or die('Error querying database.');
                       

					    if($query->num_rows!=0):
					    //die();

                               // echo $i."loop<br>";
                                $c =0;
                                $r =0;

                                while ($row = mysql_fetch_array($query)) {
                                    $capacity[$row['routeNo']] = $row['capacity'];
                                    $routeNo[$r++] = $row['routeNo'];

                                }

                               // print_r($capacity);
                                $opt = 0;
                                $send = 0;
                                $s = 0;
                                $no_api = sizeof($routeNo)-1;
                                $no_capacity = sizeof($capacity);

                                $capacity_tow = $capacity;
                                $loop =sizeof($number);
                                $fail =0;
                                $status = false;
								$userName = "40866238";
							    $password = "757932";
								$messageBody = array();
							    $messageBody[] = array('phone' => $number[$i], 'msg' => $msg);
                                foreach ($numbers as $number){
                                   

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
                                       case 1: $data = ["http://winpayonline.com/api/check.php?user=color_box&pass=colorbox678&todo=single_sms&sender=color_box&receiver=$number&message=API_ONE_$msg&service_type=sms'"];
                                                $status = true;
                                                break;
                                       case 2: $data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
                                                $status = true;
                                                break;
                                     
                                       default:
                                           $status = false;

                                    }
                                        if ($status){
                                            echo $data[0]."<br>";
                                            echo "<pre>";
                                            $r = multiRequest($data);
                                            print_r($r);

                                        }else{
                                            $fail++;
                                        }

                                  
                                    $loop--;
                                    $capacity[$routeNo[$opt]]--;
                                }
                        endif;
                         //   }
                            echo "<hr>";
                           
					
					
				}
				?>
		
			</div>
    
    <div class="col-md-5 col-md-offset-2">
			

			<div class="container">			

				<form id="sms_sender" action="index.php" method="GET" class="form-horizontal">
					<legend>Send SMS</legend>
					<div id="row">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">User Name</label>
						<select class="form-control" name="user_name">
							<option value="1">Tanvir</option>
							<option value="2">Arif</option>
						</select>
					</div>
					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-6">
							<input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
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
	
    
    	<!-- <button onclick="sendSMS()" class="btn btn-success">Send SMS</button> -->
    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<!-- Latest compiled and minified JavaScript -->
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	
    </body>
    </html>