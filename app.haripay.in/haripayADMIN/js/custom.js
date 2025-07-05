if ($('#msg_id').val() == 3) {
    swal({title: "Saved", text: "Information saved Successfully", icon: "success", buttons: false, timer: 2000});
} else if ($('#msg_id').val() == 4) {
    swal({title: "Error", text: "Something went wrong please try again", icon: "error", buttons: false, timer: 2000});
} else if ($('#msg_id').val() == 5) {
    swal({title: "Success", text: "User Wallet has been updated Successfully", icon: "success", buttons: false, timer: 2000});
} else if ($('#msg_id').val() == 6) {
    swal({title: "Success", text: "Money Transfer Succesful", icon: "success", buttons: false, timer: 2000});
} else if ($('#msg_id').val() == 7) {
    swal({title: "Rejected", text: "Money Transfer Rejected", icon: "error", buttons: false, timer: 2000});
}


function notifications() {
    $.ajax({
        url: "notification_counter.php",
        type: "post",
        data: {"updte": 1},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if(result['disputes'] > 0){
                $('#notifications').html(result['disputes']);
            }else{
                $('#notifications').html('');
            }

            if(result['notification'] > 0){
                $('#admin_notifications').html(result['notification']);
            }else{
                $('#admin_notifications').html('');
            }
            // if(result['notifications'] > 0){
            //     $('#admin-notifications').html(result['notifications']);
            // }else{
            //     $('#admin-notifications').html(result['disputes']);
            // }
            

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    setTimeout(function () {notifications();}, 10000);
}
setTimeout(function () {notifications();}, 1000);


function show_notifications(){
    // alert('hlo');
    $.ajax({
        url: "my_notifications.php",
        type: "post",
        data: {"updte": 1},
        success: function (response) {
            $('#my_notifications').html(response);    
            // $('#notifications').html       
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function show_admin_notifications(){
    // alert('hlo');
    $.ajax({
        url: "my_admin_notifications.php",
        type: "post",
        data: {"updte": 1},
        success: function (response) {
            $('#my_admin_notifications').html(response);    
            // $('#notifications').html       
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


function check_ajax_logout(id) {
    if (id == 1) {
        window.location.href = 'logout.php';
    }
}