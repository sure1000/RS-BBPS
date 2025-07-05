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
            'url': 'dispute_list.php'
        },
        columnDefs: [{
            targets: "_all",
            orderable: false
         }],        
        'columns': [
            {data: 'transaction_date'},
            {data: 'transaction_type'},
			 {data :'actual_amount'},
            {data: 'user_old_balance'},
           
            {data: 'amount'},
            {data: 'user_new_balance'},
        ],
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf', {extend: 'print', title: 'Disputes History'}
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

function dispute_info(id){
    if(id == " " || id == "0"){
        swal({title: "Error", text: "No Information to fetch", icon: "error", buttons: false, timer: 2000});
        return false;
    }
    $('#dispute_reply').html('');

    $.ajax({
        url: "dispute_info.php",
        type: "post",
        data: {"updte": 1, "ref_number":id},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if(result['error'] == 1){
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            }else{
                $('#dispute_info').modal('show');
                $('#dispute_reply').html(result['error_msg']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


</script>