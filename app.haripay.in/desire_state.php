<?php
die();
include "include.php";

//ipady_bank


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.instantpay.in/ws/dmi/bank_details",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"token\": \"f99daff05544f570cbbf100a24012921\",\"request\": {\"account\": \"{{account}}\",\"outletid\":1}}\r\n\r\n",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 551a48f2-8fd8-953f-e669-a03ade07f268"
  ),
));

 $response = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($response);

        $json = json_encode($xml);

       
$api_values = json_decode($json, true);



 for ($i = 0; $i < count($api_values['data']['item']); $i++) {
     
     
     $o1->bankID = $api_values['data']['item'][$i]['id'];
     $o1->bank_name = $api_values['data']['item'][$i]['bank_name'];
     $o1->ifsC_Code = $api_values['data']['item'][$i]['branch_ifsc'];
    $o1->status = "Active";
     $o1->is_active = "1";
     $o1 = $insertor->insert_object($o1, "ipay_bank");
     unset($o1);
     
 }










//for bank
//$url = "http://uat-api.deziremoney.com/api/DMR/BankList?key=FTyG2f9cPNWGlhwqtHWd1g==";
//
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$output = curl_exec($ch);
//curl_close($ch);
//$api_values = json_decode($output, true);
//
// for ($i = 0; $i < count($api_values); $i++) {
//     
//     
//     $o1->bankID = $api_values[$i]['bank_ID'];
//     $o1->bank_name = $api_values[$i]['bank_Name'];
//     $o1->ifsC_Code = $api_values[$i]['ifsC_Code'];
//     $o1->status = "Active";
//     $o1->is_active = "1";
//     $o1 = $insertor->insert_object($o1, "dezire_bank");
//     unset($o1);
//     
// }
//for statte
////$url = "http://uat-api.deziremoney.com/api/DMR/StateList?key=FTyG2f9cPNWGlhwqtHWd1g==";
//
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$output = curl_exec($ch);
//curl_close($ch);
//$api_values = json_decode($output, true);
//
//
// for ($i = 0; $i < count($api_values); $i++) {
//     
//     
//     $o1->state_name = $api_values[$i]['state_Name'];
//     $o1->state_ID = $api_values[$i]['state_Id'];
//     $o1->is_active = "1";
//     $o1 = $insertor->insert_object($o1, "dezire_state");
//     unset($o1);
//     
// }
//Addressproof
//$url = "http://uat-api.deziremoney.com/api/DMR/AddressProofList?key=FTyG2f9cPNWGlhwqtHWd1g==";
//
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$output = curl_exec($ch);
//curl_close($ch);
//$api_values = json_decode($output, true);
//pt($api_values);
////
////
// for ($i = 0; $i < count($api_values); $i++) {
////     
////     
//   $o1->proof_id = $api_values[$i]['addressProof_ID'];
//     $o1->proof_name = $api_values[$i]['addressProof_Name'];
//     $o1->proof_type = "Address Proof";
//     $o1->is_active = "1";
//     $o1 = $insertor->insert_object($o1, "dezire_proof");
//     unset($o1);
////     
// }
// IdProof
//$url = "http://uat-api.deziremoney.com/api/DMR/IDProofList?key=FTyG2f9cPNWGlhwqtHWd1g==";
//
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$output = curl_exec($ch);
//curl_close($ch);
//$api_values = json_decode($output, true);
//pt($api_values);
////die();
////
////
// for ($i = 0; $i < count($api_values); $i++) {
////     
////     
//   $o1->proof_id = $api_values[$i]['id'];
//     $o1->proof_name = $api_values[$i]['proof_Name'];
//     $o1->proof_type = "ID Proof";
//     $o1->is_active = "1";
//     $o1 = $insertor->insert_object($o1, "dezire_proof");
//     unset($o1);
////     
 //}
?>