<script type="text/Javascript">

function reset(){
	$("send_sms")[0].reset();
}

$("#send_sms").submit(function(e){
	e.preventDefault();
	$("#send_sms").hide();
	$("#sms_processing").show();
	var user_type =$("#user_type").val();
	var mobile =$("#phone_email").val();

	if (user_type =="0" && mobile=="") {
		swal({title: "Error", text: "Please Enter Number / User type", icon:"error",buttons:false, timer:2000});
			$("#send_sms").show();
	$("#sms_processing").hide();
		return false;
	}
 
	 var values = $("#send_sms").serialize();

	if  (user_type!="0" || mobile!="" ) {

		$.ajax({
			url: "sendSms.php",
			type: "post",
			data: values,
			
			success: function(response) {
				$("#send_sms").show();
				$("#sms_processing").hide();
				var result = jQuery.parseJSON(response);
				if(result['error'] == 1){
					swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});

				}else{
					swal({title: "Success", text: result['error_msg'], icon:"success",buttons:false, timer:2000});
					$("#send_sms")[0].reset();

				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}


});
</script>