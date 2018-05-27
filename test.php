<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>php</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(function(){
	//acknowledgement message
    var message_status = $("#status");
    $("td[contenteditable=true]").blur(function(){
        var field_userid = $(this).attr("id") ;
        var value = $(this).text() ;
        $.post('ajax.php' , field_userid + "=" + value, function(data){
            if(data != '')
			{
				message_status.show();
				message_status.text(data);
				//hide the message
				setTimeout(function(){message_status.hide()},1000);
			}
        });
    });
	
});
</script>
<style>
table.zebra-style {
	font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	text-align:left;
	border:1px solid #ccc;
	margin-bottom:25px;
	width:90%
}
table.zebra-style th {
	color: #444;
	font-size: 13px;
	font-weight: normal;
	padding: 10px 8px;
}
table.zebra-style td {
	color: #777;
	padding: 8px;
	font-size:13px;
}
table.zebra-style tr.odd {
	background:#f2f2f2;
}
body {
	background:#fafafa;
}
.container {
	width: 800px;
	border: 1px solid #C4CDE0;
	border-radius: 2px;
	margin: 0 auto;
	height: 1300px;
	background:#fff;
	padding-left:10px;
}
#status { padding:10px; background:#88C4FF; color:#000; font-weight:bold; font-size:12px; margin-bottom:10px; display:none; width:90%; }
</style>
</head>
<body>
<div class="container"><br>

 <div id="status"></div>
<table class="table zebra-style">
    <thead>
      <tr>
        <th>Name</th>
        <th>Route Name</th>
        <th>Capacity</th>
        <th>Total send</th>
      </tr>
    </thead>
    <tbody>
	<?php
		require_once 'class/config.php';
		require_once 'class/control_view.php';
		$display_route_capacity = assign_route_capacity();
		while ($view = mysql_fetch_assoc($display_route_capacity)) {
			?>
      <tr class="odd">
        <td><?php echo $view['name'] ?></td>
        <td ><?php echo $view['route_name'] ?></td>
        <td id="capacity:2" contenteditable="true"><?php echo $view["capacity"]; ?></td>
        <td><?php echo $view['total_send'] ?></td>
      </tr>
		<?php } ?>
    </tbody>
 </table>
 <br>
<br>


</div>


    <!-- Start of Woopra Code -->

  
</body>
</html>