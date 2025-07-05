<script type="text/javascript">
// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#apiTABLE').DataTable({
        "pageLength": 50,
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    });
});

</script>