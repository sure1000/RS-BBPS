<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

$result['commission_amount'] = 0;
$result['commission_percentage'] = 0;

if ($updte == 1) {
	$o1->provider_id = $_POST['provider_id'];

	if ($o1->provider_id == "" || $o1->provider_id == "0") {
		$result['error'] = 1;
		$result['error_msg'] = "Something went wrong. Please try again";
	} else {
		$o1 = $factory->get_object($o1->provider_id, "providers", "provider_id");
// pt($o1);
		$result['error'] = 0;
		if ($o1->logo == "") {
			$result['logo'] = "<img src='img/logo.png' width='100' class='img-rounded' />";
		} else {
			$result['logo'] = "<img src='provider_logos/" . $o1->logo . "' width='100' class='img-rounded' />";
		}
 // pt($result['logo']);
		if ($o1->provider_id != "") {
			$comm = commission_amount($o->plan_id, $o1->provider_id);

			$result['commission_amount'] = $comm['amount'];
			$result['commission_percentage'] = $comm['percentage'];
		}

	}
}

echo json_encode($result);

?>