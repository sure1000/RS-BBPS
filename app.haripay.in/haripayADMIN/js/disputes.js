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
            'url': 'disputes_list.php'
        },
        columnDefs: [{
            targets: "_all",
            orderable: false
         }],        
        'columns': [
            {data: 'transaction_date'},
            {data: 'user_name'},
            {data: 'transaction_type'},
            {data: 'api'},
            {data: 'user_old_balance'},
            {data: 'amount'},
            {data: 'user_new_balance'},
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
function pending_info(id){               
    if(id == " " || id == "0"){
        swal({title: "Error", text: "No Information to fetch", icon: "error", buttons: false, timer: 2000});
        return false;
         
    }
    $('#dispute_issue').val('');
   $('#pending_info').modal('show');
    // $('#pending_info')[0].reset();
    
    $('#dis_approve').val(id);
   
    
}


function update_dispute(statuss){
    
    var wallet_id = $('#dis_approve').val();
    var dispute_resolution = $('#dispute_issue').val();
   
    $.ajax({
        url: "approve_dispute.php",
        type: "post",
        data: {"updte": 1, "wallet_id" : wallet_id , "dispute_resolution":dispute_resolution,"status":statuss},
        success: function (response) {
            var result = jQuery.parseJSON(response);
            console.log(result);
            if(result['error'] == 1){
                swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});
            }else{
                $('#dispute_issue').val('');
                $('#pending_info').modal('show');
                $('#dispute_resolution').html(result['error_msg']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}




</script>