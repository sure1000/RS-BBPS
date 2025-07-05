<?php

session_start();

include "include.php";
include "session.php";



if ($_POST['state'] != "All") {
    $state = $_POST['state'];
} 
if($_POST['service_id'] > 0){
    $service_id = $_POST['service_id'];
}
if ($_POST['update'] == 1) {
if($_POST['state'] =="All"){
 $sql = "Select * from providers where service_id ='".$service_id."'and  is_active = 1";
}else{
     $sql = "Select * from providers where state = '" . $state . "' and service_id ='".$service_id."'and  is_active = 1";
      // $_SESSION['elec_provider_state'] =$state;

}
   
    $res = getXbyY($sql);
    $rows = count($res);
if($rows > 0){
 
    $sstring = '<label><i class="fa fa-globe"></i> Service Provider</label> <select name="electricity_circle" id="electricity_circle" onchange=\'Elec_provider_info(this.value,"Electricity")\' class="select2_single  form-control"><option value="" selected = "selected">Select Service Provider</option>';
    for ($i = 0; $i < $rows; $i++) {

        $sstring .= "<option value='" . $res[$i]['provider_id'] . "' >" . $res[$i]['provider'] . "</option>";
    }
    $sstring .= '</select>';
}else{
    $sstring .='<span style=" color:red;">Provider not Available</span>';
}
    $result['state'] =$state;
    $result['provider'] = $sstring;
}

echo json_encode($result);
?>

