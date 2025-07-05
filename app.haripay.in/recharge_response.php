<?php
session_start();

include_once "include.php";
include_once "session.php";

$bg_class = "";
if ($o1->transaction_type == "Commission") {
	$bg_class = "modal_design";
	$message = "Success";
} else if ($o1->transaction_type == "Recharge") {
	if ($o1->status == "Pending") {
		$bg_class = "bg-warning";
		$message = "Pending";
	} else if ($o1->status == "Success") {
		$bg_class = "modal_design";
		$message = "Success";
	}

} else {
	$bg_class = "bg-danger";
	$message = "Failed";
}

$response = '<div class="modal-content ' . $bg_class . ' white">';
$response .= '<div class="modal-body">';
$response .= '<div class="row" >';
$response .= '<div class="col-md-12 small text-left ">';
$response .= format_date_without_br($o1->transaction_date) . '<hr />';
$response .= '</div>';
$response .= '<div class="col-md-6 padding_10 small">';
$response .= '<strong>' . $message . '</strong> <br />';
$response .= '<i class="fa fa-rupee-sign"></i>' . $total_amount . '<br />';
$response .= 'Order No: ' . $o1->ref_number;
$response .= '</div>';
$response .= '<div class="col-md-6 padding_10 text-right ">';
$o5 = $factory->get_object($o1->provider_id, "providers", "provider_id");
if ($o5->logo != "") {
	$response .= '<img src="provider_logos/' . $o5->logo . '" width="70" class="img-rounded" />';
}
$response .= '</div>';
$response .= '<div class="col-md-5 small padding_10">Item</div>';
$response .= '<div class="col-md-7 small padding_10"><b>' . $o1->provider_type . '</b></div>';
$response .= '<div class="col-md-5 small padding_10">Number</div>';
$response .= '<div class="col-md-7 small padding_10"><b>' . $o1->mobile_number . '</b></div>';
$response .= '<div class="col-md-5 small padding_10">Operator</div>';
$response .= '<div class="col-md-7 small padding_10"><b>' . $o1->provider_name . ' ' . $o1->circle_name . '</b></div>';
$response .= '<div class="col-md-5 small padding_10">Operator ID</div>';
$response .= '<div class="col-md-7 small padding_10"><b>' . $o1->opid . '</b></div>';
$response .= '<div class="col-md-12"><hr /></div>';
$response .= '<div class="col-md-12 text-gray-400 small">';
if ($message == 'Success') {
	$response .= '<i class="fa fa-info-circle"></i> If you haven\'t recieved operator message/pack benefit, please contact your operator</div>';
} else if ($message == 'Pending') {
	$response .= '<i class="fa fa-info-circle"></i> The status is Pending and will be updated immediately as it\s status is changed.</div>';
} else {
	$response .= '<i class="fa fa-info-circle"></i> The Recharge has failed. And no amount has been charged.</div>';
}

$response .= '</div>';
$response .= '</div>';
$response .= '</div>';

$result['response'] = $response;
?>