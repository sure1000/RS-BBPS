if ($('#msg_id').val() == 3) {
    swal({title: "Saved", text: "Information saved Successfully", icon: "success", buttons: false, timer: 2000});
} else if ($('#msg_id').val() == 2) {
    swal({title: "Login", text: "Please Login inorder to continue", icon: "success", buttons: false, timer: 2000});
} else if($('#msg_id').val() == 4){
    swal({title: "Notifications", text: "Notifications are Cleared Successfully", icon: "success", buttons: false, timer: 2000});
}else if($('#msg_id').val() == 5){
    swal({title: "Notifications", text: "Something went wrong please try again", icon: "error", buttons: false, timer: 2000});
}else if($('#msg_id').val() == 6){
    swal({title: "Notifications", text: "This plan is already Active on your Recharges.", icon: "success", buttons: false, timer: 2000});
}else if($('#msg_id').val() == 7){
    swal({title: "Notifications", text: "Plan Updated Successfully.", icon: "success", buttons: false, timer: 2000});
}else if($('#msg_id').val() == 8){
    swal({title: "Notifications", text: "IP Address is already Configured", icon: "error", buttons: false, timer: 2000});
}else if($('#msg_id').val() == 9){
    swal({title: "Notifications", text: "New Key Generated Successfully", icon: "success", buttons: false, timer: 2000});
}else if($('#msg_id').val() == 10){
    swal({title: "Notifications", text: "IP Address Removed Successfully", icon: "success", buttons: false, timer: 2000});
}else if($('#msg_id').val() == 11){
    swal({title: "Notifications", text: "You are not authorized to view this page", icon: "error", buttons: false, timer: 2000});
}  else if($('#msg_id').val() == 12){
    swal({title: "User Details", text: "Email / Mobile already Taken. Please try another", icon: "error", buttons: false, timer: 2000});
}

function check_ajax_logout(id) {
    if (id == 1) {
        window.location.href = 'logout.php';
    }
}


function notifications() {
    $.ajax({
        url: "notifications.php",
        type: "post",
        data: {"updte": 1},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if(result['notifications'] > 0){
                $('#notifications').html(result['notifications']);
            }else{
                $('#notifications').html('');
            }
            $('#amount_balance').html(result['amount_balance']);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    setTimeout(function () {notifications();}, 10000);
}
setTimeout(function () {notifications();}, 1000);

function show_notifications(){
    $.ajax({
        url: "my_notifications.php",
        type: "post",
        data: {"updte": 1},
        success: function (response) {
            $('#my_notifications').html(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function clear_notifications(){
    $.ajax({
        url: "clear_notifications.php",
        type: "post",
        data: {"updte": 1},
        success: function (response) {
            $('#my_notifications').html(response);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function check_status(id){
    $('#status_check').modal('show');
    $('#status_check_processing').show();
    $('#status_check_result').hide();

    $.ajax({
        url: "check_status.php",
        type: "post",
        data: {"updte": 1, "wallet_id":id},
        success: function (response) {
            //$('#status_check_result').html(response);
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#status_check_result').html(result['error_msg']);
            $('#status_check_processing').hide();
            $('#status_check_result').show();

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

$('#dispute_raise').submit(function(){
    $('#disputed_div').hide();
    $('#dispute_processing').show();
    var values = $("#dispute_raise").serialize();
    var ref_no = $('#ref_no_dispute').val();
    $.ajax({
        url: "dispute_recharge.php",
        type: "post",
        data: values,
        success: function (response) {
            //$('#status_check_result').html(response);
            var result = jQuery.parseJSON(response);
            console.log(result);
            if(result['error'] == 1){
                swal({title: "Dispute", text: result['error_msg'], icon: "warning", buttons: false, timer: 2000});
            }else{
                swal({title: "Dispute", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                $('#dispute_'+ref_no).removeClass("btn-warning");
                $('#dispute_'+ref_no).addClass("btn-outline-warning");
                $('#dispute_'+ref_no).html('Disputed');
                $('#dispute_'+ref_no).attr('disabled',true);
            }
            $('#dispute_issue').val('');
            $('#ref_no_dispute').val('0');
            $('#dispute_processing').hide();
            $('#dispute_modal').modal('hide');
            $('#disputed_div').show();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});

function dispute_recharge(ref_no){
    $('#dispute_modal').modal('show');
    $('#ref_no_dispute').val(ref_no);
}

if($('#kyc_id').val() == 0){
    $('#kyc_modal').modal('show');
}

if($('#notice_id').val() == 1){
    $('#notice_board').modal('show');
}

$('#reg_pan_no').keyup(function(){
    var a = $('#reg_pan_no').val();
    a = a.toUpperCase();
    $('#reg_pan_no').val(a);

});
