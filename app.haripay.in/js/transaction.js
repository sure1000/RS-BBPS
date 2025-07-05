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
            'url': 'transaction_list_list.php'
        },
        columnDefs: [{
            targets: "_all",
            orderable: false
         }],        
        'columns': [
            {data: 'transaction_date'},
            {data: 'transaction_type'},
            {data: 'user_old_balance'},
            {data: 'amount'},
            {data: 'user_new_balance'},
        ],
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]]
    });
    
    
    
    
});

</script>