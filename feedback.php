<?php require_once 'class/config.php';  ?>
<?php
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			//require_once 'class/control_register.php';
			//require_once 'class/control_valid.php';
			//require_once 'class/control_view.php';
			
			$user_id = $_POST['user_id'];
			@$route_id = $_POST['route_id'];
			$route_capacity = $_POST['capacity'];
			
			//@$valid_route_by_user = valid_route_by_user($user_id);
			//if($valid_route_by_user == true){
		    if (!empty($user_id) || !empty($route_id)) {
						
				for ($i = 0; $i < sizeof($route_id); $i++) {

					$route_ids = $route_id[$i];
					$capacitys = $route_capacity[$i];
					
					
					if($route_ids==1){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',1,'$capacitys','1')";
						
					}
					if($route_ids==2){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',2,'$capacitys','1')";
						
					} 
					
					if($route_ids==3){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',3,'$capacitys','1')";
						
					}
					
					if($route_ids==4){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',4,'$capacitys','1')";
						
					} 
					if($route_ids==5){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',5,'$capacitys','1')";
						
					} 
					if($route_ids==6){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',6,'$capacitys','1')";
						
					}  
					$query = mysql_query($sql) or die (mysql_error());
					
					
				}
				if ($query) {
					?>
					<ul class="tickets metro">
						<li class="ticket blue">
							<a href="#">
								<span class="content">
									<span class="status">Status: [ Complete ]</span>
								</span>	                                                       
							</a>
						</li>
					</ul>
				<?php } else {
					?>
					<ul class="tickets metro">
						<li class="ticket red">
							<a href="#">
								<span class="content">
									<span class="status">Status: [ Fail ]</span>
								</span>	                                                       
							</a>
						</li>
					</ul>
				<?php
				}
			} else {
				?>
				<ul class="tickets metro">
					<li class="ticket red">
						<a href="#">
							<span class="content">
								<span class="status">Status: [ Not Empty ]</span>
							</span>	                                                       
						</a>
					</li>
				</ul>
			<?php
			}
		//}else{ ?>
				
				<!--<ul class="tickets metro">
					<li class="ticket red">
						<a href="#">
							<span class="content">
								<span class="status">Status: [ Already Inserted ]</span>
							</span>	                                                       
						</a>
					</li>
				</ul>---->
			
	<?php	
			} 
			?>