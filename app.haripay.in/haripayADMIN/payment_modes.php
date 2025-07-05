<?php

session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->payment_mode_id = $_GET['aid'];
} else {
	$o1->payment_mode_id = 0;
}

if ($o1->payment_mode_id > 0) {
	$o1 = $factory->get_object($o1->payment_mode_id, "payment_mode", "payment_mode_id");
} else {
	$o1->is_active = 1;
}

if ($updte == 1) {
	$o1->payment_mode = $_POST['payment_mode'];
	$o1->account_name = $_POST['account_name'];
	$o1->account_number = $_POST['account_number'];
	$o1->ifsc_code = $_POST['ifsc_code'];
	$o1->is_active = $_POST['is_active'];

	if ($o1->payment_mode_id > 0) {
		$o1->payment_mode_id = $updater->update_object($o1, "payment_mode");
	} else {
		$o1->payment_mode_id = $insertor->insert_object($o1, "payment_mode");
	}

	if ($_FILES['logo']['name'] != "") {
		$file_extension = explode(".", $_FILES['logo']['name']);

		if (end($file_extension) == "png" || end($file_extension) == "jpg" || end($file_extension) == "jpeg") {
			if ($o1->logo != "") {
				$img_link = "../provider_logos/" . $o1->logo;
				$img_thumb_link = "../provider_logos/thumbs/" . $o1->logo;
				unlink($img_link);
				unlink($img_thumb_link);
			}

			$tmpfile = $_FILES['logo']['tmp_name'];
			$source = "../provider_logos/";

			$destination = $o1->payment_mode . "_" . $o1->account_name . "." . end($file_extension);
			$thumbnail = 1;
			$newsize = "100";
			$watermark = "";

			uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

			$o1->logo = $destination;
			$o1->payment_mode_id = $updater->update_object($o1, "payment_mode");
		}
	}

	header("location:payment_options.php?msgid=3");
}

include "html/includes/header.php";
include "html/payment_modes.php";
include "html/includes/footer.php";
?>