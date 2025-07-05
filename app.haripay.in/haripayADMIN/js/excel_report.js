<script type="text/javascript">
	var search1 = "";
$(document).ready(function () {
    var reload_history = $('#excel_report').DataTable({

        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "ordering": false,
        'ajax': {
            type: "post",
            data: {'search_new': $('#search_new').val()},
            'url': 'list_excel_report.php'
        },
        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
        'columns': [
            {data: 'provider_name'},
            {data: 'admin_total_comm'},
            {data: 'dt_comm'},
            {data: 'rt_comm'},
            {data: 'surge'},
            {data: 'profit'},
            {data: 'total_Sell'},
            {data: 'admintotal_profit'},
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
            url: "search_filters_report.php",
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
</script>