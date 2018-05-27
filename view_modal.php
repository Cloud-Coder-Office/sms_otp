<?php require_once 'class/config.php';  ?>
<?php
		if(isset($_POST['submit'])){
			require_once 'class/control_register.php';
			require_once 'class/control_valid.php';
			require_once 'class/control_view.php';
			
			$user_id = $_POST['user_id'];
			@$route_id = $_POST['route_id'];
			$route_capacity = $_POST['capacity'];
			
			//@$valid_route_by_user = valid_route_by_user($user_id);
			//if($valid_route_by_user == true){
		    if (!empty($user_id) || !empty($route_id)) {
						
				for ($i = 0; $i < count($route_id); $i++) {

					$route_ids = $route_id[$i];
					$capacitys = $route_capacity[$i];
					if($route_id[$i]==1){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',1,'$route_capacity[0]','1')";
					}
					if($route_id[$i]==2){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',2,'$route_capacity[1]','1')";
					}
					$query = mysql_query($sql) or die (mysql_error());
					
					
				}
				if ($query == true) {
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

<div class="modal fade" id="myModal<?php echo $id; ?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
		
		<?php
		   $sql = "SELECT * FROM user WHERE id = '$id'";
		   $query = mysql_query($sql)  or die (mysql_error());
		   $view = mysql_fetch_assoc($query);
		   //echo $row1['name'];
		   echo "<input type='hidden' name='user_id' id ='user_id' type='hidden' value='" . $view['id'] . "'>" . $view['name'] . "</input>";
		?>
		
		</h4>
      </div>
      
        <div class="modal-body">
           <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-horizontal">
	
            <?php
			$display_route = view_route();
				while ($view = mysql_fetch_assoc($display_route)) {
			?>
			  <div class="form-group">
				<input type='hidden' name='user_id' id ='user_id'  value='<?php echo $view['id']; ?>'> </input>
				<label for="exampleInputEmail1"></label>
				
				  <input type="checkbox" name='route_id[]' value='<?php echo $view['route']; ?>'> <?php echo $view['route_name']; ?>
				
				<input type="text" class="form-control" name="capacity[]" id="capacity" placeholder="Route Capacity">
			  </div>
			  
				<?php } ?>
			  
				<input type="submit" name="submit" value="Submit" class="btn btn-primary"></button>
			</form>
            
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
