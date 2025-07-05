<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {
    
    $mobile = $_POST['mobile'];
    $provider_id = $_POST['provider'];
    $service = $_POST['service'];
  
   // $o3 = $factory->get_object("9", "api", "api_id");
   
    $o3 = $factory->get_object("4", "api", "api_id");

    $provider = get_provider_name($provider_id);
    
    $provider_api_code = get_api_provider_code($provider_id,$o3->api_name);
   //pt($provider_api_code);die;
    $offers = mplan_roffers($provider_api_code, $mobile, $service);
   // $offers = recharge_plan_roffers($provider_api_code, $mobile, $service);
   // $offers = plan_api_roffers($provider_api_code, $mobile, $service);
    
    // if($offers->ERROR == "0"){
    //      $total_offers = count($offers->RDATA);
    //      if($total_offers > 0){
     
    //       $result['error'] = "0";
    //       $result['error_msg'] = "Offers Fetched";
    //       $sstring = "<table class='table table-bordered table-striped' width='100%' padding='4' style='padding:10px;'>
    //             <tr>
    //             <th width='80%'>Description</th>
    //             <th width='10%'>Validity</th>
    //             <th width='10%'>Price</th>
    //             </tr>";
    //      for ($i = 0; $i < $total_offers; $i++) {
    //       $amount = explode('.', $offers->RDATA[$i]->price);
    //           $sstring .= "<tr onclick=select_plan('prepaid','" .$amount[0] . "')>"
    //                     . "<td>" .$offers->RDATA[$i]->ofrtext . "</td>"
    //                     . "<td>-</td>"
    //                     . "<td><i class='fa fa-rupee-sign'></i> " .$amount[0] . "</td>"
    //                     . "</tr>";
    //      }
    //       $sstring .= "</table>";

    //  }else{
    //      $result['error'] = "1";
    //  }
        
    // }else{
    //      $result['error'] = "1";
    // }
  //  pt($offers);die;
  //  pt($offers['records']);
    $total_offers = count($offers->records);
    
  if($total_offers > 0){
    
         $result['error'] = "0";
          $result['error_msg'] = "Offers Fetched";
          $sstring = "<table class='table table-bordered table-striped' width='100%' padding='4' style='padding:10px;'>
                <tr>
                <th width='80%'>Description</th>
                <th width='10%'>Validity</th>
                <th width='10%'>Price</th>
                </tr>";
        for ($i = 0; $i < $total_offers; $i++) {
             $sstring .= "<tr onclick=select_plan('prepaid','" .$offers->records[$i]->rs . "')>"
                        . "<td>" .$offers->records[$i]->desc . "</td>"
                        . "<td>-</td>"
                        . "<td><i class='fa fa-rupee-sign'></i> " .$offers->records[$i]->rs . "</td>"
                        . "</tr>";
        }
         $sstring .= "</table>";

    }else{
        $result['error'] = "1";
    }
     
    
      
$result['plans'] = $sstring;
}


echo json_encode($result);
?>