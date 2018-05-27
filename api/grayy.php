			
				<?php
				
				 $db = mysqli_connect('localhost','helloxyz_SMSAPI','(GOTT)ut@rIw','helloxyz_2gatewayAPI') or die('Error connecting to MySQL server.');  
				// $db = mysqli_connect('localhost','root','','api') or die('Error connecting to MySQL server.');  
				?>
				<?php include 'function.php'; ?>
				
				<?php 
				if(isset($_GET['submit']))
				{
					$number=$_GET['phone'];
					$number=explode( ',', $_GET['phone'][0] );
					//var_dump($_GET['phone']);
					
					$yourString = $_GET['msg'];
					$msg = preg_replace( "/\r|\n/", " ", $yourString );
					$msg = preg_replace( "/\s+/", "+", $msg );
					$number = preg_replace( "/\s+/", "", $number);
					//var_dump($_GET['msg']);
					
					
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
						  $api_one_sent = $row['total_sent'];
						  
						  
					    }
						 $query = "SELECT * FROM route_table WHERE route = 'route2'";
					     $query = mysqli_query($db,$query) or die('Error querying database.');
						while( $row = mysqli_fetch_array($query)){
							 //echo $row['route'] . ' ' . $row['capacity'] . ': ' . $row['count'] .'<br />';
							 $api_two_capacity = $row['capacity'];
							 $api_two_count = $row['count'];	
							 $api_two_sent = $row['total_sent'];					
						}
						
						//echo $api_one_count.": API 1:".$api_one_capacity."<br>";
						//echo $api_two_count.": API 2:".$api_two_capacity."<br>";
						if($api_one_count < $api_one_capacity){
								
								 $userName = "40383297";        //     40866238
							     $password = "939212";          //   757932
							
								$messageBody = array();
								$messageBody[] = array('phone' => $number[$i], 'msg' =>$msg);
							
								$msgInfo = json_encode($messageBody);
							
						        $data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
						        
						       
					 // print_r("http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo);
						       // print_r($data);
						                
								$api_one_count  = $api_one_count + 1;
								$api_one_sent   = $api_one_sent+1;
								$sql = "UPDATE route_table SET count = $api_one_count WHERE route='route1'";
								$query = mysqli_query($db,$sql) or die('Error querying database.');
								$sql = "UPDATE route_table SET total_sent= $api_one_sent WHERE route='route1'";
								$query = mysqli_query($db,$sql) or die('Error querying database.');
								$r = multiRequest($data);
							//echo $r[0]." and number".$number[$i]."<br/>";
							
							 print_r($r);
							 continue;
								
								
						}							
						if($api_one_count == $api_one_capacity)
						{
							
							if($api_two_count < $api_two_capacity){
							  
						     //echo "Api 2".$api_two_count."<br>";
						      $userName = "40383297";        //     40866238
							  $password = "939212";          //   757932
							
							$messageBody = array();
							$messageBody[] = array('phone' => $number[$i], 'msg' =>$msg);
							
							$msgInfo = json_encode($messageBody);
							
						        $data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo];
						        
						       // print_r("http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$msgInfo);
						      
						      //  print_r($data); 
						       
						         $api_two_count  = $api_two_count+1;
						         $api_two_sent = $api_two_sent+1;
						         $sql = "UPDATE route_table SET count = $api_two_count WHERE route='route2'";
							  $query = mysqli_query($db,$sql) or die('Error querying database.');
							  $sql = "UPDATE route_table SET total_sent = $api_two_sent WHERE route='route2'";
							  $query = mysqli_query($db,$sql) or die('Error querying database.');
							  
							  $r = multiRequest($data);
							  
							  print_r($r);
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
		
			