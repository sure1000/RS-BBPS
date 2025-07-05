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
            'url': 'user_wise_list.php'
        },
        columnDefs: [{
            targets: "_all",
            orderable: false
         }],        
        'columns': [
            {width: "20%", data: 'user_name'},
            {width: "10%", data: 'balance_amount'},
            {width: "10%", data: 'credit_amount'},
            {width: "10%", data: 'success'},
            {width: "10%", data: 'pending'},            
            {width: "10%", data: 'total'},            
            {width: "10%", data: 'failed'},            
            {width: "10%", data: 'refund'},            
            {width: "10%", data: 'revenue'}            
        ],
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]]
    });
    
    $('#search_txn').submit(function(){
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