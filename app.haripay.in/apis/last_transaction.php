<?php

include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {

        $service_type = $_POST['service_type'];
        $dd = explode(" ", todaysDate());

        $sql_transactions = "Select * from wallet where  parent_id = 0 and user_id = " . $o->user_id . " and transaction_type='Recharge' and provider_type = '" . $service_type . "' order by wallet_id DESC limit 0 , 5 ";
        $res_transactions = getXbyY($sql_transactions);
        $row_transactions = count($res_transactions);

        if ($row_transactions > 0) {

            for ($i = 0; $i < $row_transactions; $i++) {

                $slq_p = "Select provider_id ,logo from providers where provider_id   = '" . $res_transactions[$i]['provider_id'] . "' and is_active = '1' ";
                $res_p = getXbyY($slq_p);
                $rows_p = count($res_p);

                if ($rows_p == 1) {


                    $logo = $res_p[0]['logo'];
                }
                $results[$i]['wallet_id'] = $res_transactions[$i]['wallet_id'];
                $results[$i]['transaction_type'] = $res_transactions[$i]['transaction_type'];
                $results[$i]['circle_name'] = $res_transactions[$i]['circle_name'];
                $results[$i]['mobile_number'] = $res_transactions[$i]['mobile_number'];
                $results[$i]['provider_type'] = $res_transactions[$i]['provider_type'];
                $results[$i]['ref_number'] = $res_transactions[$i]['ref_number'];
                $results[$i]['opid'] = $res_transactions[$i]['opid'];
                $results[$i]['transaction_details'] = $res_transactions[$i]['transaction_details'];
                $results[$i]['provider_name'] = $res_transactions[$i]['provider_name'];


                if ($logo != "") {
                    $results[$i]['provider_image'] = "" . $_SERVER['HTTP_HOST'] . "/provider_logos/thumbs/" . $logo . "";
                } else {
                    $results[$i]['provider_image'] = "" . $_SERVER['HTTP_HOST'] . "/provider_logos/thumbs/Airtel_Prepaid.png";
                }


                $results[$i]['recharge_path'] = $res_transactions[$i]['recharge_path'];
                $results[$i]['ip_address'] = $res_transactions[$i]['ip_address'];
                $results[$i]['status'] = $res_transactions[$i]['status'];
                $results[$i]['disputed'] = $res_transactions[$i]['disputed'];
                $results[$i]['transaction_date'] = format_date($res_transactions[$i]['transaction_date']);
                $results[$i]['user_old_balance'] = $res_transactions[$i]['user_old_balance'];
                $results[$i]['total_amount'] = $res_transactions[$i]['total_amount'];
                $results[$i]['amount'] = $res_transactions[$i]['amount'];
                $results[$i]['user_new_balance'] = $res_transactions[$i]['user_new_balance'];
            }

            $result['all_history'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch History";
        } else {
            $result['all_history'] = "[]";
            $result['error'] = "1";
            $result['error_msg'] = "No Data Found";
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
