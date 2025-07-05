<?php

include "include.php";
if (isset($o)) {
    
    $o = $factory->get_object($o->user_id, "users", "user_id");
    
    if ($o->is_active == "1") {
        $dd = explode(" ", todaysDate());
        $trigger_provider_type = "1=1";
        $trigger_provider_id = "1=1";
        $trigger_transaction_type = "(transaction_type = 'Recharge'  or transaction_type = 'Utility' or transaction_type = 'R Offer Check' or transaction_type = 'User Info Check')";
        $trigger_status = "1=1";
        $trigger_from_date = "1=1";
        $trigger_to_date = "1=1";
        $trigger_search_val = "1=1";
        $trigger_to_date1 = '1=1';
        $flag_date = "0";

$old_date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 5, date("y"))) . " " . ' 00:00:01';

if (isset($_POST['from_date'])) {
    $start_date = $_POST['from_date'] . " 00:00:00";
    $date_diff = (strtotime($old_date) - strtotime($start_date));
  
    if ($date_diff > 0) {
        $flag_date = "1";
    }
}
        if ($_POST['service_id'] > 0) {
            $provider_type = get_service_name($_POST['service_id']);
            $trigger_provider_type = "provider_type = '" . $provider_type . "'";
        }
        if ($_POST['provider_id'] > 0) {
            $trigger_provider_id = "provider_id = '" . $_POST['provider_id'] . "'";
        }
        if ($_POST['transaction_type']) {
            $trigger_transaction_type = "transaction_type = '" . $_POST['transaction_type'] . "'";
        }
        if ($_POST['status']) {
            $trigger_status = "status = '" . $_POST['status'] . "'";
        }
        if($flag_date == '0'){
          if ($_POST['from_date'] != "") {
            $trigger_from_date = "transaction_date >= '" . $_POST['from_date']  . " 00:00:00'";
        } else {
            $trigger_from_date = "transaction_date >= '" . $dd[0] . " 00:00:00'";
        }
        if ($_POST['to_date'] != "") {
            $trigger_to_date = "transaction_date <= '" . $_POST['to_date']  . " 23:59:58'";
        } else {
            $trigger_to_date = "transaction_date <= '" . $dd[0] . " 23:59:58' ";
        }  
    }else{
         if ($_POST['from_date'] != "") {
            $trigger_from_date = "transaction_date >= '" . $_POST['from_date']  . " 00:00:00'";
        }
         $today_dt = strtotime(date('d-m-Y'));
        $to_date = strtotime($_POST['to_date']);

        if ($today_dt == $to_date) {

            $trigger_to_date = 'transaction_date <= "' . date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("y"))) . " " . '23:59:59"';

            $trigger_to_date1 = "transaction_date >= '" . date('Y-m-d') . " 00:00:00'";
        } else if ($to_date < $today_dt) {

    if (isset($_POST['to_date'])) {
    $trigger_to_date = "transaction_date <= '" . $_POST['to_date'] . " 23:59:59'";
            }
        }
    }
        
        if ($_POST['search_val'] != "") {
            $trigger_search_val = "(mobile_number = '" . $_POST['search_val'] . "' or ref_number = '" . $_POST['search_val'] . "' or opid = '" . $_POST['search_val'] . "')";
        }


        $triggers = $trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_transaction_type . " and " . $trigger_status . " and " . $trigger_search_val;
       
         if($o->user_type == "Master Distributor"){
     $id_type = "parent_user_id";
 }else if($o->user_type == "Distributor"){
     $id_type = "parent_user_id";
 }else {
     $id_type = "user_id";
 }
