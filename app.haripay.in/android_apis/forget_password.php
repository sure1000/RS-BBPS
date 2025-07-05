<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');
//include "include.php";
include "../core/dbInfo.php";
include_once "../core/dbFunctions.php";
include_once "../core/core_classes.php";
include_once "../core/get_classes.php";
include_once "../core/insert_classes.php";
include_once "../core/update_classes.php";
include_once "../core/errors.php";
include_once '../core/PHPMailerAutoload.php';

parameters_check();

$o = new stdClass();
$o1 = new stdClass();
$o2 = new stdClass();
$o3 = new stdClass();
$o4 = new stdClass();
$o5 = new stdClass();
$o6 = new stdClass();
$o7 = new stdClass();
$o8 = new stdClass();
$o9 = new stdClass();
$o10 = new stdClass();

$factory = new TypeFactory($dbName);
$insertor = new TypeInsertor($dbName);
$updater = new TypeUpdater($dbName);

	if (isset($_POST['updte1'])) {
	$updte = $_POST['updte1'];
} else {
	$updte = 0;
}
function randomPassword()
	{
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}
if ($updte == 1) {
	$o->email = $_POST['forgot_email'];

	$sql_check = "Select user_id from users where( email = '" . $o->email . "' or mobile = '" . $o->email . "') and is_active > 0";
	$res_check = getXbyY($sql_check);
	$row_check = count($res_check);

	if ($row_check == 1) {
		$o = $factory->get_object($res_check[0]['user_id'], "users", "user_id");
        $pin = rand(1111,9999);
		$pass= randomPassword();
		$o->password = cpassword($pass);
		$o->kyc_id = $pin;

		$o->user_id = $updater->update_object($o, "users");

		$email_from = $res_site[0]['email'];
		$email_to = $o->email;
		$email_subject = "Password  & Pin Reset for " . $res_site[0]['site_name'];
        $email_message ="Your Password is ".$pass." & Pin is " . $pin;		

		sendmail($email_from, $email_to, $email_subject, $email_message);

	//	$mobile_message = "Password for " . $res_site[0]['site_name'] . " is " . $pass . " & Pin is  " . $pin . " If this was not from you, there is nothing to worry, just ignore the request";
		$mobile_message = "Dear User your password is " . $pass . "& pin is   " . $pin . " Thanks you...";
		//pt($email_message);
		sendsms_payzoom($o->mobile, $mobile_message);

		$result['error'] = 0;
		$result['error_msg'] = "Password & Pin sent on your mobile and email. Please change your pin & password ";
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "No user found with this email. Please check email";
	}
}


echo json_encode($result);
?>