<?php include('header_file.php');?>
<?php include('menu.php'); ?>
<?php include ('class/config.php');?>

	 <?php
		@$updaterid = $_GET['update'];
		if ($updaterid) {

		mysql_query("UPDATE user_route_api SET status = '0' where id='$updaterid'");
		}
	  ?>

	<script type="text/javascript">
		
		function updaterid(rid)
		{
		var msg=confirm('Are you sure  want to Inactive?');
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

<div id="content" class="span10">
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="home.php">Home</a> 
	<i class="icon-angle-right"></i>
</li>
<li><a href="#">All Route Details</a></li>
</ul>



<div class="row-fluid">
	<div class="box span12">
		<div class="box span12">
			
			<div class="box-header" data-original-title="">
				<h2><i class="halflings-icon user"></i><span class="break"></span>ALL ROUTE DETAILS</h2>
				<div align="right" style="margin-top: -13px;" id="feedback"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#feedback-modal">Assign Route</button></div>
				
			</div>
			<div class="box-content">
				<div id="" class="" role="grid">
				<div class="row-fluid">
					<div class="span6">
					
						 <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal">
							 <fieldset>
							   <div class="controls">
									 <?php if ($_SESSION['ACCESS'] == true) { ?>
										<select name="user_id" id="user_id">
											<option value="0">SELECT CUSTOMER</option>
										<?php
										require_once 'class/control_view.php';
										$agent = view_agent();
										while ($get_agent = mysql_fetch_assoc($agent)) {
											echo "<option value=" . $get_agent['id'] . ">" . $get_agent['name'] . "</option>";
										}
										?>
										</select>
									<?php } ?>
									
									<span class="help-inline"></span>
								</div>
								<div style="margin-left:480px">
									<button align="right" style="margin-top: -55px;" type="submit" name="home_search" id="home_search" value="Search" class="btn btn-primary">Apply</button>

								</div>
						   </fieldset>
						</form>
					</div>
				</div>
				<table class="table table-striped table-bordered" id="" aria-describedby="">
						<thead>
							<tr role="row">
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">USER NAME</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ROUTE NAME</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ROUTE INTERVAL</th>
								
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">TOTAL SEND</th>
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ACTION</th>
							</tr>
						</thead>   
						<?php 
							if(!isset($_POST['home_search'])){  
						
						?>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							 <?php
								require_once 'class/control_view.php';
								$display_route_capacity = assign_route_capacity();
								while ($view = mysql_fetch_assoc($display_route_capacity)) {
						     ?>

								<tr class="odd">
								
									<td><?php echo $view['name']; ?></td>
									<td><?php echo $view['route_name']; ?></td>
									<td><?php echo $view["capacity"]; ?></td>
									
									<td><?php echo $view['total_send']; ?></td>
									<td class="center">
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
						</tbody>
							<?php } elseif(isset($_POST['home_search'])){
									$search = $_POST['user_id'];
								   
									if ($search) {
                                    $sql = "SELECT  user_route_api.user_id,user_route_api.status, user.name, route_api.route, route_api.route_name , route_api.route_capacity, user_route_api.id,user_route_api.capacity, user_route_api.total_send,user_route_api.user_id FROM user INNER JOIN user_route_api ON user.id =user_route_api.user_id INNER JOIN route_api ON user_route_api.route_id = route_api.route WHERE user_route_api.user_id = $search";
									$query = mysql_query($sql) or die (mysql_error());
								       while ($view = mysql_fetch_assoc($query)) {
                                  ?>
						         <tbody role="alert" aria-live="polite" aria-relevant="all">
                               
									
                                        <tr class="odd">
                                            <td class=" sorting_1"><?php echo $view['name'] ?></td>
                                            <td class="center "><?php echo $view['route_name'] ?></td>
                                            <td class="center "><?php echo $view['capacity'] ?></td>
                                            <td class="center "><?php echo $view['total_send'] ?></td>
											<td class="center">
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

                                    <?php } ?>
                                    <?php
                                }
								}
                                ?>


                            </tbody>
						
						</table><div class="row-fluid"></div>            
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
