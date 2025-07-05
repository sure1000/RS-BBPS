<script type="text/javascript">
$('#upi_save').submit(function () {

        
        var values = $("#upi_set").serialize();
        $.ajax({
            url: "update_upi_details.php",
            type: "post",
            data: values,
            success: function (response) {
                var result = jQuery.parseJSON(response);
                console.log(result);
                if (result['error'] == 1) {

                    swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                    window.location.href = "index.php";
                } else {
                    swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                   
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

});
</script>