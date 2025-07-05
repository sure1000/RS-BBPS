<?php

include "include.php";
if (isset($_POST)) {
    if ($_POST['provider_id'] > 0) {
        if ($_POST['provider_id'] == '1') {
            $provider = 'AIRTEL';
        } else if ($_POST['provider_id'] == '3') {
            $provider = 'IDEA';
        } else if ($_POST['provider_id'] == '5') {

            $provider = 'VODAFONE';
        } else {
            $provider = '';
        }
        $number = $_POST['mobile_number'];

        $results = get_prepaid_offers($provider, $number);

        if ($results['status'] == "FAILED") {
            $result['error'] = "1";
            $result['error_msg'] = $results['Response'];
        } else if ($results['status'] == "SUCCESS") {
            $total_offers = count($results['Response']);
            if ($total_offers > 0) {

                $result['error'] = "0";
                $result['error_msg'] = "Offers Fetched";

                for ($i = 0; $i < $total_offers; $i++) {

                    $plan[] = $results['Response'][$i];
                    $result['data'] = $plan;
                }
            } else {
                $result['error'] = "1";
                $result['error_msg'] = "Something Went Wrong";
            }
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Something Went Wrong";
    }
} else {
    $results['error'] = "1";
    $results['error_msg'] = "Something went wrong please try again";
}
echo json_encode($result);
?>