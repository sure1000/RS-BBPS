<?php

include "include.php";



if ($o->user_id > 0) {
    $sql = "SELECT * FROM site_info WHERE site_url='".$_SERVER['SERVER_NAME']."' and is_active=1";
    $res = getXbyY($sql);
    $rows = count($res);
	///
	$result['mobile'] = $res[0]['mobile'];
	$result['email'] = $res[0]['email'];
	$result['website'] = $res[0]['site_url'];
	$result['address'] = $res[0]['loction'];
	$result['whatsapp'] = $res[0]['mobile'];
}else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>