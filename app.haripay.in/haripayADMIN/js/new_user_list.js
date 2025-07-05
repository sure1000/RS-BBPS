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
            'url': 'list_new_user.php'
        },
        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
        'columns': [
            {data: 'sr_id'},
            {data: 'user_details'},
            {data: 'user_type'},
            {data: 'verified'},
            {data: 'created_at'},
            {data: 'status'},
            
        ],
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf'
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]]
    });

    $('#search_new_user').submit(function () {
        var values = $("#search_new_user").serialize();
        $.ajax({
            url: "search_filters_new_user.php",
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