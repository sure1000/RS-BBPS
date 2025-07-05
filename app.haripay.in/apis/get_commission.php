<?php

include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    
    $o = $factory->get_object($o->user_id, "users", "user_id");
    
    if ($o->is_active == "1") {


        $provider = $_POST['recharge_provider'];
        

        $slq_p = "Select provider_id ,logo from providers where provider_id   = '" . $provider . "' and is_active = '1' ";
        $res_p = getXbyY($slq_p);
        $rows_p = count($res_p);

        if ($rows_p == 1) {

            $provider = $res_p[0]['provider_id'];
            $logo = $res_p[0]['logo'];
        } else {

            $result['error'] = "1";
            $result['error_msg'] = "Operator Down";
            echo json_encode($result);
            die();
        }

        $sql = "Select * from slab_details where slab_id = '" . $o->plan_id . "' and operator_id ='" . $provider . "' and is_active ='1'";
        $res = getXbyY($sql);
        $rows = count($res);
        if ($rows > 0) {
           
            $result['ret_commission_type'] = (string) $res[0]['ret_commission_type'];
            $result['ret_per_flat'] = (string) $res[0]['ret_per_flat'];
            $result['tds'] = (string) $res[0]['ret_tds'];
            $result['gst'] = (string) $res[0]['ret_gst'];
            $result['commission'] = (string) $res[0]['ret_commission'];
           
        } else {
            $result['ret_commission_type'] = (string) "Commission";
            $result['ret_per_flat'] = (string) "Percentage";
            $result['tds'] = (string) "No";
            $result['gst'] = (string) "No";
            $result['commission'] = (string)"0";
        }
        if ($logo != "") {
            $result['provider_logo'] = "" . $_SERVER['HTTP_HOST'] . "/provider_logos/thumbs/" . $logo . "";
        } else {
            $result['provider_logo'] = "" . $_SERVER['HTTP_HOST'] . "/provider_logos/thumbs/Airtel_Prepaid.png";
        }
        $result['error'] = "0";
        $result['error_msg'] = "Fetch Tds , Gst & Commission.";
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "User Blocked";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}


echo json_encode($result);
?>
