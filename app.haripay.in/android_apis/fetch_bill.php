<?php
include "include.php";


if ($_POST['electricity_updte'] == 1) {
    if ($_POST['electricity_circle'] > 0) {
        $o1->provider_id = $_POST['electricity_circle'];
    } else {
        $o1->provider_id = 0;
    }
    $o1->service_id = '7';
    $api_result1 = select_api($o1, $o);

    $provider_data = $factory->get_object($o1->provider_id, "providers", "provider_id");

    if ($api_result1['api_id'] == '1') {
        $result['error'] = '0';
        $result['error_msg'] = "Operator Down";
    } else {
        $o2 = $factory->get_object($api_result1['api_id'], "api", "api_id");
        $o5->skey = $api_result1['api_code'];
        if ($o5->skey == "DHE" || $o5->skey == "UHE") {
            $o5->units = "&p4=" . $_POST['electricity_mobile'];
        }
        $o5->customer_number = $_POST['electricity_account_number'];
        $o5->reqid = reference_number();
        $o5->geocode = "28.5346,77.2601";
        $o5->customer_mobile = $_POST['electricity_mobile'];

        $api_result = fetch_bill($o2, $o5);
    

        if ($api_result['error'] == "0") {
            $results = json_decode($api_result['response']);

            if ($results->data->status == "FAILED") {
                if ($results->data->billName != "") {
                    
                    
                    
                    $result['error'] = "0";
                    $result['customer_name'] = $results->data->billName;
                    $result['amount_elec'] = $results->data->billAmount;
                    $result['requestId'] = $results->data->orderId;
                    $comm =  get_tds_gst($o->plan_id,  $o1->provider_id , $result['amount_elec']);
          
                    $result['provider_elec'] = $results->data->service;
                    $result['bill_number'] = $results->data->mobile;
                    $result['bill_tag'] = "Account Number";
                    $result['commission_data_elc'] = $comm['commission_amount'];
                    $result['tds_data_elec'] = $comm['tds_amt'];
                    $result['gst_data_elec'] = $comm['gst_amt'];
                    $result['total_payable_elec'] = $comm['pay_amount'];
                    $result['net_profit'] = $comm['net_profit'];
                    $result['elec_amount'] = $results->data->billAmount;
                    $result['bill_number_elec'] = $results->data->mobile ;
                    $result['CustomerName'] = $results->data->billName ;
                   
                } else {
                    $result['error'] = "1";
                    $result['error_msg'] = $results->data->resText;
                }
                
            
            } else {
                $result['error'] = "1";
                $result['error_msg'] = "Recharge Failed. No Response From Api";
            }
        } else {
            $result['error_msg'] = "Recharge Failed. No Response From Api";
            $result['error'] = "1";
        }
    }
}


echo json_encode($result);
?>