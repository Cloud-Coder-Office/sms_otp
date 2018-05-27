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
<li><a href="#">Add Route</a></li>
</ul>

<div class="row-fluid">
<div class="box span10">
	<div class="box-header" data-original-title="">
		<h2><i class="halflings-icon edit"></i><span class="break"></span>Route</h2>

	</div>
	<div class="box-content">
		<?php
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			require_once 'class/control_register.php';
			require_once 'class/control_valid.php';
			$route_name = $_POST['route_name'];
			$route_capacity = $_POST['route_capacity'];
			$alert = $_POST['alert'];
			
			$valid_route = valid_route($route_name);
			if ($valid_route == true) {
				$get_info = register_route($route_name,$route_capacity,$alert);
				if ($get_info == true) {
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
								<span class="status">Status: [ Already Inserted ]</span>
							</span>	                                                       
						</a>
					</li>
				</ul>
			<?php
			}
		}
		?>
	</div>
	<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-horizontal">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="inputSuccess">ROUTE NAME</label>
				<div class="controls">
					<input type="text" name="route_name" id="route_name">
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputSuccess">ROUTE CAPACIITY</label>
				<div class="controls">
					<input type="text" name="route_capacity" id="route_capacity">
					<span class="help-inline"></span>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="inputSuccess">ROUTE ALERT</label>
				<div class="controls">
					<input type="text" name="alert" id="alert">
					<span class="help-inline"></span>
				</div>
			</div>
			

			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<input type="reset" value="Cancel" class="btn btn-danger">
			</div>
		</fieldset>
	</form>


	
</div>
<div class="row-fluid">
	<div class="box span12">
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2><i class="halflings-icon user"></i><span class="break"></span>ALL ROUTE</h2>

			</div>
			<div class="box-content">
				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div class="dataTables_filter" id="DataTables_Table_0_filter"></div></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						<thead>
							<tr role="row">
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ROUTE NAME</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ROUTE CAPACIITY</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">SMS ALERT</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">TOTAL SEND</th>
								
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 289px;">Actions</th>
							</tr>
						</thead>   

						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php
							require_once 'class/control_view.php';
							$display_route = view_route();
							//$display_route = view_route_details();
							while ($view = mysql_fetch_assoc($display_route)) {
								    $id    = $view['route'];
								    $route = $view['route_name'];
								    $route_capacity = $view['route_capacity'];
								    $alert = $view['alert'];
								    $sql = "SELECT SUM(total_send) as total_send FROM `user_route_api` WHERE `route_id`= $id";
									$result = mysql_query($sql) or die (mysql_error());
									while ($row = mysql_fetch_assoc($result)){
										   
										   $total_send = $row['total_send'];
										
											/*if($alert <= $total_send){
												$subject="Route Information"; 
												$header="From: tanvirulislam469@gmail.com"; 
												$content="Route Name : " .$route. ' '. "and  capacity : " .$route_capacity . ' '. "and total send :" .$total_send; 
												mail('tanvir@voicelync.com', $subject, $content, $header);
											} */
								?>

								<tr class="odd">
								
									<td class=" sorting_1"><?php echo $view['route_name']; ?></td>
									<td class=" sorting_1"><?php echo $view['route_capacity']; ?></td>
									<td class=" sorting_1"><?php echo $alert; ?></td>
									<td class=" sorting_1"><?php echo $row['total_send']; ?></td>

									
									<td class="center ">
										<a class="btn btn-info" href="update_route.php?update=<?php echo $view['route'] ?>">
											<i class="halflings-icon white edit"></i>  
										</a>
										<!--<a class="btn btn-danger" href="#">
											<i class="halflings-icon white trash"></i> 
										</a>-->
									</td>
								</tr>

									<?php }}
						?>
						</tbody></table><div class="row-fluid"></div>            
				</div>
			</div>
		</div>

	</div>
</div>


</div>	

</div>



<?php include ('footer.php') ?>