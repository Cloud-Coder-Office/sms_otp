<?php include('header_file.php'); ?>
<?php include('menu.php'); ?>
<?php include('class/config.php'); ?>


<?php 
require_once "class/control_view.php";
$total_sent = total_report($con);
$total_count = mysqli_fetch_assoc($total_sent);

$daily_sent = daily_report($con);
$daily_count = mysqli_fetch_assoc($daily_sent);

$last_week = view_last_week($con);
$last_week_count = mysqli_fetch_assoc($last_week);

$last_mont = view_last_month($con);
$last_month_count = mysqli_fetch_array($last_mont);
?>
<!-- start: Content -->

<div id="content" class="span10">
<div class="row-fluid">
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="home.php">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Dashboard</a></li>
<!--<li STYLE="margin-left: 125px"><label class="control-label" for="inputSuccess"><span STYLE="font-size: large; color: #4cae4c">PHONE NUMBER</span></label></li>
<li>
	<div class="control-group success">
		
		<div class="controls">
			<input onkeyup="valid_num(this.value)" type="text" name="phone_num" id="phone_num">
			<span id="get_result" class="help-inline"></span>
		</div>
	</div>
</li>--->
</ul>

<div class="row-fluid">

<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
<div class="number"> <?php echo $total_count['total'];?> <i class="icon-arrow-up"></i></div>
<div class="title">total</div>
<div class="footer">
<a href="#"> read full report</a>
</div>	
</div>
<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
<div class="number"><?php echo $daily_count['yestarday'];?><i class="icon-arrow-up"></i></div>
<div class="title">today</div>
<div class="footer">
<a href="#"> read full report</a>
</div>
</div>
<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
<div class="number"><?php echo $last_week_count['week'];?><i class="icon-arrow-up"></i></div>
<div class="title">this week</div>
<div class="footer">
<a href="#"> read full report</a>
</div>
</div>
<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
<div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
<div class="number"><?php echo $last_month_count['month'];?><i class="icon-arrow-down"></i></div>
<div class="title">this month</div>
<div class="footer">
<a href="#"> read full report</a>
</div>
</div>	

</div>
</div>
<script type="text/javascript">
function valid_num(value) {
$.get(
'ajax.valid_contract.php',
{action: "phone_valid", number: value},
function (data) {
$("#get_result").html(data);
}
)
}
function agent_status(value) {
$.get(
'ag_status.php',
{status: value},
function (data) {
$("#agent_status" + value).html(data);
}
)
}
</script>
<?php include ('footer.php') ?>
