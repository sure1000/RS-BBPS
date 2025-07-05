<?php
session_start();

include "include.php";
include "session.php";

$sql = "Select * from benner_set order by banner_pic";
$res = getXbyY($sql);
$rows = count($res);

//unset($_SESSION['search']);
if($_GET['aid_delete']!=""){
    $aid_delete = $_GET['aid_delete'];
   $sql = "DELETE FROM `benner_set` WHERE `benner_set`.`benner_set_id` = '$aid_delete'";
   //pt($sql);die;
$res = setXbyY($sql); 
   header('Location: banner_setting'); 
}
if($_GET['aid_status']!=""){
    $aid_status = $_GET['aid_status'];
    $sql = "SELECT is_active FROM benner_set WHERE benner_set_id = '$aid_status'";
    $res = getXbyY($sql);
    if($res[0]['is_active']==0){
      $aid_status_a ="1";
    }else{
        $aid_status_a ="0";
    }
    $sql = "UPDATE benner_set SET is_active= '$aid_status_a' WHERE benner_set_id = '$aid_status'";
    $res = setXbyY($sql); 
   //pt($res[0]);die;
  header('Location: banner_setting'); 
}
if($_POST['submit']=="Submit"){
  // pt($_POST); 
    

   $image=$_FILES['banner_pic']['name']; 
     $imageArr=explode('.',$image); //first index is file name and second index file type
     $rand=rand(10000,99999);
     $newImageName=$imageArr[0].$rand.'.'.$imageArr[1];
     $uploadPath="../banner_pic/".$newImageName;
     $isUploaded=move_uploaded_file($_FILES["banner_pic"]["tmp_name"],$uploadPath);
     
    $o1->update_pic = 1;
    $o1->is_active = $_POST['is_active'];
    $o1->banner_pic = $newImageName;
    //pt($o1);die;
    $insertor->insert_object($o1,"benner_set");
    
   header('Location: banner_setting');
}
include "html/includes/header.php";
include "html/banner_setting.php";
include "html/includes/footer.php";
//include "js/all_transaction_history.js";

?>