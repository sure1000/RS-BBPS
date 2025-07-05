<?php
include "include.php";
if ($_POST) {
    
    $operator = $_POST['operator'];
    $cricle = $_POST['circle'];
    $offers = plans_api($operator, $cricle);
	
    if($offers['records']){
        $total_offers = count($offers['records']);
         if($total_offers > 0){
     
          $result['error'] = "0";
           $result['error_msg'] = "Offers Fetched";
           $sstring = "<table class='table table-bordered table-striped' width='100%' padding='4' style='padding:10px;text-align: initial;'>
                <tr>
                <th width='60%'>Description</th>
                <th width='10%'>Price</th>
                <th width='20%'>Validity</th>
                </tr>";
         foreach($offers['records'] as $k=>$v) {
			 $sstring .= "<tr>"
                        . "<td colspan='3' style='color:green;'><b>".$k."</b></td>"
                        . "</tr>";
         foreach($v as $value) {
          $amount = $value['rs'];
              $sstring .= "<tr>"
                        . "<td><a href='javascript:;' class='offer_amount' data-amount='".$amount."'>" .$value['desc'] . "</a></td>"
                        . "<td><i class='fa fa-rupee-sign'></i> <a href='javascript:;' class='offer_amount' data-amount='".$amount."'>" .$amount . "</a></td>"
                        . "<td><a href='javascript:;' class='offer_amount' data-amount='".$amount."'>".$value['validity'] ."</a></td>"
                        . "</tr>";
         }
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