<?php
session_start();
include 'include.php';
$ajax_logout = 1;
include 'session.php';
if ($_POST['updte'] == 1) {
	$o1 = $o;
	$o1->name = $_POST['name'];
	$o1->email = $_POST['email'];
	$o1->mobile = $_POST['mobile'];
	// $o1->mobile_1 = $_POST['mobile_1'];
	$o1->user_address = $_POST['user_address'];
	$o1->district = $_POST['district'];
	$o1->state = $_POST['state'];
	// $o1->dob = $_POST['dob'];
	$o1->company_name = $_POST['company_name'];
	// $o1->company_type = $_POST['company_type'];
	$o1->gst_no = $_POST['gst_no'];
	$o1->pancard = $_POST['pancard'];
	$o1->adhaar_card = $_POST['adhaar_card'];
	$o1->pincode = $_POST['pincode'];
	
	$sql="select * from users where user_id != '".$o->user_id."' and(mobile= '".$o1->mobile."' or email ='".$o1->email."')";
	$res=getXbyY($sql);
	$row=count($res);
	
if ($row > 0){
$result['error'] = 1;
$result['error_msg'] = "Mobile / Email is already exist";
}else{
	
	if ($_FILES['profile_pic']['name'] != "") {
		$file_extension = explode(".", $_FILES['profile_pic']['name']);
		if (strtolower(end($file_extension)) == "jpeg" || strtolower(end($file_extension)) == "jpg" || strtolower(end($file_extension)) == "png") {
			if ($o1->profile_pic != "") {
				unlink("profile_picture/".$o->profile_pic);
				unlink("profile_picture/thumbs/".$o->profile_pic);
			}

			$tmpfile = $_FILES['profile_pic']['tmp_name'];
			$source = "profile_picture/";
            
			$destination = $o1->user_id . "_" . time() . "." . end($file_extension);

			$thumbnail = 1;
			$newsize = "100";
			$watermark = "";

			uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

			$o1->profile_pic = $destination;
		}

	}

	$o1->user_id = $updater->update_object($o1, "users");
	$result['error'] = 0;
	$result['error_msg'] = "Imformation Updated successfully";
}
	if ($o1->profile_pic != "") {
		$result['profile_pic'] = "<img src='profile_picture/thumbs/" . $o1->profile_pic . "' />";
	} else {
		$result['profile_pic'] = "";
	}

} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something Went Wrong Please try again";

}

echo json_encode($result);
?>
