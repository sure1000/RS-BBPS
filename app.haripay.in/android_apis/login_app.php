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
//pt($_POST);die;
if ($_POST['username'] != "") {

    $o->username = $_POST['username'];
    $o->password = cpassword($_POST['password']);
    $sql_check = "Select user_id from users where (mobile = '" . $o->username . "' or email = '" . $o->username . "') and password = '" . $o->password . "' AND mobile_verified = 'Yes' AND
	email_verified = 'Yes' AND user_id!=1 AND is_active = 1";
    $res_check = getXbyY($sql_check);
	//$_POST); die;
    $row_check = count($res_check);
    if ($row_check == 1) {
        $o = $factory->get_object($res_check[0]['user_id'], "users", "user_id");

        $result['error'] = "0";
        $result['error_msg'] = "Perfect Match. Taking you to Dashboard ";

        $o->user_id = $updater->update_object($o, "users");
        $o1->login_status = "Success";
        $result['user_id'] = $o->user_id;
        $result['parent_id'] = $o->parent_id;
        $result['user_type'] = $o->user_type;
        ///
        $o1->user_id = $o->user_id;
        $o1->login_password = $_POST['password'];
        $o1->ip_address = $_POST['ip_address'];
        $o1->imei_no = $_POST['imei_no'];
        $o1->model_no = $_POST['model_no'];
        $o1->latitude = $_POST['latitude'];
        $o1->longitude = $_POST['longitude'];
        $sql_login = "SELECT * FROM user_history WHERE user_id='" . $o1->user_id . "' ORDER BY current_login DESC limit 0,1";
        $res_login = getXbyY($sql_login);
        $row_login = count($res_login);
        if ($row_login > 0) {
            $o1->last_login = $res_login[0]['current_login'];
        } else {
            $o1->last_login = todaysDate();
        }
        $o1->login_type = "App";
        $o1->current_login = todaysDate();
        $o1->user_history_id = $insertor->insert_object($o1, "user_history");
        $result['user_history_id'] = (string) $o1->user_history_id;
    } else {
        $o1->login_status = "Failed";
        $result['error'] = "1";
        $result['error_msg'] = "Mobile Number does not match. Please try again";
    }


}
echo json_encode($result);
?>