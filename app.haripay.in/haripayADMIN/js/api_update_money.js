  function check_balance(id){
        
        $.ajax({
        url: "api_balance_check.php",
        type: "post",
        data: {"id":id},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
           
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
               
            } else {
                swal({title: "Success",   text: "Api Balance : Rs." + result['Balance'] + "", icon: "success", buttons: true});
               
            }
    },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
        
    }