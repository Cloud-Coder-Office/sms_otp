<?php include('header_file.php');?>
<?php include('menu.php'); ?>
<?php include ('class/config.php');?>

	 <?php
		@$updaterid = $_GET['update'];
		if ($updaterid) {

		mysql_query("UPDATE user_route_api SET status = 0 where id='$updaterid'");
		}
	  ?>

	<script type="text/javascript">
		
		function updaterid(rid)
		{
		var msg=confirm('Are you sure you want to Inactive?');
		if(msg)
		{
			window.location="route_details.php?update="+rid;
		}
		}
	</script>
	 <?php
		@$updaterrid = $_GET['updatee'];
		if ($updaterrid) {

		mysql_query("UPDATE user_route_api SET status = 1 where id='$updaterrid'");
		}
	  ?>

	<script type="text/javascript">
		
		function updaterrid(cid)
		{
		var msg=confirm('Are you sure you want to Active?');
		if(msg)
		{
			window.location="route_details.php?updatee="+cid;
		}
		}
	</script>
	
<script type="text/javascript" src="js/form_process.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<div id="content" class="span10">
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="index.php">Home</a> 
	<i class="icon-angle-right"></i>
</li>
<li><a href="#">All Route Details</a></li>
</ul>



<div class="row-fluid">
	<div class="box span12">
		<div class="box span12">
			
			<div class="box-header" data-original-title="">
				<h2><i class="halflings-icon user"></i><span class="break"></span>ALL ROUTE DETAILS</h2>
				<div align="right" style="margin-top: -13px;" id="feedback"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#feedback-modal">Add Route</button></div>
				
			</div>
			<div class="box-content">
				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div class="dataTables_filter" id="DataTables_Table_0_filter"></div></div></div>
				<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						<thead>
							<tr role="row">
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">USER NAME</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ROUTE NAME</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ROUTE CAPACIITY</th>
								
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">TOTAL SEND</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ACTION</th>
							</tr>
						</thead>   

						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php
							require_once 'class/control_view.php';
							$display_route_capacity = assign_route_capacity();
							while ($view = mysql_fetch_assoc($display_route_capacity)) {
								?>

								<tr class="odd">
								
									<td><?php  echo $view['name'] ?></td>
									<td ><?php echo $view['route_name'] ?></td>
									<td ><?php echo $view["capacity"]; ?></td>
									
									<td><?php echo $view['total_send'] ?></td>
									<td class="center ">
									   <?php 
										if ($view['status'] == 1){
									   ?>
										<a class='btn btn-mini btn-primary' href='javascript:updaterid(rid=<?php echo $view['id'] ?>)'  rel='tooltip' title='Inactive'>Active </a>
										<?php }else{ ?>
										<a class='btn btn-mini btn-danger' href='javascript:updaterrid(cid=<?php echo $view['id'] ?>)'  rel='tooltip' title='Active'>Inactive </a>
										<?php } ?>
										
										<a class="btn btn-mini btn-info" href="update_capacity.php?update=<?php echo $view['id'] ?>">Update
											 
										</a>
									</td>

									
									
								</tr>

						<?php }
						?>
						</tbody></table><div class="row-fluid"></div>            
				</div>
			</div>
		</div>

	</div>
	<div id="feedback-modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">				
				<div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
					<h3>Assign Route</h3>
				</div>				
				<div class="modal-body">
					<form class="feedback" name="feedback">
						
						<div class="form-group">
						
						<div style="margin-left:145px;"class="controls">
						
						  
						  <select  id="user_id" name="user_id">
						  <option value="">SELECT USER</option>
						  <?php
										
							$display_name = view_agent();
							while ($view = mysql_fetch_assoc($display_name)) {
							echo "<option value='" . $view['id'] . "'>" . $view['name'] . "</option>";
							}
							?>
						  </select>
						</div>
					  </div>
					<?php
					$display_route = view_route();
						while ($view = mysql_fetch_assoc($display_route)) {
					?>
					  <div class="form-group">
						
						<label for="exampleInputEmail1"></label>
						
						  <input type="checkbox" name='route_id[]' value='<?php echo $view['route']; ?>'/> <?php echo $view['route_name']; ?>
						
						<input type="text" class="form-control" name="capacity[]" id="capacity" placeholder="Route Capacity">
					  </div>
					  
						<?php } ?>
						<br/>
						<!--<input type='submit' name="submit" class="btn btn-success" id="submit"></input>-->
					</form>
				</div>			
				<div class="modal-footer">
					<button class="btn btn-success" id="submit">Save</button>
					<a href="#" class="btn" data-dismiss="modal">Close</a>
				</div>
			</div>
		</div>
	</div>
</div>




</div>


<?php include ('footer.php') ?>