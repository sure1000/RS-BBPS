<?php

session_start();

include "include.php";
include "session.php";

$member_id = "EZ904522";
$amount = "100";
$agent_id = "12345678";
$api_key = "edad103d8c";
$text = "8f6cd256d7e0fdb5c5401288c272c227f4c0ce4ec2100700d1259c03e8150642394b6b27847a2f3048b5e9b9ddc462899b2e5a305923c686d980b53f93eedcda";


$plaintext = ''.$member_id.'|'.$amount.'|'.$agent_id.'|';
            $cipher = "SHA512";
            $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
            $encData = base64_encode(openssl_encrypt($plaintext, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));
            $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);
           



echo json_encode($result);
?>


