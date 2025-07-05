<?php

include "include.php";


 if ($o->user_id > 0) {

    $sql = "Select * from users where is_active = 1 and  parent_id ='" . $o->user_id . "' order by user_name";
    $res = getXbyY($sql);
    $rows = count($res);

  if($rows > 0){
 for ($i = 0; $i < $rows; $i++) {
   $distt = get_user_rt("plan",$res[$i]['user_id']);

  $count_dis =count($distt);
 
for($j = 0; $j < $count_dis; $j++){
 $results[$j]['user_id'] = (string)$distt[$j]['user_id'];
        $results[$j]['name'] = (string)$distt[$j]['name'];
        $results[$j]['user_name'] = (string)$distt[$j]['user_name'];
        $results[$j]['mobile'] = (string)$distt[$j]['mobile'];
        $results[$j]['company_name'] =(string)$distt[$j]['company_name'];
        $results[$j]['District'] =(string)$distt[$j]['district'];
        $results[$j]['State'] =(string)$distt[$j]['state'];
        $results[$j]['current_balance'] =(string)$distt[$j]['amount_balance'];
}
       
       

          
    }
    $result['user_list'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Users";
  }else{
     $result['user_list'] = [];
     $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
  }

   
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}   




echo json_encode($result);
?>