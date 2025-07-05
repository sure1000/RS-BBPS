<?php
session_start();

include "include.php";
include "session.php";
$tables = 1;
?>
<div id="result">
Loading..
</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script>
function getdata(){
	$.ajax({
            url: "live_report_ajax.php",
            type: "post",
            data: 1,
            success: function (response) {
                $('#result').html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
});
}
setInterval(function () {getdata()}, 50000);
getdata();
</script>