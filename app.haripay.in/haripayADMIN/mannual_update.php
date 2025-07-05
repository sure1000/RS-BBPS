<?php
die();
//include "include.php";
//
//$_POST['updte'] = 1;
//if ($_POST['updte'] > 0) {
//    $o1->wallet_id = '10807';
//    $status = 'Failed';
//    $opid = '';
//    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
//    $o2 = $factory->get_object($o1->user_id, "users", "user_id");
//    $o3 = $factory->get_object($o1->wallet_id, "wallet", "parent_id");
//    pt($o1);
//    pt($o2);
//    pt($o3);
//    
//    $o1->updated_at = todaysDate();
//    if ($status == "Success") {
//    
//            $o1->status = "Success";
//            $o1 = wallet_insert($o2, $o1);
//            $o1->parent_id = $o1->wallet_id;
//            set_commission($o1, $o2, $o1->provider_type);
//              $result['error'] = 0;
//            $result['error_msg'] = "Status  Updated Successfully :" . $status;
//      
//    } else if ($status == "Failed") {
//   
//            $o1->status = "Failed";
//            $o1->comment = $o1->comment . " - Manual " . $status;
//           
//            $o1->wallet_id = $updater->update_object($o1, "wallet");
//            $o1->transaction_type = "Refund";
//            $o1->status = "Success";
//            $o1->parent_id = $o1->wallet_id;
//            $o1->amount  = $o1->amount - $o3->amount ;
//            $o1->api_amount  = $o1->api_amount - $o3->api_amount;
//            $o1 = wallet_insert($o2, $o1);
//            pt($o1);
//            $result['error'] = 0;
//            $result['error_msg'] = "Status  Updated Successfully :" . $status;
//      
//    } else {
//        $result['error'] = 1;
//        $result['error_msg'] = "Invailed Status";
//    }
//
//} else {
//    $result['error'] = 1;
//    $result['error_msg'] = "Something went wrong. Please try again";
//}
//
//echo json_encode($result);
?>