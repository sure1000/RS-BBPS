<script type="text/Javascript">
$('#ipay_oulet_otp').submit(function(){
var values = $('#ipay_oulet_otp').serialize();
$.ajax({
     url:'get_oultet_otp.php',
     type:'post',
     data:values,
     success:function(response){
     var result = jQuery.parseJSON(response);
     if(result['error'] == '1'){
swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
     $('#ipay_oulet_otp').hide();
    $('#ipay_mobile_reg').val(result['mobile_ipay']);
    $('#ipay_oulet_registration').show();
     }else{
     swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});	
     }

     },

});

});
$('#ipay_oulet_registration').submit(function(){
var values = $('#ipay_oulet_registration').serialize();

$.ajax({
     url:'outlet_registration.php',
     type:'post',
     data:values,
     success:function(response){
     var result = jQuery.parseJSON(response);
     if(result['error'] == '1'){
swal({title: "Success", text: result['error_msg'], icon: "success", buttons: false, timer: 2000});
     setTimeout(location.reload.bind(location), 2000);
     }else{
     swal({title: "Error", text: result['error_msg'], icon: "error", buttons: false, timer: 2000});	
     }

     },

});

});

</script>