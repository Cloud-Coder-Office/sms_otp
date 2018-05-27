<?php include('header_file.php');?>
<?php include('menu.php'); ?>
<?php include('date.php'); ?>
<?php include('class/config.php'); ?>

<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="home.php">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Agent Report</a></li>
    </ul>

    <div class="row-fluid">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon edit"></i><span class="break"></span>User Details</h2>

            </div>
		<div class="box-content">
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal">
                <fieldset>

                    <div class="control-group">
                            <!--<label class="control-label" for="inputSuccess">SELECT USER</label>-->
                            <div class="controls">
                                 <?php if ($_SESSION['ACCESS'] == true) { ?>
                                    <select name="user_id" id="user_id">
                                       <option value="0">SELECT USER</option>
									   <option value="all">All</option>
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
                        </div>
                    <div class="control-group" style="margin-left: 244px; margin-top: -52px;">
                        <!--<label class="control-label" for="datepicker">FROM </label>-->
                        <div class="controls">
                            <input type="text" name="date" id="datepicker" value="<?php echo date("m/d/Y", strtotime("first day of previous month"));?>">
                        </div>
                    </div>
                    <div class="control-group" style="margin-left:480px; margin-top: -58px;">
                        <!--<label class="control-label" for="datepicker1">TO</label>-->
                        <div class="controls">
                            <input type="text" name="datee" id="datepicker1" value="<?php echo date("m/d/Y");?>">
                        </div>
						 
                    </div>
                    <div class="form" style="margin-left:900px; margin-top: -57px;">
                        <button type="submit" name="home_search" id="home_search" value="Search" class="btn btn-primary">Search</button>

                    </div>
                </fieldset>
            </form>
			</div>
		</div>

        <div class="row-fluid">

            <div class="box span12">
                
                <div class="box-header" data-original-title="">
                    <h2><i class="halflings-icon user"></i><span class="break"></span>DETAILS</h2>

                </div>
                <div class="box-content">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div class="dataTables_filter" id="DataTables_Table_0_filter"></div></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">USER NAME</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date registered: activate to sort column ascending" style="width: 248px;">PHONE</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date registered: activate to sort column ascending" style="width: 248px;">MESSAGE</th>
									 <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 170px;">ROUTE NAME</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date registered: activate to sort column ascending" style="width: 248px;">DATE</th>
                                    

                                </tr>
                            </thead>   

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php
								if(isset($_POST['home_search'])){
                                $search = $_POST['user_id'];
                                $date_one = $_POST['date'];
								$date = date("Y-m-d H:i:s", strtotime($date_one));
                                $date_two = $_POST['datee'];
								$datee = date("Y-m-d H:i:s", strtotime($date_two));
								if ($search && $date && $datee) {
                                    $sql = "SELECT user.id, user.name,route_api.route,route_api.route_name,message_report.msg,message_report.phone_no,message_report.user_id,message_report.route_id,message_report.date FROM user INNER JOIN message_report ON user.id = message_report.user_id INNER JOIN route_api ON route_api.route = message_report.route_id WHERE date BETWEEN '$date' AND '$datee' AND message_report.user_id = '$search'";
                                    $result = mysql_query($sql) or die(mysql_error());
                                    while ($section = mysql_fetch_array($result)) {
										
										$string = str_replace(' ', '+', $section['msg']); // Replaces all spaces with hyphens.
                                        
					                    $msg = utf8_encode(preg_replace("/\+/", ' ', $string)); // Removes special chars.	
										
                                        ?>
                                        <tr class="odd">
                                            <td class=" sorting_1"><?php echo $section['name']; ?></td>
                                            <td class="center "><?php echo $section['phone_no']; ?></td>
                                            <td class="center "><?php echo utf8_decode($msg);  ?></td>
                                            <td class="center "><?php echo $section['route_name']; ?></td>
											<td class="center "><?php echo $section['date']; ?></td>
                                            
                                        </tr>

                                    <?php } ?>
                                    <?php
                                } if($search == 'all'){
                                $sql = "SELECT user.id, user.name,route_api.route,route_api.route_name,message_report.msg,message_report.phone_no,message_report.user_id,message_report.route_id,message_report.date FROM user INNER JOIN message_report ON user.id = message_report.user_id INNER JOIN route_api ON route_api.route = message_report.route_id";
									//print_r($sql);
									//exit;
                                    $result = mysql_query($sql) or die(mysql_error());

                                    while ($section = mysql_fetch_array($result)) {
										$string = str_replace(' ', '+', $section['msg']);
                                        
					                    $msg = utf8_encode(preg_replace("/\+/", ' ', $string));
                                        ?>
                                        <tr class="odd">
                                            <td class=" sorting_1"><?php echo $section['name'] ?></td>
                                            <td class="center "><?php echo $section['phone_no'] ?></td>
                                            <td class="center "><?php echo utf8_decode($msg); ?></td>
                                            <td class="center "><?php echo $section['route_name'] ?></td>
											<td class="center "><?php echo $section['date'] ?></td>
                                            
                                        </tr>

                                    <?php } ?>
                                    <?php
                                } else{}
								}
                                ?>


                            </tbody></table><div class="row-fluid"></div>            
                    </div>
                </div>
            </div>


        </div>


    </div>	

</div>





<?php include ('footer.php') ?>
