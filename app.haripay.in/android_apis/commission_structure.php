<?php

include "include.php";



if ($o->user_id > 0) {



    $sql = "Select * from user_plan_service as A left join providers as B on (A.provider_id=B.provider_id ) where A.user_plan_id = '" . $o->plan_id . "' and B.is_active=1";


    $res = getXbyY($sql);
    $rows = count($res);

    for ($i = 0; $i < $rows; $i++) {
        $results[$i]['provider_name'] = (string) ucwords(strtolower($res[$i]['provider']));
        $results[$i]['service'] = (string) ucwords(strtolower($res[$i]['service']));

        if ($o->user_type == "Retailer") {
            $results[$i]['type'] = (string) ucwords(strtolower($res[$i]['type_rt']));
            $results[$i]['commission_amount'] = (string) ucwords(strtolower($res[$i]['commission_amount_rt']));
        } else if ($o->user_type == "Distributor"){
            $results[$i]['type'] = (string) ucwords(strtolower($res[$i]['type_dt']));
            $results[$i]['commission_amount'] = (string) ucwords(strtolower($res[$i]['commission_amount_dt']));
        } else{
            $results[$i]['type'] = (string) ucwords(strtolower($res[$i]['type_md']));
            $results[$i]['commission_amount'] = (string) ucwords(strtolower($res[$i]['commission_amount_md']));
        }
    }
    $result['slab'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Provider";
} else {
    $result['slab'] = "";
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>