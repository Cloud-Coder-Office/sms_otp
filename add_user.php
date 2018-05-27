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

</style>
<div id="content" class="span10">
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="home.php">Home</a> 
	<i class="icon-angle-right"></i>
</li>
<li><a href="#">Add User</a></li>
</ul>

<div class="row-fluid">
<div class="box span10">
	<div class="box-header" data-original-title="">
		<h2><i class="halflings-icon edit"></i><span class="break"></span>USER</h2>

	</div>
	<div class="box-content">
		<?php
		
		    if ($_SERVER['REQUEST_METHOD'] == "POST") 
			{
				require_once 'class/control_register.php';
				require_once 'class/control_valid.php';
				
				$agent_name   = $_POST['name'];
				$pass         = $_POST['password'];
				@$one_way     = $_POST['one_way'];
				$sms_capacity = $_POST['user_capacity'];
				$alert        = $_POST['alert'];
				
				$valid_user = valid_agent($agent_name);
				if ($valid_user == true) {
				$get_info = register_agent($agent_name,$pass,$one_way,$sms_capacity,$alert);
				
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
				<label class="control-label" for="inputSuccess">USER NAME</label>
				<div class="controls">
					<input type="text" name="name" id="name">
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputSuccess">SMS CAPACITY</label>
				<div class="controls">
					<input type="text" name="user_capacity" id="user_capacity">
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputSuccess">SMS ALERT</label>
				<div class="controls">
					<input type="text" name="alert" id="alert">
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputSuccess">PASSWORD </label>
				<div class="controls">
					<input type="password" name="password" id="password">
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				
				<div class="controls">
				  <label class="">
					<div id="" class=""><span><input id="one_way" name="one_way" value="1" type="hidden"></span></div> 
				  </label>
				
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
				<h2><i class="halflings-icon user"></i><span class="break"></span>ALL USER</h2>

			</div>
			<div class="box-content">
				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div class="dataTables_filter" id="DataTables_Table_0_filter"></div></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						<thead>
							<tr role="row">
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">USER NAME</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">SMS CAPACITY</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">SMS ALERT</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">TOTAL SEND</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">USER API</th>
								
								
								
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 289px;">ACTION</th>
							</tr>
						</thead>   

						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php
							require_once 'class/control_view.php';
							$display_user = view_agent();
							while ($view = mysql_fetch_assoc($display_user)) {
								$id = $view['id']; 
								$sql = "SELECT SUM(total_send) as total_send FROM `user_route_api` WHERE `user_id`= $id";
									$result = mysql_query($sql) or die (mysql_error());
									while ($row = mysql_fetch_assoc($result)){
								?>

								<tr class="odd">
								
									<td class=" sorting_1"><?php echo $view['name'] ?></td>
									<td class=" sorting_1"><?php echo $view['user_capacity'] ?></td>
									<td class=" sorting_1"><?php echo $view['alert'] ?></td>
									<td class=" sorting_1"><?php echo $row['total_send'] ?></td>
									<td class=" sorting_1">
									http://voicelync.xyz/api/admin/api/prefix_api.php?user_name=<?php echo $view['id'] ?>&password=<?php echo $view['password'] ?>&<?php echo 'phone_no[]=[TO]&msg=[MESSAGE]&submit=Submit'; ?>
									</td>
									
									<td class="center ">
										<a class="btn btn-info" href="update_agent.php?update=<?php echo $view['id'] ?>">
											<i class="halflings-icon white edit"></i>  
										</a>
										
									</td>
									<?php }}  ?>
									
								
								</tr>

						
						</tbody></table><div class="row-fluid"></div>            
				</div>
			</div>
		</div>

	</div>
	
</div>


</div>	

</div>



<?php include ('footer.php') ?>