<script type="text/javascript">
var search1 = "";
$(document).ready(function () {
    var reload_history = $('#recharge_history').DataTable({

        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "ordering": false,
        'ajax': {
            type: "post",
            data: {'search_new': $('#search_new').val()},
            'url': 'recharge_history_list.php'
        },
        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
        'columns': [
            {data: 'transaction_date'},
            {data: 'user_details'},
            {data: 'transaction_type'},
            {data: 'opid'},
            {data: 'api'},
           
            {data: 'tt_amout'},
            {data: 'amount'},
         
            {data: 'user_new_balance'},
        ],
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf'
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]]
    });

    $('#search_txn').submit(function () {
        var values = $("#search_txn").serialize();
        $.ajax({
            url: "search_filters.php",
            type: "post",
            data: values,
            success: function (response) {
                reload_history.ajax.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });


});

$('#service_id').change(function () {
    if ($('#service_id').val() == "0") {
        $('#provider_id').val('0');
        $('#provider_id').attr("disabled", true);
    } else {

        $.ajax({
            url: "fetch_providers.php",
            type: "post",
            data: {"updte": 1, "service_id": $('#service_id').val()},
            success: function (response) {
                $('#provider_list').html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
});
function showmodal(wid) {
    $("#retry_div").show();
    $("#processing_wallet").hide();
    $.ajax({
        url: "get_retrymodal.php",
        type: "Post",
        data: {"updte": "1", "wid": wid},
        success: function (response) {
            var results = jQuery.parseJSON(response);
            $('#modal_body1').html(results['modal_body']);
            $('#modal_head').html(results['modal_head']);
            $('#wallet_id').val(wid);
            $('#action_modal').modal('toggle');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}

function refund_success_amount(status) {
    $("#retry_div").hide();
    $("#processing_wallet").show();
    var opid = $("#opid").val();
    var wid = $('#wallet_id').val();
    $.ajax({
        url: "update_status.php",
        type: "post",
        data: {"updte": 1, "wallet_id": $('#wallet_id').val(), "opid": opid, "status": status},
        success: function (response) {
            var results = jQuery.parseJSON(response);
            if (results['error'] == "0") {
                $("#retry_div").show();
                $("#processing_wallet").hide();
                swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});

                $('#recharge_history').DataTable().ajax.reload();
                $('#action_modal').modal('toggle');
                showmodal(wid);
            } else {
                swal({title: "Error", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function check_response() {
    $("#retry_div").hide();
    $("#processing_wallet").show();
    $.ajax({
        url: "check_response.php",
        type: "post",
        data: {"updte": 1, "wallet_id": $('#wallet_id').val()},
        success: function (response) {
            var results = jQuery.parseJSON(response);
            $("#retry_div").show();
            $("#processing_wallet").hide();
            $('#response').val(results['response']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function retry_api() {
    $("#retry_div").hide();
    $("#processing_wallet").show();
    var wid = $('#wallet_id').val();
    var apid = $('#api_id').val();
    if (apid == "" || apid == '0') {
        swal({title: "Error", text: "Please Select Api.", icon: "error", buttons: false, timer: 2000});
        $("#retry_div").show();
        $("#processing_wallet").hide();
        return false;
    }
    $.ajax({
        url: "retry_api.php",
        type: "post",
        data: {"updte": 1, "wallet_id": $('#wallet_id').val(), "api_id": apid},
        success: function (response) {
            var results = jQuery.parseJSON(response);
            if (results['error'] == "0") {
                $("#retry_div").show();
                $("#processing_wallet").hide();
                if (results['status'] == "Success") {
                    swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});
                } else if (results['status'] == "Failed") {
                    swal({title: "Error", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
                } else {
                    swal({title: "Info", text: results['error_msg'], icon: "info", buttons: false, timer: 2000});
                }
                $('#action_modal').modal('toggle');
                $('#recharge_history').DataTable().ajax.reload();
                showmodal(wid);
            } else {
                swal({title: "Error", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function update_opid() {
    $("#retry_div").hide();
    $("#processing_wallet").show();
    var opid = $("#opid").val();
    var status = $("#status_opid").val();
    //alert(status);
    if (status == "" || status == '0') {
        swal({title: "Error", text: "Please Select Status.", icon: "error", buttons: false, timer: 2000});
        $("#retry_div").show();
        $("#processing_wallet").hide();
        return false;
    }
    var wid = $('#wallet_id').val();
    $.ajax({
        url: "update_opid.php",
        type: "post",
        data: {"updte": 1, "wallet_id": $('#wallet_id').val(), "opid": opid, "status": status},
        success: function (response) {
            var results = jQuery.parseJSON(response);
            if (results['error'] == "0") {
                $("#retry_div").show();
                $("#processing_wallet").hide();
                swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});
                $('#action_modal').modal('toggle');
                $('#recharge_history').DataTable().ajax.reload();
                showmodal(wid);
            } else {
                swal({title: "Error", text: results['error_msg'], icon: "error", buttons: false, timer: 2000});
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


</script>