<?php
session_start();

include "include.php";
include "session.php";

	$sql = "select * from users where user_type ='Retailer' ";
	$res = getXbyY($sql);
	$row = count($res);
    if($row > 0){
      for($i=0;$i< $row;$i++){
       $o1->user_id =$res[$i]['user_id'];
       $o1->postpaid_service ='Yes';
       $o1->prepaid_service ='Yes';
       $o1->landline_service ='Yes';
       $o1->dth_service ='Yes';
       $o1->electricity_service ='Yes';
       $o1->dmr_serivce ='Yes';
       $o1->other ="";
       $o1->created_on =todaysDate();
      $o1->is_active =1;
      $o1->userService_id = $insertor->insert_object($o1,"userServices");

      }
   

    }
  
   

?>
