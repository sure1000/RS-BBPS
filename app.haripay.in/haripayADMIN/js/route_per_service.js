<script type="text/javascript">
function update_service_route(service_id, api_id){
	$.ajax({
	    url: "route_per_service_save.php",
	    type: "post",
	    data: {"service_id":service_id, "api_id":api_id},
	    success: function (response) {
	        var result = jQuery.parseJSON(response);
            console.log(result);

            if(result['error'] == 0){
            	swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
            }else{
            	swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            }
	    },
	    error: function (jqXHR, textStatus, errorThrown) {
	        console.log(textStatus, errorThrown);
	    }
	});
}
</script>