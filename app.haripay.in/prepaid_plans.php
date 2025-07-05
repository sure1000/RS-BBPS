<?php 
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if($updte == 1){
    
    $provider = ucfirst($_POST['provider']);
    $plan = $_POST['plan'];
    $circle = $_POST['circle'];
    $service = ucfirst($_POST['service']);
    
    /*if($plan == ""){
        $plan = "Combo";
    }
    if($circle == ""){
        $circle = "Rajasthan";
    }
    if($provider == ""){
        $provider = "1";
    }
    if($service == ""){
        $service = "Prepaid";
    }*/
    
    $provider = get_provider_name($provider);
    
    
    $sql = "Select * from provider_plans where service_type = '".$service."' and operator = '".$provider."' and circle = '".$circle."' and plan_type = '".$plan."' and is_active = 1";
    $res = getXbyY($sql);
    $rows = count($res);
    
    $sstring = "<table class='table table-bordered table-striped' width='100%' padding='4' style='padding:10px;'>
        <tr>
        <th width='75%'>Description</th>
        <th width='15%'>Validity</th>
        <th width='10%'>Price</th>
        </tr>";
    
    if($rows > 0){
        for($i=0;$i<$rows;$i++){
            $sstring.="<tr onclick=select_plan('".strtolower($service)."','".$res[$i]['price']."')>"
                    . "<td>".$res[$i]['details']."</td>"
                    . "<td>".$res[$i]['validity']."</td>"
                    . "<td><i class='fa fa-rupee-sign'></i> ".$res[$i]['price']."</td>"
                    . "</tr>";
        }
    }else{
        $sstring.="<tr><td colspan='3'>No Plans Available</td></tr>";
    }
    $sstring.="</table>";
    
    $result['plans'] = $sstring;
    $result['error'] = 0;
    $result['error_msg'] = "Plans Found";
    
}

echo json_encode($result);

?>