 <script type="text/javascript">

 $(document).ready(function () {
 var reload_history_dt = $('#recharge_history').DataTable({
        "fixedHeader": true,
        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "ordering": false,
        'ajax': {
            type: "post",
            data: {'search_new': $('#search_new').val()},
            'url': 'list_recharge_report.php'
        },
                     "drawCallback": function( settings ) {
         var api = this.api();
                var json = api.ajax.json();

        $("#recharge_s_count").html(json.success_count);
        $("#recharge_p_count").html(json.pending_count);
        $("#recharge_f_count").html(json.failed_count);
        $("#recharge_s_amt").html(json.success_amt);
        $("#recharge_p_amt").html(json.pending_amt);
        $("#recharge_f_amt").html(json.failed_amt);
    },

        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
   
        'columns': [

            {data: 'tnx_id'},   
            {data: 'Retailer'},        
            {data: 'number'},
            {data: 'status'},
            {data: 'amount'},
            {data: 'my_inc'}, 
            {data: 'debited'},
            {data: 'user_amount'},          
            {data: 'opid'},
             {data: 'request_date'},
            // {data: 'print'},
  ],
  
        dom: 'Blfrtip',
        buttons: [
            {
                extend: "copy",
                className: "btn-sm"
            },
            {
                extend: "csv",
                className: "btn-sm"
            },
            {
                extend: "excel",
                className: "btn-sm"
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm"
            },
            {
                extend: "print",
                className: "btn-sm"
            },
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, 'All']],
        "pageLength": 50
       
    });
var reload_history_dt = $('#admin_fund_history_dt').DataTable({
        "fixedHeader": true,
        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "ordering": false,
        'ajax': {
            type: "post",
            data: {'search_new': $('#search_new').val()},
            'url': 'list_recharge_utility_report.php'
        },
                     "drawCallback": function( settings ) {
         var api = this.api();
                var json = api.ajax.json();

        $("#recharge_s_count").html(json.success_count);
        $("#recharge_p_count").html(json.pending_count);
        $("#recharge_f_count").html(json.failed_count);
        $("#recharge_s_amt").html(json.success_amt);
        $("#recharge_p_amt").html(json.pending_amt);
        $("#recharge_f_amt").html(json.failed_amt);
    },

        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
   
        'columns': [

            {data: 'tnx_id'},
           
            {data: 'Retailer'},
            {data: 'number'},            
            {data: 'status'},
            {data: 'amount'},
            {data: 'my_inc'},  
            {data: 'debited'},
            {data: 'user_amount'},          
            {data: 'opid'},
             {data: 'request_date'},
            {data: 'print'},
  ],
  
        dom: 'Blfrtip',
        buttons: [
            {
                extend: "copy",
                className: "btn-sm"
            },
            {
                extend: "csv",
                className: "btn-sm"
            },
            {
                extend: "excel",
                className: "btn-sm"
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm"
            },
            {
                extend: "print",
                className: "btn-sm"
            },
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, 'All']],
        "pageLength": 50
       
    });

     var reload_history_dt = $('#admin_fund_history_rt').DataTable({
        "fixedHeader": true,
        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "ordering": false,
        'ajax': {
            type: "post",
            data: {'search_new': $('#search_new').val()},
            'url': 'list_recharge_utility_report.php'
        },
                     "drawCallback": function( settings ) {
         var api = this.api();
                var json = api.ajax.json();

        $("#recharge_s_count").html(json.success_count);
        $("#recharge_p_count").html(json.pending_count);
        $("#recharge_f_count").html(json.failed_count);
        $("#recharge_s_amt").html(json.success_amt);
        $("#recharge_p_amt").html(json.pending_amt);
        $("#recharge_f_amt").html(json.failed_amt);
    },

        columnDefs: [{
                targets: "_all",
                orderable: false
            }],
   
        'columns': [

            {data: 'tnx_id'},           
            {data: 'number'},
            {data: 'status'},
            {data: 'amount'},
            {data: 'my_inc'}, 
            {data: 'debited'},
            {data: 'user_amount'},          
            {data: 'opid'},
             {data: 'request_date'},
            {data: 'print'},
  ],
  
        dom: 'Blfrtip',
        buttons: [
            {
                extend: "copy",
                className: "btn-sm"
            },
            {
                extend: "csv",
                className: "btn-sm"
            },
            {
                extend: "excel",
                className: "btn-sm"
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm"
            },
            {
                extend: "print",
                className: "btn-sm"
            },
        ],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, 'All']],
        "pageLength": 50
       
    });




});
</script>