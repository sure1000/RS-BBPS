<script type="text/javascript">
	if($('#new_route').click(function(){
		$('#serviceMODAL').modal('show');
		$('#service_id').val('0');
		$('#provider_id').val('0');
		$('#amount_check').val('No');
		$('#api_id').val('0');
		$('#amount_from').val('');
		$('#amount_to').val('');
		$('#amount_from').prop("disabled",true);
		$('#amount_to').prop("disabled",true);
		$('#route_detail_id').val(0);

	}));

	$('#amount_check').change(function(){
		$('#amount_from').prop("disabled",true);
		$('#amount_to').prop("disabled",true);
		if($('#amount_check').val() == "Yes"){
			$('#amount_from').prop("disabled",false);
			$('#amount_to').prop("disabled",false);
		}else{
			$('#amount_from').val('');
			$('#amount_to').val('');
		}
	});

	function check_values(){
		if($('#amount_check').val() == "Yes"){
			if($('#amount_to').val() != ""){
				if(parseFloat($('#amount_to').val()) < parseFloat($('#amount_from').val())){
					swal({title: "Error", text: "Amount To cannot be less than Amount From", icon: "error", buttons: false, timer: 2000});
					return false;
				}
			}
		}
		return true;
	}

	$('#service_id').change(function(){
	    if($('#service_id').val() == "0"){
	        $('#provider_id').val('0');
	        $('#provider_id').attr("disabled",true);
	    }else{
	        $.ajax({
	            url: "fetch_providers.php",
	            type: "post",
	            data: {"updte": 1, "service_id":$('#service_id').val()},
	            success: function (response) {
	                $('#provider_list').html(response);
	            },
	            error: function (jqXHR, textStatus, errorThrown) {
	                console.log(textStatus, errorThrown);
	            }
	        });
	    }
	});

	function select_route(route_id){
		$('#route_detail_id').val(route_id);
		$('#serviceMODAL').modal('show');

		$.ajax({
	            url: "route_member_ajax.php",
	            type: "post",
	            data: {"updte": 1, "route_detail_id":$('#route_detail_id').val()},
	            success: function (response) {
	                var result = jQuery.parseJSON(response);
            		console.log(result);
            		$('#service_id').val(result['service_id']);
            		$('#amount_check').val(result['amount_check']);
            		$('#api_id').val(result['api_id']);
            		$('#amount_from').val(result['amount_from']);
            		$('#amount_to').val(result['amount_to']);
            		$('#route_detail_id').val(route_id);
            		if($('#amount_check').val() == "Yes"){
            			$('#amount_from').prop("disabled", false);
            			$('#amount_to').prop("disabled", false);
            		}else{
            			$('#amount_from').prop("disabled", true);
            			$('#amount_to').prop("disabled", true);
            		}
            		$.ajax({
			            url: "fetch_providers.php",
			            type: "post",
			            data: {"updte": 1, "service_id":$('#service_id').val()},
			            success: function (response) {
			                $('#provider_list').html(response);
			                $('#provider_id').val(result['provider_id']);
			            },
			            error: function (jqXHR, textStatus, errorThrown) {
			                console.log(textStatus, errorThrown);
			            }
			        });
	            },
	            error: function (jqXHR, textStatus, errorThrown) {
	                console.log(textStatus, errorThrown);
	            }
	        });

	}

	function check_priority(){
		for(var i=0;i<$('#total_routes').val();i++){
			for(j=0;j<$('#total_routes').val();j++){
				if(i != j){
					if($('#priority_'+i).val() == $('#priority_'+j).val()){					
                    	swal({title: "Error", text: "Priority "+$('#priority_'+i).val()+" is repeated. Please make it sure that it is only used once", icon:"error",buttons:false, timer:3000});
                    	return false;
					}
				}
			}
		}
		var values = $("#ra").serialize();
		$.ajax({
            url: "route_member_save.php",
            type: "post",
            data: values,
            success: function (response) {
            	var result = jQuery.parseJSON(response);
            	console.log(result);
            	if(result['error'] == 0){
            		swal({title: "Success", text: result['error_msg'], icon:"success",buttons:false, timer:3000});
            	}else{
            		swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:3000});
            	}
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
		
		return false;
	}
</script>