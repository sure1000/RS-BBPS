<?php
include "include.php";
if ($_POST['user_id']) {
    $number = $_POST['number'];
    $api_response = dth_operator($number);
    $res = json_decode(json_encode($api_response->records), true);
    if($res['Operator']){
        
        $op = $res['Operator'];								
		$operator = array('DishTv'=>13,'Airteldth'=>12,'TataSky'=>16,'Videocon'=>17,'Sundirect'=>15);
         $result['error'] = "0";
         $result['data'] = $operator[$op];
          $result['error_msg'] = '';
        
    }else{
        $result['error'] = "1";
        $result['error_msg'] = $api_response->Message;
        
    }
}
echo json_encode($result);
?>