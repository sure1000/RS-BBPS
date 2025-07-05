<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['search']);

$service_id = $_POST['service_id'];
$provider_id = $_POST['provider_id'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$search_val = $_POST['search_val'];

if($service_id > 0){
    $_SESSION['search']['service_id'] = $service_id;
}
if($provider_id > 0){
    $_SESSION['search']['provider_id'] = $provider_id;
}
if($from_date != ""){
    $_SESSION['search']['from_date'] = $from_date;
}
if($to_date != ""){
    $_SESSION['search']['to_date'] = $to_date;
}
if($search_val != ""){
    $_SESSION['search']['search_val'] = $search_val;
}

?>