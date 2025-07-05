<script type="text/javascript">
function update_plan_route(plan_id, api_id){
	$.ajax({
	    url: "route_per_plan_save.php",
	    type: "post",
	    data: {"plan_id":plan_id, "api_id":api_id},
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

function open_modal(route_detail_id,amount_from,amount_to, api_id){
	$('#route_detail_id').val(route_detail_id);
	$('#amount_from').val(amount_from);
	$('#amount_to').val(amount_to);
	$('#api_id').val(api_id);

	$('#amountMODAL').modal('show');
}

function check_values(){

	if($('#amount_to').val() > 0){
		if(parseFloat($('#amount_from').val()) > parseFloat($('#amount_to').val())){
			swal({title: "Error", text: "From  Amount cannot be greater than To Amount", icon: "error", buttons: false, timer: 2000});
			return false;
		}	
	}
	
	return true;
}
</script>