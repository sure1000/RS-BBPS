<script type="text/javascript">
	$(document).ready(function() { 
	    $('#api_transaction_list').DataTable( {
	    	dom: "Bfrtip",
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
              responsive: true,
              "pageLength": 50,
	    	"ajax": {
	        	"url":"api_transaction_list.php",
	        	"data":{"api_id":$("#api_id").val()},
	        	"dataSrc":""
	        }
	    } );
	} );
</script>