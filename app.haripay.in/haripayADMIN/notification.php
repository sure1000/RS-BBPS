<?php

session_start();

include "include.php";
include "session.php";
$tables = 1;
function total_read($id){

    $sql_t= "select count(is_read) as total from notifications where user_id = '" .$id ."' ";
    $res_t = getXbyY($sql_t);
   
    if ($res_t[0]['total'] > 0) {
        $show = $res_t[0]['total'];

    }else{
    	 $show ='0';
    }
    return $show;
}
function read($yes){
    $sql_re= "select count(is_read) as total from notifications where user_id = '" .$yes ."'  and is_read ='yes'";
    $res_re = getXbyY($sql_re);
    if ($res_re[0]['total'] > 0) {
        $show = $res_re[0]['total'];

    }else{
    	 $show ='0';
    }
return $show;
}
function un_read($no){
     $sql_ur= "select count(is_read) as total from notifications where user_id = '" .$no ."' and is_read ='no'";
    $res_ur = getXbyY($sql_ur);
    if ($res_ur[0]['total'] > 0) {
        $show = $res_ur[0]['total'];

    }else{
    	 $show ='0';
    }
return $show;
}



$tables = 1;

// $sql = "Select * from notifications group by user_id left join";
$sql ="Select A.*,B.*  from notifications as A left join users as B on (A.user_id = B.user_id)  group by A.user_id";
$res = getXbyY($sql);
$rows = count($res);


include "html/includes/header.php";
include "html/notificiation.php";
include "html/includes/footer.php";
?>