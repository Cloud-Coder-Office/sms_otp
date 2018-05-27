<?php include('header_file.php');?>
<?php include('menu.php'); ?>
<?php include('date.php'); ?>
<?php include ('class/config.php');?>
<?php
//session_start();
if ($_SESSION['ACCESS'] == false) {
    header('location: home.php');
    exit();
}
?>
<?php include('class/control_view.php'); ?>

<?php //include('class/control_update.php'); ?>

<div id="content" class="span10">
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="home.php">Home</a> 
	<i class="icon-angle-right"></i>
</li>
<li><a href="#">Assign Route</a></li>
</ul>

<div class="row-fluid">
<div class="box span12">
	<div class="box-header" data-original-title="">
		<h2><i class="halflings-icon edit"></i><span class="break"></span>Assign Route</h2>

	</div>
	<div class="box-content">
		<?php
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
					
					if($route_id[$i]==3){
						$sql = "INSERT INTO user_route_api (user_id, route_id,capacity,status) VALUES ('$user_id',3,'$route_capacity[2]','1')";
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
	</div>
	<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-horizontal">
		<fieldset>
			<div class="control-group">
			<label class="control-label" for="selectError3">Select Customar</label>
			<div class="controls">
			  <select id="user_id" name="user_id">
			  <option value="">Select Clients</option>
			  <?php
							
				$display_name = view_agent();
				while ($view = mysql_fetch_assoc($display_name)) {
				echo "<option value='" . $view['id'] . "'>" . $view['name'] . "</option>";
				}
				?>
			  </select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label">Select Route</label>
			<div class="controls">
			 
				<?php
							
				$display_route = view_route();
				while ($view = mysql_fetch_assoc($display_route)) {
				echo "<input type='checkbox'  name='route_id[]'   value='" . $view['route'] . "'>
				<label class=''>" . $view['route_name'] . "<input type='text'  name='capacity[]' placeholder='Route Capaciry'> </label>";
				//echo "<br><br>";
				//echo "<label class='checkbox inline'>API Capacity </label><br><input type='text'  name='capacity[]'><br>";
				}
				?>
			  
			 
			</div>
		 </div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save changes</button>
			<input type="reset" value="Cancel" class="btn btn-danger">
		</div>
		</fieldset>
	</form>


	
</div>



</div>	

</div>



<?php include ('footer.php') ?>