<?php
include "include.php";


if (isset($_POST['mode'])) {
	$mode = $_POST['mode'];
} else {
	$mode = "";
}

if ($mode == "IMPS" || $mode == "NEFT" || $mode == "RTGS") {
	$result['error'] = 0;
	$result['error_msg'] = "Account Name: papaFast\nAccount Number: PAY" . $o->user_name . "\n(Account Number is Case Sensitive and is only in Capital Letter)\nFSC Code: ICIC0000104";
} else {

	$sql = "Select * from payment_mode where payment_mode = '" . $mode . "' and is_active = 1";
	$res = getXbyY($sql);
	$rows = count($res);

	if ($rows > 0) {
		$result['error'] = 0;
		$result['error_msg'] = "Account Name:" . $res[0]['account_name'] . "\nAccount Number: " . $res[0]['account_number'] . "\n";
		if ($res[0]['ifsc_code'] != "") {
			$result['error_msg'] .= "IFSC Code: " . $res[0]['ifsc_code'] . "";
		}
		if ($res[0]['logo'] != "") {
			$result['image'] = "http://" . $_SERVER['HTTP_HOST'] . "/provider_logos/" . $res[0]['logo'];
		}
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "Something went wrong. Please try again";
	}
}
echo json_encode(($result));

?>