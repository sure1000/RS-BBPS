<?php

session_start();
include "include.php";
include "session.php";

if (isset($_GET['api_id'])) {
    $o1->api_id = $_GET['api_id'];
} else {
    $o1->api_id = 0;
}

if ($o1->api_id > 0) {
    $o1 = $factory->get_object($o1->api_id, "api", "api_id");
} else {
    header("location:apis.php?msgid=4");
}

$service_id = 0;
$service_name = "";
$trigger_service = "1=1";

if($updte > 0){
    
    if($updte == 3 || $updte == 1){
       
        $total_providers = $_POST['total_providers'];
        
        for($i=0;$i<$total_providers;$i++){
            
            
            
            $pid = "circle_id_".$i;
            $apid = "api_circle_code_".$i;
            
            $o2->api_circle_code_id = $_POST[$apid];
            $o2->api_id = $o1->api_id;
            $o2->api_name = $o1->api_name;
            $o2->service_circle_id = $_POST[$pid];
            $o2->circle_name = get_circle_name($o2->service_circle_id);
            
            $pcid = "circle_code_".$o2->service_circle_id;
            $o2->circle_code = $_POST[$pcid];
            $o2->is_active = 1;
            
            
            if($o2->api_circle_code_id == 0){
                $o2->api_circle_code_id = $insertor->insert_object($o2, "api_circle_code");
            }else{
                $o2->api_circle_code_id = $updater->update_object($o2, "api_circle_code");
            }
            
            unset($o2);
            $o2 = new stdClass();
            
        }
        
        unset($_POST);
        $msg_id = 3;
        //header("location:")
        
        
    }
    
}
$sql = "Select * from service_circles where is_active = 1 and $trigger_service order by circle_name ";
$res = getXbyY($sql);
$rows = count($res);

$sql_providers = "Select * from api_circle_code where api_id = " . $o1->api_id . " and is_active = 1";
$res_providers = getXbyY($sql_providers);
$row_providers = count($res_providers);

for ($i = 0; $i < $rows; $i++) {
    $res[$i]['api_circle__code_id'] = 0;
    $res[$i]['circle_code'] = "";
    for ($j = 0; $j < $row_providers; $j++) {
        if ($res[$i]['service_circle_id'] == $res_providers[$j]['service_circle_id']) {
            $res[$i]['api_circle_code_id'] = $res_providers[$j]['api_circle_code_id'];
            $res[$i]['circle_code'] = $res_providers[$j]['circle_code'];
        }
    }
}




include "html/includes/header.php";
include "html/api_circle_code.php";
include "html/includes/footer.php";
include "js/api_provider_code.js";
?>


