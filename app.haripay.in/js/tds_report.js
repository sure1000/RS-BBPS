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
            data: {'search_new':$('#search_new').val()},
            'url': 'tds_report_list.php'
        },
        columnDefs: [{
            targets: "_all",
            orderable: false
         }],        
        'columns': [
            {data: 'transaction_date'},
            {data: 'transaction_type'},
            {data: 'actual_amount'},
            {data: 'amount'},
            {data: 'tds'},
            {data: 'gst'},
            {data: 'recharge_amount'},
        ],
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf', {extend: 'print', title: 'TDS & GST Report'}
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]]
    });
    
    $('#search_txn').submit(function(){
        var values = $("#search_txn").serialize();
        $.ajax({
            url: "commission_filters.php",
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



</script>