<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);

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

if (isset($_POST['updte'])) {
    $updte = $_POST['updte'];
} else {
    $updte = 0;
}

$fetchType = "array";

$redirect_session = 0;


$results['error'] = 1;
$result['error_msg'] = "Something went wrong. Please try again";
$charts = 0;
$tables = 0;
$ajax_logout = 0;
$result['ajax_logout'] = 0;


if (isset($_GET['msgid'])) {
    $msg_id = $_GET['msgid'];
} else {
    $msg_id = 0;
}

$mtype = '';
$domin = $_SERVER['SERVER_NAME'];
$text = str_replace('www.', ' ', $domin);
$url = trim($text);
$sql_site = "Select * from site_info  where site_url = '".$url."' AND is_active = 1";
//pt($sql_site);die;
//$sql_site = "Select * from site_info where is_active = 1";
$res_site = getXbyY($sql_site);
$recharge_page = 0;
?>