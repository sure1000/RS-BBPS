<?php

include "include.php";

if (isset($_POST)) {
    $mobile = $_POST['mobile'];
   
    if (strlen($mobile) == 10 ) {
            $results = planapi_mobile_info($mobile);

        $result['provider_id'] = $results['provider_id'];
        $result['circle'] = $results['circle'];
        $result['provider'] = $results['provider'];
        $result['error'] = "0";
        $result['error_msg'] = "Data Found";

       
    } else {
        //$results = get_mobile_info($mobile);
        $result['error_msg'] = "Incorrect Mobile Number";
        $result['error'] = "1";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}
echo json_encode($result);
?>