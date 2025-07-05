<script type="text/javascript">
function check_priority(priority, id){
	for(var i=0;i<5;i++){
		for(j=0;j<5;j++){
			if(i != j){
				if($('#priority_'+i).val() == $('#priority_'+j).val()){					
                    swal({title: "Error", text: "Priority "+$('#priority_'+i).val()+" is repeated. Please make it sure that it is only used once", icon:"error",buttons:false, timer:3000});
                    return false;
				}
			}
		}
	}
	return true;
}
</script>