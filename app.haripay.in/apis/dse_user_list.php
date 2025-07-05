<?php

include "include.php";
if (isset($_POST)) {
    if ($_POST['user_id'] > 0) {
  if($o->user_type == "DSE"){
        $sql = "Select * from users where parent_id ='" . $o->parent_id . "' and user_type='Retailer' and is_active = '1'";
  }else{
      $sql = "Select * from users where parent_id ='" . $_POST['user_id'] . "' and user_type='" . $_POST['user_type'] . "' and is_active = '1' ";
  }
        $res = getXbyY($sql);
        $row = count($res);

        if ($row > 0) {
            $result['user_list'] = $res;
            $result['error'] = '0';
            $result['error_msg'] = 'Data Fetch';
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "No User Found";
        }
    } else {

        $result['error'] = "1";
        $result['error_msg'] = "Something Went Wrong";
    }

    echo json_encode($result);
}
?>