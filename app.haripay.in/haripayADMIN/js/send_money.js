<script type="text/javascript">
$('#phone_email').change(function(){
    $('#amount').prop('disabled',true);
    $('#credit_paid').prop('disabled',true);
    $('#save').prop('disabled',true);
    $('#t_name').html('');
    $('#t_username').html('');
    $('#t_mobile').html('');
    $('#t_email').html('');
    $('#t_balance').html('0');
    $('#t_credit').html('0');
    $('#t_limit').html('0');
    $('#t_pending').html('0');
    $('#user_id').val('0');
    $('#user_info').hide();
    $('#processing').show();
    
    $.ajax({
        url: "user_info.php",
        type: "post",
        data: {"updte":1,"phone_email":$('#phone_email').val()},
        success: function(response) {
            //alert(response);
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            if(result['error'] == 1){
                swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                $('#user_info').show();
                $('#processing').hide();
            }else{
                swal({title: "Success", text: result['error_msg'], icon:"success", buttons:false, timer:2000});
                $('#user_id').val(result['user_id']);
                $('#amount').prop('disabled',false);
                $('#credit_paid').prop('disabled',false);
                $('#save').prop('disabled',false);
                $('#t_name').html(result['name']);
                $('#t_username').html(result['user_name']);
                $('#t_mobile').html(result['mobile']);
                $('#t_email').html(result['email']);
                $('#t_balance').html(result['amount_balance']);
                $('#t_credit').html(result['credit_amount']);
                $('#t_limit').html(result['credit_limit']);
                $('#t_pending').html(result['pending_limit']);
                $('#user_info').show();
                $('#processing').hide();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});


</script>