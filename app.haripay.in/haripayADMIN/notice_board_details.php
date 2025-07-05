<?php

session_start();

include "include.php";
include "session.php";
if($_GET['aid_delete']!=""){
    $aid_delete = $_GET['aid_delete'];
   $sql = "DELETE FROM `notice_board` WHERE `notice_board`.`notice_board_id` = '$aid_delete'";
   //pt($sql);die;
$res = setXbyY($sql); 
   header('Location: notice_board'); 
}
if (isset($_GET['aid'])) {
	$o1->notice_board_id = $_GET['aid'];
} else {
	$o1->notice_board_id = 0;
}

if ($o1->notice_board_id > 0) {
	$o1 = $factory->get_object($o1->notice_board_id, "notice_board", "notice_board_id");
} else {
	$o1->is_active = 1;
	$o1->notice_date = todaysDate();
}

if ($updte == 1) {
	$o1->user_id = $o->user_id;
	$o1->notice_type = $_POST['notice_type'];
	$o1->notice_details = $_POST['notice_details'];
	$o1->notice_date = todaysDate();
	$o1->is_active = $_POST['is_active'];

	if ($o1->is_active == 1) {
		$sql_active = "Update notice_board set is_active = 0";
		$set_active = setXbyY($sql_active);
	}

	if ($o1->notice_board_id > 0) {
		$o1->notice_board_id = $updater->update_object($o1, "notice_board");
	} else {
		$o1->notice_board_id = $insertor->insert_object($o1, "notice_board");
	}

	if ($_FILES['notice_file']['name'] != "") {
		if ($o1->notice_file != "") {
			$img_link = "../notice_board/" . $o1->notice_file;
			unlink($img_link);
		}

		$tmpfile = $_FILES['notice_file']['tmp_name'];
		$source = "../notice_board/";
		$file_extension = explode(".", $_FILES['notice_file']['name']);
		$destination = $o1->notice_board_id . "_img." . end($file_extension);
		$thumbnail = 0;
		$newsize = "0";
		$watermark = "";

		uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

		$o1->notice_file = $destination;
		$o1->notice_board_id = $updater->update_object($o1, "notice_board");
	}

	header("location:notice_board.php?msgid=3");
}

include "html/includes/header.php";
include "html/notice_board_details.php";
include "html/includes/footer.php";
?>