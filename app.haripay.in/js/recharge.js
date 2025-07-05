<script type="text/javascript">
var type = window.location.hash.substr(1);
refresh_service(type);
var search1 = "";
$(document).ready(function () {
    $('#prepaid_number').keyup(function () {
        if ($('#prepaid_number').val().length == 10) {
            check_number($('#prepaid_number').val(), "prepaid");
        }

    });
    $('#postpaid_number').keyup(function () {
        if ($('#postpaid_number').val().length == 10) {
            check_number($('#postpaid_number').val(), "postpaid");
        }

    });

// ipay recharge start
    $('#ipay_login').submit(function () {
        $('#ipay_submit').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);
        var values = $('#ipay_login').serialize();
        $.ajax({
            url: 'ipay_join_dmr.php',
            type: 'post',
            data: values,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                $('#ipay_submit').html("Continue").prop('disabled', false);
                $('#ipay_login').show();
                if (results['error'] == '1') {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", timer: 2000, html: true, showConfirmButton: false});
                } else if (results['error'] == '3') {
                    //not register go to register screen
                    $('#ipay_login').hide();
                    $('#ipay_register').show();
                    $('#ipay_mobile_reg').val(results['ipay_mobile']);
                    $('#ipay_mobileNo').val(results['ipay_mobile']);
                } else if (results['error'] == '2') {
                    //not verified go to verified  screen

                    $('#ipay_login').hide();
                    $('#ipay_pin').show();
                    $('#ipay_user_id').val(results['ipay_user_id']);
                } else if (results['error'] == '0') {
                    // verified go to Login screen screen
                    swal({title: "Success", text: results['error_msg'], icon: "success", timer: 2000, html: true, showConfirmButton: false});
                    setTimeout(location.reload.bind(location), 2000);
                }
            },
        });
    });
    $('#ipay_ben_del_otp').submit(function () {
        $('#ipay_submit_del').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);
        var values = $('#ipay_ben_del_otp').serialize();
        $.ajax({
            url: 'ipay_delete_ben.php',
            type: 'post',
            data: values,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                $('#ipay_submit_del').html("Verify").prop('disabled', false);
                if (results['error'] == '1') {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", timer: 2000, html: true, showConfirmButton: false});
                } else if (results['error'] == '0') {
                    // verified go to Login screen screen
                    swal({title: "Success", text: results['error_msg'], icon: "success", timer: 2000, html: true, showConfirmButton: false});
                    $('#beneficiary_list').DataTable().ajax.reload();
                }
            },
        });
    });
    $('#ipay_register').submit(function () {
        $('#ipay_reg_submit').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);
        var values = $('#ipay_register').serialize();
        $.ajax({
            url: 'ipay_join_dmr_register.php',
            type: 'post',
            data: values,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                $('#ipay_reg_submit').html("Register").prop('disabled', false);
                $('#ipay_register').show();
                if (results['error'] == '1') {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", timer: 2000, html: true, showConfirmButton: false});
                } else if (results['error'] == '2') {
                    //not verified go to verified  screen
                    $('#ipay_register').hide();
                    $('#ipay_pin').show();
                    $('#ipay_user_id').val(results['ipay_user_id']);
                    swal({title: "Success", text: results['error_msg'], icon: "success", timer: 2000, html: true, showConfirmButton: false});

                } else if (results['error'] == '0') {
                    // verified go to Login screen screen
                    swal({title: "Success", text: results['error_msg'], icon: "success", timer: 2000, html: true, showConfirmButton: false});
                    setTimeout(location.reload.bind(location), 2000);
                }
            },
        });
    });
    $('#ipay_pin').submit(function () {
        $('#ipay_pin_submit').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);
        var values = $('#ipay_pin').serialize();
        $.ajax({
            url: 'ipay_pin.php',
            type: 'post',
            data: values,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                $('#ipay_pin_submit').html("Save").prop('disabled', false);
                if (results['error'] == '1') {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", timer: 2000, html: true, showConfirmButton: false});
                } else if (results['error'] == '0') {
                    // verified go to Login screen screen
                    swal({title: "Success", text: results['error_msg'], icon: "success", timer: 2000, html: true, showConfirmButton: false});
                    setTimeout(location.reload.bind(location), 2000);
                }
            },
        });
    });
    $("#imps_register_btn").click(function () {
        $("#ipay_login").hide();
        $("#ipay_register").show();
    });
    $("#ipay_back_btn").click(function () {
        $("#ipay_login").show();
        $("#ipay_register").hide();
    });


    $("#forget_pin").click(function () {
        $('#forget_pin').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);
        var ipay_user_id = $('#ipay_user_id').val();
        $.ajax({
            url: "ipay_forget_pin.php",
            type: "post",
            data: {"updte": 1, "ipay_user_id": ipay_user_id},
            success: function (response) {
                var results = jQuery.parseJSON(response);
                console.log(results);
                $('#forget_pin').html("Forgot Pin").prop('disabled', false);
                if (results['error'] == '0') {
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});
                } else {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $('#ipay_add_beneficiary').submit(function () {
        $('#ipay_submit').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);
        var values = $("#ipay_add_beneficiary").serialize();
        $.ajax({
            url: "ipay_add_beneficiary.php",
            type: "post",
            data: values,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                console.log(results);
                $('#ipay_submit').html("Save").prop('disabled', false);
                if (results['error'] == 0) {
                    document.getElementById("ipay_add_beneficiary").reset()
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: true});
                    $('#beneficiary_list').DataTable().ajax.reload();
                } else if (results['error'] == 1) {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: true});
                } else if (results['error'] == 2) {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: true});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $("#get_name").click(function () {
        $('#get_name').html("<i class='fa fa-spinner fa-spin'></i> Wait..").prop('disabled', true);
        var account = $("#accountNo_pay").val();
        var ifsc = $("#ifscCode_pay").val();
        if (account == "" || ifsc == "") {
            $('#get_name').html("Verification").prop('disabled', false);
            swal({title: "Failed", text: "Please enter  Account no. & Ifsc code. ", icon: "error", buttons: false, timer: 2000});
            return false;
        }
        $.ajax({
            url: "ipay_ben_verify.php",
            type: "post",
            data: {"updte": 1, "name": name, "account": account, "ifsc": ifsc},
            success: function (response) {
                var results = jQuery.parseJSON(response);
                console.log(results);
                $('#get_name').html("Verification").prop('disabled', false);
                if (results['error'] == 0) {
                    swal({title: "Success", text: results['error_msg'], icon: "success", html: true, showConfirmButton: true});
                    $('#beneficiaryName_ipay').val(results['ben_name']);
                    $('#ipay_balance_limit').html(results['ipay_balance_limit']);
                    $('#ipay_balance').html(results['ipay_balance']);

                } else if (results['error'] == 1 || results['error'] == 2) {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", timer: 2000, html: true, showConfirmButton: false});

                } else if (results['error'] == 3) {
                    swal({title: "Pending", text: results['error_msg'], icon: "warning", timer: 2000, html: true, showConfirmButton: false});

                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });


    });
    $('#ipay_send_money').submit(function () {
        $('#i_send_submit').html("<i class='fa fa-spinner fa-spin'></i> Wait...").prop('disabled', true);
        var values = $("#ipay_send_money").serialize();
        $.ajax({
            url: "ipay_send_money.php",
            type: "post",
            data: values,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                console.log(results);
                $('#i_send_submit').html("Send").prop('disabled', false);
                if (results['error'] == '0') {
                    document.getElementById("ipay_send_money").reset()
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});
                    $('#ipay_balance_limit').html(results['ipay_balance_limit']);
                    $('#ipay_balance').html(results['ipay_balance']);
                } else {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    });
    $('#pz_send_money').submit(function () {
       
        $('#pz_send_submit').html("<i class='fa fa-spinner fa-spin'></i> Wait...").prop('disabled', true);
        var values = $("#pz_send_money").serialize();
        $.ajax({
            url: "pz_send_money.php",
            type: "post",
            data: values,
            success: function (response) {
                var results = jQuery.parseJSON(response);
                console.log(results);
                $('#pz_send_submit').html("Send").prop('disabled', false);
                if (results['error'] == '0') {
                    document.getElementById("pz_send_money").reset()
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});
                    $('#ipay_balance_limit').html(results['ipay_balance_limit']);
                    $('#ipay_balance').html(results['ipay_balance']);
                } else {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    });


    var reload_history = $('#recharge_history').DataTable({

        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "ordering": false,
        'ajax': {
            type: "post",
            data: {'search_new': $('#search_new').val()},
            'url': 'recharge_history.php'
        },
        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
        'columns': [
            {data: 'transaction_date'},
            {data: 'transaction_type'},
            {data: 'ref'},
            {data: 'opid'},
            {data: 'actual_amount'},
            {data: 'amount'},

            {data: 'user_new_balance'},
        ]
    });
    var reload_beneficiary_list = $('#beneficiary_list').DataTable({

        "serverSide": false,
        "processing": true,
        "paging": true,
        "searching": true,
        "ordering": false,
        'ajax': {
            type: "post",
            data: {'search_new': $('#search_new').val()},
            'url': 'ipay_ben_list.php'
        },
        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
        'columns': [

            {data: 'ben_details'},
            {data: 'Action'},
        ]
    });
    function reload_data() {
        //setTimeout(function(){ reload_history.ajax.reload();}, 3000);
        reload_history.ajax.reload();
        setTimeout(function () {
            reload_data();
        }, 30000);
    }
    setTimeout(function () {
        reload_data();
    }, 30000);
});

function ipay_transfer(id) {
    $('#ipay_send_money').show();
    $('#ipay_add_beneficiary').hide();
    $.ajax({
        url: "ipay_get_beneficiary.php",
        type: "post",
        data: {"updte": 1, "ben_id": id},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            $('#beneficiary_id_ipay').val('');
            if (result['error'] == "0") {
                $('#beneficiary_id_ipay').html(result['beneficiary_id']);
                $('#action_mode').html(result['action_mode']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}
function delete_recipient_ipay(id) {


    $.ajax({
        url: "ipay_delete_ben_otp.php",
        type: "post",
        data: {"updte": 1, "ben_id": id},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            if (result['error'] == "2") {

                $('#ipay_ben_del_otp_md').modal('toggle');
                $('#benificiary_id_del').val(id);
            } else if (result['error'] == "0") {
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                $('#beneficiary_list').DataTable().ajax.reload();
            } else if (result['error'] == "1") {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}
$('#electricity').submit(function () {
    $('#electricity_submit').attr("disabled", true);
    $('#electricity_submit').val('Processing...');
    var values1 = $('#electricity').serialize();
    $.ajax({
        url: 'recharge_electricity.php',
        type: 'post',
        data: values1,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            if (result['error'] == 0) {
                $('#electricity_submit').attr("disabled", false);
                $('#electricity_submit').val('Pay Bill');
                  document.getElementById("electricity").reset();
                swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
            } else {

                $('#electricity_submit').attr("disabled", false);
                $('#electricity_submit').val('Pay Bill');
                $('#electricity_modal').modal('show');
                
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});


            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });


});
$('#prepaid').submit(function () {
//    $('#recharge_data').modal('show');
//    $('#recharge_logo').html($('#prepaid_provider_logo').html());
//    $('#number_data').html($('#prepaid_number').val());
//    $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#prepaid_amount').val() + "</b>");
//    $('#recharge_type').val('prepaid');
//    commission_tax($("#prepaid_amount").val());
    $('#prepaid').hide();
    $('#mobile_processing').show();
    var values = $("#prepaid").serialize();
    $.ajax({
        url: "recharge_prepaid.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#prepaid').show();
            $('#mobile_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#prepaid_amount").val('');
                $("#prepaid_number").val('');
                $("#prepaid_provider").val('');
                $("#stv_data").val('0');
                $("#prepaid_circle").val('');
                $("#amount_balance").html(result['amount_balance']);
                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});
$('#landline').submit(function () {

    if ($('#landline_number').val() == "") {
        $('#errormessge1').html('Landline number Required');
    } else if ($('#landline_provider').val() == "") {
        $('#errormessge2').html('Select landline provide Required');
    } else if ($('#landline_amount').val() == "") {
        $('#errormessge5').html('Enter amount number');
    } else if ($('#landline_account_number').val() == "") {
        $('#errormessge3').html('Account number Required');
    } else if ($('#landline_circle').val() == "") {
        $('#errormessge4').html('Landline circle Required');
    } else
    {
        $('#recharge_data').modal('show');
        $('#recharge_logo').html($('#landline_provider_logo').html());
        $('#number_data').html($('#landline_number').val());
        $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#landline_amount').val() + "</b>");
        $('#recharge_type').val('landline');
        commission_tax($("#landline_amount").val());
    }



});
$('#water').submit(function () {
    var error = false;
    if ($('#water_mobile').val() == "") {
        $('#errormessge18').html('Customer Number Required');
        error = true;
    }
    if ($('#water_state').val() == "") {
        $('#errormessge14').html('Select State Required');
        error = true;
    }
    if ($('#water_amount').val() == "") {
        $('#errormessge17').html('Enter amount');
        error = true;
    }
    if ($('#water_account_number').val() == "") {
        $('#errormessge15').html('Account number Required');
        error = true;
    }
    if ($('#water_circle').val() == "") {
        $('#errormessge16').html('Select service provider Required');
        error = true;
    }
    if ($('#water_last_date').val() == "") {
        $('#errormessge19').html('last date Required');
        error = true;
    }
    if (error == false) {
        $('#recharge_data').modal('show');
        $('#recharge_logo').html($('#water_provider_logo').html());
        $('#number_data').html($('#water_account_number').val());
        $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#water_amount').val() + "</b>");
        $('#recharge_type').val('water');
        commission_tax($("#water_amount").val());
    }
});
function recharge_water() {
    var values = $("#water").serialize();
    $("#utility_processing").show();
    $.ajax({
        url: "recharge_water.php",
        type: "post",
        data: values,
        success: function (response) {
            $("#utility_processing").hide();
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#water').show();
            $('#roffer_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#water_state").val('');
                $("#water_account_number").val('');
                $("#water_circle").val('');
                // $("#water_amount").val('');
                $("#water_mobile").val('');
                $("water_last_date").val('');
                $("#water_amount").html(result['amount_balance']);
                /*if(result['status'] == "Success"){
                 swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                 }else if(result['status'] == "Pending"){
                 swal({title: "Accepted", text: result['error_msg'], icon: "warning", buttons: false, timer: 2000});
                 }else{
                 swal({title: "Failed", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                 }*/

                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

// function recharge_electricity() {
//     var values = $("#electricity").serialize();
//     $("#utility_processing").show();
//     $.ajax({
//         url: "recharge_electricity.php",
//         type: "post",
//         data: values,
//         success: function (response) {
//             $("#utility_processing").hide();
//             var result = jQuery.parseJSON(response);
//             console.log(result);
//             $('#electricity').show();
//             $('#roffer_processing').hide();
//             if (result['error'] == 1) {
//                 swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
//             } else {
//                 $("#water_state").val('');
//                 $("#water_account_number").val('');
//                 $("#water_circle").val('');
//                 // $("#water_amount").val('');
//                 $("#water_mobile").val('');
//                 $("water_last_date").val('');

//                 $("#water_amount").html(result['amount_balance']);
//                 /*if(result['status'] == "Success"){
//                  swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
//                  }else if(result['status'] == "Pending"){
//                  swal({title: "Accepted", text: result['error_msg'], icon: "warning", buttons: false, timer: 2000});
//                  }else{
//                  swal({title: "Failed", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
//                  }*/

//                 $('#recharge_status_response').html(result['response']);
//                 $('#recharge_status').modal('show');
//             }
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log(textStatus, errorThrown);
//         }
//     });
// }
/*$('#electricity').submit(function () {
 var error = false;
 if ($('#water_mobile').val() == "") {
 $('#errormessge18').html('Customer Number Required');
 error = true;
 }
 if ($('#water_state').val() == "") {
 $('#errormessge14').html('Select State Required');
 error = true;
 }
 if ($('#water_amount').val() == "") {
 $('#errormessge17').html('Enter amount');
 error = true;
 }
 if ($('#water_account_number').val() == "") {
 $('#errormessge15').html('Account number Required');
 error = true;
 }
 if ($('#water_circle').val() == "") {
 $('#errormessge16').html('Select service provider Required');
 error = true;
 }
 if ($('#water_last_date').val() == "") {
 $('#errormessge19').html('last date Required');
 error = true;
 }
 if (error == false) {
 $('#recharge_data').modal('show');
 $('#recharge_logo').html($('#water_provider_logo').html());
 $('#number_data').html($('#water_account_number').val());
 $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#water_amount').val() + "</b>");
 $('#recharge_type').val('water');
 commission_tax($("#water_amount").val());
 }
 });*/

function change_kyc(id) {
    $('#kyc_div').hide();
    if (id == "false") {
        $('#kyc_div').hide();
    } else if (id == "true") {
        $('#kyc_div').show();
    }
}
function recharge_prepaid() {
    $('#prepaid').hide();
    $('#mobile_processing').show();
    var values = $("#prepaid").serialize();
    $.ajax({
        url: "recharge_prepaid.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#prepaid').show();
            $('#mobile_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#prepaid_amount").val('');
                $("#prepaid_number").val('');
                $("#prepaid_provider").val('');
                $("#stv_data").val('0');
                $("#prepaid_circle").val('');
                $("#amount_balance").html(result['amount_balance']);
                /*if(result['status'] == "Success"){
                 swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                 }else if(result['status'] == "Pending"){
                 swal({title: "Accepted", text: result['error_msg'], icon: "warning", buttons: false, timer: 2000});
                 }else{
                 swal({title: "Failed", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                 }*/

                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function get_providers(value, service_id) {
    $('#provs').remove();
    if (value == "") {
        value = "All";
    }
    $.ajax({
        url: "get_electricity_provider.php",
        type: "post",
        data: {"state": value, "service_id": service_id, "update": 1},
        success: function (response) {
            var result = jQuery.parseJSON(response);
//

            $('#provs_onchanges').show();
            $('#provs_onchanges').html(result['provider']);
            if (value == "Maharashtra") {
                $('#bill_unit').show();
                $('#sub_div').hide();
            } else {
                $('#bill_unit').hide();
                $('#sub_div').hide();
            }
            if (value == "Jammu Kashmir") {
                $('#sub_div').show();
                $('#bill_unit').hide();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function Elec_provider_info(id, service) {

    if (id == "") {
        id = 0;
    }
    if (service == "") {
        service = "Electricity";
    }
    $.ajax({
        url: "provider_info_elec.php",
        type: "post",
        data: {"provider_id": id, "updte": 1},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            $('#prepaid_submit').prop('disabled', false);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {


                $('#' + service + '_provider_logo').html(result['logo']);
            }


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


function recharge_landline() {
    var values = $("#landline").serialize();
    $("#mobile_processing").show();
    $.ajax({
        url: "recharge_landline.php",
        type: "post",
        data: values,
        success: function (response) {
            $("#mobile_processing").hide();
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#landline').show();
            $('#roffer_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#landline_amount").val('');
                $("#landline_number").val('');
                $("#landline_provider").val('');
                $("#landline_circle").val('');
                $("#amount_balance").html(result['amount_balance']);
                /*if(result['status'] == "Success"){
                 swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                 }else if(result['status'] == "Pending"){
                 swal({title: "Accepted", text: result['error_msg'], icon: "warning", buttons: false, timer: 2000});
                 }else{
                 swal({title: "Failed", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                 }*/

                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function recharge_dth_activation() {
    var values = $("#dth_activation").serialize();
    $("#mobile_processing").show();
    $.ajax({
        url: "recharge_dth_activation.php",
        type: "post",
        data: values,
        success: function (response) {
            $("#mobile_processing").hide();
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#dth_activation').show();
            $('#roffer_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#dth_activation_amount").val('');
                $("#dth_activation_mobile").val('');
                $("#dth_activation_provider").val('');
                $("#amount_balance").html(result['amount_balance']);
                /*if(result['status'] == "Success"){
                 swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
                 }else if(result['status'] == "Pending"){
                 swal({title: "Accepted", text: result['error_msg'], icon: "warning", buttons: false, timer: 2000});
                 }else{
                 swal({title: "Failed", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                 }*/

                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


$('#postpaid').submit(function () {
    $('#postpaid').hide();
    $('#mobile_processing').show();
    var values = $("#postpaid").serialize();
    $.ajax({
        url: "recharge_postpaid.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#postpaid').show();
            $('#mobile_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#postpaid_amount").val('');
                $("#postpaid_number").val('');
                $("#postpaid_provider").val('');
                $("#postpaid_circle").val('');
                $("#amount_balance").html(result['amount_balance']);
                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});


$('#dth').submit(function () {

    $('#dth').hide();
    $('#dth_processing').show();
    var values = $("#dth").serialize();
    $.ajax({
        url: "recharge_dth.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#dth').show();
            $('#dth_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#dth_amount").val('');
                $("#dth_number").val('');
                $("#dth_provider").val('');
                $("#amount_balance").html(result['amount_balance']);
                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});

//rech dmr start
$('#rech_login').submit(function () {
    var value = $('#rech_login').serialize();
    $('#rech_submit').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);
    $.ajax({
        url: 'rech_join_dmr.php',
        type: 'post',
        data: value,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['status'] == 0) {
                swal({title: "Error", text: result['error'], icon: "error", buttons: false, timer: 2000});


            } else if (result['status'] == 1) {
                swal({title: "Success", text: result['error'], icon: "success", buttons: false, timer: 2000});
// swal({title: result['error'], type: "success", timer: 2000, html: true, showConfirmButton: false});
                setTimeout(location.reload.bind(location), 2000);
            } else if (result['status'] == 2) {

                $('#rech_mobile_re').val(result['rech_mobile_reg']);
                $('#rech_login').hide();
                $('#rech_register').show();
            }
        },

    });
});
$('#rech_register').submit(function () {
    var value = $('#rech_register').serialize();
    $.ajax({
        url: 'rech_join_dmr.php',
        type: 'post',
        data: value,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['status'] == 0) {
                swal({title: "Sucess", text: result['error'], icon: "success", buttons: false, timer: 2000});
                if (result['otpRequired'] == 1) {
                    $('#rech_register').hide();
                    $('#rech_mobile_verify').val(result['rech_mobile_verify']);
                    $('#rech_customer_verify').show();
                } else {
                    setTimeout(location.reload.bind(location), 2000);
                }

            } else if (result['status'] == 1) {
                swal({title: "Success", text: result['error'], icon: "success", buttons: false, timer: 2000});
// swal({title: result['error'], type: "success", timer: 2000, html: true, showConfirmButton: false});
                setTimeout(location.reload.bind(location), 2000);
            } else if (result['status'] == 2) {
                swal({title: "Error", text: result['error'], icon: "error", buttons: false, timer: 2000});

            }
        },

    });
});
$('#rech_customer_verify').submit(function () {
    var values = $('#rech_customer_verify').serialize();
    $.ajax({
        url: 'rech_customer_verify.php',
        type: 'post',
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if (result['status'] == 0) {
                swal({title: "Error", text: result['error'], icon: "error", buttons: false, timer: 2000});
            } else {
                swal({title: "Success", text: result['error'], icon: "success", buttons: false, timer: 2000});
                setTimeout(location.reload.bind(location), 2000);
            }
        },
    });
});

$('#rech_add_recipient').submit(function () {
    var values = $(this).serialize();
    $('#rech_ben_verify_form').hide();
    $('#rech_add_recipient').hide();
    $('#rech_processing').show();
    $.ajax({
        url: "rech_add_recipient.php",
        type: "post",
        data: values,
        success: function (response) {
            // alert(response);
            var results = jQuery.parseJSON(response);
            $('#rech_processing').hide();
            if (results['status'] == 0) {
                swal({title: results['error'], type: "error", timer: 2000, html: true, showConfirmButton: false});
                $('#rech_ben_verify_form').hide();
                $('#rech_add_recipient').show();
            } else if (results['status'] == 1) {
                swal({title: results['error'], type: "success", timer: 2000, html: true, showConfirmButton: false});
                $('#rech_benificiary_id_otp').val(results['rech_benificiary_id_otp']);
                $('#rech_ben_verify_form').show();
                $('#rech_add_recipient').hide();
// setTimeout(location.reload.bind(location), 2000);
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    return false;
});
$("#rech_get_name").click(function () {

    var name = $("#rech_recipient_name").val();
    var account = $("#rech_account").val();
    var ifsc = $("#rech_ifsc").val();
    if (name == "" || account == "" || ifsc == "") {
        swal({title: "Failed", text: "Please enter Beneficiary Name , Account no. & Ifsc code. ", icon: "error", buttons: false, timer: 2000});
        return false;
    }
// $('#rech_add_recipient').hide();
    $('#rech_processing').show();
    $.ajax({
        url: "rech_acc_verify.php",
        type: "post",
        data: {"updte": 1, "rech_recipient_name": name, "rech_acc_number": account, "rech_ifsc": ifsc},
        success: function (response) {
            var results = jQuery.parseJSON(response);
            console.log(results);
            $('#rech_add_recipient').show();
            $('#rech_processing').hide();
            if (results['error'] == '0') {

                if (results['status'] == 'Success') {
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: true, timer: 2000});
                } else {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: true, timer: 2000});
                }
            } else {
                swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: true, timer: 2000});
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });


});
$('#rech_send_money_form').submit(function () {
    var values = $("#rech_send_money_form").serialize();
    alert(values);
    $('#rech_send_money_form').hide();
    $('#rech_processing').show();
    $.ajax({
        url: "rech_send_money.php",
        type: "post",
        data: values,
        success: function (response) {
            var results = jQuery.parseJSON(response);
            console.log(results);
            // alert(results);
            $('#rech_send_money_form').show();
            $('#rech_processing').hide();
            if (results['error'] == '0') {
                if (results['status'] == "Success") {
                    $('#rech_send_popup').modal('toggle');
                    $('#rech_send_popup_id').html(results['response']);
                    // swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});

                } else if (results['status'] == "Failed") {
                    swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
                }
            } else {
                swal({title: "Failed", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});


$('#rech_acc_verify_form').submit(function () {

    //$('#processing_three_g_1').show();
    var values = $(this).serialize();
    alert(values);
    var ab = $('#credit_amount').html();
    var amt = 3;
    $('#rech_processing').show();
    $('#acc_ver_hide').hide();
    $.ajax({
        url: "rech_acc_verify.php",
        type: "post",
        data: values,
        success: function (response) {
            //alert(response);
            var results = jQuery.parseJSON(response);
            $('#rech_processing').hide();
            $('#acc_ver_hide').show();
            $('#rech_ben_info').show();
            $('#ben_name').html(results['ben_name']);
            $('#charged_amt').html(results['charged_amt']);
            $('#benificiary_acc').html(results['benificiary_acc']);
            $('#ipay_ifsc_bn').html(results['ipay_ifsc']);
            $('#ver_status').html(results['ver_status']);
            swal({title: results['error'], timer: 2000, html: true, showConfirmButton: false});


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    return false;
});

$('#rech_ben_verify_form').submit(function () {
    var values = $(this).serialize();
    $('#rech_processing').show();
    $.ajax({
        url: "rech_ben_verify_form.php",
        type: "post",
        data: values,
        success: function (response) {
            // alert(response);
            var results = jQuery.parseJSON(response);
            $('#rech_processing').hide();
            if (results['status'] == 0) {
                swal({title: results['error'], type: "error", timer: 2000, html: true, showConfirmButton: false});
            } else if (results['status'] == 1) {
                swal({title: results['error'], type: "success", timer: 2000, html: true, showConfirmButton: false});
                setTimeout(location.reload.bind(location), 2000);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    return false;
});

//rech dmr end

$('#gas').submit(function () {
    var error = false;
    if ($('#gas_state').val() == "") {
        $('#errormessge20').html('State Required');
        error = true;
    }
    if ($('#gas_account_number').val() == "") {
        $('#errormessge21').html('Account Number Required');
        error = true;
    }
    if ($('#gas_circle').val() == "") {
        $('#errormessge22').html('Provider Required');
        error = true;
    }
    if ($('#gas_amount').val() == "") {
        $('#errormessge23').html('Amount Required');
        error = true;
    }
    if ($('#gas_last_date').val() == "") {
        $('#errormessge25').html('Last date Required');
        error = true;
    }
    if ($('#gas_mobile').val() == "") {
        $('#errormessge24').html('Mobile Number Required');
        error = true;
    }

    if (error == false) {
        $('#recharge_data').modal('show');
        $('#recharge_logo').html($('#gas_provider_logo').html());
        $('#number_data').html($('#gas_mobile').val());
        $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#gas_amount').val() + "</b>");
        $('#recharge_type').val('gas');
        commission_tax($("#gas_amount").val());
    }
});


function recharge_gas() {
    var values = $("#gas").serialize();
    $.ajax({
        url: "recharge_gas.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#gas').show();
            $('#utility_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#gas_amount").val('');
                $("#gas_mobile").val('');
                $("#gas_circle").val('');
                //$("#postpaid_circle").val('');
                $("#amount_balance").html(result['amount_balance']);
                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
$('#school_fee').submit(function () {
    var error = false;
    if ($('#school_fee_state').val() == "") {
        $('#errormessge26').html('State Required');
        error = true;
    }
    if ($('#school_fee_account_number').val() == "") {
        $('#errormessge27').html('Account Number Required');
        error = true;
    }
    if ($('#school_fee_circle').val() == "") {
        $('#errormessge28').html('Provider Required');
        error = true;
    }
    if ($('school_fee_dob').val() == "") {
        $('#errormessge29').html('DOB Required');
    }
    if ($('#school_fee_amount').val() == "") {
        $('#errormessge30').html('Amount Required');
        error = true;
    }
    if ($('#school_fee_pay_amount').val() == "") {
        $('#errormessge31').html('Amount Required');
        error = true;
    }
    if ($('#school_fee_last_date').val() == "") {
        $('#errormessge33').html('Last date Required');
        error = true;
    }
    if ($('#school_fee_mobile').val() == "") {
        $('#errormessage32').html('Mobile Number Required');
        error = true;
    }

    if (error == false) {
        $('#recharge_data').modal('show');
        $('#recharge_logo').html($('#school_fee_provider_logo').html());
        $('#number_data').html($('#school_fee_mobile').val());
        $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#school_fee_pay_amount').val() + "</b>");
        $('#recharge_type').val('school_fee');
        commission_tax($("#school_fee_pay_amount").val());
    }
});


function recharge_school_fee() {
    var values = $("#school_fee").serialize();
    $.ajax({
        url: "recharge_school_fee.php",
        type: "post",
        data: values,
        success: function (response) {

            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#school_fee').show();
            $('#school_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#school_fee_pay_amount").val('');
                $("#school_fee_mobile").val('');
                $("#school_fee_circle").val('');
                //$("#postpaid_circle").val('');
                $("#amount_balance").html(result['amount_balance']);
                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


function dth_activation_monthsplan(value) {

    $.ajax({
        url: "dth_user_plan.php",
        type: "post",
        data: {"months": value, "update": 1},
        success: function (response) {
            $("#dth_activation_provider_info").hide();
            $("#show_data").html(response)
        }
    });
}
function get_amount(id) {

    var dish = $("#dth_activation_amount").val(id);
    $.ajax({
        url: "dth_activation_provider.php",
        type: "post",
        data: {"dish": dish},
        success: function (response) {
            $("#dth_activation_provider_info").hide();
            $("#show_data").html(response)
        }
    });

}
/*function dth_activation_provider(){
 var dish = $('#dth_activation_provider').val();
 alert(dish);
 $.ajax({
 url: "dth_activation_provider.php",
 type: "post",
 data: { "dish": dish},
 success: function (response) {
 var result = jQuery.parseJSON(response);
 $("#dth_activation_provider").html(result['logo'])
 }
 });
 }*/

$('#dth_activation').submit(function () {

    var error = false;
    if ($('#dth_activation_provider').val() == "") {
        $('#errormessge5').html('DTH provider Required');
        error = true;
    }
    if ($('#dth_activation_box_type').val() == "") {
        $('#errormessge6').html('Select Box Required');
        error = true;
    }
    if ($('#dth_activation_month').val() == "") {
        $('#errormessge7').html('select Month number');
        error = true;
    }
    if ($('#dth_activation_user_name').val() == "") {
        $('#errormessge9').html('Username Required');
        error = true;
    }
    if ($('#dth_activation_address').val() == "") {
        $('#errormessge10').html('Adress Required');
        error = true;
    }
    if ($('#dth_activation_locality').val() == "") {
        $('#errormessge11').html('Near by Required');
        error = true;
    }
    if ($('#dth_activation_mobile').val() == "") {
        $('#errormessge12').html('Mobile Required');
    }
    if ($('#dth_activation_amount').val() == "") {
        $('#errormessge8').html('Amount Required');
        error = true;
    }
    if ($('#dth_activation_pin_code').val() == "") {
        $('#errormessge13').html('Pin Code Required');
        error = true;
    }

    if (error == false) {

        $('#recharge_data').modal('show');
        $('#recharge_logo').html($('#dth_activation_provider_logo').html());
        $('#number_data').html($('#dth_activation_mobile').val());
        $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#dth_activation_amount').val() + "</b>");
        $('#recharge_type').val('dth_activation');
        commission_tax($("#dth_activation_amount").val());
    }
});


// $('#dth').submit(function () {
//     $('#recharge_data').modal('show');
//     $('#recharge_logo').html($('#dth_provider_logo').html());
//     $('#number_data').html($('#dth_number').val());
//     $('#amount_data').html("<b><i class='fa fa-rupee-sign'></i> " + $('#dth_amount').val() + "</b>");
//     $('#recharge_type').val('dth');
//     commission_tax($("#dth_amount").val());
// });
function recharge_dth() {
    var values = $("#dth").serialize();
    $.ajax({
        url: "recharge_dth.php",
        type: "post",
        data: values,
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            $('#dth').show();
            $('#dth_processing').hide();
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $("#dth_amount").val('');
                $("#dth_number").val('');
                $("#dth_provider").val('');
                $("#amount_balance").html(result['amount_balance']);
                $('#recharge_status_response').html(result['response']);
                $('#recharge_status').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}



function refresh_service(service_name) {
    $('#service_mobile').hide();
    $('#service_dth').hide();
    $('#service_utilities').hide();
    $('#service_dmr').hide();
    $('#service_insurance').hide();
    $('#service_school').hide();
    $('#service_bus').hide();
    $('#service_creditcard').hide();
    $('#service_hotel').hide();
    $('#service_flight').hide();
    $('#service_dmr_pz').hide();
    $('#service_dmr_pay').hide();
    $('#service_' + service_name).show();
}

function mobile_service(service_name) {
    $('#select_prepaid').removeClass('green_header');
    $('#select_postpaid').removeClass('green_header');
    $('#select_landline').removeClass('green_header');
    $('#select_prepaid').addClass('black_header');
    $('#select_postpaid').addClass('black_header');
    $('#select_landline').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#prepaid_div').hide();
    $('#postpaid_div').hide();
    $('#landline_div').hide();
    $('#' + service_name + "_div").show();
}

function dth_service(service_name) {
    $('#select_dth').removeClass('green_header');
    $('#select_dth_activation').removeClass('green_header');
    $('#select_dth').addClass('black_header');
    $('#select_dth_activation').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#dth_div').hide();
    $('#dth_activation_div').hide();
    $('#' + service_name + "_div").show();
}

function utility_service(service_name) {
    $('#select_electricity').removeClass('green_header');
    $('#select_water').removeClass('green_header');
    $('#select_gas').removeClass('green_header');
    $('#select_electricity').addClass('black_header');
    $('#select_water').addClass('black_header');
    $('#select_gas').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#electricity_div').hide();
    $('#water_div').hide();
    $('#gas_div').hide();
    $('#' + service_name + "_div").show();
}
function dmr_service(service_name) {
    $('#select_imps').removeClass('green_header');
    $('#select_aeps').removeClass('green_header');
    $('#select_upi').removeClass('green_header');
    $('#select_imps').addClass('black_header');
    $('#select_aeps').addClass('black_header');
    $('#select_upi').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#imps_div').hide();
    $('#aeps_div').hide();
    $('#upi_div').hide();
    $('#' + service_name + "_div").show();
}
function insurance_service(service_name) {
    $('#select_insurance_premium').removeClass('green_header');
    $('#select_insurance_purchase').removeClass('green_header');
    $('#select_insurance_premium').addClass('black_header');
    $('#select_insurance_purchase').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#insurance_premium_div').hide();
    $('#insurance_purchase_div').hide();
    $('#' + service_name + "_div").show();
}
function school_service(service_name) {
    $('#select_school_fee').removeClass('green_header');
    $('#select_school_fee').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#school_fee_div').hide();
    $('#' + service_name + "_div").show();
}
function bus_service(service_name) {
    $('#select_bus').removeClass('green_header');
    $('#select_cab').removeClass('green_header');
    $('#select_bus').addClass('black_header');
    $('#select_cab').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#bus_div').hide();
    $('#cab_div').hide();
    $('#' + service_name + "_div").show();
}
function credit_service(service_name) {
    $('#select_credit').removeClass('green_header');
    $('#select_credit').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#credit_div').hide();
    $('#' + service_name + "_div").show();
}
function hotel_service(service_name) {
    $('#select_hotel').removeClass('green_header');
    $('#select_international_hotel').removeClass('green_header');
    $('#select_hotel').addClass('black_header');
    $('#select_international_hotel').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#hotel_div').hide();
    $('#international_hotel_div').hide();
    $('#' + service_name + "_div").show();
}
function flight_service(service_name) {
    $('#select_flight').removeClass('green_header');
    $('#select_international_flight').removeClass('green_header');
    $('#select_flight').addClass('black_header');
    $('#select_international_flight').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#flight_div').hide();
    $('#international_flight_div').hide();
    $('#' + service_name + "_div").show();
}
function ipay_service(service_name) {
    $('#ipay_send_money').hide();
    $('#ipay_add_beneficiary').hide();
    if (service_name == "FUND TRANSFER") {

        $('#ipay_send_money').show();
        $.ajax({
            url: "ipay_get_beneficiary.php",
            type: "post",
            data: {"updte": 1},
            success: function (response) {
                var result = jQuery.parseJSON(response);
                console.log(result);
                check_ajax_logout(result['ajax_logout']);
                $('#beneficiary_id_ipay').val('');
                if (result['error'] == "0") {
                    $('#beneficiary_id_ipay').html(result['beneficiary_id']);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    } else if (service_name == "ADD BENEFICIARY") {
        $('#ipay_add_beneficiary').show();
    }
//$('#beneficiary_list').DataTable().ajax.reload();

}



function rech_service(service_name) {
    $('#select_addben').removeClass('green_header');
    $('#select_rechsend').removeClass('green_header');
    $('#select_allben').removeClass('green_header');
    $('#select_addben').addClass('black_header');
    $('#select_rechsend').addClass('black_header');
    $('#select_allben').addClass('black_header');
    $('#select_' + service_name).addClass('green_header');
    $('#addben_div').hide();
    $('#rechsend_div').hide();
    $('#allben_div').hide();
    $('#' + service_name + "_div").show();
    if (service_name == "rechsend") {
        $.ajax({
            url: "rech_get_beneficiary.php",
            type: "post",
            data: {"updte": 1},
            success: function (response) {
                var result = jQuery.parseJSON(response);
                console.log(result);
                check_ajax_logout(result['ajax_logout']);
                $('#beneficiary_id').val('');
                if (result['error'] == "0") {
                    $('#beneficiary_id').html(result['beneficiary_id']);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    } else if (service_name == "allben") {
        var reload_beneficiary_list = $('#rech_beneficiary_list').DataTable({

            "serverSide": true,
            "processing": true,
            "paging": true,
            "searching": false,
            "ordering": false,
            'ajax': {
                type: "post",
                data: {'search_new': $('#search_new').val()},
                'url': 'rech_ben_list.php'
            },
            columnDefs: [{
                    targets: "_all",
                    orderable: false
                }],
            'columns': [
                {data: 'sr_id'},
                {data: 'ben_details'},
                {data: 'Address'},
                {data: 'bank_details'},
                {data: 'account_details'},

                {data: 'Action'},
            ]
        });

    }
}
function provider_info(id, service) {
    if (id == "") {
        id = 0;
    }
    if (service == "") {
        service = "prepaid";
    }
    $.ajax({
        url: "provider_info.php",
        type: "post",
        data: {"provider_id": id, "updte": 1},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            if (service == "prepaid") {
                $('#special_recharge').hide();
            }
            if (id == 2) {
                $('#special_recharge').show();
            }
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $('#' + service + '_provider_logo').html(result['logo']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function check_number(mobile, service) {
    $.ajax({
        url: "mobile_number.php",
        type: "post",
        data: {"mobile": mobile, "updte": 1, "service": service},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $('#' + service + '_provider').val(result['provider_id']);
                $('#' + service + '_circle').val(result['circle']);
                provider_info(result['provider_id'], service);
                if (service == "prepaid") {
                    $('#special_recharge').hide();
                }
                var provider = result['provider_id'];
                if (provider == 2) {
                    $('#special_recharge').show();
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function get_prepaid_plans(plan, service) {
    var provider = $('#' + service + '_provider').val();
    var circle = $('#' + service + '_circle').val();
    if (service == "prepaid") {
        $('#special_recharge').hide();
    }
    if (provider == 2) {
        $('#special_recharge').show();
    }
    $.ajax({
        url: "prepaid_plans.php",
        type: "post",
        data: {"provider": provider, "updte": 1, "plan": plan, "circle": circle, "service": service},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            } else {
                $('#' + service + '_plans').html(result['plans']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function change_bank(id) {
    $.ajax({
        url: "ipay_bank.php",
        type: "post",
        data: {"bank_id": id, "updte": 1},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            $('#ifscCode_pay').val('');
            if (result['error'] == "0") {
                $('#ifscCode_pay').val(result['ifsC_Code']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function select_plan(service, amount) {
    $('#' + service + '_amount').val(amount);
}
function get_mobile_offers(service) {
    if (service == "") {
        service = "prepaid";
    }
    var mobile = $('#' + service + '_number').val();
    if (mobile == "") {
        swal({title: "Error", text: "Please Enter Mobile Number", icon: "error", buttons: false, timer: 2000});
        $('#' + service + '_number').focus();
        return false;
    }
    var provider = $('#' + service + '_provider').val();
    if (provider == "") {
        swal({title: "Error", text: "Please select Provider", icon: "error", buttons: false, timer: 2000});
        $('#' + service + '_provider').focus();
        return false;
    }
    var mobile = $('#' + service + '_number').val();
    $('#roffer_processing').show();
    $.ajax({
        url: "roffers.php",
        type: "post",
        data: {"provider": provider, "updte": 1, "mobile": mobile, "service": service},
        success: function (response) {
            $('#roffer_processing').hide();
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 5000});
            } else {
                $('#' + service + '_plans').html(result['plans']);
                $('#' + service + '_plans').show();
                $('#amount_balance').html(result['amount_balance']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function get_dth_info(service) {

    var mobile = $('#' + service + '_number').val();
    if (mobile == "") {
        swal({title: "Error", text: "Please Enter Dth Number", icon: "error", buttons: false, timer: 2000});
        $('#' + service + '_number').focus();
        return false;
    }
    var provider = $('#' + service + '_provider').val();
    if (provider == "") {
        swal({title: "Error", text: "Please select Provider", icon: "error", buttons: false, timer: 2000});
        $('#' + service + '_provider').focus();
        return false;
    }
    var mobile = $('#' + service + '_number').val();
    $('#get_info').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);

    $.ajax({
        url: "get_dth_info.php",
        type: "post",
        data: {"provider": provider, "updte": 1, "mobile": mobile, "service": service},
        success: function (response) {
            $('#get_info').html("Dth Info").prop('disabled', false);
            var result = jQuery.parseJSON(response);
            console.log(result);
            check_ajax_logout(result['ajax_logout']);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 5000});
            } else {

                $('#get_dth_data').modal('toggle');
                $('#show_dth_VC').html(result['VC']);
                $('#show_dth_Name').html(result['dth_Name']);
                $('#show_dth_Rmn').html(result['dth_Rmn']);
                $('#show_dth_Balance').html(result['dth_Balance']);
                $('#show_dth_Monthly').html(result['dth_Monthly']);
                $('#show_dth_Next_recharge').html(result['dth_Next_recharge']);
                $('#show_dth_Address').html(result['dth_Address']);
                $('#show_dth_Plan').html(result['dth_Plan']);
                $('#show_dth_City').html(result['dth_City']);
                $('#show_dth_State').html(result['dth_State']);
                $('#show_dth_Pin').html(result['dth_Pin']);
                $('#show_dth_District').html(result['dth_District']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function get_user_info(service) {
    if (service == "") {
        service = "prepaid";
    }
    var mobile = $('#' + service + '_number').val();
    if (mobile == "") {
        swal({title: "Error", text: "Please Enter Number", icon: "error", buttons: false, timer: 2000});
        $('#' + service + '_number').focus();
        return false;
    }
    var provider = $('#' + service + '_provider').val();
    if (provider == "") {
        swal({title: "Error", text: "Please select Provider", icon: "error", buttons: false, timer: 2000});
        $('#' + service + '_provider').focus();
        return false;
    }
    if (service == "prepaid") {
        $('#' + service + '_plans').html("Coming Soon");
    } else if (service == "dth") {
        swal({
            title: "This will cost you Rs 0.02?",
            text: "Do you want to Continue!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("We are fetching your information. Please wait!", {
                            icon: "success", buttons: false, timer: 5000
                        });
                        $.ajax({
                            url: "user_info.php",
                            type: "post",
                            data: {"provider": provider, "updte": 1, "mobile": mobile, "service": service},
                            success: function (response) {
                                var result = jQuery.parseJSON(response);
                                console.log(result);
                                check_ajax_logout(result['ajax_logout']);
                                if (result['error'] == 1) {
                                    swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
                                } else {
                                    $('#' + service + '_plans').html(result['plans']);
                                    $('#amount_balance').html(result['amount_balance']);
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    } else {
                        //swal("Nothing is deducted from your account",{ icon:"success", buttons: false, timer:2000 });
                        return false;
                    }
                });
    }
}
/*function dth_operator(dth) {
    if (dth.length > 2) {
        var dth_check = dth.substring(0, 2);
        var dth_check1 = dth.substring(0, 3);
        if (dth_check == "30") {
            $('#dth_provider').val(8);
        } else if (dth_check == "02" || dth_check1 == "015") {
            $('#dth_provider').val(9);
        } else if (dth_check1 == "201" || dth_check1 == "200") {
            $('#dth_provider').val(12);
        } else if (dth_check == "44" || dth_check == "41") {
            $('#dth_provider').val(10);
        } else if (dth_check == "12" || dth_check == "10" || dth_check == "10") {
            $('#dth_provider').val(11);
        } else {
            $('#dth_provider').val(17);
        }
        provider_info($('#dth_provider').val(), "dth");
    }
}*/
function roundToTwo(num) {
    return +(Math.round(num + "e+2") + "e-2");
}
function open_popup() {
    $('#dezire_send_popup').modal('toggle');
}
function fetch_bill() {

    var electricity_provider = $('#electricity_provider').val();
    var electricity_account_number = $('#electricity_account_number').val();
    if (electricity_account_number == "") {
        swal({title: "Error", text: "Please Enter Account Number", icon: "error", buttons: false, timer: 2000});
        $('#electricity_account_number').focus();
        return false;
    }

    if (electricity_provider == "" || electricity_provider == "0" || electricity_provider == " ") {
        swal({title: "Error", text: "Please select Provider", icon: "error", buttons: false, timer: 2000});
        $('#electricity_provider').focus();
        return false;
    }
    $('#fetch_button').html("<i class='fa fa-spinner fa-spin'></i> Processing....").prop('disabled', true);


    $.ajax({
        url: "get_electricity_bill.php",
        type: "post",
        data: {"provider": electricity_provider, "updte": 1, "mobile": electricity_account_number},
        success: function (response) {

            var result = jQuery.parseJSON(response);
            $('#fetch_button').html("Fetch Bill").prop('disabled', false);
            if (result['error'] == 1) {
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 5000});
            } else {
                $('#fetch_button').html("Fetch Bill").prop('disabled', true);
                $('#other_rech_info').show();
                $('#electricity_amount').val(result['amount']);
                $('#electricity_customer_name').val(result['name']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
</script>