<?php
include "include.php";
if ($o->user_id > 0) {
    $sql = "Select * from payment_mode where is_active = 1";
    $res = getXbyY($sql);
    $rows = count($res);
	$j = '0';
    for ($i = 0; $i < $rows; $i++) {
		$results[$j]['id'] =$res[$i]['payment_mode_id'];
        $results[$j]['account_no'] = ucwords(strtolower($res[$i]['account_number']));
        $results[$j]['account_holder_name'] =$res[$i]['account_name'];
        $results[$j]['ifsc_code'] =$res[$i]['ifsc_code'];
		$results[$j]['bank_name'] =$res[$i]['payment_mode'];
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