<?php

include "include.php";


if ($o->user_id > 0) {

    $sql = "Select * from users where is_active = 1 and  parent_id ='" . $o->user_id . "' order by user_name";
    $res = getXbyY($sql);
    $rows = count($res);

  

    for ($i = 0; $i < $rows; $i++) {

        $results[$i]['user_id'] = (string)$res[$i]['user_id'];
        $results[$i]['name'] = (string)$res[$i]['name'];
        $results[$i]['user_name'] = (string)$res[$i]['user_name'];
        $results[$i]['mobile'] = (string)$res[$i]['mobile'];
        $results[$i]['company_name'] =(string)$res[$i]['company_name'];
    }
    $result['user_list'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Users";
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>