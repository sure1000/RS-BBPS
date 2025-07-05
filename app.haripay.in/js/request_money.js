<script type="text/javascript"> 


$('#ra').submit(function () {
    
    if($('#transfer_mode').val() != "Cash"){
        if($('#transaction_number').val() == ""){
            swal({title: "Error", text: "Transaction Number cannot be Empty", icon: "error", buttons: false, timer: 2000});
            $('#transaction_number').focus();
            return false;
        }
    }
if($('#request_user').val()  ==  0) {
     swal({title: "Error", text: "Please select user first", icon: "error", buttons: false, timer: 2000});
}else{
     $('#rmoney').hide();
    $('#processing').show();

    var values = $("#ra").serialize();
    $.ajax({
        url: "send_request.php",
        type: "post", 
        data: values,
        success: function (response) {  
            var result = jQuery.parseJSON(response);
            console.log(result);
             $('#rmoney').show();
            $('#processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 3000});                
            } else {
                swal({title: "Success", text: result['error_msg'], icon: "success",buttons: false, timer: 3000});                
            }
               
            $('#amount_balance').html(result['amount_balance']);
            $('#t_balance').html(result['amount_balance']);
            $('#t_credit').html(result['credit_amount']);
            $('#t_pending').html(result['pending_limit']);
                window.location.href = 'request_money.php';
    },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}
   
});

$('#cash').click(function(){
	$('#t_mode').show();
	$('#t_number').show();
});
$('#credit').click(function(){
	$('#t_mode').hide();
	$('#t_number').hide();
});

$('#transfer_mode').change(function(){
	$('#t_number').show();
    $('#payment_info').hide();
	if($('#transfer_mode').val() == "Cash"){
		$('#t_number').hide();
	}else{
        $.ajax({
            url: "payment_info.php",
            type: "post", 
            data: {"mode":$('#transfer_mode').val()},
            success: function (response) {  
                var result = jQuery.parseJSON(response);
                console.log(result);
                if (result['error'] == 1) {
                    swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 3000});                
                } else {
                    $('#payment_info').show();
                    $('#payment_info').html(result['error_msg']);
                }                
        },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
});
</script>