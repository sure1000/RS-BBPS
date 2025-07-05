<script type="text/Javascript">

    $('#change_password').click(function(){
        $.ajax({
            url: "change_user_password.php",
            type: "post",
            data: {"updte":1,"user_id":$('#user_id').val()},
            success: function(response) {
                //alert(response);
                var result = jQuery.parseJSON(response);
                console.log(result);
                check_ajax_logout(result['ajax_logout']);
                if(result['error'] == 1){
                    swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                }else{
                    swal({title: "Success", text: result['error_msg'], icon:"success"});
                    //window.location.href="index.php";
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    
    $('#force_logout').click(function(){
        swal({
            title: "Are you sure?",
            text: "This will logout user from all the devices!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "force_logout.php",
                    type: "post",
                    data: {"updte":1,"user_id":$('#user_id').val()},
                    success: function(response) {
                        //alert(response);
                        var result = jQuery.parseJSON(response);
                        console.log(result);
                        check_ajax_logout(result['ajax_logout']);
                        if(result['error'] == 1){
                            swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                        }else{
                            swal({title: "Success", text: result['error_msg'], icon:"success"});
                            //window.location.href="index.php";
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            } else {
                swal("Nothing has changed. The user account is working");
            }
        });
    });

    function edit_Services(user_id){
     $.ajax({
          url:'get_userServices.php',
          type:'post',
          data:{"updte":1,"user_id":user_id},
        success: function(response) {
       
              $('#service_plan_id').html(response);
              $('#user_id').val(user_id);
                $('#plan_modal').modal('show');
          },
        error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }


    });


    }
function set_service(value,service_name){
    var userId = $('#user_id').val();
   $.ajax({
            url:'update_userService.php',
            type:'post',
            data:{"updte":1,"status_val":value,"service_name":service_name,"user_id":userId},
            success: function(response) {
              
          },
        error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
    });



}

$('#whitelabel').submit(function () {

/*var values = new FormData();
values.append('email', $('#email').val());
values.append('mobile', $('#mobile').val());
values.append('address', $('#address').val());
values.append('website', $('#website').val());
values.append('web_url', $('#web_url').val());
values.append('is_active', $('#is_active').val());

values.append('logo', $('#logo')[0].files[0]);
values.append('app_link', $('#app_link')[0].files[0]);*/
        
        var values = $("#whitelabel").serialize();
        $.ajax({
            url: "add_label.php",
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
		var values = $("#whitelabel2").serialize();
        $.ajax({
            url: "add_site_detailes.php",
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

function user_rights(id) {

    $.ajax({
        url: "get_user_services.php",
        type: "post",
        data: {"updte": 1, "user_id": id},
        success: function (response) {

            var result = jQuery.parseJSON(response);
            if (result['error'] == 1) {

                $('#user_service_rights').html(result['body']);
            }
        }

    });
    $('#user_rights_status').modal('toggle');
} 

function save_user_rights(service_id, i, user_id) {

    var status = $('#status_' + i).prop("checked");
    if (status == false) {
        var status = "No";
    } else {
        var status = "Yes";
    }


    $.ajax({
        url: "save_user_rights.php",
        type: "post",
        data: {"id": user_id, "service_id": service_id, "status": status, "updte": 1},

        success: function (response) {
            var results = jQuery.parseJSON(response);
            $('#processing_update_status').hide();
            if (results['error'] == 1) {

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


$('#update_status').submit(function () {

    swal({title: "Success", text: "User rights updated successfully", icon: "success"});
    $('#user_rights_status').modal('hide');

});

</script>