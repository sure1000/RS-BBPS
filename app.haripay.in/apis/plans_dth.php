<?php
include "include.php";
if ($_POST) {
    
    $operator = $_POST['operator'];
    $offers = dth_plans($operator);
	//pt($offers);
    if($offers['records']){
        $total_offers = count($offers['records']);
         if($total_offers > 0){
     
          $result['error'] = "0";
           $result['error_msg'] = "Offers Fetched";
           $sstring = "<table class='table table-bordered table-striped' width='100%' padding='4' style='padding:10px;text-align: initial;'>
                <tr>
                <th width='60%'>Description / Plan Name</th>
                <th width='10%'>Price</th>
                <th width='20%'>Validity</th>
                </tr>";
		 if($offers['records']['Plan'])
		 {			 
         foreach($offers['records']['Plan'] as $k=>$v) {
			foreach($v['rs'] as $key=>$val){
				$amount = ceil($val);
				$validity = $key;
			} 	
              $sstring .= "<tr>"
                        . "<td><a href='javascript:;' class='offer_amount' data-amount='".$amount."'>" .$v['desc'] .'<br>'.$v['plan_name']. "</a></td>"
                        . "<td><i class='fa fa-rupee-sign'></i> <a href='javascript:;' class='offer_amount' data-amount='".$amount."'>" .$amount. "</a></td>"
                        . "<td><a href='javascript:;' class='offer_amount' data-amount='".$amount."'>".$validity ."</a></td>"
                        . "</tr>";
         } 
		 } else if($offers['records']['desc']) {
			 $sstring .= "<tr>"
                        . "<td colspan='4'><b>".$offers['records']['desc']."</b></td>"
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