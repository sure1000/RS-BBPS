<?php
include "include.php";

$sql = "Select * from wallet where recharge_path = 'Api' and parent_id = 0 and call_back_status = 0 and status != 'Pending' limit 0,100";
$res = getXbyY($sql);
$rows = count($res);

for ($i = 0; $i < $rows; $i++) {
	$sql_key = "Select * from api_ip_key where ip_address = '" . $res[$i]['ip_address'] . "'";
	$res_key = getXbyY($sql_key);

	if ($res[$i]['status'] == "Success") {
		$sql_comm = "Select amount from wallet where parent_id = " . $res[$i]['wallet_id'];
		$res_comm = getXbyY($sql_comm);
		$comm = $res_comm[0]['amount'];
	} else {
		$comm = 0;
	}

	$url = $res_key[0]['call_back_url'] . "?reqid=" . $res[$i]['api_ref_number'] . "&status=" . $res[$i]['status'] . "&amount=" . $res[$i]['amount'] . "&commission=" . $comm . "&opid=" . $res[$i]['opid'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$api_call_back_response = curl_exec($ch);
	curl_close($ch);

	$sql_set = "Update wallet set call_back_status = '1', api_call_back_url = '" . $url . "', api_call_back_response = '" . $api_call_back_response . "' where wallet_id = " . $res[$i]['wallet_id'];
	$res_set = setXbyY($sql_set);

}
echo "callback hit";
?>