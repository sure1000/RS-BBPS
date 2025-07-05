<?php
session_start();
include "include.php";
include "session.php";

$tables = 1;

if($updte == 1){
    $date_limit_start = today_date_limit($_POST['from_date']);
    $date_limit_end = today_date_limit($_POST['to_date']);
    
    $from_date = $date_limit_start['start_time'];
    $to_date = $date_limit_start['start_time'];
}else{
    $date_limits = today_date_limit(todaysDate_only());
    $from_date = $date_limits['start_time'];
    $to_date = $date_limits['end_time'];
}

$sql_api = "Select api_id, api_name from api where is_active = 1 order by api_name";
$res_api = getXbyY($sql_api);
$row_api = count($res_api);

/*$sql_opening = "SELECT api_id, api_new_balance FROM wallet WHERE transaction_date <= '".$from_date."' GROUP BY api_id ORDER BY transaction_date DESC";
$res_opening = getXbyY($sql_opening);
$row_opening = count($res_opening);

$sql_closing = "SELECT api_id, api_new_balance FROM wallet WHERE transaction_date <= '".$to_date."'  GROUP BY api_id ORDER BY transaction_date DESC";
$res_closing = getXbyY($sql_closing);
$row_closing = count($res_closing);*/

$sql_api_wallet = "Select sum(amount) as top_up, api_id from api_wallet where transaction_date >= '".$from_date."' AND transaction_date <= '".$to_date."' and update_wallet = 'Yes' and is_active = 1 group by api_id";
$res_api_wallet = getXbyY($sql_api_wallet);
$row_api_wallet = count($res_api_wallet);

for($i=0;$i<$row_api;$i++){
    $res_api[$i]['recharge_amount'] = 0;
    $res_api[$i]['api_top_up'] = 0;
    
    for($j=0;$j<$row_api_wallet;$j++){
        if($res_api[$i]['api_id'] == $res_api_wallet[$j]['api_id']){
            $res_api[$i]['api_top_up'] = $res_api_wallet[$j]['api_top_up'];
        }
    }
}

include "html/includes/header.php";
include "html/api_wise_transactions.php";
include "html/includes/footer.php";

?>

