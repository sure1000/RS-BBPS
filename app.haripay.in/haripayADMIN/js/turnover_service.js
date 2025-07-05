<script type="text/javascript">

var search1 = "";
$(document).ready(function () {
    var reload_history = $('#recharge_history').DataTable({

        "serverSide": false,
        "processing": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "pageLength": 50,

        columnDefs: [{
            targets: "_all",
            orderable: true
         }],        
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



</script>