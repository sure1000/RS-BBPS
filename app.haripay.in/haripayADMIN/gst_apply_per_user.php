<?php
session_start();

include "include.php";
include "session.php";

$sql = "Select * from wallet where user_id = 42 and transaction_type = 'Recharge' and status = 'Success'";
$res = getXbyY($sql);
$rows = count($res);

$total = 0;
$comm = 0;
$tgst = 0;

for ($i = 0; $i < $rows; $i++) {
	$sql_comm = "Select wallet_id, amount from wallet where parent_id = " . $res[$i]['wallet_id'];
	$res_comm = getXbyY($sql_comm);
	echo $res[$i]['amount'] . "---------->" . $res_comm[0]['amount'] . "----->";
	echo $gst = round(((($res[$i]['amount'] - $res_comm[0]['amount']) / 118) * 18), 2);
	echo "---->";
	echo $tds = "0";
	echo "<br />";

	$total = $total + $res[$i]['amount'];
	$comm = $comm + $res_comm[0]['amount'];
	$tgst = $tgst + $gst;

	$sql_update = "Update wallet set gst = '" . round($gst, 2) . "', comment = '" . $res[$i]['amount'] . "' where wallet_id = " . $res_comm[0]['wallet_id'];
	//$set_update = setXbyY($sql_update);
}

echo "<b>" . $total . "-------->" . $comm . "----->" . $tgst . "<br />";
?>