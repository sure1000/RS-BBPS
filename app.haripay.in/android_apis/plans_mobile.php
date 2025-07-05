<?php
include "include.php";
if ($_POST) {
    
    $operator = $_POST['operator'];
    $cricle = $_POST['circle'];
    $provider_api_code = get_api_provider_code($operator,"EZYTM PLAN API");
    $sql = "Select circle_code from api_circle_code where  api_id='15' and circle_name = '" . $cricle."'";
    //pt($sql);die;
    $res = getXbyY($sql);
    //pt($res[0]['circle_code']);die;
    $cricle =$res[0]['circle_code'];
    //	pt($provider_api_code);die;
    $offers = plans_api_ezytm($provider_api_code, $cricle);
	//pt($offers);die;
    if($offers['RDATA']){
        $total_offers = count($offers['RDATA']);
         if($total_offers > 0){
     
          $result['error'] = "0";
           $result['error_msg'] = "Offers Fetched";
           $result['plan'] = $offers;

     }else{
         $result['error'] = "1";
     }
        
    }else{
         $result['error'] = "1";
    }
    
$result['plans'] = $sstring;
}


echo json_encode($result);
?>