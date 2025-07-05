<?php

include "include.php";



if ($o->user_id > 0) {
    $sql = "SELECT * FROM upi_setup WHERE upi_setup_id='1'";
    $res = getXbyY($sql);
    $rows = count($res);
	///
	$result['payeeVPA'] = $res[0]['payeeVPA'];
	$result['payeeName'] = $res[0]['payeeName'];
	$result['payeeMerchantCode'] = $res[0]['payeeMerchantCode'];
	$result['minimumAmount'] = $res[0]['minimumAmount'];
	$result['transactionRefUrl'] = $res[0]['transactionRefUrl'];
	$result['aid'] = $res[0]['aid'];
}else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>