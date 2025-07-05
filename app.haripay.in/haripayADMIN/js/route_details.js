<script type="text/javascript">
$('#route_type').change(function(){
	
	$('#from_amount').prop('disabled', true);
	$('#to_amount').prop('disabled', true);

	if($('#route_type').val() == "Amount"){ 
		$('#from_amount').prop('disabled', false);
		$('#to_amount').prop('disabled', false);
	}else{
		$('#from_amount').val('');
		$('#to_amount').val('');
	}
});


$('#route_for').change(function(){
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
    
});
</script>