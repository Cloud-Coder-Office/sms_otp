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
        <li><a href="#">Update Contract</a></li>
    </ul>

    <div class="row-fluid">
        <div class="box span10">
            <div class="box-content">
             <?php 
			// session_start();
			   if (isset($_GET['id']))
			   {
				   $id = $_GET['id'];
				   $_SESSION['id']=$id ;
				   $name= $_GET['name'];
				   $_SESSION['name']=$name;
				   $phone = $_GET['phone'];
				   $_SESSION['phone'] = $phone;
			   }
				
				 if (isset($_REQUEST['submit'])) {
					 if (isset($_SESSION['id']))
					   {
						   $id = $_SESSION['id'];
						   $name = $_SESSION['name'];
						   $phone = $_SESSION['phone'];
					   }
					 
                            extract($_POST);
                          
                            $up1 = $_FILES['picture']['name'];
							$up2 = $_FILES['picture']['tmp_name'];
							$type = $_FILES['picture']['type'];
							$up4 = $_FILES['picture']['size'];
							$update_name = "UPDATE user_control SET name = '$name', ssc = '$ssc' WHERE id = '$id' limit 1";
							$query_for_update_name = mysql_query($update_name) or die (mysql_error());
							
							
                               
		
							if ($up2 != "" && $type == "image/png" || $type == "image/jpeg" || $type == "image/jpg" || $type == "image/gif" && $up4 <= 50480) {
                                $image_type=explode("/",$type);
								$image_name=$name .'_' . $phone .'.'. $image_type[1];
								$destination = "../profile_picture/";
								move_uploaded_file($up2, $destination . $image_name);
                                
                                if (isset($_FILES["picture"]["name"]) && $_FILES["picture"]["tmp_name"] != ""){
                                 $sql1 = "UPDATE user_control SET picture='$image_name' WHERE id = '$id' limit 1";
                                $query = mysql_query($sql1) or die(mysql_error());
                              
							  }
							if($query_for_update_name = true ||  $query = true){
								
								echo'<div class="alert alert-success alert-dismissable">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>Update Success </div>'; 
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=view_member_data.php">';
                              
                               
							}else{
								echo'<div class="alert alert-danger alert-dismissable">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>Update Failed </div>'; 
                             echo '<META HTTP-EQUIV="Refresh" Content="0; URL=view_member_data.php">';
                               exit;
							} 
                      }
				 }   
                        ?>
						</div>
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Update Contract</h2>
                <div class="box-icon">
                    <a href="view_member_data.php" class="btn btn-primary"><i class="halflings-icon fast-backward"></i>GOO BACK</a>

                </div>
            </div>
            <div class="box-content">
               <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        
						<div class="control-group">
                            <label class="control-label" for="inputSuccess"> Name</label>
                            <div class="controls">
							    	<?php $get_info = view_contract_by_id($id); ?>
                                <input type="text" name="name"  id="name" value="<?php	echo $get_info['name']; ?>">
                                <span class="help-inline"></span>
                            </div>
                        </div>
						<div class="control-group">
                            <label class="control-label" for="inputSuccess"> S.S.C Batch</label>
                            <div class="controls">
							    	<?php $get_info = view_contract_by_id($id); ?>
                                <input type="text" name="ssc"  id="ssc" value="<?php	echo $get_info['ssc']; ?>">
                                <span class="help-inline"></span>
                            </div>
                        </div>
                        <div class="control-group success">
                            <label class="control-label" for="inputSuccess">PROFILE PICTURE</label>
							 
                            <div class="controls">
                                <input type="file" id="picture" name="picture"><img src = "../profile_picture/<?php echo $get_info['picture']; ?>" height = "40px" width = "40px">
                                <span class="help-inline"></span>
                            </div>
                        </div>
                      
                       
                        <div class="form-actions">
                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                            <button class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>




<?php include ('footer.php') ?>