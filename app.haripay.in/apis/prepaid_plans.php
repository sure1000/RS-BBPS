<?php

include "include.php";


if ($_POST['plan_updte'] == 1) {

    $provider = ucfirst($_POST['provider']);
    $plan = $_POST['plan'];
    $circle = $_POST['circle'];
    $service = ucfirst($_POST['service']);

    if ($plan == "") {
        $plan = "Combo";
    }
    if ($circle == "") {
        $circle = "Rajasthan";
    }
    if ($provider == "") {
        $provider = "1";
    }
    if ($service == "") {
        $service = "Prepaid";
    }
    if ($service == "Dth") {
        $circle = "";
    }

    $provider = get_provider_name($provider);


    $sql = "Select * from provider_plans where service_type = '" . $service . "' and operator = '" . $provider . "' and circle = '" . $circle . "' and plan_type = '" . $plan . "' and is_active = 1";
    $res = getXbyY($sql);
    $rows = count($res);



    for ($i = 0; $i < $rows; $i++) {
        $sstring[$i]['details'] = strip_tags($res[$i]['details']);
        $sstring[$i]['validity'] = $res[$i]['validity'];
        $sstring[$i]['price'] = $res[$i]['price'];
    }

    if ($rows > 0) {
        $sstring = $sstring;
    } else {
        $sstring = "[]";
    }

    $result['plans'] = $sstring;
    $result['error'] = "0";
    $result['error_msg'] = "Plans Found";
}

echo json_encode($result);
?>