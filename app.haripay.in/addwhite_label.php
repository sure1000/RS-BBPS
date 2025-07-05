
<?php
session_start();
include 'include.php';


if($updte==1)
    {
    $sql_check= "select * from white_label where ( website ='".$_POST['website']."' OR web_url='".$_POST['web_url']."') ";
    $res_check= getXbyY($sql_check);
    $row_check= count($res_check);
    
    if($row_check > 0)
        {
        $result['error']=0;
        $result['error_msg']="website, Web URL already exits.";
    }
    else {
    $o1->website = $_POST['website'];
    $o1->web_url = $_POST['web_url'];
    $o1->color = $_POST['color'];
    $o1->address = $_POST['address'];
    $o1->email = $_POST['email'];
    $o1->mobile = $_POST['mobile'];
    $o1->created_at = todaysDate();
    $o1->user_id = $_SESSION['w_id'];
    $o1->white_label_user_id = $_SESSION['user_id']
    $o1->is_active = $_POST['is_active'];
    if (user_id > 0){
        $o1->white_label_user_id = $updator->update_object($o1,"white_label");
    }
    $o1->white_label_user_id = $insertor->insert_object($o1,"white_label");
     $result['error']= 1;
     $result['error_msg']="User Added successfully.";
}
}

  echo json_encode($result);
  ?>
