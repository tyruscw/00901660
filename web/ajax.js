$(document).ready(function() {
	$("#school").change(function() {
		var school_id = $(this).val();
		if(school_id != "") {
			$.ajax({
				url:"register_getter.php",
				data:{org_id:school_id},
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
