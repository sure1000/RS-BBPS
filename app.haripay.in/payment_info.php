<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if (isset($_POST['mode'])) {
	$mode = $_POST['mode'];
} else {
	$mode = "";
}

if ($mode == "IMPS" || $mode == "NEFT" || $mode == "RTGS") {
	$result['error'] = 0;
	$result['error_msg'] = "<b>Account Name: ShibaTechnology</b><br />Account Number: PAY" . $o->user_name . "<br /> <span class='red'>(Account Number is Case Sensitive and is only in Capital Letter)</span><br />IFSC Code: ICIC0000104";
} else {

	$sql = "Select * from payment_mode where account_name = '" . $mode . "' and is_active = 1";
	$res = getXbyY($sql);
	$rows = count($res);

	if ($rows > 0) {
		$result['error'] = 0;
		$result['error_msg'] = "<b>Account Name:" . $res[0]['account_name'] . "</b><br />Account Number: " . $res[0]['account_number'] . "<br />";
		if ($res[0]['ifsc_code'] != "") {
			$result['error_msg'] .= "IFSC Code: " . $res[0]['ifsc_code'] . "<br />";
		}
		if ($res[0]['logo'] != "") {
			$result['error_msg'] .= "<img src='./provider_logos/" . $res[0]['logo'] . "' width='50%' class='img-responsible' alt='logo' />";
		}
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "Something went wrong. Please try again";
	}
}
echo json_encode(($result));

?>