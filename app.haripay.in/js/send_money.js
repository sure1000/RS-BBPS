<script type="text/javascript">
$(document).ready(function(){
    $('#ra').submit(function(){
       
        if($('#transfer_money').val()  ==  0) {
                     swal({title: "Error", text: "Please select user first", icon: "error", buttons: false, timer: 2000});
                    }else{

                       $('#save').val("Processing....").prop('disabled', true);
        var value = $('#ra').serialize();
      
        $.ajax({
            url: "send_money_users.php",
            type:"post",
            data : value,
            success:function(response){
                var results = jQuery.parseJSON(response);
               $('#save').val('Save').prop('disabled', false);
                if(results['error']=='1'){
                    swal({title:"Success",text:results['error_msg'],icon:"success",buttons:false,timer:2000});
                  window.location.reload();
                } 
                else{
                   swal({title:"Error",text:results['error_msg'],icon:"error",buttons:false,timer:2000}); 
                }
            },
        });  
                    }
   

    });
});
   
function get_users_detail(id){
  
    $.ajax({
        url: "user_details.php",
        type: "post",
        data: {"id":id},
        success: function(response) {
           
            var result = jQuery.parseJSON(response);
            if(result['error'] == 0){
                swal({title: "Error", text: result['error_msg'], icon:"error",buttons:false, timer:2000});
                
            }else{
       
               $('#t_name').html(result['name']);
                $('#t_username').html(result['username']);
                 $('#t_mobile').html(result['mobile']);
                  $('#t_email').html(result['email']);
                    $('#t_balance').html(result['balanceamount']);
                     
                  
            }
           
        }
    });
}


</script>