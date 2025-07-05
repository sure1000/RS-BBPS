<?php
session_start();

include "include.php";
include "session.php";

if (isset($_POST['kyc_updte'])) {
	$updte = $_POST['kyc_updte'];
} else {
	$updte = 0;
}

if ($updte == 1) {
	$o2->user_id = $o->user_id;
	$o2->document_type = "pancard";
	$o2->upload_date = todaysDate();
	$o2->is_active = $_POST['is_active'];

	if ($_FILES['pan_file']['name'] != "") {

		$tmpfile = $_FILES['pan_file']['tmp_name'];
		$source = "./user_documents/";
		$file_extension = explode(".", $_FILES['pan_file']['name']);
		$destination = $o->user_id . "_" . $o2->document_type . "." . end($file_extension);
		$thumbnail = 0;
		$newsize = "100";
		$watermark = "";

		uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

		$o2->document_name = $destination;
		$o2->kyc_id = $insertor->insert_object($o2, "kyc");

		if ($o->kyc_id == 0 && $o2->is_active == 1) {
			$o->kyc_id = $o2->kyc_id;
			$o->pancard = $_POST['reg_pan_no'];
			$o->user_id = $updater->update_object($o, "users");
		}
		unset($o2->kyc_id);

	}

	$o2->document_type = $_POST['kyc_doc'];

	if ($_FILES['kyc_file']['name'] != "") {

		$tmpfile = $_FILES['kyc_file']['tmp_name'];
		$source = "./user_documents/";
		$file_extension = explode(".", $_FILES['kyc_file']['name']);
		$destination = $o->user_id . "_" . $o2->document_type . "." . end($file_extension);
		$thumbnail = 0;
		$newsize = "100";
		$watermark = "";

		uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

		$o2->document_name = $destination;
		$o2->kyc_id = $insertor->insert_object($o2, "kyc");

		unset($o2->kyc_id);

	}

	header("location:index.php?msgid=3");
} else {
	header("location:index.php?msgid=5");
}
?>