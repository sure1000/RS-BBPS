<?php

session_start();

include "include.php";
include "session.php";
$recharge_page = 1;
$tables = 1;

//pt($_POST);pt($_GET);
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$length = $_POST['length'];

if ($row == "") {
	$row = 0;
}

if ($length == "") {
	$length = 10;
}

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql_total = "Select count(wallet_id) as total_transactions from wallet where user_id = " . $o->user_id . " and transaction_type = 'recharge'";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where user_id = " . $o->user_id . " and transaction_type = 'recharge' order by wallet_id DESC limit 0 ,10";
//$sql_transactions = "Select * from wallet where user_id = ".$o->user_id." order by transaction_date DESC";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);
// pt($res_transactions);
if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
	 $class = transaction_type($res_transactions[$i]['transaction_type']);
        if ($class == "red") {
            $sign = "-";
        } else {
            $sign = "+";
        }
        if ($res_transactions[$i]['circle_name'] == " " || $res_transactions[$i]['circle_name'] == "" ||  $res_transactions[$i]['circle_name'] == "0") {
            $res_transactions[$i]['circle_name'] = "Pan India";
        }
       
            $transaction_type = $res_transactions[$i]['transaction_type'];
        
       $ttype  = "";
        if($transaction_type == "Recharge" || $transaction_type == "Refund" || $transaction_type == "Commission" ){
            if($res_transactions[$i]['provider_type'] == "Money Transfer" && $transaction_type == "Recharge" ){
            $transaction_type_show = "<span style='color:#130ffa'>Money Transfer </span>" ;
            $detail = $res_transactions[$i]['transaction_details'];
            }else{
                $transaction_type_show = $transaction_type;
                $detail = "";
            }
           $ttype .= "<b style='color:#fa3a0f'>" .$transaction_type_show  . "</b> <br/> <b>" . $res_transactions[$i]['mobile_number'] . " " . $res_transactions[$i]['provider_name'] . " </b>(" . $res_transactions[$i]['provider_type'] . " " . $res_transactions[$i]['circle_name'] . ") <br/>".$detail;
        }else if($transaction_type == "Send Money"){
              $ttype .=  "<b style='color:#fa3a0f'>" .$transaction_type  . "</b> <br/>".$res_transactions[$i]['transaction_details'];
           
        }else if($transaction_type == "Reverse"){
            $ttype .=  "<b style='color:#fa3a0f'>" .$transaction_type  . "</b> <br/>".$res_transactions[$i]['transaction_details'];
            
        }else if($transaction_type == "Recieve Money"){
               $ttype .=  "<b style='color:#009688'>" .$transaction_type  . "</b> <br/>".$res_transactions[$i]['transaction_details'];
        }
            
        
        
        $ttype .= "(".$res_transactions[$i]['recharge_path'].")<br/>";
        if ($res_transactions[$i]['status'] == "Success") {
            $ttype .= "<button class='btn btn-success' disabled='disabled'>Success</button>";
        } else if ($res_transactions[$i]['status'] == "Pending" || $res_transactions[$i]['InQueue']) {
            $ttype .= "<button class='btn btn-info' disabled='disabled'>Pending</button>";
        } else {
            $ttype .= "<button class='btn btn-danger' disabled='disabled'>Failed</button>";
        }
         if ($res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['disputed'] == "No") {
			$ttype .= " <button class='btn btn-warning' id='dispute_" . $res_transactions[$i]['ref_number'] . "' onclick='dispute_recharge(" . $res_transactions[$i]['ref_number'] . ")'>Dispute</button>";
		}
       if ($res_transactions[$i]['disputed'] == "Yes") {
			$ttype .= " <button class='btn btn-outline-warning' disabled='disabled'>Disputed</button>";
		}

        
        if($transaction_type == "Commission" || $transaction_type == "Refund" || $transaction_type == "Send Money" || $transaction_type == "Reverse" ||  $transaction_type == "Recieve Money" ){
        $commission_column = "";
        }else{
        $commission_column = "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['total_amount']; 
        }
        
        if($transaction_type == "Recharge"){ 
       $show_amount =  "<i class='fa fa-rupee-sign'></i> " .  $res_transactions[$i]['amount'] . "</span>";
        }else if($transaction_type == "Reverse" || $transaction_type == "Send Money"){
             $show_amount =  "<i class='fa fa-rupee-sign red' >  " . $res_transactions[$i]['amount'] . " </i></span>";
        }else if($transaction_type == "Recieve Money" || $transaction_type == "Commission" || $transaction_type == "Refund"){
             $show_amount =  "<i class='fa fa-rupee-sign green' > " . $res_transactions[$i]['amount'] . " </i></span>";
        }

        $ttype .= "  <a target = '_blank' href='print.php?ref_number=" . $res_transactions[$i]['ref_number'] . "' class='btn btn-primary' >Print</a>";
		$data[] = array(
			"transaction_date" => format_date($res_transactions[$i]['transaction_date']),
			"transaction_type" => $ttype,
                        "ref"=> "" . $res_transactions[$i]['ref_number'] ,
                        "opid"=>  $res_transactions[$i]['opid'] ,
                        "actual_amount"=> $commission_column,
			"amount" => $show_amount,
			"user_new_balance" =>"<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['user_new_balance'],
		);
	}
} else {
	$data = array();
}

## Response
$response = array(
	"draw" => intval($draw),
	"iTotalRecords" => 10,
	"iTotalDisplayRecords" => 10,
	"aaData" => $data,
);

echo json_encode($response);
?>
