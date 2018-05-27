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
           <a href="home.php">Home</a> 
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
					$route_name  = $_POST['route_name'];
					$route_capacity  = $_POST['route_capacity'];
					$alert  = $_POST['alert'];
					$get_valid =valid_route_by_id($route_name,$route_capacity);
					if($get_valid == true){
						$get_info = update_route($up_id,$route_name,$route_capacity,$alert);
						if($get_info == true){ ?>
							<ul class="tickets metro">
								<li class="ticket blue">
									<a href="#">
										<span class="content">
										<span class="status">Status: [ Update Success ]</span>
										</span>	                                                       
									</a>
								</li>
							</ul>
							
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
							require_once('class/control_view.php');
							$view = view_route_by_id($up_id);
						?>
                      <div class="control-group">
                           <label class="control-label" for="inputSuccess">ROUTE NAME</label>
                            <div class="controls">
                               <input type="text" name="route_name"  id="route_name" value="<?php echo $view['route_name']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
					   
					   <div class="control-group">
                           <label class="control-label" for="inputSuccess">ROUTE CAPACITY</label>
                            <div class="controls">
                               <input type="text" name="route_capacity"  id="route_capacity" value="<?php echo $view['route_capacity']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
					   <div class="control-group">
                           <label class="control-label" for="inputSuccess">ROUTE CAPACITY</label>
                            <div class="controls">
                               <input type="text" name="alert"  id="alert" value="<?php echo $view['alert']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
                       
					   
                       <div class="form-actions">
                           <button type="submit"  class="btn btn-primary">Save changes</button>
                           <a href="add_route.php" class="btn">Cancel</a>
                       </div>
                   </fieldset>
               </form>

           </div>

       </div>

   </div>
   <?php include ('footer.php') ?>