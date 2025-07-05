<?php

include "include.php";



if ($o->user_id > 0) {

    $sql = "Select * from notifications where user_id = " . $o->user_id . " and is_active = 1  ";
    $res = getXbyY($sql);
    $rows = count($res);
    $sql_clear_notifications = "Update notifications set is_read = 'Yes' where user_id = ".$o->user_id;
    $set_clear_notifications = setXbyY($sql_clear_notifications);

    if($rows>0){

    for ($i = 0; $i < $rows; $i++) {
        $results[$i]['is_read']=$res[$i]['is_read'];
        $results[$i]['notification'] = $res[$i]['notification'];
        $results[$i]['notification_date'] =$res[$i]['notification_date'];
    }
    $result['notification']=$results;
    $result['error']="0";
    $result['error_msg']="All notifications";

}else {
   $result['error'] = "1";
        $result['error_msg'] = "No notification "; 
    
}
}else{
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}


echo json_encode($result);
?>  