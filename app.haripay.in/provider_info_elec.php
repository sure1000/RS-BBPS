<?php 
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if($updte == 1){
    $o3->provider_id = $_POST['provider_id'];
   
    if($o3->provider_id == "" || $o3->provider_id == "0"){
        $result['error'] = 1;
        $result['error_msg'] = "Something went wrong. Please try again";
    }else{
        $o1 = $factory->get_object($o3->provider_id,"providers", "provider_id");
        $sql_pr ="Select * from providers where provider_id ='".$o1->provider_id."' and api_id ='4' and is_active='1'";
        $res_pr=getXbyY($sql_pr);
        $row_pr =count($res_pr);

        if($row_pr > 0){
           
           
         $result['error'] = 0;
        
        if($o1->logo == ""){
            $result['logo'] = "<img src='img/logo.png' width='100' class='img-rounded' />";
        }else{
            $result['logo'] = "<img src='provider_logos/thumbs/".$o1->logo."' width='100' class='img-rounded' />";
        }

       
      
        }else{
             $result['error_msg'] = "Operator Down.Please try later.";
            $result['err_code'] = "2";
        }
       
    
       
        // if($o1->is_active == "0"){
        //     $result['error_msg'] = "Operator Down.Please try later.";
        //     $result['err_code'] = "2";
        // }
        

    }
}

echo json_encode($result);

?>