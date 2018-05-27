function SubmitFormData() {
	var user_id = $("#user_id").val();
	var route_id = $("#route_id").val();
	var capacity = $("#capacity").val();
	
	$.post("submit.php", { user_id: user_id, route_id: route_id, capacity:capacity},
	   function(data) {
		 $('#results').html(data);
		 $('#myForm')[0].reset();
	   });
}

