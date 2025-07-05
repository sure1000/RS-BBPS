<?php

include "include.php";

if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {
        
        $result['amount_balance'] = (string)$o->amount_balance;
        $result['company_name'] = (string)$o->company_name;
        $result['dmr_balance'] = (string)$o->dmr_balance;
        $result['aeps_balance'] = (string)$o->aeps_balance;
        $result['mobile'] = (string)$o->mobile;
        $result['email'] = (string)$o->email;
        $result['force_logout'] = (string)$o->force_logout;
        $result['name'] = (string)$o->name;
        $result['user_type'] = (string)$o->user_type;
        $result['outlet_status'] = (string)$o->outlet_status;
        
        
	if ($o->profile_pic == "" || $o->profile_pic == '0') {
		$my_profile_pic =  "" . $_SERVER['HTTP_HOST'] . "/img/avatar.svg";
	} else {
		$my_profile_pic =  "" . $_SERVER['HTTP_HOST'] . "/profile_picture/thumbs/" . $o->profile_pic;
	}
        $sql = "Select count(notification_id) as notifications from notifications where user_id = ".$o->user_id." and is_active = 1 and is_read = 'No'";
        $res = getXbyY($sql);
    
        $result['notifications'] = (string)$res[0]['notifications'];
        $result['my_profile_pic'] = $my_profile_pic;
        
        $sql = "Select notice_details from notice_board where is_active = 1 LIMIT 1";
        $res = getXbyY($sql);
        
        $result['error'] = "0";
        $result['welcome'] =  (string)$res[0]['notice_details'];
        $result['error_msg'] = "Fetch User Info";
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
