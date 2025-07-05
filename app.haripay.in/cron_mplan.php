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

$sql_del = "Delete from provider_plans where service_type = 'Prepaid'";
$set_del = setXbyY($sql_del);

$sql = "Select * from providers where is_active = 1 and service = 'Prepaid'";
$res = getXbyY($sql);
$rows = count($res);

$sql_circle = "Select * from service_circles where is_active = 1";
$res_circle = getXbyY($sql_circle);
$row_circle = count($res_circle);

for ($i = 0; $i < $rows; $i++) {
	for ($j = 0; $j < $row_circle; $j++) {
		//$result = mplan_plans($res[$i]['provider'], $res_circle[$j]['circle_name']);
		$o1->service_type = "Prepaid";
		$o1->operator_id = $res[$i]['provider_id'];
		$o1->operator = $res[$i]['provider'];
		$o1->circle = $res_circle[$j]['circle_name'];

		$result = mplan_plans($res[$i]['provider'], $res_circle[$j]['circle_name']);
		$objects = (get_object_vars($result->records));
		$total_objects = count($objects);
		//pt($objects);
		foreach ($objects as $key => $value) {
			$o1->plan_type = $key;
			$ptype = $key;

			$total_ptype = count($objects[$ptype]);

			for ($l = 0; $l < $total_ptype; $l++) {
				$o1->price = $objects[$ptype][$l]->rs;
				$o1->details = addslashes($objects[$ptype][$l]->desc);
				$o1->validity = addslashes($objects[$ptype][$l]->validity);
				$o1->last_update = $objects[$ptype][$l]->last_update;
				$o1->is_active = 1;
				pt($o1);
				$o1->provider_plan_id = $insertor->insert_object($o1, "provider_plans");

				unset($o1->provider_plan_id);
			}

		}

	}

}

?>