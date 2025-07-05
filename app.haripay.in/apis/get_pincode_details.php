<?php

include 'include.php';


if (isset($_POST)) {
    $sql = "Select * from pincode where pincode ='" . $_POST['pincode'] . "' group by district_name";
    $res = getXbyY($sql);
    $rows = count($res);
    if ($rows > 0) {
        for ($i = 0; $i < $rows; $i++) {

            $results[$i]['district_name'] = ucwords(strtolower($res[$i]['district_name']));
        }
        $result['error_msg'] = "Data Found";
        $result['district_list'] = $results;
        $result['state_name'] = $res[0]['state_name'];
    } else {
        $result['error_msg'] = "No Data Found";
        $result['district_list'] = [];
        $result['state_name'] = "";
    }


    $result['error'] = '0';
} else {
    $result['error'] = '1';
    $result['error_msg'] = "Something Went Wrong";
}

echo json_encode($result);
?>