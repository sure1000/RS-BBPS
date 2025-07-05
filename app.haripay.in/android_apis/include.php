<?php

//error_reporting(E_ERROR | E_PARSE);
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');

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

$o->username = $_POST['username'];
$o->password = cpassword($_POST['password']);
$sql = "Select user_id from users where (mobile = '" . $o->username . "' or email = '" . $o->username . "') and password = '" . $o->password. "' AND is_active = 1";
$res = getXbyY($sql);
$row = count($res);
//pt($res);die; 
if ($row == '1') {
    $o->user_id = $res[0]['user_id'];
		$o = $factory->get_object($o->user_id, "users", "user_id");
}else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
    echo json_encode($result);die;
}


?>