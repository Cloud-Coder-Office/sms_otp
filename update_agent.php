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
       <li><a href="#">Update User Name</a></li>
   </ul>

   <div class="row-fluid">
       <div class="box span10">	
       <div class="box-content">
       		<?php
				$up_id = $_GET['update'];
				if($_SERVER['REQUEST_METHOD']=="POST"){
					require_once('class/control_update.php');
					require_once('class/control_valid.php');
					$user_name     = $_POST['name'];
					$pass          = $_POST['password'];
					@$one_way      = $_POST['one_way'];
					@$sms_capacity = $_POST['user_capacity'];
					$alert         = $_POST['alert'];
					$get_valid = valid_agent_by_id($user_name);
					if($get_valid == true){
						$get_info = update_agent($up_id,$user_name,$pass,$one_way,$sms_capacity,$alert);
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
										<span class="status">Status: [ Phone Number Already used ]</span>
										</span>	                                                       
									</a>
								</li>
							</ul>
				<?php	}
					
				}
			?>
       </div>		
           <div class="box-header" data-original-title="">
               <h2><i class="halflings-icon edit"></i><span class="break"></span>USER</h2>

           </div>
           <div class="box-content">
           		
               <form  action="" method="POST" class="form-horizontal">
                   <fieldset>
						<?php 
							require_once('class/control_view.php');
							$view = view_agent_by_id($up_id);
						?>
                      <div class="control-group">
                           <label class="control-label" for="inputSuccess">USER NAME</label>
                            <div class="controls">
                               <input type="text" name="name"  id="name" value="<?php echo $view['name']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
					   <div class="control-group">
                           <label class="control-label" for="inputSuccess">SMS CAPACITY</label>
                            <div class="controls">
                               <input type="text" name="user_capacity"  id="user_capacity" value="<?php echo $view['user_capacity']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
					   <div class="control-group">
                           <label class="control-label" for="inputSuccess">SMS ALERT</label>
                            <div class="controls">
                               <input type="text" name="alert"  id="alert" value="<?php echo $view['alert']; ?>">
                               <span class="help-inline"></span>
                           </div>
                       </div>
					   <div class="control-group">
						<label class="control-label" for="inputSuccess">PASSWORD </label>
						<div class="controls">
							<input type="password" name="password" id="password" value="<?php echo $view['password']; ?>">
							<span class="help-inline"></span>
						</div>
					  </div>
                       <div class="control-group">
					   
						<label class="control-label">SELECT CHECK BOX</label>
						<div class="controls">
						  <label class="checkbox inline">
							<div id="uniform-inlineCheckbox1" class="checker">
							<span>
							<?php if($view['one_way'] == 1){
								$check ='checked';
								?>
							  <input id="one_way" name="one_way" value="1" type="checkbox" <?php echo $check; ?>>
							  <?php }else{ ?>
							  <input id="one_way" name="one_way" value="1" type="checkbox">
							  <?php } ?>
							</span>
							</div>
							one way
						  </label>
						
						</div>
					  </div>
					   
                       <div class="form-actions">
                           <button type="submit" class="btn btn-primary">Save changes</button>
                           <a href="add_user.php" class="btn">Cancel</a>
                       </div>
                   </fieldset>
               </form>

           </div>

       </div>

   </div>
   <?php include ('footer.php') ?>