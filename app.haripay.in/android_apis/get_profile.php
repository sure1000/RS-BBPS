<?php
include "include.php";
if (isset($o->user_id )) {
    $o = $factory->get_object($o->user_id, "users", "user_id");

if ($o->is_active == "1") {

  $sql = "Select * from kyc where user_id = '" . $o->user_id . "' and is_active ='0'";
  $res = getXbyY($sql);
  $rows = count($res);
if($rows > 0){
	 $result['user'] =$o;
        $result['kyc'] = $res[0];
        $result['error'] = "0";
        $result['error_msg'] = "User Details";
    }else{
    	 $result['user'] = $o;
        $result['kyc'] = "No Data Found";
        $result['error'] = "0";
        $result['error_msg'] = "User Details";
    }
       



} else {
        $result['error'] = "1";
        $result['error_msg'] = "User Blocked";
    }


	} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}


echo json_encode($result);

?>