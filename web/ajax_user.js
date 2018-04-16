$(document).ready(function() {
	$("#school").change(function() {
		var user_id = $(this).val();
		if(user_id != "") {
			$.ajax({
				url:"register_getter.php",
				data:{user_id:school_id},
				type:'POST',
				success:function(response) {
					var resp = $.trim(response);
					$("#org").html(resp);
				}
			});
		} else {
			$("#org").html("<option value=''>------- Select --------</option>");
		}
	});
});
