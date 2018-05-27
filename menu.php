<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="home.php"><span>SMS ADMIN PANEL</span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
				
                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i>
                            <?php
                            echo $_SESSION['NAME'] . " (" . $_SESSION['ADMIN'] . ")";
                            ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <span>Account Settings</span>
                            </li>
							<?php
                    if ($_SESSION['ACCESS'] == true) {
                        ?>
                            <!--<li><a href="change_pass.php"><i class="halflings-icon user"></i> CHANGE PASS</a></li>-->
					<?php } ?>
                            <li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
                        </ul>
                    </li>
					
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->
<div class="container-fluid-full">
    <div class="row-fluid">
        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a href="home.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
					<li><a href="route_details.php"><i class="icon-file-alt"></i><span class="hidden-tablet">  Route Details</span></a></li>
                    <li><a href="add_user.php"><i class="icon-file-alt"></i><span class="hidden-tablet">Customer</span></a></li>
						
                    <li><a href="add_route.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Route</span></a></li>
					<li><a href="assign_route.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Assign Route</span></a></li>
					<li><a href="add_otp_message.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> OTP Message</span></a></li>
					
					
					<li>
						<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Report</span></a>
						<ul>
							
							<li><a href="report.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> User Report</span></a></li>
							<li><a href="route_report.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Route Report</span></a></li>
							<li><a href="otp_report.php"><i class="icon-file-alt"></i><span class="hidden-tablet">OTP Report</span></a></li>
							<li><a href="otp_route_report.php"><i class="icon-file-alt"></i><span class="hidden-tablet">OTP Report By Route</span></a></li>
							
						</ul>	
					</li>
					
					
					
                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->