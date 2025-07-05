<?php
include "include.php";

if ($_POST) {
    
    $mobile = $_POST['number'];
    $provider_id = $_POST['provider'];
    //pt($provider_id);die;
    $offers = mplan_bill_info_app($provider_id, $mobile);
	//pt($offers);die;
    
$result['plans'] = $offers;
}


echo $offers;
?>