<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
//require_once("../../db.php");
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
if($isValidChecksum == "TRUE") {
    
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		$data['user_id'] = 1;
		$data['username'] = $_COOKIE['username'];
		$data['amount'] = $_POST['TXNAMOUNT'];
		$data['order_id'] = $_POST['ORDERID'];
		$data['credit_paid'] = 'Credit';
		$data['payment_mode'] = $_POST['PAYMENTMODE'];
		$data['updte'] = 1;
		$data['uname'] =UNAME;
		$data['token'] =TOKEN;
		$parameters = http_build_query($data);
			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/paytm_money.php');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		 $json = curl_exec($ch);
		curl_close($curl);
		header('location:https://fastsbpay.in/apis/app/home');
	}
	else {
		header('location:https://fastsbpay.in/apis/app/failed');
		//echo "<b>Transaction status is failure</b>" . "<br/>";
	}


}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>