if($flag_date == '0'){
$sql_total = "Select count(wallet_id) as total_transactions from wallet where   parent_id = 0 and   $id_type = " . $o->user_id . " and $triggers and $trigger_from_date and $trigger_to_date";
$sql_transactions = "Select * from wallet where  parent_id = 0 and $id_type = " . $o->user_id . " and $triggers and $trigger_from_date and $trigger_to_date order by wallet_id DESC ";
}else{
    if($trigger_to_date1 != '1=1'){
$sql_total1 = "Select count(wallet_id) as total_transactions from wallet where   parent_id = 0 and   $id_type = " . $o->user_id . " and $triggers and $trigger_to_date1";
$sql_transactions1 = "Select * from wallet where  parent_id = 0 and $id_type = " . $o->user_id . " and $triggers and $trigger_to_date1 order by wallet_id DESC ";
$res_total1 = getXbyY($sql_total1);
$res_transactions1 = getXbyY($sql_transactions1);
  $row_transactions1 = count($res_transactions1);
    }
	//wallet_backup
$sql_total = "Select count(wallet_id) as total_transactions from wallet where   parent_id = 0 and   $id_type = " . $o->user_id . " and $triggers and $trigger_from_date and $trigger_to_date";
$sql_transactions = "Select * from wallet where  parent_id = 0 and $id_type = " . $o->user_id . " and $triggers and $trigger_from_date and $trigger_to_date order by wallet_id DESC ";
}
        $res_total = getXbyY($sql_total);
        $res_transactions = getXbyY($sql_transactions);
      
if($o->user_type == 'Master Distributor'){
  if($flag_date == '1'){
    for($i=0 ;$i< count($res_transactions1);$i++){
    $res_transactions1[$i]['md_comm'] =get_commission_api($res_transactions1[$i]['wallet_id'], $res_transactions1[$i]['md_user_id'],'wallet');
  $res_transactions1[$i]['dt_comm']=get_commission_api($res_transactions1[$i]['wallet_id'], $res_transactions1[$i]['dt_user_id'],'wallet');
  }
  for($i=0 ;$i< count($res_transactions);$i++){
    $res_transactions[$i]['md_comm'] =get_commission_api($res_transactions[$i]['wallet_id'], $res_transactions[$i]['md_user_id'],'wallet'); //wallet_backup
    $res_transactions[$i]['dt_comm']=get_commission_api($res_transactions[$i]['wallet_id'], $res_transactions[$i]['dt_user_id'],'wallet'); //wallet_backup

  }
}else{
   for($i=0 ;$i< count($res_transactions);$i++){
    $res_transactions[$i]['md_comm'] =get_commission_api($res_transactions[$i]['wallet_id'], $res_transactions[$i]['md_user_id'],'wallet');
    $res_transactions[$i]['dt_comm']=get_commission_api($res_transactions[$i]['wallet_id'], $res_transactions[$i]['dt_user_id'],'wallet');

  }
}
  
  
}
if($o->user_type == 'Distributor'){
  if($flag_date == '1'){
for($i=0 ;$i< count($res_transactions1);$i++){
   
  $res_transactions1[$i]['dt_comm']=get_commission($res_transactions1[$i]['wallet_id'], $res_transactions1[$i]['dt_user_id'],'wallet');
  }
  for($i=0 ;$i< count($res_transactions);$i++){
    
    $res_transactions1[$i]['dt_comm']=get_commission($res_transactions[$i]['wallet_id'], $res_transactions[$i]['dt_user_id'],'wallet_backup');

  }
  }else{
      for($i=0 ;$i< count($res_transactions);$i++){
    
    $res_transactions[$i]['dt_comm']=get_commission($res_transactions[$i]['wallet_id'], $res_transactions[$i]['dt_user_id'],'wallet');

  }
  }
}

