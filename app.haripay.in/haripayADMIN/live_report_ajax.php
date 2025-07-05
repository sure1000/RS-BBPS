<?php
session_start();

include "include.php";
include "session.php";
$tables = 1;
$sdate = todaysDate_only() . " 00:00:00";
$edate = todaysDate();
$trigger_start_date = "transaction_date >= '" . $sdate . "'";
$trigger_end_date = "transaction_date <= '" . todaysDate() . "'";

$sql_turnover_operator = "Select * from wallet WHERE transaction_type = 'Recharge' AND $trigger_start_date and $trigger_end_date order by wallet_id DESC LIMIT 50";
$res_turnover_operator = getXbyY($sql_turnover_operator);
if(count($res_turnover_operator))
{
?>
<table border="1" cellspacing="10" cellpadding="10" style="font-weight: bold;font-size: 20px;color: white;">
<tr style="color: black;">
    <th>Date/Time</th>
	<th>Username</th>

	<th>Provider</th>
	<th>Mobile/Dth No.</th>
	<th>Api</th>
	<th>Path</th>
	<th>Order Id</th>
	<th>Op Id</th>
	<th>Amount</th>
	
	<th>Status</th>
</tr>

<?php
foreach($res_turnover_operator as $row){
if($row['status']=='Success')
	$colour = 'green';
elseif($row['status']=='Failed')
	$colour = '#E91E63';
elseif($row['status']=='Pending')
	$colour = '#999900';
?>
	<tr style="background-color:<?php echo $colour; ?>">
	    <td><?php echo $row['transaction_date']; ?></td>
		<td><?php echo $row['user_name']; ?></td>
		<td><?php echo $row['provider_name']; ?></td>
		<td><?php echo $row['mobile_number']; ?></td>
		<td><?php echo $row['api_name']; ?></td>
		<td><?php echo $row['recharge_path']; ?></td>
		<td><?php echo $row['ref_number']; ?></td>
		<td><?php echo $row['opid']; ?></td>
		<td><?php echo $row['total_amount']; ?></td>
	    
		
			<!--<td><?php echo $row['provider_name']; ?></td>
		<td><?php echo $row['provider_name']; ?></td>
		<td><?php echo $row['provider_name']; ?></td>
		<td><?php echo $row['provider_name']; ?></td>
		<td><?php echo $row['provider_name']; ?></td>-->
		
		<td><?php echo $row['status']; ?></td>
		
	</tr>
<?php } ?>
</table>

<?php } else { echo 'not found'; } ?>