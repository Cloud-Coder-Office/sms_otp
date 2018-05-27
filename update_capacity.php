<?php include('header_file.php'); ?>
<?php include('menu.php'); ?>
<?php
	if($_SESSION['ACCESS'] == false){
		header('location: home.php');
		exit();
	}
?>
<div id="content" class="span10">
   <ul class="breadcrumb">
       <li>
           <i class="icon-home"></i>
           <a href="index.php">Home</a> 
           <i class="icon-angle-right"></i>
       </li>
       <li><a href="#">Update Route </a></li>
   </ul>

   <div class="row-fluid">
       <div class="box span10">	
       <div class="box-content">
       		<?php
				$up_id = $_GET['update'];
				if($_SERVER['REQUEST_METHOD']=="POST"){
					require_once('class/control_update.php');
					require_once('class/control_valid.php');
					$route_name  = $_POST['route_id'];
					$route_capacity  = $_POST['capacity'];
					$count  = $_POST['count'];
					
					$get_valid =valid_capacity_by_user_id($route_name,$route_capacity);
					if($get_valid == true){
						$get_info = update_route_capacity($up_id,$route_name,$route_capacity,$count);
						if($get_info == true){ ?>
							<!--<ul class="tickets metro">
								<li class="ticket blue">
									<a href="#">
										<span class="content">
										<span class="status">Status: [ Update Success ]</span>
										</span>	                                                       
									</a>
								</li>
							</ul>----->
							<script type="text/javascript">
							  alert("Update Success");
							  window.location.href = "route_details.php";
							</script>
							?>
					<?php	}else{  ?>
							<ul class="tickets metro">
								<li class="ticket red">
									<a href="#">
										<span class="content">
										<span class="status">Status: [ Update Fail ]</span>
										</span>	                                                       
									</a>
								</li>
							</ul>
					<?php	}
					}else{ ?>
						<ul class="tickets metro">
								<li class="ticket red">
									<a href="#">
										<span class="content">
										<span class="status">Status: [ Exits !! ]</span>
										</span>	                                                       
									</a>
								</li>
							</ul>
				<?php	}
					
				}
			?>
       </div>		
           <div class="box-header" data-original-title="">
               <h2><i class="halflings-icon edit"></i><span class="break"></span>Route Details</h2>

           </div>
           <div class="box-content">
           		
               <form  action="" method="POST" class="form-horizontal">
                   <fieldset>
						<?php 
							require_once('class/config.php');
							//$row = update_route_capacity($up_id);
							$sql = "SELECT  user_route_api.route_id,user_route_api.user_id,user_route_api.status, user.name, route_api.route, route_api.route_name , route_api.route_capacity, user_route_api.id,user_route_api.capacity,user_route_api.count, user_route_api.total_send,user_route_api.user_id FROM user INNER JOIN user_route_api ON user.id =user_route_api.user_id INNER JOIN route_api ON user_route_api.route_id = route_api.route WHERE user_route_api.id = $up_id";
							$query = mysql_query($sql) or die (mysql_error());
							$view = mysql_fetch_array($query);
						?>
                      <div class="control-group">
					  
						<label class="control-label" for="inputSuccess">USER NAME</label>
						<div class="controls">
						   <select class="form-control" name="user_id" id="user_id" readonly>
							 <?php
							   
								$csql=mysql_query("select * from user");
								while($user=mysql_fetch_array($csql))
								{
								?>
								<option value="<?php echo $user['id']; ?>"  <?php if ($view['user_id']==$user['id']) { echo "selected"; } ?> ><?php echo $user['name']; ?></option>
							<?php
								}
								?>

							</select> 
								<span class="help-inline"></span>
							 </div>
                        </div>
					   
					   <div class="control-group">
					  
							<label class="control-label" for="inputSuccess">ROUTE NAME</label>
							 <div class="controls">
							   <select class="form-control" name="route_id" id="route_id" required>
								 <?php
								   
									$sql=mysql_query("select * from route_api");
									while($route_name=mysql_fetch_array($sql))
									{
									?>
									<option value="<?php echo $route_name['route']; ?>"  <?php if ($view['route_id']==$route_name['route']) { echo "selected"; } ?> ><?php echo $route_name['route_name']; ?></option>
								<?php
									}
									?>

								</select> 
								<span class="help-inline"></span>
						 </div>
                      </div>
                       <div class="control-group">
                           <label class="control-label" for="inputSuccess">ROUTE CAPACITY</label>
                            <div class="controls">
                               <input type="text" name="capacity"  id="capacity" value="<?php echo $view['capacity']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
					   <div class="control-group">
                           <label class="control-label" for="inputSuccess">INTERVAL COUNT</label>
                            <div class="controls">
                               <input type="text" name="count"  id="count" value="<?php echo $view['count']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
					   
                       <div class="form-actions">
                           <button type="submit"  class="btn btn-primary">Save changes</button>
                           <a href="route_details.php" class="btn">Cancel</a>
                       </div>
                   </fieldset>
               </form>

           </div>

       </div>

   </div>
   <?php include ('footer.php') ?>