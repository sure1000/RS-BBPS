<?php

session_start();
include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->user_plan_id = $_GET['aid'];
} else {
	$o1->user_plan_id = 0;
}

if ($o1->user_plan_id > 0) {
	$o1 = $factory->get_object($o1->user_plan_id, "user_plans", "user_plan_id");
} else {
	header("location:plans.php?msgid=4");
}

$service_id = 0;
$service_name = "";
$trigger_service = "1=1";

if ($updte > 0) {

	$service_id = $_POST['services'];
	if ($service_id > 0) {
		$trigger_service = "service_id = '" . $_POST['services'] . "'";
		$service_name = get_service_name($service_id);
		$o2->service_id = $service_id;
		$o2->service_name = $service_name;
	}

	if ($updte == 3 || $updte == 1) {

		$service_id = $_POST['services'];
		$commission_amount_rt = $_POST['all_commission_amount_rt'];
		$commission_amount_dt = $_POST['all_commission_amount_dt'];
		$commission_amount_md = $_POST['all_commission_amount_md'];
		$type_rt = $_POST['all_type_rt'];
		$type_dt = $_POST['all_type_dt'];
		$type_md = $_POST['all_type_md'];
		$total_providers = $_POST['total_providers'];

		for ($i = 0; $i < $total_providers; $i++) {
			$pid = "provider_id_" . $i;
			$apid = "user_plan_service_id_" . $i;
			$o2->user_plan_service_id = $_POST[$apid];
			$o2->user_plan_id = $o1->user_plan_id;
			$o2->provider_id = $_POST[$pid];
			$o2->provider_name = get_provider_name($o2->provider_id);
			$o2->is_active = 1;

			if ($updte == 3) {
				$o2->commission_amount_rt = $_POST['all_commission_amount_rt'];
				$o2->commission_amount_dt = $_POST['all_commission_amount_dt'];
				$o2->commission_amount_md = $_POST['all_commission_amount_md'];
				$o2->type_rt = $_POST['all_type_rt'];
				$o2->type_dt = $_POST['all_type_dt'];
				$o2->type_md = $_POST['all_type_md'];

			} else {
				$commission_amount_rt = "commission_amount_rt_" . $o2->provider_id;
				$commission_amount_dt = "commission_amount_dt_" . $o2->provider_id;
				$commission_amount_md = "commission_amount_md_" . $o2->provider_id;
				$type_dt = "type_dt_" . $o2->provider_id;
				$type_rt = "type_rt_" . $o2->provider_id;
				$type_md = "type_md_" . $o2->provider_id;

				$o2->commission_amount_rt = $_POST[$commission_amount_rt];
				$o2->commission_amount_dt = $_POST[$commission_amount_dt];
				$o2->commission_amount_md = $_POST[$commission_amount_md];
				$o2->type_rt = $_POST[$type_rt];
				$o2->type_dt = $_POST[$type_dt];
				$o2->type_md = $_POST[$type_md];

			}

			if ($o2->commission_amount_rt == "") {
				$o2->commission_amount_rt = 0;
			}
			if ($o2->commission_amount_dt == "") {
				$o2->commission_amount_dt = 0;
			}
			if ($o2->commission_amount_md == "") {
				$o2->commission_amount_md = 0;
			}
			if ($o2->user_plan_service_id == 0) {
				$o2->user_plan_service_id = $insertor->insert_object($o2, "user_plan_service");
			} else {
				$o2->user_plan_service_id = $updater->update_object($o2, "user_plan_service");
			}

			unset($o2);
			$o2 = new stdClass();

		}

		unset($_POST);
		$msg_id = 3;
		//header("location:")

	}

}

//$sql = "SELECT A.service_id, A.service_name, B.commission, B.percentage FROM services AS A LEFT JOIN api_services AS B ON (A.service_id = B.service_id) WHERE A.is_active = 1";
$sql = "Select * from providers where is_active = 1 and $trigger_service order by provider";
$res = getXbyY($sql);
$rows = count($res);

$sql_providers = "Select * from user_plan_service where user_plan_id = " . $o1->user_plan_id . " and is_active = 1";
$res_providers = getXbyY($sql_providers);
$row_providers = count($res_providers);

for ($i = 0; $i < $rows; $i++) {
	$res[$i]['user_plan_service_id'] = 0;
	$res[$i]['commission_amount_dt'] = 0;
	$res[$i]['commission_amount_rt'] = 0;
	$res[$i]['commission_amount_md'] = 0;
	for ($j = 0; $j < $row_providers; $j++) {
		if ($res[$i]['provider_id'] == $res_providers[$j]['provider_id']) {
			$res[$i]['user_plan_service_id'] = $res_providers[$j]['user_plan_service_id'];
			$res[$i]['commission_amount_dt'] = $res_providers[$j]['commission_amount_dt'];
			$res[$i]['commission_amount_rt'] = $res_providers[$j]['commission_amount_rt'];
			$res[$i]['commission_amount_md'] = $res_providers[$j]['commission_amount_md'];
			$res[$i]['type_rt'] = $res_providers[$j]['type_rt'];
			$res[$i]['type_dt'] = $res_providers[$j]['type_dt'];
			$res[$i]['type_md'] = $res_providers[$j]['type_md'];
		}
	}
}

include "html/includes/header.php";
include "html/plan_commission.php";
include "html/includes/footer.php";
include "js/plan_details.js";
?>


