<script type="text/javascript">
function update_api_key(id) {

    $.ajax({
        url: "update_api_key.php",
        type: "post",
        data: {"id": id},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);

            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});

            } else {
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                window.location.href = 'api_details.php?aid=' + id;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}
    
</script>