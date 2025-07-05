<script type="text/javascript">

var search1 = "";
$(document).ready(function () {
    var reload_history = $('#recharge_history').DataTable({

        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "ordering": false,
        "pageLength": 50,

        'ajax': {
            type: "post",
            data: {'search_new':$('#search_new').val()},
            'url': 'money_requests_list.php'
        },
        columnDefs: [{
            targets: "_all",
            orderable: false
         }],        
        'columns': [
            {data: 'transaction_date'},
            {data: 'user_name'},
            {data: 'cash_credit'},
            {data: 'mode'},
            {data: 'transaction_number'},
            {data: 'amount'},
            {data: 'status'},
        ],
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf'
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]]
    });
    
    $('#search_txn').submit(function(){
        var values = $("#search_txn").serialize();
        $.ajax({
            url: "money_requests_filters.php",
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

$('#service_id').change(function(){
    if($('#service_id').val() == "0"){
        $('#provider_id').val('0');
        $('#provider_id').attr("disabled",true);
    }else{
        
        $.ajax({
            url: "fetch_providers.php",
            type: "post",
            data: {"updte": 1, "service_id":$('#service_id').val()},
            success: function (response) {
                $('#provider_list').html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
});


function change_status(id, status){
    $('#request_money_id').val(id);
    $('#process_it').attr('disabled',false);
    $('#reject_it').attr('disabled',false);
    $('#decision').val('');
    if(status == "Transferred"){
        $('#process_it').attr('disabled',true);
    }
    if(status == "Rejected"){
        $('#reject_it').attr('disabled',true);
    }

    $('#request_modal').modal('show');
}
</script>