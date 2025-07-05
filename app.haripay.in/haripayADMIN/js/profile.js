<script type="text/javascript">
$(document).ready(function () {
    $('#change_password').submit(function () {
        var values = $("#change_password").serialize();
        if($('#new_password').val() != $('#confirm_password').val()){
            swal({title: "Error", text: "New Password & Confirm Password Donot Match", icon: "error", buttons: false, timer: 2000});
            $('#confirm_password').val('');
            $('#confirm_password').focus();
            return false;
        }


        $("#cpassword").hide();
        $("#c_processing").show();
        $.ajax({
            url: "save_change_password.php",
                type: "post",
                data: values,
                success: function (response) {
                
                var results = jQuery.parseJSON(response);
                $("#cpassword").show();
                $("#c_processing").hide();
                if (results['error'] == 1) {
                    swal({title: "Error", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});             
                } else {
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});             
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
    });
});
</script>