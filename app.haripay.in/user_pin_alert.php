<?php
session_start();

include "include.php";
include "session.php";


$sql ="Select * from users where user_type='Retailer' and is_active='1'";
$res =getXbyY($sql);
$row =count($res);

for($i=0;$i< $row;$i++){

	$o1=$factory->get_object($res[$i]['user_id'] , "users" ,"user_id");
	$o1->kyc_id =rand(5000, 9999);
    $email_subject = $res_site[0]['site_name'] . "Your User Pin";
    $email_message=  "Your User Pin on  is :".$o1->kyc_id;        
                sendmail($email_from, $o1->email, $email_subject, $email_message);

                $message = "Your User Pin on is :".$o1->kyc_id;
                sendsms_payzoom($o1->mobile, $message);
	$o1=$updater->update_object($o1,"users");
}
header('Location:index.php');
?>