<script type="text/Javascript">
    function update_form(id){
        $('#updte').val(id);
        if(id == 2){
            
        }else if(id == 3){
            if(($('#all_commission_amount').val() == 0 || $('#all_commission_amount') == "") && ($('#all_commission_percentage').val() == 0 || $('#all_commission_percentage').val() == "")){
                swal({title: "Error", text: "Please Enter Amount or Percentage", icon:"error",buttons:false, timer:2000});
                return false;
            }
            
        }else{
        
        }
        
        document.ra.submit();
        
    }
    
      
</script>