<?php
include "include.php";
$user_id = $_POST['user_id'];
$payment_mode = $_POST['payment_mode'];
if($payment_mode) $w= " AND payment_mode ='$payment_mode'";
else $w = '';
if ($user_id > 0) {
    $sql = "Select * from payment_mode where is_active = 1 $w order by account_name";
    $res = getXbyY($sql);
    $rows = count($res);
    
/*      $parent = "No";   
if($o->parent_id > 0){
     $o1 = $factory->get_factory($o->parent_id, "users", "user_id");
     if($o1->user_type != "Admin"){
      $parent = "Yes";   
     }
} */
/*  if ($parent == "Yes") {
                                           
      $results[0]['bank_id'] = 'Parent';
        $results[0]['bank_name'] = (string) $o1->name ;
        $results[0]['account_no'] = (string) $o1->mobile;
        $results[0]['account_holder_name'] =(string) $o1->user_name ;
        $results[0]['bank_logo'] = '' ;
        $j = '1';  
 }else{
     $j = '0';
 } */
 $j = '0';
    for ($i = 0; $i < $rows; $i++) {
        $results[$j]['account_no'] = ucwords(strtolower($res[$i]['account_number']));
        $results[$j]['account_holder_name'] =$res[$i]['account_name'];
        $results[$j]['ifsc_code'] =$res[$i]['ifsc_code'];
		$results[$j]['mode'] =$res[$i]['payment_mode'];
        $results[$j]['bank_logo'] =  "" . $_SERVER['HTTP_HOST'] . "/img/".$res[$i]['logo'];
        $j++;
    }
    $result['bank_details'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Bank";
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}
echo json_encode($result);
?>