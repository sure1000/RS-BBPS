<script type="text/javascript">

  //  $(document).ready(function(){
      //  $("#myModal").modal('show');
   // });

$('#bz').submit(function () {
    $('#form_login').hide();
    $('#processing').show();
    var values = $("#bz").serialize();
    $.ajax({
        url: "login_check.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                $('#form_login').show();
                $('#processing').hide();
            } else if(result['error'] == 2){
            swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                window.location.href = "whitelabel_user/index.php";
                    }else{
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                window.location.href = "index.php";
            }
    },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});

$('#rg').submit(function () {
    $('#register').hide();
    $('#processing').show();
    var values = $("#rg").serialize();

    $.ajax({
        url: "register.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                $('#register').show();
                $('#processing').hide();
            } else {
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                $('#verify_otp').show();
                $('#verify_user_id').val(result['verify_user_id']);
                $('#processing').hide();
                // window.location.href="index.php";
            }


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});
$('#votp').submit(function () {
    $('#verify_otp').hide();
    $('#processing').show();
    var values = $("#votp").serialize();
    $.ajax({
        url: "verify_otp.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                $('#verify_otp').show();
                $('#processing').hide();
            } else {
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                // window.location.href="index.php";
                if (result['user_type'] == "Whitelabel User")
                {
                  window.location.href = "whitelabel_user/index.php";
                }
                else{
                window.location.href="index.php";
            }
          }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});
$('#fp').submit(function () {
    $('#forgot_password').hide();
    $('#processing').show();
    var values = $('#fp').serialize();
    $.ajax({
        url: "forgot_password.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                $('#forgot_password').show();
                $('#processing').hide();
                $('#forgot_email').val('');
            } else {
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                $('#reset_password').show();
                $('#processing').hide();
                $('#reset_email').val($('#forgot_email').val());
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});


$('#rp').submit(function () {
    if ($('#new_password').val() != $('#confirm_password').val()) {
        swal({title: "Error", text: "New Password doesnot match with Confirm Password", icon: "error", buttons: false, timer: 2000});
        return false;
    }

    $('#reset_password').hide();
    $('#processing').show();

    var values = $('#rp').serialize();
    $.ajax({
        url: "reset_password.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                $('#reset_password').show();
                $('#processing').hide();
                $('#new_password').val('');
                $('#confirm_password').val('');

            } else {
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                $('#reset_password').hide();
                $('#processing').hide();
                $('#form_login').show();
                $('#email').val($('#reset_email').val());
            }


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});




if ($('#msg_id').val() == 1) {
    swal({title: "Logout", text: "you have successfully logged out", icon: "success", buttons: false, timer: 2000});
} else if ($('#msg_id').val() == 2) {
    swal({title: "Login", text: "Please Login inorder to continue", icon: "success", buttons: false, timer: 2000});
}

function forgot_password() {
    $('#form_login').hide();
    $('#forgot_password').show();
}
function create_account() {
    $('#form_login').hide();
    $('#register').show();
}
function resend_otp(type){

var id = $("#verify_user_id").val();
   $('#verify_otp').hide();
    $('#processing').show();
 $.ajax({
        url: "resend_otp.php",
        type: "post",
        data: {"type":type, "user_id":id},
        success: function (response) {
            var result = jQuery.parseJSON(response);
           // console.log(result);
               $('#verify_otp').show();
    $('#processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
    } else {
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});

            }


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function show_login(id) {
    $('#form_login').show();
    $('#register').hide();
    $('#verify_otp').hide();
    if (id == 1) {
        $('#forgot_password').hide();
    } else {
        $('#reset_password').hide();
    }

}
</script>
