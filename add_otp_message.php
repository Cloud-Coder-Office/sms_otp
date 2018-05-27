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
		<h2><i class="halflings-icon edit"></i><span class="break"></span>Message</h2>

	</div>
	<div class="box-content">
		<?php
		
		    if ($_SERVER['REQUEST_METHOD'] == "POST") 
			{
				require_once 'class/control_register.php';
				require_once 'class/control_valid.php';
				
				$incomming_string         = strtoupper($_POST['incomming_string']);
				$outgooing_string         = $_POST['outgooing_string'];
				
				
				$valid_user = valid_ot_message($incomming_string);
				if ($valid_user == true) {
				$get_info = register_otp_message($incomming_string,$outgooing_string);
				
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
				<label class="control-label" for="inputSuccess">Incoming Message</label>
				<div class="controls">
					<input type="text" name="incomming_string" id="name">
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputSuccess">Outgoing Message</label>
				<div class="controls">
					<input type="text" name="outgooing_string" id="user_capacity">
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
				<h2><i class="halflings-icon user"></i><span class="break"></span>ALL</h2>

			</div>
			<div class="box-content">
				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div class="dataTables_filter" id="DataTables_Table_0_filter"></div></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						<thead>
							<tr role="row">
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">Incomming Message</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">Outgooing Message</th>
								
								
								
							</tr>
						</thead>   

						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php
							require_once 'class/control_view.php';
							$display_otp_message = view_otp_message();
							while ($view = mysql_fetch_assoc($display_otp_message)) {
								
								?>

								<tr class="odd">
								
									<td class=" sorting_1"><?php echo $view['incomming_string'] ?></td>
									<td class=" sorting_1"><?php echo $view['outgoing_string'] ?></td>
									
									
									
									<?php }  ?>
									
								
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