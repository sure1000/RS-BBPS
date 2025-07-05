<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);

include "/var/www/html/core/dbInfo.php";
include_once "/var/www/html/core/dbFunctions.php";
include_once "/var/www/html/core/core_classes.php";
include_once "/var/www/html/core/get_classes.php";
include_once "/var/www/html/core/insert_classes.php";
include_once "/var/www/html/core/update_classes.php";
include_once "/var/www/html/core/errors.php";
include_once '/var/www/html/core/PHPMailerAutoload.php';

parameters_check();

$o = new stdClass();
$o1 = new stdClass();
$o2 = new stdClass();
$o3 = new stdClass();
$o4 = new stdClass();
$o5 = new stdClass();
$o6 = new stdClass();
$o7 = new stdClass();
$o8 = new stdClass();
$o9 = new stdClass();
$o10 = new stdClass();

$factory = new TypeFactory($dbName);
$insertor = new TypeInsertor($dbName);
$updater = new TypeUpdater($dbName);

if (isset($_POST['updte'])) {
	$updte = $_POST['updte'];
} else {
	$updte = 0;
}

$fetchType = "array";

$redirect_session = 0;

$results['error'] = 1;
$result['error_msg'] = "Something went wrong. Please try again";
$charts = 0;
$tables = 0;
$ajax_logout = 0;
$kyc_id = 1;

if (isset($_GET['msgid'])) {
	$msg_id = $_GET['msgid'];
} else {
	$msg_id = 0;
}

$sql_template = "Select * from template where is_active = 1";
$res_template = getXbyY($sql_template);

$sql_site = "Select * from site_info where is_active = 1";
$res_site = getXbyY($sql_site);

$path = "./templates/" . $res_template[0]['template_name'] . "/";

$recharge_page = 0;

$sql_notice = "Select * from notice_board where is_active = 1";
$res_notice = getXbyY($sql_notice);
$row_notice = count($res_notice);
$show_notice = 0;

if ($res_notice[0]['notice_type'] == "Image") {
	if (isset($_SESSION['notice_board_id'])) {
		if ($_SESSION['notice_board_id'] != $res_notice[0]['notice_board_id']) {
			$show_notice = 1;
			$_SESSION['notice_board_id'] = $res_notice[0]['notice_board_id'];
		}
	} else {
		$show_notice = 1;
		$_SESSION['notice_board_id'] = $res_notice[0]['notice_board_id'];

	}

}

$sql = "Select wallet_id, user_id from wallet where status = 'Pending'";
$res = getXbyY($sql);
$rows = count($res);

for ($i = 0; $i < $rows; $i++) {
	$o = $factory->get_object($res[$i]['user_id'], "users", "user_id");

	$o1->wallet_id = $res[$i]['wallet_id'];
	$o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");

	if ($o1->api_id > 0) {
		if ($o1->api_id == '8') {
			$result = tiptopmoney_status($o1);
		} else if ($o1->api_id == '6') {
			$result = easymywallet_status($o1);
		}

		$o1->opid = $result['opid_id'];

		//$result['status'] = "Success";
		if ($result['status'] == "Failed") {
			$o1->status = "Failed";
			$o1->api_response = $result['response'];
			$o1->wallet_id = $updater->update_object($o1, "wallet");
			$result['error_msg'] = "Recharge Failed";

			//$o1 = wallet_insert($o, "0", "", $o1->api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
			$o1->transaction_type = "Refund";
			$o1->status = "Success";
			$o1 = wallet_insert($o, $o1);
		} else if ($result['status'] == "Success") {
			$o1->status = "Success";
			$o1->api_response = $result['response'];
			$o1->wallet_id = $updater->update_object($o1, "wallet");
			$result['error_msg'] = "Recharge Success";

			set_commission($o1, $o, "Prepaid");
		} else {
			$result['status'] = "Pending";
			$result['error_msg'] = "Recharge Pending";
		}
	}
}

?>