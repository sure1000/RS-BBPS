<?php
session_start();
include 'include.php';
include "session.php";


if($_POST)
    {
    $sql_check= "select * from site_info where ( site_name ='".$_POST['website']."' OR site_url='".$_POST['web_url']."') ";
    $res_check= getXbyY($sql_check);
    $row_check= count($res_check);

    if($row_check > 0 && !$_POST['aid'])
        {
        $result['error']=0;
        $result['error_msg']="website, Web URL already exits.";
    }
    else {
        
    $o1->site_name = $_POST['website'];
    $o1->site_url = $_POST['web_url'];
    $o1->mobile = $_POST['mobile'];
    $o1->email = $_POST['email'];
    $o1->loction = $_POST['address'];
    //$o1->logo = $_POST['logo'];
    //$o1->app_link = $_POST['app_link'];
    $o1->created_at = todaysDate();
    $o1->is_active = $_POST['is_active'];

    if ($_FILES['logo']['name'] != "") {
    	$tmpfile = $_FILES['logo']['tmp_name'];
		$source = "../img/";
		$file_extension = explode(".", $_FILES['logo']['name']);
		$destination = date('YmdHis')."_logo." . end($file_extension);
		$thumbnail = 0;
		$newsize = "0";
		$watermark = "";
		uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);
		$o1->logo = $destination;
    }
    
    if($_FILES['app_link']['name'] != "") {
    	$tmpfile = $_FILES['app_link']['tmp_name'];
		$source = "../img/";
		$file_extension = explode(".", $_FILES['app_link']['name']);
		$destination = date('YmdHis') . "_app_link." . end($file_extension);
		$thumbnail = 0;
		$newsize = "0";
		$watermark = "";
		uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);
		$o1->app_link = $destination;
    }
    if($_POST['aid']){
     $o1->site_info_id = $_POST['aid'];
     $updater->update_object($o1, "site_info");
    } else    $insertor->insert_object($o1,"site_info");
     $result['error']= 1;
     $result['error_msg']="User Added successfully.";
    
}

}

 header('location:site_list.php');
//  echo json_encode($result);
  ?>