if($flag_date == '1'){
      $res_total[0]['total_transactions'] = $res_total[0]['total_transactions'] + $res_total1[0]['total_transactions'] ;
    for($n= 0 ; $n < count($res_transactions); $n++){
        $res_transactions1[$row_transactions1+$n] =$res_transactions[$n];

    }
   $res_transactions = $res_transactions1;
}
 $row_transactions = count($res_transactions);
        if ($row_transactions > 0) {

            for ($i = 0; $i < $row_transactions; $i++) {

                $slq_p = "Select provider_id ,logo from providers where provider_id   = '" . $res_transactions[$i]['provider_id'] . "' and is_active = '1' ";
                $res_p = getXbyY($slq_p);
                $rows_p = count($res_p);

                if ($rows_p == 1) {


                    $logo = $res_p[0]['logo'];
                }
        
    if($o->user_type == "Master Distributor"){
        $o7 =$factory->get_object($res_transactions[$i]['dt_user_id'],"users","user_id");
         $results[$i]['Distributor'] = $o7->user_name ."-".$o7->name.",".$o7->company_name ;
          $o8 =$factory->get_object($res_transactions[$i]['user_id'],"users","user_id");
            $results[$i]['Retailer'] = $o8->user_name ."-".$o8->name.",". $o8->company_name ; 
        
         }else if($o->user_type == "Distributor"){
             $results[$i]['Distributor']="";
            $o8 =$factory->get_object($res_transactions[$i]['user_id'],"users","user_id");
            $results[$i]['Retailer'] = $o8->user_name ."-".$o8->name.",". $o8->company_name ;  
         }
      
 

        if($o->user_type == "Master Distributor"){
             $results[$i]['my_inc'] = "My INC :".$res_transactions[$i]['md_comm'].", DT INC". $res_transactions[$i]['dt_comm'].", RT INC :" .round($res_transactions[$i]['total_amount'] - $res_transactions[$i]['amount'],4);
       
         } else if($o->user_type == "Distributor") {
              $results[$i]['my_inc'] = "My INC :".$res_transactions[$i]['dt_comm'].", Rt INC :".round($res_transactions[$i]['total_amount'] - $res_transactions[$i]['amount'],4);
      
        } else {
             $results[$i]['my_inc'] = "DT : ".$res_transactions[$i]['amount']."
             Com : ".round($res_transactions[$i]['total_amount'] - $res_transactions[$i]['amount'],4)." ";
        }
                $results[$i]['wallet_id'] = $res_transactions[$i]['wallet_id'];
                $results[$i]['transaction_type'] = $res_transactions[$i]['transaction_type'];
                $results[$i]['circle_name'] = $res_transactions[$i]['circle_name'];
                $results[$i]['mobile_number'] = $res_transactions[$i]['mobile_number'];
                $results[$i]['provider_type'] = $res_transactions[$i]['provider_type'];
                $results[$i]['ref_number'] = $res_transactions[$i]['ref_number'];
                $results[$i]['opid'] = $res_transactions[$i]['opid'];
                $results[$i]['transaction_details'] = $res_transactions[$i]['transaction_details'];
                $results[$i]['provider_name'] = $res_transactions[$i]['provider_name'];
				$results[$i]['user_name'] = $res_transactions[$i]['user_name'];


                if ($logo != "") {
                    $results[$i]['provider_image'] = "" . $_SERVER['HTTP_HOST'] . "/provider_logos/" . $logo . "";
                } else {
                    $results[$i]['provider_image'] = "" . $_SERVER['HTTP_HOST'] . "/provider_logos/logo.png";
                }

                $results[$i]['user_name'] = $res_transactions[$i]['user_name'];
                $results[$i]['recharge_path'] = $res_transactions[$i]['recharge_path'];
                $results[$i]['ip_address'] = $res_transactions[$i]['ip_address'];
                $results[$i]['status'] = $res_transactions[$i]['status'];
                $results[$i]['disputed'] = $res_transactions[$i]['disputed'];
                $results[$i]['transaction_date'] = $res_transactions[$i]['transaction_date'];
                $results[$i]['user_old_balance'] = $res_transactions[$i]['user_old_balance'];
                $results[$i]['total_amount'] = $res_transactions[$i]['total_amount'];
                $results[$i]['amount'] = $res_transactions[$i]['amount'];
                $results[$i]['user_new_balance'] = $res_transactions[$i]['user_new_balance'];
                $results[$i]['margin'] = $res_transactions[$i]['status'] == 'Success' ? $res_transactions[$i]['commission_rt']:0;
            }

            $result['all_history'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch History";
        } else {
            $result['all_history'] = "";
            $result['error'] = "1";
            $result['error_msg'] = "No Data Found";
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "User Blocked";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}


echo json_encode($result);
?>
