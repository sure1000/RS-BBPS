<?php
include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {

        $amount = $_POST['recharge_amount'];
        $provider = $_POST['recharge_provider'];
        $type = $_POST['type'];


         $slq_p = "Select provider_id ,logo from providers where provider = '" . $provider . "' and is_active = '1' and service = '" . $type . "'";
        $res_p = getXbyY($slq_p);
        $rows_p = count($res_p);

        if ($rows_p == 1) {

            $provider = $res_p[0]['provider_id'];
            $logo = $res_p[0]['logo'];
        } else {

            $result['error'] = "1";
            $result['error_msg'] = "Invalid Provider Name";
            echo json_encode($result);
            die();
        }
 

        if ($type == "Prepaid") {
            if ($o11->is_prepaid == "Yes") {
                $flag = "1";
            } else {
                $flag = "0";
            }
        }
        if ($flag == "1") {

            $amt_tds_gst_com = get_tds_gst($o->plan_id, $provider, $amount);
            $result['pay_amount'] =  (string)$amt_tds_gst_com['pay_amount'];
            $result['tds_amt'] = (string)$amt_tds_gst_com['tds_amt'];
            $result['gst_amt'] = (string)$amt_tds_gst_com['gst_amt'];
            $result['commission_amount'] = (string)$amt_tds_gst_com['commission_amount'];
            $result['net_profit'] = (string)$amt_tds_gst_com['net_profit'];
            if($logo != ""){
            $result['provider_logo'] = "".$_SERVER['HTTP_HOST']."/provider_logos/thumbs/".$logo."";
            }else{
            $result['provider_logo'] = "".$_SERVER['HTTP_HOST']."/provider_logos/thumbs/Airtel_Prepaid.png";
            }
            $result['error'] = "0";
            $result['error_msg'] = "Pay now";
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Your services to recharge " . $type . " is not activated. Please contact Administrator for more details.";
        }
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