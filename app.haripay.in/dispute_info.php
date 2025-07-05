<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {
	$ref_number = $_POST['ref_number'];

	$sql = "Select wallet_id, user_id from wallet where ref_number = '" . $ref_number . "' and disputed != 'No'";
	$res = getXbyY($sql);
	$rows = count($res);

	if ($rows == 1) {
		$sql_dispute = "Select * from disputes where wallet_id = " . $res[0]['wallet_id'];
		$res_dispute = getXbyY($sql_dispute);

		if ($res_dispute[0]['dispute_date'] == $res_dispute[0]['resolution_date']) {
			$res_dispute[0]['resolution_date'] = "-";
		} else {
			$res_dispute[0]['resolution_date'] = format_date_without_br($res_dispute[0]['resolution_date']);
		}

		$dispute_reply = "<b>Dispute Date: " . format_date_without_br($res_dispute[0]['dispute_date']) . "</b><br />";
		$dispute_reply .= "Dispute: " . $res_dispute[0]['dispute'] . "<br /><br />";
		$dispute_reply .= "<b>Reply Date: " . $res_dispute[0]['resolution_date'] . "</b><br />";
		$dispute_reply .= "Dispute Reply: " . $res_dispute[0]['dispute_resolution'] . "<br />";

		$result['error'] = 0;
		$result['error_msg'] = $dispute_reply;
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "Something went wrong. Please try again";
	}
}
echo json_encode(($result));
?>