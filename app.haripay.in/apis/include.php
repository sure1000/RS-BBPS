<?php

header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);

include "../core/dbInfo.php";
include_once "../core/dbFunctions.php";
include_once "../core/core_classes.php";
include_once "../core/get_classes.php";
include_once "../core/insert_classes.php";
include_once "../core/update_classes.php";
include_once "../core/errors.php";
include_once '../core/PHPMailerAutoload.php';

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
if (isset($_POST['uname'])) {
	$username = $_POST['uname'];
} else {
	$username = "";
}
if (isset($_POST['token'])) {
	$token = $_POST['token'];
} else {
	$token = "";
}

$sql = "Select api_token_id from API_token where username = '" . $username . "' and token = '" . $token . "' and is_active ='1'";
$res = getXbyY($sql);
$row = count($res);

if ($row == '1') {
	if ($_POST['user_id'] > 0) {
		$o->user_id = $_POST['user_id'];
		$o = $factory->get_object($o->user_id, "users", "user_id");

		if ($o->mobile_verified == "Yes" && $o->email_verified == "Yes") {

			if ($o->is_active == "1") {

				$sql_user_services = "Select * from user_services where user_id = " . $o->user_id . " and status ='Yes'";
				$res_user_services = getXbyY($sql_user_services);
				$rows_user_services = count($res_user_services);
				$user_services = [];
				$o11->is_prepaid = "No";
				$o11->is_postpaid = "No";
				$o11->is_landline = "No";
				$o11->is_dth = "No";
				$o11->is_dth_activation = "No";
				$o11->is_electricity = "No";
				$o11->is_gas = "No";
				$o11->is_insurance = "No";
				$o11->is_school_fees = "No";
				$o11->is_water = "No";
				$o11->is_wallet = "No";
				$o11->is_stv = "No";
				if ($rows_user_services > 0) {
					for ($i = 0; $i < $rows_user_services; $i++) {
						$user_services[]['type'] = $res_user_services[$i]['service_name'];
					}
				}
				$tt = count($user_services);
				if ($tt > 0) {
					for ($st = 0; $st < $tt; $st++) {
						if ($user_services[$st]['type'] == 'Prepaid') {
							$o11->is_prepaid = "Yes";
						}
						if ($user_services[$st]['type'] == 'Postpaid') {
							$o11->is_postpaid = "Yes";
						}
						if ($user_services[$st]['type'] == 'Landline') {
							$o11->is_landline = "Yes";
						}
						if ($user_services[$st]['type'] == 'DTH') {
							$o11->is_dth = "Yes";
						}
						if ($user_services[$st]['type'] == 'DTH Activation') {
							$o11->is_dth_activation = "Yes";
						}
						if ($user_services[$st]['type'] == 'Electricity') {
							$o11->is_electricity = "Yes";
						}
						if ($user_services[$st]['type'] == 'Gas') {
							$o11->is_gas = "Yes";
						}
						if ($user_services[$st]['type'] == 'Insurance') {
							$o11->is_insurance = "Yes";
						}
						if ($user_services[$st]['type'] == 'School Fees') {
							$o11->is_school_fees = "Yes";
						}
						if ($user_services[$st]['type'] == 'Water') {
							$o11->is_water = "Yes";
						}
						if ($user_services[$st]['type'] == 'Wallet') {
							$o11->is_wallet = "Yes";
						}
						if ($user_services[$st]['type'] == 'Stv') {
							$o11->is_stv = "Yes";
						}
					}
				}
			}
		} else {
			if ($verify_email == 1) {

			} else {
				$result['error'] = "1";
				$result['error_msg'] = "User Blocked.";

				echo json_encode($result);
				die();
			}
		}
	} else {
		if ($_POST['userid'] > 0) {
			$_POST['user_id'] = $_POST['userid'];
			$o->user_id = $_POST['user_id'];
			$o = $factory->get_object($o->user_id, "users", "user_id");
		}
	}
} else {

	$result['error'] = "1";
	$result['error_msg'] = "App Username & Token Mismatch.";

	echo json_encode($result);
	die();

}
$sql_site = "Select * from site_info where is_active = 1";
$res_site = getXbyY($sql_site);
if ($res_site[0]['is_updating'] != "") {
	$o11->website_status = $res_site[0]['is_updating'];
} else {
	$o11->website_status = "No";
}
?>