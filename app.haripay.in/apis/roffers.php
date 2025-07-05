<?php
include "include.php";

if ($_POST) {
    
    $mobile = $_POST['mobile'];
    $provider_id = $_POST['provider'];
    $service = $_POST['service'];
  
   // $o3 = $factory->get_object("9", "api", "api_id");
   
    $o3 = $factory->get_object("3", "api", "api_id");

    $provider = get_provider_name($provider_id);
    $provider_api_code = get_api_provider_code($provider_id,$o3->api_name);
    $offers = plan_api_roffers($provider_api_code, $mobile, $service);
	//pt($offers);die;
    if($offers->records){
         $total_offers = count($offers->records);
         if($total_offers > 0){
     
          $result['error'] = "0";
           $result['error_msg'] = "Offers Fetched";
           $sstring = "<table class='table table-bordered table-striped' width='100%' padding='4' style='padding:10px;text-align: initial;'>
                <tr>
                <th width='70%'>Description</th>
                <th width='20%'>Price</th>
                </tr>";
         for ($i = 0; $i < $total_offers; $i++) {
          $amount = explode('.', $offers->records[$i]->rs);
              $sstring .= "<tr>"
                        . "<td><a href='javascript:;' class='offer_amount' data-amount='".$amount[0]."'>" .$offers->records[$i]->desc . "</a></td>"
                        . "<td><i class='fa fa-rupee-sign'></i> <a href='javascript:;' class='offer_amount' data-amount='".$amount[0]."'>" .$amount[0] . "</a></td>"
                        . "</tr>";
         }
          $sstring .= "</table>";

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