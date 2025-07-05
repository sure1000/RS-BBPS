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
}

$sql = "Select * from api_wallet where api_id = ".$o1->api_id." order by transaction_date DESC";
$res = getXbyY($sql);
$rows = count($res);

$cash_amount = 0;
$credit_amount = 0;
for($i=0;$i<$rows;$i++){
	$data[$i][] = $i+1;
	$data[$i][] = $res[$i]['transaction_date'];
	$data[$i][] = $res[$i]['transaction_details'];
	if($res[$i]['cash_credit'] == "Cash"){
		$data[$i][] = "<i class='fa fa-rupee-sign'></i> ".$res[$i]['amount'];
		$data[$i][] = "-";
		$cash_amount = $cash_amount + $res[$i]['amount'];
	}else{
		$data[$i][] = "-";
		$data[$i][] = "<i class='fa fa-rupee-sign'></i> ".$res[$i]['amount'];
		$credit_amount = $credit_amount + $res[$i]['amount'];
	}
}

$data[$i][] = $i+1;
$data[$i][] = "";
$data[$i][] = "<b>Total</b>";
$data[$i][] = "<b><i class='fa fa-rupee-sign'></i> ".$cash_amount."</b>";
$data[$i][] = "<b><i class='fa fa-rupee-sign'></i> ".$credit_amount."</b>";




echo json_encode($data);
?>