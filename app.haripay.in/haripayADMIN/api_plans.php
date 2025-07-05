<?php

session_start();
include "include.php";
include "session.php";

if (isset($_GET['api_id'])) {
	$o1->api_id = $_GET['api_id'];
} else {
	$o1->api_id = 0;
}

if ($o1->api_id > 0) {
	$o1 = $factory->get_object($o1->api_id, "api", "api_id");
} else {
	header("location:apis.php?msgid=4");
}

$service_id = 0;
$service_name = "";
$trigger_service = "1=1";

if ($updte > 0) {

	$service_id = $_POST['services'];
	if ($service_id > 0) {
		$trigger_service = "service_id = '" . $_POST['services'] . "'";
		$service_name = get_service_name($service_id);
	}

	if ($updte == 3 || $updte == 1) {
		//pt($_POST);
		$service_id = $_POST['services'];
		$commission_amount = $_POST['all_commission_amount'];
		$commission_percentage = $_POST['all_commission_percentage'];
		$total_providers = $_POST['total_providers'];

		for ($i = 0; $i < $total_providers; $i++) {
			$pid = "provider_id_" . $i;
			$apid = "provider_api_id_" . $i;
			$o2->api_provider_id = $_POST[$apid];
			$o2->api_id = $o1->api_id;
			$o2->api_name = $o1->api_name;
			$o2->provider_id = $_POST[$pid];
			$o2->provider = get_provider_name($o2->provider_id);
			$o2->is_active = 1;

			if ($updte == 3) {
				$o2->commission_amount = $_POST['all_commission_amount'];
				$o2->commission_percentage = $_POST['all_commission_percentage'];
			} else {
				$com_amount = "commission_amount_" . $o2->provider_id;
				$com_percentage = "commission_percentage_" . $o2->provider_id;
				$o2->commission_amount = $_POST[$com_amount];
				$o2->commission_percentage = $_POST[$com_percentage];
			}

			if ($o2->commission_amount == "") {
				$o2->commission_amount = 0;
			}
			if ($o2->commission_percentage == "") {
				$o2->commission_percentage = 0;
			}
			//pt($o2);

			if ($o2->api_provider_id == 0) {
				$o2->api_provider_id = $insertor->insert_object($o2, "api_provider");
			} else {
				$o2->api_provider_id = $updater->update_object($o2, "api_provider");
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

$sql_providers = "Select * from api_provider where api_id = " . $o1->api_id . " and is_active = 1";
$res_providers = getXbyY($sql_providers);
$row_providers = count($res_providers);

for ($i = 0; $i < $rows; $i++) {
	$res[$i]['api_provider_id'] = 0;
	$res[$i]['commission_amount'] = 0;
	$res[$i]['commission_percentage'] = 0;
	for ($j = 0; $j < $row_providers; $j++) {
		if ($res[$i]['provider_id'] == $res_providers[$j]['provider_id']) {
			$res[$i]['api_provider_id'] = $res_providers[$j]['api_provider_id'];
			$res[$i]['commission_amount'] = $res_providers[$j]['commission_amount'];
			$res[$i]['commission_percentage'] = $res_providers[$j]['commission_percentage'];
		}
	}
}

include "html/includes/header.php";
include "html/api_plans.php";
include "html/includes/footer.php";
include "js/api_plans.js";
?>


