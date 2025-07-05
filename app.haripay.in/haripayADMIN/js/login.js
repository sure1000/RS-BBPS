<script type="text/javascript">
 // $(document).ready(function(){
     //   $("#myModal").modal('show');
  //  });
    $('#bz').submit(function(){
        $('#form_login').hide();
        $('#processing').show();
        var values = $("#bz").serialize();
        $.ajax({
            url: "login_check.php",
            type: "post",
            data: values,
            success: function(response) {
                var result = jQuery.parseJSON(response);
                console.log(result);
                if(result['error'] == 1){
                    swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                    $('#form_login').show();
                    $('#processing').hide();
                }else{
                    swal({title: "Success", text: result['error_msg'], icon:"success",buttons:false, timer:2000});
                    // window.location.href="index.php";
                    $('#processing').hide();
                    $('#form_login').hide();
                    $('#verify_otp').show();
                    $('#user_id').val(result['user_id']);

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $('#fp').submit(function(){
        $('#forgot_password').hide();
        $('#processing').show();

        var values = $('#fp').serialize();
        $.ajax({
            url: "forgot_password.php",
            type: "post",
            data: values,
            success: function(response) {
                var result = jQuery.parseJSON(response);
                console.log(result);

                if(result['error'] == 1){
                    swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                    $('#forgot_password').show();
                    $('#processing').hide();
                    $('#forgot_email').val('');
                }else{
                    swal({title: "Success", text: result['error_msg'], icon:"success",buttons:false, timer:2000});
                    $('#reset_password').show();
                    $('#processing').hide();
                    $('#reset_email').val($('#forgot_email').val());
                }
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });


    $('#rp').submit(function(){
        if($('#new_password').val() != $('#confirm_password').val()){
            swal({title: "Error", text: "New Password doesnot match with Confirm Password", icon:"error",buttons:false, timer:2000});
            return false;
        }

        $('#reset_password').hide();
        $('#processing').show();

        var values = $('#rp').serialize();
        $.ajax({
            url: "reset_password.php",
            type: "post",
            data: values,
            success: function(response) {
                var result = jQuery.parseJSON(response);
                console.log(result);

                if(result['error'] == 1){
                    swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                    $('#reset_password').show();
                    $('#processing').hide();
                    $('#new_password').val('');
                    $('#confirm_password').val('');

                }else{
                    swal({title: "Success", text: result['error_msg'], icon:"success",buttons:false, timer:2000});
                    $('#reset_password').hide();
                    $('#processing').hide();
                    $('#form_login').show();
                    $('#email').val($('#reset_email').val());
                }
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

$('#vo').submit(function(){
$('#verify_otp').hide();
$('#processing').show();
        var values = $('#vo').serialize();
        $.ajax({
            url: "verify_otp.php",
            type: "post",
            data: values,
            success: function(response) {
                var result = jQuery.parseJSON(response);
                console.log(result);

                if(result['error'] == 1){
                    swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                    $('#form_login').show();
                    $('#processing').hide();
                }else{
                    swal({title: "Success", text: result['error_msg'], icon:"success",buttons:false, timer:2000});
                     window.location.href="index.php";
                 }
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

});


	if($('#msg_id').val() == 1){
		swal({title: "Logout", text: "you have successfully logged out", icon:"success",buttons:false, timer:2000});
	}else if($('#msg_id').val() == 2){
        swal({title: "Login", text: "Please Login inorder to continue", icon:"success",buttons:false, timer:2000});
    }

    function forgot_password(){
        $('#form_login').hide();
        $('#forgot_password').show();
    }

    function show_login(id){
        $('#form_login').show();
        if(id == 1){
            $('#forgot_password').hide();   
        }else{
            $('#reset_password').hide();   
        }
        
    }
    function show_login1(id){
        $('#form_login').show();
        if(id == 1){
            $('#verify_otp').hide();
            $('#forgot_password').hide();   
            $('#reset_password').hide();   
        }
        
    }
    function resentOTP(){
        $('#verify_otp').hide();
       $('#processing').show();
        var user_id = $('#user_id').val();

           $.ajax({
            url: "resend_otp.php",
            type: "post",
            data: {"user_id":user_id},
           success: function(response) {
            
                $('#verify_otp').show();
                    $('#processing').hide();
                var result = jQuery.parseJSON(response);
               

               if(result['error'] == 1){
                    swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                    
                }else{
                    swal({title: "Success", text: result['error_msg'], icon:"success",buttons:false, timer:2000});
                    $('#user_id').val(result['user_id']);
                    
                 }
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });





    }
</script>