<?php
include "include.php";


if ($_POST) {
    $mobile = $_POST['mobile'];
    $service = $_POST['service'];
    $provider = $_POST['provider'];

    $provider_api_code = get_api_provider_code($provider, "M PLAN API");
    // pt($provider_api_code);die;
    $api_response = fetch_dth_info($mobile, $provider_api_code);
    $result['info'] = $api_response;
}

echo json_encode($result);
?>