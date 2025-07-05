<?php

include "include.php";
if (isset($o->user_id)) {
    $o = $factory->get_object($o->user_id, "users", "user_id");

	$o1 = $o;
	$o1->name = $_POST['name'];
	$o1->email = $o->email;
	$o1->mobile = $o->mobile;
	$o1->mobile_1 = $o->mobile_1;
	$o1->user_address = $_POST['user_address'];
	$o1->company_name = $o->company_name;
	$o1->gst_no = $o->gst_no;
	$o1->pancard = $o->pancard;
	$o1->adhaar_card = $o->adhaar_card;

	if ($_FILES['profile_pic']['name'] != "") {
		$file_extension = explode(".", $_FILES['profile_pic']['name']);
		if (strtolower(end($file_extension)) == "jpeg" || strtolower(end($file_extension)) == "jpg" || strtolower(end($file_extension)) == "png") {
			if ($o1->profile_pic != "") {
				unlink("profile_picture/$o1->profile_pic");
				unlink("profile_picture/thumbs/$o1->profile_pic");
			}

			$tmpfile = $_FILES['profile_pic']['tmp_name'];
			$source = "./profile_picture/";

			$destination = $o1->user_id . "_" . time() . "." . end($file_extension);
			$thumbnail = 1;
			$newsize = "100";
			$watermark = "";

			uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

			$o1->profile_pic = $destination;
		}

	}

	$o1->user_id = $updater->update_object($o1, "users");
	$result['error'] = "0";
	$result['error_msg'] = "Information Updated successfully";
	if ($o1->profile_pic != "") {
		$result['profile_pic'] = "<img src='./profile_picture/thumbs/" . $o1->profile_pic . "' />";
	} else {
		$result['profile_pic'] = "";
	}

}else{

	$result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}



echo json_encode($result);

?>