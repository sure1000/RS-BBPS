<script type="text/javascript">

$(document).ready(function(){
	$('#ra').submit(function(){
		var value= $('#ra').serialize();
		//alert(value);
		$.ajax({
			url:"save_dmr_commission_details.php",
			type:"post",
			data:value,
			success:function(response){
			 var results = jQuery.parseJSON(response);
			 if(results['error'] == '1'){
		swal({title: "Success", text: results['error_msg'], icon: "success", buttons: false, timer: 2000});
			 window.location.href="dmr_commission.php";
			 
			 }else{
				swal({title: "Error", text: results['error_msg'], icon: "error", buttons: false, timer: 2000}); 
			 }
				
			},
			
		});
		
		
	});	
});


</script>