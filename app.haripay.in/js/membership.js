<script type="text/javascript">
function plan_details(plan_id){
        $.ajax({
        url: "user_plans.php",
            type: "post",
            data: {"plan_id":plan_id},
            success: function (response) {
                $('#user_plan_id').html(response);
                $('#plan_modal').modal('show');
            },
        error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
        }
    });
    
}
</script>