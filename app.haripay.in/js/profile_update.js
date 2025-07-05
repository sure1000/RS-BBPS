<script type="text/javascript">	
$(document).ready(function () {
    $('#update_profile').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
 
        $.ajax({
            url: "update_user_profile.php",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                if (results['error'] == 0) {
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});
                    $('#profile_picture').html(results['profile_pic']);
                    $('#header_profile_pic').html(results['profile_pic']);
                    //window.location.href='profile.php';
                } else {
                    swal({title: "Error", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
            }
        });
    });
});
</script>