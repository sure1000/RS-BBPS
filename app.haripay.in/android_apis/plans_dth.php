<?php
include "include.php";
if ($_POST) {
    
    $operator = $_POST['operator'];
    
    $provider_api_code = get_api_provider_code($operator, "DTH PLAN API");
    $offers = dth_plans($provider_api_code);
	//pt($offers);
    $result['error'] = "0";
    $result['error_msg'] = "Offers Fetched";
    $result['plan'] = $offers;

}
echo json_encode($result);
?>