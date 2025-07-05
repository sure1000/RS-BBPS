<script type="text/javascript">
 $('#payment_submit').submit(function () {
        var values = $("#payment_submit").serialize();
        $("#payment_submit").hide();
        $("#processing_payment").show();
        $.ajax({
            url: "save_payment_request.php",
            type: "post",
            data: values,
            success: function (response) {
                   var result = jQuery.parseJSON(response);
       $("#payment_submit").show();
             $("#processing_payment").hide();
if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
 } else {
            $("#payment_request_modal").modal("toggle");
            $("#remarks").val("");
            $("#request_money_status").val("0");
            $("#request_money_id").val("0");
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
             }
               window.location.href = 'pending_requests.php';
           
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

function change_payment_request(type , id){
$("#payment_request_modal").modal("toggle");
$("#order_id").html("ORD0"+id);
$("#request_money_id").val(id);
$("#request_money_status").val(type);

}
</script>